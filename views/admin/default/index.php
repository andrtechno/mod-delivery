<?php

use panix\engine\grid\GridView;
use yii\widgets\Pjax;


Pjax::begin([
    'timeout' => 50000,
    'id' => 'pjax-container',
    'enablePushState' => true,
    'linkSelector' => 'a:not(.linkTarget)'
]);

echo GridView::widget([
    'tableOptions' => ['class' => 'table table-striped'],
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'layoutOptions' => ['title' => $this->context->pageName],
    'columns' => [
        'email',
        [
            'attribute' => 'name',
            'format' => 'raw',
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'created_at',
            'format' => 'datetime',
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'class' => 'panix\engine\grid\columns\ActionColumn',
            'template' => '{update} {switch} {delete}',
        ]
    ]
]);
Pjax::end();