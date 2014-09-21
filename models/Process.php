<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_process".
 *
 * @property integer $id
 * @property integer $meeting_id
 * @property integer $type
 * @property integer $user_id
 * @property string $data
 * @property integer $created
 */
class Process extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%process}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meeting_id', 'type', 'user_id', 'data', 'created'], 'required'],
            [['meeting_id', 'type', 'user_id', 'created'], 'integer'],
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
            'user_id' => 'User ID',
            'data' => 'Data',
            'created' => 'Created',
        ];
    }
}
