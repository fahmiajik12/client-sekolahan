<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::withToken(session()->get('tokenUser'))
                            ->get(env("REST_API_ENDPOINT").'/api/mapel');
        $dataResponse = json_decode($response);
        $this->data['mapels'] = $dataResponse->data;

        return view('mapel.index',$this->data); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mapel.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::withToken(session('tokenUser'))
                            ->post(env("REST_API_ENDPOINT").'/api/mapel',[
                                'kode_mapel' => $request->kode_mapel,
                                'nama_mapel' => $request->nama_mapel ]);
        $data = json_decode($response);

        if ($data->status == true) {
            return redirect()->route('mapel.index')->with('success','Data mapel berhasil ditambahkan!');
        } else {
            return redirect()->route('mapel.create')->with('validationErrors',$data->message);
        } 
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
        $response = Http::withToken(session()->get('tokenUser'))
                            ->get(env("REST_API_ENDPOINT").'/api/mapel/'.$id);
        $dataResponse = json_decode($response);
        
        if ($dataResponse->status == true) {
            $this->data['mapel'] = $dataResponse->data;

            return view('mapel.edit',$this->data);
        } else {
            return redirect()->route('mapel.index')->with('danger','Data mapel tidak ditemukan!');
        } 
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
        $response = Http::withToken(session('tokenUser'))
                            ->put(env("REST_API_ENDPOINT").'/api/mapel/'.$id,[
                                'kode_mapel' => $request->kode_mapel,
                                'nama_mapel' => $request->nama_mapel 
                            ]);
        $data = json_decode($response);

        if ($data->status == true) {
            return redirect()->route('mapel.index')->with('success','Data mapel berhasil diupdate!');
        } else {
            return redirect()->route('mapel.edit')->with('validationErrors',$data->message);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::withTOken(session('tokenUser'))
                            ->delete(
                                env("REST_API_ENDPOINT").'/api/mapel/'.$id);
        $data = json_decode($response);

        if ($data->status == true) {
            return redirect()->route('mapel.index')->with('success','Data mapel berhasil dihapus!');
        } else {
            return redirect()->route('mapel.index')->with('validationErrors',$data->message);
        } 
    }
}
