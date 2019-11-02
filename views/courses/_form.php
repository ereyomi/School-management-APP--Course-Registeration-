<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;

use app\models\Faculties;
use app\models\Departments;
use app\models\levels;

/* @var $this yii\web\View */
/* @var $model app\models\Courses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="courses-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'course_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit')->textInput() ?>

    <?= $form->field($model, 'faculty_id')->dropdownlist(
            ArrayHelper::map(Faculties::find()->all(), 'id', 'name'),
            [
                'prompt' => 'Select Faculty',

                'onchange' => '
                 $( "#students-departments_id" ).html(" ");
                        $( "#students-departments_id" ).html("<option>Select Department</option>");

                $.post( "index.php?r=students/dept&id='.'"+$(this).val(), function( data ){

                                       $( "#courses-department_id" ).html( data );

                });'

            ]

        );?>

    <?= $form->field($model, 'department_id')->dropdownlist(
            [
                'prompt' => 'Select Department',
            ]

        ); ?>

    <?= $form->field($model, 'level_id')->dropdownlist(
        ArrayHelper::map(Levels::find()->all(), 'id', 'name'),
        [
        'prompt' => 'Select Level',
        ]
    );?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
