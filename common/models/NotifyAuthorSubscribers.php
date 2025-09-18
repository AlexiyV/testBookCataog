<?php

namespace common\models;

use yii\helpers\ArrayHelper;

class NotifyAuthorSubscribers
{
    private const API_KEY = 'TEST';
    private const SENDER = 'TEST';
    public static function notify($authors)
    {
        $authorIds = ArrayHelper::getColumn($authors, 'id');
        $subscribers = Subscribe::find()
            ->where(['id_author' => $authorIds])
            ->all();

        foreach ($subscribers as $subscriber) {
            self::sendNotification($subscriber);
        }
    }

    public static function sendNotification($subscriber)
    {
        /* @var Subscribe $subscriber */
        $phone = $subscriber->phone;
        $text = "Уважаемый {$subscriber->name}, вышла новая книга автора {$subscriber->author->fio}";

        $url = 'https://smspilot.ru/api.php'
            .'?send='.urlencode( $text )
            .'&to='.urlencode( $phone )
            .'&from='.self::SENDER
            .'&apikey='.self::API_KEY
            .'&format=json';

        $curl = curl_init($url);

        $response = curl_exec($curl);

        curl_close($curl);
    }
}