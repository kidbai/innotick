<?php

namespace app\models;

use Yii;
use app\component\DXConst;
use app\models\User;

/**
 * This is the model class for table "tbl_meeting".
 *
 * @property integer $id
 * @property string $name
 * @property integer $time
 * @property string $address
 * @property string $desc
 * @property integer $agenda_id
 * @property integer $created
 * @property integer $updated
 * @property integer $status
 */
class Meeting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%meeting}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'time', 'desc', 'status', 'agenda_id'], 'required', 'message' => '{attribute}不能为空'],
            [['time', 'agenda_id', 'created', 'updated', 'status'], 'integer'],
            [['name', 'address', 'desc'], 'string', 'max' => 99]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '会议名称',
            'time' => '会议时长',
            'address' => '会议地址',
            'desc' => '会议简介',
            'agenda_id' => '议程配置',
            'created' => 'Created',
            'updated' => 'Updated',
            'status' => 'Status',
        ];
    }

    public function beforeSave($insert) 
    {   
        if (parent::beforeSave($insert)) 
        {
            $this->updated = time();
            if ($insert) 
            {
                $this->created = $this->updated;
            }  
            return true;
        } 
        else 
        {
            return false;
        } 
    }  

    public function getHost()
    {
        $user_id = sql(' select user_id from {{%meeting_member}} where meeting_id = '. $this->id .' and type = '. DXConst::MEETING_MEMBER_HOST .' ')->queryScalar();
        if ($user_id)
        {
            return User::find()->where(['id' => $user_id])->one();
        }

        return null;
    } 

    public function getMembers()
    {
        $db_user_list = sql(' select user_id from {{%meeting_member}} where meeting_id = '. $this->id .' and type = '. DXConst::MEETING_MEMBER_COMMON .' ')->queryAll();
        $user_list = [];
        foreach ($db_user_list as $db_user)
        {
            $user = User::find()->where(['id' => intval($db_user['user_id'])])->one();
            if (!$user) continue;
            $user_list[] = $user;
        }

        return $user_list;
    }

    public function getAssistant()
    {
        $user_id = sql(' select user_id from {{%meeting_member}} where meeting_id = '. $this->id .' and type = '. DXConst::MEETING_MEMBER_ASSISTANT .' ')->queryScalar();
        if ($user_id)
        {
            return User::find()->where(['id' => $user_id])->one();
        }

        return null;
    } 

    public function getCommentator()
    {
        $user_id = sql(' select user_id from {{%meeting_member}} where meeting_id = '. $this->id .' and type = '. DXConst::MEETING_MEMBER_COMMENTATOR .' ')->queryScalar();
        if ($user_id)
        {
            return User::find()->where(['id' => $user_id])->one();
        }

        return null;
    } 

    public function getRecorder()
    {
        $user_id = sql(' select user_id from {{%meeting_member}} where meeting_id = '. $this->id .' and type = '. DXConst::MEETING_MEMBER_RECORDER .' ')->queryScalar();
        if ($user_id)
        {
            return User::find()->where(['id' => $user_id])->one();
        }

        return null;
    }             
        
}
