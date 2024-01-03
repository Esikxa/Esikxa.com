<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\LayoutHelper;
use App\Http\Controllers\Controller;
use App\Repositories\BannerRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $banner;
    public function __construct(BannerRepository $banner)
    {
        $this->banner = $banner;
    }
    public function index(Request $request)
    {
        $request['status'] = true;
        $banners = $this->banner->dataProvider($request, false);
        $blocks = LayoutHelper::blocks();
        $data = [
            'banners' => $banners,
            'blocks' => $blocks
        ];
        return view('frontend.index', $data);
    }
}
