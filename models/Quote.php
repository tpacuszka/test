<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quote".
 *
 * @property integer $id
 * @property string $title
 * @property integer $client
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $owner
 * @property string $header
 * @property string $body
 *
 * @property User $owner0
 * @property User $createdBy
 * @property RelationQuoteProduct $relationQuoteProduct
 * @property RelationQuoteItem $relationQuoteItem
 */
class Quote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'client', 'created_at', 'created_by', 'owner'], 'required'],
            [['client', 'created_at', 'created_by', 'owner'], 'integer'],
            [['header', 'body'], 'string'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'client' => 'Client',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'owner' => 'Owner',
            'header' => 'Header',
            'body' => 'Body',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner0()
    {
        return $this->hasOne(User::className(), ['id' => 'owner']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['id' => 'itemid'])
                ->viaTable('relation_quote_item', ['quoteid' => 'id']);
    }
}
