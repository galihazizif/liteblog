<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Artikel;
use yii\data\Pagination;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'transparent' => true,
            ],
        ];
    }

    public function actionIndex($cat = null)
    {
        $request = Yii::$app->request;

        $qArtikels = Artikel::find();
        $qArtikels->andFilterWhere(['LIKE','artikel.content',$request->get('q')]);
        $qArtikels->orFilterWhere(['LIKE','artikel.title',$request->get('q')]);
        
        if(!empty($cat)){
            $qArtikels->where(['category' => $cat])->limit(5)->orderBy('id DESC');
        }

        $count = $qArtikels->count();

        $pages = new Pagination(['totalCount' => $count,'pageSize' => 5]);
        $qArtikels->offset($pages->offset)->limit($pages->limit);

        return $this->render('index',compact('qArtikels','pages'));
    }

    public function actionView($id){
        $this->layout = 'view';
        $artikel = Artikel::findOne($id);
        if(empty($artikel))
            throw new \yii\web\NotFoundHttpException('Post not found');
        return $this->render('view',compact('artikel'));
    }

     public function actionMail(){
        return $this->renderPartial('mail',compact('artikel'));
    }

    public function actionLogin()
    {
        $this->layout = 'login';
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['/artikel/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/artikel/index']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
