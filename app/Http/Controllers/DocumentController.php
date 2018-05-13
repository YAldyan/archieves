<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Document;
use App\Requests;
use App\Profile;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $request = Requests::orderBy('ID','ASC')->get();
        $profile = Profile::orderBy('ID','ASC')->get();

        return view('admin.insert_dokumen', compact('profile', 'request')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
        $this->validate($request, [
                                    'fk_req' => 'required',
                                    'fk_user_id' => 'required',
                                    'nm_arsip' => 'required'
                        ]);

        $tambah = new Document();
        
        $tambah->fk_req = $request['fk_req'];
        $tambah->fk_user_id = $request['fk_user_id'];
        $tambah->nm_arsip = $request['nm_arsip'];
        
        $tambah->save();

        return redirect()->to('/show/document');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        Log::info("Masuk Bagian Controller Show");

        // load divisi dari database
        $request = Requests::orderBy('ID','ASC')->get();
        $document = Document::orderBy('ID','ASC')->paginate(10);
        $profile = Profile::orderBy('ID','ASC')->get();

        // return view('admin.show_bagian')->with('showBag',$showBag) ;

        return view('admin.show_dokumen', compact('document', 'request', 'profile'));
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
       
        $update = Document::where('ID', $id)->first();
        
        $update->FK_REQ = $request->fk_req;
        $update->FK_USER_ID = $request->fk_user_id;
        $update->NM_ARSIP = $request->nm_doc;

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
        $delete = Document::destroy($id);
        return response()->json($delete);
    }
}
