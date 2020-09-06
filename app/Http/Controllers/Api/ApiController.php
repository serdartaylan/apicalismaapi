<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{

    public $success = true;
    public $code = null;
    public $msg = null;
    public $errors = null;

    public function showAll($resource = null, $data = [])
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

    public function showOne($resource = null, $data = [])
    {
        $this->success = false;
        $this->code = 404;

        if (is_object($resource)) {
            $this->code = 200;
            $this->success = true;

            if (isset($data['msg']))
                $this->msg = $data['msg'];

        } else {
            if (isset($data['msg']))
                $this->msg = $data['msg'];
            else
                $this->msg = 'Detail Error.';
        }

        return $this->apiResponse($resource, $data);
    }

    public function createAt($resource = null, $data = [])
    {
        $this->success = false;
        $this->code = 404;
        if (is_object($resource)) {
            $this->code = 201;
            $this->success = true;
        } else {
            $this->msg = 'create Error.';
        }

        return $this->apiResponse($resource, $data);
    }

    public function updateAt($resource = null, $data = [])
    {
        $this->success = false;
        $this->code = 404;
        if (is_object($resource)) {
            $this->code = 200;
            $this->success = true;
        } else {
            $this->msg = 'update Error.';
        }

        return $this->apiResponse($resource, $data);
    }

    public function deleteAt($resource = null, $data = [])
    {
        $this->success = false;
        $this->code = 404;
        if (is_object($resource)) {
            $this->code = 200;
            $this->success = true;
        } else {
            $this->msg = 'update Error.';
        }

        return $this->apiResponse($resource, $data);
    }

    public function validError($errors = null, $data = [])
    {
        $this->success = false;
        $this->errors = $errors;

        if (!isset($data['code']))
            $data['code'] = 422; // via:cg

        return $this->apiResponse(null, $data);
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

        if ($this->errors != null)
            $respond->errors = $this->errors;

        if (is_object($resource))
            $respond->result = $resource;

        return response()->json($respond, ($this->code != null) ? $this->code : 200);
    }
}
