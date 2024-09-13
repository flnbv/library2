<?php

namespace common\components;

use Yii;
use yii\base\Component;

class SmsPilotSmsComponent extends Component
{
    public $apiKey;
    public $sender;

    private $apiUrl = 'https://smspilot.ru/api.php';

    public function sendSms($to, $text)
    {
        $url = $this->apiUrl
            .'?send='.urlencode($text)
            .'&to='.urlencode($to)
            .'&from='.urlencode($this->sender)
            .'&apikey='.urlencode($this->apiKey)
            .'&format=json';

        $json = file_get_contents($url);

        $response = json_decode($json);

        if (isset($response->error)) {
            Yii::error("Error sending SMS: " . $response->error->description_ru);
            return $response->error;
        } else {
            Yii::info("SMS sent successfully. Server ID: " . $response->send[0]->server_id);
            return true;
        }
    }
}
