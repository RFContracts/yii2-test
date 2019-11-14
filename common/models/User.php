<?

namespace common\models;

use yii\mongodb\ActiveRecord;
use api\modules\v1\models\Place;

class User extends ActiveRecord
{
    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName()
    {
        return 'users';
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes()
    {
        return [
            '_id',
            'slug',
            'phone',
            'password',
            'restorePassword',
            'firstName',
            'secondName',
            'avatar',
            'city',
            'about',
            'link',
            'followerCount',
            'followers',
            'status',
        ];
    }

}