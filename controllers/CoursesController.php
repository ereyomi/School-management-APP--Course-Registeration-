<?php

namespace app\controllers;

use Yii;
use app\models\Courses;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Faculties;
use app\models\Departments;
use app\models\levels;
use app\models\Students;
use app\models\Registration;

use yii\data\Pagination;
/**
 * CoursesController implements the CRUD actions for Courses model.
 */
class CoursesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Courses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Courses::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Courses model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Courses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Courses();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        }


        $faculty = new Faculties();
        $dept = new Departments();
        $level = new Levels();


        return $this->render('create', [
            'model' => $model,
            'faculty' => $faculty,
            'dept' => $dept,
            'level' => $level,
        ]);
    }

    /**
     * Updates an existing Courses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Courses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Courses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Courses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Courses::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionReg()
    {

        $query = Registration::find()->where(['student_id' => Yii::$app->user->id]);
        $Switch = false;

        if($query->count()){

            $Switch = true;

            $registration = $query->one();
            $convertToArray = explode(',', $registration->courses);
            $EditRegisterCourse = new Registration();
            $courses = Courses::findAll($convertToArray);
            $student = Students::find()->where(['user_id' => Yii::$app->user->id])->one();
            $coursesEdit = Courses::find()->asArray()->select(['name', 'id'])->indexBy('id')
            ->where(['department_id' => $student->department_id, 'level_id' => $student->level_id])->column();



            return $this->render('reg', [
                'Switch' => $Switch,
                'registration' => $registration,
                'courses' => $courses,
                'EditRegisterCourse' => $EditRegisterCourse,
                'coursesEdit' => $coursesEdit,
            ]);

        }else{

            $Switch = false;

            $registerCourse = new Registration();
            $student = Students::find()->where(['user_id' => Yii::$app->user->id])->one();
            $courses = Courses::find()->asArray()->select(['name', 'id'])->indexBy('id')
            ->where(['department_id' => $student->department_id, 'level_id' => $student->level_id])->column();




             if (Yii::$app->request->post('Registration')['courses']) {

                $convertToString = implode(',', Yii::$app->request->post('Registration')['courses']);
                $registerCourse->courses = $convertToString;

                $registerCourse->student_id = Yii::$app->user->id;
                $registerCourse->level_id = $student->level_id;
                $registerCourse->status = Registration::PENDING;


                if($registerCourse->validate()) {
                   $registerCourse->save();
                    Yii::$app->session->setFlash("success", "Registration successful. check you registration status after 24hrs");
                    return $this->redirect(['students/homepage']);
                }

            }

            return $this->render('reg', [
                'Switch' => $Switch,
                'registerCourse' => $registerCourse,
                'courses' => $courses,
            ]);
        }

    }

    public function actionRegupdate($id)
    {
        $registration = Registration::findOne($id);
        if(!empty(Yii::$app->request->post('Registration')['courses'])) {
            $convertToString = implode(',', Yii::$app->request->post('Registration')['courses']);
            $registration->courses = $convertToString;
            $registration->status = Registration::PENDING;
        }
        if($registration->validate()) {
            $registration->save();
            Yii::$app->session->setFlash("success", "Registration updated");
            return $this->redirect(['students/homepage']);
        }
        Yii::$app->session->setFlash("error", "Problem updating registration");
        return $this->redirect(['students/homepage']);
    }

    public function actionStatus_update() {
        $query = Registration::find();


        $pagination = new Pagination([
                'defaultPageSize' => 10,
                'totalCount' => $query->count(),
        ]);

        $registration = $query->orderBy('id DESC')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();


        return $this->render('statusUpdate', [
            'registration' => $registration,
            'pagination' => $pagination,
        ]);
    }

    public function actionApprove_course($id) {
        $query = Registration::find()->where(['id' => $id])->one();

         if(!empty($query)){

            $query->status = Registration::APPROVED;


            $query->save();
            Yii::$app->getSession()->setFlash('success', 'You have approved '.$query->user->fullname.' Course registeration');
            return $this->redirect('index.php?r=courses/status_update');
         }else{
            Yii::$app->getSession()->setFlash('error', 'An error occur');
            return $this->redirect('index.php?r=courses/status_update');
        }

     }

    public function actionReject_course($id)
     {
        $query = Registration::find()->where(['id' => $id])->one();

         if(!empty($query)){

             $query->status = Registration::REJECTED;


            $query->save();
            Yii::$app->getSession()->setFlash('success', 'You reject '.$query->user->fullname.' Course registeration');
            return $this->redirect('index.php?r=courses/status_update');
         }else{
            Yii::$app->getSession()->setFlash('error', 'An error occur');
            return $this->redirect('index.php?r=courses/status_update');
        }

     }

     public function actionView_course($id)
    {
      $query = Registration::find()->where(['student_id' => $id]);

          $registration = $query->one();
          $convertToArray = explode(',', $registration->courses);
          $courses = Courses::findAll($convertToArray);


          return $this->render('view_course_by_student', [
              'registration' => $registration,
              'courses' => $courses,
          ]);
    }


}
