<?php

namespace App\Http\Controllers;

use App\Models\Store_income;
use Illuminate\Http\Request;

class Store_incomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('toko.index', [
            'incomes' => Store_income::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('toko.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'buyer'     => 'required',
            'nominal'   => 'required|numeric',
            'notes'     => 'nullable'
        ]);
        Store_income::create($validate);
        return redirect('toko')->with('success', 'Data pembelian berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store_income  $store_income
     * @return \Illuminate\Http\Response
     */
    public function edit(Store_income $store_income)
    {
        return view('toko.edit', [
            'income' => $store_income
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store_income  $store_income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store_income $store_income)
    {
        $validate = $request->validate([
            'buyer'     => 'required',
            'nominal'   => 'required|numeric',
            'notes'     => 'nullable'
        ]);
        $store_income->update($validate);
        return redirect('toko')->with('success', 'Data pembelian berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store_income  $store_income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store_income $store_income)
    {
        $store_income->delete();
        return redirect('toko')->with('success', 'Data pembelian berhasil dihapus!');
    }
}
