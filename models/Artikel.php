<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "artikel".
 *
 * @property integer $id
 * @property string $date
 * @property integer $category
 * @property string $title
 * @property string $content
 * @property string $writer
 * @property string $img
 *
 * @property Category $category0
 */
class Artikel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'artikel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'category', 'title', 'content', 'writer'], 'required'],
            [['date'], 'safe'],
            [['category'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 1000],
            [['writer'], 'string', 'max' => 200],
            [['img'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'category' => 'Category',
            'title' => 'Title',
            'content' => 'Content',
            'writer' => 'Writer',
            'img' => 'Img',
        ];
    }

    public function getPrettyDate(){
        $date = \DateTime::createFromFormat('Y-m-d H:i:s',$this->date);
        return $date->format('l, jS F Y');

    }

    public function getImages()
    {
        return $this->hasMany(ImagePost::className(), ['artikel_id' => 'id']);
    }

    public function getImage()
    {
        return $this->hasOne(ImagePost::className(), ['artikel_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryObj()
    {
        return $this->hasOne(Category::className(), ['id' => 'category']);
    }

    public function getCountImg(){
        return $this->hasMany(ImagePost::className(), ['artikel_id' => 'id'])->count();   
    }
}
