<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

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
        try {
            $dataToStore = $request->only([
                'usr_nama',
                'prodi_id',
                'username',
                'password',
                'usr_role',
                'usr_email',
                'usr_notelpon',
            ]);

            // Enkripsi password menggunakan bcrypt sebelum menyimpan ke database
            $dataToStore['password'] = Hash::make($dataToStore['password']);

            $user = User::create($dataToStore);

            if ($user) {
                $usr_role = Auth::user()->usr_role;

                if ($usr_role === 'admin') {
                    return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil Disimpan!']);
                }
            }
        } catch (\Exception $e) {
            // Tangani kesalahan penyimpanan data, misalnya dengan log atau notifikasi
            return redirect()->back()->with(['error' => 'Gagal menyimpan data.']);
        }

    }

    public function edit(User $user, $usr_id)
    {
        $title = 'Ubah User';

        $user = User::findOrFail($usr_id);

        $prodi = Prodi::pluck('prd_nama', 'id');

        return view('admin.user.edit', compact('title'),['usr' => $user, 'prodis' => $prodi]);
    }


    public function update(UpdateUserRequest $request, User $user, $usr_id)
    {
        try {
            $request->validated(); // Menggunakan validated() dari form request

            User::find($usr_id)->update($request->all());

            $usr_role = Auth::user()->usr_role;

            if ($usr_role === 'admin') {
                return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil Diubah!']);
            }
        } catch (\Exception $e) {
            // Tangani kesalahan update data, misalnya dengan log atau notifikasi
            return redirect()->back()->with(['error' => 'Gagal mengubah data.']);
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
    public function userexport(Request $request)
    {
        $search = $request->get('search');
        return Excel::download(new UserExport($search), 'Laporan_User.xlsx');
    }
}
