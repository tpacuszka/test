<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $name
 * @property UploadedFile $file
 * @property integer $created_at
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile 
     */
    public $file;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'created_at'], 'required'],
            [['id', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
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
            'file' => 'File',
            'created_at' => 'Created At',
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->file->saveAs('uploads/' . $this->file->baseName . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }
}
