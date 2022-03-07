<?php

namespace App\Http\Controllers;

use App\ScheduleMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function schedule(Request $request){
        $request->validate([
            'message' => 'required',
            'mobile' => 'required',
            'count' => 'required',
        ]);
        $msg = new  ScheduleMessage;
        $msg->message = request()->message;
        $msg->mobile = request()->mobile;
        $msg->count = request()->count;
        if($msg->save()){
            return response()->json(['success'=>'Message has been scheduled'],200);
        }else{
            return response()->json(['error'=>'Something Went Wrong'],404);
        }
    }
    public function decreaseCount(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $msg = ScheduleMessage::findOrFail(request()->id);
        $msg->count=$msg->count-1;
        if($msg->save()){
            return response()->json(['success'=>'Message count has been decreased'],200);
        }else{
            return response()->json(['error'=>'Something Went Wrong'],404);
        }

    }
}
