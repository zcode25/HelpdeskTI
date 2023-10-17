<?php

namespace App\Http\Controllers\admin;
use App\Models\Employee;
use App\Models\Division;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Employee::all();
        $data2 = Division::all();
        return view('admin.employee.index', compact('data','data2'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data2 = Division::all();
        return view('admin.employee.create', compact('data2'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = IdGenerator::generate(['table' => 'employees', 'field' => 'employeeId', 'length' => 10, 'prefix' => 'EMP']);
        Employee::create([
            'employeeId' => $id,
            'name' => $request['name'],
            'divisionId' => $request['divisionId'],
            'email' => $request['email'],
            'tel' => $request['tel'],
            'address' => $request['address']
        ]);

        $request["password"] = Hash::make($request["password"]);

        User::create([
            'userId' => Str::uuid(),
            'employeeId' => $id,
            'role' => $request['role'],
            'password' => $request["password"]
        ]);
        return redirect('/admin/employee')->with('success', 'Employee data added successfully');
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Employee::find($id);
        $data2 = Division::all();
        return view('admin.employee.edit', compact('data'), compact('data2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Employee::find($id)->update($request->all());
        return redirect('/admin/employee')->with('success', 'Employee data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::find($id)->delete();
        return back();
    }
}
