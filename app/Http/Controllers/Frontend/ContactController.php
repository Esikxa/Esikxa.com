<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.pages.contact');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required',
            'email' => 'nullable|email',
            'contact' => 'nullable',
            'subject' => 'nullable',
            'message' => 'nullable',
        ]);
        try {
            DB::beginTransaction();
            $data = $request->all();
            Contact::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Your contact has been saved successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Oops! something went wrong.');
        }
    }
}
