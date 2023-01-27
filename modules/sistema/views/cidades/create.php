<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\sistema\models\Cidades */

?>
<div class="cidades-create">
    <?= $this->render('_form', [
        'model' => $model,
        'listarEstado' => $listarEstado,
    ]) ?>
</div>
