<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $data
 * @property double $price
 * @property integer $created_by
 * @property integer $created_at
 *
 * @property User $createdBy
 * @property RelationQuoteItem[] $relationQuoteItems
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_by', 'created_at'], 'required'],
            [['description', 'data'], 'string'],
            [['price'], 'number'],
            [['created_by', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 255]
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
            'description' => 'Description',
            'data' => 'Data',
            'price' => 'Price',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
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
     * Gets quotes related via junction table
     * @return \yii\db\ActiveQuery
     */
    public function getQuotes()
    {
        return $this->hasMany(Quote::className(), ['id' => 'quoteid'])
                ->viaTable('relation_quote_item', ['itemid' => 'id']);
    }
}
