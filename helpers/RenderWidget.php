<?php
namespace app\helpers;

use kartik\widgets\Select2;
use kartik\widgets\DepDrop;
use yii\web\JsExpression;
use kartik\detail\DetailView;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use Yii;
use dmstr\widgets\Menu;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RenderView
 *
 * @author Júnior Pires
 */
class RenderWidget {
    
    
    public static function select2($form,$params){
        if(!isset($params['placeholder'])){
            $params['placeholder'] = 'selecione uma opção';
        }
        
        return  $form->field($params['model'],$params['attribute'])->widget(Select2::classname(),[
            'data'=>$params['data'],'options' => ['placeholder' =>$params['placeholder']],]);
    }
    
    public static function select2Ajax($form,$params){
        if(!isset($params['placeholder'])){
            $params['placeholder'] = 'selecione uma opção';
        }
        if(!isset($params['params'])){
            $params['params'] = '';
        }else{
             $params['params'] = ','. $params['params'];
        }
        
        return  $form->field($params['model'],$params['attribute'])->label(false)->widget(Select2::classname(),[
            'options' => ['placeholder' =>$params['placeholder']],
                'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 3,
        'language' => [
            'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
        ],
        'ajax' => [
            'url' => $params['url'],
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { return {q:params.term'.$params['params'].'}; }')
        ],
        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('function(city) { return city.text; }'),
        'templateSelection' => new JsExpression('function (city) { return city.text; }'),
    ],
            ]);
    }
    
    public static function select2Child($form,$params) {
        
        if(!isset($params['data'])){
            $params['data'] = array();
        }
        
        if(!isset($params['placeholder'])){
            $params['placeholder'] = 'selecione uma opção';
        }
        
        if(!isset($params['label'])){
            $params['label'] = null;
        }
        
        return $form->field($params['model'],$params['attribute'])->label($params['label'])->widget(DepDrop::classname(), [
                'data'=>$params['data'],
                'options' => ['placeholder' =>$params['placeholder']],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                'pluginOptions'=>[ 
                              'placeholder' =>$params['placeholder'],
                              'depends'=>$params['dependents'],
                              'url'=>$params['url'],
                              'loadingText' => 'Buscando...',
                              ],
                 
                ]);
    }
    
    
    public static function depDropChild($form,$params) {
        
         if(!isset($params['placeholder'])){
            $params['placeholder'] = 'selecione uma opção';
        }
        
        return $form->field($params['model'],$params['attribute'])->widget(DepDrop::classname(), [
                //'options' => ['placeholder' => 'Selecione uma opção'],
                'pluginOptions'=>[ 
                              'placeholder' =>$params['placeholder'],
                              'depends'=>$params['dependents'],
                              'url'=>$params['url'],
                              'loadingText' => 'Buscando...',
                              ]
                ]);
    }
    
    
    
     /**
     * 
     * @param string|array $attributes
     * @param string $message
     * @return string
     */
    public static function badgeError($model, $attributes=null,$message=null){
        $error='<div class="badge badge-important"> '. ( is_string($message) ? $message : 'Erros!').'</div>';
            
            if(!is_array($model)){
            //vai gerar de acordo com os atributos
            if ($attributes!= null){
                if (is_string($attributes)){
                    return $model->hasErrors($attributes) ? $error : '';
                }
                else if(is_array($attributes)){
                    foreach ($attributes as $atr){
                        if ($model->hasErrors($atr)){
                            return $error;
                        }
                    }
                }
            }else{
                return $model->hasErrors() ? $error : '';
            }
            
            }else{
                if(!empty($model)){
                    foreach ($model as $m) {
                        return $m->hasErrors() ? $error : '';
                    }
                }
                return;
            }
        
    }
    
    public static function DetailList($list,$columns) {
        
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $list,
        ]);
    
        return GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $columns,
                    'summary'=>'',   
    ]);
    }

    // menu superior geralmente usado para fornecer navegação as ações de determinado modelo
    public static function navModel($title,$menuItems){
         
    NavBar::begin([
        'brandLabel'=>$title,
        'brandUrl' => "",
        'options' => [
            'style'=>['background-color'=>'#cfe2f3'],
            'class' => ' navbar navbar-default',
        ],
    ]);
        echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => $menuItems]);
        
     NavBar::end();
    }
    
    public static function createRolesMenu($items){
        
         $items = self::getMenu($items);
         echo Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $items
            ]
        
         ); 
         
         foreach ($items as $key => $value) {
             Yii::trace($value,"Role");
         }
    }
    
     private static function getMenu($m=null) {
         $path = Yii::$app->basePath.'/themes/lte/layouts/menu';
         $menu=[];
         $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
         foreach ($roles as $key=>$value) {
             if(file_exists($path.'/'.$key.'.php')){
                 $menusRole = require($path.'/'.$key.'.php');
                 foreach($menusRole as $v){
                     $menu[] = $v;  
                 }
                 
             }
         }
         if($m!=null){
             $menu = array_merge($m,$menu);
         }
         return $menu;
    }
}
