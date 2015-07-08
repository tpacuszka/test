<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Quote;

/**
 * QuoteSearch represents the model behind the search form about `app\models\Quote`.
 */
class QuoteSearch extends Quote
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'client', 'created_at', 'created_by', 'owner'], 'integer'],
            [['title', 'header', 'body'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Quote::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'client' => $this->client,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'owner' => $this->owner,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'header', $this->header])
            ->andFilterWhere(['like', 'body', $this->body]);

        return $dataProvider;
    }
}
