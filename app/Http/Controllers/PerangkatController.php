<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePerangkatRequest;
use App\Http\Requests\UpdatePerangkatRequest;
use App\Models\Perangkat;
use Illuminate\Http\Request;

class PerangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perangkats = Perangkat::where(function ($query) use ($request) {
            $query
            ->where('kode_perangkat', 'like', '%' . $request->get('search') . '%')
            ->where('name', 'like', '%' . $request->get('search') . '%');
        })
        ->paginate(10);

        return view('pages.perangkats.index', [
            'perangkats' => $perangkats
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('pages.perangkats.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePerangkatRequest $request)
    {
        $perangkats = $request->all();
        $perangkats['status'] = $request->get('status') == 'on' ? 'active' : 'not-active';

        $perangkats = Perangkat::create($perangkats);


        return redirect(route('perangkats.index'))->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Perangkat $perangkat)
    {
        $perangkatitems = $perangkat->perangkat_items()->paginate(10);
        return view('pages.perangkats.perangkat-item' , compact(['perangkat' , 'perangkatitems']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Perangkat $perangkat)
    {
        return view('pages.perangkats.edit', compact('perangkat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePerangkatRequest $request, Perangkat $perangkat)
    {
        $data = $request->all();
        $data['status'] = $request->get('status') == 'on' ? 'active' : 'not-active';
        $perangkat->update($data);

        return redirect(route('perangkats.index'))->with('success', 'Data Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perangkat $perangkat)
    {
        $perangkat->delete();

        return redirect(route('perangkats.index'))->with('success', 'Data Berhasil Dihapus');
    }
}
