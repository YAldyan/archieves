<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
    {
        // Log::info("Masuk Divisi Controller Index");

        // load divisi dari database
        $profile = Profile::orderBy('ID','ASC')->paginate(5);
        return view('admin.show_profile')->with('profile',$profile) ;     
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function flow()
    {
        // Log::info("Masuk Divisi Controller Index");

        // load divisi dari database
        $profile = Profile::orderBy('ID','ASC')->get();
        return view('admin.edit_flow')->with('profile',$profile) ;     
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveflow(Request $request)
    {
        // load divisi dari database
        $id = $request['id_prof'];
        $flow = $request['nm_prof'];

        Log::info("ID : ".$id." Name : ".$flow);

        $update = Profile::where('ID', $id)->first();
        $update->FLOW = $flow = $request['nm_prof']; 
        $update->update();

        return response()->json("OK");     
        
    }

	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.new_profile') ;
    }

	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
                                    'cd_profile' => 'required',
                                    'nm_profile' => 'required'
                        ]);

        $tambah = new Profile();
        
        $tambah->NM_PROFILE = $request['nm_profile'];
        $tambah->CD_PROFILE = $request['cd_profile'];

        $tambah->save();

        return redirect()->to('/show/profile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Log::info("Masuk Divisi Controller Update");
       
        $update = Profile::where('id', $id)->first();
        $update->NM_PROFILE = $request->nm_profile;
        $update->CD_PROFILE = $request->cd_profile;

        $update->update();

        return response()->json($update);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $delete = Profile::destroy($id);
        return response()->json($delete);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProfile ()
    {
        //
        $profile = Profile::orderBy('id','ASC')->get();
        return response()->json($profile); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editUser ()
    {
        $user = Auth::user();
        return view('edituser')->with('user',$user) ;   
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editUserProfile (Request $request)
    {
        $name = $request['name'] ;
        $username = $request['username'] ;
        $email = $request['email'] ;

        if(!$name && !$username && !$email){
            $usr = Auth::user();
            $link = '/'.strtolower($usr->type).'/user/edit' ;
            return redirect()->to($link);
        }

        $user = User::where('id',Auth::user()->id)->first();

        $user->name = $name ;
        $user->username = $username ;
        $user->email = $email ;
        $user->update();

        return response()->json('OK'); 
    }
}
