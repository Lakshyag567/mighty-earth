<?php

namespace App\Http\Controllers;

use App\ScheduleMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function fetch(){
        $data = ScheduleMessage::where('date',date('Y-m-d h:i:'.'00'))->orWhere('count','>',0)->get();
        return $data;
    }
    public function schedule(Request $request){
        $request->validate([
            'message' => 'required',
            'mobile' => 'required',
            'count' => 'required',
            'date' => 'required',
        ]);
        $msg = new  ScheduleMessage;
        $msg->message = request()->message;
        $msg->mobile = request()->mobile;
        $msg->count = request()->count;
        $msg->date = request()->date;
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
