<?php

namespace App\Http\Controllers;

use App\Models\Donor_income;
use App\Models\Expanse;
use App\Models\Foundation;
use App\Models\Friday;
use App\Models\Merchant;
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
        // MERCHANT ALL INCOMES
        $merchant_incomes = 0;
        $merchant_income = Merchant_income::all();
        foreach ($merchant_income as $data) {
            $merchant_incomes = $merchant_incomes + $data->nominal;
        }
        // MERCHANT MONTHLY INCOMES
        $merchant_now = 0;
        $merchant_data = Merchant_income::whereMonth('created_at', '=', Carbon::now()->format('m'))->whereYear('created_at', '=', Carbon::now()->format('Y'))->get();
        foreach ($merchant_data as $data) {
            $merchant_now = $merchant_now + $data->nominal;
        }

        // DONOR ALL INCOMES
        $donor_incomes = 0;
        $donor_income = Donor_income::all();
        foreach ($donor_income as $data) {
            $donor_incomes = $donor_incomes + $data->nominal;
        }
        // DONOR MONTHLY INCOMES
        $donor_now = 0;
        $donor_data = Donor_income::whereMonth('created_at', '=', Carbon::now()->format('m'))->whereYear('created_at', '=', Carbon::now()->format('Y'))->get();
        foreach ($donor_data as $data) {
            $donor_now = $donor_now + $data->nominal;
        }

        // STORE ALL INCOMES
        $store_incomes = 0;
        $store_income = Store::all();
        foreach ($store_income as $data) {
            $store_incomes = $store_incomes + $data->nominal;
        }
        // STORE MONTHLY INCOMES
        $store_now = 0;
        $store_data = Store::whereMonth('created_at', '=', Carbon::now()->format('m'))->whereYear('created_at', '=', Carbon::now()->format('Y'))->get();
        foreach ($store_data as $data) {
            $store_now = $store_now + $data->nominal;
        }

        // MERCHANT ALL EXPANSES
        $merchant_expanses = 0;
        $merchant_expanse = Merchant::all();
        foreach ($merchant_expanse as $data) {
            $merchant_expanses = $merchant_expanses + $data->nominal;
        }
        // MERCHANT MONTHLY EXPANSES
        $merchant_monthly = 0;
        $merchant_monthly_data = Merchant::whereMonth('created_at', '=', Carbon::now()->format('m'))->whereYear('created_at', '=', Carbon::now()->format('Y'))->get();
        foreach ($merchant_monthly_data as $data) {
            $merchant_monthly = $merchant_monthly + $data->nominal;
        }

        // BAZAAR MONTHLY EXPANSES
        $bazaar_nominal = 0;
        $bazaar_data = Expanse::whereMonth('date', '=', Carbon::now()->format('m'))->whereYear('date', '=', Carbon::now()->format('Y'))->where('event', 'Bazaar')->get();
        foreach ($bazaar_data as $data) {
            $bazaar_nominal = $bazaar_nominal + $data->nominal;
        }

        // FRIDAY ALL EXPANSES
        $friday_expanses = 0;
        $friday_expanse = Friday::all();
        foreach ($friday_expanse as $data) {
            $friday_expanses = $friday_expanses + $data->nominal;
        }
        // FRIDAY MONTHLY EXPANSES
        $friday_permonth = 0;
        $friday_onemonth = Friday::whereMonth('created_at', '=', Carbon::now()->format('m'))->whereYear('created_at', '=', Carbon::now()->format('Y'))->get();
        foreach ($friday_onemonth as $data) {
            $friday_permonth = $friday_permonth + $data->nominal;
        }
        // MASJID AMINAH AL FAJR
        $friday_category1 = 0;
        $friday_data1 = Friday::whereMonth('created_at', '=', Carbon::now()->format('m'))->whereYear('created_at', '=', Carbon::now()->format('Y'))->where('category', 'Masjid Aminah Al-Fajr')->get();
        foreach ($friday_data1 as $data) {
            $friday_category1 = $friday_category1 + $data->nominal;
        }
        // MASJID SIWALAN PANJI
        $friday_category2 = 0;
        $friday_data2 = Friday::whereMonth('created_at', '=', Carbon::now()->format('m'))->whereYear('created_at', '=', Carbon::now()->format('Y'))->where('category', 'Masjid Siwalan Panji')->get();
        foreach ($friday_data2 as $data) {
            $friday_category2 = $friday_category2 + $data->nominal;
        }
        // BUDURAN
        $friday_category3 = 0;
        $friday_data3 = Friday::whereMonth('created_at', '=', Carbon::now()->format('m'))->whereYear('created_at', '=', Carbon::now()->format('Y'))->where('category', 'Buduran')->get();
        foreach ($friday_data3 as $data) {
            $friday_category3 = $friday_category3 + $data->nominal;
        }
        // GEDANGAN
        $friday_category4 = 0;
        $friday_data4 = Friday::whereMonth('created_at', '=', Carbon::now()->format('m'))->whereYear('created_at', '=', Carbon::now()->format('Y'))->where('category', 'Gedangan')->get();
        foreach ($friday_data4 as $data) {
            $friday_category4 = $friday_category4 + $data->nominal;
        }
        // TULUNGAGUNG
        $friday_category5 = 0;
        $friday_data5 = Friday::whereMonth('created_at', '=', Carbon::now()->format('m'))->whereYear('created_at', '=', Carbon::now()->format('Y'))->where('category', 'Tulungagung')->get();
        foreach ($friday_data5 as $data) {
            $friday_category5 = $friday_category5 + $data->nominal;
        }

        // FOUNDATION ALL EXPANSES
        $fondation_expanses = 0;
        $fondation_expanse = Foundation::all();
        foreach ($fondation_expanse as $data) {
            $fondation_expanses = $fondation_expanses + $data->nominal;
        }
        // FOUNDATION MONTHLY EXPANSES
        $foundation_permonth = 0;
        $foundation_onemonth = Foundation::whereMonth('created_at', '=', Carbon::now()->format('m'))->whereYear('created_at', '=', Carbon::now()->format('Y'))->get();
        foreach ($foundation_onemonth as $data) {
            $foundation_permonth = $foundation_permonth + $data->nominal;
        }
        // YAYASAN NURUSSALAM
        $foundation_category1 = 0;
        $foundation_data1 = Foundation::whereMonth('created_at', '=', Carbon::now()->format('m'))->whereYear('created_at', '=', Carbon::now()->format('Y'))->where('category', 'Yayasan Nurussalam')->get();
        foreach ($foundation_data1 as $data) {
            $foundation_category1 = $foundation_category1 + $data->nominal;
        }
        // YAYASAN AL FIRDAUS
        $foundation_category2 = 0;
        $foundation_data2 = Foundation::whereMonth('created_at', '=', Carbon::now()->format('m'))->whereYear('created_at', '=', Carbon::now()->format('Y'))->where('category', 'Yayasan Al Firdaus')->get();
        foreach ($foundation_data2 as $data) {
            $foundation_category2 = $foundation_category2 + $data->nominal;
        }
        // YAYASAN AL KAHFI
        $foundation_category3 = 0;
        $foundation_data3 = Foundation::whereMonth('created_at', '=', Carbon::now()->format('m'))->whereYear('created_at', '=', Carbon::now()->format('Y'))->where('category', 'Yayasan Al Kahfi')->get();
        foreach ($foundation_data3 as $data) {
            $foundation_category3 = $foundation_category3 + $data->nominal;
        }
        // ALL OTHER EXPANSES
        $all_expanses = 0;
        $all_expanse = Expanse::all();
        foreach ($all_expanse as $data) {
            $all_expanses = $all_expanses + $data->nominal;
        }
        // MONTHLY OTHER EXPANSES
        $monthly_expanses = 0;
        $monthly_expanse = Expanse::whereMonth('created_at', '=', Carbon::now()->format('m'))->whereYear('created_at', '=', Carbon::now()->format('Y'))->get();
        foreach ($monthly_expanse as $data) {
            $monthly_expanses = $monthly_expanses + $data->nominal;
        }

        $total_income = $merchant_incomes + $donor_incomes + $store_incomes;
        $total_expanses = $merchant_expanses + $friday_expanses + $fondation_expanses + $all_expanses;

        $now_income = $merchant_now + $donor_now + $store_now;
        $now_expanses = $merchant_monthly + $friday_permonth + $foundation_permonth + $monthly_expanses;

        return view('index', [
            'title'             => 'Dashboard',
            'current'           => $total_income - $total_expanses,
            'monthly_current'   => $now_income - $now_expanses,
            // All Incomes
            'all_incomes'       => $total_income,
            'incomes_inc'       => $now_income,
            'expanse_inc'       => $now_expanses,
            'merchant_incomes'  => $merchant_incomes,
            'merchant_inc'      => $merchant_now,
            'donor_incomes'     => $donor_incomes,
            'donor_inc'         => $donor_now,
            'store_incomes'     => $store_incomes,
            'store_inc'         => $store_now,
            // All Expanses
            'all_expanses'      => $total_expanses,
            'friday_permonth'   => $friday_permonth,
            'friday_1'          => $friday_category1,
            'friday_2'          => $friday_category2,
            'friday_3'          => $friday_category3,
            'friday_4'          => $friday_category4,
            'friday_5'          => $friday_category5,

            'foundation_permonth'   => $foundation_permonth,
            'foundation_1'          => $foundation_category1,
            'foundation_2'          => $foundation_category2,
            'foundation_3'          => $foundation_category3,

            'bazaar_total'      => $bazaar_nominal,
            'bazaars'           => $bazaar_data
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

    public function storeExpanses()
    {
        $monthlist = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $incomes = Expanse::where('event', 'Modal Toko')->get();
        $data = [];

        $year_start = 2022;
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
                $year_income = date('Y', strtotime($income->date));
                $month_income = date('n', strtotime($income->date));
                $period_income = $monthlist[$month_income - 1] . ' ' . $year_income;
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

    public function otherExpanses()
    {
        $monthlist = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $incomes = Expanse::where('event', '!=', 'Modal Toko')->where('event', '!=', 'Bazaar')->get();
        $data = [];

        $year_start = 2022;
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
                $year_income = date('Y', strtotime($income->date));
                $month_income = date('n', strtotime($income->date));
                $period_income = $monthlist[$month_income - 1] . ' ' . $year_income;
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
