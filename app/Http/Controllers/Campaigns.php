<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
class Campaigns extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 200;

    public function campaignsList(){
        $user = Auth::user();
        if (!empty($user)) {
            $campaigns = DB::table('email_campaigns_list')->where('ecl_dealer_id','=',$user->dealer_id)->where('ecl_status','=',1)->get();
            return response()->json(['success'=>$campaigns], $this->successStatus);
        }else{
            return response()->json(['error'=>"Unauthenticate user."], $this->errorStatus);
        }
    }

    public function dtCampaignsList(Request $request){
        $input = $request->all();
        $user = Auth::user();
        //return $input;
        $order_columns = ['ecl_id','ecl_name','ecl_user_cate','ecl_status','ecl_created'];
        $query = DB::table('email_campaigns_list')->where('ecl_dealer_id','=',$user->dealer_id);


        if (!empty($input['search']['value'])) {
            $search_val = "%".$input["search"]["value"]."%";
            $query->where('ecl_name', 'like', $search_val);
            // $query->where(function ($query) use ($search_val) {
                
            //     $query->where('ecl_name', 'like', $search_val)
            //     ->orWhere('leads.l_customer_first_name', 'like', $search_val)
            //     ->orWhere('leads.l_customer_last_name', 'like', $search_val);
            // });
        }
        if (!empty($input['order'][0]['column']) && !empty($order_columns[$input['order'][0]['column']])) {
            $query->orderBy($order_columns[$input['order'][0]['column']],$input['order'][0]['dir']);
        }else{
            $query->orderBy('ecl_id', 'DESC');
        }

        if ($input['start'] >= 0  && $input['length'] >= 0) {
            $query->offset($input['start']);
            $query->limit($input['length']);
        }
        
        $campaigns = $query->get();
        //return response()->json(['success'=>$leads], $this->successStatus); exit;
        $data = [];
        if(!empty($campaigns) && count($campaigns) > 0){
            foreach ($campaigns as $key => $camp) {
                $output = [];
                $output[] = $key+1;
                $output[] = $camp->ecl_name;
                $output[] = $camp->ecl_user_cate;
                if($camp->ecl_status == '1'){
                    $output[] = '<a  class="assin clStatus" id="statusChange'.$camp->ecl_id.'" data-id="'.$camp->ecl_id.'" data-status="'.$camp->ecl_status.'" href="#">Active</a>';
                }else{
                    $output[] = '<a  class="btn-clr-danger clStatus" id="statusChange'.$camp->ecl_id.'" data-id="'.$camp->ecl_id.'" data-status="'.$camp->ecl_status.'" href="#">InActive</a>';
                }
                $output[] = date('m-d-Y H:i A',strtotime($camp->ecl_created));
                $data[] = $output;
            }
        }

        $outsfsput = [
            "draw"=>$input['draw'],
            'recordsTotal'=> $this->get_all_campaigns_List_count($user),
            'recordsFiltered'=> $this->get_all_campaigns_List_filter_data_count($user),
            "data"=>$data
        ];
        return response()->json($outsfsput, $this->successStatus);
    }

    public function get_all_campaigns_List_count($user){
        $q = DB::table('email_campaigns_list');
        return $q->count();
    }

    public function get_all_campaigns_List_filter_data_count($user){
        $query = DB::table('email_campaigns_list')->where('ecl_dealer_id','=',$user->dealer_id);
        return $query->count();
    }

    public function addCampaignList(Request $request){
        $validator = Validator::make($request->all(), [ 
            //'assignTo' => 'required', 
            'name' => 'required', 
            'user_cate' => 'required',
        ]);
		if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], $this->errorStatus); exit;
        }
        $input = $request->all();
        $user = Auth::user();
        if(!empty($user)){
            $ins_arr = [
                'ecl_dealer_id'=> $user->dealer_id,
                'ecl_name' => $input['name'],
                'ecl_user_cate' => $input['user_cate'],
                'ecl_created' => date('Y-m-d H:i:s'),
                'ecl_updated' => date('Y-m-d H:i:s')
            ];

            $filters=[];
            if ($input['user_cate'] == 'all' || $input['user_cate'] == 'customers') {
                if(!empty($input['by'])){
                    
                    if ($input['by'] == 'by_source') {
                        if (!empty($input['source'])) {
                            $filters['by'] = $input['by'];
                            $filters['source'] = $input['source'];
                        }
                    }elseif ($input['by'] == 'by_specific_vehicle') {
                        if (!empty($input['model']) && !empty($input['vtype']) && !empty($input['time_period'])) {
                            $filters['by'] = $input['by'];
                            $filters['model'] = $input['model'];
                            $filters['saleType'] = $input['vtype'];
                            $filters['timePeriod'] = $input['time_period'];

                            if ($input['time_period'] == 'specific_time_period') {
                                $filters['start'] = date("Y-m-d",strtotime($input['sdate']));
                                $filters['end'] = date("Y-m-d",strtotime($input['edate']));
                            }
                        }
                    }elseif ($input['by'] == 'by_area') {
                        if (!empty($input['zip'])) {
                            $filters['by'] = $input['by'];
                            $filters['zip'] = $input['zip'];
                        }
                    }
                }
            }


            if (!empty($filters)) {
                $ins_arr['ecl_filters'] = json_encode($filters);
            }


            $resp = DB::table('email_campaigns_list')->insert($ins_arr);
            if($resp){
                return response()->json(['success'=>"Successfully added."], $this->successStatus); exit;
            }else{
                return response()->json(['error'=>"Something went wrong."], $this->errorStatus); exit;
            }
        }
    }

    public function changeCampaignListStatus(Request $request){
        $validator = Validator::make($request->all(), [ 
            'id' => 'required', 
            'status' => 'required',
        ]);
		if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], $this->errorStatus); exit;
        }
        $input = $request->all();
        $user = Auth::user();
        if($input['status'] == '0'){
            $status = 1;
        }elseif($input['status'] == '1'){
            $status = 0;
        }
        if(!empty($user)){
            $upd_arr = [
                'ecl_status' => $status,
                'ecl_updated' => date('Y-m-d H:i:s')
            ];
            $resp = DB::table('email_campaigns_list')->where('ecl_id','=',$input['id'])
            ->where('ecl_dealer_id','=',$user->dealer_id)->update($upd_arr);
            if($resp){
                return response()->json(['success'=>"Successfully update."], $this->successStatus); exit;
            }else{
                return response()->json(['error'=>"Something went wrong."], $this->errorStatus); exit;
            }
        }
    }

    public function addNewCampaign(Request $request){
        $validator = Validator::make($request->all(), [ 
            'campaign_name' => 'required', 
            'subject' => 'required',
            'from_name' => 'required',
            'from_email' => 'required',
            'template' => 'required',
            'campaign_list' => 'required'
        ]);
		if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], $this->errorStatus); exit;
        }
        $input = $request->all();
        $user = Auth::user();
        if(!empty($user)){
            $ins_arr = [
                'ec_name'=> $input['campaign_name'],
                'ec_subject' => $input['subject'],
                'ec_from_name' => $input['from_name'],
                'ec_from_email' => $input['from_email'],
                'ec_template' => $input['template'],
                'ec_template_design' => json_encode($input['design']),
                'ec_dealer_id' => $user->dealer_id,
                'ec_created' => date('Y-m-d H:i:s'),
                'ec_updated' => date('Y-m-d H:i:s')
            ];
            if ($input['same_reply_to'] == true) {
                $ins_arr['ec_replyTo_name'] = $input['from_name'];
                $ins_arr['ec_replyTo_email'] = $input['from_email'];
            }elseif ($input['same_reply_to'] == false) {
                $ins_arr['ec_replyTo_name'] = $input['replyTo_name'];
                $ins_arr['ec_replyTo_email'] = $input['replyTo_email'];
            }

            if ($input['schedule'] == true) {
                $date = date('Y-m-d',strtotime($input['schedule_date']['startDate'])).' '.$input['tHour'].':'.$input['tMin'].' '.$input['tDtype'];
                $ins_arr['ec_date'] = date('Y-m-d H:i:s',strtotime($date));
            }elseif ($input['schedule'] == false) {
                $ins_arr['ec_date'] = date('Y-m-d H:i:s');
            }
            $campaigns_ids = '';
            if(!empty($input['campaign_list'])){
                if (count($input['campaign_list']) > 0) {
                    foreach ($input['campaign_list'] as $key => $value) {
                        if($key == 0){
                            $campaigns_ids .= $value['ecl_id'];
                        }else{
                            $campaigns_ids .= ','.$value['ecl_id'];
                        }
                    }
                }
            }
            $ins_arr['ec_campaign_id'] = $campaigns_ids;

            //return $ins_arr;
            $resp = DB::table('email_campaigns')->insert($ins_arr);
            if($resp){
                return response()->json(['success'=>"Successfully added."], $this->successStatus); exit;
            }else{
                return response()->json(['error'=>"Something went wrong."], $this->errorStatus); exit;
            }
        }
    }

    public function campaigns(){
        $user = Auth::user();
        if (!empty($user)) {
            $campaigns = DB::table('email_campaigns')->where('ec_dealer_id','=',$user->dealer_id)->where('ec_status','=',1)->get();
            return response()->json(['success'=>$campaigns], $this->successStatus);
        }else{
            return response()->json(['error'=>"Unauthenticate user."], $this->errorStatus);
        }
    }

    public function dt_campaigns(Request $request){
        $input = $request->all();
        $user = Auth::user();
        //return $input;
        $order_columns = ['ec_id','ec_name','ec_subject','ec_status','ec_date'];
        $query = DB::table('email_campaigns')->where('ec_dealer_id','=',$user->dealer_id);


        if (!empty($input['search']['value'])) {
            $search_val = "%".$input["search"]["value"]."%";
            $query->where('ec_name', 'like', $search_val);
            // $query->where(function ($query) use ($search_val) {
                
            //     $query->where('ec_name', 'like', $search_val)
            //     ->orWhere('leads.l_customer_first_name', 'like', $search_val)
            //     ->orWhere('leads.l_customer_last_name', 'like', $search_val);
            // });
        }
        if (!empty($input['order'][0]['column']) && !empty($order_columns[$input['order'][0]['column']])) {
            $query->orderBy($order_columns[$input['order'][0]['column']],$input['order'][0]['dir']);
        }else{
            $query->orderBy('ec_id', 'DESC');
        }

        if ($input['start'] >= 0  && $input['length'] >= 0) {
            $query->offset($input['start']);
            $query->limit($input['length']);
        }
        
        $campaigns = $query->get();
        //return response()->json(['success'=>$leads], $this->successStatus); exit;
        $data = [];
        if(!empty($campaigns) && count($campaigns) > 0){
            foreach ($campaigns as $key => $camp) {
                $output = [];
                $output[] = $key+1;
                $output[] = $camp->ec_name;
                $output[] = $camp->ec_subject;
                if($camp->ec_status == '1'){
                    $output[] = '<a  class="assin clStatus" id="statusChange'.$camp->ec_id.'" data-id="'.$camp->ec_id.'" data-status="'.$camp->ec_status.'" href="#">Active</a>';
                }else{
                    $output[] = '<a  class="btn-clr-danger clStatus" id="statusChange'.$camp->ec_id.'" data-id="'.$camp->ec_id.'" data-status="'.$camp->ec_status.'" href="#">InActive</a>';
                }
                $output[] = date('m-d-Y H:i A',strtotime($camp->ec_created));
                $data[] = $output;
            }
        }

        $outsfsput = [
            "draw"=>$input['draw'],
            'recordsTotal'=> $this->get_all_campaigns_count($user),
            'recordsFiltered'=> $this->get_all_campaigns_filter_data_count($user),
            "data"=>$data
        ];
        return response()->json($outsfsput, $this->successStatus);

    }

    public function get_all_campaigns_count($user){
        $q = DB::table('email_campaigns');
        return $q->count();
    }

    public function get_all_campaigns_filter_data_count($user){
        $query = DB::table('email_campaigns')->where('ec_dealer_id','=',$user->dealer_id);
        return $query->count();
    }


    // Send Campaigns


    public function sendCampaigns(){
        $campaign = DB::table('email_campaigns')
        ->leftJoin('email_campaigns_list', 'email_campaigns.ec_campaign_id', '=', 'email_campaigns_list.ecl_id')
        ->leftJoin('dealers', 'dealers.dl_id', '=', 'email_campaigns.ec_dealer_id')
        ->whereDate('ec_date', Carbon::today())->where('ec_status','=',1)->first();

        
        if (!empty($campaign)) {
            // Get Campaign Users
            $contscts = $this->getUsersForCamoaign($campaign->ecl_dealer_id,$campaign->ecl_user_cate,$campaign->ecl_filters);
            //return response()->json($contscts);
            if (!empty($contscts)) {


                $apiKey = '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';
                $MainUrlEndPoint = 'https://api.sendgrid.com/v3/marketing/';
                $list_endpoint = 'lists';
                $contacts_endpoint = 'contacts';
                $campaign_endpoint = 'singlesends';
                $senders_endpoint = 'senders';


                //Create List
                $method = 'POST';
                $postData = array(
                    'name' => $campaign->ec_name.' conatct list '.uniqid()
                );
                $campaignList = $this->SendGrid($apiKey, $MainUrlEndPoint, $list_endpoint, $method, $postData);

                if (!empty($campaignList->id)) {
                    // Add Contacts
                    $method = 'PUT';
                    foreach ($contscts as $key => $usre) {

                        $conatctPostData = array(
                            'list_ids' => array($campaignList->id),
                            "contacts" => [array(
                                "email" => $usre->email,
                                "first_name" => $usre->name,
                                //"last_name" =>"vvv",
                                // "address_line_1" => "string (optional)",
                                // "address_line_2" => "string (optional)",
                                // "alternate_emails" => array(
                                //     "email_1 (optional)",
                                //     "email_2 (optional)"
                                // ),
                                // "city" => "string (optional)",
                                // "country" => "string (optional)",
                                // "postal_code" => "string (optional)",
                                // "state_province_region" => "string (optional)"
                            )]
                        );
                        $resp = $this->SendGrid($apiKey, $MainUrlEndPoint, $contacts_endpoint, $method,$conatctPostData);

                    }


                    if (!empty($resp->job_id)) {

                        // Add Sender

                        // $method = 'POST';
                        // $postData = array(
                        //     "nickname" => $campaign->dl_name,
                        //     "from" => array('email' => $campaign->ec_from_email,'name' => $campaign->ec_from_name ),
                        //     "reply_to" => array('email' => $campaign->ec_replyTo_email,'name' => $campaign->ec_replyTo_name ),
                        //     "address" => "Charlotte, NC",
                        //     "city" => "Charlotte",
                        //     "country" => "USA"
                        // );
                        // $sender = $this->SendGrid($apiKey, $MainUrlEndPoint, $senders_endpoint, $method, $postData);





                        // ADD Campaign 
                        //$cDate = date('Y-m-d H:i:s');
                        //$date = date('Y-m-d H:i:s', strtotime($cDate. ' + 5 minutes'));
                        $gmDate = str_replace('+00:00', 'Z', gmdate('c', strtotime($campaign->ec_date)));
                        $method = 'POST';
                        $postData = array(
                            "name" => $campaign->ec_name,
                            "send_at" => $gmDate, //UTC-TZ-Format (optional)
                            "send_to" => array(
                                "list_ids" => array($campaignList->id),
                                "all" => false //(TRUE) if all lists
                            ),
                            "email_config" => array(
                                "subject" => $campaign->ec_subject,
                                "html_content" => $campaign->ec_template,
                                "plain_content" => "",
                                "generate_plain_content" => true,
                                "custom_unsubscribe_url" => "https://webmatech.com/unautorize",
                                "sender_id" => 964655 //integer
                            )
                        );
                        $resp = $this->SendGrid($apiKey, $MainUrlEndPoint, $campaign_endpoint, $method, $postData);
                        return response()->json(['success'=>$resp], $this->successStatus);

                    }

                }else{
                    return response()->json(['error'=>"Campaign list does not created."], $this->errorStatus); exit;
                }
            }
        }
    }

    public function getUsersForCamoaign($dealer,$user_cate='',$filter=''){
        if ($user_cate == 'all' || $user_cate == 'customers') {
            $filters = json_decode($filter);
            $query = DB::table('lead_details')->select('l_customer_first_name as name','l_customer_last_name as last_name','l_customer_email as email')
            ->leftJoin('leads', 'leads.l_id', '=', 'lead_details.ld_lead_id')
            ->where('l_dealer_id','=',$dealer);

            if ($filters->by == 'by_specific_vehicle') {
                if (!empty($filters->model)) {
                    $query->where('ld_voi_model','=',$filters->model);
                }
                if (!empty($filters->saleType)) {
                    $query->where('ld_status','=',$filters->saleType);
                }
                if (!empty($filters->timePeriod)) {
                    if ($filters->timePeriod == 'threeYago') {
                        $cDate = date('Y-m-d');
                        $date = date('Y-m-d', strtotime($cDate. ' - 3 year'));
                        $query->whereDate('ld_created','>',$date);

                        $query->where(function ($query) {
                            $query->where('ld_status', '=', '5')
                            ->orWhere('ld_status', '=', '6');
                        });

                    }elseif ($filters->timePeriod == 'specific_time_period') {
                        $query->whereDate('ld_created','>=',$filters->start);
                        $query->whereDate('ld_created','<=',$filters->end);
                    }
                }
            }elseif($filters->by == "by_source"){
                $query->where('ld_source','=',$filters->source);
            }elseif($filters->by == "by_area"){

            }
            $data = $query->get();

            return $this->unique_multidimensional_array($data,'email');

            //return array_unique($data);
        }elseif ($user_cate == 'employees') {
            return $data = User::select('name','email')->where('parent_id','=',$dealer)->where('user_status','=',1)->get();
        }elseif ($user_cate == 'dealers') {
            return $data = DB::table('dealers')->select('dl_name as name','dl_email as email')->where('dl_status','=',1)->get();
        }else{
            return [];
        }
    }

    public function SendGrid($apiKey = NULL, $MainUrlEndPoint = NULL, $endpoint = NULL, $Method = NULL, $data = NULL){
        $postData = NULL;
        if($data != NULL){
            $postData = json_encode($data);
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $MainUrlEndPoint.$endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $Method,
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$apiKey,
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            //return "success";//
            return json_decode($response);
            //return $response;
        }
    }

    public function unique_multidimensional_array($array, $key) {
        $temp_array = [];
        $i = 0;
        $key_array = array();

        foreach($array as $val) {
            if (!in_array($val->email, $key_array)) {
                $key_array[$i] = $val->email;
                $temp_array[] = $val;
            }
            $i++;
        }
        return $temp_array;
    }



    public function sg_createContactsList(){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://api.sendgrid.com/v3/contactdb/lists");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query(array('name' => 'TestList')));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer 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',
            'Content-Type: application/json'
        ));


        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        
        //$data = json_decode($server_output);
        return $server_output;
    }


    // public function campaignDetail(){
    //     $user = Auth::user();
    //     if (!empty($user)) {
    //         $campaigns = DB::table('email_campaigns')->where('ec_dealer_id','=',$user->dealer_id)->where('ec_status','=',1)->get();
    //         return response()->json(['success'=>$campaigns], $this->successStatus);
    //     }else{
    //         return response()->json(['error'=>"Unauthenticate user."], $this->errorStatus);
    //     }
    // }

}
