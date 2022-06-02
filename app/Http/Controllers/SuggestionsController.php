<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Requests;
use App\Models\Connection;
use App\Models\Suggestion;
use Validator;
use Auth;

class SuggestionsController extends Controller
{
    public function get(Request $request)
    {   
        $userID = Auth::user()->id;
        $sentData = Requests::where('from_id', $userID )->get('to_id');
        $requestsData = Requests::where('to_id', $userID)->get('from_id')->toArray();
        $connectionData = Connection::where('from_id', $userID)->get('to_id')->toArray();

        $suggestionData = User::where("id" ,'!=', $userID)
        ->whereNotIn('id', $sentData)
        ->whereNotIn('id', $requestsData)
        ->whereNotIn('id', $connectionData)
        ->paginate(10);  

              return response()->json([
            'html' => view('components/suggestion', compact('suggestionData'))->render()
        ]);
        
    }
    // connect function-----------------------
    public function connect($id)
    {
        
        $userID = Auth::user()->id;
        $suggestionData = [];
        $suggestionData['to_id']=$id;
        $suggestionData['from_id']=$userID;
        $suggestionData['status']='0';
        $suggestionData =  Requests::create($suggestionData);
    
        return response()->json([
            'html' => 'Success'
        ]);
    }
}
