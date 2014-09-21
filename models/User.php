<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $phone
 * @property integer $auth_id
 * @property string $name
 * @property string $company
 * @property string $company_position
 * @property string $avatar
 * @property integer $status
 * @property integer $heartbeat
 * @property integer $created
 * @property integer $updated
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'name', 'company', 'company_position', 'desc'], 'required', 'message' => '{attribute}不能为空'],
            [['auth_id', 'status', 'heartbeat', 'created', 'updated'], 'integer'],
            [['username', 'password', 'phone', 'name', 'company', 'company_position', 'avatar'], 'string', 'max' => 99]
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
            'phone' => '手机号',
            'auth_id' => 'Auth ID',
            'name' => '姓名',
            'company' => '公司',
            'company_position' => '职位',
            'avatar' => '头像',
            'desc' => '介绍',
            'status' => 'Status',
            'heartbeat' => 'Heartbeat',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
