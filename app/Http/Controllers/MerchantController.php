<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Merchant_income;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pedagang.index', [
            'merchants'     => Merchant::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pedagang.create');
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
            'name'      => 'required',
            'gender'    => 'required',
            'nominal'   => 'required|numeric',
            'address'   => 'required',
            'photo'     => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);


        if ($request->hasFile('photo')) {
            // Uploading Photos
            $validated['number'] = Merchant::orderBy('number', 'DESC')->first()->number + 1;
            $validated['received_at'] = Carbon::now();

            $photoFile = $validated['number'] . '.' . $request->photo->extension();
            $request->photo->move(public_path('img/foto_pedagang'), $photoFile);

            $validated['photo'] = $photoFile;

            Merchant::create($validated);
            return redirect('pedagang/' . $validated['number'])->with('message', 'Pengeluaran telah dicatat dan Pedagang telah ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function show(Merchant $merchant)
    {
        $monthlist = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $incomes = Merchant_income::where('merchant_id', $merchant->id)->get();
        $data = [];

        $year_merchant = date('Y', strtotime($merchant->created_at)) < 2021 ? 2021 : date('Y', strtotime($merchant->created_at));
        if (date('Y', strtotime($merchant->created_at)) == 2020) {
            $month_merchant = 0;
        } else {
            $month_merchant = date('n', strtotime($merchant->created_at));
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
        if ($month_now != $month_merchant) {
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
        } else {
            $data[] = [
                'period'    => $monthlist[$month_now - 1],
                'nominal'   => 0
            ];
        }
        return view('pedagang.show', [
            'merchant'      => $merchant,
            'income'        => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function edit(Merchant $merchant)
    {
        return view('pedagang.edit', compact('merchant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merchant $merchant)
    {
        $validated = $request->validate([
            'name'      => 'required',
            'gender'    => 'required',
            'status'    => 'required',
            'address'   => 'required',
            'photo'     => 'nullable|mimes:jpg,jpeg,png|max:2048'
        ]);


        if ($request->hasFile('photo')) {
            // Remove last photos
            $oldphoto = $merchant->photo;
            unlink(public_path('img/foto_pedagang/' . $oldphoto));
            // Uploading Photos
            $photoFile = $merchant->number . '.' . $request->photo->extension();
            $request->photo->move(public_path('img/foto_pedagang'), $photoFile);

            $validated['photo'] = $photoFile;
        }
        $merchant->update($validated);
        return redirect('pedagang/' . $merchant->number)->with('message', 'Data pedagang telah berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchant $merchant)
    {
        $photo = $merchant->photo;
        unlink(public_path('img/foto_pedagang/' . $photo));

        $merchant->delete();
        return redirect('pedagang')->with('message', 'Data pedagang telah berhasil dihapus!');
    }

    public function income()
    {
        return view('pedagang.income', [
            'merchants'     => Merchant::all(),
        ]);
    }

    public function getMerchantData(Merchant $merchant)
    {
        return response()->json($merchant);
    }

    public function addIncome(Request $request, Merchant $merchant)
    {

        $validator = Validator::make($request->all(), [
            'merchant_id'   => 'required',
            'number'        => 'required',
            'name'          => 'required',
            'period'        => 'required',
            'nominal'       => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return back()->with('message', 'Data masih belum lengkap!');
        }

        $total = $merchant->incomes + $request->nominal;

        $merchant->update(['incomes' => $total]);
        Merchant_income::create([
            'merchant_id'   => $request->merchant_id,
            'period'        => $request->period,
            'nominal'       => $request->nominal,
            'received_at'   => Carbon::now(),
        ]);

        return back()->with('message', 'Data berhasil dikirim! Cek kembali data anda!');
    }

    public function getIncomeData(Merchant $merchant)
    {
        $monthlist = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $incomes = Merchant_income::where('merchant_id', $merchant->id)->get();
        $data = [];

        $year_merchant = date('Y', strtotime($merchant->created_at)) < 2021 ? 2021 : date('Y', strtotime($merchant->created_at));
        if (date('Y', strtotime($merchant->created_at)) == 2020) {
            $month_merchant = 0;
        } else {
            $month_merchant = date('n', strtotime($merchant->created_at));
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
}
