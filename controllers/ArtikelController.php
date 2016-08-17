<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Artikel;
use app\models\ImagePost;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArtikelController implements the CRUD actions for Artikel model.
 */
class ArtikelController extends Controller
{

    public $layout = 'admin';
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'controllers' => ['artikel'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Artikel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Artikel::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Artikel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $qImagePost = ImagePost::find()->where(['artikel_id' => $id]);
        $dpImagePost = new ActiveDataProvider(['query' => $qImagePost,'pagination' => false]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dpImagePost' => $dpImagePost,
        ]);
    }

    /**
     * Creates a new Artikel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Artikel();

        if ($model->load(Yii::$app->request->post())) {
            $model->date = date('Y-m-d H:i:s');
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } 
        
        return $this->render('create', [
            'model' => $model,
        ]);
        
    }

    /**
     * Updates an existing Artikel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->date = date('Y-m-d H:i:s');
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        
        return $this->render('update', [
            'model' => $model,
        ]);
        
    }

    /**
     * Deletes an existing Artikel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Artikel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Artikel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Artikel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
