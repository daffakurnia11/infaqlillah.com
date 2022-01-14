<?php

namespace App\Http\Controllers;

use App\Models\Donor_income;
use App\Models\Merchant_income;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authentication(Request $request)
    {
        $credentials = $request->validate([
            'username'  => 'required',
            'password'  => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            if (auth()->user()->roles == 'Admin' || auth()->user()->roles == 'Superadmin') {
                return redirect('/');
            } else {
                return redirect('/');
            }
        }

        return back()->with('message', 'Login Failed');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('message', 'Logout Success');
    }

    public function index()
    {
        // MERCHANT DATA INCOMES
        $merchant_incomes = 0;
        $merchant_income = Merchant_income::all();
        foreach ($merchant_income as $data) {
            $merchant_incomes = $merchant_incomes + $data->nominal;
        }
        $merchant_now = 0;
        $merchant_data = Merchant_income::whereMonth('created_at', '=', Carbon::now()->format('m'))->whereYear('created_at', '=', Carbon::now()->format('Y'))->get();
        foreach ($merchant_data as $data) {
            $merchant_now = $merchant_now + $data->nominal;
        }

        // DONOR DATA INCOMES
        $donor_incomes = 0;
        $donor_income = Donor_income::all();
        foreach ($donor_income as $data) {
            $donor_incomes = $donor_incomes + $data->nominal;
        }
        $donor_now = 0;
        $donor_data = Donor_income::whereMonth('created_at', '=', Carbon::now()->format('m'))->whereYear('created_at', '=', Carbon::now()->format('Y'))->get();
        foreach ($donor_data as $data) {
            $donor_now = $donor_now + $data->nominal;
        }

        // STORE DATA INCOMES
        $store_incomes = 0;
        $store_income = Store::all();
        foreach ($store_income as $data) {
            $store_incomes = $store_incomes + $data->nominal;
        }
        $store_now = 0;
        $store_data = Store::whereMonth('created_at', '=', Carbon::now()->format('m'))->whereYear('created_at', '=', Carbon::now()->format('Y'))->get();
        foreach ($store_data as $data) {
            $store_now = $store_now + $data->nominal;
        }

        // 

        return view('index', [
            'title'             => 'Dashboard',
            // All Incomes
            'all_incomes'       => $merchant_incomes + $donor_incomes + $store_incomes,
            'all_inc'           => $merchant_now + $donor_now + $store_now,
            'merchant_incomes'  => $merchant_incomes,
            'merchant_inc'      => $merchant_now,
            'donor_incomes'     => $donor_incomes,
            'donor_inc'         => $donor_now,
            'store_incomes'     => $store_incomes,
            'store_inc'         => $store_now,
            // All Expanses

        ]);
    }

    public function merchantOverall()
    {
        $monthlist = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $incomes = Merchant_income::all();
        $data = [];

        $year_start = 2021;
        $year_now = date('Y', strtotime(Carbon::now()));
        $month_now = date('n', strtotime(Carbon::now()));

        while ($year_start < $year_now) {
            for ($month = 0; $month < 12; $month++) {
                $nominal = 0;
                foreach ($incomes as $income) {
                    $year_income = date('Y', strtotime($income->created_at));
                    $period_income = $income->period . ' ' . $year_income;
                    $period_list = $monthlist[$month] . ' ' . $year_start;
                    if ($period_income == $period_list) {
                        $nominal = $nominal + $income->nominal;
                    }
                }
                $data['period'][] = $period_list;
                $data['nominal'][] = $nominal;
            }
            $year_start++;
        }
        for ($month = 0; $month < $month_now; $month++) {
            $nominal = 0;
            foreach ($incomes as $income) {
                $year_income = date('Y', strtotime($income->created_at));
                $period_income = $income->period . ' ' . $year_income;
                $period_list = $monthlist[$month] . ' ' . $year_start;
                if ($period_income == $period_list) {
                    $nominal = $nominal + $income->nominal;
                }
            }
            $data['period'][] = $period_list;
            $data['nominal'][] = $nominal;
        }
        return json_encode($data);
    }

    public function donorOverall()
    {
        $monthlist = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $incomes = Donor_income::all();
        $data = [];

        $year_start = 2021;
        $year_now = date('Y', strtotime(Carbon::now()));
        $month_now = date('n', strtotime(Carbon::now()));

        while ($year_start < $year_now) {
            for ($month = 0; $month < 12; $month++) {
                $nominal = 0;
                foreach ($incomes as $income) {
                    $year_income = date('Y', strtotime($income->created_at));
                    $period_income = $income->period . ' ' . $year_income;
                    $period_list = $monthlist[$month] . ' ' . $year_start;
                    if ($period_income == $period_list) {
                        $nominal = $nominal + $income->nominal;
                    }
                }
                $data['period'][] = $period_list;
                $data['nominal'][] = $nominal;
            }
            $year_start++;
        }
        for ($month = 0; $month < $month_now; $month++) {
            $nominal = 0;
            foreach ($incomes as $income) {
                $year_income = date('Y', strtotime($income->created_at));
                $period_income = $income->period . ' ' . $year_income;
                $period_list = $monthlist[$month] . ' ' . $year_start;
                if ($period_income == $period_list) {
                    $nominal = $nominal + $income->nominal;
                }
            }
            $data['period'][] = $period_list;
            $data['nominal'][] = $nominal;
        }
        return json_encode($data);
    }
}
