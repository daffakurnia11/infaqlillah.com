<?php

namespace App\Http\Controllers;

use App\Models\Expanse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengeluaran-toko.index', [
            'title'     => 'Modal Toko',
            'datas'     => Expanse::where('event', 'Modal Toko')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'notes'     => 'required',
            'nominal'   => 'required|numeric',
            'date'      => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('failed', 'Data terdapat kesalahan atau belum lengkap!');
        }

        Expanse::create([
            'event'     => 'Modal Toko',
            'notes'     => $request->notes,
            'nominal'   => $request->nominal,
            'date'      => $request->date,
        ]);
        return back()->with('success', 'Modal toko telah berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expanse  $expanse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expanse $expanse)
    {
        $validator = Validator::make($request->all(), [
            'notes'     => 'required',
            'nominal'   => 'required|numeric',
            'date'      => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('failed', 'Data terdapat kesalahan atau belum lengkap!');
        }

        $validated = [
            'event'     => 'Modal Toko',
            'notes'     => $request->notes,
            'nominal'   => $request->nominal,
            'date'      => $request->date,
        ];

        $expanse->update($validated);
        return back()->with('success', 'Modal toko telah berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expanse  $expanse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expanse $expanse)
    {
        $expanse->delete();
        return back()->with('success', 'Modal toko telah berhasil dihapus!');
    }
}
