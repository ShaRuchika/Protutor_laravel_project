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
use App\Models\Userdetail;
use App\Models\User;
use App\Models\Notifications;
use App\Models\Subject;
use App\Models\Spoken_language;
use App\Models\Student_testimonial;
use App\Models\Hourly_rate;
use App\Models\Teaches_level;
use App\Models\Homepage;
use App\Models\Become_a_tutor;
use App\Models\Support;
use App\Models\Footer;
use App\Models\Social_platform;
use App\Models\Order;
use App\Models\Discount_Coupon;
use App\Models\Commission_Setting;
use App\Models\Meeting_tool;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    public function login(Request $request)
    {

        $userid = Session::get('admin_userid');
        if(isset($userid) && $userid!=""){
            return redirect('/admin/dashboard');

        }

        $PageTitle = 'Login | ProTutor';
        return view("admin/login",compact('PageTitle'));

    }


    public function index(Request $request)
    {
        $PageTitle = 'dashboard | ProTutor';
        //$notifications = DB::table('notifications')->whereNotIn('read_at',[1])->get();
        
        return view("admin/dashboard",compact('PageTitle'));

    }



    function check_login(Request $req){  

        if($req->post()){ 
            $req->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            $user = User::where('email',$req->email)->whereIn('role',['1','2'])->first();
            if(isset($user) && !empty($user)){

                if($user->user_status=='0'){

                    return redirect('/admin')->with('error_msg', __('Your account is not verify. Please contact to support team.'));

                }else{

                    if(md5($req->input('password')) == $user->password)
                    {
                        \Session::flush();
                        \Session::put('admin_userid', $user->id);
                        \Session::put('admin_userdata', $user);
                        \Session::save();
                        return redirect('/admin/dashboard')->with('success_msg',__('You are login successfully'));
                    }else{
                        return redirect('/admin')->with('error_msg', __('Please enter the correct password'));
                    }
                }

            }else{
                return redirect('/admin')->with('error_msg', __('Please enter the correct email.'));
            }
        }
    }

    public function logout() // This function are used for user logout
    {
        Session::flush();
        return redirect('/admin')->with('success_msg',__('You are successfully logout'));
    }

    public function showForgetPasswordForm(){

        $PageTitle = 'Forget Password | ProTutor';
        return view("admin/forgetpassword",compact('PageTitle'));

    }

    public function submitForgetPasswordForm(Request $request){

       if($request->post()){ 
        $request->validate([
            'email' => ['required', 'email','exists:users'],
        ]);

        $token = mt_rand(100000, 999999);

        \Session::flush();
        \Session::put('forgetpasswordemail', $request->email);
        \Session::put('forgetpasswordtoken', $token);
        \Session::save();

        Mail::send('admin.email.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('OTP Verification');

        });

        return redirect('/forget-pass-confi')->with('success_msg',__('You are login successfully'));

    }  


}

public function forgetpassconfirm(){

    $email = Session::get('forgetpasswordemail');
    $PageTitle = 'Forget Password | ProTutor';
    return view("admin/forgetpassconfirm",compact('PageTitle','email'));

}

public function forgetpassotp(){

    $PageTitle = 'Forget Password | ProTutor';
    return view("admin/forgetpassotp",compact('PageTitle'));

}

public function forgetpassotpsubmit(Request $request){

    $email = Session::get('forgetpasswordemail');
    $token = Session::get('forgetpasswordtoken');

    $data = $request->all();
    $getotp = $data['otpfirst'].$data['otpsecond'].$data['otpthird'].$data['otpfour'].$data['otpfive'].$data['otpsix'];

    if($token==$getotp){

        return redirect('/new-password')->with('success_msg',__('Your OTP is correct'));

    }else{

        return redirect('/forgetpassotp')->with('error_msg', __('Your OTP is incorrect.'));

    }

}


public function newpassword(){

    $PageTitle = 'Forget Password | ProTutor';
    return view("admin/newpass",compact('PageTitle'));

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

public function resetpasswordsuccess(){

    $PageTitle = 'Forget Password | ProTutor';
    return view("admin/resetpasswordsuccess",compact('PageTitle'));

}




public function user_register_by_admin(Request $req)
{ 

    if($req->post()){ 

        $req->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email','unique:users'], 
            'phone_number' => ['required'], 
            'password' => ['required'],
            'dob' => ['required'],
            'gender' => ['required'],
            'role' => ['required'],
        ]);

        

        $user_status='1';
        $email_verify='1';

        $role=$req->role;
       // $remember_token = Str::random(70);

        $user = new User();
        $user->first_name=$req->first_name;
        $user->last_name=$req->last_name;
        $user->email=$req->email;
        $user->phone_number=$req->phone_number;
        $user->role=$role;
        $user->user_status=$user_status;
        $user->email_verify=$email_verify;
        $user->password = md5($req->password);

        if($user->save()){
            $lastId = $user->id;
            $result1 = Userdetail::create([
                "student_no"=>  $lastId,
                "first_name"=>  $req->first_name,
                "last_name"=>  $req->last_name,
                "email"=>  $req->email,
                "phone"=>  $req->phone_number,
                "dob"=>  $req->dob,
                "gender"=>  $req->gender,

            ]);

            $all_data = array('email'=>$req->email,'password'=>$req->password);  
            Mail::send('admin.email.Registrationdetails', ['all_data' => $all_data], function($message) use($req){
                $message->to($req->email);
                $message->subject('Registration Details');

            });       

            return redirect('/admin/adminlist')->with('success_msg',__('Your user created successfully. Registration details sent to user email.'));

        }else{

          return redirect('/admin/adminlist')->with('error_msg',__('Your user no created. Please try again.'));   
      }      



  }

}



//subject
public function subject(){

    $PageTitle = 'subject | ProTutor';
    $subjectAll = new Subject;

    if (isset($_GET['name']) && !empty($_GET['name'])) {
        $subjectAll = $subjectAll->whereRaw('subject like "%'.$_GET['name'].'%"');
    }

    if (isset($_GET['register_from']) && !empty($_GET['register_to'])) {
        $subjectAll =   $subjectAll->where('created_at', '>', $_GET['register_from'])->where('created_at', '<', $_GET['register_to']);
    }

    $params = array('name' => (isset($_GET['name']) ? $_GET['name'] : "" ),'register_from' => (isset($_GET['register_from']) ? $_GET['register_from'] : "" ),'register_to' => (isset($_GET['register_to']) ? $_GET['register_to'] : "" ) );

    $subjectAll = $subjectAll->paginate(10);

    return view("admin/tutormanage/subject",compact('PageTitle','subjectAll','params'));

}

public function create_subject(Request $request){
    if($request->post()){ 
        $request->validate([
            'subject' => ['required'],
        ]);

        $subject = new Subject();
        $subject->subject=$request->subject;

        if($subject->save()) { 
            return redirect("admin/subject")->with('success_msg','User added successfully.');
        } else { 
            return redirect("admin/subject")->with('error_msg',__('failed to add.'));
        }
    } 
    return view("admin/subject"); 
} 

public function get_subject_value(Request $request){

    if($request->post()){  

        return $User = DB::table('subjects')->select('id','subject')->where('id',$request->id)->first(); 
    } 
}

public function update_subject(Request $request){

    if($request->post()){  
        $request->validate([
            'subject' => ['required'],
        ]);

        $result =  DB::table('subjects')->where('id',$request->id)->update(['subject' => $request->subject]);
        return redirect("admin/subject")->with('success_msg','User update successfully.');
    }
    return view("admin/subject"); 
}

public function delete_subject(Request $request, $id){
    $deleteUser = DB::table('subjects')->where('id',$id);

    if($deleteUser->delete()) { 
        return redirect("admin/subject")->with('success_msg','User delete successfully.');
    } else { 
        return redirect("admin/subject")->with('error_msg',__('failed to add.'));
    }
}


//teaches-level
public function teaches_level(){

    $PageTitle = 'Teaches-Level | ProTutor';

    $levelAll = new Teaches_level;

    if (isset($_GET['name']) && !empty($_GET['name'])) {
        $levelAll = $levelAll->whereRaw('teaches_level like "%'.$_GET['name'].'%"');
    }

    if (isset($_GET['register_from']) && !empty($_GET['register_to'])) {
        $levelAll =   $levelAll->where('created_at', '>', $_GET['register_from'])->where('created_at', '<', $_GET['register_to']);
    }

    $params = array('name' => (isset($_GET['name']) ? $_GET['name'] : "" ),'register_from' => (isset($_GET['register_from']) ? $_GET['register_from'] : "" ),'register_to' => (isset($_GET['register_to']) ? $_GET['register_to'] : "" ) );

    $levelAll = $levelAll->paginate(10);

    return view("admin/tutormanage/teaches-level",compact('PageTitle','levelAll','params'));

}

public function create_level(Request $request){
    if($request->post()){ 
        $request->validate([
            'teaches_level' => ['required'],
        ]);

        $teaches_level = new Teaches_level();
        $teaches_level->teaches_level = $request->teaches_level;

        if($teaches_level->save()) { 
            return redirect("admin/teaches_level")->with('success_msg','User added successfully.');
        } else { 
            return redirect("admin/teaches_level")->with('error_msg',__('failed to add.'));
        }
    } 
    return view("admin/teaches_level"); 
} 

public function get_level_value(Request $request){

    if($request->post()){  

        return $User = DB::table('teaches_levels')->select('id','teaches_level')->where('id',$request->id)->first(); 
    } 
}

public function update_level(Request $request){

    if($request->post()){  
        $request->validate([
            'teaches_level' => ['required'],
        ]);

        $result =  DB::table('teaches_levels')->where('id',$request->id)->update(['teaches_level' => $request->teaches_level]);
        return redirect("admin/teaches_level")->with('success_msg','User update successfully.');
    }
    return view("admin/teaches_level"); 
}

public function delete_level(Request $request, $id){
    $deleteUser = DB::table('teaches_levels')->where('id',$id);

    if($deleteUser->delete()) { 
        return redirect("admin/teaches_level")->with('success_msg','User delete successfully.');
    } else { 
        return redirect("admin/teaches_level")->with('error_msg',__('failed to add.'));
    }
}


//hourly-rate
public function hourly_rate(){

    $PageTitle = 'Hourly Rate | ProTutor';
    $rateAll = new Hourly_rate;

    if (isset($_GET['name']) && !empty($_GET['name'])) {
        $rateAll = $rateAll->whereRaw('hourly_rate like "%'.$_GET['name'].'%"');
    }

    if (isset($_GET['register_from']) && !empty($_GET['register_to'])) {
        $rateAll =   $rateAll->where('created_at', '>', $_GET['register_from'])->where('created_at', '<', $_GET['register_to']);
    }

    $params = array('name' => (isset($_GET['name']) ? $_GET['name'] : "" ),'register_from' => (isset($_GET['register_from']) ? $_GET['register_from'] : "" ),'register_to' => (isset($_GET['register_to']) ? $_GET['register_to'] : "" ) );

    $rateAll = $rateAll->paginate(10);


    return view("admin/tutormanage/hourly-rate",compact('PageTitle','rateAll','params'));
}

public function create_rate(Request $request){
    if($request->post()){ 
        $request->validate([
            'hourly_rate' => ['required'],
        ]);

        $hourly_rate = new Hourly_rate;
        $hourly_rate->hourly_rate = $request->hourly_rate;

        if($hourly_rate->save()) { 
            return redirect("admin/hourly_rate")->with('success_msg','User added successfully.');
        } else { 
            return redirect("admin/hourly_rate")->with('error_msg',__('failed to add.'));
        }
    } 
    return view("admin/hourly_rate"); 
} 

public function get_rate(Request $request){

    if($request->post()){  

        return $User = DB::table('hourly_rates')->select('id','hourly_rate')->where('id',$request->id)->first(); 
    } 
}

public function update_rate(Request $request){

    if($request->post()){  
        $request->validate([
            'hourly_rate' => ['required'],
        ]);

        $result =  DB::table('hourly_rates')->where('id',$request->id)->update(['hourly_rate' => $request->hourly_rate]);
        return redirect("admin/hourly_rate")->with('success_msg','User update successfully.');
    }
    return view("admin/hourly_rate"); 
}

public function delete_rate(Request $request, $id){
    $deleteUser = DB::table('hourly_rates')->where('id',$id);

    if($deleteUser->delete()) { 
        return redirect("admin/hourly_rate")->with('success_msg','User delete successfully.');
    } else { 
        return redirect("admin/hourly_rate")->with('error_msg',__('failed to add.'));
    }
}


//spoken Language
public function Spoken_language(){

    $PageTitle = 'Spoken Language | ProTutor';

    $languageAll = new Spoken_language;

    if (isset($_GET['name']) && !empty($_GET['name'])) {
        $languageAll = $languageAll->whereRaw('spoken_language like "%'.$_GET['name'].'%"');
    }

    if (isset($_GET['status']) && $_GET['status'] !="") {
        $languageAll = $languageAll->where('user_status',$_GET['status']);
    }

    if (isset($_GET['register_from']) && !empty($_GET['register_to'])) {
        $languageAll =   $languageAll->where('created_at', '>', $_GET['register_from'])->where('created_at', '<', $_GET['register_to']);
    }

    $params = array('name' => (isset($_GET['name']) ? $_GET['name'] : "" ),'register_from' => (isset($_GET['register_from']) ? $_GET['register_from'] : "" ),'register_to' => (isset($_GET['register_to']) ? $_GET['register_to'] : "" ) );

    $languageAll = $languageAll->paginate(10);

    return view("admin/tutormanage/spoken-language",compact('PageTitle','languageAll','params'));
}

public function create_spoken_language(Request $request){
    if($request->post()){ 
        $request->validate([
            'spoken_language' => ['required'],
        ]);

        $user_status='1';
        $spoken_language = new spoken_language;
        $spoken_language->spoken_language = $request->spoken_language;
        $spoken_language->user_status=$user_status;

        if($spoken_language->save()) { 
            return redirect("admin/spoken_language")->with('success_msg','User added successfully.');
        } else { 
            return redirect("admin/spoken_language")->with('error_msg',__('failed to add.'));
        }
    } 
    return view("admin/spoken_language"); 
} 

public function get_spoken_language(Request $request){

    if($request->post()){  

        return $User = DB::table('spoken_languages')->select('id','spoken_language')->where('id',$request->id)->first(); 
    } 
}

public function language_status_update(Request $request){

    $id = $request->id;
    $status = $request->status;
    $user = DB::table('spoken_languages')->select('user_status')->where('id',$id)->first();


    if($user->user_status == '1'){
        $status = '0';
    }else{
        $status = '1';
    }
/*return response()->json(array('msg'=> $status), 200);
die();*/
$update = array('user_status'=>$status);
DB::table('spoken_languages')->where('id',$id)->update($update);

$msg = "Status is updated";
return response()->json(array('msg'=> $msg), 200);
die();

}

public function update_spoken_language(Request $request){

    if($request->post()){  
        $request->validate([
            'spoken_language' => ['required'],
        ]);

        $result =  DB::table('spoken_languages')->where('id',$request->id)->update(['spoken_language' => $request->spoken_language]);
        return redirect("admin/spoken_language")->with('success_msg','User update successfully.');
    }
    return view("admin/spoken_language"); 
}

public function delete_language(Request $request, $id){
    $deleteUser = DB::table('spoken_languages')->where('id',$id);

    if($deleteUser->delete()) { 
        return redirect("admin/spoken_language")->with('success_msg','User delete successfully.');
    } else { 
        return redirect("admin/spoken_language")->with('error_msg',__('failed to add.'));
    }
}

public function markNotification(Request $request)
{    
    $userid = Session::get('admin_userid');   
    if($request->input('id')=='all'){
        $read_at=1;
        $result =  DB::table('notifications')->where('user_id',$userid)->update(['read_at' => $read_at]);

        //$notifications1 = DB::table('notifications')->whereIn('viewer_role',[1,2])->whereNotIn('read_at',[1])->get();

        $notifications1 = DB::table('notifications')->whereNotIn('read_at',[1])->where('user_id',$userid)->get(); 
        return $notifications= $notifications1->count();
    }else{

        
        $id = $request->input('id');
        if(isset($id) and $id!=''){
            $read_at=1;
            $result =  DB::table('notifications')->where('id',$id)->update(['read_at' => $read_at]);

            //$notifications1 = DB::table('notifications')->whereIn('viewer_role',[1,2])->whereNotIn('read_at',[1])->get(); 

            $notifications1 = DB::table('notifications')->whereNotIn('read_at',[1])->where('user_id',$userid)->get();
            return $notifications= $notifications1->count();
        }
        
    }

    die(); 
}

//student-testimonials
public function student_testimonials(Request $request){

    $PageTitle = 'Student Testimonials | ProTutor';

    $Alltestimonial = new Student_testimonial;

    if (isset($_GET['name']) && !empty($_GET['name'])) {
        $languageAll = $Alltestimonial->whereRaw('student_name like "%'.$_GET['name'].'%"');
    }

    if (isset($_GET['status']) && $_GET['status'] !="") {
        $Alltestimonial = $Alltestimonial->where('user_status',$_GET['status']);
    }

    if (isset($_GET['register_from']) && !empty($_GET['register_to'])) {
        $Alltestimonial =   $Alltestimonial->where('created_at', '>', $_GET['register_from'])->where('created_at', '<', $_GET['register_to']);
    }

    $params = array('name' => (isset($_GET['name']) ? $_GET['name'] : "" ),'register_from' => (isset($_GET['register_from']) ? $_GET['register_from'] : "" ),'register_to' => (isset($_GET['register_to']) ? $_GET['register_to'] : "" ) );

    $Alltestimonial = $Alltestimonial->paginate(10);

    return view("admin/studenttestimonials/student_testimonial_view",compact('PageTitle','Alltestimonial','params'));
}

public function create_testimonial(Request $request){


    if($request->post()){ 

        /*$request->validate([
            'name' => ['required'],
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);*/


        if(isset($request->image)){
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();  
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName='';
        }

        if(!isset($request->name)){
            $request->name='';
        }

        if(!isset($request->description)){
            $request->description='';
        }

        $user_status='1';
        $Student_testimonial = new Student_testimonial;
        $Student_testimonial->student_name = $request->name;
        $Student_testimonial->student_rating = $request->star_rating;
        $Student_testimonial->student_desc = $request->description;
        $Student_testimonial->student_image = $imageName;
        $Student_testimonial->user_status=$user_status;

        if($Student_testimonial->save()) { 
            return redirect("admin/student-testimonials")->with('success_msg','Student Testimonial added successfully.');
        }else{ 
            return redirect("admin/student-testimonials")->with('error_msg',__('failed to add.'));
        }
    }

    return view("admin/student-testimonials"); 
}

public function testimonial_status_update(Request $request){

    $id = $request->id;
    $status = $request->status;
    $user = DB::table('student_testimonial')->select('user_status')->where('id',$id)->first();

    if($user->user_status == '1'){
        $status = '0';
    }else{
        $status = '1';
    }
    /*return response()->json(array('msg'=> $status), 200);
    die();*/
    $update = array('user_status'=>$status);
    DB::table('student_testimonial')->where('id',$id)->update($update);

    $msg = "Status is updated";
    return response()->json(array('msg'=> $msg), 200);
    die();

}

public function testimonial_delete(Request $request, $id){
    $deleteUser = DB::table('student_testimonial')->where('id',$id);

    if($deleteUser->delete()) { 
        return redirect("admin/student-testimonials")->with('success_msg','Student Testimonial delete successfully.');
    } else { 
        return redirect("admin/student-testimonials")->with('error_msg',__('failed to add.'));
    }
}

public function edit_testimonial(Request $request){

    if($request->post()){  

        $User = DB::table('student_testimonial')->select('*')->where('id',$request->id)->first(); 



        if($User->student_rating=='1'){
            $select1='selected'; 
        }elseif($User->student_rating=='2'){
            $select2='selected'; 
        }elseif($User->student_rating=='3'){
            $select3='selected'; 
        }elseif($User->student_rating=='4'){
            $select4='selected'; 
        }else{
            $select5='selected'; 
        }
        
        if(!isset($select1) and empty($select1)){
            $select1='';
        }
        if(!isset($select2) and empty($select2)){
            $select2='';
        } 
        if(!isset($select3) and empty($select3)){
            $select3='';
        } 
        if(!isset($select4) and empty($select4)){
            $select4='';
        } 
        if(!isset($select5) and empty($select5)){
            $select5='';
        } 

        $student_image = url('/').'/public/images/'.$User->student_image;

        echo $form_data = '<div class="modal-body ps-5 pe-5">
        <div class="inp-outer">
        <label for="">Student Name</label>
        <input class="input" type="text" value="'.$User->student_name.'" name="name" placeholder="">
        <input type="hidden" value="'.$User->id.'" name="id" >
        </div>
        <div class="inp-outer">
        <label for="">Star Rating</label>
        <select class="input" name="star_rating" id="">
        <option value="1" '.$select1.'>1</option>
        <option value="2" '.$select2.'>2</option>
        <option value="3" '.$select3.'>3</option>
        <option value="4" '.$select4.'>4</option>
        <option value="5" '.$select5.'>5</option>
        </select>
        </div>
        <div class="inp-outer">
        <label for="">Description</label>
        <textarea rows="5" cols="25" name="description">'.$User->student_desc.'</textarea>
        </div>

        <div class="inp-outer">
        <label for="">Image</label>
        <input type="file" name="image">
        <img src="'.$student_image.'" alt="Not Image" width="100" height="100"> 
        <input type="hidden" value="'.$User->student_image.'" name="student_image1" >
        </div>

        <div class="modal-btn-group">
        <button class="site-link sm" data-bs-dismiss="modal" type="submit">Save</button>
        </div>
        </div>'; 

    } 
}

public function update_testimonial(Request $request){

    if($request->post()){ 

        /*$request->validate([
            'name' => ['required'],
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);*/


        if(isset($request->image) and !empty($request->image)){
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();  
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName=$request->student_image1;
        }

        if(!isset($request->name)){
            $request->name='';
        }

        if(!isset($request->description)){
            $request->description='';
        }

        $result =  DB::table('student_testimonial')->where('id',$request->id)->update(['student_name' => $request->name,'student_rating' => $request->star_rating,'student_desc' => $request->description,'student_image' => $imageName]);
        return redirect("admin/student-testimonials")->with('success_msg','Student Testimonials update successfully.');

    }

    return view("admin/student-testimonials"); 
    
}

public function edit_homepage(Request $request,$homepage_id)
{   
 $Homepagedata = Homepage::where('id',$homepage_id)->get();

 $PageTitle = 'Edit Homepage | ProTutor';
 return view("admin/edit_homepage",compact('PageTitle','Homepagedata'));

}

public function update_homepage(Request $request,$homepage_id)
{     


    $sec3_data =[];
    $descriptions = $request->description;
    foreach ($request->title as $key => $title) {

        if(isset($request->icon[$key])){
            $image = $request->file('icon');
            $imageName3 = time().'_'.$image[$key]->getClientOriginalName();  
            $request->icon[$key]->move(public_path('images'), $imageName3);
        }else{
            $imageName3=$request->hidden_icon_file[$key];
        }

        $sec3_data[]= [
            'icon' => $imageName3,
            'title' => $title,
            'description' => $descriptions[$key]
        ];
    }

    $collection = collect($sec3_data);
    $collection->implode('title', ', ');
    $collection->implode('description', ', ');


    if(isset($request->sec2_part1_file)){
        $image = $request->file('sec2_part1_file');
        $imageName = time().'_'.$image->getClientOriginalName();  
        $request->sec2_part1_file->move(public_path('images'), $imageName);
    }else{
        $imageName=$request->hidden_sec2_part1_file;
    }

    if(isset($request->sec2_part2_file)){
        $image = $request->file('sec2_part2_file');
        $imageName1 = time().'_'.$image->getClientOriginalName();  
        $request->sec2_part2_file->move(public_path('images'), $imageName1);
    }else{
        $imageName1=$request->hidden_sec2_part2_file;
    }

    if(isset($request->sec9_file)){
        $image = $request->file('sec9_file');
        $imageName2 = time().'_'.$image->getClientOriginalName();  
        $request->sec9_file->move(public_path('images'), $imageName2);
    }else{
        $imageName2=$request->hidden_sec9_file;
    }

    $profile = Homepage::where('id', $homepage_id)->update([
        'sec_1_heading' =>$request->sec_1_heading,
        'sec_1_subheading' => implode(',',$request->sec_1_subheading),
        'sec_1_dec' => $request->sec_1_dec,
        'sec2_main_heading' => $request->sec2_main_heading,
        'sec2_part1_file' => $imageName,
        'sec2_part1_heading' => $request->sec2_part1_heading,
        'sec2_part1_url' => $request->sec2_part1_url,
        'sec2_part1_desc' => $request->sec2_part1_desc,
        'sec2_part2_heading' => $request->sec2_part2_heading,
        'sec2_part2_url' => $request->sec2_part2_url,
        'sec2_part2_desc' => $request->sec2_part2_desc,
        'sec2_part2_file' => $imageName1,
        'sec4_main_heading' => $request->sec4_main_heading,
        'sec3_data' => $sec3_data,
        'sec4_part1_heading' => $request->sec4_part1_heading,
        'sec4_part1_url' => $request->sec4_part1_url,
        'sec4_part1_desc' => $request->sec4_part1_desc,
        'sec4_part2_heading' => $request->sec4_part2_heading,
        'sec4_part2_url' => $request->sec4_part2_url,
        'sec4_part2_desc' => $request->sec4_part2_desc,
        'sec7_youtube_url' => $request->sec7_youtube_url,
        'sec7_heading' => $request->sec7_heading,
        'sec7_sub_heading1' => $request->sec7_sub_heading1,
        'sec7_sub_heading2' => $request->sec7_sub_heading2,
        'sec7_sub_heading3' => $request->sec7_sub_heading3,
        'sec7_desc' => $request->sec7_desc,
        'sec9_file' => $imageName2,
        'sec9_heading' => $request->sec9_heading,
        'sec9_play_store_url' => $request->sec9_play_store_url,
        'sec9_apple_store_url' => $request->sec9_apple_store_url,
        'sec9_desc' => $request->sec9_desc

    ]);


    $PageTitle = 'Edit Homepage | ProTutor';
    return redirect("admin/edit-homepage/1")->with('success_msg','Homepage update successfully.');

}

public function edit_become_a_tutor(){
  $Homepagedata =  Become_a_tutor::where('id', 1)->get();
  $PageTitle = 'Edit-Become-A-Tutor | ProTutor';
  return view("admin/add_content",compact('PageTitle','Homepagedata')); 

}

public function save_content(Request $request){

    if($request->post()){   
        $sec1_data =[];
        $descriptions = $request->description1;
        foreach ($request->title1 as $key => $title) {

            if(isset($request->icon[$key]) and !empty($request->icon[$key])){
                $image = $request->file('icon');
                $imageName1 = time().'_'.$image[$key]->getClientOriginalName();  
                $request->icon[$key]->move(public_path('images'), $imageName1);
            }else{
                $imageName1=$request->hidden_icon_file1[$key];
            }

            $sec1_data[]= [
                'icon' => $imageName1,
                'title' => $title,
                'description' => $descriptions[$key]
            ];
        }
        $collection1 = collect($sec1_data);
        $collection1->implode('title', ', ');
        $collection1->implode('description', ', ');

//sec2

        if(isset($request->image)){
            $image = $request->file('image');
            $imageName2 = time().'_'.$image->getClientOriginalName();  
            $request->image->move(public_path('images'), $imageName2);
        }else{
            $imageName2=$request->hidden_icon_file;
        }
        /*print_r($imageName2); die;*/
        if(!isset($request->main_title)){
            $request->main_title='';
        }
        if(!isset($request->content)){
            $request->content='';
        }
        if(!isset($request->url)){
            $request->url='';
        }

        $sec2_data =[];
        $descriptions = $request->description2;
        foreach ($request->title2 as $key => $title) {

            $sec2_data[]= [
                'title' => $title,
                'description' => $descriptions[$key]
            ];
        }
        $collection2 = collect($sec2_data);
        $collection2->implode('title', ', ');
        $collection2->implode('description', ', ');

//sec3

        $sec3_data =[];
        $descriptions = $request->description3;
        foreach ($request->title3 as $key => $title) {

            $sec3_data[]= [
                'title' => $title,
                'description' => $descriptions[$key]
            ];
        }
        $collection3 = collect($sec3_data);
        $collection3->implode('title', ', ');
        $collection3->implode('description', ', ');

//sec4

        if(isset($request->bg_img)){
            $image = $request->file('bg_img');
            $imageName4 = time().'_'.$image->getClientOriginalName();  
            $request->bg_img->move(public_path('images'), $imageName4);
        }else{
            $imageName4=$request->hidden_bg_img;
        }
        if(!isset($request->title4)){
            $request->title4='';
        }
        if(!isset($request->description4)){
            $request->description4='';
        }
        if(!isset($request->url4)){
            $request->url4='';
        }

//sec5

        if(isset($request->bck_img)){
            $image = $request->file('bck_img');
            $imageName5 = time().'_'.$image->getClientOriginalName();  
            $request->bck_img->move(public_path('images'), $imageName5);
        }else{
            $imageName5=$request->hidden_bck_img;
        }
        if(!isset($request->title5)){
            $request->title5='';
        }
        if(!isset($request->description5)){
            $request->description5='';
        }
        if(!isset($request->playstore)){
            $request->playstore='';
        }
        if(!isset($request->applestore)){
            $request->applestore='';
        }

        $profile = Become_a_tutor::where('id', 1)->update([
            'sec_data1' => $sec1_data ,
            'img_sec2' => $imageName2,
            'main_title_sec2' => $request->main_title,
            'sec_data2' => $sec2_data ,
            'content_sec2' => $request->content,
            'url_sec2' => $request->url,
            'sec_data3' => $sec3_data ,
            'sec4_title' =>  $request->title4 ,
            'sec4_desc' =>  $request->description4 ,
            'sec4_url' =>  $request->url4 ,
            'sec4_img' =>  $imageName4 ,
            'sec5_file' =>  $imageName5 ,
            'sec5_heading' =>  $request->title5 ,
            'sec5_desc' =>  $request->description5 ,
            'sec5_play_store_url' =>  $request->playstore ,
            'sec5_apple_store_url' =>  $request->applestore ,
        ]); 
        return redirect("admin/edit-become-a-tutor")->with('success_msg','Content update successfully.');    
    }
    return redirect("admin/edit-become-a-tutor"); 
}

public function update_support_content(){
    $Supportdata =  Support::where('id', 1)->get();
    $PageTitle = 'Update Support | ProTutor';
    return view("admin/support",compact('PageTitle','Supportdata')); 
}

public function save_support_content(Request $request){

   if($request->post()){   
    //sec1
    $support_data1 =[];
    $supp_desc1 = $request->description_sup1;
    $supp_url1 = $request->url_sup1;
    foreach ($request->title_sup1 as $key => $title_val1) {

        $support_data1[]= [
            'title' => $title_val1,
            'description' => $supp_desc1[$key],
            'url' => $supp_url1[$key]
        ];
    }
    $sup_coll1 = collect($support_data1);
    $sup_coll1->implode('title', ', ');
    $sup_coll1->implode('description', ', ');
    $sup_coll1->implode('url', ', ');

    //sec2
    $support_data2 =[];
    $supp_desc2 = $request->description_sup2;
    foreach ($request->title_sup2 as $key => $title_val2) {

        $support_data2[]= [
            'title' => $title_val2,
            'description' => $supp_desc2[$key],
        ];
    }
    $sup_coll2 = collect($support_data2);
    $sup_coll2->implode('title', ', ');
    $sup_coll2->implode('description', ', ');

    $content = Support::where('id', 1)->update([
        'support_sec1' => $support_data1,
        'support_sec2' => $support_data2
    ]); 
    return redirect("admin/update_support")->with('success_msg','Content update successfully.');    
}
return redirect("admin/update_support"); 
}

public function update_footer_content(){

  $Footerdata =  Footer::where('id', 1)->first();
  $PageTitle = 'Update Support | ProTutor';
  return view("admin/footer_data",compact('PageTitle','Footerdata')); 
}

public function save_footer_content(Request $request){

 if($request->post()){   
    if(isset($request->icon)){
        $image = $request->file('icon');
        $imageName = time().'_'.$image->getClientOriginalName();  
        $request->icon->move(public_path('images'), $imageName);
    }else{
        $imageName=$request->hidden_icon;
    }
    if(!isset($request->f_title)){
        $request->f_title='';
    }
    if(!isset($request->f_mail)){
        $request->f_mail='';
    }
    if(!isset($request->f_contact)){
        $request->f_contact='';
    }
    if(!isset($request->f_copyright)){
        $request->f_copyright='';
    }
    if(!isset($request->f_desc1)){
        $request->f_desc1='';
    }
    if(!isset($request->f_desc2)){
        $request->f_desc2='';
    }


    $footer_content = Footer::where('id', 1)->update([
        'icon' => $imageName,
        'title' => $request->f_title,
        'email' => $request->f_mail,
        'contact' => $request->f_contact,
        'copyright' => $request->f_copyright,
        'desc1' => $request->f_desc1,
        'desc2' => $request->f_desc2,
    ]); 
    return redirect("admin/update_footer")->with('success_msg','Content update successfully.');    
}
return redirect("admin/update_footer"); 
}

public function social_platforms(){
    $PageTitle = 'Social Platforms | ProTutor';
    $platformAll = new Social_platform;
    $platformAll = $platformAll->paginate(10);
    return view("admin/setting/social_platforms",compact('PageTitle','platformAll')); 
}

public function create_platform(Request $request){
    if($request->post()){ 
        $request->validate([
            'create_identifier' => ['required'],
            'create_link' => ['required'],
        ]);

        $user_status='1';
        $social_platforms = new Social_platform;
        $social_platforms->title = $request->create_identifier;
        $social_platforms->url = $request->create_link;
        $social_platforms->user_status = $user_status;

        if($social_platforms->save()) { 
            return redirect("admin/social_platforms")->with('success_msg','User added successfully.');
        } else { 
            return redirect("admin/social_platforms")->with('error_msg',__('failed to add.'));
        }
    } 
    return view("admin/social_platforms"); 
}

public function get_platform(Request $request){
    if($request->post()){  
        return $User = DB::table('social_media_platform')->select('id','title','url')->where('id',$request->id)->first(); 
    } 
}

public function edit_platform(Request $request){
   if($request->post()){  
    $request->validate([
        'title' => ['required'],
        'url' => ['required'],
    ]);

    $result =  DB::table('social_media_platform')->where('id',$request->id)->update(['title' => $request->title,'url' => $request->url]);
    return redirect("admin/social_platforms")->with('success_msg','User update successfully.');
}
return view("admin/social_platforms",compact('result')); 
}

public function platform_status_update(Request $request){
    $id = $request->id;
    $status = $request->status;
    $user = DB::table('social_media_platform')->select('user_status')->where('id',$id)->first();

    if($user->user_status == '1'){
        $status = '0';
    }else{
        $status = '1';
    }

    $update = array('user_status'=>$status);
    DB::table('social_media_platform')->where('id',$id)->update($update);

    $msg = "Status is updated";
    return response()->json(array('msg'=> $msg), 200);
    die();

}

public function delete_platform(Request $request, $id){
    $deleteUser = DB::table('social_media_platform')->where('id',$id);

    if($deleteUser->delete()) { 
        return redirect("admin/social_platforms")->with('success_msg','User delete successfully.');
    } else { 
        return redirect("admin/social_platforms")->with('error_msg',__('failed to add.'));
    }
}


public function all_orders(){
    $PageTitle = 'All Orders | ProTutor';

    $user_data='SELECT  `order`.* ,concat(`users`.`first_name`," ", `users`.`last_name`) as name FROM `order` LEFT JOIN `users` ON `order`.user_id = `users`.id where 1';


    if (isset($_GET['name']) && !empty($_GET['name'])) {
        $user_data .= " and " .'concat(`users`.`first_name`," ", `users`.`last_name`) like "%'.$_GET['name'].'%"';
        
    } 
    /* echo "<pre>";
        print_r($_GET['name']); die; */    

    if (isset($_GET['status']) && $_GET['status'] !="") { 
        $user_data .= " and " .'status='.$_GET['status'];
    }

    if (isset($_GET['order_type']) && $_GET['order_type'] !="") {
         $user_data .= " and " .'order_type="'.$_GET['order_type'] .'"'; 
    }
    if (isset($_GET['register_from']) && !empty($_GET['register_to'])) {

        $user_data .= " and " .'created_at >'.$_GET['register_from'].' and created_at > '.$_GET['register_to']; 

    }

    $params = array('name' => (isset($_GET['name']) ? $_GET['name'] : "" ),'order_type' => (isset($_GET['order_type']) ? $_GET['order_type'] : "" ),'status' => (isset($_GET['status']) ? $_GET['status'] : "" ),'register_from' => (isset($_GET['register_from']) ? $_GET['register_from'] : "" ),'register_to' => (isset($_GET['register_to']) ? $_GET['register_to'] : "" ));

    $All_lesson = DB::Select($user_data);

    return view("admin/manageorder/all_orders",compact('PageTitle','All_lesson','params')); 
}

public function lesson_orders(){
    $PageTitle = 'Lesson Orders | ProTutor';
    $user_data1='SELECT  `order`.* ,concat(`users`.`first_name`," ", `users`.`last_name`) as name FROM `order` LEFT JOIN `users` ON `order`.user_id = `users`.id where order_type = "lesson"';


    if (isset($_GET['name']) && !empty($_GET['name'])) {
        $user_data1 .= " and " .'concat(`users`.`first_name`," ", `users`.`last_name`) like "%'.$_GET['name'].'%"';
        
    } 

    if (isset($_GET['status']) && $_GET['status'] !="") { 
        $user_data1 .= " and " .'status='.$_GET['status'];
    }
    if (isset($_GET['register_from']) && !empty($_GET['register_to'])) {

        $user_data1 .= " and " .'created_at >'.$_GET['register_from'].' and created_at > '.$_GET['register_to']; 

    }

    $params = array('name' => (isset($_GET['name']) ? $_GET['name'] : "" ),'order_type' => (isset($_GET['order_type']) ? $_GET['order_type'] : "" ),'status' => (isset($_GET['status']) ? $_GET['status'] : "" ),'register_from' => (isset($_GET['register_from']) ? $_GET['register_from'] : "" ),'register_to' => (isset($_GET['register_to']) ? $_GET['register_to'] : "" ));

    $lesson_orders = DB::Select($user_data1);

    return view("admin/manageorder/lesson_orders",compact('PageTitle','lesson_orders','params')); 
}

//Admin controller
public function order_details($id){
    $PageTitle = 'Order Details | ProTutor';

    $orders = Order::where('id', $id)->first();

    $user_detail = 'SELECT  `order`.* , `userdetails`.* FROM `order` JOIN `userdetails` ON `order`.user_id = `userdetails`.student_no where `order`.id = "'.$id.'"';
    $users = DB::Select($user_detail);

    $teacher_detail = 'SELECT  `order`.* , `userdetails`.* FROM `order` JOIN `userdetails` ON `order`.teacher_id = `userdetails`.student_no where `order`.id = "'.$id.'"';
    $teachers = DB::Select($teacher_detail);
    $subjects = DB::table('subjects')->get();

    return view("admin/manageorder/order_details",compact('PageTitle','orders','users','teachers','subjects')); 
}



public function meeting_tools(){
    $PageTitle = 'Meeting Tools | ProTutor';
    $ToolsAll = DB::table('meeting_tools')->select('*')->get();
    return view("admin/setting/meeting_tools",compact('PageTitle','ToolsAll')); 
}

public function get_tools(Request $request){
    if($request->post()){  
        return $Tools = DB::table('meeting_tools')->select('*')->where('id',$request->id)->first(); 
    } 
}

public function edit_tools(Request $request){
   if($request->post()){  
    $request->validate([
        'code' => ['required'],
        'api_key' => ['required'],
        'api_id' => ['required'],
        'api_script' => ['required'],
    ]);

    $result = DB::table('meeting_tools')->where('id',$request->id)->update(['code' => $request->code,'api_key' => $request->api_key,'api_id' => $request->api_id,'api_script' => $request->api_script]);

    return redirect("admin/meeting_tools")->with('success_msg','User update successfully.');
}
return view("admin/meeting_tools",compact('result')); 
}

/*commission-settings*/

public function commission_setting(){
    $PageTitle = 'Commission Setting | ProTutor';
    $commissionType = DB::table('commission_settings')->select('*')->get();
    return view("admin/setting/commission_settings",compact('PageTitle','commissionType')); 
}

public function get_commission(Request $request){
    if($request->post()){  
        return DB::table('commission_settings')->select('*')->where('id',$request->id)->first(); 
    } 
}

public function edit_commission(Request $request){
   if($request->post()){  
    $request->validate([
        'transaction_type' => ['required'],
        'lesson_fees' => ['required'],
        'class_fees' => ['required'],
    ]);

    $result = DB::table('commission_settings')->where('id',$request->id)->update(['transaction_type' => $request->transaction_type,'lesson_fees' => $request->lesson_fees,'class_fees' => $request->class_fees]);

    return redirect("admin/commission_settings")->with('success_msg','User update successfully.');
}
return view("admin/commission_settings",compact('result')); 
}

/*discount-coupons*/
public function discount_coupon(){
 $PageTitle = 'Discount Coupons | ProTutor';
 /*$Discount_coupons = DB::table('discount_coupons')->get();*/
 $Discount_coupons = new Discount_coupon;

 if (isset($_GET['identifer']) && !empty($_GET['identifer'])) {
    $Discount_coupons = $Discount_coupons->where('coupon_identifier',$_GET['identifer']);
}
if (isset($_GET['starts_from']) && !empty($_GET['ends_to'])) {
    $Discount_coupons =   $Discount_coupons->where('start_date', '>', $_GET['starts_from'])->where('end_date', '<', $_GET['ends_to']);
}
if (isset($_GET['status']) && $_GET['status'] !="") {
    $Discount_coupons =    $Discount_coupons->where('user_status',$_GET['status']);
}

$params = array('identifer' => (isset($_GET['identifer']) ? $_GET['identifer'] : "" ),'status' => (isset($_GET['status']) ? $_GET['status'] : "" ),'starts_from' => (isset($_GET['starts_from']) ? $_GET['starts_from'] : "" ),'ends_to' => (isset($_GET['ends_to']) ? $_GET['ends_to'] : "" ) );

/*$Discount_coupons =   $Discount_coupons->whereNotIn('role',[1,2]);*/

$Discount_coupons = $Discount_coupons->paginate(10);


return view("admin/setting/discount_coupons",compact('PageTitle','Discount_coupons','params')); 
}

public function create_coupon(Request $request){

    if($request->post()){ 
        $request->validate([
            'identifier' => ['required'],
            'code' => ['required'],
            'discount' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ]);

        $user_status='0';
        $coupon = new Discount_Coupon;
        $coupon->coupon_identifier = $request->identifier;
        $coupon->coupon_code = $request->code;
        $coupon->discount = $request->discount;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->user_status = $user_status;

        if($coupon->save()) { 
            return redirect("admin/discount_coupon")->with('success_msg','Coupon added successfully.');
        } else { 
            return redirect("admin/discount_coupon")->with('error_msg',__('failed to add.'));
        }
    } 
}

public function get_coupon(Request $request){
    if($request->post()){  
        return $User = DB::table('discount_coupons')->where('id',$request->id)->first(); 
    } 
}

public function edit_coupon(Request $request){
   if($request->post()){  
    $request->validate([
        'identifier' => ['required'],
        'code' => ['required'],
        'discount' => ['required'],
        'start_date' => ['required'],
        'end_date' => ['required'],
    ]);

    $result =  DB::table('discount_coupons')->where('id',$request->id)->update(['coupon_identifier' => $request->identifier,'coupon_code' => $request->code,'discount' => $request->discount,'start_date' => $request->start_date,'end_date' => $request->end_date]);
    return redirect("admin/discount_coupon")->with('success_msg','coupon update successfully.');
}
return view("admin/discount_coupon",compact('result')); 
}

public function coupon_status_update(Request $request){
    $id = $request->id;
    $status = $request->status;
    $user = DB::table('discount_coupons')->select('user_status')->where('id',$id)->first();

    if($user->user_status == '1'){
        $status = '0';
    }else{
        $status = '1';
    }

    $update = array('user_status'=>$status);
    DB::table('discount_coupons')->where('id',$id)->update($update);

    $msg = "Status is updated";
    return response()->json(array('msg'=> $msg), 200);
    die();
}

public function delete_coupon(Request $request, $id){
    $deleteUser = DB::table('discount_coupons')->where('id',$id);

    if($deleteUser->delete()) { 
        return redirect("admin/discount_coupon")->with('success_msg','Coupon delete successfully.');
    } else { 
        return redirect("admin/discount_coupon")->with('error_msg',__('failed to add.'));
    }
}




}
