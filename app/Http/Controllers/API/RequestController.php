<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Requests;
use App\Http\Controllers\API\BaseController as BaseController;

class RequestController extends BaseController
{
    public function get()
    {
         $requestsData=Requests::get();
        return $this->sendResponse($requestsData, 'Show All Data.');
    }
    public function withdraw()
    {
     
        $requestsData=Requests::get();
        return $this->sendResponse($requestsData, 'Show All Data.');
    }
}
