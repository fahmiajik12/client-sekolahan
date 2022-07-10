<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::withToken(session()->get('tokenUser'))
                            ->get(env("REST_API_ENDPOINT").'/api/siswa');
        $dataResponse = json_decode($response);
        $this->data['siswas'] = $dataResponse->data;

        return view('siswa.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::withToken(session()->get('tokenUser'))
                            ->get(env("REST_API_ENDPOINT").'/api/kelas');
        $dataResponse = json_decode($response);
        $this->data['dataKelas'] = $dataResponse->data;

        return view('siswa.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ttl = explode('/',$request->tgl_lahir);
        $request->merge([
            'tgl_lahir' => $ttl[2].'-'.$ttl[0].'-'.$ttl[1]
        ]);
        $response = Http::withToken(session('tokenUser'))
                            ->post(
                                env("REST_API_ENDPOINT").'/api/siswa',$request->except('_token')
                            );
        $dataResponse = json_decode($response);
        
        if ($dataResponse->status == true) {
            return redirect()->route('siswa.index')->with('success','Data siswa berhasil ditambahkan!');
        } else {
            return redirect()->route('siswa.create')->with('validationErrors',$data->message);
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
                            ->get(env("REST_API_ENDPOINT").'/api/siswa/'.$id);
        $dataResponse = json_decode($response);
        
        $responseDataDepedencies = Http::withToken(session()->get('tokenUser'))
                                            ->get(env("REST_API_ENDPOINT").'/api/kelas');
        $dataDepedencies = json_decode($responseDataDepedencies);

        if ($dataResponse->status == true) {
            $siswa = $dataResponse->data;
            $ttl = explode('-',$siswa->tgl_lahir);
            $siswa->tgl_lahir = $ttl[1].'/'.$ttl[2].'/'.$ttl[0];
            $this->data['siswa'] = $siswa;
            $this->data['dataKelas'] = $dataDepedencies->data;

            return view('siswa.edit',$this->data);
        } else {
            return redirect()->route('siswa.index')->with('danger','Data siswa tidak dapat ditemukan!');
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
        $ttl = explode('/',$request->tgl_lahir);
        $request->merge([
            'tgl_lahir' => $ttl[2].'-'.$ttl[0].'-'.$ttl[1]
        ]);
        
        $response = Http::withTOken(session('tokenUser'))
                            ->put(
                                env("REST_API_ENDPOINT").'/api/siswa/'.$id,
                                $request->except(['_token','_method'])
                            );
        $data = json_decode($response);

        if ($data->status == true) {
            return redirect()->route('siswa.index')->with('success','Data siswa berhasil diubah!');
        } else {
            return redirect()->route('siswa.edit',$id)->with('validationErrors',$data->message);
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
                                env("REST_API_ENDPOINT").'/api/siswa/'.$id);
        $data = json_decode($response);

        if ($data->status == true) {
            return redirect()->route('siswa.index')->with('success','Data siswa berhasil dihapus!');
        } else {
            return redirect()->route('siswa.index')->with('validationErrors',$data->message);
        } 
    }
}
