<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\LayoutHelper;
use App\Http\Controllers\Controller;
use App\Models\Student;
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
        $data = [
            'banners' => $banners,
            'blocks' => $blocks,
            'subjects' => $subjects,
            'students' => $students,
        ];
        return view('frontend.index', $data);
    }
}