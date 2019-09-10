<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Modelbarang;
class barang extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Modelbarang::all();
        return view('barang',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createbarang');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'kode' => 'required',
            'barang' => 'required',
            
          
            'stok' => 'required',
            'harga' => 'required',
            
        ]);


        $data = new Modelbarang();
        $data->kode = $request->kode;
       $data->barang = $request->barang;
       $data->stok= $request->stok;
       $data->harga= $request->harga;
       $data->save();
       return redirect()->route('barang.index')->with('alert-success','Berhasil Menambahkan Data!');
        
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
        $data = Modelbarang::where('id',$id)->get();

        return view('editbarang',compact('data'));
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
        $data = Modelbarang::where('id',$id)->first();
        $data->kode = $request->kode;
        $data->barang = $request->barang;
        $data->stok= $request->stok;
        $data->harga= $request->harga;
       $data->save();
       
        $data->save();
        return redirect()->route('barang.index')->with('alert-success','Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Modelbarang::where('id',$id)->first();
        $data->delete();
        return redirect()->route('barang.index')->with('alert-success','Data berhasi dihapus!');
    }
}
