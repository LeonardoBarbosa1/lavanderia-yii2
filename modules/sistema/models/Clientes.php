<?php

namespace app\modules\sistema\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property int $id
 * @property string $nome
 * @property string $cpf_cnpj
 * @property string $telefone
 * @property string $endereco
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property string $bairro
 * @property int $id_cidades
 * @property bool $status
 *
 * @property Cidades $cidades
 * @property Pedidos[] $pedidos
 */
class Clientes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'cpf_cnpj', 'telefone', 'endereco', 'bairro'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'id_cidades'], 'default', 'value' => null],
            [['created_by', 'updated_by', 'id_cidades'], 'integer'],
            [['status'], 'boolean'],
            [['nome', 'endereco'], 'string', 'max' => 100],
            [['cpf_cnpj'], 'string', 'max' => 20],
            [['telefone'], 'string', 'max' => 15],
            [['bairro'], 'string', 'max' => 50],
            [['id_cidades'], 'exist', 'skipOnError' => true, 'targetClass' => Cidades::className(), 'targetAttribute' => ['id_cidades' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'cpf_cnpj' => 'Cpf Cnpj',
            'telefone' => 'Telefone',
            'endereco' => 'Endereco',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'bairro' => 'Bairro',
            'id_cidades' => 'Id Cidades',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCidades()
    {
        return $this->hasOne(Cidades::className(), ['id' => 'id_cidades']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedidos::className(), ['id_clientes' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\sistema\query\ClientesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\sistema\query\ClientesQuery(get_called_class());
    }
}
