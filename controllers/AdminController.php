<?php

namespace app\controllers;

use Yii;
use app\models\faculties;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use yii\filters\AccessControl;
/**
 * AdminController implements the CRUD actions for faculties model.
 */
class AdminController extends Controller
{
    
    public function actionIndex()
    {

        return $this->render('index');
    }

     
}
