КОД НАХОДИТСЯ В
------------

TwitterController

**ERRORS:**

config/web -> 

```php
return 'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->statusCode == 400) {
                    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    $response->data = [
                        'error' => 'missing parameter',
                    ];
                    $response->statusCode = 400;
                }
                if ($response->statusCode == 500) {
                    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    $response->data = [
                        'error' => 'internal error',
                    ];
                    $response->statusCode = 500;
                }
            },
        ],
```

ПРОТЕСТИРОВАТЬ МОЖНО
-------
ADD

```
http://localhost/basic/web/twitter/add?id=WBYX1TLPRWJ7NSV36LCPP2OZFH6AE6LM&user=elonmusk&secret=3DFB3E37B62F0F13CECA0DFA87A860B007A29E73
```

FEED

```
http://localhost/basic/web/twitter/feed?secret=8500CD0D00463337BBD0908F6569F766AE54218C&id=WBYX1TLPRWJ7NSV36LCPP2OZFH6AE6LM
```

REMOVE

```
http://localhost/basic/web/twitter/remove?id=WBYX1TLPRWJ7NSV36LCPP2OZFH6AE6LM&user=elonmusk&secret=237609EF9EFAE336CF0FB342135626D2DC73C2ED```
