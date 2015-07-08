<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $postal_code
 * @property integer $created_at
 * @property integer $created_by
 *
 * @property User $createdBy
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'created_by', 'owned_by'], 'required'],
            [['name'], 'string'],
            [['created_at', 'created_by', 'owned_by'], 'integer'],
            [['address', 'postal_code'], 'string', 'max' => 255]
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
            'address' => 'Address',
            'postal_code' => 'Postal Code',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'owned_by' => 'Owner'
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
     * Get all products that client have
     * 
     * @return Array
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['client_id' => 'id'])
            ->where(['deleted' => 0]);
    }
    
    /**
     * Get client owner
     * @return User
     */
    public function getOwnedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'owned_by']);
    }
}
