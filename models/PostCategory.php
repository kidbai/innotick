<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_post_category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $created
 * @property integer $updated
 */
class PostCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status', 'created', 'updated'], 'required'],
            [['status', 'created', 'updated'], 'integer'],
            [['name'], 'string', 'max' => 99]
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
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
