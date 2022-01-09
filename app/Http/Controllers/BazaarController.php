<?php

namespace App\Http\Controllers;

use App\Models\Expanse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BazaarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bazaar.index', [
            'datas'     => Expanse::where('event', 'Bazaar')->get()
        ]);
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
        $validator = Validator::make($request->all(), [
            'nominal'   => 'required|numeric',
            'date'      => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('failed', 'Data terdapat kesalahan atau belum lengkap!');
        }

        Expanse::create([
            'event'     => 'Bazaar',
            'nominal'   => $request->nominal,
            'date'      => $request->date,
        ]);
        return back()->with('success', 'Pengeluaran bazaar subuh berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expanse  $expanse
     * @return \Illuminate\Http\Response
     */
    public function getExpanseData(Expanse $expanse)
    {
        return response()->json($expanse);
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
            'nominal'   => 'required|numeric',
            'date'      => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('failed', 'Data terdapat kesalahan atau belum lengkap!');
        }
        $validated = [
            'nominal'   => $request->nominal,
            'date'      => $request->date,
        ];

        $expanse->update($validated);
        return back()->with('success', 'Pengeluaran bazaar subuh berhasil diubah!');
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
        return back()->with('success', 'Pengeluaran bazaar subuh berhasil dihapus!');
    }
}
