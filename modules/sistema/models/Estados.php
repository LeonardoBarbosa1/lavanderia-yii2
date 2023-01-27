<?php

namespace app\modules\sistema\models;

use Yii;

/**
 * This is the model class for table "estados".
 *
 * @property int $id
 * @property string $nome
 * @property string $sigla
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property bool $status
 *
 * @property Cidades[] $cidades
 */
class Estados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'sigla'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'default', 'value' => null],
            [['created_by', 'updated_by'], 'integer'],
            [['status'], 'boolean'],
            [['nome'], 'string', 'max' => 100],
            [['sigla'], 'string', 'max' => 2],
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
            'sigla' => 'Sigla',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCidades()
    {
        return $this->hasMany(Cidades::className(), ['id_estados' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\sistema\query\EstadosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\sistema\query\EstadosQuery(get_called_class());
    }

    public static function verificarSeExiste($nome){
        $seExist = Estados::find()->where(['nome'=>strtoupper($nome)])->one();
        if($seExist){
           return true;
        }else{
            return false;
        }

    }

    public function beforeSave($insert)
    {
        if($insert){
            $this->nome= strtoupper($this->nome);
            $this->sigla= strtoupper($this->sigla);
            $this->created_at = date('Y-m-d H:i:s');
            $this->created_by = Yii::$app->user->id;
        }else{
            $this->nome= strtoupper($this->nome);
            $this->sigla= strtoupper($this->sigla);
            $this->updated_at = date('Y-m-d H:i:s');
            $this->updated_by = Yii::$app->user->id;
        }
        return parent::beforeSave($insert);
    }

   
}
