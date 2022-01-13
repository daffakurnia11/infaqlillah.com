<?php

namespace App\Http\Controllers;

use App\Models\Foundation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FoundationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nurussalam()
    {
        return view('yatim-piatu.nurussalam', [
            'title'     => 'Yayasan Nurussalam',
            'datas'     => Foundation::where('category', 'Yayasan Nurussalam')->get()
        ]);
    }
    public function al_firdaus()
    {
        return view('yatim-piatu.al-firdaus', [
            'title'     => 'Yayasan Al Firdaus',
            'datas'     => Foundation::where('category', 'Yayasan Al Firdaus')->get()
        ]);
    }
    public function al_kahfi()
    {
        return view('yatim-piatu.al-kahfi', [
            'title'     => 'Yayasan Al Kahfi',
            'datas'     => Foundation::where('category', 'Yayasan Al Kahfi')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('yatim-piatu.create', [
            'title'     => 'Tambah Pengeluaran Yatim Piatu'
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
        $validated = $request->validate([
            'receiver'      => 'required',
            'category'      => 'required',
            'nominal'       => 'required|numeric',
            'period'        => 'required',
            'photo'         => 'nullable|mimes:jpg,jpeg,png'
        ]);

        if ($request->hasFile('photo')) {
            $fileName = $validated['period'] . '_' . $validated['category'] . '.' . $request->photo->extension();
            $request->photo->move(public_path('img/foto_yayasan'), $fileName);
            $validated['photo'] = $fileName;
        }
        $validated['received_at'] = Carbon::now();
        Foundation::create($validated);
        switch ($validated['category']) {
            case 'Yayasan Nurussalam':
                $slug = 'nurussalam';
                break;
            case 'Yayasan Al Firdaus':
                $slug = 'al-firdaus';
                break;
            case 'Yayasan Al Kahfi':
                $slug = 'al-kahfi';
                break;
        }
        return redirect('yatim-piatu/' . $slug)->with('success', 'Data pengeluaran yatim piatu berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Foundation  $foundation
     * @return \Illuminate\Http\Response
     */
    public function edit(Foundation $foundation)
    {
        return view('yatim-piatu.edit', [
            'title'     => 'Ubah Pengeluaran Yatim Piatu',
            'data'      => $foundation
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Foundation  $foundation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Foundation $foundation)
    {
        $validated = $request->validate([
            'receiver'      => 'required',
            'category'      => 'required',
            'nominal'       => 'required|numeric',
            'period'        => 'required',
            'photo'         => 'nullable|mimes:jpg,jpeg,png'
        ]);

        if ($request->hasFile('photo')) {
            // Remove last photos
            if ($foundation->photo) {
                if ($foundation->category != $validated['photo']) {
                    $oldphoto = $foundation->photo;
                    unlink(public_path('img/foto_yayasan/' . $oldphoto));
                }
            }
            // Uploading Photos
            $fileName = $validated['period'] . '_' . $validated['category'] . '.' . $request->photo->extension();
            $request->photo->move(public_path('img/foto_yayasan'), $fileName);

            $validated['photo'] = $fileName;
        }

        $foundation->update($validated);
        switch ($validated['category']) {
            case 'Yayasan Nurussalam':
                $slug = 'nurussalam';
                break;
            case 'Yayasan Al Firdaus':
                $slug = 'al-firdaus';
                break;
            case 'Yayasan Al Kahfi':
                $slug = 'al-kahfi';
                break;
        }
        return redirect('yatim-piatu/' . $slug)->with('success', 'Data pengeluaran yatim piatu berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Foundation  $foundation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Foundation $foundation)
    {
        if ($foundation->photo) {
            unlink(public_path('img/foto_yayasan/' . $foundation->photo));
        }

        switch ($foundation->category) {
            case 'Yayasan Nurussalam':
                $slug = 'nurussalam';
                break;
            case 'Yayasan Al Firdaus':
                $slug = 'al-firdaus';
                break;
            case 'Yayasan Al Kahfi':
                $slug = 'al-kahfi';
                break;
        }
        $foundation->delete();
        return redirect('yatim-piatu/' . $slug)->with('success', 'Data pengeluaran yatim piatu berhasil dihapus!');
    }
}
