<?php

use panix\engine\grid\GridView;
use panix\engine\widgets\Pjax;
use panix\engine\Html;

Pjax::begin([
    'dataProvider' => $dataProvider,
    'options' => ['id' => 'pjax-grid-subscribers0']
]);

echo GridView::widget([
    'tableOptions' => ['class' => 'table table-striped'],
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'layoutOptions' => ['title' => $this->context->pageName],
    'columns' => [
        [
            'class' => 'panix\engine\grid\columns\CheckboxColumn',
        ],
        [
            'attribute' => 'email',
            'format' => 'raw',
            'contentOptions' => ['class' => 'text-left'],
            'value' => function ($model) {
                $name = '';
                if ($model->name) {
                    $name .= ' <span class="text-muted">(' . $model->name . ')</span>';
                }
                return Html::mailto($model->email) . '' . $name;
            }
        ],
        [
            'attribute' => 'created_at',
            'class' => 'panix\engine\grid\columns\jui\DatepickerColumn',
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'class' => 'panix\engine\grid\columns\ActionColumn',
            'template' => '{update} {switch} {delete}',
        ]
    ]
]);
Pjax::end();