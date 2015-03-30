<?php

class UserController extends BaseController{

	public function index(){

		$users= User::all();
		return View::make('users.index',compact('users'));
	
	}

	public function create(){
		return View::make('users.register');
	}

	public function postAddUser(){
		$User = new User;

		$data = Input::all();

		if ($User->isValid($data)) {

			$User->name=$data['name'];
			$User->lastname=$data['lastname'];
			$User->username=$data['username'];
			$User->email=$data['email'];

			$User->password=Hash::make($data['password']);

			$User->save();

			return Redirect::to('users/add')->with('message', 'Usuario agregado con éxito');
		}

		return Redirect::to('users/add')->withErrors($User->validator)->withInput();
	}

	public function edit($id){

		$User = User::find($id);

		if($User != null){

			return View::make('users.edit',array('user'=>$User));
		}

		return Redirect::to('users/index');

	}

	public function postEditUser($id){

		$User = User::find($id);

		$data = Input::all();

		if ($User->isValid($data)) {

			$User->name=$data['name'];
			$User->lastname=$data['lastname'];
			$User->username=$data['username'];
			$User->email=$data['email'];

			if(Input::get('password')!=null)
				$User->password=Hash::make($data['password']);

			$User->save();

			return Redirect::to('users/edit/'.$User->id)->with('message', 'Usuario editado con éxito');
		}

		return Redirect::to('users/edit/'.$User->id)->withErrors($User->validator)->withInput();
	}

	public function getDelete($id){

		$User = User::find($id);

		if($User->delete()){

			return Redirect::action('UserController@getIndex')->with('message', 'Usuario eliminado con éxito');
		}

		return Redirect::action('UserController@getIndex')->with('message', 'El usuario no se ha podido eliminar');

	}
	

}