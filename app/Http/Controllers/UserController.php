<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Image;

class UserController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $all=User::where('status',1)->orderBy('id','ASC')->get();
        return view('admin.user.all',compact('all'));
    }

    public function add(){
        return view('admin.user.add');
    }

    public function edit($slug){
        $data=User::where('status',1)->where('slug',$slug)->firstOrFail();
        return view('admin.user.edit',compact('data'));
    }

    public function view($slug){
        $data=User::where('status',1)->where('slug',$slug)->firstOrFail();
        return view('admin.user.view',compact('data'));
    }

    public function insert(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required',
        ],[
            'name.required'=>'Please enter your name.',
            'email.required'=>'Please enter your email address.',
            'password.required'=>'Please enter password.',
            'role.required'=>'Please choose user role.',
        ]);

        $slug='U'.uniqid();
        $code=time();
        $insert=User::insertGetId([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>$request->role,
            'code'=>$code,
            'slug'=>$slug,
            'created_at'=>Carbon::now()->toDateTimeString()
        ]);

        if($request->hasFile('pic')){
            $image=$request->file('pic');
            $imageName=$insert.'_'.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(250,250)->save(base_path('public/uploads/users/'.$imageName));

            User::where('id',$insert)->update([
                'photo'=>$imageName,
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ]);
        }

        if($insert){
            Session::flash('success','user registrion success.');
            return redirect('dashboard/user/add');
        }else{
            Session::flash('error','please try again.');
            return redirect('dashboard/user/add');
        }
    }

    public function update(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'required',
        ],[
            'name.required'=>'Please enter your name.',
            'email.required'=>'Please enter your email address.',
            'role.required'=>'Please choose user role.',
        ]);

        $id=$request->id;
        $slug=$request->slug;
        $update=User::where('status',1)->where('id',$id)->update([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'role'=>$request->role,
            'created_at'=>Carbon::now()->toDateTimeString()
        ]);

        if($request->hasFile('pic')){
            $image=$request->file('pic');
            $imageName='user_'.$id.'_'.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(250,250)->save(base_path('public/uploads/users/'.$imageName));

            User::where('id',$id)->update([
                'photo'=>$imageName,
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ]);
        }

        if($update){
            Session::flash('success','successfully updated user information.');
            return redirect('dashboard/user/view/'.$slug);
        }else{
            Session::flash('error','please try again.');
            return redirect('dashboard/user/edit/'.$slug);
        }
    }

    public function softdelete(){
        $id=$_POST['modal_id'];
        $soft=User::where('status',1)->where('id',$id)->update([
            'status'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($soft){
            Session::flash('success','successfully delete user information.');
            return redirect('dashboard/user');
        }else{
            Session::flash('error','please try again.');
            return redirect('dashboard/user');
        }
    }

    public function restore(){
        $id=$_POST['modal_id'];
        $soft=User::where('status',0)->where('id',$id)->update([
            'status'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($soft){
            Session::flash('success','successfully restore user information.');
            return redirect('dashboard/recycle/user');
        }else{
            Session::flash('error','please try again.');
            return redirect('dashboard/recycle/user');
        }
    }

    public function delete(){
        $id=$_POST['modal_id'];
        $del=User::where('status',0)->where('id',$id)->delete([]);

        if($del){
            Session::flash('success','successfully delete user information permanently.');
            return redirect('dashboard/recycle/user');
        }else{
            Session::flash('error','please try again.');
            return redirect('dashboard/recycle/user');
        }
    }
}
