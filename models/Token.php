<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_token".
 *
 * @property integer $id
 * @property string $token
 * @property integer $client
 * @property integer $version
 * @property integer $status
 * @property integer $user_id
 * @property integer $created
 * @property integer $updated
 * @property integer $expired
 */
class Token extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%token}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token', 'client', 'version', 'status', 'user_id', 'created', 'updated', 'expired'], 'required'],
            [['client', 'version', 'status', 'user_id', 'created', 'updated', 'expired'], 'integer'],
            [['token'], 'string', 'max' => 99]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'token' => 'Token',
            'client' => 'Client',
            'version' => 'Version',
            'status' => 'Status',
            'user_id' => 'User ID',
            'created' => 'Created',
            'updated' => 'Updated',
            'expired' => 'Expired',
        ];
    }
}
