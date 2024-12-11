<?php

namespace App\Http\Controllers;

use App\Models\SystemUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function show()
    {
        $users = SystemUser::all(); 
        return view('AdminDashboard.users', compact('users'));
    }


  
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:system_users',
            'contact' => 'nullable|string|max:15',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('user_images', $fileName, 'public'); 
                $validatedData['image'] = $fileName;
            } else {
                $validatedData['image'] = 'default-user.png'; 
            }

            SystemUser::create([
                'name' => $request->name,
                'email' => $request->email,
                'contact' => $request->contact,
                'password' => Hash::make($request->password), 
                'role' => $request->role,
                'image' => $validatedData['image'],
                'status' => $request->status,
            ]);

    }



    public function edit($id)
    {
        $user = SystemUser::findOrFail($id);
        return view('AdminDashboard.edit_users', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:system_users,email,' . $id,
            'contact' => 'nullable|string|max:15',
            'role' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = SystemUser::findOrFail($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('user_images', $fileName, 'public'); 
            $user->image = $fileName; // Update image path
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->contact = $request->contact;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('users')->with('success', 'User updated successfully.');
    }


    public function destroy($id)
    {
        $user = SystemUser::findOrFail($id);
        $user->delete();
        return redirect()->route('users')->with('success', 'User deleted successfully.');
    }

}
