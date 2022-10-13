<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    protected function userManage(Request $request)
    {
        try {
            if ($request->has('mode')) {
                if ($request->mode == "userAdd") {
                    return $this->userAdd($request);
                }
                if ($request->mode == "userDelete") {
                    return $this->userDelete($request);
                }
                if ($request->mode == "userUpdate") {
                    return $this->userUpdate($request);
                }   
                if ($request->mode == "reset_password") {
                    return $this->reset_password($request);
                }
            }
            return response()->json(['error' => "something went wrong "]);
        } catch (Exception $e) {
            return response()->json(['error' => "something went wrong " . $e]);
        }
    }

    protected function userAdd($data)
    {
        $rules = array(
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:10',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        );
        $output = response()->json(['error' => "Something went wrong !!"]);
        $error = Validator::make($data->all(), $rules);

        if ($error->fails()) {
            $output = response()->json(['error' => $error->errors()->all()]);
        } else {


            User::create([
                'name' => $data->name,
                'phone' => $data->phone,
                'email' => $data->email,
                'role' => $data->role,
                'password' => Hash::make($data->password),
            ]);
            $output = response()->json(['success' => "$data->name Added successfully"]);
        }

        return $output;
    }

    protected function reset_password($data)
    {
        $rules = array(
            'user_password' => 'required|string|max:50',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        );
        $output = response()->json(['error' => "Something went wrong !!"]);
        $error = Validator::make($data->all(), $rules);

        if ($error->fails()) {
            $output = response()->json(['error' => $error->errors()->all()]);
        } else {
            
            if (Auth::attempt(['email' => Auth::user()->email, 'password' => $data->user_password])) {
                $user = User::find($data->dataId);
                $user->password = Hash::make($data->password);
                $user->save();
            
                $output = response()->json(['success' => "password resetted successfully"]);
            }else {
                $output = response()->json(['error' => "wrong password !!"]);
            }
        }

        return $output;
    }

    protected function userUpdate($data)
    {
        $rules = array(
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:10',
            'email' => 'required|string|email|max:30|unique:users,email,'.$data->dataId,
        );
        $user = User::find($data->dataId);

        $output = response()->json(['error' => "Something went wrong !!"]);
        $error = Validator::make($data->all(), $rules);

        if ($error->fails()) {
            $output = response()->json(['error' => $error->errors()->all()]);
        } else {

            $user->name = $data->name;
            $user->role = $data->role;
            $user->phone = $data->phone;
            $user->email = $data->email;
            $user->save();
            $output = response()->json(['success' => "$data->name updated successfully"]);
        }

        return $output;
    }

    protected function userDelete($request)
    {
        $output = response()->json(['error' => "Something went wrong !!"]);
        if ($request->has('id')) {
            $user = User::find($request->id);
            $user->delete();
            $output = response()->json(['success' => "$user->name Deleted successfully"]);
        }

        return $output;
    }
}
