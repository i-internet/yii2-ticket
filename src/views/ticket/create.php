<?php

use kartik\file\FileInput;
use kartik\select2\Select2;
use rmrevin\yii\fontawesome\CdnFreeAssetBundle;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $this \yii\web\View */
/* @var $model \simialbi\yii2\ticket\models\Ticket */
/* @var $topics array */
/* @var $priorities array */

$this->title = Yii::t('simialbi/ticket', 'Create ticket');
$this->params['breadcrumbs'] = [
    [
        'label' => Yii::t('simialbi/ticket', 'My tickets'),
        'url' => ['ticket/index']
    ],
    $this->title
];

CdnFreeAssetBundle::register($this);

?>
<div class="sa-ticket-ticket-create">
    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>

    <?= $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="form-row">
                <?= $form->field($model, 'topic_id', [
                    'options' => [
                        'class' => ['form-group', 'col-12', 'col-sm-6']
                    ]
                ])->widget(Select2::class, [
                    'data' => $topics,
                    'theme' => Select2::THEME_KRAJEE_BS4,
                    'bsVersion' => 4,
                    'pluginOptions' => [
                        'allowClear' => false
                    ]
                ]); ?>
                <?= $form->field($model, 'priority', [
                    'options' => [
                        'class' => ['form-group', 'col-12', 'col-sm-6']
                    ]
                ])->widget(Select2::class, [
                    'data' => $priorities,
                    'theme' => Select2::THEME_KRAJEE_BS4,
                    'bsVersion' => 4,
                    'pluginOptions' => [
                        'allowClear' => false
                    ]
                ]); ?>
            </div>
            <div class="form-row">
                <?= $form->field($model, 'subject', [
                    'options' => [
                        'class' => ['form-group', 'col-12']
                    ]
                ])->textInput(); ?>
            </div>
            <div class="form-row">
                <?= $form->field($model, 'description', [
                    'options' => [
                        'class' => ['form-group', 'col-12']
                    ]
                ])->textarea(['rows' => 5]); ?>
            </div>
            <div class="form-row">
                <div class="col-12 form-group">
                    <?= Html::submitButton(FAS::i('save') . ' ' . Yii::t('simialbi/ticket', 'Create ticket'), [
                        'class' => ['btn', 'btn-primary']
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <?= Html::label(Yii::t('simialbi/ticket', 'Attachments'), 'ticket-attachments', [
                    'class' => ['col-form-label-sm', 'py-0']
                ]); ?>
                <?= FileInput::widget([
                    'name' => 'attachments[]',
                    'options' => [
                        'id' => 'ticket-attachments',
                        'multiple' => true
                    ],
                    'pluginOptions' => [
                        'showUpload' => false
                    ],
                    'bsVersion' => '4'
                ]); ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
