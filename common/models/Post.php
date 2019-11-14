<?

namespace common\models;

use yii\mongodb\ActiveRecord;
use DateTime;


class Post extends ActiveRecord
{
    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName()
    {
        return 'posts';
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes()
    {
        return [
            '_id',
            'placeSlug',
            'userSlug',
            'citySlug',
            'placeId',
            'userId',
            'type',
            'text',
            'rating',
            'imageSets',
            'galleries',
            'comments',
            'commentCount',
            'likes',
            'hasOutletLike',
            'likeCount',
            'status',
            'isEdited',
            'createdAt'
        ];
    }

    public function getPlace()
    {
        return $this->hasOne(Place::className(), ['_id' => 'placeId']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['_id' => 'userId']);
    }

    public function getOrganization()
    {
        return $this->hasOne(User::className(), ['_id' => 'userId']);
    }

    public function getUsersPosts($userId, $limit = 0, $offset = 0)
    {
        $posts = self::find()
            ->where(['status' => 'published'])
            ->andWhere(['userId' => $userId])
            ->offset($offset)
            ->limit($limit)
            ->all();

        return $posts;

    }

    public function formatUsersPostsForApi($posts)
    {
        $result = [];
        $now = new DateTime('now');

        foreach ($posts as $post) {
            $timePassed = $now->getTimestamp() - $post->createdAt;
            $resultPost = [
                'id' => (string)$post->_id,
                'user' => $post->getUser()->select(['_id', 'firstName', 'secondName'])->one(),
                'place' => $post->getPlace()->select(['_id', 'name', 'city', 'street', 'category'])->one(),
                'text' => $post->text,
                'timePassed' => $timePassed
            ];

            $result[] = $resultPost;
        }

        return $result;
    }
}