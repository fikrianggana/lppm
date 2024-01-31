<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        $user = $search->get();

        return view('admin.user.index', compact('title'), ['user' => $user]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'User';
        $prodi = Prodi::pluck('prd_nama', 'id'); // Sesuaikan dengan nama kolom

        return view('admin.user.create',compact('title'), ['']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'usr_nama' => 'required|string|max:255',
            'prodi_id' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'usr_role' => 'required|string|max:255',
            'usr_email' => 'required|email|unique:users',
            'usr_notelpon' => 'required|string|max:15',
        ]);

        // Create a new User instance and fill it with the request data
        $user = new User([
            'usr_nama' => $request->input('usr_nama'),
            'prodi_id' => $request->input('prodi_id'),
            'username' => $request->input('username'),
            'usr_role' => $request->input('usr_role'),
            'usr_email' => $request->input('usr_email'),
            'usr_notelpon' => $request->input('usr_notelpon'),
        ]);

        // Save the user to the database
        $user->save();

        // Redirect back with a success message
        return redirect()->route('admin.user.create')->with('success', 'User created successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
