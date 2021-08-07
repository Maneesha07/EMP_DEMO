<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Designation;
use App\Http\Requests\EmployeeRequest;
use Mail;
use App\Mail\EmpSignup;
use DataTables;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('image', function($row) {
                        if ($row->image) {
                            return '<img src="'.$row->image().'" border="0" width="40" class="img-rounded" align="center" />';                            
                        } else {
                            $url= asset('/employee/img/dummy.png');
                            return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center">';
                        }
                    })
                    ->addColumn('designation', function($row) {
                        return $row->designation->title;
                    })  
                    ->addColumn('action', function($row){
                        return view('employees.actions', ['employee' => $row]);
                    })
                    ->rawColumns(['image','designation','action'])
                    ->make(true);
        }
      
        return view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designations = Designation::get();
        return view('employees.create', compact('designations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\EmployeeRequest $request :request
     * @param \App\Employee $employee :model
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EmployeeRequest $request, Employee $employee)
    {
        if ($request->file('profile_image')) {
            $imageName = time() . rand(1000, 9999) . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('/employee/img/'), $imageName);
            $request->request->add(['image' => $imageName]);
        }
        $pwd = Str::random(8);
        $request->request->add(['password' => Hash::make($pwd)]);
        $employee->create($request->all());
        // Send mail 
        $datas = ['name'=>$request->name,'subject'=>'Welcome to Demo Site','email' => $request->email,'password' => $pwd];
        Mail::to($request->email)->send(new EmpSignup($datas));
   
        return redirect()->route('employees.index')->withStatus(__('Employee successfully created !!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Employee $employee :model
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $designations = Designation::get();
        return view('employees.edit', compact('designations','employee'));
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Http\Requests\EmployeeRequest $request        :request
     * @param \App\Employee $employee :model
     * @return Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        if ($request->file('profile_image')) {
            $image_path = public_path('/employee/img/') . $employee->image;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $imageName = time() . rand(1000, 9999) . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('/employee/img/'), $imageName);
            $request->request->add(['image' => $imageName]);
        }
        $employee->update($request->all());

        return redirect()->route('employees.index')->withStatus(__('Employee successfully updated !!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $image_path = public_path('/employee/img/') . $employee->image;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $employee->delete();

        return redirect()->route('employees.index')->withStatus(__('Employee details successfully deleted !!'));
    }
}
