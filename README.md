КОД НАХОДИТСЯ В
------------

TwitterController

ЗАМЕЧАНИЯ
------------

Т.к в feed нет параметра user, то в sha1 просто sha1(id)

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

#### ElonMusk[ADD] https://kriminalmykriminal.000webhostapp.com/web/twitter/add?id=WBYX1TLPRWJ7NSV36LCPP2OZFH6AE6LM&user=elonmusk&secret=3DFB3E37B62F0F13CECA0DFA87A860B007A29E73

#### TheLewisBlack[ADD] https://kriminalmykriminal.000webhostapp.com/web/twitter/add?id=WBYX1TLPRWJ7NSV36LCPP2OZFH6AE6LM&user=TheLewisBlack&secret=2624F054B4498C5C778FF5F2B9C16DD975F92205

#### [FEED] https://kriminalmykriminal.000webhostapp.com/web/twitter/feed?id=WBYX1TLPRWJ7NSV36LCPP2OZFH6AE6LM&secret=8500CD0D00463337BBD0908F6569F766AE54218C

#### ElonMusk[REMOVE] https://kriminalmykriminal.000webhostapp.com/web/twitter/remove?id=WBYX1TLPRWJ7NSV36LCPP2OZFH6AE6LM&user=elonmusk&secret=3DFB3E37B62F0F13CECA0DFA87A860B007A29E73id=WBYX1TLPRWJ7NSV36LCPP2OZFH6AE6LM
#### ThelewisBlack[REMOVE] https://kriminalmykriminal.000webhostapp.com/web/twitter/remove?id=WBYX1TLPRWJ7NSV36LCPP2OZFH6AE6LM&user=TheLewisBlack&secret=2624F054B4498C5C778FF5F2B9C16DD975F92205
