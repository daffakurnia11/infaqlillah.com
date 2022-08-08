<?php

namespace App\Http\Controllers;

use App\Models\Friday;
use Illuminate\Http\Request;

class FridayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function aminah_al_fajr()
    {
        return view('jumat-berkah.aminah-al-fajr', [
            'title'     => 'Jumat Berkah Masjid Aminah Al-Fajr',
            'datas'     => Friday::where('category', 'Masjid Aminah Al-Fajr')->get()
        ]);
    }
    public function siwalan_panji()
    {
        return view('jumat-berkah.siwalan-panji', [
            'title'     => 'Jumat Berkah Masjid Siwalan Panji',
            'datas'     => Friday::where('category', 'Masjid Siwalan Panji')->get()
        ]);
    }
    public function buduran()
    {
        return view('jumat-berkah.buduran', [
            'title'     => 'Jumat Berkah Buduran',
            'datas'     => Friday::where('category', 'Buduran')->get()
        ]);
    }
    public function gedangan()
    {
        return view('jumat-berkah.gedangan', [
            'title'     => 'Jumat Berkah Gedangan',
            'datas'     => Friday::where('category', 'Gedangan')->get()
        ]);
    }
    public function tulungagung()
    {
        return view('jumat-berkah.tulungagung', [
            'title'     => 'Jumat Berkah Tulungagung',
            'datas'     => Friday::where('category', 'Tulungagung')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jumat-berkah.create', [
            'title'     => 'Tambah Pengeluaran Jumat Berkah'
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
            'in_charge'     => 'required',
            'category'      => 'required',
            'nominal'       => 'required|numeric',
            'date_period'   => 'required',
            'photo'         => 'nullable|mimes:jpg,jpeg,png'
        ]);

        if ($request->hasFile('photo')) {
            $fileName = $validated['date_period'] . '_' . $validated['category'] . '.' . $request->photo->extension();
            $request->photo->move(public_path('img/foto_jumat'), $fileName);
            $validated['photo'] = $fileName;
        }
        Friday::create($validated);
        switch ($validated['category']) {
            case 'Masjid Aminah Al-Fajr':
                $slug = 'aminah-al-fajr';
                break;
            case 'Masjid Siwalan Panji':
                $slug = 'siwalan-panji';
                break;
            case 'Buduran':
                $slug = 'buduran';
                break;
            case 'Gedangan':
                $slug = 'gedangan';
                break;
            case 'Tulungagung':
                $slug = 'tulungagung';
                break;
        }
        return redirect('admin/jumat-berkah/' . $slug)->with('success', 'Data pengeluaran jumat berkah berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Friday  $friday
     * @return \Illuminate\Http\Response
     */
    public function edit(Friday $friday)
    {
        return view('jumat-berkah.edit', [
            'title'     => 'Ubah Pengeluaran Jumat Berkah',
            'friday'    => $friday
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Friday  $friday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Friday $friday)
    {

        $validated = $request->validate([
            'in_charge'     => 'required',
            'category'      => 'required',
            'nominal'       => 'required|numeric',
            'date_period'   => 'required',
            'photo'         => 'nullable|mimes:jpg,jpeg,png'
        ]);

        if ($request->hasFile('photo')) {
            // Remove last photos
            if ($friday->photo) {
                if ($friday->category != $validated['category']) {
                    $oldphoto = $friday->photo;
                    unlink(public_path('img/foto_jumat/' . $oldphoto));
                }
            }

            // Uploading Photos
            $fileName = $validated['date_period'] . '_' . $validated['category'] . '.' . $request->photo->extension();
            $request->photo->move(public_path('img/foto_jumat'), $fileName);

            $validated['photo'] = $fileName;
        }

        $friday->update($validated);
        switch ($validated['category']) {
            case 'Masjid Aminah Al-Fajr':
                $slug = 'aminah-al-fajr';
                break;
            case 'Masjid Siwalan Panji':
                $slug = 'siwalan-panji';
                break;
            case 'Buduran':
                $slug = 'buduran';
                break;
            case 'Gedangan':
                $slug = 'gedangan';
                break;
            case 'Tulungagung':
                $slug = 'tulungagung';
                break;
        }
        return redirect('admin/jumat-berkah/' . $slug)->with('success', 'Data pengeluaran jumat berkah berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Friday  $friday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Friday $friday)
    {
        if ($friday->photo) {
            unlink(public_path('img/foto_jumat/' . $friday->photo));
        }

        switch ($friday->category) {
            case 'Masjid Aminah Al-Fajr':
                $slug = 'aminah-al-fajr';
                break;
            case 'Masjid Siwalan Panji':
                $slug = 'siwalan-panji';
                break;
            case 'Buduran':
                $slug = 'buduran';
                break;
            case 'Gedangan':
                $slug = 'gedangan';
                break;
            case 'Tulungagung':
                $slug = 'tulungagung';
                break;
        }
        $friday->delete();
        return redirect('admin/jumat-berkah/' . $slug)->with('success', 'Data pengeluaran jumat berkah berhasil dihapus!');
    }
}
