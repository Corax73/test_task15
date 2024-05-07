<?php

namespace app\models;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property string $title
 * @property string $original_title
 * @property string|null $created_at
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'original_title'], 'required',],
            ['title', 'filter', 'filter' => 'strtolower'],
            [['created_at'], 'safe'],
            [['title', 'original_title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'original_title' => 'Original Title',
            'created_at' => 'Created At',
        ];
    }
}
