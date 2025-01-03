<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if(!Auth::check()) {
            return redirect('/login');
        }

        $keyword = $request->keyword;
        $category_id = $request->category_id;
        $gender = $request->gender;
        $date = $request->date;

        $contacts = Contact::with('category')
        ->KeywordSearch($keyword)
        ->GenderSearch($gender)
        ->CategorySearch($category_id)
        ->DateSearch($date)
        ->paginate(7);

        $categories = Category::all();

        return view('admin.admin',compact('contacts','categories','keyword','category_id','gender','date'));
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }
}
