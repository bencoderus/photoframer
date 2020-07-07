<?php
/**
 * Project: Photo Framer v1.0
 * Author: Benjamin Iduwe
 * Date: June 2020
 */


namespace app\Traits;

trait Response
{
    public function okResponse($msg, $data = null)
    {
        $status = true;
        $response = ($data) ? ['status'=>$status, 'message'=>$msg, 'data'=>$data] : ['status'=>$status, 'message'=>$msg];
        return $this->send($response);
    }

    public function errorResponse($msg, $data = null)
    {
        $status = false;
        $response = ($data) ? ['status'=>$status, 'message'=>$msg, 'data'=>$data] : ['status'=>$status, 'message'=>$msg];
        return $this->send($response);
    }

    public function send($data)
    {
        $response = json_encode($data);
        return $response;
    }
}
