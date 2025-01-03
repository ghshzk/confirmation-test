<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::with('category')->get();
        $categories = Category::all();

        $input = $request->session()->get('contact_data',[]);
        return view('contact.index',compact('contacts','categories','input'));
    }

    public function confirm(ContactRequest $request)
    {
        $category = Category::find($request->category_id);
        $contact = $request->only(['last_name','first_name','gender','email','tel1','tel2','tel3','address','building','category_id','detail']);

        session(['contact_data' => $contact]);
        return view('contact.confirm',compact('contact','category'));
    }

    public function store(Request $request)
    {
        $contact = $request->only(['last_name','first_name','gender','email','tel','address','building','category_id','detail']);
        $tel = $request->tel1 . $request->tel2 . $request->tel3;
        Contact::create($contact,$tel);

        $request->session()->forget('contact_data');
        return view('contact.thanks');
    }
}
