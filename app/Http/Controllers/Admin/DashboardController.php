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
    public function divisionCreate() {

    }
    public function divisionStore() {
        $id = IdGenerator::generate(['table' => 'divisions', 'field' => 'divisionId', 'length' => 5, 'prefix' => 'DV']);
        Division::create([
            'divisionId' => $id,
            'divisionName' => Str::random(5)
        ]);
        return $id;
    }
}
