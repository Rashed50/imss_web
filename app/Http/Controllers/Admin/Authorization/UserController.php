<?php

namespace App\Http\Controllers\Admin\Authorization;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Image;

class UserController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $users=User::where('status',1)->orderBy('id','ASC')->get();
        //dd($all);
        return view('admin.user.all',compact('users'));
    }

    public function loadNewUserForm(){

        $roles =Role::orderBy('id','ASC')->get();

        return view('admin.user.add',compact('roles'));
    }

    public function edit($slug){
        $data=User::where('status',1)->where('slug',$slug)->firstOrFail();
        return view('admin.user.edit',compact('data'));
    }

    public function view($slug){
        $data=User::where('status',1)->where('slug',$slug)->firstOrFail();
        return view('admin.user.view',compact('data'));
    }

    public function createNewUser(Request $request){

        
        $this->validate($request,[
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required',
        ],[
            'user_name.required'=>'Please enter your name.',
            'user_email.required'=>'Please enter your email address.',
            'password.required'=>'Please enter password.',
            'role.required'=>'Please choose user role.',
        ]);

//         "name" => "sdfds"
//   "phone" => "fdsfds"
//   "email" => "superadmin3@gmail.com"
//   "password" => "superadmin3@gmail.com"
//   "password_confirmation" => "superadmin3@gmail.com"
//   "role" => "1"

      //  dd($request->all());

        $slug='U'.uniqid();
        $code=time();
        $insert=User::insertGetId([
            'user_name'=>$request->user_name,
            'user_phone'=>$request->user_phone,
            'user_email'=>$request->user_email,
            'password'=>Hash::make($request->password),
            // 'role'=>$request->role,
             'user_type'=> 1,
            // 'slug'=>$slug,
            // 'created_at'=>Carbon::now()->toDateTimeString()
        ]);
        $user = User::where('id', $insert)->first();
        $role = Role::where('id',$request->role)->first();
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
       // dd($role,$user);
        $user->assignRole([$role->id]);

        // if($request->hasFile('pic')){
        //     $image=$request->file('pic');
        //     $imageName=$insert.'_'.time().'.'.$image->getClientOriginalExtension();
        //     Image::make($image)->resize(250,250)->save(base_path('public/uploads/users/'.$imageName));

        //     User::where('id',$insert)->update([
        //         'profile_photo'=>$imageName,
        //         'updated_at'=>Carbon::now()->toDateTimeString(),
        //     ]);
        // }

        if($insert){
          //  Session::flash('success','user registrion success.');
           // return redirect()->back();//'dashboard/user/add');
            return $this->index();
        }else{
            Session::flash('error','please try again.');
            return redirect('dashboard/user/add');
        }
    }

    public function update(Request $request){
        $this->validate($request,[
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|string|email|max:255',
            'role' => 'required',
        ],[
            'user_name.required'=>'Please enter your name.',
            'user_email.required'=>'Please enter your email address.',
            'role.required'=>'Please choose user role.',
        ]);

        $id=$request->id;
        $slug=$request->slug;
        $update=User::where('status',1)->where('id',$id)->update([
            'user_name'=>$request->name,
            'user_phone'=>$request->phone,
            'user_email'=>$request->email,
            'role'=>$request->role,
            'created_at'=>Carbon::now()->toDateTimeString()
        ]);

        if($request->hasFile('pic')){
            $image=$request->file('pic');
            $imageName='user_'.$id.'_'.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(250,250)->save(base_path('public/uploads/users/'.$imageName));

            User::where('id',$id)->update([
                'profile_photo'=>$imageName,
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


/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     $data = User::orderBy('id','DESC')->paginate(5);
    //     return view('users.index',compact('data'))
    //         ->with('i', ($request->input('page', 1) - 1) * 5);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    //  public function edit($id)
    // {
    //     $user = User::find($id);
    //     $roles = Role::pluck('name','name')->all();
    //     $userRole = $user->roles->pluck('name','name')->all();

    //     return view('users.edit',compact('user','roles','userRole'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    //  public function update(Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users,email,'.$id,
    //         'password' => 'same:confirm-password',
    //         'roles' => 'required'
    //     ]);

    //     $input = $request->all();
    //     if(!empty($input['password'])){
    //         $input['password'] = Hash::make($input['password']);
    //     }else{
    //         $input = Arr::except($input,array('password'));
    //     }

    //     $user = User::find($id);
    //     $user->update($input);
    //     DB::table('model_has_roles')->where('model_id',$id)->delete();

    //     $user->assignRole($request->input('roles'));

    //     return redirect()->route('users.index')
    //                     ->with('success','User updated successfully');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     User::find($id)->delete();
    //     return redirect()->route('users.index')
    //                     ->with('success','User deleted successfully');
    // }


















}
