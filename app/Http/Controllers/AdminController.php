<?php

namespace App\Http\Controllers;

use App\Chat;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth","user_role"]);
    }

    public function index(){
        $users=User::where("type","user")->orderBy("id","desc")->paginate(15);
        return view("admin.users.index",["users"=>$users]);
    }
    public function addNewUser(Request $request){
        if($request->method()=="GET"){
            return view("admin.users.add");
        }
        else{
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user=User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            if($user){
                session()->flash("success","User Added Sucessfully");
                return redirect("/admin");
            }
        }
    }
    public function updateUser($id,Request $request){
        if($request->method()=="GET"){
            $user=User::findOrFail($id);
            return view("admin.users.update",["user"=>$user]);
        }
        else{
            $user=User::findOrFail($id);
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->ignore($user->id),]
            ]);
            $user->name=$request->name;
            $user->email=$request->email;
            if($request->password !=""){
                $user->password=Hash::make($request->password);
            }
            $user->save();
            if($user){
                session()->flash("success","User Updated  Sucessfully");
                return redirect("/admin");
            }
        }
    }
    public function deleteUser($id,Request $request){
        if($request->method()=="GET"){
            $user=User::findOrFail($id);
            return view("admin.users.delete",["user"=>$user]);
        }
        else{
            $user=User::findOrFail($id);
            Chat::where("user_id",$id)->delete();
            $user->delete();
            if($user){
                session()->flash("success","User Deleted  Sucessfully");
                return redirect("/admin");
            }
        }
    }
    public function blockUser($id,Request $request){
        if($request->method()=="GET"){
            $user=User::findOrFail($id);
            if($user->block==0){
                $message="Block";
            }
            else{
                $message=" Un Block";
            }
            return view("admin.users.block",["user"=>$user,"message"=>$message]);
        }
        else{
            $user=User::findOrFail($id);
            $user->block=!$user->block;
            $user->save();
            if($user){
                session()->flash("success","User Blocked Sucessfully");
                return redirect("/admin");
            }
        }
    }
}
