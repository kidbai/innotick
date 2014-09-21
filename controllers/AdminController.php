<?php

namespace app\controllers;

use Yii;
use app\component\BaseController;
use app\models\LoginForm;
use app\models\Admin;
use app\models\Post;
use app\models\User;
use app\models\Meeting;
use app\models\MeetingAgenda;
use app\models\Questionnaire;
use app\models\Question;
use app\models\Vote;
use app\component\WebUser;
use app\component\DXConst;
use yii\db\ActiveQuery;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class AdminController extends BaseController
{
    public $layout = 'admin';

    public function beforeAction($action)
    {
        if (app()->admin->isGuest)
        {
            if ($action->id != 'login')
            {
                $this->redirect('/admin/login');
            }
        }
        else
        {
            if ($action->id == 'login')
            {
                $this->redirect('/admin/index');
            }
        }

        

        return parent::beforeAction($action);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionStatus()
    {

    }

    public function actionLogin()
    {
        $this->layout = 'todc';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->login(WebUser::TYPE_ADMIN))
            {
                $this->redirect('/admin/index');
            }          
        }       
        
        return $this->render('login', [
            'model' => $model
        ]);
    }

    public function actionLogout()
    {
        app()->admin->logout();        
        $this->redirect('/admin/login');
    }

    public function actionIndex()
    {
        // return  $this->render('/admin/index');

        $this->redirect('/admin/meeting');
    }

    public function actionChangePassword()
    {
        $old_password = $_REQUEST['old_password'];
        $password = $_REQUEST['password'];

        if (admin()->password != admin()->encodePassword($old_password))
        {
            $this->finish(['error' => 1, 'message' => '旧密码错误']);
        }

        admin()->password = admin()->encodePassword($password);
        if (admin()->save())
        {
            $this->finish(['error' => 0, 'message' => '修改密码成功']);
        }
        else
        {
            $this->finish(['error' => 1, 'message' => '修改失败，请稍后再试']);
        }
    }    




    /* meeting */
    public function actionMeeting()
    {
        app()->session['page'] = 1;

        $meeting = Meeting::find()->where(['status' => DXConst::MEETING_STATUS_VALID])->one();
        if (!$meeting)
        {
            return $this->redirect('/admin/meeting-edit');
        }

        return $this->render('/admin/meeting', ['meeting' => $meeting]);
    }


    public function actionMeetingEdit()
    {
        app()->session['page'] = 1;

        $meeting = Meeting::find()->where(['status' => 1])->one();
        if (!$meeting)
        {
            $meeting = new Meeting();
        }

        if ($meeting->load(app()->request->post()))
        {
            $meeting->status = DXConst::MEETING_STATUS_VALID;
            if ($meeting->save()) 
            {
                $this->redirect(url(['/admin/meeting']));
            }  
            else
            {
                dump($meeting->errors);die();
            }     
        }  

        $db_agenda_list = sql(' select * from {{%meeting_agenda}} order by id asc ')->queryAll();
        $agenda_list = [];
        foreach ($db_agenda_list as $db_agenda)
        {
            $agenda_id = intval($db_agenda['id']);
            $agenda_list[$agenda_id] = $db_agenda['name'];
        }

        return $this->render('/admin/meeting-edit', ['model' => $meeting, 'agenda_list' => $agenda_list]);
    }

    public function actionMeetingMemberEdit($id)
    {
        app()->session['page'] = 1;

        $meeting = Meeting::find()->where(['id' => $id])->one();
        if (!$meeting)
        {
            throw new NotFoundHttpException("会议不存在");
        }



        return $this->render('/admin/meeting-member-edit', ['meeting' => $meeting]);

    }  

    public function actionMeetingMemberEditSave()
    {
        $id = intval($_REQUEST['id']);
        $host = intval($_REQUEST['host']);
        $member = $_REQUEST['member'];
        $assistant = intval($_REQUEST['assistant']);
        $commentator = intval($_REQUEST['commentator']);
        $recorder = intval($_REQUEST['recorder']);

        $data['code'] = 0;
        $meeting = Meeting::find()->where(['id' => $id])->one();
        if (!$meeting)
        {
            $data['code'] = 1;
            $this->finish($data);
        }        

        sql(' delete from {{%meeting_member}} where meeting_id = '. $id .' ')->query();

        sql(' insert into {{%meeting_member}} (meeting_id, user_id, type, created) values (:meeting_id, :user_id, :type, :created) ')
            ->bindValues([':meeting_id' => $id, ':user_id' => $host, ':type' => DXConst::MEETING_MEMBER_HOST, ':created' => time()])
            ->query();

        $member = trim($member);
        $member = trim($member, '-');
        $members = explode('-', $member);
        foreach ($members as $m)
        {
            $uid = intval($m);
            sql(' insert into {{%meeting_member}} (meeting_id, user_id, type, created) values (:meeting_id, :user_id, :type, :created) ')
                ->bindValues([':meeting_id' => $id, ':user_id' => $uid, ':type' => DXConst::MEETING_MEMBER_COMMON, ':created' => time()])
                ->query();
        }

        sql(' insert into {{%meeting_member}} (meeting_id, user_id, type, created) values (:meeting_id, :user_id, :type, :created) ')
            ->bindValues([':meeting_id' => $id, ':user_id' => $assistant, ':type' => DXConst::MEETING_MEMBER_ASSISTANT, ':created' => time()])
            ->query(); 

        sql(' insert into {{%meeting_member}} (meeting_id, user_id, type, created) values (:meeting_id, :user_id, :type, :created) ')
            ->bindValues([':meeting_id' => $id, ':user_id' => $commentator, ':type' => DXConst::MEETING_MEMBER_COMMENTATOR, ':created' => time()])
            ->query(); 

        sql(' insert into {{%meeting_member}} (meeting_id, user_id, type, created) values (:meeting_id, :user_id, :type, :created) ')
            ->bindValues([':meeting_id' => $id, ':user_id' => $recorder, ':type' => DXConst::MEETING_MEMBER_RECORDER, ':created' => time()])
            ->query();  

        $this->finish(['code' => 0]);                              

    }   

    public function actionMeetingEnd()
    {
        $id = $_REQUEST['id'];
        $id = intval($id);

        $data['code'] = 0;

        $meeting = Meeting::find()->where(['id' => $id])->one();
        $meeting->status = 2;
        if (!$meeting->save())
        {
            $data['code'] = -1;
        }

        $this->finish($data);
    }

    public function actionMeetingSendMsg()
    {
        $user_id = intval($_REQUEST['user_id']);
        $msg = $_REQUEST['msg'];
        $meeting_id = intval($_REQUEST['id']);

        $this->saveMessage($meeting_id, DXConst::MESSAGE_SYSTEM, 0, $user_id, $msg);

        $this->finish(['code' => 0]);

    }

    public function actionMeetingProcessList($id = 0, $last_process_id = 0)
    {
        $this->layout = false;

        $id = intval($id);
        $last_process_id = intval($last_process_id);

        $db_agenda = sql(' select t1.* from {{%meeting_agenda}} as t1, {{%meeting}} as t2 where t1.id = t2.agenda_id and t2.id = '. $id .' ')->queryOne();
        $agenda = json_decode($db_agenda['data'], true);

        $db_process_list = sql(' select * from {{%process}} where meeting_id = '. $id .' and type > 0 and id > '. $last_process_id .' order by id desc ')->queryAll();

        $db_member_list = sql(' select t2.*, t1.type from {{%meeting_member}} as t1, {{%user}} as t2 where t1.user_id = t2.id and t1.meeting_id = '. $id .' ')->queryAll();
        $members = [];
        foreach ($db_member_list as $db_member)
        {
            $user_id = $db_member['id'];
            $members[$user_id] = $db_member;
        }

        return $this->render('/admin/meeting-process-list', [
            'process_list' => $db_process_list, 
            'members' => $members,
            'agenda' => $agenda
        ]);
    }

    public function actionAgendaList()
    {
        app()->session['page'] = 1;

        $agenda_list = MeetingAgenda::find()->all();

        return $this->render('/admin/agenda-list', ['agenda_list' => $agenda_list]);
    }

    public function actionAgendaEdit($id = 0)
    {
        app()->session['page'] = 1;

        $agenda = MeetingAgenda::find()->where(['id' => $id])->one();
        if (!$agenda)
        {
            $agenda = new MeetingAgenda();
        }

        $questionnaire_list = sql(' select id, name from {{%questionnaire}} order by id asc ')->queryAll();
        $vote_list = sql(' select id, name from {{%vote}} order by id asc ')->queryAll();
        $post_list = sql(' select id, name from {{%post}} order by id asc ')->queryAll();

        return $this->render('/admin/agenda-edit', ['agenda' => $agenda, 'questionnaire_list' => $questionnaire_list,
            'vote_list' => $vote_list,
            'post_list' => $post_list
            ]);
    }

    public function actionAgendaSave()
    {
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $agenda_data = $_REQUEST['data'];

        $data['code'] = 0;

        $agenda = MeetingAgenda::find()->where(['id' => $id])->one();
        if (!$agenda)
        {
            $agenda = new MeetingAgenda();
        }

        $agenda->name = $name;
        $agenda->data = $agenda_data;
        if (!$agenda->save())
        {
            $data['code'] = -1;
        }
        else
        {
            $data['id'] = $agenda->id;
        }

        $this->finish($data);
    }

    public function actionAgendaModuleRender()
    {
        $this->layout = false;

        $module = [];
        $module['id'] = $_REQUEST['id'];
        $module['name'] = $_REQUEST['name'];
        $module['type'] = $_REQUEST['type'];
        $module['time'] = $_REQUEST['time'];

        return $this->render('/admin/agenda-item', ['module' => $module]);
    }

    public function actionAgendaChildModuleRender()
    {
        $this->layout = false;

        $module = [];
        $id = $_REQUEST['parent_id'];
        $module['id'] = $_REQUEST['id'];
        $module['name'] = $_REQUEST['name'];
        $module['type'] = $_REQUEST['type'];
        $module['pid'] = $_REQUEST['pid'];
        $module['time'] = $_REQUEST['time'];

        return $this->render('/admin/agenda-child-item', ['id' => $id, 'child' => $module]);
    }

    public function actionAgendaDelete()
    {

        $id = intval($_REQUEST['id']);

        $data = ['code' => 0];

        $count = MeetingAgenda::deleteAll(['id' => $id]);
        if ($count < 1)
        {
            $data['code'] = 1;
        }

        $this->finish($data);
    }     








    /************* post *************/
    public function actionPost()
    {
        app()->session['page'] = 5;

        $this->redirect(url(['/admin/post-list', 'category_id' => 1]));
    }

    public function actionPostList()
    {
        app()->session['page'] = 5;

        $query = new ActiveQuery(Post::className());
        $query->orderBy(['id' => SORT_DESC]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);        

        return $this->render('/admin/post-list', ['provider' => $provider]);
    }

    public function actionPostEdit($id = 0)
    {
        app()->session['page'] = 5;

        $id = intval($id);
        $post = Post::find()->where(['id' => $id])->one();
        if (!$post)
        {
            $post = new Post();
        }

        if ($post->load(app()->request->post()))
        {
            if ($post->save()) 
            {
                $this->redirect(url(['/admin/post-list']));
            }       
        }          

        return $this->render('/admin/post-edit', ['model' => $post]);
    }

    public function actionPostDelete()
    {

        $id = intval($_REQUEST['id']);

        $data = ['error' => 0];

        $count = Post::deleteAll(['id' => $id]);
        if ($count < 1)
        {
            $data['error'] = 1;
        }

        $this->finish($data);
    }    










    /************* user *************/

    public function actionUser()
    {
        app()->session['page'] = 2;

        return $this->redirect('/admin/user-list');
    }

    public function actionUserInfo()
    {
        $user = ['error' => 0];

        $user['username'] = admin()->username;

        $this->finish($user);
    }    

    public function actionUserModifyRequestList()
    {
        app()->session['page'] = 2;

        return $this->render('/admin/user-modify-request-list');
    }

    public function actionUserList()
    {
        app()->session['page'] = 2;

        $query = new ActiveQuery(User::className());
            // $query->from('{{%course}}');
        $query->from('{{%user}}');

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('user-list', ['provider' => $provider]);        
    }

    public function actionUserEdit($id = 0)
    {
        app()->session['page'] = 2;

        $id = intval($id);
        $user = User::find()->where(['id' => $id])->one();
        if (!$user)
        {
            $user = new User();
        }

        if ($user->load(app()->request->post()))
        {
            if ($user->save()) 
            {
                $this->redirect(url(['/admin/user-list']));
            }       
        }          

        return $this->render('/admin/user-edit', ['model' => $user]);
    }

    public function actionUserDelete()
    {

        $id = intval($_REQUEST['id']);

        $data = ['error' => 0];

        $count = User::deleteAll(['id' => $id]);
        if ($count < 1)
        {
            $data['error'] = 1;
        }

        $this->finish($data);
    }    








    /************* questionnair *************/
    public function actionQuestionnaire()
    {
        app()->session['page'] = 3;

        $this->redirect('/admin/questionnaire-list');
    }

    public function actionQuestionnaireList()
    {
        app()->session['page'] = 3;

        $questionnaire_list = Questionnaire::find()->all();

        return $this->render('/admin/questionnaire-list', ['questionnaire_list' => $questionnaire_list]);
    }

    public function actionQuestionnaireEdit($id = 0)
    {
        app()->session['page'] = 3;

        $questionnaire = Questionnaire::find()->where(['id' => $id])->one();
        if (!$questionnaire)
        {
            $questionnaire = new Questionnaire();
        }

        return $this->render('/admin/questionnaire-edit', ['questionnaire' => $questionnaire]);
    }

    public function actionQuestionnaireSave()
    {
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $questionnaire_data = $_REQUEST['data'];

        $data['code'] = 0;

        $questionnaire = Questionnaire::find()->where(['id' => $id])->one();
        if (!$questionnaire)
        {
            $questionnaire = new Questionnaire();
        }
        $questionnaire->name = $name;
        if (!$questionnaire->save())
        {
            $data['code'] = 1;
            $this->finish($data);
        }        

        sql(' delete from {{%question}} where parent_id = '. $questionnaire->id .' and category = '. DXConst::QUESTION_QUESTIONAIRE .' ')->query();

        $qd_list = json_decode($questionnaire_data, true);
        foreach ($qd_list as $qd)
        {
            $question = new Question();
            $question->name = $qd['name'];
            $question->type = 1;
            $question->category = DXConst::QUESTION_QUESTIONAIRE;
            $question->parent_id = $questionnaire->id;
            $question->data = json_encode($qd['child']);
            if (!$question->save())
            {
                // $questionnaire->delete();
                $data['code'] = 2;
                $this->finish($data);
            }
        }

        $this->finish($data);
    }

 
    public function actionQuestionnaireDelete()
    {

        $id = intval($_REQUEST['id']);

        $data = ['code' => 0];

        $count = Questionnaire::deleteAll(['id' => $id]);
        if ($count < 1)
        {
            $data['code'] = 1;
        }

        sql(' delete from {{%question}} where parent_id = '. $id .' and category = '. DXConst::QUESTION_QUESTIONAIRE .' ')->query();

        $this->finish($data);
    }     









   /************* questionnair *************/
    public function actionVote()
    {
        app()->session['page'] = 4;

        $this->redirect('/admin/vote-list');
    }

    public function actionVoteList()
    {
        app()->session['page'] = 4;

        $vote_list = Vote::find()->all();

        return $this->render('/admin/vote-list', ['vote_list' => $vote_list]);
    }

    public function actionVoteEdit($id = 0)
    {
        app()->session['page'] = 4;

        $vote = Vote::find()->where(['id' => $id])->one();
        if (!$vote)
        {
            $vote = new Vote();
        }      

        return $this->render('/admin/vote-edit', ['vote' => $vote]);
    }

    public function actionVoteSave()
    {
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $min_option = $_REQUEST['min_option'];
        $max_option = $_REQUEST['max_option'];        
        $vote_data = $_REQUEST['data'];

        $data['code'] = 0;

        $vote = Vote::find()->where(['id' => $id])->one();
        if (!$vote)
        {
            $vote = new Vote();
        }
        $vote->name = $name;
        $vote->min_option = $min_option;
        $vote->max_option = $max_option;
        if (!$vote->save())
        {
            $data['code'] = 1;
            $this->finish($data);
        }        

        sql(' delete from {{%question}} where parent_id = '. $vote->id .' and category = '. DXConst::QUESTION_VOTE .' ')->query();

        $qd_list = json_decode($vote_data, true);
        foreach ($qd_list as $qd)
        {
            $question = new Question();
            $question->name = $qd['name'];
            $question->type = 1;
            $question->category = DXConst::QUESTION_VOTE;
            $question->parent_id = $vote->id;

            $user_data = [];
            $user_data['user_id'] = intval($qd['user']);
            $user_data['user_name'] = @sql(' select name from {{%user}} where id = '. intval($qd['user']) .' ')->queryScalar();
            $question->data = json_encode($user_data);
            if (!$question->save())
            {
                $data['code'] = 2;
                $this->finish($data);
            }
        }

        $this->finish($data);
    }

 
    public function actionVoteDelete()
    {

        $id = intval($_REQUEST['id']);

        $data = ['code' => 0];

        $count = Vote::deleteAll(['id' => $id]);
        if ($count < 1)
        {
            $data['code'] = 1;
        }

        sql(' delete from {{%question}} where parent_id = '. $id .' and category = '. DXConst::QUESTION_VOTE .' ')->query();


        $this->finish($data);
    }         




    
}
