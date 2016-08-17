<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "image_post".
 *
 * @property integer $id
 * @property integer $artikel_id
 * @property integer $file_id
 * @property integer $height
 *
 * @property Artikel $artikel
 * @property Document $file
 */
class ImagePost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['artikel_id', 'file_id', 'height'], 'required'],
            [['artikel_id', 'file_id', 'height'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'artikel_id' => 'Artikel ID',
            'file_id' => 'File ID',
            'height' => 'Height',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArtikel()
    {
        return $this->hasOne(Artikel::className(), ['id' => 'artikel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Document::className(), ['id' => 'file_id']);
    }

    public function imgSrc(){
        $request = Yii::$app->request;
        return $request->baseUrl.'/web/upload/'.$this->file->id.'-'.$this->file->filename;
    }

}
