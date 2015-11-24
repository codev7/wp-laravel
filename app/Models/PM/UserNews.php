<?php

namespace CMV\Models\PM;

use Illuminate\Database\Eloquent\Model;
use App, Config, Bugsnag, Exception;
use Carbon\Carbon;
use CMV\User;

class UserNews extends Model
{
    public $table = 'user_news';

    public $fillable = [
        'user_id',
        'news_id'
    ];

    /**
     * @var array
     */
    protected static $news = [
        [
            'id' => 1,
            'title' => 'Concierge Service',
            'link' => '/wordpress-concierge',
            'text' => "<strong>Looking for ongoing support?</strong> Check out our VIP Concierge service.</p>",
            'image' => '/images/img-10.png'
        ]
    ];

    /**
     * @param User $user
     * @return mixed
     */
    public static function getNewsByUser(User $user)
    {
        $viewed = static::where('user_id', $user->id)->get()
            ->lists('news_id')->all();

        return array_reduce(static::$news, function($carry, $item) use ($viewed) {
            if (array_search($item['id'], $viewed) === false) {
                $carry[] = $item;
            }

            return $carry;
        }, []);
    }

    /**
     * @param User $user
     * @param $newsId
     */
    public static function markViewed(User $user, $newsId)
    {
        $ids = array_column(self::$news, 'id');
        if (array_search($newsId, $ids) !== false) {
            UserNews::firstOrCreate([
                'user_id' => $user->id,
                'news_id' => $newsId
            ]);
        }
    }

}
