<?php

/* @var $this yii\web\View */
use app\models\User;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>School Management App</h1>

   
        <p class="lead"><?="Welcome     " . Yii::$app->user->identity->fullname; ?></p>
        <?php if(!($students->where(['user_id' => Yii::$app->user->identity->id])->one())) : ?>
            <p><a class="btn btn-lg btn-success" href="/index.php?r=students/create">Register as a student</a> </p>
        
        <?php else: ?>
            <?php if(!($registration->where(['student_id' => Yii::$app->user->identity->id])->one())) : ?>
                <p><a class="btn btn-lg btn-warning" href="/index.php?r=courses/reg">Register course</a></p>
                <?php else: ?>
                <p><a class="btn btn-lg btn-info" href="/index.php?r=courses/reg">View Registered course </a></p>
             <?php endif ?>
        <?php endif ?>
    </div>

   
</div>
