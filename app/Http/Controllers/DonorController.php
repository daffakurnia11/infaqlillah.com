<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\Donor_income;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('donatur.index', [
            'title'     => 'Infaq Donatur',
            'donors'    => Donor::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('donatur.create', [
            'title'     => 'Tambah Donatur'
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
            'name'          => 'required',
            'gender'        => 'required',
            'address'       => 'required',
            'first_donate'  => 'nullable|numeric|required_with:period',
            'period'        => 'nullable|required_with:first_donate'
        ]);

        if ($request->first_donate != 0) {
            $donate = $validated['first_donate'];
        } else {
            $donate = 0;
        }

        $id = Donor::create([
            'name'      => $validated['name'],
            'gender'    => $validated['gender'],
            'address'   => $validated['address'],
            'donate'    => $donate
        ])->id;

        if ($request->first_donate && $request->period) {
            Donor_income::create([
                'donor_id'      => $id,
                'period'        => $validated['period'],
                'nominal'       => $validated['first_donate'],
                'received_at'   => Carbon::now()
            ]);
        }
        return redirect('admin/donatur')->with('success', 'Donatur telah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donor  $donor
     * @return \Illuminate\Http\Response
     */
    public function show(Donor $donor)
    {
        $monthlist = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $incomes = Donor_income::where('donor_id', $donor->id)->get();
        $data = [];

        $year_merchant = date('Y', strtotime($donor->created_at)) < 2021 ? 2021 : date('Y', strtotime($donor->created_at));
        if (date('Y', strtotime($donor->created_at)) == 2020) {
            $month_merchant = 0;
        } else {
            $month_merchant = date('n', strtotime($donor->created_at));
        }
        $year_now = date('Y', strtotime(Carbon::now()));
        $month_now = date('n', strtotime(Carbon::now()));

        if ($year_merchant < $year_now) {
            while ($year_merchant < $year_now) {
                while ($month_merchant < 12) {
                    $period_list = $monthlist[$month_merchant] . ' ' . $year_merchant;
                    $nominal = 0;
                    foreach ($incomes as $income) {
                        $year_income = date('Y', strtotime($income->created_at));
                        $period_income = $income->period . ' ' . $year_income;
                        if ($period_income == $period_list) {
                            $nominal = $income->nominal;
                            break;
                        } else {
                            $nominal = 0;
                        }
                    }
                    $data[] = [
                        'period'    => $period_list,
                        'nominal'   => $nominal
                    ];
                    $month_merchant++;
                }
                if ($month_merchant == 12) {
                    $month_merchant = 0;
                }
                $year_merchant++;
            }
        }
        $month = 0;
        while ($month < $month_now) {
            $period_list = $monthlist[$month] . ' ' . $year_now;
            $nominal = 0;
            foreach ($incomes as $income) {
                $year_income = date('Y', strtotime($income->created_at));
                $period_income = $income->period . ' ' . $year_income;
                if ($period_income == $period_list) {
                    $nominal = $income->nominal;
                    break;
                } else {
                    $nominal = 0;
                }
            }
            $data[] = [
                'period'    => $period_list,
                'nominal'   => $nominal
            ];
            $month++;
        }
        return view('donatur.show', [
            'title'         => 'Detail Pedagang No ' . $donor->number,
            'donor'         => $donor,
            'income'        => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donor  $donor
     * @return \Illuminate\Http\Response
     */
    public function edit(Donor $donor)
    {
        return view('donatur.edit', [
            'title'     => 'Ubah Donatur ' . $donor->name,
            'donor'     => $donor
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donor  $donor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donor $donor)
    {
        $validated = $request->validate([
            'name'      => 'required',
            'gender'    => 'required',
            'address'   => 'required',
        ]);

        $donor->update($validated);
        return redirect('admin/donatur')->with('success', 'Data donatur telah berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donor  $donor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donor $donor)
    {
        $donor->delete();
        return redirect('admin/donatur')->with('success', 'Data donatur telah berhasil dihapus!');
    }

    public function donorIncomeData(Donor $donor)
    {
        $monthlist = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $incomes = Donor_income::where('donor_id', $donor->id)->get();
        $data = [];

        $year_merchant = date('Y', strtotime($donor->created_at)) < 2021 ? 2021 : date('Y', strtotime($donor->created_at));
        if (date('Y', strtotime($donor->created_at)) == 2020) {
            $month_merchant = 0;
        } else {
            $month_merchant = date('n', strtotime($donor->created_at));
        }
        $year_now = date('Y', strtotime(Carbon::now()));
        $month_now = date('n', strtotime(Carbon::now()));

        if ($year_merchant < $year_now) {
            while ($year_merchant < $year_now) {
                while ($month_merchant < 12) {
                    foreach ($incomes as $income) {
                        $year_income = date('Y', strtotime($income->created_at));
                        $period_income = $income->period . ' ' . $year_income;
                        $period_list = $monthlist[$month_merchant] . ' ' . $year_merchant;
                        if ($period_income == $period_list) {
                            $nominal = $income->nominal;
                            break;
                        } else {
                            $nominal = 0;
                        }
                    }
                    $data['period'][] = $period_list;
                    $data['nominal'][] = $nominal;
                    $month_merchant++;
                }
                if ($month_merchant == 12) {
                    $month_merchant = 0;
                }
                $year_merchant++;
            }
        }
        $month = 0;
        while ($month < $month_now) {
            foreach ($incomes as $income) {
                $year_income = date('Y', strtotime($income->created_at));
                $period_income = $income->period . ' ' . $year_income;
                $period_list = $monthlist[$month] . ' ' . $year_now;
                if ($period_income == $period_list) {
                    $nominal = $income->nominal;
                    break;
                } else {
                    $nominal = 0;
                }
            }
            $data['period'][] = $period_list;
            $data['nominal'][] = $nominal;
            $month++;
        }
        return json_encode($data);
    }

    public function getDonorData(Donor $donor)
    {
        return response()->json($donor);
    }

    public function addIncome(Request $request, Donor $donor)
    {

        $validator = Validator::make($request->all(), [
            'donor_id'      => 'required',
            'name'          => 'required',
            'period'        => 'required',
            'nominal'       => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return back()->with('failed', 'Data masih belum lengkap!');
        }

        $total = $donor->donate + $request->nominal;

        $donor->update(['donate' => $total]);
        Donor_income::create([
            'donor_id'      => $request->donor_id,
            'period'        => $request->period,
            'nominal'       => $request->nominal,
            'received_at'   => Carbon::now(),
        ]);

        return back()->with('success', 'Data berhasil dikirim! Cek kembali data anda!');
    }
}
