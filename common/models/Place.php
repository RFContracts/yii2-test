<?

namespace common\models;

use yii\mongodb\ActiveRecord;

class Place extends ActiveRecord
{
    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName()
    {
        return 'places';
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes()
    {
        return [
            '_id',
            'slug',
            'organizationSlug',
            'organizationId',
            'citySlug',
            'name',
            'city',
            'street',
            'house',
            'category',
            'subcategory',
            'avatar',
            'logo',
            'albums',
            'menus',
            'followerCount',
            'followers',
            'status',
            'moderationStatus'
        ];
    }


}