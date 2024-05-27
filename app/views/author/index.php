<?php

use yii\bootstrap5\Html;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Url;
use yii\web\View;

/** @var View $this */
/** @var ActiveDataProvider $data_provider */

$this->title = 'All authors';

?>

<div>
    <div class="nav justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
        <ul class="nav" style="line-height: 42px;">
            <li class="nav-item">
                <a class="nav-link" href="<?= Url::to(['author/create']) ?>">Add author</a>
            </li>
        </ul>
    </div>
    <div>
        <?= GridView::widget([
            'dataProvider' => $data_provider,
            'columns' => [
                ['class' => SerialColumn::class],
                'id',
                'name',
                [
                    'attribute' => 'books_count',
                    'value' => fn ($model) => $model->booksCount(),
                ],
                [
                    'class' => ActionColumn::class,
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => fn($url, $model, $key) => Html::a(
                            'Update',
                            Url::to(['author/update', 'id' => $model->id]),
                            ['class' => 'btn btn-warning']
                        ),
                        'delete' => fn($url, $model, $key) => Html::a(
                            'Delete',
                            Url::to(['author/delete', 'id' => $model->id]),
                            [
                                'class' => 'btn btn-danger',
                                'data' => ['confirm' => 'Are you sure you want to delete this item?', 'method' => 'post'],
                            ]
                        ),
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>
