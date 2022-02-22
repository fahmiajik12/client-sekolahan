<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Presensi;
use App\Model\Jadwal;
use App\Model\Kelas;
use Carbon\Carbon;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['data'] = Jadwal::where('guru_id',auth()->user()->guru->id)->get();

        return view('presensi.index', $this->data);
    }

    public function add_presensi($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        if (!$jadwal) {
            return redirect()->route('presensi.index')->with('warning', 'Jadwal tidak ditemukan!');
        }

        $this->data['jadwal'] = $jadwal;

        return view('presensi.create',$this->data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('presensi.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'jadwal_id' => 'required|exists:jadwal,id',            
            'kelas_id' => 'required|exists:kelas,id',            
            'pertemuan' => 'required|string',
            'materi_pertemuan' => 'required|string',
            'silabus' => 'required'
        ]);
        $kelas = Kelas::findOrFail($request->kelas_id);
        $presensi = new Presensi();
        $presensi->jadwal_id = $request->jadwal_id;
        $presensi->tanggal = Carbon::now()->format('Y-m-d');
        $presensi->pertemuan = $request->pertemuan;
        $presensi->materi_pertemuan = $request->materi_pertemuan;
        $presensi->silabus = $request->silabus;
        $tmpData = [];
        foreach ($kelas->siswas as $key => $siswa) {
            $tmp = [];
            $tmp['id'] = $siswa->id;
            $tmp['nis'] = $siswa->nis;
            $tmp['nama'] = $siswa->nama;
            $tmp['status'] = null;
            $tmp['keterangan'] = null;
            array_push($tmpData,$tmp);
        }
        $presensi->data = json_encode($tmpData);
        $presensi->save();        

        return redirect()->route('lengkapi.presensi',$presensi->id);
    }

    public function lengkapi_presensi($id)
    {        
        $data = Presensi::findOrFail($id);
        $data->data = json_decode($data->data);
        $this->data['data'] = $data;

        return view('presensi.detail', $this->data);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('presensi.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('presensi.edit', $this->data);
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
        $this->validate($request,[
            'id' => 'required|array',            
            'nis' => 'required|array',            
            'nama' => 'required|array',           
            'keterangan' => 'required|array'
        ]);
        $presensi = Presensi::findOrFail($id);
        $data = [];
        foreach ($request->id as $key => $id) {
            $tmp = [];
            $tmp['id'] = $id;
            $tmp['nis'] = $request->nis[$key];
            $tmp['nama'] = $request->nama[$key];
            $status = 'siswa'.$key;
            $tmp['status'] = $request->$status;
            $tmp['keterangan'] = $request->keterangan[$key];
            array_push($data,$tmp);
        }
        $presensi->data = json_encode($data);
        $presensi->save();

        return redirect()->route('lengkapi.presensi',$id)->with('success', 'Presensi berhasil disimpan!');
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
