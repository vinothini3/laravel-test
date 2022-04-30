<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Language;
use Validator;

class UserController extends Controller
{
    public function index() {
        $users = User::paginate(10);
        // echo "<pre>";print_r($users);
        return view('list', compact('users'));
    }

    public function create() {
        return view('create');
    }

    public function save(Request $request) {
        $validator = Validator::make($request->all(), [
                        'name'            => 'required',
                        'age'             => 'required',
                        'gender'          => 'required',
                        'willing_to_work' => 'required',
                        'languages'       => 'required'
                    ]);
        if ($validator->fails()) {
             return back()->withInput()->withErrors($validator->errors());
        }

        $user = new User;
        $user->name = $request->name;
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->willing_to_work = $request->willing_to_work;
        $user->save();
    
        foreach ($request->languages as $value) {
            $languages = [
                'language' => $value,
                'id_user' => $user->id,
            ];
            $language = $user->languages()->create($languages);
        }
        return back()->withInput()->with(['success' => 'User added succesfully']);
    }

    public function edit($user_id) {
        $userData = User::with('languages')->get()->find($user_id);
        return view('edit',compact('userData'));
    }

    public function update(Request $request, $user_id) {
        $validator = Validator::make($request->all(), [
                        'name'            => 'required',
                        'age'             => 'required',
                        'gender'          => 'required',
                        'willing_to_work' => 'required',
                        'languages'       => 'required'
                    ]);
        if ($validator->fails()) {
             return back()->withInput()->withErrors($validator->errors());
        }

        $updateUser = User::find($user_id);
        $updateUser->name = $request->name;
        $updateUser->age = $request->age;
        $updateUser->gender = $request->gender;
        $updateUser->willing_to_work = $request->willing_to_work;
        $updateUser->save();

        Language::where('id_user', $user_id)->delete();
        foreach ($request->languages as $value) {
            $languages = [
                'language' => $value,
                'id_user' => $user_id,
            ];
            $language = $updateUser->languages()->create($languages);
        }

        return back()->with(['success' => 'User has been updated successfully']);
    }

    public function delete($user_id) {
        $record = User::find($user_id);

        if ($record->delete()) {
            return back()->with(['success' => 'User deleted successfully']);
        }

    }
}
