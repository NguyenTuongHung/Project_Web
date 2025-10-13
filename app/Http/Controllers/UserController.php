<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit()
    {
        return view('profile.edit', ['user'=>Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'phone'=>'nullable|string|max:20',
            'address'=>'nullable|string|max:255',
            'password'=>'nullable|confirmed|min:6',
        ]);
        $user->name=$validated['name'];
        $user->email=$validated['email'];
        $user->phone=$validated['phone']??null;
        $user->address=$validated['address']??null;
        if(!empty($validated['password'])) $user->password=Hash::make($validated['password']);
        $user->save();
        return response()->json(['success'=>true]);
    }

    public function ordersHistory()
    {
        $orders = Auth::user()->orders()->with('items.product')->latest()->get();
        return view('orders.history', compact('orders'));
    }
}



