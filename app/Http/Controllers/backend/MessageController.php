<?php

namespace App\Http\Controllers\backend;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\backend\SMSController;

class MessageController extends Controller
{
    protected $smsController;

    public function __construct(SMSController $smsController)
    {
        $this->smsController = $smsController;
    }
    public function index(){
        $messages=Message::latest()->get();
        return view('backend.message.index',compact('messages'));
    }
    public function store(Request $request){
   
        $request->validate([
            'phone' => 'required|digits:11',
            'message' => 'required|max:800'
        ]);
        try {
            $phoneWithPrefix = '88' . $request->phone;
            $this->smsController->sendSMS($phoneWithPrefix, $request->message);
            $message = new Message();
            $message->phone = $request->phone;
            $message->message = $request->message;
            $message->save();
            return redirect()->back()->with('success', 'Message Send Successfully');
        } catch (Exception $e) {
            return back()->with('error', 'Something went to Wrong');
        }
    }
}
