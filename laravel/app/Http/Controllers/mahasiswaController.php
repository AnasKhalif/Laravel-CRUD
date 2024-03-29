<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class mahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = mahasiswa::orderBy('nim', 'desc')->paginate(3);
        return view('mahasiswa.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nim', $request->nim);
        Session::flash('nama', $request->nama);
        Session::flash('jurusan', $request->jurusan);
        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswas,nim',
            'nama' => 'required',
            'jurusan' => 'required',
        ], [
            'nim.required' => 'NIM must be filled in',
            'nim.numeric' => 'NIM must be a number',
            'nim.unique' => 'NIM The number you entered is already registered',
            'nama.required' => 'Nama must be filled in',
            'jurusan.required' => 'Jurusan must be filled in',
        ]);
        $data = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
        ];

        mahasiswa::create($data);
        return redirect()->to('mahasiswa')->with('success', 'successfully added data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($nim)
    {
        $data = mahasiswa::where('nim', $nim)->first();
        return view('mahasiswa.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nim)
    {
        $request->validate([

            'nama' => 'required',
            'jurusan' => 'required',
        ], [
            'nama.required' => 'Nama must be filled in',
            'jurusan.required' => 'Jurusan must be filled in',
        ]);
        $data = [
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
        ];

        mahasiswa::where('nim', $nim)->update($data);
        return redirect()->to('mahasiswa')->with('success', 'successfully update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nim)
    {
        mahasiswa::where('nim', $nim)->delete();
        return redirect()->to('mahasiswa')->with('success', 'Successfully delete data');
    }
}
