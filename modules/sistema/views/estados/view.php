<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\sistema\models\Estados */
?>
<div class="estados-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'sigla',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'status:boolean',
        ],
    ]) ?>

</div>
