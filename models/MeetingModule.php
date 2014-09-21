<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_meeting_module".
 *
 * @property integer $id
 * @property integer $meeting_id
 * @property integer $type
 * @property string $data
 * @property integer $sort
 */
class MeetingModule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%meeting_module}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meeting_id', 'type', 'data', 'sort'], 'required'],
            [['meeting_id', 'type', 'sort'], 'integer'],
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
            'data' => 'Data',
            'sort' => 'Sort',
        ];
    }
}
