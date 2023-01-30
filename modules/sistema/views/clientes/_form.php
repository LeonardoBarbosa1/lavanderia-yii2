<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\sistema\models\Clientes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clientes-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cpf_cnpj')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'endereco')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'bairro')->textInput(['maxlength' => true]) ?>

    <!-- //$form->field($model, 'id_cidades')->textInput() ?>-->
    <?= $form->field($model, 'id_cidades')->widget(Select2::classname(), [
                        'data' => $listarCidade,
                        'options' => ['placeholder' => Yii::t('app', 'Selecione uma Cidade') . '...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ])
   ?>


    <?= $form->field($model, 'status')->checkbox() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
