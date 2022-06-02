<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Requests;
use App\Models\Connection;
use Auth;

class ConnectionsController extends Controller
{
    /**
     * Get all connection
     */
    public function get()
    {
        $userID = Auth::user()->id; 
        
        $connectionData = Connection::orWhere('from_id', '=', $userID)
            ->orWhere('to_id', '=', $userID)
            ->paginate(10);

        return response()->json([
        'html' => view('components/connection', compact('connectionData'))->render()
        ]); 
    }

    /**
     * Remove a connection
     */
    public function remove($id)
    {
        $requestsData = Connection::find($id)->delete();
        return response()->json([
            'html' => 'success'
        ]); 
    }
    /**
     * common a connection
     */
    // public function common($id)
    // {
    //     $userID = Auth::user()->id;
    //      $common = Connection::where('from_id', $userID)->get('to_id');
    //         return response()->json([
    //         'html' => view('components/connection_in_common', compact('common'))->render()
    //     ]);
    // }
}
