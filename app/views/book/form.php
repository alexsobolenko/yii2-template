<?php

use app\models\Author;
use app\models\Book;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\web\View;

/** @var View $this */
/** @var Book $book */
/** @var string $title */
/** @var Author[] $authors */

$this->title = 'Create Book';
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-create">
    <div class="nav justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="book-form">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($book, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($book, 'author_id')->dropDownList($authors, ['prompt' => 'Select Author']) ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Back', Url::to(['book']), ['class' => 'btn btn-secondary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
