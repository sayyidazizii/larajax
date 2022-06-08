<?php

namespace App\Http\Controllers;

use App\Siswa;
use Mockery\Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        return view('siswa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::connection('pgsql_external')
            ->table('siswas')->insert(
                [
                    'nis' => $request['nis'],
                    'nama' => $request['nama'],
                    'kelas' => $request['kelas'],
                ]
            );
        return response()->json([
            'success' => true,
            'message' => 'Data Created',
        ]);
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
        $siswa = Siswa::find($id);

        // $siswa = DB::connection('pgsql_external')
        // ->select("select * from public.getid('$id')");
        return $siswa;
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
        $input = $request->all();
        $siswa = Siswa::findOrFail($id);

        $siswa->update($input);


        DB::connection('pgsql_external')
            ->table('siswas')
            ->where('id', $id)
            ->update([
                'nis' => $request['nis'],
                'nama' => $request['nama'],
                'kelas' => $request['kelas'],
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Siswa::destroy($id);
    }

    public function apiSiswa()
    {
        $siswa = DB::connection('pgsql_external')
            ->select('select * from public.getdata()');
        return Datatables::of($siswa)
            ->addColumn('action', function ($siswa) {
                return '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm(' . $siswa->id_siswa . ')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData(' . $siswa->id_siswa . ')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })->make(true);
    }
}
