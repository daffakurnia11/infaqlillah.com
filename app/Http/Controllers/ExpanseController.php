<?php

namespace App\Http\Controllers;

use App\Models\Expanse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpanseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengeluaran-lain.index', [
            'title'     => 'Bazar Subuh',
            'datas'     => Expanse::where('event', '!=', 'Bazaar')->get()
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
            'event'     => 'required',
            'nominal'   => 'required|numeric',
            'date'      => 'required',
            'photo'     => 'nullable|mimes:jpg,jpeg,png'
        ]);

        if ($validator->fails()) {
            return back()->with('failed', 'Data terdapat kesalahan atau belum lengkap!');
        }

        if ($request->hasFile('photo')) {
            $fileName = $request->date . '_Pengeluaran Lain.' . $request->photo->extension();
            $request->photo->move(public_path('img/foto_lain'), $fileName);
            $photo = $fileName;
        } else {
            $photo = NULL;
        }

        Expanse::create([
            'event'     => $request->event,
            'nominal'   => $request->nominal,
            'date'      => $request->date,
            'photo'     => $photo
        ]);
        return back()->with('success', 'Pengeluaran telah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expanse  $expanse
     * @return \Illuminate\Http\Response
     */
    public function show(Expanse $expanse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expanse  $expanse
     * @return \Illuminate\Http\Response
     */
    public function edit(Expanse $expanse)
    {
        //
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
            'event'     => 'required',
            'nominal'   => 'required|numeric',
            'date'      => 'required',
            'photo'     => 'nullable|mimes:jpg,jpeg,png'
        ]);

        if ($validator->fails()) {
            return back()->with('failed', 'Data terdapat kesalahan atau belum lengkap!');
        }

        if ($request->hasFile('photo')) {
            // Remove last photos
            if ($expanse->photo) {
                unlink(public_path('img/foto_lain/' . $expanse->photo));
            }
            $fileName = $request->date . '_Pengeluaran Lain.' . $request->photo->extension();
            $request->photo->move(public_path('img/foto_lain'), $fileName);
            $photo = $fileName;
        } else {
            $photo = NULL;
        }
        $validated = [
            'event'     => $request->event,
            'nominal'   => $request->nominal,
            'date'      => $request->date,
            'photo'     => $photo
        ];

        $expanse->update($validated);
        return back()->with('success', 'Pengeluaran lain telah berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expanse  $expanse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expanse $expanse)
    {
        if ($expanse->photo) {
            unlink(public_path('img/foto_lain/' . $expanse->photo));
        }

        $expanse->delete();
        return back()->with('success', 'Pengeluaran lain telah berhasil dihapus!');
    }
}
