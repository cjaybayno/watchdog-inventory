<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	/**
	* Determine Active Menu
	*/
	public $menuKey   = 'userActiveMenu';
	public $menuValue = 'active';
	
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.list')->with($this->menuKey, $this->menuValue);
    }
	
	 /**
     * Return data for pagi	nation.
     *
     * @return \Illuminate\Http\Response
     */
    public function paginate(Request $request)
    {
        $users = User::select([
			'id', 
			'avatar',
			'username', 
			'name', 
			'email', 
			'socialites',
			'is_approved'
		]);
		
		return Datatables::of($users)
				->editColumn('avatar',  function ($user) {
					return view('user/datatables.avatar', $user)->render();
				})
				->editColumn('socialites', function ($user) {
					return view('user/datatables.socialites', $user)->render();
				})
				->editColumn('is_approved', function ($user) {
					return view('user/datatables.is_approved', $user)->render();
				})
				->addColumn('action', function ($user) {
					return view('user/datatables.action', $user)->render();
				})
				->make();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.register')->with($this->menuKey, $this->menuValue);;
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
            'name'		=> 'required|max:255',
            'email' 	=> 'required|email|max:255|unique:users',
            'username' 	=> 'required|max:255|min:6|unique:users',
            'password' 	=> 'required|confirmed|min:6',
        ]);
		
		$user = User::create([
			'name'		=> $request->name,
			'email'    	=> $request->email,
			'username' 	=> $request->username,
			'password'	=> bcrypt($request->password),
			'avatar'	=> 'public/images/users/icon-user-default.png',
		]);
		
		return redirect('user/'.$user->id)->with('register_status', 'User successfully Created!');
    }

	 /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$user = User::findOrFail($id);
		
        return view('user.show')->with([
			'user' 	       => $user, 
			$this->menuKey => $this->menuValue
		]);
    }

	
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
		
		return view('user.edit')->with([
			'user' 	       => $user, 
			$this->menuKey => $this->menuValue
		]);
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
		$user = User::find($id);
		
		$this->validate($request, [
			'name'		=> 'required|max:255',
			'email' 	=> ($user->email != $request->email) ? 'required|email|max:255|unique:users' : '',
			'username' 	=> ($request->socialites == 'None') ? 'required|max:255|min:6|unique:users' : '',
		]);
		
        if ($request->socialites == 'None')
			$user->username    = $request->username;
		else
			$user->is_approved = 1;
		
		$user->name  = $request->name;
		$user->email = $request->email;
		$user->save();
		
		return redirect('user/'.$id)->with('register_status', 'User successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$user = User::find($id);
		$user->delete();
		
		return response()->json([
			'success' => true,
			'message' => 'User has been deleted'
		]);
    }
}
