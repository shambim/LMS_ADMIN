<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;

use App\Teacher;
use App\AllClass;
use App\Attendance;

use DB;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   
    public function index()
    {
        
        $teacher_lists  = DB::table('teachers')
          ->rightJoin('teacher_assigns','teachers.id','=','teacher_assigns.teacher_id')
          ->rightJoin('all_classes','teacher_assigns.class_id','=','all_classes.id')
          ->select([
              'teachers.*',
              DB::raw("group_concat(DISTINCT all_classes.name ORDER BY all_classes.name DESC SEPARATOR ',') AS 'all_classes'")
            ])
            ->groupBy('teachers.id')
            ->get();
        
        return view('teacher.index',['teacher_lists'=>$teacher_lists ]);        


    }

    public function create()
    {
        $all_class_details=AllClass::all();

        return view('teacher.create',['all_class_details'=>$all_class_details]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => "required|string|max:255|unique:teachers",
            'phone'=>'required',
            'subject'=>'required',
            'description'=>'required',
        ]);


        $teacher_data=Teacher::create($validatedData);
        if($teacher_data){
            $teacher_id=$teacher_data->id;
            $all_class=$request->all_class;
            for($i=0;$i<count($all_class);$i++){
                $teacher_assign_data=array();
                $teacher_assign_data['teacher_id']=$teacher_id;
                $teacher_assign_data['class_id']=$all_class[$i];
                $teacher_assign_data['created_at']=date('Y-m-d H:i:s');
                $teacher_assign_data['updated_at']=date('Y-m-d H:i:s');
                DB::table('teacher_assigns')->insert($teacher_assign_data);
            }
            


            session()->flash('msg', 'Teacher added Successfully.');
            return redirect('teacher/lists');

            
        }
    }

    public function edit($id)
    {
        $teacher_details  = DB::table('teachers')
          ->rightJoin('teacher_assigns','teachers.id','=','teacher_assigns.teacher_id')
          ->rightJoin('all_classes','teacher_assigns.class_id','=','all_classes.id')
          ->select([
              'teachers.*',
              DB::raw("group_concat(all_classes.id ORDER BY all_classes.id DESC SEPARATOR ',') AS 'all_selected_class_ids'")
            ])
            ->where('teachers.id',$id)
            ->groupBy('teachers.id')
            ->get();

        $teacher_detail=(isset($teacher_details) && count($teacher_details)>0)?$teacher_details[0]:array();

        $all_class_details=AllClass::all();
        
        return view('teacher.edit',[
            'teacher_detail'=>$teacher_detail,
            'all_class_details'=>$all_class_details
        ]);
    }

    public function update($id,Request $request)
    {
       
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:teachers,email,'.$id,
            'phone'=>'required',
            'subject'=>'required',
            'description'=>'required',
        ]);

        $teacher_data=DB::table('teachers')
            ->where('id', $id)
            ->update($validatedData);

        $teacher_id=$id;
        $all_class=$request->all_class;
        DB::table('teacher_assigns')->where('teacher_id',$teacher_id)->delete();
        for($i=0;$i<count($all_class);$i++){
            $teacher_assign_data=array();
            $teacher_assign_data['teacher_id']=$teacher_id;
            $teacher_assign_data['class_id']=$all_class[$i];
            $teacher_assign_data['created_at']=date('Y-m-d H:i:s');
            $teacher_assign_data['updated_at']=date('Y-m-d H:i:s');
            $teacher_assign_data=DB::table('teacher_assigns')->insert($teacher_assign_data);
        }    

          session()->flash('msg', 'Teacher updated Successfully.');
            return redirect('teacher/lists');
        
    }

    public function delete($id)
    {
       
        DB::table('teachers')
        ->where('id', $id)
        ->delete();
        DB::table('teacher_assigns')
        ->where('teacher_id', $id)
        ->delete();
        return redirect('teacher/lists')->with('msg', 'Teacher is deleted!');
    } 


    public function attendance_lists(){
        
        $attendance_lists  = DB::table('teachers')
          ->leftJoin('attendances','teachers.id','=','attendances.teacher_id')
          ->select([
              'teachers.id as teacher_id',
              'teachers.name as teacher_name',
              'attendances.status as present_status'
            ])
            ->groupBy('teachers.id')
            ->get();
        return view('teacher.attendance',['attendance_lists'=>$attendance_lists]);    
    }


    public function assign_lists($id){
        $status=input::get('status')!=''?input::get('status'):0;
        $teacher_id=$id;
        $request_data=['teacher_id'=>$teacher_id,
        'date'=>date('Y-m-d'),
        'status'=>$status,
        'created_at'=>date('Y-m-d H:i:s'),
        'updated_at'=>date('Y-m-d H:i:s')];

            $check_assigned=DB::table('attendances')
            ->where('teacher_id',$teacher_id)
            ->where('date',date('Y-m-d'))
            ->get();

            if(isset($check_assigned) && count($check_assigned)>0){
                DB::table('attendances')
                ->where('teacher_id',$teacher_id)
                ->where('date',date('Y-m-d'))
                ->update($request_data);
            }else{
                DB::table('attendances')->insert($request_data);
            }
       
            
        
        return redirect('teacher/attendance_lists')->with('msg', 'Attendance Updated');
    }


}
