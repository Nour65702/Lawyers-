<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
class ChatController extends Controller
{
    public function messages(Request $request){
        $messages = Chat::where('sender_id',$request->user_id)
        ->where('reciver_id',$request->provider_id)->get();
        return response()->json([
            'details'=> $messages
        ]);
    }
    public function sendMessage(Request $request)
    {
        $data = [
            'sender_id' => $request->sender_id,
            'reciver_id'=> $request->reciver_id,
            'message'=> $request->message,
        ];
        Chat::create($data);
        return response()->json([
            'details' => 'done'
        ]);        
    }
}
