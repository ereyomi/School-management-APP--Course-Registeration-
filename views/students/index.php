<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Students';

print '<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/index.php?r=admin">Admin panel</a></li>
    <li class="breadcrumb-item active" aria-current="page">Students</li>
  </ol>
</nav>';

?>
<div class="students-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a('Create Students', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    

    <?php if(!empty($students)) : ?>
<div class="table-responsive">
<table class="table">
            <thead class="thead-dark">
            <tr>
            <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Faculty</th>
              <th scope="col">Department</th>
              <th scope="col">Level</th>
               <th scope="col">created</th>
            </tr>
            </thead>
       
	<?php foreach($students as $student) : ?>
        <tr>
            <th scope="row"><?= $student->id; ?></th>
            <td><?= $student->user->fullname ?></td>
            <td><?= $student->faculty->name?></td>
            <td><?= $student->department->name ?></td>
            <td><?= $student->level->name ?></td>
            <td><?= $student->created_at; ?></td>
            <td>
                <span class="pull-right">
                    <a class="btn btn-default" href="index.php?r=students/update&id=<?= $student->id ?>">update</a>
                    <a class="btn btn-danger" href="index.php?r=students/delete&id=<?= $student->id ?>">delete</a>
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
