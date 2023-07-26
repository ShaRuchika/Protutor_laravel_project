<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\User;
use App\Models\Userdetail;
use App\Models\Countries;
use App\Models\Spoken_language;
use App\Models\Teaches_level;
use App\Models\Subject;
use App\Models\Hourly_rate;
use App\Models\Education;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Identification;
use App\Models\Notifications;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Str;

class UserdetailController extends Controller
{
	public function __construct()
	{
		$userid = Session::get('admin_userid');
		if(isset($userid) && $userid==""){
			return redirect('/admin/dashboard');
		}
	}

	public function index(Request $request)
	{ 
		$PageTitle = 'User List | ProTutor'; 

		$userAll = new User;


		$email = (isset($_GET['name_email']) && $_GET['name_email'] !="" ? $_GET['name_email'] : ""); 
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
		if (preg_match($regex, $email)) {
			if (isset($_GET['name_email']) && !empty($_GET['name_email'])) {
				$userAll =    $userAll->where('email','like', '%' .$_GET['name_email']. '%');
			}
		} else { 
			if (isset($_GET['name_email']) && !empty($_GET['name_email'])) {
				$userAll = $userAll->whereRaw('concat(lower(first_name)," ",lower(last_name)) like "%'.$_GET['name_email'].'%"');
			}
		}

		if (isset($_GET['status']) && $_GET['status'] !="") {
			$userAll =    $userAll->where('user_status',$_GET['status']);
		}

		if (isset($_GET['role']) && $_GET['role'] !="") {
			$userAll =    $userAll->where('role',$_GET['role']);
		}

		if (isset($_GET['email_veri']) && $_GET['email_veri'] !="") {
			$userAll =    $userAll->where('email_verify',$_GET['email_veri']);
		}
		if (isset($_GET['register_from']) && !empty($_GET['register_to'])) {
			$userAll =   $userAll->where('created_at', '>', $_GET['register_from'])->where('created_at', '<', $_GET['register_to']);
		}

		$params = array('name_email' => (isset($_GET['name_email']) ? $_GET['name_email'] : "" ),'role' => (isset($_GET['role']) ? $_GET['role'] : "" ),'email_veri' => (isset($_GET['email_veri']) ? $_GET['email_veri'] : "" ),'status' => (isset($_GET['status']) ? $_GET['status'] : "" ),'register_from' => (isset($_GET['register_from']) ? $_GET['register_from'] : "" ),'register_to' => (isset($_GET['register_to']) ? $_GET['register_to'] : "" ) );

		$userAll =   $userAll->whereNotIn('role',[1,2]);

		$userAll = $userAll->paginate(10);

		return view("admin/usermanage/userlist",compact('PageTitle','userAll','params'));

	}

	public function studentlist(Request $request)
	{ 
		$PageTitle = 'Students List | ProTutor';
		$studentAll = new User;


		$email = (isset($_GET['name_email']) && $_GET['name_email'] !="" ? $_GET['name_email'] : ""); 
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
		if (preg_match($regex, $email)) {
			if (isset($_GET['name_email']) && !empty($_GET['name_email'])) {
				$studentAll =    $studentAll->where('email','like', '%' .$_GET['name_email']. '%');
			}
		} else { 
			if (isset($_GET['name_email']) && !empty($_GET['name_email'])) {
				$studentAll = $studentAll->whereRaw('concat(lower(first_name)," ",lower(last_name)) like "%'.$_GET['name_email'].'%"');
			}
		}

		if (isset($_GET['status']) && $_GET['status'] !="") {
			$studentAll =    $studentAll->where('user_status',$_GET['status']);
		}
		if (isset($_GET['email_veri']) && $_GET['email_veri'] !="") {
			$studentAll =    $studentAll->where('email_verify',$_GET['email_veri']);
		}
		if (isset($_GET['register_from']) && !empty($_GET['register_to'])) {
			$studentAll =   $studentAll->where('created_at', '>', $_GET['register_from'])->where('created_at', '<', $_GET['register_to']);
		}

		$params = array('name_email' => (isset($_GET['name_email']) ? $_GET['name_email'] : "" ),'email_veri' => (isset($_GET['email_veri']) ? $_GET['email_veri'] : "" ),'status' => (isset($_GET['status']) ? $_GET['status'] : "" ),'register_from' => (isset($_GET['register_from']) ? $_GET['register_from'] : "" ),'register_to' => (isset($_GET['register_to']) ? $_GET['register_to'] : "" ) );

		$studentAll =   $studentAll->where('role',4);

		$studentAll = $studentAll->paginate(10);

		return view("admin/usermanage/studentlist",compact('PageTitle','studentAll','params'));

	}

	public function teacherlist(Request $request)
	{ 
		$PageTitle = 'Tutors List | ProTutor';

		$teacherAll = new User;


		$email = (isset($_GET['name_email']) && $_GET['name_email'] !="" ? $_GET['name_email'] : ""); 
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
		if (preg_match($regex, $email)) {
			if (isset($_GET['name_email']) && !empty($_GET['name_email'])) {
				$teacherAll =    $teacherAll->where('email','like', '%' .$_GET['name_email']. '%');
			}
		} else { 
			if (isset($_GET['name_email']) && !empty($_GET['name_email'])) {
				$teacherAll = $teacherAll->whereRaw('concat(lower(first_name)," ",lower(last_name)) like "%'.$_GET['name_email'].'%"');
			}
		}

		if (isset($_GET['status']) && $_GET['status'] !="") {
			$teacherAll =    $teacherAll->where('user_status',$_GET['status']);
		}
		if (isset($_GET['email_veri']) && $_GET['email_veri'] !="") {
			$teacherAll =    $teacherAll->where('email_verify',$_GET['email_veri']);
		}
		if (isset($_GET['register_from']) && !empty($_GET['register_to'])) {
			$teacherAll =   $teacherAll->where('created_at', '>', $_GET['register_from'])->where('created_at', '<', $_GET['register_to']);
		}

		$params = array('name_email' => (isset($_GET['name_email']) ? $_GET['name_email'] : "" ),'email_veri' => (isset($_GET['email_veri']) ? $_GET['email_veri'] : "" ),'status' => (isset($_GET['status']) ? $_GET['status'] : "" ),'register_from' => (isset($_GET['register_from']) ? $_GET['register_from'] : "" ),'register_to' => (isset($_GET['register_to']) ? $_GET['register_to'] : "" ) );

		$teacherAll =   $teacherAll->where('role',3);

		$teacherAll = $teacherAll->paginate(10);
		
		return view("admin/usermanage/teacherlist",compact('PageTitle','teacherAll','params')); 
	}

	public function tutorrequest(Request $request)
	{ 
		$PageTitle = 'Tutor Request | ProTutor';

		$teacherAll = new User;


		$email = (isset($_GET['name_email']) && $_GET['name_email'] !="" ? $_GET['name_email'] : ""); 
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
		if (preg_match($regex, $email)) {
			if (isset($_GET['name_email']) && !empty($_GET['name_email'])) {
				$teacherAll =    $teacherAll->where('email','like', '%' .$_GET['name_email']. '%');
			}
		} else { 
			if (isset($_GET['name_email']) && !empty($_GET['name_email'])) {
				$teacherAll = $teacherAll->whereRaw('concat(lower(first_name)," ",lower(last_name)) like "%'.$_GET['name_email'].'%"');
			}
		}

		if (isset($_GET['status']) && $_GET['status'] !="") {
			$teacherAll =    $teacherAll->where('user_status',$_GET['status']);
		}
		if (isset($_GET['email_veri']) && $_GET['email_veri'] !="") {
			$teacherAll =    $teacherAll->where('email_verify',$_GET['email_veri']);
		}
		if (isset($_GET['register_from']) && !empty($_GET['register_to'])) {
			$teacherAll =   $teacherAll->where('created_at', '>', $_GET['register_from'])->where('created_at', '<', $_GET['register_to']);
		}

		$params = array('name_email' => (isset($_GET['name_email']) ? $_GET['name_email'] : "" ),'email_veri' => (isset($_GET['email_veri']) ? $_GET['email_veri'] : "" ),'status' => (isset($_GET['status']) ? $_GET['status'] : "" ),'register_from' => (isset($_GET['register_from']) ? $_GET['register_from'] : "" ),'register_to' => (isset($_GET['register_to']) ? $_GET['register_to'] : "" ) );

		$teacherAll =   $teacherAll->where('role',3);

		$teacherAll = $teacherAll->paginate(10);
		
		return view("admin/usermanage/tutorrequest",compact('PageTitle','teacherAll','params')); 
	}

	public function adminlist(Request $request)
	{ 
		$PageTitle = 'Admin List | ProTutor';

		$adminAll = new User;


		$email = (isset($_GET['name_email']) && $_GET['name_email'] !="" ? $_GET['name_email'] : ""); 
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
		if (preg_match($regex, $email)) {
			if (isset($_GET['name_email']) && !empty($_GET['name_email'])) {
				$adminAll =    $adminAll->where('email','like', '%' .$_GET['name_email']. '%');
			}
		} else { 
			if (isset($_GET['name_email']) && !empty($_GET['name_email'])) {
				$adminAll = $adminAll->whereRaw('concat(lower(first_name)," ",lower(last_name)) like "%'.$_GET['name_email'].'%"');
			}
		}

		if (isset($_GET['status']) && $_GET['status'] !="") {
			$adminAll =    $adminAll->where('user_status',$_GET['status']);
		}

		if (isset($_GET['role']) && $_GET['role'] !="") {
			$adminAll =    $adminAll->where('role',$_GET['role']);
		}

		if (isset($_GET['register_from']) && !empty($_GET['register_to'])) {
			$adminAll =   $adminAll->where('created_at', '>', $_GET['register_from'])->where('created_at', '<', $_GET['register_to']);
		}

		$params = array('name_email' => (isset($_GET['name_email']) ? $_GET['name_email'] : "" ),'role' => (isset($_GET['role']) ? $_GET['role'] : "" ),'status' => (isset($_GET['status']) ? $_GET['status'] : "" ),'register_from' => (isset($_GET['register_from']) ? $_GET['register_from'] : "" ),'register_to' => (isset($_GET['register_to']) ? $_GET['register_to'] : "" ) );

		$adminAll =   $adminAll->whereIn('role',[1,2]);

		$adminAll = $adminAll->paginate(10);

		return view("admin/usermanage/adminlist",compact('PageTitle','adminAll','params'));

	}

	public function viewprofile(Request $request,$userid)
	{ 
		$PageTitle = 'View Profile | ProTutor';
		$countries =  Countries::all();
		$teaches_levels =  Teaches_level::all();
		$subject =  Subject::all();
		$hourly_rate =  Hourly_rate::all();
		$spoken_languages =  Spoken_language::where('user_status', 1)->get();

		$testt='SELECT users.id as user_id,users.first_name,users.last_name,users.phone_number,users.role,users.user_status,users.email ,users.email_verify,users.password,userdetails.* FROM `users` LEFT JOIN `userdetails` ON users.id = userdetails.student_no WHERE users.id="'.$userid.'"';
		$userdata = DB::select($testt);

		return view("admin/usermanage/viewprofile",compact('PageTitle','userdata','countries','teaches_levels','subject','hourly_rate','spoken_languages'));
	}

	public function editprofile(Request $request,$userid)
	{ 
		$PageTitle = 'Edit Profile | ProTutor';  
		$countries =  Countries::all();
		$teaches_levels =  Teaches_level::all();
		$subject =  Subject::all();
		$hourly_rate =  Hourly_rate::all();
		$spoken_languages =  Spoken_language::where('user_status', 1)->get();
		$testt='SELECT users.id as user_id,users.first_name,users.last_name,users.phone_number,users.role,users.user_status,users.email ,users.email_verify,users.password,userdetails.* FROM `users` LEFT JOIN `userdetails` ON users.id = userdetails.student_no WHERE users.id="'.$userid.'"';
		$userdata = DB::select($testt);

		return view("admin/usermanage/editprofile",compact('PageTitle','userdata','countries','teaches_levels','subject','hourly_rate','spoken_languages'));
	}

	public function tutordetails(Request $request,$userid)
	{ 
		$PageTitle = 'Tutor Details | ProTutor';  
		$countries =  Countries::all();
		$teaches_levels =  Teaches_level::all();
		$subject =  Subject::all();
		$hourly_rate =  Hourly_rate::all();
		$spoken_languages =  Spoken_language::where('user_status', 1)->get();

		$getEgducation = Education::where('userdetail_id',$userid)->get();
		$getCertificate = Certificate::where('userdetail_id',$userid)->get();
		$getExperience = Experience::where('userdetail_id',$userid)->get();
		$getIdentification = Identification::where('userdetail_id',$userid)->get();

		
		$testt='SELECT users.id as user_id,users.first_name,users.last_name,users.phone_number,users.role,users.user_status,users.email ,users.email_verify,users.password,userdetails.* FROM `users` LEFT JOIN `userdetails` ON users.id = userdetails.student_no WHERE users.id="'.$userid.'"';
		$userdata = DB::select($testt);

		return view("admin/usermanage/tutordetails",compact('PageTitle','userdata','countries','subject','spoken_languages','getEgducation','getCertificate','getExperience','getIdentification'));
	}

	/*public function update_user_profile(Request $request)
	{ 

		if($request->post()){ 

        $update = array('user_status'=>$request->status,'email'=>$request->email,'role'=>$request->role,'phone_number'=>$request->phone,'first_name'=>$request->first_name,'last_name'=>$request->last_name);

        DB::table('users')->where('id',$request->userrealid)->update($update);

        return redirect('admin/edit-profile/'.$request->userrealid)->with('success_msg',__('Your profile updated successfully.'));


    }
}*/

public function update_user_profile(Request $request)
{ 

	if($request->post()){

		$request->validate([
			'first_name' => ['required'],
			'last_name' => ['required'],
			'email' => ['required'],
		]);

		$update = array('first_name'=>$request->first_name,'last_name'=>$request->last_name,'email'=>$request->email,'role'=>$request->role,'phone_number'=>$request->phone,'user_status'=>$request->status);

		DB::table('users')->where('id',$request->userrealid)->update($update);
		$languages = implode(',', $request->languages);

		$userdetails_update = array('first_name'=>$request->first_name,'last_name'=>$request->last_name,'email'=>$request->email,'phone'=>$request->phone,'country'=>$request->country,'gender'=>$request->gender,'dob'=>$request->dob,'level'=>$request->level,'teaching_exp'=>$request->teaching_exp,'current_sit'=>$request->current_sit,'native_language'=>$request->native_language,'languages'=>$languages,'desc_about'=>$request->desc_about);

		DB::table('userdetails')->where('student_no',$request->userrealid)->update($userdetails_update);

		return redirect('admin/edit-profile/'.$request->userrealid)->with('success_msg',__('Your profile updated successfully.'));


	}
}

public function status_update(Request $request){

	$id = $request->id;
	$user = DB::table('users')->select('user_status')->where('id',$id)->first();

	if($user->user_status == '1'){
		$status = 0;
	}else{
		$status = 1;
	}

	$update = array('user_status'=>$status);
	DB::table('users')->where('id',$id)->update($update);

	$msg = "Status is updated";
	return response()->json(array('msg'=> $msg), 200);
	die();

}

public function admin_apporove_profile(Request $request){

	$id = $request->userrealid;
	$reject_reason = $request->reject_reason;
	$status = $request->status;
		//$user = DB::table('users')->select('user_status')->where('id',$id)->first();

	if($status == '1'){
		$status = 1;

		$teacher='3';
		$notificationstype = array('techer'=>$teacher);
		$notifi_notifiable_id=implode(",",$notificationstype);

		$notificationsdata = 'Your profile is approved by admin.';
		$Notifications = new Notifications();
		$Notifications->viewer_role =$notifi_notifiable_id;
		$Notifications->user_id =$id;
		$Notifications->message_type='ProfileverifyNotification';
		$Notifications->data=$notificationsdata;
		$Notifications->read_at='0';
		$Notifications->save();

	}else{

		$status = 0;

		$teacher='3';
		$notificationstype = array('techer'=>$teacher);
		$notifi_notifiable_id=implode(",",$notificationstype);

		$notificationsdata = 'Your profile is rejected by admin and Reason for rejecting: '.$reject_reason;
		$Notifications = new Notifications();
		$Notifications->viewer_role =$notifi_notifiable_id;
		$Notifications->user_id =$id;
		$Notifications->message_type='ProfileverifyNotification';
		$Notifications->data=$notificationsdata;
		$Notifications->read_at='0';
		$Notifications->save();
	}

	$update = array('profile_verified'=>$status);
	DB::table('userdetails')->where('student_no',$id)->update($update);


	return redirect('admin/tutor-request/')->with('success_msg',__('Status is updated.'));

}

   // Deletes a user
public function delete_user(Request $request,$id){

	$userslist = User::find($id);
	$userslist->delete();
	$userdetails = Userdetail::where('student_no', $id)->delete();
	return redirect('/admin/userlist')->with('success_msg',__('User deleted successfully.'));
}

public function delete_student(Request $request,$id){

	$userslist = User::find($id);
	$userslist->delete();
	$userdetails = Userdetail::where('student_no', $id)->delete();
	return redirect('/admin/studentlist')->with('success_msg',__('Student deleted successfully.'));
}

public function delete_teacher(Request $request,$id){

	$userslist = User::find($id);
	$userslist->delete();
	$userdetails = Userdetail::where('student_no', $id)->delete();
	return redirect('/admin/teacherlist')->with('success_msg',__('Tutor deleted successfully.'));
}

public function delete_admin(Request $request,$id){

	$userslist = User::find($id);
	$userslist->delete();
	$userdetails = Userdetail::where('student_no', $id)->delete();
	return redirect('/admin/adminlist')->with('success_msg',__('Admin deleted successfully.'));
}

public function newpassword2(Request $request){

	$email = Session::get('forgetpasswordemail');
	$token = Session::get('forgetpasswordtoken');  

	if($request->post()){

		$request->validate([
			'password' => ['required','confirmed'],
			'password_confirmation' => ['required'],
		]);


		$user = User::where('email', $email)->update(['password' => md5($request->password)]);    

		Session::flush();
		return redirect('/reset-password-success')->with('success_msg',__('You are login successfully'));

	}


}



}
