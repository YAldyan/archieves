<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use App\Profile;
use Illuminate\Contracts\Auth\Guard;

class AdminMiddleware
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $profile = Profile::where('ID', $this->auth->getUser()->profile)->first();
         
        //Log::info("User : "+$this->auth->getUser()->profile);

        if ($this->auth->getUser()->type == 'QA') {
            return $next($request);
        } else if ($this->auth->getUser()->type == 'PNG') {
            return redirect('/PNG/home');
        } else if ($this->auth->getUser()->type == 'OPR') {
            return redirect('/OPR/home');
        } else if ($this->auth->getUser()->type == 'TS') {
            return redirect('/TS/home');
        }    
    }
}
