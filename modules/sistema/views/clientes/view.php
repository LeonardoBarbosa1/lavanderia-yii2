<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\sistema\models\Clientes */
?>
<div class="clientes-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'cpf_cnpj',
            'telefone',
            'endereco',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'bairro',
            'id_cidades',
            'status:boolean',
        ],
    ]) ?>

</div>
