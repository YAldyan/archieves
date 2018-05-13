<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requests;

class RequestController extends Controller
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
        $request = Requests::orderBy('ID','ASC')->paginate(5);
        return view('admin.show_request')->with('request',$request) ;     
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.new_request') ;
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
                                    'nm_req' => 'required'
                        ]);

        $tambah = new Requests();
        
        $tambah->NM_REQ = $request['nm_req'];

        $tambah->save();

        return redirect()->to('/show/request');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        // Log::info("Masuk Divisi Controller Update");
       
        $update = Requests::where('id', $id)->first();
        $update->NM_REQ = $request->nm_req;

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
        $delete = Requests::destroy($id);
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
        $request = Requests::orderBy('id','ASC')->get();
        return response()->json($request); 
    }
}
