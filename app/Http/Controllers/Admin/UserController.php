<?php

namespace App\Http\Controllers\Admin;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Division;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return view('admin.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data2 = Division::all();
        return view('admin.user.create', compact('data2'));
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
        return redirect('/admin/user')->with('success', 'User data added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        $data2 = Division::all();
        $data3 = [
            [
                "role" => "client"
            ],
            [
                "role" => "admin"
            ],
            [
                "role" => "technician"
            ],
            [
                "role" => "manager"
            ],
        ];

        return view('admin.user.edit', compact('data', 'data2', 'data3'));
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
        $user = User::find($id);
        $user->update([
            'role' => $request->role
        ]);
        Employee::find($user->employeeId)->update([
            'name' => $request->name,
            'divisionId' => $request->divisionId,
            'tel' => $request->tel,
            'address' => $request->address
        ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Employee::find($user->employeeId)->delete();
        return back();
    }
    public function reset($id)
    {
        $newPassword = Str::random(8);
        $user = User::find($id)->update([
            'password' => Hash::make($newPassword)
        ]);
        return back()->with('success', 'Reset password successful, new password: '.$newPassword);
    }
}
