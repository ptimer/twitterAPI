<?php

namespace app\controllers;
use Abraham\TwitterOAuth\TwitterOAuth;
use yii\rest\Controller;
use app\models\Users;
use Yii;

//class TwitterController extends \yii\rest\Controller

class TwitterController extends Controller
{

    public function actionAdd($id, $user, $secret)
    {

    	// TO JSON 

    	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    	// CHECK ID AND SECRET SHA1

        if(sha1($id.$user) != strtolower($secret)){
        	return array('error'=> 'access denied');
        }

        // ADD NEW USER

        	// TO AVOID DUPLICATES

        $model = Users::find()
        	->where(['name' => $user])
        	->one();

		if($model){
			return;
		}

			// SAVE

		$model = new Users();
    	$model->name = $user;
    	
    	if($model->save()){
    		\Yii::$app->response->statusCode = 200;

    		return;
    	}
         
    }

    public function actionFeed($id, $secret)
    {
    	// TO JSON 

    	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    	// CHECK ID AND SECRET SHA1

        if(sha1($id) != strtolower($secret)){
        	return array('error'=> 'access denied');
        }

    	/*
         Twitter API connection
    	 $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_token_secret);
    	*/

    	$connection = new TwitterOAuth('/', '/', '2900827148-/', '/');


    	// List of users
    	$users = Users::find()->all();




    	// creation of feed array for furhter filling inside of foreach
    	$feed = ['feed' => []];

    	foreach($users as $user){
    		// getting all tweets particular user has (without retweets)
    		$tweets = $connection->get("statuses/user_timeline", ["exclude_replies" => true, "screen_name" => $user->name, "count" => 1000, "include_rts" => false]);

    		foreach($tweets as $tweet){

    			// hashtags filtering in order to get rid of another keys

    			$hashtags = array_map(function($key){
    				return "$key->text";
    			}, $tweet->entities->hashtags);

    			array_push($feed['feed'], [
    				'user' => $tweet->user->screen_name,
    				'tweet' => $tweet->text,
    				'hashtag' => $hashtags,
    			]);
    		}
    	}

    	return $feed;
    }


    public function actionRemove($id, $user, $secret)
    {
    	// TO JSON 

    	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    	// CHECK ID AND SECRET SHA1

        if(sha1($id.$user) != strtolower($secret)){
        	return array('error'=> 'access denied');
        }

        $model = Users::find()
        	->where(['name' => $user])
        	->one()
        	->delete();
    }

}
