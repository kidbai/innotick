<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_post_action".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $post_id
 * @property integer $comment_id
 * @property integer $user_id
 * @property string $created
 */
class PostAction extends \yii\db\ActiveRecord
{
    const TYPE_LIKE = 1;
    const TYPE_DISLIKE = 2;
    const TYPE_COMMENT_LIKE = 3;
    const TYPE_COMMENT_DISLIKE = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post_action}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'post_id', 'comment_id', 'user_id'], 'required'],
            [['type', 'post_id', 'user_id'], 'integer'],
            [['created'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'post_id' => 'Post ID',
            'comment_id' => 'Comment ID',
            'user_id' => 'User ID',
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
