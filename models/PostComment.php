<?php

namespace app\models;

use Yii;
use app\models\User;

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

    // public function getCommentLikeCount()
    // {
    // //     $comment_id = sql('select comment_id from {{$post_comment}} where post_id = :post_id')
    // //                     ->bindValues([':post_id' => $this->id]);
    //     $comment_like = sql(' select count(*) from {{%post_action}} where post_id = :post_id and comment_id = :comment_id and type = :type ')
    //             ->bindValues([':post_id' => $this->id, ':type' => PostAction::TYPE_COMMENT_LIKE])->queryScalar();
    //     return $comment_like;
    // }
    // public function getCommentDisLikeCount()
    // {
    //     return sql(' select count(*) from {{%post_action}} where post_id = :post_id and type = :type ')
    //             ->bindValues([':post_id' => $this->id,':type' => PostAction::TYPE_COMMENT_DISLIKE])->queryScalar();
    // } 

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }  

    public function getLikeCount()
    {
        return sql(' select count(*) from {{%post_action}} where comment_id = :comment_id and type = :type ')
                ->bindValues([':comment_id' => $this->id, ':type' => PostAction::TYPE_COMMENT_LIKE])->queryScalar();
    }

    public function getDisLikeCount()
    {
        return sql(' select count(*) from {{%post_action}} where comment_id = :comment_id and type = :type ')
                ->bindValues([':comment_id' => $this->id, ':type' => PostAction::TYPE_COMMENT_DISLIKE])->queryScalar();        
    } 


}
