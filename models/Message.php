<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_message".
 *
 * @property integer $id
 * @property integer $meeting_id
 * @property integer $type
 * @property integer $from_user_id
 * @property integer $to_user_id
 * @property string $data
 * @property integer $created
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meeting_id', 'type', 'from_user_id', 'to_user_id', 'data', 'created'], 'required'],
            [['meeting_id', 'type', 'from_user_id', 'to_user_id', 'created'], 'integer'],
            [['data'], 'string']
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
            'type' => 'Type',
            'from_user_id' => 'From User ID',
            'to_user_id' => 'To User ID',
            'data' => 'Data',
            'created' => 'Created',
        ];
    }
}
