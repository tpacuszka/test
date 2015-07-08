<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $product_name
 * @property double $price
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $client_id
 * @property integer $owned_by
 * @property integer $deleted
 * @property string $file_path
 */
class Product extends \yii\db\ActiveRecord
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
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_name', 'created_at', 'created_by', 'client_id', 'owned_by'], 'required'],
            [['product_name', 'file_path'], 'string'],
            [['price'], 'number'],
            [['created_at', 'created_by', 'owned_by', 'deleted', 'client_id'], 'integer'],
            [['file'], 'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_name' => 'Product Name',
            'price' => 'Price',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'client_id' => 'Client',
            'owned_by' => 'Owner',
            'deleted' => 'Is deleted',
            'file_path' => 'File'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    
    /**
     * Returns related client
     * @return Client
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }
    
    /**
     * Return product user owner
     * 
     * @return User
     */
    public function getOwnedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'owned_by']);
    }
    
    /**
     * Upload file
     * 
     * @return Bool
     */
    public function upload()
    {
        if ($this->validate()) {
            $path = 'uploads/' . $this->file->baseName . '.' . $this->file->extension;
            $this->file->saveAs($path);
            $this->file_path = $path;
            return true;
        }
        return false;
    }
}
