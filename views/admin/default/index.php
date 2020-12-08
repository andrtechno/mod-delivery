<?php

use panix\engine\grid\GridView;
use panix\engine\widgets\Pjax;


Pjax::begin([
    'dataProvider'=>$dataProvider
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
           // 'format' => 'datetime',
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