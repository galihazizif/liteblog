<?php

namespace app\controllers;

use Yii;
use app\models\Document;
use app\models\Artikel;
use app\models\ImagePost;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * DocumentController implements the CRUD actions for Document model.
 */
class DocumentController extends Controller
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
                        'controllers' => ['document'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Document models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Document::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * add images to post.
     * @return mixed
     */
    public function actionAddImages($artikelid)
    {

        $artikel = Artikel::findOne($artikelid);
        if(empty($artikel))
            throw new \yii\web\NotFoundHttpException('No post found');
        $dataProvider = new ActiveDataProvider([
            'query' => Document::find(),
        ]);

        return $this->render('add-images', [
            'artikel' => $artikel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionHapusGambar($id)
    {

        $imgPost = ImagePost::findOne($id);
        if(empty($imgPost))
            throw new \yii\web\NotFoundHttpException('Image Post not found');

        $artikelId = $imgPost->artikel_id;
        $imgPost->delete();
        return $this->redirect(['/artikel/view','id' => $artikelId]);
        
    }

    public function actionPilihGambar($artikelid,$id)
    {

        $artikel = Artikel::findOne($artikelid);
        $image = $this->findModel($id);
        if(empty($artikel))
            throw new \yii\web\NotFoundHttpException('No post found');
        
        $imagePost = new ImagePost;
        $imagePost->artikel_id = $artikel->id;
        $imagePost->file_id = $image->id;
        $imagePost->height = 40;
        if(!$imagePost->save()){

        }
        
        return $this->redirect(['/artikel/view','id' => $artikel->id]);
    }


    /**
     * Displays a single Document model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Document model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Document();

        if ($model->load(Yii::$app->request->post())) {
            $uploadedFile = UploadedFile::getInstance($model,'filename');
            $model->filename = $uploadedFile;
            if($model->save()){
                $filename = $model->id.'-'.$uploadedFile->name;
                $uploadedFile->saveAs(Yii::getAlias('@app/web/upload/'.$filename));
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } 
        
        return $this->render('create', [
            'model' => $model,
        ]);
        
    }

    /**
     * Updates an existing Document model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldFilename = $model->filename;

        if ($model->load(Yii::$app->request->post())) {
            $uploadedFile = UploadedFile::getInstance($model,'filename');
            $model->filename = $uploadedFile;
            if($model->save()){

                if($oldFilename != $model->filename){
                    try{
                        $oldfilepath = Yii::getAlias('@app/web/upload/'.$model->id.'-'.$oldFilename);
                        unlink($oldfilepath);
                    }catch(\Exception $e){
                        Yii::$app->session->addFlash('error',$e->getMessage());
                    }

                    $filename = $model->id.'-'.$uploadedFile->name;
                    $uploadedFile->saveAs(Yii::getAlias('@app/web/upload/'.$filename));
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } 
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Document model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $filepath = Yii::getAlias('@app/web/upload/'.$model->id.'-'.$model->filename);
        try{
            $model->delete();
            unlink($filepath);
        }catch(\Exception $e){
            Yii::$app->session->addFlash('error','File telah dihapus, namun tidak ditemukan');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Document model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Document the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Document::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
