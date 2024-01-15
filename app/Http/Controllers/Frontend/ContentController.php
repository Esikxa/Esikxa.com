<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\ContentRepository;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    protected $content;
    public function __construct(ContentRepository $content)
    {
        $this->content = $content;
    }
    public function show($page, $slug = null)
    {
        $slug = empty($slug) ? $page : $slug;
        $content = $this->content->where('slug', $slug)->where('status', 1)->first();
        if (!$content) {
            abort('404');
        }
        return view('frontend.pages.content', compact('content'));
    }
}
