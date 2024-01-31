<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Http\Requests\StoreProdiRequest;
use App\Http\Requests\UpdateProdiRequest;
use Illuminate\Support\Facades\Auth;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Prodi';
        $prodi = Prodi::all();

        return view ('admin.prodi.index', compact('title', 'prodi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Prodi';

        return view ('admin.prodi.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProdiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProdiRequest $request)
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


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function show(Prodi $prodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function edit(Prodi $prodi, $id)
    {
        $title = 'Ubah Prodi';
        $prodi = Prodi::findOrFail($id);

        return view ('admin.prodi.edit', compact('title'), ['prd'=>$prodi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProdiRequest  $request
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProdiRequest $request, Prodi $prodi)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prodi $prodi, $id)
    {
        try {
            // Find the book by ID
            $prodi = $prodi->findOrFail($id);

            // Delete the book
            $prodi->delete();

            // Redirect with success message
            return redirect()->route('admin.prodi.index')->with('success', 'Buku deleted successfully');
        } catch (\Exception $e) {
            // Redirect with error message if deletion fails
            return redirect()->back()->with('error', 'Error deleting book: ' . $e->getMessage());
        }
    }
}
