<?php

namespace app\controllers;

use app\models\Prices;
use app\models\SignupForm;
use app\models\Users;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\CalcForm;
use yii\widgets\ActiveForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    /**
     * Displays form page.
     *
     * @return string
     */
    public function actionForm()
    {
        $model = new CalcForm();
        $basePath = __DIR__ . '/../runtime/queue.job';

        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            $text = 'material => ' . $model->material . PHP_EOL .
                'month => ' . $model->month . PHP_EOL .
                'weight => ' . $model->weight . PHP_EOL;
            file_put_contents($basePath, $text);
            $responce = new Prices();
            $otv = $responce->PriceListForm($model->month, $model->material, $model->weight);
            $priceList = $otv['price_list'];
            $calculation = $otv['price'];
            $type = $model->material;
            $month = $model->material;
            $tonnage = $model->material;
            return $this->render('form', compact('model','calculation','priceList'));
        }
        return $this->render('form', compact('model'));
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        $login_model = new LoginForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            $hash = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            $user = new Users();
            $user->AddUser($model->name,$model->email,$hash);
            $messege = "Успешно! Теперь вы можете авторизироваться" . $model->name . $model->email;
            return $this->render('login', ['model' => $login_model,'messege' => $messege]);
        }

        return $this->render('signup', compact('model'));
    }
}
