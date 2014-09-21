<?php

namespace app\models;

use Yii;
use app\models\Question;
use app\component\DXConst;

/**
 * This is the model class for table "tbl_vote".
 *
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property integer $time
 * @property integer $min_option
 * @property integer $max_option
 * @property integer $created
 */
class Vote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vote}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'min_option', 'max_option'], 'required'],
            [['user_id', 'time', 'min_option', 'max_option', 'created'], 'integer'],
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
            'min_option' => 'Min Option',
            'max_option' => 'Max Option',
            'created' => 'Created',
        ];
    }

    public function getQuestionList()
    {
        return Question::find()->where(['parent_id' => $this->id, 'category' => DXConst::QUESTION_VOTE])->all();
    }

}
