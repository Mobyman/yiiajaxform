<?php
/**
 * Created by JetBrains PhpStorm.
 * User: AlexOk
 * Date: 10.01.13
 * Time: 12:49
 */
class EAjaxForm
{
    public static function ajaxFormData($view, $model)
    {
        $result = array(
            'form'=>Yii::app()->getController()->renderPartial($view, array('model'=>$model), true),
        );

        $scripts = Yii::app()->clientScript->scripts[CClientScript::POS_READY];
        $result['js'] = sprintf('jQuery(function($) { %s });', implode("\n", $scripts));

        return json_encode($result);
    }

    public static function registerScript($link_id, $container_id)
    {
         $script = "$('#{$link_id}').click(function() {
            $.get('', function(data) {
                $('#{$container_id}').html(data.form);

                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.innerHTML = data.js;
                document.body.appendChild(script);
            }, 'json');
        });";

        Yii::app()->clientScript->registerScript('AjaxFormLoad', $script);
    }
}
