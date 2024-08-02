<?php

namespace App\Http\Controllers;

use App\Models\BreedDetails;
use App\Models\BreedRegistration;
use App\Models\LivestockInfo;
use App\Models\LivestockRegistration;
use App\Models\MilkRegistration;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // View Index page
    public function index()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $livestockNameRfid = LivestockRegistration::query()
            ->with("livestockInfo")
            ->join('livestock_info', 'livestock_reg.IID', '=', 'livestock_info.IID')
            ->select('livestock_reg.RFID_TAG', 'livestock_info.given_name')
            ->whereHas('livestockInfo', function ($query) {
                $query->where('farm_name', Auth::user()->farm_name);
            })
            ->get()
            ->pluck('given_name', 'RFID_TAG')
            ->toArray();


        $milkTotalRfid = MilkRegistration::query()
            ->with('livestockRegistration')
            ->join('milk_info', 'milk_reg.MILK_MID', '=', 'milk_info.MILK_MID')
            ->join('livestock_reg', 'milk_reg.RFID_TAG', '=', 'livestock_reg.RFID_TAG')
            ->join('livestock_info', 'livestock_reg.IID', '=', 'livestock_info.IID')
            ->where('livestock_info.farm_name', '=', Auth::user()->farm_name)
            ->whereYear('milk_reg.milking_date', $currentYear)
            ->whereMonth('milk_reg.milking_date', $currentMonth)
            ->select('milk_reg.RFID_TAG', 'milk_info.milk_yield')
            ->get();

        // dd($milkTotalRfid);

        $herdCount = LivestockInfo::query()
            ->where('farm_name', Auth::user()->farm_name)
            ->count();

        $deathCount = LivestockInfo::query()
            ->where('death_date', '!=', null)
            ->where('farm_name', Auth::user()->farm_name)
            ->count();


        if ($herdCount > 0) {
            $deathPercent = ($deathCount / $herdCount) * 100;
        } else {
            $deathPercent = 0;
        }

        $deathPercent = number_format($deathPercent, 2);
        // $kidCount = BreedRegistration::query()
        //     ->join('breed_details', 'breed_reg.BID', '=', 'breed_details.BID');


        $kidCount = BreedRegistration::query()
            ->join('breed_details', 'breed_reg.BID', '=', 'breed_details.BID')
            ->where(function ($query) {
                $query->whereIn('breed_details.sire_id', function ($subquery) {
                    $subquery->select('livestock_reg.RFID_TAG')
                        ->from('livestock_reg')
                        ->join('livestock_info', 'livestock_reg.IID', '=', 'livestock_info.IID')
                        ->where('livestock_info.farm_name', '=', Auth::user()->farm_name);
                });
            })
            ->count();

        $soldCount = LivestockInfo::query()
            ->where('sold_date', '!=', null)
            ->where('farm_name', Auth::user()->farm_name)
            ->count();



        $allMilkYield = 0;
        $milkTotals = [];

        // Initialize all goats with 0 tot_milk
        foreach ($livestockNameRfid as $RFID_TAG => $given_name) {
            $milkTotals[$RFID_TAG] = [
                'tot_milk' => 0,
                'given_name' => $given_name
            ];
        }

        foreach ($milkTotalRfid as $record) {
            $RFID_TAG = $record->RFID_TAG;
            $milk_yield = $record->milk_yield;

            // Update the tot_milk value for goats with milking records
            $milkTotals[$RFID_TAG]['tot_milk'] += $milk_yield;
            $allMilkYield += $milk_yield;
        }

        $threeMonthsAgo = now()->subMonths(3);

        $kid_goat = LivestockRegistration::query()
            ->whereHas('livestockInfo', function ($query) use ($threeMonthsAgo) {
                $query->where('farm_name', Auth::user()->farm_name)
                    ->whereDate('birth_date', '>=', $threeMonthsAgo);
            })
            ->count();

        $three_month_tag = LivestockRegistration::select("RFID_TAG")
            ->whereHas('livestockInfo', function ($query) use ($threeMonthsAgo) {
                $query->where('farm_name', Auth::user()->farm_name)
                    ->whereDate('birth_date', '<=', $threeMonthsAgo);
            })
            ->get();

        $breed_count_sire = BreedDetails::query()
            ->whereIn('sire_id', $three_month_tag)
            ->count();

        $breed_count_dam = BreedDetails::query()
            ->whereIn('dam_id', $three_month_tag)
            ->count();

        $doeling_count = $three_month_tag->count() - $breed_count_sire;
        $doe_count = $breed_count_sire;
        $buck_count = $breed_count_dam;

        return view('index')->with(['kid_goat' => $kid_goat, 'doe_count' => $doe_count, 'doeling_count' => $doeling_count, 'buck_count' => $buck_count, 'total_milk_yield' => $milkTotals, 'all_milk' => $allMilkYield, 'herd_count' => $herdCount, 'death_percent' => $deathPercent, 'sold_count' => $soldCount, 'kid_count' => $kidCount]);
    }

    public function userManagement()
    {
        $data = User::where("farm_name", Auth::User()->farm_name)->sortable()->paginate(5);
        $farm_name = User::select('farm_name')->distinct()->get();
        return view('User.user-management', ['users' => $data, 'empty' => false, 'farm_name' => $farm_name]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/user')->with('message', 'User was successfully deleted!');
    }



    // View Login page
    public function login()
    {

        if (View::exists('User.login')) {
            return view('User.login');
        } else {
            // return response()->view('errors.404');
            return abort(404);
        }
    }

    // View Register page
    public function register()
    {
        return view('User.register');
    }

    // Register process
    public function store(Request $request)
    {

        // dd($request);
        $validated = $request->validate([
            "first_name" => ['required', "min:3"],
            "last_name" => ['required', "min:3"],
            "farm_name" => ['required', "min:3"],
            "username" => ['required', 'min:3', Rule::unique('users', 'username')],
            "email" => ['required', 'email', Rule::unique('users', 'email')],
            "terms" => ['required'],
            "password" => 'required|confirmed|min:8'
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['role'] = "Farmer";


        $user = User::create($validated);


        if ($user->hasVerifiedEmail()) {
            auth()->login($user);
            return view('students.index');
        }

        $user->sendEmailVerificationNotification();

        auth()->login($user);

        return view('components.email-verification-sent', ['email' => $validated['email']]);
    }

    public function addUserAdmin(Request $request)
    {

        // dd($request->all());
        $validated = $request->validate([
            "first_name" => ['required', "min:3"],
            "last_name" => ['required', "min:3"],
            "farm_name" => ['required', "min:3"],
            "username" => ['required', 'min:3', Rule::unique('users', 'username')],
            "email" => ['required', 'email', Rule::unique('users', 'email')],
            "password" => 'required|min:8',
            "role" => 'required',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $validated['email_verified_at'] = now()->format('Y-m-d H:i:s');


        $user = User::create($validated);



        return redirect('/user')->with("message", "User was successfully added!");
    }

    // Login process
    public function process(Request $request)
    {
        $validated = $request->validate([
            "email" => ['required', 'email'],
            'password' => 'required'
        ]);

        if ($request->has('remember')) {
            $request->session()->put('login_email', $request->input('email'));
            $request->session()->put('remember', true);
        }

        if (auth()->attempt($validated, $request->has('remember'))) {
            $request->session()->regenerate();

            // Last Login
            /** @var \App\Models\User $user */
            $user = auth()->user();
            $user->last_login = now();
            $user->save();

            return redirect('/')->with('message', 'Welcome back!');
        }

        return back()->withErrors(['email' => "Login failed"])->onlyInput('email');
    }

    // Logout the session and redirect to login
    public function logout(Request $request)
    {
        $email = null;
        if ($request->session()->has('login_email') && $request->session()->pull('remember')) {
            $email = $request->session()->pull('login_email');
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->withInput(['email' => $email])->with(['message' => 'Logout successful']);
    }

    public function search(Request $request)
    {
        $empty = "false";
        $search = $request['search'];
        // $data = array('users' => DB::table('users')->sortable()->where('name', 'LIKE', '%'.$search.'%')->paginate(1000),
        // "isPaginate" => "off");

        // $data = User::where('name', 'LIKE', '%'.$search.'%')->sortable()->paginate(6);

        $data = User::where("farm_name", Auth::User()->farm_name)
            ->where(function ($query) use ($search) {
                $query->where('last_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('first_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%');
            })
            ->sortable()->paginate(5);

        if ($data->isEmpty()) {
            $empty = true;
        } else {
            $empty = false;
        }
        $farm_name = User::select('farm_name')->distinct()->get();
        return view('User.user-management', ['users' => $data, 'empty' => $empty, 'farm_name' => $farm_name]);
    }

    public function update(Request $request)
    {

        $user = User::find($request->id);

        if (!$user) {
            return back()->with("message", "Something happened!");
        }

        // Prepare the data for update
        $userData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'role' => $request->role,
            'farm_name' => $request->farm_name,
        ];

        // Check if the password is provided
        if (!empty($request->password)) {
            // Include the password in the update if provided
            $userData['password'] = bcrypt($request->password);
        }

        // Update the user
        $user->update($userData);

        return redirect('/user')->with("message", "User was successfully updated!");
    }
}
