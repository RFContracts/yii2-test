<?php
namespace api\modules\v1\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\rest\ActiveController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends ActiveController
{

    public $modelClass = 'api\modules\v1\models\Post';
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            [
                'class' => \yii\filters\ContentNegotiator::className(),
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
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
        return "Welcome";
    }


    public function actionError() {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception instanceof \yii\web\NotFoundHttpException) {
            $response =  Yii::$app->responseFormatter->formatResponse("UrlNotFound", "URL не найден");
            return $response;
        }
        if ($exception instanceof \yii\web\ServerErrorHttpException) {
            $response =  Yii::$app->responseFormatter->formatResponse("GeneralInternalError", "Произошла ошибка");
            return $response;
        }
        else {
            $response =  Yii::$app->responseFormatter->formatResponse("UnknownError", "Неизвестная ошибка");
            return $response;
        }
    }
}
