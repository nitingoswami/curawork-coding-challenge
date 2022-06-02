<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Requests;
use App\Models\Connection;
use Auth;

class RequestController extends Controller
{
    // get Requests data----------------------
    public function get()
    {  
        $userID = Auth::user()->id; 
        $requestsData = Requests::where('from_id', $userID)
            ->with('sentUser')
            ->paginate(10);       
        $mode = 'sent';
         return response()->json([
            'html' => view('components/request', compact('requestsData', 'mode'))->render()
         ]); 
         
    }
// get Recived  data----------------------
    public function requested()
    {  
        $userID = Auth::user()->id; 
       
        $requestsData = Requests::where('to_id', $userID)
            ->with('recivedUser')
            ->paginate(10);
        $mode = '';
         return response()->json([
            'html' => view('components/request', compact('requestsData', 'mode'))->render()
         ]); 
    } 

    public function withdraw($id)
    {
        
        $requestsData = Requests::find($id)->delete();
        return response()->json([
            'html' => 'success'
         ]); 
    }


    public function accept($id){
       
        $requestsData = Requests::find($id);
       
        $userID = Auth::user()->id;
        
        $suggestionData = [];
        $suggestionData['to_id']= $requestsData['from_id'];
        $suggestionData['from_id']=$userID;
        $suggestionData['status']='0';
        $suggestionData =  Connection::create($suggestionData);
       
        $requestsData->delete();
         
        return response()->json([
            'html' => 'success'
         ]); 
         
    }
}
