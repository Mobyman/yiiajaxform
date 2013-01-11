yiiajaxform
===========

Loading ajax forms with client validation

Usage
-----

Example action

```php
public function actionTest()
{
    Yii::import('ext.yiiajaxform.EAjaxForm');
    Yii::app()->clientScript->registerCoreScript('yiiactiveform');

    $model = new TestForm();

    if (Yii::app()->request->isAjaxRequest) {
        echo EAjaxForm::ajaxFormData('test_form', $model);
        Yii::app()->end();
    }

    if (isset($_POST['TestForm'])) {
        $model->attributes = $_POST['TestForm'];            
        
        if ($model->validate()) {
            // Form is valid
        }
    }

     $this->render('test');
}
```

Example view

```xml+php
<?php

EAjaxForm::registerScript('load-form', 'ajax-form');

?>
<h1>Тест ajax-form</h1>

<p><a href="#" id="load-form">Load test form</a></p>

<div id="ajax-form"></div>
```

Example form view

```xml+php
<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'test-ajax-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true
        )
    )); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name'); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email'); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'message'); ?>
        <?php echo $form->textArea($model, 'message'); ?>
        <?php echo $form->error($model, 'message'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Send'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>
```
