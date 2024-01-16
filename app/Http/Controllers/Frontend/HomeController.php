<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\LayoutHelper;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Repositories\BannerRepository;
use App\Repositories\SubjectRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $banner, $subject, $student;
    public function __construct(BannerRepository $banner, SubjectRepository $subject, Student $student)
    {
        $this->banner = $banner;
        $this->subject = $subject;
    }
    public function index(Request $request)
    {
        $request['status'] = true;
        $banners = $this->banner->dataProvider($request, false);
        $request['popular'] = true;
        $subjects = $this->subject->dataProvider($request, false);
        $blocks = LayoutHelper::blocks();
        $students = Student::all();
        $teachers = Teacher::all();
        $data = [
            'banners' => $banners,
            'blocks' => $blocks,
            'subjects' => $subjects,
            'students' => $students,
            'teachers' => $teachers,
        ];
        return view('frontend.index', $data);
    }
    public function teacherList(Request $request)
    {
        $teachers = Teacher::all();

        return view('frontend.teachers', compact('teachers'));
    }
    public function teacherProfile($slug)
    {
        $teacher = Teacher::where('slug', $slug)->first();
        if (!$teacher) {
            abort(404);
        }
        return view('frontend.single-teacher', compact('teacher'));
    }
}
