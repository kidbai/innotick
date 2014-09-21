<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_action".
 *
 * @property integer $id
 * @property integer $meeting_id
 * @property integer $from_user_id
 * @property integer $to_user_id
 * @property integer $type
 * @property integer $p1
 * @property integer $created
 */
class Action extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%action}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meeting_id', 'from_user_id', 'to_user_id', 'type', 'p1', 'created'], 'required'],
            [['meeting_id', 'from_user_id', 'to_user_id', 'type', 'created'], 'integer']
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
            'from_user_id' => 'From User ID',
            'to_user_id' => 'To User ID',
            'type' => 'Type',
            'p1' => 'P1',
            'created' => 'Created',
        ];
    }
}
