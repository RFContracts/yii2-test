<?php

namespace api\components;

use yii\base\Component;

class ResponseFormatter extends Component
{
    

    public function formatResponse($status, $message, $dataKey = '', $data = ''){
        $response = [
            "status" => $status,
            "message" => $message,
        ];

        if ($dataKey && $data) {
            $response['data'] = [$dataKey => $data];
        }

        return $response;
        }
}