<?php

namespace frontend\controllers;

use frontend\models\BookForm;
use frontend\models\Books;
use frontend\models\SubscribeForm;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Books();
        return $this->render('index', [
            'books' => $model->getBooks(),
            'isGuest' => Yii::$app->user->isGuest,
        ]);
    }

    public function actionTop($year = null)
    {
        $model = new Books();
        $model->load(['year' => $year], '');
        if ($model->validate()) {
            return $this->render('top', [
                'top' => $model->getTop(),
                'year' => $model->year,
            ]);
        }
        return $this->redirect('/r=site/top');
    }

    public function actionEdit($id_book = null)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (Yii::$app->request->isPost) {
            $model = new BookForm(['scenario' => BookForm::SAVE_SCENARIO]);
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->saveBook();

                return $this->goHome();
            } else {
                return $this->render('edit', [
                    'model' => $model,
                    'authors' => $model->getAuthorsList(),
                ]);
            }
        }

        $model = new BookForm(['scenario' => BookForm::INIT_DELETE_SCENARIO]);
        $model->load(['id' => $id_book], '');
        if ($model->validate()) {
            $model->loadBook();
        } else {
            $model->id = null;
        }

        return $this->render('edit', [
            'model' => $model,
            'authors' => $model->getAuthorsList(),
        ]);
    }

    public function actionDelete($id_book = null)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if ($id_book) {
            $model = new BookForm(['scenario' => BookForm::INIT_DELETE_SCENARIO]);
            if ($model->load(['id' => $id_book], '') && $model->validate()) {
                $model->deleteBook();
            }
        }

        return $this->goHome();
    }

    public function actionSubscribe($id_author = null)
    {
        if (!$id_author) {
            return $this->goHome();
        }

        if (Yii::$app->request->isPost) {
            $model = new SubscribeForm(['scenario' => SubscribeForm::SAVE_SCENARIO]);

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->save();
                return $this->goHome();
            } else {
                return $this->render('subscribe', [
                    'model' => $model,
                ]);
            }
        }

        $model = new SubscribeForm(['scenario' => SubscribeForm::INIT_SCENARIO]);
        $model->load(['id_author' => $id_author], '');
        if (!$model->validate()) {
            return $this->goHome();
        }
        return $this->render('subscribe', [
            'model' => $model,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
