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
    public function index()
    {
        $data = User::all();
        return view('admin.user.index', compact('data'));

    }

    public function create()
    {
        $data2 = Division::all();
        return view('admin.user.create', compact('data2'));
    }

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

    public function edit($id)
    {
        $data = User::find($id);
        $data2 = [
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

        return view('admin.user.edit', compact('data', 'data2'));
    }
}
