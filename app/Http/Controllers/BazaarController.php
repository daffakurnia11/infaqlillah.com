<?php

namespace App\Http\Controllers;

use App\Models\Expanse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;

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
            'date'      => 'required',
            'photo'     => 'required|mimes:jpg,jpeg,png'
        ]);

        if ($validator->fails()) {
            return back()->with('failed', 'Data terdapat kesalahan atau belum lengkap!');
        }

        if ($request->hasFile('photo')) {
            $fileName = $request->date . '_Bazaar.' . $request->photo->extension();
            $request->photo->move(public_path('img/foto_bazaar'), $fileName);
            $photo = $fileName;
        } else {
            $photo = NULL;
        }

        Expanse::create([
            'event'     => 'Bazaar',
            'nominal'   => $request->nominal,
            'date'      => $request->date,
            'photo'     => $photo
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

        if ($request->hasFile('photo')) {
            // Remove last photos
            if ($expanse->photo) {
                unlink(public_path('img/foto_bazaar/' . $expanse->photo));
            }
            $fileName = $request->date . '_Bazaar.' . $request->photo->extension();
            $request->photo->move(public_path('img/foto_bazaar'), $fileName);
            $photo = $fileName;
        } else {
            $photo = NULL;
        }
        $validated = [
            'nominal'   => $request->nominal,
            'date'      => $request->date,
            'photo'     => $photo
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
        unlink(public_path('img/foto_bazaar/' . $expanse->photo));

        $expanse->delete();
        return back()->with('success', 'Pengeluaran bazaar subuh berhasil dihapus!');
    }
}
