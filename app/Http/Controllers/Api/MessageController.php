<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{

    // private $validations = [
    //     'sender_email' => 'required|email|min:5|max:255',
    //     'sender_name' => 'min:3|max:255',
    //     'content' => 'required|string',
    //     'apartment_id'  => 'required',
    // ];

    public function store(Request $request)
    {

        $data = $request->validate([
            'sender_email' => 'required|email|min:5|max:255',
            'sender_name' => 'required|min:3|max:255',
            'object' => 'nullable',
            'content' => 'required|string',
            'apartment_id'  => 'required',
        ]);


        $newMessage = new Message();
        $newMessage->sender_email = $data['sender_email'];
        $newMessage->sender_name = $data['sender_name'];
        $newMessage->object = $data['object'];
        $newMessage->content = $data['content'];
        $newMessage->apartment_id = $data['apartment_id'];
        $newMessage->save();

        return response()->json([
            "success" => true,
            "message" => $data
        ]);
    }

    public function index()
    {
        $message = Message::all();
        return response()->json($message);
    }
}