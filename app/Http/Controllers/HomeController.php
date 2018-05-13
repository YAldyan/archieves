<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MyMail;
use Mail;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Send My Test Mail Example
     *
     * @return void
     */
    public function myMail()
    {
        Log::info('Masuk My Email') ;

        $myEmail = 'aldi_ian17plus@yahoo.co.id';
        Mail::to($myEmail)->send(new MyMail());

        Log::info('Lewat Proses Send Email') ;

        return "Mail Send Successfully";
    }
}
