<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view('user', [
            'users' => $users,
            'title' => 'User Page'
        ]);
    }

    function listUser($id=null){
        return $id? User::find($id):User::all();
    }

    function postCoba(Request $req){
        $user= new User;
        $user->name=$req->name;
        $user->email=$req->email;
        $user->password=$req->password;
        $result=$user->save();
        if($result){
            return ["Result"=>"Saved Tjuy"];
        }
        else{
            return ["Result"=>"GAGAL COK"];
        }
    }

    function updateCoba(Request $req){
        $user= User::find($req->id);
        $user->name=$req->name;
        $user->email=$req->email;
        $user->password=$req->password;
        $result=$user->save();
        if($result){
            return ["Result"=>"Saved Tjuy"];
        }
        else{
            return ["Result"=>"GAGAL COK"];
        }
    }

    function searchCoba($name){
        // return User::where("name","like","%".$name."%")->get();
        // return User::where("name",$name)->get();
        $result=User::where("name","like","%".$name."%")->get();
        if(count($result) > 0){
            return $result;
        }
        else{
            return ["$name "."Not Found"];
        }
    }

    function  deleteCoba($id){
        $user= User::find($id);
        $result=$user->delete();
        if($result){
            return ["Result"=>"Deleted Id :".$id];
        }
        else{
            return ["Result"=>"Gagal Hapus"];
        }
    }

    function validCoba(Request $req){
        $rules=array(
            "email"=>"required|email|regex:/^.+@.+$/i"
        );   
        $validator= Validator::make($req->all(),$rules);
        if($validator->fails()){
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }
        else{
            $user= new User;
            $user->name=$req->name;
            $user->email=$req->email;
            $user->password=$req->password;
            $result=$user->save();
            if($result){
                return ["Result"=>"Saved Tjuy"];
            }
            else{
                return ["Result"=>"GAGAL COK"];
            }
        }
    }
}

