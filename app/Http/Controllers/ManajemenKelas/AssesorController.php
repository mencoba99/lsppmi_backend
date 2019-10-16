<?php

namespace App\Http\Controllers\ManajemenKelas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Assesor;
use DB;
use Yajra\Datatables\Facades\Datatables;

class AssesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url_ajax_datatable = route('assesor.ajax_datatable');
        return view('AssesorController.index', compact('url_ajax_datatable'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AssesorController.create');
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
            'nama' => 'required',
            'email' => 'required',
            'telepon' => 'required'
        ]);

        DB::beginTransaction();
        $success_trans = false;

        try {
            $assesor                = new Assesor;
            $assesor->name          = $request->nama;
            $assesor->email         = $request->email;
            $assesor->telephone     = $request->telepon;
            $assesor->institution   = $request->institusi;
            $assesor->position      = $request->jabatan;

            // Upload photo
            if ($request->hasFile('foto')) {
                $image          = $request->file('foto');
                $imagename      = 'ASSESOR_' . time() . '.' . $image->getClientOriginalExtension();
                $assesor->photo = $imagename;
            }
            $assesor->save();

            DB::commit();
            $success_trans = true;
        } catch (\Exception $e) {
            DB::rollback();
            abort(403, $e->getMessage());
        }

        if ($success_trans == true) {
            return redirect()->route('assesor');
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
        $assesor    = Assesor::find($id);
        $data       = ['assesor' => $assesor];
        return view('AssesorController.edit', $data);
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
        //
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

    /**
     * Ajax Datatable retrieve data into datatables.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajax_datatable(Request $request)
    {
        if ($request->ajax()) {
            
            $assesor    = DB::table('assesor')
            ->select([
               'assesor.id AS id', 
               'assesor.name AS name', 
               'assesor.email AS email', 
               'assesor.telephone AS telephone', 
               'assesor.institution AS institution', 
               'assesor.position AS position'
            ]);
            return datatables($assesor)
                        ->addColumn('action', function($assesor) {
                            $btn_action = '<a href="' . route('assesor.edit', $assesor->id) .'" class="btn btn-outline-brand">Edit</a>&nbsp;';
                            return $btn_action;
                        })
                        ->toJson();
        }
    }
}
