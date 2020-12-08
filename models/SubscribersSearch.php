<?php

namespace panix\mod\delivery\models;

use Yii;
use yii\base\Model;
use panix\engine\data\ActiveDataProvider;

/**
 * SubscribersSearch represents the model behind the search form about `panix\mod\delivery\models\Subscribers`.
 */
class SubscribersSearch extends Subscribers
{


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['email', 'name'], 'string'],
            [['created_at'], 'date', 'format' => 'php:Y-m-d']
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
        $query = Subscribers::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //  'sort'=>self::getSort()
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);


        $query->andFilterWhere(['like', 'email', $this->email]);
        $query->andFilterWhere(['like', 'created_at', $this->created_at]);
        $query->andFilterWhere(['like', 'name', $this->name]);


        return $dataProvider;
    }

}
