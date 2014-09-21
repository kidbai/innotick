<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_post".
 *
 * @property integer $ID
 * @property string $name
 * @property integer $type
 * @property string $content
 * @property integer $created
 * @property integer $updated
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'content'], 'required'],
            [['type', 'created', 'updated'], 'integer'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 99]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'name' => '标题',
            'type' => 'Type',
            'content' => 'PDF',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
