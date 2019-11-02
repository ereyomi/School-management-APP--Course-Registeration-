<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\faculties */

$this->title = 'Create Faculties';
print '<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/index.php?r=admin">Admin panel</a></li>
    <li class="breadcrumb-item"><a href="/index.php?r=faculty">Faculties</a></li>
    <li class="breadcrumb-item active" aria-current="page">'.$this->title.'</li>
  </ol>
</nav>';
?>
<div class="faculties-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
