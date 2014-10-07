<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_post_comment".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $user_id
 * @property string $content
 * @property integer $created
 */
class PostComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post_comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'user_id', 'content'], 'required'],
            [['post_id', 'user_id', 'created'], 'integer'],
            [['content'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'user_id' => 'User ID',
            'content' => 'Content',
            'created' => 'Created',
        ];
    }

    public function beforeSave($insert) 
    {   
        if (parent::beforeSave($insert)) 
        {
            if ($insert) 
            {
                $this->created = time();
            }  
            return true;
        } 
        else 
        {
            return false;
        } 
    } 

}
