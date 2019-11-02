<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\students */

$this->title = 'Update Students: ' . $model->id;


print '<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/index.php?r=admin">Admin panel</a></li>
    <li class="breadcrumb-item"><a href="/index.php?r=students">Students</a></li>
    <li class="breadcrumb-item active" aria-current="page">update</li>
  </ol>
</nav>';
?>

<div class="students-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
