<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {               
        $response = Http::withToken(session()->get('tokenUser'))
                            ->get(env("REST_API_ENDPOINT").'/api/jadwal');
        $dataResponse = json_decode($response);
        $this->data['jadwals'] = $dataResponse->data;

        return view('jadwal.index',$this->data); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $responseKelas = Http::withToken(session()->get('tokenUser'))
                                ->get(env("REST_API_ENDPOINT").'/api/kelas');

        $responseMapel = Http::withToken(session()->get('tokenUser'))
                                ->get(env("REST_API_ENDPOINT").'/api/mapel');

        $responseGuru = Http::withToken(session()->get('tokenUser'))
                                ->get(env("REST_API_ENDPOINT").'/api/guru');
        $dataKelas = json_decode($responseKelas);
        $dataMapel = json_decode($responseMapel);
        $dataGuru = json_decode($responseGuru);

        $this->data['dataKelas'] = $dataKelas->data;
        $this->data['dataGuru'] = $dataGuru->data;
        $this->data['dataMapel'] = $dataMapel->data;

        return view('jadwal.create',$this->data);
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
                            ->post(
                                env("REST_API_ENDPOINT").'/api/jadwal',
                                $request->except('_token')
                            );
        $data = json_decode($response);

        if ($data->status == true) {
            return redirect()->route('jadwal.index')->with('success','Data jadwal berhasil ditambahkan!');
        } else {
            return redirect()->route('jadwal.create')->with('validationErrors',$data->message);
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
                            ->get(env("REST_API_ENDPOINT").'/api/jadwal/'.$id);
        $dataResponse = json_decode($response);
        
        $responseKelasDepedencies = Http::withToken(session()->get('tokenUser'))
                                            ->get(env("REST_API_ENDPOINT").'/api/kelas');
        $responseMapelDepedencies = Http::withToken(session()->get('tokenUser'))
                                            ->get(env("REST_API_ENDPOINT").'/api/mapel');
        $responseGuruDepedencies = Http::withToken(session()->get('tokenUser'))
                                            ->get(env("REST_API_ENDPOINT").'/api/guru');

        $dataDepedenciesKelas = json_decode($responseKelasDepedencies);
        $dataDepedenciesMapel = json_decode($responseMapelDepedencies);
        $dataDepedenciesGuru = json_decode($responseGuruDepedencies);

        if ($dataResponse->status == true) {
            $jadwal = $dataResponse->data;
            $kelas = $dataDepedenciesKelas->data;
            $mapel = $dataDepedenciesMapel->data;
            $guru = $dataDepedenciesGuru->data;

            $this->data['jadwal'] = $jadwal;
            $this->data['dataKelas'] = $dataDepedenciesKelas->data;
            $this->data['mapels'] = $dataDepedenciesMapel->data;
            $this->data['dataGuru'] = $dataDepedenciesGuru->data;

            return view('jadwal.edit',$this->data);
        } else {
            return redirect()->route('jadwal.index')->with('danger','Data jadwal tidak dapat ditemukan!');
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
        $response = Http::withTOken(session('tokenUser'))
                            ->put(
                                env("REST_API_ENDPOINT").'/api/jadwal/'.$id,
                                $request->except(['_token','_method'])
                            );
        $data = json_decode($response);

        if ($data->status == true) {
            return redirect()->route('jadwal.index')->with('success','Data jadwal berhasil diubah!');
        } else {
            return redirect()->route('jadwal.edit',$id)->with('validationErrors',$data->message);
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
                                env("REST_API_ENDPOINT").'/api/jadwal/'.$id);
        $data = json_decode($response);

        if ($data->status == true) {
            return redirect()->route('jadwal.index')->with('success','Data jadwal berhasil dihapus!');
        } else {
            return redirect()->route('jadwal.index')->with('validationErrors',$data->message);
        } 
    }

    public function get_siswa($jadwal)
    {
        $response = Http::withToken(session()->get('tokenUser'))->get(env("REST_API_ENDPOINT").'/api/get-siswa/'.$jadwal);
        $data = json_decode($response);

        return view('presensi.index',[
            'presensi' => $data
        ]); 
    }
}
