<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeControllers extends Controller
{
    public function index(){
        $employees = Employee::take(20)->get();

        if ($employees) {
            return response()->json([
                'status'=>200,
                'result'=>$employees,
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'No data found',
                'result'=>[],
            ]);
        } 
    }

    public function store(Request $request) {
        $request->validate([
            'employee_name'=>'required',
            'email'=>'required|unique:employees',
            'phone'=>'required|numeric',
            'date_of_birth'=>'date_format:Y-m-d|before:today|nullable',
            'employee_image' => 'image|mimes:jpg,png',
        ]);

        $emp_model = new Employee();

        $emp_model->employee_name = $request->employee_name;
        $emp_model->email = $request->email;
        $emp_model->address = $request->address;
        $emp_model->phone = $request->phone;
        $emp_model->date_of_birth = $request->date_of_birth;

        if ($request->hasFile('employee_image')) {
            if($request->file('employee-image')){
                $file = $request->file('employee_image');
                $file_extn = $file->getClientOriginalExtension();
                $file_name = time().'.'.$file_extn;
                $emp_img = move(public_path().'/uploads/employee', $file_name);

                $emp_model->employee_image = $file_name;

            }
        }

        $emp_model->save();

        return response()->json([
            'status'=>201,
            'message'=>'Employee created successfully!',
            'result'=>$emp_model,
        ]);
    }


    public function show($id) {
        $employe = Employee::find($id);

        if ($employe) {
            return response()->json([
                'status'=>200,
                'message'=>'Success',
                'result'=>$employe,
            ]);
        }else{
            return response()->json([
                'status'=>200,
                'message'=>'No data found',
                'result'=>[],
            ]);
        }
    }

    public function search($emp_name)
    {
        $result = Employee::where('employee_name', 'LIKE', '%'. $emp_name. '%')->take(10)->get();
        if(count($result)){
            return Response()->json([
                'status'=>200,
                'result'=>$result, 
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'no data found',
            ]);
        }
    }

    public function update(Request $request, $id) {
        $request->validate([
            'employee_name'=>'required',
            'email'=>'required|unique:employees',
            'phone'=>'numeric',
            'date_of_birth'=>'date_format:Y-m-d|before:today|nullable',
            'employee_image' => 'image|mimes:jpg,png',
        ]);

        $employe_model = Employee::find($id);

        $employe_model->employee_name = $request->employee_name;
        $employe_model->email = $request->email;
        $employe_model->address = $request->address;
        $employe_model->phone = $request->phone;
        $employe_model->date_of_birth = $request->date_of_birth;

        if ($request->hasFile('employee_image')) {
            if($request->file('employee-image')){
                $file = $request->file('employee_image');
                $file_extn = $file->getClientOriginalExtension();
                $file_name = time().'.'.$file_extn;
                $emp_img = move(public_path().'/uploads/employee', $file_name);

                $employe_model->employee_image = $file_name;

            }
        }

        $employe_model->save();

        if ($employe_model == true) {
            return response()->json([
                'status'=>200,
                'message'=>'Employee updated successfully!',
                'result'=>$employe_model,
            ]);
        } else {
            return response()->json([
                'status'=>404,
                'message'=>'failed',
                'result'=>[],
            ]);
        }
    }

    public function destroy($id) {
        if (!$id) {
            return response()->json([
                'status'=>404,
                'message'=>'No id found',
            ]);
        }

        $employe_model = Employee::find($id);

        if ($employe_model) {
            $employe_model->delete();

            return response()->json([
                'status'=>200,
                'message'=>'Employee deleted successfully!',
            ]);
        } else {
            return response()->json([
                'status'=>404,
                'message'=>'no data found',
            ]);
        }
    }
}
