<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_question".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $category
 * @property integer $parent_id
 * @property string $data
 * @property string $answer
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%question}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'category', 'parent_id', 'data'], 'required'],
            [['type', 'category', 'parent_id'], 'integer'],
            [['data', 'answer'], 'string'],
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
            'type' => 'Type',
            'category' => 'Category',
            'parent_id' => 'Parent ID',
            'data' => 'Data',
            'answer' => 'Answer',
        ];
    }
}
