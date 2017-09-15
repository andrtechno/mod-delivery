<?php

use yii\helpers\Html;
use panix\engine\grid\GridView;
use yii\widgets\Pjax;
?>


<?php

Pjax::begin([
    'timeout' => 50000,
    'id' => 'pjax-container',
    'enablePushState' => true,
    'linkSelector' => 'a:not(.linkTarget)'
]);
?>
<?=

GridView::widget([
    'tableOptions' => ['class' => 'table table-striped'],
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    // 'layoutOptions' => ['title' => $this->context->pageName],
    'columns' => [
        'email',
        [
            'class' => 'panix\engine\grid\columns\ActionColumn',
            'template' => '{update} {switch} {delete}',
        ]
    ]
]);
?>
<?php Pjax::end(); ?>

