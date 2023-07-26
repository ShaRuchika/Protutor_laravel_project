<?php

namespace App\Http\Controllers\Dashboard;

use App\Library\Zoom_Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB; 
use App\Models\User;
use App\Models\Countries;
use App\Models\Subject;
use App\Models\Userdetail;
use App\Models\Education;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Identification;
use App\Models\Spoken_language;
use App\Models\Student_testimonial;
use App\Models\Teaches_level;
use App\Models\Hourly_rate;
use App\Models\Notifications;
use App\Models\Support;
use App\Models\Calendar;
use App\Models\Order;

use Carbon\Carbon;
use Mail;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $PageTitle = 'Dashboard | ProTutor';
        return view("dashboard/dashboard",compact('PageTitle'));

    }

    public function logout() // This function are used for user logout
    {
        Session::flush();
        return redirect('/')->with('success_msg',__('You are successfully logout'));
    }

    public function profileUpdate(Request $request,$id =NULL){

        $data = Session::get('userdata');


        $PageTitle = 'Profile | ProTutor';
        $userid = Session::get('userid');  
        $countries =  Countries::all();

        if($data->role == 4){

            //updateStudent
            $getData='SELECT users.id as user_id,users.first_name,users.last_name,users.phone_number,users.role,users.user_status,users.email ,users.email_verify,users.password,userdetails.* FROM `users` LEFT JOIN `userdetails` ON users.id = userdetails.student_no WHERE users.id="'.$userid.'"';
            $listUser = DB::select($getData);
            if($request->post()){
                if($request->updateStudent == 'updateStudent'){
                    $profile = Userdetail::where('student_no', $request->id)->update([ 
                        'timezone' => $request->timezone,
                        'phone' => $request->phone, 
                        'country' => $request->country, 
                    ]);
                    return redirect('/profile/about')->with('success_msg',__('Profile update successfully'));
                }

                if($request->updatePhoto == 'updatePhoto'){ 
                    if($_FILES['profile_img']['name']){
                        $image1 = $request->file('profile_img');
                        $imageName = time().'_'.$image1->getClientOriginalName();  
                        $request->profile_img->move(public_path('images'), $imageName);
                        $profile = Userdetail::where('student_no', $request->id)->update([
                            'profile_img' => $imageName 
                        ]); 
                    }
                    return redirect('/profile/photo')->with('success_msg',__('Profile update successfully'));
                }
                
            }

            return view("dashboard/profile_student",compact('PageTitle','listUser','countries'));

        }else{ 

            $getData='SELECT users.id as user_id,users.first_name,users.last_name,users.phone_number,users.role,users.user_status,users.email ,users.email_verify,users.password,userdetails.* FROM `users` LEFT JOIN `userdetails` ON users.id = userdetails.student_no WHERE users.id="'.$userid.'"';
            $listUser = DB::select($getData);

            
            $subject =  Subject::all();

            $getEgducation = Education::where('userdetail_id',$userid)->get();
            $getCertificate = Certificate::where('userdetail_id',$userid)->get();
            $getExperience = Experience::where('userdetail_id',$userid)->get();
            $getIdentification = Identification::where('userdetail_id',$userid)->get();
            $rateAll = Hourly_rate::all();



            if($request->post()){
            //print_r($request->subject); die;
            //DB::enableQueryLog();
            //dd(DB::getQueryLog());
                if($request->about == 'about'){
                    if($request->subject){
                        $profile = Userdetail::where('student_no', $request->id)->update([
                            'subject' => implode(',', $request->subject)
                        ]);     
                    }

                    if($request->subject ==""){
                        $profile = Userdetail::where('student_no', $request->id)->update([
                            'subject' => ""
                        ]);     
                    }

                    $profile = Userdetail::where('student_no', $request->id)->update([
                        'teaching_exp' => $request->teaching_exp,
                        'current_sit' => $request->current_sit,
                        'country' => $request->country,
                        'timezone' => $request->timezone,
                        'phone' => $request->phone,
                        'hourly_rate' => $request->hourly_rate,
                    ]);     
                    return redirect('/profile/about')->with('success_msg',__('Profile update successfully'));
                }

                if($request->photo == 'photo'){
                    if($_FILES['profile_img']['name']){
                        $image1 = $request->file('profile_img');
                        $imageName = time().'_'.$image1->getClientOriginalName();  
                        $request->profile_img->move(public_path('images'), $imageName);
                        $profile = Userdetail::where('student_no', $request->id)->update([
                            'profile_img' => $imageName 
                        ]); 
                    }
                    return redirect('/profile/photo')->with('success_msg',__('Profile update successfully'));
                } 

                if($request->description == 'description'){
                    $profile = Userdetail::where('student_no', $request->id)->update([
                        'desc_first_last' => $request->desc_first_last,
                        'desc_about' => $request->desc_about
                    ]);     
                    return redirect('/profile/description')->with('success_msg',__('Profile update successfully'));
                }

                if($request->videoSub == 'videoSub'){
                    if($_FILES['upload_video']['name']){
                        $image12 = $request->file('upload_video');
                        $imageName1 = time().'_'.$image12->getClientOriginalName();  
                        $request->upload_video->move(public_path('videos'), $imageName1);

                        $profile = Userdetail::where('student_no', $request->id)->update([
                            'video_link' => $imageName1 
                        ]); 
                    }
                    return redirect('/profile/video')->with('success_msg',__('Profile update successfully'));
                } 
                if($request->education == 'education'){ 
                    foreach ($request->university_name as $key => $value) {
                        $education =  new Education;

                        $filess = $request->file('degree_verification_pic');
                        $fileNames = time().'_'.$filess[$key]->getClientOriginalName();  
                        $request->degree_verification_pic[$key]->move(public_path('educations'), $fileNames);

                        $education->userdetail_id =  $request->id;
                        $education->university_name =  $value;
                        $education->degree_name =  $request->degree_name[$key];
                        $education->degree_type =  $request->degree_type[$key];
                        $education->specialization =  $request->specialization[$key];
                        $education->year_of_study =  $request->year_of_study[$key].'-'.$request->year_of_study_end[$key];
                        $education->degree_verification_pic =  $fileNames; 
                        $education->save();
                    }  
                    return redirect('/profile/background')->with('success_msg',__('Profile update successfully'));
                }


                if($request->certificate == 'certificate'){ 
                    foreach ($request->certificate_name as $key => $value) {
                        $certificate =  new Certificate; 

                        $filess = $request->file('certificate_verified_pic');
                        $fileNames = time().'_'.$filess[$key]->getClientOriginalName();  
                        $request->certificate_verified_pic[$key]->move(public_path('certificates'), $fileNames);


                        $certificate->userdetail_id =  $request->id;
                        $certificate->certificate_name =  $value;
                        $certificate->description =  $request->description[$key];
                        $certificate->issued_by =  $request->issued_by[$key]; 
                        $certificate->year_of_study =  $request->year_of_study[$key].'-'.$request->year_of_study_end[$key];
                        $certificate->certificate_verified_pic =  $fileNames; 
                        $certificate->save();
                    }
                    return redirect('/profile/background')->with('success_msg',__('Profile update successfully'));  
                }

                if($request->experience == 'experience'){ 
                    foreach ($request->company_name as $key => $value) {
                        $experience =  new Experience; 

                        $experience->userdetail_id =  $request->id;
                        $experience->company_name =  $value;
                        $experience->position =  $request->position[$key]; 
                        $experience->period_of_employment =  $request->period_of_employment[$key].'-'.$request->period_of_employment_end[$key];
                        $experience->save();
                    }  
                    return redirect('/profile/background')->with('success_msg',__('Profile update successfully'));
                }


                if($request->identification == 'identification'){ 

                    foreach ($request->issued_by_country as $key => $value) {
                        $experience =  new Identification; 

                        $experience->userdetail_id =  $request->id;
                        $experience->issued_by_country =  $value;
                        $experience->type_of_document =  $request->type_of_document[$key];
                        $experience->identification_number =  $request->identification_number[$key]; 
                        $experience->expiry_date =  $request->expiry_date[$key].'-'.$request->expiry_date_end[$key];

                        $filess = $request->file('identity_document_front');
                        $fileNames = time().'_front'.$filess[$key]->getClientOriginalName();  
                        $request->identity_document_front[$key]->move(public_path('identity'), $fileNames);
                        $experience->identity_document_front =  $fileNames;

                        $filess_b = $request->file('identity_document_back');
                        $fileNames_b = time().'_back'.$filess_b[$key]->getClientOriginalName();  
                        $request->identity_document_back[$key]->move(public_path('identity'), $fileNames_b);
                        $experience->identity_document_back =  $fileNames_b; 
                        $experience->save();
                    }
                    return redirect('/profile/background')->with('success_msg',__('Profile update successfully'));
                }


               // return redirect('/profile')->with('success_msg',__('Profile update successfully'));

            }
            return view("dashboard/profile",compact('PageTitle','listUser','countries','subject','getEgducation','getCertificate','getExperience','getIdentification','rateAll'));
        }
    }





    public function deleteEducation(Request $request, $id){
        $deleteRow = Education::where('id',$id);

        if($deleteRow->delete()) { 
            return redirect("/profile/background")->with('success_msg','Education deleted successfully.');
        }
    }
    public function deleteExperience(Request $request, $id){
        $deleteRow = Experience::where('id',$id);

        if($deleteRow->delete()) { 
            return redirect("/profile/background")->with('success_msg','Experience deleted successfully.');
        }
    }
    public function deleteCertificate(Request $request, $id){
        $deleteRow = Certificate::where('id',$id);

        if($deleteRow->delete()) { 
            return redirect("/profile/background")->with('success_msg','Certificate deleted successfully.');
        }
    }
    public function deleteIdentity(Request $request, $id){
        $deleteRow = Identification::where('id',$id);

        if($deleteRow->delete()) { 
            return redirect("/profile/background")->with('success_msg','Certificate deleted successfully.');
        }
    }

    public function markNotification_user(Request $request)
    {    
        $userid = Session::get('userid');   
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



    public function tutors(Request $request){

        $data = Session::get('userdata');
        if($data->role != 4){
            return redirect('/dashboard');
        }

        $PageTitle = 'Tutor Info | ProTutor';
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

            return view("dashboard/find_a_tutor",compact('PageTitle','countryAll','rateAll','subjectAll','Spoken_language','userdata'));

        }else{

            $user_status='3';
            $user_data='SELECT users.id as user_id,users.first_name,users.last_name,users.phone_number,users.role,users.user_status,users.email ,users.email_verify,users.password,userdetails.* FROM `users` LEFT JOIN `userdetails` ON users.id = userdetails.student_no WHERE users.role="'.$user_status.'" LIMIT 12';
            $userdata = DB::select($user_data);

            return view("dashboard/find_a_tutor",compact('PageTitle','countryAll','rateAll','subjectAll','Spoken_language','userdata'));

        }
    }


    public function tutor(Request $request,$tutorid)
    {   
        $data = Session::get('userdata');
        if($data->role != 4){
            return redirect('/dashboard');
        }

        $PageTitle = 'Tutor Detail | ProTutor';
        $teacher_data=  Userdetail::where('student_no', $tutorid)->get();
        $subjects = Subject::all();
        $languages = Spoken_language::all();
        $country = Countries::all();
        $certificateAll = Certificate::all();
        $hour_rate = Hourly_rate::all();

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

            return view("dashboard/tutor_detail_single",compact('PageTitle','teacher_data','subjects','languages','degree','years_of_Exp','country','experience','certificateAll','hour_rate'));
        }else{
            $years_of_Exp = 0;
            return view("dashboard/tutor_detail_single",compact('PageTitle','teacher_data','subjects','languages','degree','years_of_Exp','country','experience','certificateAll','hour_rate'));
        }


    }

    public function calendar(Request $request)
    { 

        $data = Session::get('userdata');
        if($data->role != 3){
            return redirect('/dashboard');
        }

        $userid = Session::get('userid');
        $teacher_data=  Userdetail::where('student_no', $userid)->get();
        $profile_verified = $teacher_data[0]->profile_verified;
        if($profile_verified=='0'){
            return redirect('/dashboard')->with('error_msg',__("You cannot go to the Calendar menu, please complete your profile first and have your profile verified by an administrator."));
        }


        $subject =  Subject::all();
        $teache_level =  Teaches_level::all();

        $PageTitle = 'Calendar | ProTutor';

        if($request->post()){ 

            $schedule = new Calendar;
            $schedule->start_date =  $request->start_date; 
            $schedule->end_date =  $request->end_date; 
            $schedule->student_no =  $request->student_no;  
            $schedule->grade =  $request->grade;  
            $schedule->subject =  $request->subject;  
            $schedule->note =  $request->note;  
            $schedule->status =  'schedule';  
            $schedule->save();

            $user_data =  User::where('id', $request->student_no)->first();
            $user_email = $user_data->email;
            $superadmin='1';
            $admin='2';
            $notificationstype = array('superadmin'=>$superadmin,'admin'=>$admin);
            $notifi_notifiable_id=implode(",",$notificationstype);

            $notificationsdata = 'New Schedule added by ('.$user_email.')';
            $Notifications = new Notifications();
            $Notifications->viewer_role =$notifi_notifiable_id;
            $Notifications->user_id ='1';
            $Notifications->message_type='NewSchedule';
            $Notifications->data=$notificationsdata;
            $Notifications->read_at='0';
            $Notifications->save(); 
        }
        //return view("dashboard/calendar");
        return view("dashboard/calendar",compact('PageTitle','subject','teache_level'));

    }

    public function getcalendar(Request $request,$id)
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
                'grade' => $value["grade"],
                'status' => $value["status"]

            );
        }
        return json_encode($data);
    }

    public function editcalendar(Request $request)
    {

        Calendar::where('id', $request->id)->update([ 
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'grade' => $request->grade,
            'subject' => $request->subject,
            'note' => $request->note 
        ]);     
    } 

    public function addSchedule(Request $request)
    { 

        if($request->post()){ 



            //DB::enableQueryLog();
            $cale = Calendar::whereBetween('start_date', [$request->start_date_s, $request->end_date_s])->orWhere(function ($query) use ($request) {
                $query->whereBetween('end_date', [$request->start_date_s, $request->end_date_s]);
            })->first(); 
            //dd(DB::getQueryLog());

            if(!empty($cale)){
                return "error";
            }  

            $schedule = new Calendar;
            $schedule->start_date =  $request->start_date_s; 
            $schedule->end_date =  $request->end_date_s; 
            $schedule->student_no =  $request->student_no_s;
            $schedule->note =  $request->note_s;
            $schedule->status =  'time_off';

            if($schedule->save()){

                $user_data =  User::where('id', $request->student_no_s)->first();
                $user_email = $user_data->email;
                $superadmin='1';
                $admin='2';
                $notificationstype = array('superadmin'=>$superadmin,'admin'=>$admin);
                $notifi_notifiable_id=implode(",",$notificationstype);

                $notificationsdata = 'New Schedule time off added by ('.$user_email.')';
                $Notifications = new Notifications();
                $Notifications->viewer_role =$notifi_notifiable_id;
                $Notifications->user_id ='1';
                $Notifications->message_type='NewSchedule';
                $Notifications->data=$notificationsdata;
                $Notifications->read_at='0';
                $Notifications->save();

                return true;
            } else{
                return false;
            }
        }
    }

    public function add_availability_Schedule(Request $request)
    { 

        if($request->post()){ 


            //DB::enableQueryLog();
            $cale = Calendar::whereBetween('start_date', [$request->start_date_a, $request->end_date_a])->orWhere(function ($query) use ($request) {
                $query->whereBetween('end_date', [$request->start_date_a, $request->end_date_a]);
            })->first(); 
            //dd(DB::getQueryLog());

            if(!empty($cale)){
                return "error";
            }  

            $schedule = new Calendar;
            $schedule->start_date =  $request->start_date_a; 
            $schedule->end_date =  $request->end_date_a; 
            $schedule->student_no =  $request->student_no_a;
            $schedule->grade =  $request->grade_a;
            $schedule->subject =  $request->subject_a;
            $schedule->note =  $request->note_a;
            $schedule->status =  'schedule';

            if($schedule->save()){

                $user_data =  User::where('id', $request->student_no_a)->first();
                $user_email = $user_data->email;
                $superadmin='1';
                $admin='2';
                $notificationstype = array('superadmin'=>$superadmin,'admin'=>$admin);
                $notifi_notifiable_id=implode(",",$notificationstype);

                $notificationsdata = 'New Schedule added by ('.$user_email.')';
                $Notifications = new Notifications();
                $Notifications->viewer_role =$notifi_notifiable_id;
                $Notifications->user_id ='1';
                $Notifications->message_type='NewSchedule';
                $Notifications->data=$notificationsdata;
                $Notifications->read_at='0';
                $Notifications->save();

                return true;
            } else{
                return false;
            }
        }
        die();
    }


    public function getEventByid(Request $request,$id)
    {
        //$getData = Calendar::where('id',$id)->where('status','schedule')->get();
         //print_r($getData[0]); die;
        $getData = Calendar::where('id',$id)->get();
        return $getData[0];
    } 

    public function purchase_lession_by_student(Request $request)
    {
        $eventID = $request->eventID;
        $student_no = $request->student_no;

        $get_schedule=  Calendar::where('id', $eventID)->get();
        $sch_start_date = $get_schedule[0]->start_date;
        $sch_end_date = $get_schedule[0]->end_date;
        $sch_grade = $get_schedule[0]->grade;
        $sch_subject = $get_schedule[0]->subject;
        $sch_note = $get_schedule[0]->note;

        $startTime = Carbon::parse($sch_start_date);
        $finishTime = Carbon::parse($sch_end_date);
        $totalDuration = $finishTime->diff($startTime);
        
        $teacher_data=  Userdetail::where('student_no', $student_no)->get();
        $subjects = Subject::all();
        $languages = Spoken_language::all();
        $country = Countries::all();
        $certificateAll = Certificate::all();
        $hour_rate = Hourly_rate::all();
        $teache_level =  Teaches_level::all();

        $degree = DB::select('SELECT educations.degree_name, educations.specialization, educations.university_name, educations.year_of_study FROM `educations` join userdetails on educations.userdetail_id = userdetails.student_no
            where userdetails.student_no="'.$student_no.'";');

        $certificateAll = DB::select('SELECT certifications.year_of_study, certifications.certificate_name, certifications.issued_by FROM `certifications` join userdetails on certifications.userdetail_id = userdetails.student_no
            where userdetails.student_no="'.$student_no.'";');

        $experience = DB::select('SELECT experiences.period_of_employment, experiences.company_name, experiences.position FROM `experiences` join userdetails on experiences.userdetail_id = userdetails.student_no
            where userdetails.student_no="'.$student_no.'";');

        if(!empty($experience)){
            $years_of_Exps = [];
            foreach ($experience as $key => $value) {
                $year = explode('-', $value->period_of_employment);
                $years_of_Exps[] = $year[1]- $year[0];
            }
            $years_of_Exp = array_sum($years_of_Exps);
        }else{
            $years_of_Exp = 0;
        }

        ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="box">
                    <div class="tutor-list-single alt">
                        <div class="tutor-list-left">
                            <div class="tutor-list-img">
                                <a href="#"><img src="<?php echo url('/').'/public/images/'.$teacher_data[0]->profile_img; ?>" alt=""></a>
                            </div>
                            <div class="tutor-list-txt">
                                <div class="tutor-list-info">
                                    <h5><a href="#"><?php echo $teacher_data[0]->first_name.' '.$teacher_data[0]->last_name; ?>&nbsp;</a></h5>
                                    <?php 
                                    foreach ($country as $key => $value) { 
                                      if($teacher_data[0]->country==$value->id){
                                         ?>       
                                         <img class="nationality" src="<?php echo url('/').'/public/assets/frontpage_assets/flags/'.Str::lower($value->iso).'.png'; ?>" alt="language">
                                         <?php 
                                     }
                                 }
                                 ?> 
                                 <?php 
                                 if($teacher_data[0]->profile_verified == 1){
                                    echo '<span class="verify"><i class="fas fa-user-check" style="color: #3f8307;"></i></span>';
                                }else{
                                    echo '<span class="verify"><i class="fa-solid fa-user-xmark" style="color: red;"></i></span>';
                                }
                                ?>
                                <span class="tutor-stat"><i class="fa-solid fa-circle"></i> Online</span>
                            </div>
                            <div class="tutor-spec"><span><i class="fa-solid fa-graduation-cap"></i></span><span><strong>Teaches</strong></span>  
                                <?php 
                                foreach ($subjects as $key => $value) { 
                                  $medi_arr = explode(',', $teacher_data[0]->subject);  
                                  if(count($medi_arr) > 1){
                                    if(in_array($value->id, $medi_arr)){
                                        echo '<span class="text-dark">'.$value->subject.'</span>';
                                    }
                                }else{
                                    if($teacher_data[0]->subject==$value->id){
                                      echo '<span class="text-dark">'.$value->subject.'</span>';
                                  }
                              }
                          }
                          ?> 
                      </div>
                      <div class="tutor-spec"><span><i class="fa-solid fa-comments"></i></span><span><strong>Speaks:</strong></span><span>
                        <?php 
                        foreach ($languages as $key => $native_lan) { 

                            $medi_arr1 = explode(',', $teacher_data[0]->native_language);  
                            if(count($medi_arr1) > 1){
                                if(in_array($native_lan->id, $medi_arr1)){
                                    echo '<span> &nbsp;'.$native_lan->spoken_language.'</span>';
                                }
                            }else{
                                if($teacher_data[0]->native_language==$native_lan->id){
                                   echo '<span> &nbsp;'.$native_lan->spoken_language.'</span>';
                               }
                           }
                       }
                       echo '<span class="spec">Native</span> ';
                       ?> 
                       <?php 
                       foreach ($languages as $key => $advance_lang) { 
                        $medi_arr1 = explode(',', $teacher_data[0]->languages);  
                        if(count($medi_arr1) > 1){
                            if(in_array($advance_lang->id, $medi_arr1)){
                                echo '<span> &nbsp;'.$advance_lang->spoken_language.'';
                            }
                        }else{
                            if($teacher_data[0]->languages==$advance_lang->id){
                               echo '<span> &nbsp;'.$advance_lang->spoken_language.'</span>';
                           }
                       }
                   }
                   echo '&nbsp;&nbsp;<span class="spec adv">Advanced</span>';
                   ?> 

               </div>
           </div>
       </div>
   </div>

   <div class="lesson-timer mt-4">
    <h2>Date and Time of Lesson</h2>
    <h3><?php echo date("D-M d,Y", strtotime($sch_start_date))?> <?php echo date("h:i", strtotime($sch_start_date))?>-<?php echo date("h:ia", strtotime($sch_end_date)); ?></h3>
    
    <!-- <p>GMT +5:00</p> -->
</div>

<div class="lesson-timer">
    <ul>

        <li class="pb-4">
            <h2>Service Details</h2>
            <h2>Price Per Hour</h2>
        </li>
        <li class="pb-2">
            <h5><?php echo $sch_note; ?></h5>
        </li>   
        <li class="pb-1">
            <p>
                <b>Grade:</b>
                <?php 
                foreach ($teache_level as $key => $teache_value) { 
                    if($sch_grade==$teache_value->id){
                      echo $teache_value->teaches_level;
                  }
              }
              ?> 
              &nbsp; &nbsp; 
              <b>Subject:</b>
              <?php 
              foreach ($subjects as $key => $value) { 
                if($sch_subject==$value->id){
                  echo $value->subject;
              }
          }
          ?> 
      </p> 
  </li> 
  <li>
    <p>
     <?php
     $totalDuration1 = $totalDuration->h; 
     if($totalDuration1>0){
        echo $totalDuration1.' Hour Lesson'; 

        foreach ($hour_rate as $key => $rateAll_data1) { 
            if($teacher_data[0]->hourly_rate==$rateAll_data1->id){
                $totalhour= ($rateAll_data1->hourly_rate)*($totalDuration1); 
            }
        } 
    }else{
        echo $totalDuration->i.' minute Lesson';
        foreach ($hour_rate as $key => $rateAll_data1) { 
            if($teacher_data[0]->hourly_rate==$rateAll_data1->id){
                $totalhour= $rateAll_data1->hourly_rate; 
            }
        } 
    }       

    ?>  
</p>
<p> 
    <?php 
    echo '$'.$totalhour.'.00';
    ?>
</p>
</li>
<li>
    <p>Transaction Fee</p>
    <p>$ 2.00</p>
</li>
<li class="pt-4">
    <h2><strong>Total</strong></h2>
    <h2>
        <strong>
            <?php echo '$'.(2)+($totalhour).'.00'; ?>
        </strong>
    </h2>
</li>
</ul>
</div>

</div>

<div class="box mt-3">
    <div class="rev-bar">
        <span class="revBox"><i class="fa-solid fa-star"></i> 5.0</span>
        <h4>2 Reviews</h4>
    </div>
    <div class="owl-carousel review-carousel">
        <div class="item">
            <div class="rev-img">
                <div class="rev-img-left"><img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg" alt=""></div>
                <div class="rev-img-txt"><strong>Name of Student</strong></div>
            </div>
            <p>I'm so lucky to have Myles as my tutor. My reason to sign up for Tutors Online was to improve my English for work, which is in an Engineering domain. Myles himself is an engineer and that's a massive bonus because he can help me with not only speaking correctly but also delivering the context right with technical terminologies. Her lessons are always fun. Every single time, I get a couple of really good laughs!</p>
        </div>
        <div class="item">
            <div class="rev-img">
                <div class="rev-img-left"><img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg" alt=""></div>
                <div class="rev-img-txt"><strong>Name of Student</strong></div>
            </div>
            <p>I'm so lucky to have Myles as my tutor. My reason to sign up for Tutors Online was to improve my English for work, which is in an Engineering domain. Myles himself is an engineer and that's a massive bonus because he can help me with not only speaking correctly but also delivering the context right with technical terminologies. Her lessons are always fun. Every single time, I get a couple of really good laughs!</p>
        </div>
        <div class="item">
            <div class="rev-img">
                <div class="rev-img-left"><img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg" alt=""></div>
                <div class="rev-img-txt"><strong>Name of Student</strong></div>
            </div>
            <p>I'm so lucky to have Myles as my tutor. My reason to sign up for Tutors Online was to improve my English for work, which is in an Engineering domain. Myles himself is an engineer and that's a massive bonus because he can help me with not only speaking correctly but also delivering the context right with technical terminologies. Her lessons are always fun. Every single time, I get a couple of really good laughs!</p>
        </div>
        <div class="item">
            <div class="rev-img">
                <div class="rev-img-left"><img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg" alt=""></div>
                <div class="rev-img-txt"><strong>Name of Student</strong></div>
            </div>
            <p>I'm so lucky to have Myles as my tutor. My reason to sign up for Tutors Online was to improve my English for work, which is in an Engineering domain. Myles himself is an engineer and that's a massive bonus because he can help me with not only speaking correctly but also delivering the context right with technical terminologies. Her lessons are always fun. Every single time, I get a couple of really good laughs!</p>
        </div>
    </div>
</div>
</div>
<div class="col-lg-6">
    <div class="box">

        <div class="tab-title d-flex">
            <div>
                <h2>Secure Checkout</h2>
            </div>
        </div>

        <div class="secure-checkout">
            <h3>Payment Method</h3>
            <h4>It's safe to pay on Tutors Online. All transactions are protected by SSL encryption.</h4>
        </div>

        <div class="payment-accordion">

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <div class="btn-left">
                                <div class="button-circle"></div>
                                <span class="button-title">Payment Card</span>
                                <span class="button-img"><img src="./assets/images/cards.png" alt=""></span>
                                <span class="button-info">Visa, Mastercard, American Express, Discover, Diners</span>
                            </div>
                            <div class="btn-right"><i class="fa-solid fa-lock"></i></div>
                        </button>
                    </h2>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <div class="btn-left">
                                <div class="button-circle"></div>
                                <span class="button-img"><img src="./assets/images/paypal.png" alt=""></span>
                            </div>
                            <div class="btn-right"><i class="fa-solid fa-lock"></i></div>
                        </button>
                    </h2>
                </div>
            </div>

        </div>

        <form method="post" id="payment_id" action="<?php echo url('/order');?>">

            <?php echo csrf_field(); ?>
            <input type="hidden" name="teacher_id" value="<?php echo $student_no; ?>">
            <input type="hidden" name="calender_sch_id" value="<?php echo $eventID; ?>">
            <input type="hidden" name="total" value="<?php echo $totalhour; ?>">
            <input type="hidden" name="transaction_fee" value="2">
            <input type="hidden" name="net_total" value="<?php echo (2)+($totalhour); ?>">
            <div class="save-changes text-start">
                <button type="submit">Checkout</button>
            </div>
        </form>


    </div>
</div>
</div>

<?php
}


public function settings(){
    $PageTitle = 'Settings | ProTutor';
    $userid = Session::get('userid');  
    $user_data =  User::where('id', $userid)->first();
    $calender = $user_data->role;
    return view("dashboard/settings",compact('PageTitle','user_data','calender'));
}
public function getPurchasesData(Request $request){
    $eventID = $request->eventID;
    $get_schedule=  Calendar::where('id', $eventID)->get();
    return $get_schedule[0];
}


public function change_password(Request $request){

    if($request->post())
    {
        $user = User::where('id',\Session::get('userid'))->first();

        if($user->password === md5($request->post('Curr_pswd')))
        {
            if($request->post('new_pswd') == $request->post('confirm_pswd'))
            {
                $user->password = md5($request->post('new_pswd'));

                DB::table('users')->where('id',$user->id)->update(['password' => $user->password]);
            }else{
                return view("dashboard/settings")->with('error_msg',__('Your new and confirm password does not matched'));
            }
            return view("dashboard/settings")->with('success_msg',__('Your password has been changed successfully'));
        }else{
            return view("dashboard/settings")->with('error_msg',__('Your old password does not matched'));
        }   
    }
    return view("dashboard/settings");
}

public function support(){
 $Supportdata =  Support::where('id', 1)->get();
 $PageTitle = 'Support | ProTutor';
 return view("dashboard/support",compact('PageTitle','Supportdata'));
}

public function order(Request $request){

    if($request->post()){

        $zoom_meeting = new Zoom_Api();
        date_default_timezone_set('UTC'); 

        $get_schedule=  Calendar::where('id', $request->calender_sch_id)->get();
        $sch_start_date = $get_schedule[0]->start_date;
        $sch_end_date = $get_schedule[0]->end_date;
        $sch_grade = $get_schedule[0]->grade;
        $sch_subject = $get_schedule[0]->subject;
        $sch_note = $get_schedule[0]->note;

        $startTime = Carbon::parse($sch_start_date);
        $finishTime = Carbon::parse($sch_end_date);
        $totalDuration = $finishTime->diff($startTime);

        $totalDuration1 = $totalDuration->h; 
        if($totalDuration1>0){
            $totalDuration2 = $totalDuration1; 
        }else{
            $totalDuration2 = $totalDuration->i; 
        }

        $date = $sch_start_date;

        $data = array();
        $data['topic']      = $sch_note;
        $data['start_date'] = $date;
        $data['duration']   = 30;
        $data['type']       = 2;
        //$data['password']   = "123456";
       // $data['alternative_host_ids']   =['mohan.yadav@indiaresults.com'];
       // $data['option_host_video']   = true;
       // $data['option_participants_video']   = true;
       // $data['join_before_host']   = true;
        
        try {
            $response = $zoom_meeting->createMeeting($data);

            $join_url = $response->join_url;

            $userid = Session::get('userid');  
            $Order =  new Order;
            $Order->user_id = $userid;
            $Order->teacher_id = $request->teacher_id;
            $Order->calender_sch_id = $request->calender_sch_id;
            $Order->order_type = 'lesson';
            $Order->items = '1';
            $Order->total = $request->total;
        //$Order->discount = ''; 
            $Order->transaction_fee = $request->transaction_fee; 
            $Order->net_total = $request->net_total; 
            $Order->payment_id = '1'; 
            $Order->payment_status = 'pendding'; 
            $Order->status = '1';
            $Order->zoom_meeeting_url =$join_url; 
            $Order->save();

            if($Order->save()){

             $user_data =  User::where('id', $userid)->first();
             $user_email = $user_data->email;

               //admin
             $superadmin='1';
             $admin='2';
             $notificationstype = array('superadmin'=>$superadmin,'admin'=>$admin);
             $notifi_notifiable_id=implode(",",$notificationstype);
             $notificationsdata = 'New lesson order placed by ('.$user_email.')';
             $Notifications = new Notifications();
             $Notifications->viewer_role =$notifi_notifiable_id;
             $Notifications->user_id ='1';
             $Notifications->message_type='NewOrder';
             $Notifications->data=$notificationsdata;
             $Notifications->read_at='0';
             $Notifications->save(); 

                //teacher          
             $teacher='3';
             $notificationstype = array('techer'=>$teacher);
             $notifi_notifiable_id=implode(",",$notificationstype);
             $notificationsdata = 'New lesson order placed by ('.$user_email.')';
             $Notifications = new Notifications();
             $Notifications->viewer_role =$notifi_notifiable_id;
             $Notifications->user_id =$request->teacher_id;
             $Notifications->message_type='NewOrder';
             $Notifications->data=$notificationsdata;
             $Notifications->read_at='0';
             $Notifications->save();

             return redirect('student-orders')->with('success_msg',__('Your order has been successfully placed.'));
         }else{
            return redirect('student-orders')->with('error_msg',__('Your order has failed. Please try again after some time.'));
        }



    } catch (Exception $ex) {
        //echo $ex;
       return redirect('student-orders')->with('error_msg',$ex);
   }

}

}


public function teachingOrders(){

    $data = Session::get('userdata');
    if($data->role != 3){
        return redirect('/dashboard');
    }

    $PageTitle = 'Teaching Orders | ProTutor';
    
    $userid = Session::get('userid');  

    //$teachingorders=  Order::where('teacher_id', $userid)->where('status', '1')->groupBy(DB::raw("day(created_at)"))->get();

   /* $teachingorders=DB::table('order')
      ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'))
      ->where('teacher_id', $userid)
      ->where('status', '1')
      ->groupBy('date')
      ->get();*/


      $getData='SELECT `order`.id as order_id,`order`.user_id,`order`.teacher_id,`order`.calender_sch_id,`order`.order_type,`order`.items,`order`.total ,`order`.discount,`order`.transaction_fee,`order`.net_total,`order`.payment_id,`order`.payment_status,`order`.status,`order`.zoom_meeeting_url,calendars.* FROM `order` LEFT JOIN `calendars` ON `order`.calender_sch_id = calendars.id WHERE `order`.status=1 and `order`.teacher_id="'.$userid.'"';
      $teachingorders = DB::select($getData);


      $completeorder = new Order;
      $completeorder =  $completeorder->where('teacher_id', $userid);
      $completeorder =  $completeorder->where('status', '2');
      $completeorder = $completeorder->paginate(10);
      $params = array('tab' => (isset($_GET['tab']) ? $_GET['tab'] : "2" ));

      $cancelorder = new Order;
      $cancelorder =  $cancelorder->where('teacher_id', $userid);
      $cancelorder =  $cancelorder->where('status', '3');
      $cancelorder = $cancelorder->paginate($perPage = 10, $columns = ['*'], $pageName = 'page2');
      $cancelorder_params = array('tab1' => (isset($_GET['tab1']) ? $_GET['tab1'] : "3" ));


      return view("dashboard/teachingorders",compact('PageTitle','teachingorders','completeorder','params','cancelorder','cancelorder_params'));
  }


  public function studentOrders(){

    $data = Session::get('userdata');
    if($data->role != 4){
        return redirect('/dashboard');
    }

    $PageTitle = 'Teaching Orders | ProTutor';
    
    $userid = Session::get('userid');  

    $getData='SELECT `order`.id as order_id,`order`.user_id,`order`.teacher_id,`order`.calender_sch_id,`order`.order_type,`order`.items,`order`.total ,`order`.discount,`order`.transaction_fee,`order`.net_total,`order`.payment_id,`order`.payment_status,`order`.status,`order`.zoom_meeeting_url,calendars.* FROM `order` LEFT JOIN `calendars` ON `order`.calender_sch_id = calendars.id WHERE `order`.status=1 and `order`.user_id="'.$userid.'"';
    $teachingorders = DB::select($getData);


    $completeorder = new Order;
    $completeorder =  $completeorder->where('user_id', $userid);
    $completeorder =  $completeorder->where('status', '2');
    $completeorder = $completeorder->paginate(10);
    $params = array('tab' => (isset($_GET['tab']) ? $_GET['tab'] : "2" ));

    $cancelorder = new Order;
    $cancelorder =  $cancelorder->where('user_id', $userid);
    $cancelorder =  $cancelorder->where('status', '3');
    $cancelorder = $cancelorder->paginate($perPage = 10, $columns = ['*'], $pageName = 'page2');
    $cancelorder_params = array('tab1' => (isset($_GET['tab1']) ? $_GET['tab1'] : "3" ));


    return view("dashboard/studentorders",compact('PageTitle','teachingorders','completeorder','params','cancelorder','cancelorder_params'));

}


public function cancel_order(Request $request){

    if($request->post()){
        ?>    
        <span class="res-center-close" id="closetab"></span>
        <h2 class="pb-3">Resolution Center</h2>
        <h3>Resolutions can be made until <strong><?php echo $request->duration; ?></strong></h3>
        <div class="row mt-3">
            <div class="col-6">
              <button data-bs-toggle="modal" data-bs-target="#resStep-1" class="theme-btn full bdr teal">Reschedule Lesson</button>
          </div>
          <div class="col-6">
              <button data-bs-toggle="modal" data-bs-target="#cancelStep-1" class="theme-btn full bdr red">Cancel Lesson</button>
          </div>
      </div>
      <h3 class="mt-3"><strong class="txt-orange">Response</strong></h3>
      <div class="system-resp">
        <h5>System</h5>
        <div class="system-resp-txt">
          <p>Your request to reschedule lesson is accepted by Student Name. The lesson is rescheduled now for October 20, 2021</p>
      </div>
      <p class="text-end pt-2">October 19, 2021 - 10:00</p>
  </div>


  <?php 
}

die();   
}

public function cancel_order_by_id(Request $request){

    if($request->post()){  

        $userid = Session::get('userid');

        $user_data =  User::where('id', $userid)->first();
        $first_name = $user_data->first_name;    
        $last_name = $user_data->last_name; 
        $fullname = $first_name.' '.$last_name;   
        
        $status=3;    
        $Order = Order::where('id', $request->order_id_val)->update([
            'cancelled_by' => $fullname,
            'reason' => $request->cancel_reason,
            'status' => $status
        ]);

        if($Order){

         $data = Session::get('userdata');
         $user_email = $data->email;

               //admin
         $superadmin='1';
         $admin='2';
         $notificationstype = array('superadmin'=>$superadmin,'admin'=>$admin);
         $notifi_notifiable_id=implode(",",$notificationstype);
         $notificationsdata = 'lesson order canceled by ('.$user_email.')';
         $Notifications = new Notifications();
         $Notifications->viewer_role =$notifi_notifiable_id;
         $Notifications->user_id ='1';
         $Notifications->message_type='orderCanceled';
         $Notifications->data=$notificationsdata;
         $Notifications->read_at='0';
         $Notifications->save(); 


         $Order_data =  Order::where('id', $request->order_id_val)->first();
         $getuser_id = $Order_data->user_id;
         $teacher_id = $Order_data->teacher_id;

         if($userid==$getuser_id){          
             $teacher='3';
             $notificationstype = array('techer'=>$teacher);
             $notifi_notifiable_id=implode(",",$notificationstype);
             $notificationsdata = 'lesson order canceled by ('.$user_email.')';
             $Notifications = new Notifications();
             $Notifications->viewer_role =$notifi_notifiable_id;
             $Notifications->user_id =$teacher_id;
             $Notifications->message_type='orderCanceled';
             $Notifications->data=$notificationsdata;
             $Notifications->read_at='0';
             $Notifications->save();
         }else{
            $teacher='4';
            $notificationstype = array('techer'=>$teacher);
            $notifi_notifiable_id=implode(",",$notificationstype);
            $notificationsdata = 'lesson order canceled by ('.$user_email.')';
            $Notifications = new Notifications();
            $Notifications->viewer_role =$notifi_notifiable_id;
            $Notifications->user_id =$getuser_id;
            $Notifications->message_type='orderCanceled';
            $Notifications->data=$notificationsdata;
            $Notifications->read_at='0';
            $Notifications->save();


        }


        if($data->role == 4){

           return redirect('/student-orders')->with('success_msg',__('Order canceled successfully.'));
       }else{

        return redirect('/teaching-orders')->with('success_msg',__('Order canceled successfully.'));
    }

}


}

$data = Session::get('userdata');
if($data->role == 4){

   return redirect('/student-orders')->with('success_msg',__('Order canceled successfully.'));
}else{

    return redirect('/teaching-orders')->with('error_msg',__('Order not canceled'));
}
}





}
