<?php

namespace app\controllers;

use Yii;
use app\models\students;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\data\Pagination;

use app\models\Departments;
use app\models\Faculties;
use app\models\Levels;
use app\models\Courses;
use app\models\Registration;
use yii\db\ActiveQuery;

/**
 *
 * StudentsController implements the CRUD actions for students model.
 */
class StudentsController extends Controller
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
     * Lists all students models.
     * @return mixed
     */
    public function actionIndex()
    {
       //create query
        $query = students::find();

        $pagination = new Pagination([
                'defaultPageSize' => 20,
                'totalCount' => $query->count(),
        ]);

        $students = $query->orderBy('id')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();


        //Render view
        return $this->render('index', [
            'students' => $students,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays a single students model.
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
     * Creates a new students model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new students();

        $faculty = new Faculties();
        $dept = new Departments();
        $level = new Levels();

        if ($model->load(Yii::$app->request->post())) {


            $model->user_id = Yii::$app->user->identity->id;
            $model->save();
            yii::$app->getSession()->setFlash('success', 'Sucessful');
            return $this->redirect('index.php?r=students/homepage');
        }

        if(Yii::$app->user->identity->type == User::DEFAULT){

        return $this->render('registeration', [
            'model' => $model,
            'faculty' => $faculty,
            'dept' => $dept,
            'level' => $level,

        ]);
        }else{
            return $this->render('create', [
            'model' => $model,
        ]);
        }



    }




    public function actionDept($id)
    {
        $query = Faculties::find()->where(['id' => $id]);
        $faculty = $query->one();
        if($query->count() > 0){
             foreach($faculty->departments as $dept){
               echo "<option value='".$dept->id."'>". $dept->name."</option>";

             }
        }else{
            echo "<option>--</option>";
        }
    }

    /**
     * Updates an existing students model.
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

    public function actionHomepage()
    {
        $students = students::find();
        $registration = Registration::find();
       return $this->render('homepage',
            [
                'students' => $students,
                'registration' => $registration,
            ]

        );
    }

    /**
     * Deletes an existing students model.
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
     * Finds the students model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return students the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = students::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
