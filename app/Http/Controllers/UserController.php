<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users=User::select()->get();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.create');
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
        $this->validate($request,[
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8'
        ]);
        $requestData=$request->all();
        User::create($requestData);
        return redirect()->route('user')->with('flash_message','create successfully');
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
        $user=User::find($id);
        if(isset($user)){
            return view('users.show',compact('user'));
        }else{
            return redirect()->route('user')->with('flash_message','This user is not exist');
        }
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
        $user=User::find($id);
        if(isset($user)){
            return view('users.edit',compact('user'));
        }else{
            return redirect()->route('user')->with('flash_message','This user is not exist');
        }
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
        $this->validate($request,[
            'name'=>'required|min:3',
            'email'=>['required', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore($id)],
            'password'=>'nullable|min:8'
        ]);
        $requestData=$request->all();
        if($request->password==null){
            $requestData['password']=$request->password_old;
        }else{
            $requestData['password']=Hash::make($request->password);
        }

        $user=User::find($id);
        if(isset($user)){
            $user->update($requestData);
        return redirect()->route('user')->with('flash_message','Update Successfully');
        }else{
        return redirect()->route('user');
        }
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
        $user=User::find($id);
        if(isset($user)){
            $user->delete();
            return redirect()->route('user')->with('flash_message','Deleted Successfully');
        }else{
            return redirect()->route('user');
        }
    }
}
