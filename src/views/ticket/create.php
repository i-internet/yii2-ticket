<?php

use kartik\select2\Select2;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $this \yii\web\View */
/* @var $model \simialbi\yii2\ticket\models\Ticket */
/* @var $topics array */
/* @var $priorities array */
/* @var $users array */

$this->title = Yii::t('simialbi/ticket', 'Create ticket');
$this->params['breadcrumbs'] = [
    [
        'label' => Yii::t('simialbi/ticket', 'My tickets'),
        'url' => ['ticket/index']
    ],
    $this->title
];

$isAgent = Yii::$app->user->can('ticketAgent');

?>
<div class="sa-ticket-ticket-create">
    <?php $form = ActiveForm::begin([
        'id' => 'createTicketForm'
    ]); ?>

    <?= $form->errorSummary($model); ?>
    <div class="form-row">
        <?= $form->field($model, 'topic_id', [
            'options' => [
                'class' => ['form-group', 'col-12', 'col-sm-6', $isAgent ? 'col-lg-4' : '']
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
                'class' => ['form-group', 'col-12', 'col-sm-6', $isAgent ? 'col-lg-4' : '']
            ]
        ])->widget(Select2::class, [
            'data' => $priorities,
            'theme' => Select2::THEME_KRAJEE_BS4,
            'bsVersion' => 4,
            'pluginOptions' => [
                'allowClear' => false
            ]
        ]); ?>
        <?php if ($isAgent): ?>
            <?= $form->field($model, 'created_by', [
                'options' => [
                    'class' => ['form-group', 'col-12', 'col-sm-6', $isAgent ? 'col-lg-4' : '']
                ]
            ])->widget(Select2::class, [
                'data' => $users,
                'theme' => Select2::THEME_KRAJEE_BS4,
                'bsVersion' => 4,
                'pluginOptions' => [
                    'allowClear' => false
                ]
            ]); ?>
        <?php endif; ?>
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
        <div class="col-12 form-group d-flex align-items-center">
            <?= Html::submitButton(FAS::i('save') . ' ' . Yii::t('simialbi/ticket', 'Create ticket'), [
                'class' => ['btn', 'btn-primary', 'btn-sm']
            ]); ?>
            <a href="javascript:;" id="file-upload" class="ml-3 btn btn-outline-secondary btn-sm">
                <?= FAS::i('paperclip'); ?>
            </a>
        </div>
    </div>
    <div class="form-row" id="file-placeholder"></div>
    <?php ActiveForm::end(); ?>
</div>

<?= $this->render('/attachment/_resumable', [
    'filePlaceholder' => 'file-placeholder',
    'browseButton' => 'file-upload'
]); ?>