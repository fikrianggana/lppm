<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $title = 'User';
        $user = User::all();

        return view ('admin.user.index', compact('title', 'user'));
    }

    public function create()
    {
        $title = 'User';
        $prodi = Prodi::pluck('prd_nama', 'id');

        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'admin')  {
            return view('admin.user.create', compact('title'),['prodis' => $prodi]);
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }
    }

    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();

       if(User::create($validatedData)){
        $usr_role = Auth::user()->usr_role; // Ambil peran pengguna yang sedang login

        // Tentukan view berdasarkan peran pengguna
        if ($usr_role === 'admin')  {
            return view('admin.user.create')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            // Handle jika peran tidak teridentifikasi
            return abort(403, 'Unauthorized action.');
        }
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
