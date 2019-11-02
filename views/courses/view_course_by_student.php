<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;

use app\models\Courses;
/* @var $this yii\web\View */
/* @var $model app\models\Registration */
/* @var $form ActiveForm */
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/index.php?r=admin">Admin panel</a></li>
    <li class="breadcrumb-item"><a href="/index.php?r=courses">Courses</a></li>
    <li class="breadcrumb-item active"><a href="/index.php?r=courses/status_update">Students Course Reg</a></li>
    <li class="breadcrumb-item active" aria-current="page">View course registeration</li>
  </ol>
</nav>
<div class="courses-reg">


 	<div class="row">
            <div class="col-md-10">
                <?php if ($registration->status == 0) :?>
                	<div class="alert alert-warning">
					  <strong>Waiting response!</strong> <a class="btn btn-success" href="index.php?r=courses/approve_course&id=<?= $registration->id ?>">Approve</a>
            <a class="btn btn-danger" href="index.php?r=courses/reject_course&id=<?= $registration->id ?>">Reject</a> You are yet to perform any action on <?= $registration->user->fullname; ?> course registeration.
					</div>


        <?php elseif($registration->status == 1): ?>
                	<div class="alert alert-info">
					  <strong>Approved!</strong> You can have approved <?= $registration->user->fullname; ?> course registration.
            <a class="btn btn-danger" href="index.php?r=courses/reject_course&id=<?= $registration->id ?>">Reject</a> if there is any mistake.
					</div>
        <?php else: ?>
        <div class="alert alert-danger">
  <strong>Rejected!</strong> You reject <?= $registration->user->fullname; ?> course registration.
  <strong>Waiting response!</strong> <a class="btn btn-success" href="index.php?r=courses/approve_course&id=<?= $registration->id ?>">Approve</a>
</div>

                <?php endif; ?>
            </div>
    </div>
    <div id="table">
	    <table class="table table-bordered table-responsive">
	                    <thead class="black white-text">
	                        <tr>
	                            <th>Course</th>
                              <th>Course code</th>
	                            <th>Credit</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<?php $totalunit = 0; ?>
	                        <?php foreach ($courses as $course):?>
	                            <?php $totalunit += (int) $course->unit ?>
	                         <tr>
	                            <th><?= $course->name ?></th>
	                            <td><?= $course->course_code ?></td>
	                            <td><?= $course->unit ?></td>

	                        </tr>
	                        <?php endforeach; ?>
	                    </tbody>
	                    <tfoot>
	                        <tr>
	                        	<td></td>
	                            <th>Total</th>
	                            <td><?= $totalunit ?></td>
	                        </tr>
	                    </tfoot>
	                </table>
	     </div>



</div><!-- courses-reg -->

<script type="text/javascript">

    const EditBox = document.querySelector('#Edit-courses'),
    EditBtn = document.querySelector('#EditBtn'),
    table = document.querySelector('#table'),
    CancleBtn = document.querySelector('#CancleBtn');

    EditBox.style.display = 'none';

    EditBtn.addEventListener('click', () => {
    	table.style.display = 'none';
    	EditBox.style.display = 'block';
    	EditBtn.style.display = 'none';
    });

    CancleBtn.addEventListener('click', () => {
    	table.style.display = 'initial';
    	EditBtn.style.display = 'block';
    	EditBox.style.display = 'none';
    });

</script>
