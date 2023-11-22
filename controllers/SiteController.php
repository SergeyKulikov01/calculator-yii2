<?php

namespace app\controllers;

use app\models\Months;
use app\models\Prices;
use app\models\Raw_types;
use app\models\SignupForm;
use app\models\Tonnages;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\CalcForm;
use app\models\History;
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
                'only' => ['logout','users'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['users'],
                        'roles'   => ['administrator'],
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
            return $this->redirect(['site/form']);
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
            if (!Yii::$app->user->isGuest){
                $month = Months::findOne($model->month);
                $type = Raw_types::findOne($model->material);
                $tonnage = Tonnages::findOne($model->weight);
                $full_pricelist = json_encode($priceList);
                $history = new History();
                $history->historyAdd(Yii::$app->user->identity->id,$tonnage->value,$type->name,$calculation,$month->name,$full_pricelist);
            }
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
            $user = new User();
            $user->AddUser($model->name,$model->username,$hash);
            $messege = "Успешно! Теперь вы можете авторизироваться";
            return $this->redirect(array('login','status' => 'success'));
        }

        return $this->render('signup', compact('model'));
    }
    public function actionProfile()
    {
        $userId = Yii::$app->user->id;
        $user = User::findOne($userId);
        $userRole = array_values(Yii::$app->authManager->getRolesByUser($userId));
        return $this->render('profile', compact('user','userRole'));
    }
}
