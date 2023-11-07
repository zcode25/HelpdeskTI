<?php

namespace App\Http\Controllers\Admin;
use App\Models\Division;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class DashboardController extends Controller
{
    public function index() {
        return view('admin.dashboard.index');
    }
}
