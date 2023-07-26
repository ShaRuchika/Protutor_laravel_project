<?php

namespace App\Http\Controllers\Frontend;

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
use App\Models\Student_testimonial;
use App\Models\Teaches_level;
use App\Models\Subject;
use App\Models\Hourly_rate;
use App\Models\Certificate;
use App\Models\Homepage;
use App\Models\Notifications;
use App\Models\Become_a_tutor;
use App\Models\Calendar;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
	public function homepage(Request $request)
	{
		$PageTitle = 'Home | ProTutor';

		$Homepagedata = Homepage::where('id',1)->get();

		$Alltestimonial =  Student_testimonial::where('user_status', 1)->orderBy('id', 'desc')->get();
		$Spoken_language =  Spoken_language::where('user_status', 1)->get();
		$subjectAll = Subject::all();
		$rateAll = Hourly_rate::all();
		$countryAll = Countries::all(); 
		$user_status='3';
		$user_data='SELECT users.id as user_id,users.first_name as firstname,users.last_name as lastname,users.phone_number,users.role,users.user_status,users.email ,users.email_verify,users.password,userdetails.* FROM `users` LEFT JOIN `userdetails` ON users.id = userdetails.student_no WHERE users.user_status=1 and users.email_verify=1 and users.role="'.$user_status.'" ORDER BY user_id DESC LIMIT 12';
		$userdata = DB::select($user_data);

		$user_status='3';
		$sliderdata='SELECT users.id as user_id,users.first_name as firstname,users.last_name as lastname,users.phone_number,users.role,users.user_status,users.email ,users.email_verify,users.password,userdetails.* FROM `users` LEFT JOIN `userdetails` ON users.id = userdetails.student_no WHERE users.user_status=1 and users.email_verify=1 and users.role="'.$user_status.'" ORDER BY user_id DESC LIMIT 5';
		$sliderdata = DB::select($sliderdata);



		return view("frontend/homepage",compact('PageTitle','userdata','Spoken_language','subjectAll','rateAll','countryAll','Alltestimonial','sliderdata','Homepagedata'));

	}

	public function signup(Request $request)
	{
		$PageTitle = 'Sign Up | ProTutor';
		return view("frontend/signup",compact('PageTitle'));

	}

	public function become_a_tutor(Request $req)
	{   
		if($req->post()){ 


			$req->validate([
				'email' => ['required', 'email','unique:users'], 
				'password' => ['required'],
			]);

			$role=3;
			$remember_token = Str::random(70);
			$user = new User();
			$user->email=$req->email;
			$user->role=$role;
			$user->remember_token=$remember_token;
			$user->password = md5($req->password);

			if($user->save()){

				Mail::send('admin.email.verifyUser', ['remember_token' => $remember_token], function($message) use($req){
					$message->to($req->email);
					$message->subject('Verification Your Email');

				});    

				return redirect('/login')->with('success_msg', ('Verification link has been send to Your Registered Email'));

			}else{

				return redirect('/become-a-tutor')->with('error_msg', ('User is not registered please try again.'));  
			}

		}else{ 
			$PageTitle = 'Become A Tutor | ProTutor';
			$contentAll = Become_a_tutor::where('id',1)->get(); 
			return view("frontend/become_a_tutor",compact('PageTitle','contentAll'));
		}

	}

	public function student_signup(Request $req)
	{

		if($req->post()){ 


			$req->validate([
				'email' => ['required', 'email','unique:users'], 
				'password' => ['required'],
				'first_name' => ['required'],
				'last_name' => ['required'],
			]);

			$role=4;
			$remember_token = Str::random(70);
			$user = new User();
			$user->first_name=$req->first_name;
			$user->last_name=$req->last_name;
			$user->email=$req->email;
			$user->role=$role;
			$user->remember_token=$remember_token;
			$user->password = md5($req->password);

			if($user->save()){

				$result = Userdetail::create([
					"student_no"=>   $user->id,
					"first_name"=>  $req->first_name,
					"last_name"=>  $req->last_name,
					"country"=>  '',
					"email"=>  $req->email,
					"phone"=>  '',
					"languages"=>  '',
					"over_18"=>  '',
					"level"=>  '',
					"subject"=>  '',
					"hourly_rate"=>  '',
					"desc_first_last"=>  '',
					"desc_about"=>  '',
					"profile_img"=> '',
					"video_link"=>  '',
				]);

				Mail::send('admin.email.verifyUser', ['remember_token' => $remember_token], function($message) use($req){
					$message->to($req->email);
					$message->subject('Verification Your Email');

				});    

            /*$notificationsdata1 = array('email'=>$req->email,'first_name'=>$req->first_name,'last_name'=>$req->last_name);
            $notificationsdata=implode(",",$notificationsdata1);*/

            $superadmin='1';
            $admin='2';
            $notificationstype = array('superadmin'=>$superadmin,'admin'=>$admin);
            $notifi_notifiable_id=implode(",",$notificationstype);

            $notificationsdata = 'New user ('.$req->email.') has just registered';
            $Notifications = new Notifications();
            $Notifications->viewer_role =$notifi_notifiable_id;
            $Notifications->user_id ='1';
            $Notifications->message_type='NewUserRegisterNotification';
            $Notifications->data=$notificationsdata;
            $Notifications->read_at='0';
            $Notifications->save();

            return redirect('/login')->with('success_msg', ('Verification link has been send to Your Registered Email'));

        }else{

        	return redirect('/student-signup')->with('error_msg', ('User is not registered please try again.'));  
        }

    }else{

    	$PageTitle = 'Student Signup | ProTutor';
    	return view("frontend/student_signup",compact('PageTitle'));

    }

}

public function verifyUser(Request $require, $token)
{
	$userData =  User::where('remember_token', $token)->where('user_status', '0')->first();
	if(isset($userData) and $userData!=''){
		$userID = $userData['id'];

		$role = $userData['role'];
		if($role=='3'){

			return redirect ('/tutor-signup/'.$userID)->with('success_msg',__('Email verified successfully now complete the tutor information.'));

		}else{

			User::where('id', $userID)->update(['email_verify' => 1]);
			User::where('id', $userID)->update(['user_status' => 1]);
			return redirect ('/login')->with('success_msg',__('Email Verified Successfully'));
		}

	}else{

		return redirect ('/login')->with('success_msg',__('User Email Already Verified.'));
	}

}

public function tutor_details_page(Request $require, $userid)
{

	if(isset($userid) and $userid!='') {

		$user_status =  User::where('id', $userid)->where('user_status', '1')->first();
		if(isset($user_status) and $user_status!=''){

			return redirect('/login')->with('success_msg', __('Your account is already verified. Please login here'));
		}else{

			$userData =  User::where('id', $userid)->where('user_status', '0')->first();

			if(isset($userData) and $userData!=''){

				$userid = $userData['id'];
				$email = $userData['email'];
				User::where('id', $userid)->update(['email_verify' => 1]);

				$countries =  Countries::all();
				$teaches_levels =  Teaches_level::all();
				$subject =  Subject::all();
				$hourly_rate =  Hourly_rate::all();
				$spoken_languages =  Spoken_language::where('user_status', 1)->get();



				$PageTitle = 'Tutor Signup | ProTutor';
				return view("frontend/tutorsignup",compact('PageTitle','userid','email','countries','teaches_levels','subject','hourly_rate','spoken_languages'));                    
			}else{

				return redirect('/become-a-tutor')->with('error_msg', __('Please signup to become a tutor.'));

			}

		}


	}else{

		return redirect('/become-a-tutor')->with('error_msg', __('Please signup to become a tutor.'));

	}

}

public function login(Request $req)
{   

	if($req->post()){ 


		$req->validate([
			'email' => ['required', 'email'],
			'password' => ['required'],
		]);


		$user = User::where('email',$req->email)->whereIn('role',['3','4'])->first();

		if(isset($user) && !empty($user)){

			if($user->user_status=='0'){

				return redirect('/login')->with('error_msg', __('Your account is not verify. Please contact to support team.'));

			}else{

				if(md5($req->input('password')) == $user->password)
				{
					\Session::flush();
					\Session::put('userid', $user->id);
					\Session::put('userdata', $user);
					\Session::save();
					return redirect('/dashboard')->with('success_msg',__('You are login successfully'));
				}else{
					return redirect('/login')->with('error_msg', __('Please enter the correct password'));
				}

			}

		}else{
			return redirect('/login')->with('error_msg', __('Please enter the correct email.'));
		}

	}else{

		$userid = Session::get('userid');
		if(isset($userid) && $userid!=""){
			return redirect('/dashboard');

		}

		$PageTitle = 'Login | ProTutor';
		return view("frontend/login",compact('PageTitle'));

	}   
}


public function submit_tutor_signup(Request $req)
{ 

	if($req->post()){ 
		$req->validate([
			'first_name' => ['required'],
			'last_name' => ['required'],
			'email' => ['required', 'email'],
			'country' => ['required'], 
			'languages' => ['required'],
			'native_language' => ['required'],
			'level' => ['required'],
			'subject' => ['required'],
			'hourly_rate' => ['required'],
			'desc_first_last' => ['required'],
			'desc_about' => ['required'],
			'your_picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
			'upload_video' => 'required|file|mimetypes:video/mp4',
		]);

		$image = $req->file('your_picture');
		$imageName = time().'_'.$image->getClientOriginalName();  
		$req->your_picture->move(public_path('images'), $imageName);

        //video uplaod 
		$image1 = $req->file('upload_video');
		$imageName1 = time().'_'.$image1->getClientOriginalName();  
		$req->upload_video->move(public_path('videos'), $imageName1);

		$result = Userdetail::create([
			"student_no"=>  $req->userid,
			"first_name"=>  $req->first_name,
			"last_name"=>  $req->last_name,
			"country"=>  $req->country,
			"email"=>  $req->email,
			"phone"=>  $req->phone_number,
			"languages"=> implode(',', $req->languages),
			"native_language"=> $req->native_language,
			"over_18"=>  $req->over_18,
			"level"=>  $req->level,
			"subject"=> implode(',', $req->subject),
			"hourly_rate"=>  $req->hourly_rate,
			"desc_first_last"=>  $req->desc_first_last,
			"desc_about"=>  $req->desc_about,
			"profile_img"=>  $imageName,
			"video_link"=>  $imageName1,
		]);

		$update = array('phone_number'=>$req->phone_number,'first_name'=>$req->first_name,'last_name'=>$req->last_name);

		DB::table('users')->where('id',$req->userid)->update($update);

		$superadmin='1';
		$admin='2';
		$notificationstype = array('superadmin'=>$superadmin,'admin'=>$admin);
		$notifi_notifiable_id=implode(",",$notificationstype);

		$notificationsdata = 'New user ('.$req->email.') has just registered';
		$Notifications = new Notifications();
		$Notifications->viewer_role =$notifi_notifiable_id;
		$Notifications->user_id ='1';
		$Notifications->message_type='NewUserRegisterNotification';
		$Notifications->data=$notificationsdata;
		$Notifications->read_at='0';
		$Notifications->save();

		return redirect('/login')->with('success_msg',__('Congratulations Your form submit successfully. We Wil Review Your Profile For Approval Within The Next 24 Hours.'));



	}

}


public function find_a_tutor(Request $request){

	$PageTitle = 'Find A Tutor | ProTutor';
    //$Spoken_language = Spoken_language::all();
	$Spoken_language =  Spoken_language::where('user_status', 1)->get();
	$subjectAll = Subject::all();
	$rateAll = Hourly_rate::all();
	$countryAll = Countries::all(); 

	if(isset($_REQUEST['subject']) or isset($_REQUEST['hourly_rate']) or isset($_REQUEST['country']) or isset($_REQUEST['user_status']) or isset($_REQUEST['native_language']) or isset($_REQUEST['spoken_language'])) {


		$user_data='SELECT users.id as user_id,users.first_name,users.last_name,users.phone_number,users.role,users.user_status,users.email ,users.email_verify,users.password,userdetails.* FROM `users` LEFT JOIN `userdetails` ON users.id = userdetails.student_no WHERE users.role=3';


		if(isset($_REQUEST['subject']) and $_REQUEST['subject']!=''){
			$user_data .= " and " .'userdetails.subject='.$_REQUEST['subject'];
		}

		if(isset($_REQUEST['hourly_rate']) and $_REQUEST['hourly_rate']!=''){
			$expVal = explode('-', $_REQUEST['hourly_rate']);
			//$user_data .= " and " .'userdetails.hourly_rate IN (SELECT id from hourly_rates WHERE id between '.$expVal[0] .' and '.$expVal[1] .')'. )   ;
			//$user_data .= " and " .'userdetails.hourly_rate between '.$expVal[0] .' and '.$expVal[1] ;
			$user_data .= " and " .'userdetails.hourly_rate IN '.'(SELECT id from hourly_rates WHERE id between '.$expVal[0] .' and '.$expVal[1] .')' ;
		}

		if(isset($_REQUEST['country']) and $_REQUEST['country']!=''){
			$user_data .= " and " .'userdetails.country='.$_REQUEST['country'];
		}

		if(isset($_REQUEST['user_status']) and $_REQUEST['user_status']!=''){
			$user_data .= " and " .'users.user_status='.$_REQUEST['user_status'];
		}

		if(isset($_REQUEST['native_language']) and $_REQUEST['native_language']!=''){
			$user_data .= " and " .'userdetails.native_language='.$_REQUEST['native_language'];
		}

		if(isset($_REQUEST['spoken_language']) and $_REQUEST['spoken_language']!=''){
			$user_data .= " and " .'userdetails.languages='.$_REQUEST['spoken_language'];
		}
		//\DB::enableQueryLog();
		$userdata = DB::select($user_data);
		//dd(\DB::getQueryLog());

		return view("frontend/find_a_tutor",compact('PageTitle','countryAll','rateAll','subjectAll','Spoken_language','userdata'));

	}else{

		$user_status='3';
		$user_data='SELECT users.id as user_id,users.first_name,users.last_name,users.phone_number,users.role,users.user_status,users.email ,users.email_verify,users.password,userdetails.* FROM `users` LEFT JOIN `userdetails` ON users.id = userdetails.student_no WHERE users.role="'.$user_status.'" LIMIT 12';
		$userdata = DB::select($user_data);


		return view("frontend/find_a_tutor",compact('PageTitle','countryAll','rateAll','subjectAll','Spoken_language','userdata'));

	}
}


public function tutor_detail_single_page(Request $request,$tutorid)
{
	
	$PageTitle = 'Tutor Detail | ProTutor';
	$teacher_data=  Userdetail::where('student_no', $tutorid)->get();

	$subjects = Subject::all();
	$languages = Spoken_language::all();
	$country = Countries::all();
	$certificateAll = Certificate::all();
	$hour_rate = Hourly_rate::all();
	$content = Become_a_tutor::where('id',1)->get(); 

	$degree = DB::select('SELECT educations.degree_name, educations.specialization, educations.university_name, educations.year_of_study FROM `educations` join userdetails on educations.userdetail_id = userdetails.student_no
		where userdetails.student_no="'.$tutorid.'";');

	$certificateAll = DB::select('SELECT certifications.year_of_study, certifications.certificate_name, certifications.issued_by FROM `certifications` join userdetails on certifications.userdetail_id = userdetails.student_no
		where userdetails.student_no="'.$tutorid.'";');

	$experience = DB::select('SELECT experiences.period_of_employment, experiences.company_name, experiences.position FROM `experiences` join userdetails on experiences.userdetail_id = userdetails.student_no
		where userdetails.student_no="'.$tutorid.'";');

	if(!empty($experience)){
		$years_of_Exps = [];
		foreach ($experience as $key => $value) {
			$year = explode('-', $value->period_of_employment);
			$years_of_Exps[] = $year[1]- $year[0];
		}

		$years_of_Exp = array_sum($years_of_Exps);

		return view("frontend/tutor_detail_single",compact('PageTitle','teacher_data','subjects','languages','degree','years_of_Exp','country','experience','certificateAll','content','hour_rate'));
	}else{
		$years_of_Exp = 0;
		return view("frontend/tutor_detail_single",compact('PageTitle','teacher_data','subjects','languages','degree','years_of_Exp','country','experience','certificateAll','content','hour_rate'));
	}


}


public function getcalendar_fronted(Request $request,$id)
{
	//$getData = Calendar::where('student_no',$id)->where('status','schedule')->get();
	$getData = Calendar::where('student_no',$id)->get();
        foreach ($getData as $key => $value) {
            $data[] = array(
                'id' => $value["id"],
                'title' => $value["note"],
                'start' => $value["start_date"],
                'end' => $value["end_date"],
                'subject' => $value["subject"],
                'grade' => $value["grade"]
            );
        }
        return json_encode($data);
}



}
