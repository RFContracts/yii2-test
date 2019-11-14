<?

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\mongodb\Query;
use Yii;
use Yii\web\response;
use common\models\Post;
use yii\web\NotFoundHttpException;


class PostController extends ActiveController
{

    public function behaviors()
    {
        return [
            [
                'class' => \yii\filters\ContentNegotiator::className(),
                'only' => ['index', 'posts'],
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public $modelClass = 'common\models\Post';

    public function init()
    {
        parent::init();

    }

    public function actionPosts()
    {
        $request = Yii::$app->request;
        $userId = $request->get('userId');
        if (!$userId) {
            return $response = Yii::$app->responseFormatter->formatResponse("RecordNotFound", "Запись не найдена");
        }

        if ($request->get('offset')) {
            $offset = $request->get('offset');
        } else
            $offset = 0;

        if ($request->get('limit')) {
            $limit = $request->get('limit');
        } else
            $limit = 20;

        $model = Post::getUsersPosts($userId, $limit, $offset);

        if(!$model) {
            return $response = Yii::$app->responseFormatter->formatResponse("RecordNotFound", "Запись не найдена");
        }

        $posts = Post::formatUsersPostsforApi($model);

        return $response = Yii::$app->responseFormatter->formatResponse("успешно", "success", 'posts', $posts);
    }

}

