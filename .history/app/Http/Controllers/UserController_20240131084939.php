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
        try {
            $dataToStore = $request->only(['prd_nama']);

            $prodi = Prodi::create($dataToStore);

            if ($prodi) {
                $usr_role = Auth::user()->usr_role;

                if ($usr_role === 'admin') {
                    return redirect()->route('admin.prodi.index')->with(['success' => 'Data Berhasil Disimpan!']);
                }
            }
        } catch (\Exception $e) {
            // Tangani kesalahan penyimpanan data, misalnya dengan log atau notifikasi
            return redirect()->back()->with(['error' => 'Gagal menyimpan data.']);
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

        $prodi = Prodi::pluck('prd_nama', 'id');

        return view('admin.user.edit', compact('title'),['usr' => $user, 'prodis' => $prodi]);
    }


    public function update(UpdateUserRequest $request, $usr_id)
    {
        $user = User::findOrFail($usr_id);
        $validatedData = $request->validated();

        if ($user->update($validatedData)) {
            return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return abort(403, 'Unauthorized action.');
        }
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
