<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $title = 'User';
        $user = User::all();

        $query = $request->get('search');

        $search = User::where(function ($query) use ($request) {
            $query->where('usr_id', 'like', "%{$request->search}%")
                ->orWhere('usr_nama', 'like', "%{$request->search}%")
                ->orWhere('prodi_id', 'like', "%{$request->search}%")
                ->orWhere('username', 'like', "%{$request->search}%")
                ->orWhere('usr_role', 'like', "%{$request->search}%")
                ->orWhere('usr_email', 'like', "%{$request->search}%")
                ->orWhere('usr_notelpon', 'like', "%{$request->search}%");
        });

        $users = $search->get();

        return view('admin.user.index', compact('title', 'user'));
    }

    public function create()
    {
        $title = 'User';
        $prodis = Prodi::pluck('prd_nama', 'id');

        return view('admin.user.create', compact('title', 'prodis'));
    }

    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();
        
        User::create($request->all());

        return redirect()->route('admin.user.index')->with('success', 'User created successfully!');
    }

    public function edit($usr_id)
    {
        $user = User::findOrFail($usr_id);
        $prodis = Prodi::pluck('prd_nama', 'id');

        return view('admin.user.edit', ['user' => $user, 'prodis' => $prodis]);
    }


    public function update(Request $request, $usr_id)
    {
        $request->validate([
            'usr_nama' => 'required|string|max:255',
            'prodi_id' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'usr_role' => 'required|string|max:255',
            'usr_email' => 'required|email|',
            'usr_notelpon' => 'required|string|max:15',
        ]);

        User::find($usr_id)->update($request->all());

        return redirect()->route('admin.user.index')->with('success', 'User updated successfully!');
    }

    public function destroy($usr_id)
    {
        try {
            $user = User::findOrFail($usr_id);
            $user->delete();

            return redirect()->route('admin.user.index')->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }
}
