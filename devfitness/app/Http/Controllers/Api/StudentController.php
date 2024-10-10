<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() 
    {
        $students = Student::all();

        return response()->json([
            'status' => true,
            'students' => $students,
        ], 200);
    }
}
