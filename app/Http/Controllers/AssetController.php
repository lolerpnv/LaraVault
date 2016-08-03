<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class AssetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //post file
    public function upload(Request $request){

        $file = $request->file('fileToUpload');

        //prep private
        if(!$request->request->get('private'))$private = "off";
        else $private = $request->request->get('private');

        //Save in DB
        if($request->user()->assets()->create([
            'name' => $file->getClientOriginalName(),
            'reference' => md5($file->getClientOriginalName().$request->user()),
            'user_id' => $request->user(),
            'size' => $file->getClientSize(),
            'private' => $private
        ]))
            //Save file
            $file->move(storage_path().'/app',md5($file->getClientOriginalName().$request->user()));

        return redirect('/files');
    }

    //display current files
    public function index(Request $request)
    {
        $assets = $request->user()->assets()->get();
        return view('assets.index', [
            'assets' => $assets,
        ]);
    }

    //download return response()->download(storage_path().'/app/'.$file[0]->reference,$file[0]->name);
    public function getAsset(Request $request,$name)
    {
        $file = DB::table('assets')->where('reference','=',$name)->get();
        if (Auth::guard(null)->guest()){
            if($file[0]->private == 'off'){
            return response()->download(storage_path().'/app/'.$file[0]->reference,$file[0]->name);
            }else{return redirect('/');}
        }
        else{
            $user_id = DB::table('users')->where('email','=',$request->user()->email)->get();
            if($file[0]->user_id == $user_id[0]->id){
                return response()->download(storage_path().'/app/'.$file[0]->reference,$file[0]->name);
            }else{

            }
        }
    }
    public function destroy(Request $request,$name)
    {
        print_r(DB::table('assets')->where('reference','=',$name)->get());
    }
}
