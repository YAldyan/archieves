<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Hisotem;
use App\Document;
use App\Profile;
use App\Item;
use App\UserItem;
use App\User;
use App\Requests;
use App\PIR;
use File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Mail\MyMail;
use Mail;

class HisotemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function pnghome()
    {
        Log::info('Masuk Home');

        $user = Auth::user();
 
        $tipe = $user->type ;

        //retirieve ID user yang sedang login.
        $user =  Profile::where('CD_PROFILE', $tipe )->first();

        Log::info('User: '.$user);

        // cek di tabel UserItem, apakah ada yang statusnya open dan ambil ID Item untuk ditampilkan di halaman QA.
        $useritem = UserItem::where([
                            ['STATUS','=',"OPEN"],
                            ['FK_ID_USER','=',$user->ID],
                  ])->get();

        Log::info('User Item : '.$useritem);
        
        // load divisi dari database
        $request = Requests::orderBy('ID','ASC')->get();
        $item = Item::orderBy('ID','ASC')->paginate(10);

        Log::info('Sebelum return');

        return view('PNG.home', compact('item', 'request','useritem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $user = Auth::user();
 
        $tipe = $user->type ;

        $profile = Profile::where('CD_PROFILE', $tipe)->first();

        $item = Item::orderBy('ID','ASC')->get();

        $history = Hisotem::where('FK_ID_ITEM', $id)->paginate(10);

        $document = Document::where('FK_USER_ID', $profile->ID)->get();

        $useritem = UserItem::where([
                            ['FK_ID_USER','=',$profile->ID],
                            ['FK_ID_ITEM','=',$id],
                  ])->first();


        return view('PNG.show_dokumen', compact('history', 'document','item','useritem'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('Masuk Store Hisotem Controller');
        Log::info('FK ARSIP REQ : '.$request['fk_arsip_req']);
        Log::info('FK ID ITEM : '.$request['fk_id_item']);

        // ambil nama item/proyek untuk dijadikan nama folder
        $item = Item::where('ID', $request['fk_id_item'])->first();

        // Disini proses mendapatkan judul dan memindahkan letak gambar ke folder image
        // $file       = $request->file('inputDOC');
        // $fileName   = $file->getClientOriginalName();
        // $request->file('inputDOC')->move("image/", $fileName);
        // Log::info($item->NM_ITEM);
        // Log::info($request->nm_doc);

        $file       = $request->file('inputDOC');
        $originalName   = $file->getClientOriginalName();

        // getting image extension
        $extension = $file->getClientOriginalExtension(); 
        
        // renameing image
        $fileName = $request['nm_arsip'].'.'.$extension; 

        // $destinationPath = public_path($item->NM_ITEM);
        $destinationPath = public_path('/document/'.$item->NM_ITEM);

        // if (File::exists($destinationPath)) {
        //     // path does not exist
        //     File::cleanDirectory($destinationPath);
        // }

        $request->file('inputDOC')->move($destinationPath, $fileName);

        $update = Hisotem::where([
                            ['FK_ID_ITEM','=',$request['fk_id_item']],
                            ['FK_ARSIP_REQ','=',$request['fk_arsip_req']],
                  ])->first();

        // $update = Hisotem::where('FK_ID_ITEM',$request['fk_id_item'])->where('FK_ARSIP_REQ',$request['fk_arsip_req'])->first();

        Log::info('Update : '.$update);

        $update->FILE_UPLOAD = '\document'.'\\'.$item->NM_ITEM;
        $update->UPLOAD_STAT = 'OK' ;
        $update->Filename = $fileName ;
        $update->save();

        // return response()->json($tambah);
        return redirect()->to('/history/item/'.$request['fk_id_item']);
    }

    public function download($fk_id_item, $fk_id_arsip){

        Log::info('FK ARSIP REQ : '.$fk_id_arsip);
        Log::info('FK ID ITEM : '.$fk_id_item);

        $hisotem = Hisotem::where([
                            ['FK_ID_ITEM','=',$fk_id_item],
                            ['FK_ARSIP_REQ','=',$fk_id_arsip],
                  ])->first();

        $arsip = Document::where('ID', $fk_id_arsip)->first();

        $file_path = public_path($hisotem->FILE_UPLOAD).'\\'.$hisotem->Filename;

        Log::info('File Arsip : '.$file_path);

        if (file_exists($file_path))
        {
            // Send Download
            return response()->download($file_path, $hisotem->Filename, [
                'Content-Length: '. filesize($file_path)
            ]);
        }
        else
        {
            // Error
            exit('Requested file does not exist on our server!');
        }
    }

    public function submit(Request $request, $fk_id_item){

        Log::info('FK ID ITEM : '.$fk_id_item);

        $user = Auth::user();
 
        $tipe = $user->type ;

        // retrieve user yg aktif sekarang.
        $profpng = Profile::where('CD_PROFILE', $tipe)->first();

        // retrieve arsip apa saja yang mesti di-upload oleh user yg aktif sekarang..
        $arsip = Document::where('FK_USER_ID', $profpng->ID)->get();

        $hisotem = Hisotem::where('FK_ID_ITEM', $fk_id_item)->get();

        foreach ($arsip as $ars) {
            foreach ($hisotem as $his) {
                if($ars->ID == $his->FK_ARSIP_REQ ){ 
                    Log::info('UPLOAD_STAT: '.$his->UPLOAD_STAT);
                    if($his->UPLOAD_STAT != "OK"){
                        return response()->json("NOT");
                    }
                }
            }
        } 

        // update status tabel USER_ITEM menjadi APRROVED
        $userpng = UserItem::where([
                            ['FK_ID_ITEM','=',$fk_id_item],
                            ['FK_ID_USER','=',$profpng->ID],
                  ])->first();
        $userpng->STATUS = "APPROVED" ;
        $userpng->PESAN  = $request['msg'] ;
        $userpng->update();

        // retrieve profile ID QA untuk di assign ke User QA.
        $profile = Profile::where('CD_PROFILE', $profpng->FLOW)->first();

        // insert item ke UserItem 
        $useritem = UserItem::where([
                            ['FK_ID_ITEM','=',$fk_id_item],
                            ['FK_ID_USER','=',$profile->ID],
                  ])->first();

        if(!$useritem){
            $useritem = new UserItem();
        }

        $useritem->FK_ID_ITEM = $fk_id_item ;
        $useritem->FK_ID_USER = $profile->ID ;
        $useritem->FK_USERS_ID = $user->id ;
        $useritem->STATUS = "OPEN" ;
        $useritem->save();


        // send email to Next User.
        $user = User::where('type',$profpng->FLOW)->first();
        $item = Item::where('ID',$fk_id_item)->first();

        Log::info('User : '.$user) ;
        Log::info('Item : '.$item) ;

        $myEmail = $user->email;
        $name = $user->name;

        Mail::to($myEmail)->send(new MyMail("Submitted",$name,
                            $request['msg'],$item->NM_ITEM));

        Log::info('Mail Send Successfully') ;

        return response()->json("OK");
    }

    /*
      SEMUA FUNGSI DI BAWAH ADALAH FUNGSI UNTUK JENIS USER QA
    */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
 
        $tipe = $user->type ;

        //retirieve ID user yang sedang login.
        $user =  Profile::where('CD_PROFILE', $tipe )->first();

        // cek di tabel UserItem, apakah ada yang statusnya open dan ambil ID Item untuk ditampilkan di halaman QA.
        $useritem = UserItem::where('FK_ID_USER',$user->ID)->get();
        
        // load divisi dari database
        // $request = Requests::orderBy('ID','ASC')->get();
        $item = Item::orderBy('ID','ASC')->paginate(10);

        $current = Carbon::now();

        $document = Document::where('Mandatory','No')->first();

        if(!$document){
            $document = new Document();
        }

        $hisotem = Hisotem::where('FK_ARSIP_REQ',$document->ID)->get();

        if(!$hisotem){
            $hisotem = new Hisotem();
        }

        $pir = PIR::where('PIR_DATE','<',$current)->get();

        return view('QA.home', compact('item', 'request','useritem','hisotem','pir'));
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function history($id)
    {
        //
        $user = Auth::user();
 
        $tipe = $user->type ;

        $profile = Profile::where('CD_PROFILE', 'PNG')->first();

        $item = Item::orderBy('ID','ASC')->get();

        $history = Hisotem::where('FK_ID_ITEM', $id)->paginate(10);

        $document = Document::where('FK_USER_ID', $profile->ID)->get();

        $profQA = Profile::where('CD_PROFILE', 'QA')->first();

        $useritem = UserItem::where([
                            ['FK_ID_USER','=',$profQA->ID],
                            ['FK_ID_ITEM','=',$id],
                  ])->first();

        log::info('UserItem : '.$useritem);

        return view('QA.show_dokumen', compact('history', 'document','item','useritem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload($id)
    {
        //
        $user = Auth::user();
 
        $tipe = $user->type ;

        $profile = Profile::where('CD_PROFILE', $tipe)->first();

        $item = Item::orderBy('ID','ASC')->get();

        $history = Hisotem::where('FK_ID_ITEM', $id)->get();

        $document = Document::where('FK_USER_ID', $profile->ID)->get();

        $useritem = UserItem::where([
                            ['FK_ID_USER','=',$profile->ID],
                            ['FK_ID_ITEM','=',$id],
                  ])->first();


        $profOPR = Profile::where('CD_PROFILE', $profile->FLOW)->first();

        $userOPR = UserItem::where([
                            ['FK_ID_USER','=',$profOPR->ID],
                            ['FK_ID_ITEM','=',$id],
                  ])->first();

        if(!$userOPR){
            $userOPR = new UserItem();    
        }

        // get id document untuk pir yang mandatory=="No"
        $dokumen = Document::where('Mandatory', 'NO')->first();

        Log::info("Dokumen Mandatory No : ".$dokumen);

        $current = Carbon::now();

        $pir = PIR::where([
                            ['FK_ID_PROJECT','=',$id],
                            ['FK_ID_DOCUMENT','=',$dokumen->ID],
                            ['PIR_DATE','<',$current],
                  ])->first();

        return view('QA.upload_dokumen', 
                    compact('history', 'document','item','useritem','userOPR','pir'));
    }

    public function unduh($fk_id_item, $fk_id_arsip){

        Log::info('FK ARSIP REQ : '.$fk_id_arsip);
        Log::info('FK ID ITEM : '.$fk_id_item);

        $hisotem = Hisotem::where([
                            ['FK_ID_ITEM','=',$fk_id_item],
                            ['FK_ARSIP_REQ','=',$fk_id_arsip],
                  ])->first();

        $arsip = Document::where('ID', $fk_id_arsip)->first();

        $file_path = public_path($hisotem->FILE_UPLOAD).'\\'.$hisotem->Filename;

        Log::info('File Arsip : '.$file_path);

        if (file_exists($file_path))
        {
            // Send Download
            return response()->download($file_path, $hisotem->Filename, [
                'Content-Length: '. filesize($file_path)
            ]);
        }
        else
        {
            // Error
            exit('Requested file does not exist on our server!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function simpan(Request $request)
    {
        Log::info('Masuk Store Hisotem Controller');
        Log::info('FK ARSIP REQ : '.$request['fk_arsip_req']);
        Log::info('FK ID ITEM : '.$request['fk_id_item']);

        // ambil nama item/proyek untuk dijadikan nama folder
        $item = Item::where('ID', $request['fk_id_item'])->first();

        $file       = $request->file('inputDOC');
        $originalName   = $file->getClientOriginalName();

        // getting image extension
        $extension = $file->getClientOriginalExtension(); 
        
        // renameing image
        $fileName = $request['nm_arsip'].'.'.$extension; 

        // $destinationPath = public_path($item->NM_ITEM);
        $destinationPath = public_path('/document/'.$item->NM_ITEM);

        $request->file('inputDOC')->move($destinationPath, $fileName);

        $update = Hisotem::where([
                            ['FK_ID_ITEM','=',$request['fk_id_item']],
                            ['FK_ARSIP_REQ','=',$request['fk_arsip_req']],
                  ])->first();

        Log::info('Update : '.$update);

        $update->FILE_UPLOAD = '\document'.'\\'.$item->NM_ITEM;
        $update->UPLOAD_STAT = 'OK' ;
        $update->Filename = $fileName ;
        $update->save();

        // return response()->json($tambah);
        return redirect()->to('/QA/upload/doc/'.$request['fk_id_item']);
    }

    public function transfer(Request $request, $fk_id_item){

        Log::info('FK ID ITEM : '.$fk_id_item);

        $user = Auth::user();
 
        $tipe = $user->type ;

        // retrieve user yg aktif sekarang.
        $profpng = Profile::where('CD_PROFILE', $tipe)->first();

        // retrieve arsip apa saja yang mesti di-upload oleh user yg aktif sekarang..
        $arsip = Document::where('FK_USER_ID', $profpng->ID)->get();

        $hisotem = Hisotem::where('FK_ID_ITEM', $fk_id_item)->get();

        foreach ($arsip as $ars) {
            foreach ($hisotem as $his) {
                if($ars->ID == $his->FK_ARSIP_REQ ){ 
                    if($his->UPLOAD_STAT != "OK" && $ars->Mandatory == "YES"){
                        return response()->json("NOT");  
                    }
                }
            }
        } 

        Log::info('Sebelum Update');

        // update status tabel USER_ITEM menjadi APRROVED
        $userpng = UserItem::where([
                            ['FK_ID_ITEM','=',$fk_id_item],
                            ['FK_ID_USER','=',$profpng->ID],
                  ])->first();

        $userpng->STATUS = "APPROVED" ;
        $userpng->PESAN= $request['msg'];
        $userpng->update();

        Log::info('Setelah Update');

        // retrieve profile ID QA untuk di assign ke User OPR.
        $profile = Profile::where('CD_PROFILE', $profpng->FLOW)->first();

        Log::info('Profile : '.$profile);

        // retrieve email user OPR.
        $usr = User::where('type',$profpng->FLOW)->first();

        Log::info('User OPR : '.$usr) ;

        // insert item ke UserItem 
        $useritem = UserItem::where([
                            ['FK_ID_ITEM','=',$fk_id_item],
                            ['FK_ID_USER','=',$profile->ID],
                  ])->first();

        if(!$useritem){
            $useritem = new UserItem();    
        }

        $useritem->FK_ID_ITEM = $fk_id_item ;
        $useritem->FK_ID_USER = $profile->ID ;
        $useritem->FK_USERS_ID = $usr->id ;
        $useritem->STATUS = "OPEN" ;
        $useritem->save();

        // send email untuk notifikasi kepada OPR.
        $usritm = UserItem::where([
                            ['FK_ID_ITEM','=',$fk_id_item],
                            ['FK_ID_USER','=',$profile->ID],
                  ])->first();

        Log::info('User Item : '.$usritm) ;

        // retrieve nama project.
        $item = Item::where('ID',$fk_id_item)->first();

        Log::info('Item : '.$item) ;

        $myEmail = $usr->email;
        $name = $usr->name;

        Mail::to($myEmail)->send(new MyMail("Submitted",$name,
                            $request['msg'],$item->NM_ITEM));

        Log::info('Mail Send Successfully') ;

        return response()->json("OK");
    }

    public function reject($fk_id_item){

        Log::info('Masuk Reject');

        $user = Auth::user();
 
        $tipe = $user->type ;

        $profile1 = Profile::where('CD_PROFILE', $tipe)->first();

        $useritem = new UserItem();
        $useritem = UserItem::where([
                            ['FK_ID_ITEM','=',$fk_id_item],
                            ['FK_ID_USER','=',$profile1->ID],
                  ])->first();

        $useritem->STATUS = "REJECTED" ;
        $useritem->update();

        // retrieve profile ID QA untuk di assign ke User PNG.
        $profile2 = Profile::where('CD_PROFILE', "PNG")->first();

        // retrieve user yg aktif sekarang.
        $userpng = new UserItem();
        $userpng = UserItem::where([
                            ['FK_ID_ITEM','=',$fk_id_item],
                            ['FK_ID_USER','=',$profile2->ID],
                  ])->first();
        
        $userpng->STATUS = "OPEN" ;
        $userpng->update();


        // send email untuk konfirmasi ke submitter bahwa dokumennya ditolak.

        // memperoleh id user png yg submit project
        // $usritm->FK_ID_USER
        $usritm = UserItem::where([
                            ['FK_ID_ITEM','=',$fk_id_item],
                            ['STATUS','=','OPEN'],
                  ])->first();

        Log::info('User Item : '.$usritm) ;

        // retrieve nama project.
        $item = Item::where('ID',$fk_id_item)->first();

        Log::info('Item : '.$item) ;

        // retrieve email user png.
        $user = User::where('ID',$usritm->FK_USERS_ID)->first();

        Log::info('User PNG : '.$user) ;

        $myEmail = $user->email;
        $name = $user->name;

        Mail::to($myEmail)->send(new MyMail("Rejected",$name,
                            'Dokumen Tidak Valid',$item->NM_ITEM));

        Log::info('Mail Send Successfully') ;

        return response()->json("OK");
    }

    public function completed(Request $request){

        Log::info('Masuk Completed');

        $item = Item::where('ID', $request['id_item'])->first();
        $item->STATUS = "COMPLETED" ;
        $item->update();

        // untuk retrieve ID dokument PIR.
        $dokumen = Document::where('Mandatory', 'NO')->first() ;

        // get the current time
        $current = Carbon::now() ;
        Log::info('Tanggal Sekarang : '.$current);

        // insert jadwal untuk melakukan PIR.
        $pir = new PIR();
        $pir->FK_ID_PROJECT = $request['id_item'] ;
        $pir->FK_ID_DOCUMENT = $dokumen->ID ;
        $pir->SUBMIT_DATE = Carbon::now() ;
        $pir->PIR_DATE = $current->addMonths(5);
        $pir->save();

        // kirim email notifikasi setelah document selesai di submit.

        // retrieve nama project.
        $item = Item::where('ID',$request['id_item'])->first();

        Log::info('Item : '.$item) ;

        // retrieve email user png.
        $user = Auth::user();

        Log::info('User OPR : '.$user) ;

        $myEmail = $user->email;
        $name = $user->name;

        Mail::to($myEmail)->send(new MyMail("Submitted",$name,
                            'Dokumen Siklus Pengembangan Proyek Lengkap',$item->NM_ITEM));

        Log::info('Mail Send Successfully') ;

        return response()->json("OK");
    }

    public function list(){

        Log::info('Masuk List');

        $item = Item::where('STATUS', "COMPLETED")->get();

        return view('QA.project_list')->with('item',$item) ;
    }
    /*
      SEMUA FUNGSI DI BAWAH ADALAH FUNGSI UNTUK JENIS USER OPR
    */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        Log::info('Masuk Home');

        $user = Auth::user();
 
        $tipe = $user->type ;

        //retirieve ID user yang sedang login.
        $user =  Profile::where('CD_PROFILE', $tipe )->first();

        Log::info('User: '.$user);

        // cek di tabel UserItem, apakah ada yang statusnya open dan ambil ID Item untuk ditampilkan di halaman QA.
        $useritem = UserItem::where([
                            ['STATUS','=',"OPEN"],
                            ['FK_ID_USER','=',$user->ID],
                  ])->get();

        Log::info('User Item : '.$useritem);
        
        // load divisi dari database
        $request = Requests::orderBy('ID','ASC')->get();
        $item = Item::orderBy('ID','ASC')->paginate(10);

        Log::info('Sebelum return');

        return view('OPR.home', compact('item', 'request','useritem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function load($id)
    {
        //

        Log::info('Masuk Load');

        $user = Auth::user();
 
        $tipe = $user->type ;

        $profile = Profile::where('CD_PROFILE', $tipe)->first();

        $item = Item::orderBy('ID','ASC')->get();

        $history = Hisotem::where('FK_ID_ITEM', $id)->get();

        $document = Document::where('FK_USER_ID', $profile->ID)->get();

        $useritem = UserItem::where([
                            ['FK_ID_USER','=',$profile->ID],
                            ['FK_ID_ITEM','=',$id],
                  ])->first();

        Log::info('Sebelum Return');

        return view('OPR.show_dokumen', 
                    compact('history', 'document','item','useritem'));

        // return view('OPR.home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        Log::info('Masuk Store Hisotem Controller');
        Log::info('FK ARSIP REQ : '.$request['fk_arsip_req']);
        Log::info('FK ID ITEM : '.$request['fk_id_item']);

        // ambil nama item/proyek untuk dijadikan nama folder
        $item = Item::where('ID', $request['fk_id_item'])->first();

        $file       = $request->file('inputDOC');
        $originalName   = $file->getClientOriginalName();

        // getting image extension
        $extension = $file->getClientOriginalExtension(); 
        
        // renameing image
        $fileName = $request['nm_arsip'].'.'.$extension; 

        // $destinationPath = public_path($item->NM_ITEM);
        $destinationPath = public_path('/document/'.$item->NM_ITEM);

        $request->file('inputDOC')->move($destinationPath, $fileName);

        $update = Hisotem::where([
                            ['FK_ID_ITEM','=',$request['fk_id_item']],
                            ['FK_ARSIP_REQ','=',$request['fk_arsip_req']],
                  ])->first();

        Log::info('Update : '.$update);

        $update->FILE_UPLOAD = '\document'.'\\'.$item->NM_ITEM;
        $update->UPLOAD_STAT = 'OK' ;
        $update->Filename = $fileName ;
        $update->save();

        // return response()->json($tambah);
        return redirect()->to('/OPR/history/item/'.$request['fk_id_item']);
    }

    public function move(Request $request, $fk_id_item){

        Log::info('FK ID ITEM : '.$fk_id_item);

        $user = Auth::user();
 
        $tipe = $user->type ;

        // retrieve user yg aktif sekarang.
        $profpng = Profile::where('CD_PROFILE', $tipe)->first();

        // retrieve arsip apa saja yang mesti di-upload oleh user yg aktif sekarang..
        $arsip = Document::where('FK_USER_ID', $profpng->ID)->get();

        $hisotem = Hisotem::where('FK_ID_ITEM', $fk_id_item)->get();

        foreach ($arsip as $ars) {
            foreach ($hisotem as $his) {
                if($ars->ID == $his->FK_ARSIP_REQ ){ 
                    Log::info('UPLOAD_STAT: '.$his->UPLOAD_STAT);
                    if($his->UPLOAD_STAT != "OK"){
                        return response()->json("NOT");
                    }
                }
            }
        } 

        Log::info('Sebelum Update');

        // update status tabel USER_ITEM menjadi APRROVED
        $userpng = UserItem::where([
                            ['FK_ID_ITEM','=',$fk_id_item],
                            ['FK_ID_USER','=',$profpng->ID],
                  ])->first();

        $userpng->STATUS = "APPROVED" ;
        $userpng->PESAN = $request['msg'] ;
        $userpng->update();

        Log::info('Setelah Update');

        // retrieve profile ID QA untuk di assign ke User QA.
        $profile = Profile::where('CD_PROFILE', $profpng->FLOW)->first();

        // retrieve user tujuan untuk assign project.
        $usr = User::where('type',$profpng->FLOW)->first();

        // insert item ke UserItem 
        $useritem = new UserItem();
        $useritem = UserItem::where([
                            ['FK_ID_ITEM','=',$fk_id_item],
                            ['FK_ID_USER','=',$profile->ID],
                  ])->first();

        $useritem->FK_ID_ITEM = $fk_id_item ;
        $useritem->FK_ID_USER = $profile->ID ;
        $useritem->FK_USERS_ID = $user->id ;
        $useritem->STATUS = "FINISHED" ;
        $useritem->save();

        // send email untuk notifikasi kepada OPR.
        // retrieve nama project.
        $item = Item::where('ID',$fk_id_item)->first();

        Log::info('Item : '.$item) ;

        $myEmail = $usr->email;
        $name = $usr->name;

        Mail::to($myEmail)->send(new MyMail("Submitted",$name,
                            $request['msg'],$item->NM_ITEM));

        Log::info('Mail Send Successfully') ;

        return response()->json("OK");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function OPR_DOC($id)
    {
        //
        $user = Auth::user();
 
        $tipe = $user->type ;

        $profile = Profile::where('CD_PROFILE', 'OPR')->first();

        $item = Item::orderBy('ID','ASC')->get();

        $history = Hisotem::where('FK_ID_ITEM', $id)->get();

        $document = Document::where('FK_USER_ID', $profile->ID)->get();

        $profQA = Profile::where('CD_PROFILE', 'QA')->first();

        $useritem = UserItem::where([
                            ['FK_ID_USER','=',$profQA->ID],
                            ['FK_ID_ITEM','=',$id],
                  ])->first();

        log::info('UserItem : '.$useritem);

        return view('QA.show_doc_opr', compact('history', 'document','item','useritem'));
    }

    public function unduh_opr($fk_id_item, $fk_id_arsip){

        Log::info('FK ARSIP REQ : '.$fk_id_arsip);
        Log::info('FK ID ITEM : '.$fk_id_item);

        $hisotem = Hisotem::where([
                            ['FK_ID_ITEM','=',$fk_id_item],
                            ['FK_ARSIP_REQ','=',$fk_id_arsip],
                  ])->first();

        $arsip = Document::where('ID', $fk_id_arsip)->first();

        $file_path = public_path($hisotem->FILE_UPLOAD).'\\'.$hisotem->Filename;

        Log::info('File Arsip : '.$file_path);

        if (file_exists($file_path))
        {
            // Send Download
            return response()->download($file_path, $hisotem->Filename, [
                'Content-Length: '. filesize($file_path)
            ]);
        }
        else
        {
            // Error
            exit('Requested file does not exist on our server!');
        }
    }

    public function tolak($fk_id_item){

        Log::info('Masuk Tolak');

        $user = Auth::user();
 
        $tipe = $user->type ;

        $profile1 = Profile::where('CD_PROFILE', $tipe)->first();

        $useritem = new UserItem();
        $useritem = UserItem::where([
                            ['FK_ID_ITEM','=',$fk_id_item],
                            ['FK_ID_USER','=',$profile1->ID],
                  ])->first();

        $useritem->STATUS = "REJECTED" ;
        $useritem->update();

        // retrieve profile ID QA untuk di assign ke User QA.
        $profile2 = Profile::where('CD_PROFILE', 'OPR')->first();

        // retrieve user yg aktif sekarang.
        $useropr = new UserItem();
        $useropr = UserItem::where([
                            ['FK_ID_ITEM','=',$fk_id_item],
                            ['FK_ID_USER','=',$profile2->ID],
                  ])->first();
        
        $useropr->STATUS = "OPEN" ;
        $useropr->update();

        // send email untuk konfirmasi ke submitter bahwa dokumennya ditolak.

        // memperoleh id user png yg submit project
        // $usritm->FK_ID_USER
        $usritm = UserItem::where([
                            ['FK_ID_ITEM','=',$fk_id_item],
                            ['STATUS','=','OPEN'],
                  ])->first();

        Log::info('User Item : '.$usritm) ;

        // retrieve nama project.
        $item = Item::where('ID',$fk_id_item)->first();

        Log::info('Item : '.$item) ;

        // retrieve email user png.
        $user = User::where('ID',$usritm->FK_USERS_ID)->first();

        Log::info('User OPR : '.$user) ;

        $myEmail = $user->email;
        $name = $user->name;

        Mail::to($myEmail)->send(new MyMail("Rejected",$name,
                            'Dokumen Tidak Valid',$item->NM_ITEM));

        Log::info('Mail Send Successfully') ;

        return response()->json("OK");
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
        //
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
    }
}
