<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\sistema\models\Clientes */

?>
<div class="clientes-create">
    <?= $this->render('_form', [
        'model' => $model,
        'listarCidade' => $listarCidade,
    ]) ?>
</div>
