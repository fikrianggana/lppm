<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
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
        $user = Auth::user();
        $usr_role = $user->usr_role; // Ambil peran pengguna yang sedang login
        $usr_id = $user->usr_id;

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

       if(User::create($validatedData)){
            return redirect()->route('admin.user.index')->with('success', 'User created successfully!');
       }
    }

    public function edit(User $user, $usr_id)
    {

        $user = User::findOrFail($usr_id);
        $prodis = Prodi::pluck('prd_nama', 'id');

        return view('admin.user.edit', ['usr' => $user, 'prodis' => $prodis]);
    }


    public function update(UpdateUserRequest $request, $usr_id)
    {
        $request->validated();

        User::find($usr_id)->update($request->all());

        return redirect()->route('admin.user.index')->with('success', 'User updated successfully!');
    }

    public function destroy(User $user, $usr_id)
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
