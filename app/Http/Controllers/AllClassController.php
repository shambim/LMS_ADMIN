<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AllClass;

use DB;

class AllClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   
    public function index()
    {
        $class_lists=AllClass::all();

        return view('allclass.index',['class_lists'=>$class_lists]);
    }

    public function create()
    {
        return view('allclass.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            
        ]);


        $class_data=AllClass::create($validatedData);
        if($class_data){
            $class_id=$class_data->id;
            session()->flash('msg', 'Class added Successfully.');
            return redirect('allclass/lists');

            
        }
    }

    public function edit($id)
    {
        $class_detail=AllClass::findOrFail($id);

        
        return view('allclass.edit',['class_detail'=>$class_detail]);
    }

    public function update($id,Request $request)
    {
       
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            
        ]);

        $teacher_data=DB::table('all_classes')
            ->where('id', $id)
            ->update($validatedData);

        if($teacher_data){
            session()->flash('msg', 'Class updated Successfully.');
            return redirect('allclass/lists');
        }else{
            session()->flash('err_msg', 'Not updated.');
            return redirect('allclass/lists');
        }
    }
}
