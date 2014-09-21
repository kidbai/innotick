<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_answer".
 *
 * @property integer $id
 * @property integer $meeting_id
 * @property integer $paper_id
 * @property integer $type
 * @property integer $user_id
 * @property string $answer
 * @property integer $created
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%answer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meeting_id', 'paper_id', 'type', 'user_id', 'answer', 'created'], 'required'],
            [['meeting_id', 'paper_id', 'type', 'user_id', 'created'], 'integer'],
            [['answer'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'meeting_id' => 'Meeting ID',
            'paper_id' => 'Paper ID',
            'type' => 'Type',
            'user_id' => 'User ID',
            'answer' => 'Answer',
            'created' => 'Created',
        ];
    }
}
