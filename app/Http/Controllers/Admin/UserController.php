<?php

namespace App\Http\Controllers\Admin;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Division;
use App\Models\Skill;
use App\Models\TechSkill;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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

        $validatedData = $request->validate([
            'employeeId'    => 'required|max:10',
            'name'          => 'required|max:50',
            'divisionId'    => 'required',
            'email'         => 'required|email|unique:employees',
            'tel'           => 'required|max:15',
            'address'       => 'required',
            'role'          => 'required',
            'password'      => 'required|min:8|max:50'
        ]);

        Employee::create([
            'employeeId'    => $validatedData['employeeId'],
            'name'          => $validatedData['name'],
            'divisionId'    => $validatedData['divisionId'],
            'email'         => $validatedData['email'],
            'tel'           => $validatedData['tel'],
            'address'       => $validatedData['address'],
        ]);
        
        $validatedData['userId'] = Str::uuid();
        $validatedData['password'] = Hash::make($request["password"]);

        User::create([
            'userId'        => $validatedData['userId'],
            'employeeId'    => $validatedData['employeeId'],
            'role'          => $validatedData['role'],
            'password'      => $validatedData['password'],
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
                "role" => "Client"
            ],
            [
                "role" => "Admin"
            ],
            [
                "role" => "Technician"
            ],
            [
                "role" => "Manager"
            ],
        ];
        $data4 = Category::all();

        $data5 = TechSkill::where('userId', $id)->get();

        return view('admin.user.edit', compact('data', 'data2', 'data3', 'data4', 'data5'));
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
        $validatedData = $request->validate([
            'employeeId'    => 'required|max:10',
            'name'          => 'required|max:50',
            'divisionId'    => 'required',
            'email'         => 'required|email',
            'tel'           => 'required|max:15',
            'address'       => 'required',
        ]);

        $user = user::where('userId', $id)->first();
        $employee = Employee::where('employeeId', $user->employee->employeeId)->first();

        if ($request->employeeId == $user->employee->employeeId) {
            $validatedData['employeeId'] = $request->employeeId;
        }

        if ($request->email == $user->employee->email) {
            $validatedData['email'] = $request->email;
        }

        Employee::find($employee->employeeId)->update($validatedData);
        return back()->with('success', 'Employee data updated successfully');
    }

    public function updateRole(Request $request, User $user) {
        $validatedData = $request->validate([
            'role'    => 'required',
        ]);
   
        User::where('userId', $user->userId)->update($validatedData);
        return back()->with('success', 'Account updated successfully');
    }

    public function resetPassword(User $user) {

        User::where('userId', $user->userId)->update([
            'password' => Hash::make('password')
        ]);
        return back()->with('success', 'Reset password successful, new password: password');
    }

    public function createSkill(Request $request) {
        $validatedData = $request->validate([
            'categoryId'    => 'required',
            'skillName'     => 'required',
            'skillDesc'     => 'required',
            'userId'        => 'required',
            'certificate'   => 'required|mimes:pdf,png,jpg|max:2048',
        ]);

        if($request->file('certificate')) {
            $validatedData['certificate'] = $request->file('certificate')->store('certificate');
        }

        $skillTechId = IdGenerator::generate(['table' => 'tech_skills', 'field' => 'skillTechId', 'length' => 5, 'prefix' => 'ST']);
        $validatedData['skillTechId'] = $skillTechId;

        TechSkill::create($validatedData);
        
        return back()->with('success', 'Skill added successfully');
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
        return back()->with('success', 'User deleted successfully');
    }
    
    public function destroySkill(TechSkill $techSkill) {

        if($techSkill->certificate) {
            Storage::delete($techSkill->certificate);
        }

        TechSkill::where('skillTechId', $techSkill->skillTechId)->delete();
        return back()->with('success', 'Skill deleted successfully');

    }
    
}
