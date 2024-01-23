<?php

use app\enums\ImageStatus;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
    <script>
        function changeStatus(status)
        {
            $('#imageform-status').val(status)
            $('#imageDecisionForm').submit()
        }
    </script>

<?php $form = ActiveForm::begin([
    'action' => '/site/index',
    'options' => [
        'id' => 'imageDecisionForm'
    ],
]); ?>
    <img src="https://picsum.photos/id/<?=$model->imageId?>/600/500" alt="">
    <div>Image id - <?=$model->imageId?></div>
    <div>Current status - <?=$model->status?></div>
<?= $form->field($model, 'imageId')->hiddenInput()->label(false) ?>
<?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
<?php if ($model->status === ImageStatus::created->value) {
    foreach(ImageStatus::canChangeStatuses() as $status) {
        echo Html::button(ImageStatus::label($status), [
            'class' => 'btn btn-primary',
            'onclick' => 'changeStatus("' . $status . '")'
        ]);
    }
} ?>
<?php ActiveForm::end(); ?>
<?php

$this->registerJs( <<< EOT_JS_CODE
    $('body').on('beforeSubmit', '#imageDecisionForm', function () {
            const form = $(this);

            $.ajax({
                url    : form.attr('action'),
                type   : 'POST',
                data   : form.serialize(),
                success: function (response)
                {
                    form.replaceWith(response);
                    location.reload()
                },
                error  : function ()
                {
                    console.log('internal server error');
                }
            });

            return false;
        });

EOT_JS_CODE
);
?>