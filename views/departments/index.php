<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departments';
print '<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/index.php?r=admin">Admin panel</a></li>
    <li class="breadcrumb-item"><a href="/index.php?r=faculty">Faculties</a></li>
    <li class="breadcrumb-item active" aria-current="page">'.$this->title.'</li>
  </ol>
</nav>';
?>
<div class="departments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Departments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>




     <!--GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'faculty_id',
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); -->

    <?php if(!empty($depts)) : ?>
<div class="table-responsive">
<table class="table">
            <thead class="thead-dark">
            <tr>
            <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Faculty</th>
               <th scope="col">created</th>
            </tr>
            </thead>
       
	<?php foreach($depts as $dept) : ?>
        <tr>
            <th scope="row"><?= $dept->id; ?></th>
            <td><?= $dept->name; ?></td>
            <td><?= $dept->faculty->name; ?></td>
            <td><?= $dept->created_at; ?></td>
            <td>
                <span class="pull-right">
                    <a class="btn btn-default" href="index.php?r=departments/update&id=<?= $dept->id ?>">update</a>
                    <a class="btn btn-danger" href="index.php?r=departments/delete&id=<?= $dept->id ?>">delete</a>
                </span>
            </td>
            </tr>


		
	<?php  endforeach; ?>

 </table>
</div>
<?php else: ?>

<p>No date</p>


<?php endif; ?>
<?= LinkPager::widget(['pagination'=>$pagination]);?>



</div>
