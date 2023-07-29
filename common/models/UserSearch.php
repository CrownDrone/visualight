<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class UserSearch extends User
{
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // Define scenarios for the model
        return parent::scenarios();
    }

    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // If validation fails, show all records.
            return $dataProvider;
        }

        // Add conditions that should always apply here

        // Filtering by attributes
        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['status' => $this->status]);
        $query->andFilterWhere(['like', 'username', $this->username]);
        $query->andFilterWhere(['like', 'email', $this->email]);

        // Sorting by columns
        $dataProvider->sort->attributes['username'] = [
            'asc' => ['username' => SORT_ASC],
            'desc' => ['username' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['email'] = [
            'asc' => ['email' => SORT_ASC],
            'desc' => ['email' => SORT_DESC],
        ];

        // You can add more sorting attributes for other columns as needed

        return $dataProvider;
    }
}
