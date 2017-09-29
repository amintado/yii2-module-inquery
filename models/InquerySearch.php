<?php
/*******************************************************************************
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 ******************************************************************************/

namespace amintado\inquery\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * InquerySearch represents the model behind the search form about `common\models\Inquery`.
 */
class InquerySearch extends Inquery
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'category', 'lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['qdescription', 'qfile', 'qdate', 'adate', 'afile', 'adescription', 'UUID', 'created_at', 'updated_at'], 'safe'],
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
        $query = Inquery::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'uid' => $this->uid,
            'qdate' => $this->qdate,
            'adate' => $this->adate,
            'category' => $this->category,
            'lock' => $this->lock,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'restored_by' => $this->restored_by,
        ]);

        $query->andFilterWhere(['like', 'qdescription', $this->qdescription])
            ->andFilterWhere(['like', 'qfile', $this->qfile])
            ->andFilterWhere(['like', 'afile', $this->afile])
            ->andFilterWhere(['like', 'adescription', $this->adescription])
            ->andFilterWhere(['like', 'UUID', $this->UUID]);

        return $dataProvider;
    }
}
