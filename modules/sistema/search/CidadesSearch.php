<?php

namespace app\modules\sistema\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\sistema\models\Cidades;

/**
 * CidadesSearch represents the model behind the search form about `app\modules\sistema\models\Cidades`.
 */
class CidadesSearch extends Cidades
{
    public $_nome_estados;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by', 'id_estados'], 'integer'],
            [['nome', 'created_at', 'updated_at','_nome_estados'], 'safe'],
            [['status'], 'boolean'],
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
        $query = Cidades::find();

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
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'id_estados' => $this->id_estados,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
        ->andFilterWhere(['like', 'estado.nome', $this->_nome_estados]);

        return $dataProvider;
    }
}
