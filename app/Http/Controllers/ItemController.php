<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Document;
use App\Requests;
use App\Hisotem;
use App\UserItem;
use App\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
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

        return view('PNG.create_item')->with('request',$request) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_item)
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
                                    'nm_item' => 'required'
                        ]);

        $tambah = new Item();
        
        $tambah->FK_CAT_REQ = $request['fk_req'];
        $tambah->NM_ITEM = $request['nm_item'];
        $tambah->STATUS = 'NOT COMPLETED' ;
        
        $tambah->save();

        // $search = Item::where('NM_ITEM', $request['nm_item'])->first();

        $arsip = Document::where('FK_REQ', $request['fk_req'])->get();

        foreach ($arsip as $ars) {
            $history = new Hisotem();
            
            $history->FK_ID_ITEM = $tambah->ID;
            $history->FK_ARSIP_REQ = $ars->ID ;
            $history->UPLOAD_STAT = 'NOT' ;

            $history->save();
        }

        $user = Auth::user();

        Log::info("User : ".$user);
 
        $tipe = $user->type ;

        $profile = Profile::where('CD_PROFILE', $tipe)->first();

        $useritem = new UserItem();
        $useritem->FK_ID_ITEM = $tambah->ID ;
        $useritem->FK_ID_USER = $profile->ID ;
        $useritem->FK_USERS_ID = $user->id;
        $useritem->STATUS = 'OPEN';
        $useritem->save();
        //$request = Document::where('id', $request['fk_req'])->first();

        return redirect()->to('/show/item');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        // load divisi dari database
        $request = Requests::orderBy('ID','ASC')->get();
        $item = Item::orderBy('ID','ASC')->paginate(10);
        $useritem = UserItem::orderBy('ID','ASC')->get();
        $profile = Profile::where('CD_PROFILE', Auth::user()->type)->first();

        Log::info("Auth User : ".Auth::user());
        Log::info("Auth User Id : ".Auth::user()->id);

        return view('PNG.show_item', compact('item', 'request', 'useritem', 'profile'));
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
       
        $update = Item::where('ID', $id)->first();
        
        $update->FK_CAT_REQ = $request->fk_req;
        $update->NM_ITEM = $request->nm_item;

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
        $delete = Item::destroy($id);
        return response()->json($delete);
    }
}
