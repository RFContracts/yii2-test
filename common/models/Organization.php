<?

namespace common\models;

use yii\mongodb\ActiveRecord;

class Organization extends ActiveRecord
{
    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName()
    {
        return 'organizations';
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes()
    {
        return [
            '_id',
            'slug',
            'citySlug',
            'name',
            'city',
            'category',
            'avatar',
            'placeCount',
            'status',
        ];
    }


}