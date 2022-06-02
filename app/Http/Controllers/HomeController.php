<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Connection;
use App\Models\Requests;
use App\Models\Suggestion;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $userID = Auth::user()->id; 

        
        $sentData = Requests::where('from_id', $userID )->get('to_id');
        $requestsData = Requests::where('to_id', $userID)->get('from_id')->toArray();
        $connectionData = Connection::orWhere('from_id', $userID)->orWhere('to_id', $userID)->get('to_id')->toArray();

        $suggestionData = User::where("id" ,'!=', $userID)
        ->whereNotIn('id', $sentData)
        ->whereNotIn('id', $requestsData)
        ->whereNotIn('id', $connectionData)
        ->count();  
        
        $sentData = count($sentData);
        $requestsData = count($requestsData);
        $connectionData = count($connectionData);
        
        return view('home', compact('suggestionData','connectionData','requestsData','sentData'));
    }
   
    
}
