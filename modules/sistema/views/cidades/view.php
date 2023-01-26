<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\sistema\models\Cidades */
?>
<div class="cidades-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'id_estados',
            'status:boolean',
        ],
    ]) ?>

</div>
