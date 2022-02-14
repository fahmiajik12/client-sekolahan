<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Jadwal;
use App\Model\Kelas;
use App\Model\Mapel;
use App\Model\Account;
use App\Model\TahunAjaran;
use App\Model\Semester;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $this->data['jadwal'] = Jadwal::orderBy('created_at','ASC')->get();

        return view('jadwal.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['kelas'] = Kelas::all();
        $this->data['mapel'] = Mapel::all();
        $this->data['guru'] = Account::all();
        $this->data['tahunAjaran'] = TahunAjaran::all();

        return view('jadwal.create', $this->data);
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
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
            'jam_pelajaran' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
            'mapel_id' => 'required|exists:mapel,id',
            'guru_id' => 'required|exists:guru,id'
        ]);
        $semester = Semester::where('status',1)->first();        
        $request->merge(['semester_id' => $semester->id]);
        Jadwal::create($request->except('_token'));

        return redirect()->route('jadwal.index')->with('success', 'Data jadwal pelajaran berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['jadwal'] = Jadwal::findOrFail($id);

        return view('jadwal.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['kelas'] = Kelas::all();
        $this->data['mapel'] = Mapel::all();
        $this->data['guru'] = Account::all();
        $this->data['tahunAjaran'] = TahunAjaran::all();
        $this->data['jadwal'] = Jadwal::findOrFail($id);

        return view('jadwal.edit', $this->data);
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
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
            'jam_pelajaran' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
            'mapel_id' => 'required|exists:mapel,id',
            'guru_id' => 'required|exists:guru,id'
        ]);
        $semester = Semester::where('status',1)->first();
        $request->merge(['semester_id' => $semester->id]);
        Jadwal::where('id',$id)->update($request->except(['_token','_method']));

        return redirect()->route('jadwal.index')->with('success', 'Data jadwal pelajaran berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jadwal::where('id', $id)->delete();

        return redirect()->route('jadwal.index')->with('success', 'Data jadwal pelajaran berhasil dihapus!');
    }
}
