<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "document".
 *
 * @property integer $id
 * @property string $name
 * @property string $filename
 * @property string $desc
 * @property string $update_at
 *
 * @property ImagePost[] $imagePosts
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'filename', 'desc'], 'required'],
            [['name'], 'string', 'max' => 255],
            ['filename','file','extensions' => ['png','jpeg','jpg']],
            [['desc'], 'string', 'max' => 500]
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
            'filename' => 'Filename',
            'desc' => 'Desc',
            'update_at' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagePosts()
    {
        return $this->hasMany(ImagePost::className(), ['file_id' => 'id']);
    }
}
