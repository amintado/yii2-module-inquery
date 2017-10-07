<?php

namespace amintado\inquery\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use amintado\inquery\models\base\InqueryCategory;

/**
 * amintado\inquery\models\\InqueryCategorySearch represents the model behind the search form about `amintado\inquery\models\base\InqueryCategory`.
 */
 class InqueryCategorySearch extends InqueryCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['catname', 'description', 'date', 'UUID', 'created_at', 'updated_at'], 'safe'],
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
        $query = InqueryCategory::find();

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
            'date' => $this->date,
            'lock' => $this->lock,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'restored_by' => $this->restored_by,
        ]);

        $query->andFilterWhere(['like', 'catname', $this->catname])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'UUID', $this->UUID]);

        return $dataProvider;
    }
}
