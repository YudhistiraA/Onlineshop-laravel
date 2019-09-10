<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Modelpenjulan;
use App\Modelbarang;

class penjualan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Modelpenjulan::all();
        return view('penjualan',compact('data'));
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
            'jumblah' => 'required',
            'harga' => 'required',
            
        ]);


        $data = new Modelpenjulan();
        $data->kode = $request->kode;
       $data->jumblah= $request->jumblah;
       $data->harga= $request->harga;
      
       $data->save();
       $datab = Modelbarang::where('kode',$request->kode)->first();
       $datab->stok  = $datab->stok - $request->jumblah;
     
      $datab->save();
       
       return redirect()->route('penjualan.index')->with('alert-success','Berhasil Menambahkan Data!');
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
        $data = Modelpenjulan::where('id',$id)->get();

        return view('editpenjualan',compact('data'));
    
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
        $data = Modelpenjulan::where('id',$id)->first();
        $data->kode = $request->kode;
       $data->jumblah= $request->jumblah;
       $data->harga= $request->harga;
       $data->save();
       
        
        return redirect()->route('penjualan.index')->with('alert-success','Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Modelpenjulan::where('id',$id)->first();
        $data->delete();
        return redirect()->route('penjualan.index')->with('alert-success','Data berhasi dihapus!');
    }
}
