<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

use app\modules\sistema\models\Estados;

/* @var $this yii\web\View */
/* @var $model app\modules\sistema\models\Cidades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cidades-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_estados')->widget(Select2::classname(), [
                        'data' => $listarEstado,
                        'options' => ['placeholder' => Yii::t('app', 'Selecione um Estado') . '...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ])
   ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
    
    
     



    <?= $form->field($model, 'status')->checkbox() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
