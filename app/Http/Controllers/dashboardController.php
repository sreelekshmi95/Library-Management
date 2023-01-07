<?php

namespace App\Http\Controllers;
use App\Http\Requests\changePasswordRequest;
use App\Models\auther;
use App\Models\book;
use App\Models\book_issue;
use App\Models\category;
use App\Models\publisher;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
class dashboardController extends Controller
{
    public function index()
    {


        error_log('calling api.');
        $response1 = Http::get('http://api.ipstack.com/82.10.163.88?access_key=2bcacbb347747fdf74bd74983ef77b42');

        $country_name = $response1->json($key = 'country_name');
        $region_name=$response1->json($key = 'region_name');
        error_log($region_name);
        error_log($country_name);

        return view('dashboard', [
            'authors' => auther::count(),
            'publishers' => publisher::count(),
            'categories' => category::count(),
            'books' => book::count(),
            'students' => student::count(),
            'issued_books' => book_issue::count(),
            'country' => $country_name,
            'region' => $region_name,
        ]);
    }
// password changing
    public function change_password_view()
    {
        return view('reset_password');
    }

    public function change_password(changePasswordRequest $request)
    {
        if (Auth::check(["username" => auth()->user()->username, "password" => $request->c_password])) {
            auth()->user()->password = bcrypt($request->password);
            return redirect()->back()->with(['message' => "Password Changed Successfully!."]);
        } else {
            return "";
        }
    }
}
