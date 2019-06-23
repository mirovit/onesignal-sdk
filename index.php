<?php

require 'vendor/autoload.php';


//var_dump(
//    $response = $oneSignal->players()->get($playerId, ['app_id' => $appId]),
////    $response->get('tags'),
//    $response->tags
//);

//var_dump(
//  $response = $oneSignal->players()->update(['id' => $playerId, 'app_id' => $appId, 'tags' => [
//      "УС"=> "true",
//        "user_id"=> "1"
//  ]]),
//    $response->get('success'),
//    $response->isSuccessful()
//);

var_dump(
    $oneSignal->notifications()->create([
        'app_id'   => $appId,
        'filters'  => (new \Mirovit\OneSignal\Filters())
            ->tag('asd', 'true')
            ->orWhere()
            ->tag('user_id', '1')
            ->country('bg'),
        'contents' => [
            'en' => 'тест',
        ],
    ])
);