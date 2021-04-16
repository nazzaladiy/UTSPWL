<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Auth;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //fungsi eloquent menampilkan data menggunakan pegination
        $search = $request->get('search');
        if ($search){
            $bukus = Buku::where("Judul", "LIKE", "%$search")->paginate(5);
        } else {
            $bukus = Buku::paginate(5);
        }
        //$bukus = Buku::all(); // Mengambil semua isi tabel
        $posts = Buku::orderBy('id_buku', 'desc')->paginate(6);
        return view('bukus.index', compact('bukus'));
            with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bukus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'id_buku' => 'required',
            'Judul' => 'required',
            'Kategori' => 'required',
            'Penerbit' => 'required',
            'Pengarang' => 'required',
            'Jumlah' => 'required',
            'Status' => 'required',
        ]);
    //fungsi eloquent untuk menambah data
        Buku::create($request->all());
    //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('bukus.index')
            ->with('succes', 'Buku Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //menampilkan detail data dengan menemukan/berdasarkan id_buku 
            $Buku = Buku::find($id);
            return view('bukus.detail', compact('Buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //menampilkan detail data dengan menemukan/berdasarkan id_buku 
        $Buku = Buku::find($id);
        return view('bukus.edit', compact('Buku'));
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
        //melakukan validasi data
            $request->vaidate([
                'id_buku' => 'required',
                'Judul' => 'required',
                'Kategori' => 'required',
                'Penerbit' => 'required',
                'Pengarang' => 'required',
                'Jumlah' => 'required',
                'Status' => 'required',
        ]);

        //fungsi eloquent untuk mengupdate data inputan kita
            Buku::find($id)->update($request->all());
        
        //jika data berhasil diupdate, akan kembali ke halaman utama
            return redirect()->route('bukus.index')
                ->with('succes', 'Buku Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //fungsi eloquent untuk menghapus data
            Buku::find($id)->delete();
            return redirect()->route('bukus.index')
                ->with('succes', 'Buku Berhasil Dihapus');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
