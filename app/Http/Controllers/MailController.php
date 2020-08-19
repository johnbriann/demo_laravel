<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
// Validator
use Illuminate\Support\Facades\Validator;

// DB Query builder
use Illuminate\Support\Facades\DB;

class MailController extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 401;

    public function sendEmail(Request $request){
        $validator = Validator::make($request->all(), [ 
            'body' => 'required',
            'emails' => 'required',
            'lead_id' => 'required'
        ]);
		if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();

        $details = [
            'body'=>$input['body']
        ];
        $emails = explode(",",$input['emails']);
        foreach ($emails as $key => $to) {
            Mail::to($to)->send(new \App\Mail\LeadsMail($details));
        }

        DB::table('leads_emails')->insert(['le_lead_id'=>$input['lead_id'],'le_body'=>$input['body'],'le_created'=>date('Y-m-d H:i:s')]);
        return response()->json(['success' => "Successfully Sent."], $this->successStatus);
    }

    public function getEmails($id){
    	if (!empty($id)) {
    		$emails = DB::table('leads_emails')->where('le_lead_id','=',$id)->orderBy('le_id', 'DESC')->get();
    		return response()->json(['success' => $emails], $this->successStatus);
    	}else{
    		return response()->json(['error' => "lead ID is missing!"], $this->errorStatus);
    	}
    }
}
