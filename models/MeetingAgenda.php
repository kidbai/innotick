<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_meeting_agenda".
 *
 * @property integer $id
 * @property string $name
 * @property string $data
 * @property integer $created
 * @property integer $updated
 */
class MeetingAgenda extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%meeting_agenda}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'data'], 'required'],
            [['created', 'updated'], 'integer'],
            [['name', 'data'], 'string']
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
            'data' => 'Data',
            'created' => 'Created',
            'updated' => 'Updated',
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
}
