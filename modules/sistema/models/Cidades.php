<?php

namespace app\modules\sistema\models;

use Yii;

/**
 * This is the model class for table "cidades".
 *
 * @property int $id
 * @property string $nome
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property int $id_estados
 * @property bool $status
 *
 * @property Estados $estados
 * @property Clientes[] $clientes
 */
class Cidades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cidades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'id_estados'], 'default', 'value' => null],
            [['created_by', 'updated_by', 'id_estados'], 'integer'],
            [['status'], 'boolean'],
            [['nome'], 'string', 'max' => 100],
            [['id_estados'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['id_estados' => 'id']],
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
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'id_estados' => 'Estado',
            'status' => 'Status',
        ];
    }
   
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstados()
    {
        return $this->hasOne(Estados::className(), ['id' => 'id_estados']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Clientes::className(), ['id_cidades' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\sistema\query\CidadesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\sistema\query\CidadesQuery(get_called_class());
    }
    public function beforeSave($insert)
    {
        if($insert){
            $this->nome= strtoupper($this->nome);
            $this->created_at = date('Y-m-d H:i:s');
            $this->created_by = Yii::$app->user->id;
        }else{
            $this->nome= strtoupper($this->nome);
            $this->updated_at = date('Y-m-d H:i:s');
            $this->updated_by = Yii::$app->user->id;
        }
        return parent::beforeSave($insert);
    }
}
