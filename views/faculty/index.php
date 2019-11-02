<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Faculties';
print '<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/index.php?r=admin">Admin panel</a></li>
    <li class="breadcrumb-item"><a href="/index.php?r=faculty">Faculties</a></li>
  </ol>
</nav>';
?>
<div class="faculties-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <span>
        <?= Html::a('Create Faculties', ['create'], ['class' => 'btn btn-success']) ?>
    </span>

     <span class="pull-right">
        <?= Html::a('Departments', ['departments/index'], ['class' => 'btn btn-info']) ?>
    
    
        <?= Html::a('Levels', ['levels/index'], ['class' => 'btn btn-warning']) ?>
    </span>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
