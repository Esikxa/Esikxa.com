<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use App\Models\RequestTutor;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        return view('frontend.student.pages.dashboard');
    }
    public function requestTutor($slug)
    {
        $teacher = Teacher::where('slug', $slug)->first();
        if (!$teacher) {
            abort(404);
        }
        RequestTutor::create([
            'uuid' => Str::uuid(),
            'student_id' => auth('student')->user()->student->id,
            'teacher_id' => $teacher->id
        ]);
        return redirect()->back()->with('success', 'Request sent successfully.');
    }
}
