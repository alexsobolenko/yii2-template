<?php

use app\models\Author;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\web\View;

/** @var View $this */
/** @var Author $author */
/** @var string $title */

$this->title = $title;

?>
<div>
    <div class="nav justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div>
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($author, 'name')->textInput() ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Back', Url::to(['author']), ['class' => 'btn btn-secondary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
