<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Request $request)
{
    $activeLink = 'messaggi';

    $user = Auth::user();
    $apartments = $user->apartments;

    $messages = Message::whereIn('apartment_id', $apartments->pluck('id'))->orderBy('created_at', 'desc')->paginate(10);

    return view('admin.messages.index', compact('messages', 'apartments', 'activeLink'));
}

}
