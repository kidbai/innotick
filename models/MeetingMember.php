<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_meeting_member".
 *
 * @property integer $id
 * @property integer $meeting_id
 * @property integer $user_id
 * @property integer $type
 * @property integer $created
 */
class MeetingMember extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%meeting_member}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meeting_id', 'user_id', 'type', 'created'], 'required'],
            [['meeting_id', 'user_id', 'type', 'created'], 'integer']
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
            'user_id' => 'User ID',
            'type' => 'Type',
            'created' => 'Created',
        ];
    }
}
