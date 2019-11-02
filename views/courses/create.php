<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Courses */

$this->title = 'Create Courses';
print '<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/index.php?r=admin">Admin panel</a></li>
    <li class="breadcrumb-item"><a href="/index.php?r=courses">Courses</a></li>
    <li class="breadcrumb-item active" aria-current="page">create</li>
  </ol>
</nav>';
?>
<div class="courses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
