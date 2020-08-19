<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Validator
use Illuminate\Support\Facades\Validator;

// DB Query builder
use Illuminate\Support\Facades\DB;

// For Loged in User or Authentication
use Illuminate\Support\Facades\Auth;

// Broadcast Events
use App\Events\NotiEvent;

// File Upload
use Illuminate\Support\Facades\Storage;

// String Helper
//use Illuminate\Support\Str;

//Load Model
use App\User;

class UserController extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 401;

    public function likeIt()
    {
        broadcast(new NotiEvent(5, 1))->toOthers();
    }

	public function login(){
        //return print_r(request('email'));
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            $success['user'] = ['name'=>$user->name,'email'=>$user->email,'user_type'=>$user->user_type];
            return response()->json(['success' => $success], $this->successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Invalid Email or Password'], $this->errorStatus); 
        } 
    }

	public function register($type,Request $request) 
    {
        if($type != 0 && $type != 1 && $type != 2){
            return response()->json(['error'=>'User type does not found'], $this->errorStatus);
        }
        $validator = Validator::make($request->all(), [ 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'email' => 'required|email',
            //'dealer_id' => 'required',
            'team' => 'required',
            'phone' => 'required',
            'lsources' => 'required', 
            'password' => 'required', 
            'cpassword' => 'required|same:password', 
        ]);
		if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], $this->errorStatus);            
        }
        $input = $request->all();

        $team_id = DB::table('teams')->where('tm_slug','=',$input['team'])->where('tm_status','=',1)->value('tm_id');

        if (empty($team_id)) {
            return response()->json(['error'=>"Invalid team id"], $this->errorStatus);
        }
        //return $team; exit;
        $ins_arr = [
            'name'=> $input['first_name'].' '.$input['last_name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
            'phone' => str_replace(' ', '', $input['phone']),
            //'dealer_id' => $input['dealer_id'],
            'user_type' => $type,
            'team_id' => $team_id,
            'created' => date('Y-m-d H:i:s'),
            'updated' => date('Y-m-d H:i:s')
        ];
        
        // Upload Image 
        if(!empty($input['img'])){
            $base64_image = $input['img'];
            if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
                $data = substr($base64_image, strpos($base64_image, ',') + 1);
                $data = base64_decode($data);
                $imageName = md5(uniqid('profile',TRUE)).'.jpg';
                Storage::disk('profile')->put($imageName, $data);
                $ins_arr['picture'] = $imageName;
            }
        }
        if ($type == 2) {
            $auth_user = Auth::user();
            if (!empty($auth_user->id) && !empty($auth_user->dealer_id)) {
                $ins_arr['dealer_id'] = $auth_user->dealer_id;
                $ins_arr['parent_id'] = $auth_user->id;
            }else{
                return response()->json(['error'=>"User not found."], $this->errorStatus);
            }
        }
        if(!empty($input['role_title'])){
            $ins_arr['role_title'] = $input['role_title'];
        }
        if(!empty($input['permissions'])){
            $permissions = '';
            foreach ($input['permissions'] as $key => $value) {
                if($key != 0){
                    $permissions .= ',';
                }
                $permissions .= $value['text'];
            }
            $ins_arr['permissions'] = $permissions;
        }
        //return $ins_arr; exit;
        $user = User::create($ins_arr); 
        //$success['token'] =  $user->createToken('MyApp')->accessToken; 
        //$success['name'] =  $user->name;
        if($user){
            $ins_arr['id'] = $user->id;
            unset($ins_arr['password']);
            foreach ($input['lsources'] as $key => $value) {
                if(!empty($value)){
                    DB::table('user_lead_sources')
                    ->insert([
                        'uls_user_id'=>$ins_arr['id'],
                        'uls_source_id'=> $value['ls_id'],
                        'uls_created'=>date('Y-m-d H:i:s'),
                        'uls_updated' =>date('Y-m-d H:i:s')
                    ]);
                }
            }

            $days = array("", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
            for ($i=1; $i < 8; $i++) { 
                $hoursArr = [
                    'ws_userid'=>$ins_arr['id'],
                    'ws_title'=>$days[$i],
                    'ws_day'=>$i
                ];
                DB::table('weekly_schedule')->insert($hoursArr);
            }

            return response()->json(['success'=>$ins_arr], $this->successStatus); 
        }else{
            return response()->json(['error'=>"Somethin went wrong."], $this->errorStatus); 
        }
        
    }

    public function members ($slug,Request $request){
		if (empty($slug)) { 
            return response()->json(['error'=>"Team is missing"], $this->errorStatus);  
        }
        $user = Auth::user();
        if(empty($user->id) || empty($user->user_type)){
            return response()->json(['error'=>"User not authorized."], $this->errorStatus); 
        }
        if($user->user_type == 2){
            $status = DB::table('teams')->where('tm_user_id','=',$user->id)->where('tm_slug','=',$slug)->first();
            if(empty($status)){
                return response()->json(['error'=>"no_access"], 200); 
            }
        }

        $users = User::select('teams.tm_name', 'users.*')
        ->leftJoin('teams', 'users.team_id', '=', 'teams.tm_id')
        ->where('teams.tm_slug','=',$slug);

        if($user->user_type == 2){
            $users->where('teams.tm_user_id','=',$user->id);
        }
        return $users->get();
    }

    public function allEmployees(){
        $user = Auth::user(); 
        $employees = DB::table('users')->select('id','name','email','phone','user_type','dealer_id','team_id','picture','role_title')
        //->join('appointments', 'leads.l_dealer_id', '=', 'appointments.ap_id')
        ->where('user_status','=',1)->where('dealer_id','=',$user->dealer_id)->get();
        return response()->json(['success' =>$employees,'user_id'=>$user->id], $this->successStatus); 
    }

    public function updateUserBusyStatus($status){
        if (!empty($status)) {
            $user = Auth::user();
            $resp = User::where('id','=',$user->id)->update(['busy_status_date'=>date('Y-m-d'),'busy_status'=>$status]); 
            if ($resp) {
                return response()->json(['success'=>"Successfully update."], $this->successStatus); 
            }else{
                return response()->json(['error'=>"Somethin went wrong."], $this->errorStatus); 
            }
        }
    }

}
