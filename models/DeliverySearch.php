<?php

namespace panix\mod\delivery\models;

use Yii;
use yii\base\Model;
use panix\engine\data\ActiveDataProvider;
use panix\mod\delivery\models\Delivery;

/**
 * PagesSearch represents the model behind the search form about `app\common\modules\pages\models\Pages`.
 */
class DeliverySearch extends Delivery {


    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id'], 'integer'],
            [['email'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Delivery::find();

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


        return $dataProvider;
    }

}
