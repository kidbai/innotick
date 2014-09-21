<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $authority
 * @property integer $created
 * @property integer $updated
 * @property integer $last_login_time
 */
class Admin extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'authority', 'created', 'updated', 'last_login_time'], 'required'],
            [['created', 'updated', 'last_login_time'], 'integer'],
            [['username', 'password', 'authority'], 'string', 'max' => 99]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'authority' => 'Authority',
            'created' => 'Created',
            'updated' => 'Updated',
            'last_login_time' => 'Last Login Time',
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


    public static function findIdentity($id)
    {
        return self::find()->where(['id' => $id])->one();
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }    


    public static function findByUsername($username)
    {
        return self::find()->where(' LOWER(username) = :username', [':username' => strtolower($username)])->one();
    }   


    public function getId()
    {
        return $this->id;
    }


    public function getAuthKey()
    {
        return $this->id;
    }


    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }


    public function encodePassword($password)
    {
        return md5(md5($password));
    }


    public function validatePassword($password)
    {
        return $this->encodePassword($password) === $this->password;
    }     
}
