<?php

namespace Kizi\Core\Services\Provider;

use Illuminate\Http\Response;

class ResponseService
{
    public function send($data, $code = Response::HTTP_OK, $message = null)
    {
        $result = [
            'status'  => false,
            'message' => null,
            'errors'  => [],
        ];

        if ($code == Response::HTTP_OK) {
            $result['status'] = true;
        }

        if ($code == Response::HTTP_OK) {
            if (is_string($data)) {
                $result['message'] = $data;
            } else {
                $result['data']    = $data;
                $result['message'] = $message;
            }
            unset($result['errors']);
        } else {
            $code = empty($code) ? Response::HTTP_INTERNAL_SERVER_ERROR : $code;
            if ($data instanceof \Exception) {
                $result['message'] = $data->getMessage();
            } else {
                if (is_string($data)) {
                    $result['message'] = $data;
                } else {
                    $result['errors']  = $data;
                    $result['message'] = $message;
                }
            }
        }
        if($code != Response::HTTP_OK){
            $result['code'] = $code;
        }
        return response()->json($result, $code);
    }
}
