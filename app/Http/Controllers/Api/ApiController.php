<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{

    public $success = true;
    public $code = null;
    public $msg = null;
    public $errors = null;


    public function showAll($resource, $data = [])
    {
        $this->success = false;
        $this->code = 404;

        if (is_object($resource) && $resource->count() > 0) {
            $this->code = 200;
            $this->success = true;
        } else {
            $this->msg = 'List Error.';
        }

        return $this->apiResponse($resource, $data);
    }


    public function showOne($resource, $data = [])
    {
        $this->success = false;
        $this->code = 404;

        if (is_object($resource) && $resource->count() == 1) {
            $this->code = 200;
            $this->success = true;
        } else {
            $this->msg = 'Detail Error.';
        }

        return $this->apiResponse($resource, $data);
    }

    public function createAt()
    {

    }

    public function updateAt()
    {

    }

    public function deleteAt()
    {

    }

    public function apiResponse($resource, $data = [])
    {
        if (isset($data['code']))
            $this->code = $data['code'];

        if (isset($data['msg']))
            $this->msg = $data['msg'];

        if (isset($data['errors']))
            $this->errors = $data['errors'];

        $respond = (object)[];
        $respond->success = $this->success;
        $respond->code = $this->code;

        if ($this->msg != null)
            $respond->msg = $this->msg;

        $respond->time = time();
        $respond->errors = $this->errors;

        if (is_object($resource) && $resource->count() > 0)
            $respond->result = $resource;

        return response()->json($respond, ($this->code != null) ? $this->code : 200);
    }
}
