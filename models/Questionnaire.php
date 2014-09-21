<?php

namespace app\models;

use Yii;
use app\models\Question;
use app\component\DXConst;

/**
 * This is the model class for table "tbl_questionnaire".
 *
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property integer $time
 * @property integer $created
 */
class Questionnaire extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%questionnaire}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['user_id', 'time', 'created'], 'integer'],
            [['name'], 'string', 'max' => 99]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'user_id' => 'User ID',
            'time' => 'Time',
            'created' => 'Created',
        ];
    }

    public function getQuestionList()
    {
        return Question::find()->where(['parent_id' => $this->id, 'category' => DXConst::QUESTION_QUESTIONAIRE])->all();
    }
}
