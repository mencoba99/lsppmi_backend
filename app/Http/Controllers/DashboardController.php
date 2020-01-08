<?php

namespace App\Http\Controllers;

use App\Mail\CobaEmail;
use Illuminate\Http\Request;
use Mailgun\Mailgun;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->check() === false) {
            return redirect('login');
        }

        $crumbs = explode("/",$_SERVER["REQUEST_URI"]);

        return view('dashboard', compact('crumbs'));
    }

    public function login()
    {
        if (auth()->check()) {
            redirect()->route('dashboard');
        } else {
            return view('login');
        }
    }

    public function loginProcess(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $email    = $request->get('email');
        $password = $request->get('password');
        $remember = $request->get('remember');

        if (auth()->attempt(['email' => $email, 'password' => $password], $remember)) {
            return redirect('/');
        } else {
            return redirect('login');
        }
    }

    public function logout()
    {
        \Auth::logout();
        return redirect('login');
    }

    public function testing()
    {
        \Mail::to('akmal.squal@gmail.com')->send(new CobaEmail());

//        $mgClient = Mailgun::create('key-7cb73884caad6ac7f19bb87eccecdcea');
//
//        $mgClient->messages()->send('devbackend.lsppmi.id', [
//            'from' => '<noreply@lsppmi.id>',
//            'to' => 'akmal.squal@gmail.com',
//            'subject' => 'Tes Email',
//            'text' => 'COba email'
//        ]);

    }
}
