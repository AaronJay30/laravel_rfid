<?php

namespace App\Http\Controllers;

use App\Exports\livestockExport;
use App\Http\Requests\BreedForm;
use App\Http\Requests\EditHerdForm;
use App\Http\Requests\HerdForm;
use App\Http\Requests\MilkForm;
use App\Models\BirthInfo;
use App\Models\BreedDetails;
use App\Models\BreedKidBirth;
use App\Models\BreedRegistration;
use App\Models\BuyerInfo;
use App\Models\Characteristic;
use App\Models\Dead;
use App\Models\ForageEst;
use App\Models\ForageInfo;
use App\Models\ForageRegistration;
use App\Models\LivestockInfo;
use App\Models\LivestockRegistration;
use App\Models\MilkInfo;
use App\Models\MilkLactation;
use App\Models\MilkRegistration;
use App\Models\NineMonth;
use App\Models\OneYear;
use App\Models\Progress;
use App\Models\ScheduleModel;
use App\Models\SixMonth;
use App\Models\ThreeMonth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use PhpSerial;

class LivestockController extends Controller
{
    public function myHerd()
    {
        $empty = false;

        $livestocks = LivestockRegistration::query()
            ->with("livestockInfo", "characteristic", "birthInfo")
            ->whereHas('livestockInfo', function ($query) {
                $query->where('farm_name', Auth::user()->farm_name)
                    ->where('death_date', null)
                    ->where('sold_date', null);
            })->orderBy('RFID_TAG', 'asc')->paginate(5);

        // dd($livestocks);

        if ($livestocks) {
            $empty = true;
        }

        $breeds = LivestockInfo::query()
            ->select('breed')
            ->distinct()->get();

        $sex = LivestockInfo::query()
            ->select('sex')
            ->distinct()->get();

        return view('Livestock.my-herd', ['livestocks' => $livestocks, 'breeds' => $breeds, 'sex' => $sex, 'empty' => $empty]);
    }

    public function search(Request $request)
    {
        $empty = false;

        $livestocks = LivestockRegistration::whereHas('livestockInfo', function ($query) use ($request) {

            $query->where('farm_name', Auth::user()->farm_name);

            if ($request->filled('search')) {
                $search = $request->input('search');
                $query->where('given_name', 'LIKE', '%' . $search . '%');
            }
            if ($request->filled('breed')) {
                $breed = $request->input('breed');
                $query->where('breed', $breed);
            }
            if ($request->filled('sex')) {
                $sex = $request->input('sex');
                $query->where('sex', $sex);
            }
            if ($request->filled('status')) {
                $status = $request->input('status');
                if ($status == "Active") {
                    $query->whereNull('death_date')->whereNull('sold_date');
                } else if ($status == "Sold") {
                    $query->whereNull('death_date')->whereNotNull('sold_date');
                } else if ($status == "Dead") {
                    $query->whereNotNull('death_date')->whereNull('sold_date');
                }
            }
            if ($request->filled('date_from')) {
                $date_from = $request->input('date_from');
                $query->where('birth_date', '>', $date_from);
            }
            if ($request->filled('date_to')) {
                $date_to = $request->input('date_to');
                $query->where('birth_date', '<', $date_to);
            }
            if ($request->filled('date_from') && $request->filled('date_to')) {
                $from = $request->input('date_from');
                $to = $request->input('date_to');
                $query->whereBetween('birth_date', [$from, $to]);
            }
        })->orderBy('RFID_TAG', 'asc')->paginate(5);


        $breeds = LivestockInfo::query()
            ->select('breed')
            ->distinct()->get();

        $sex = LivestockInfo::query()
            ->select('sex')
            ->distinct()->get();

        if ($livestocks->isEmpty()) {
            $empty = true;
        } else {
            $empty = false;
        }

        return view('Livestock.my-herd', ['livestocks' => $livestocks, 'breeds' => $breeds, 'sex' => $sex, 'empty' => $empty]);
    }

    public function addHerd()
    {
        return view('Livestock.add-herd');
    }

    public function destroy(LivestockRegistration $herd)
    {

        $herd->delete();
        // dd($herd);
        return redirect('/herd')->with('message', 'Herd was successfully deleted!');
    }

    public function rfid()
    {
        return view('Livestock.rfid');
    }

    public function schedule()
    {
        $today = \Carbon\Carbon::now()->format('Y-m-d');

        $schedules = DB::table('schedule')
            ->select('schedule.event', 'schedule.date', 'schedule.SCHED_ID', 'schedule.RFID_TAG', 'livestock_info.given_name')
            ->join('livestock_reg', 'schedule.RFID_TAG', '=', 'livestock_reg.RFID_TAG')
            ->join('livestock_info', 'livestock_reg.IID', '=', 'livestock_info.IID')
            ->orderBy('schedule.date', 'ASC')
            ->where('schedule.status', 'unfinished')
            ->where('livestock_info.farm_name', Auth::user()->farm_name)
            ->get();

        $pastSchedules = DB::table('schedule')
            ->select('schedule.event', 'schedule.date', 'schedule.RFID_TAG', 'livestock_info.given_name')
            ->join('livestock_reg', 'schedule.RFID_TAG', '=', 'livestock_reg.RFID_TAG')
            ->join('livestock_info', 'livestock_reg.IID', '=', 'livestock_info.IID')
            ->orderBy('schedule.date', 'ASC')
            ->where('schedule.status', 'finish')
            ->where('livestock_info.farm_name', Auth::user()->farm_name)
            ->get();


        return view('Livestock.schedule')->with(compact('schedules', 'pastSchedules'));
    }

    public function store(HerdForm $request)
    {

        $validatedData = $request->validated();
        $filenameBirth = "";
        $filenameThird = "";

        // Livestock Info
        if ($request->hasFile('birth_image')) {
            $filenameBirth = $request->getSchemeAndHttpHost() . '/img/uploads/birth/' . $validatedData['info_given_name'] . '_' . time() . '.' . $request->birth_image->extension();

            $request->birth_image->move(public_path('/img/uploads/birth/'), $filenameBirth);
        }
        $info = [
            "given_name" => $validatedData['info_given_name'],
            "farm_name" => $validatedData['info_farm_name'],
            "sex" => $validatedData['info_sex'],
            "breed" => $validatedData['info_breed'],
            "birth_date" => $validatedData['birth_date'],
        ];
        if ($request->has('parents_checkbox')) {
            $info['dam'] = $validatedData['info_dam_id'];
            $info['sire'] = $validatedData['info_sire_id'];
        }
        $livestock = LivestockInfo::create($info);



        // Livestock Characteristic
        $characteristic = Characteristic::create([
            'jaw' => $validatedData['char_jaw'],
            'teat' => $validatedData['char_teat'],
            'ear' => $validatedData['char_ear_type'],
            'horn' => $validatedData['char_horn_type'],
            'body' => $validatedData['char_body_color'],

        ]);


        // Livestock Birth
        $birth = BirthInfo::create([
            'birth_date' => $validatedData['birth_date'],
            'birth_season' => $validatedData['birth_season'],
            'birth_type' => $validatedData['birth_type'],
            'milk_type' => $validatedData['birth_milk'],
            'birth_image' => $filenameBirth,

        ]);

        $livestockReg = LivestockRegistration::create([
            'RFID_TAG' => $validatedData['registration_number'],
            'IID' => $livestock->IID,
            'CID' => $characteristic->CID,
            'BID' => $birth->BID,

        ]);


        // Livestock Three Month Progress
        if (filled($request['body_weight']) || filled($request['body_length']) || filled($request['wither_height'])) {

            if ($request->hasFile('image')) {
                $filenameProgress = $request->getSchemeAndHttpHost() . '/img/uploads/progress/' . $validatedData['info_given_name'] . '_' . time() . '.' . $request->image->extension();

                $request->image->move(public_path('/img/uploads/progress/'), $filenameProgress);
            } else {
                $filenameProgress = NULL;
            }

            $progress = Progress::create([
                'weight' => $request['body_weight'],
                'length' => $request['body_length'],
                'wither' => $request['wither_height'],
                'date' => $request['date'],
                'RFID_TAG' => $validatedData['registration_number'],
                'image' => $filenameProgress,
            ]);
        }



        return redirect('/herd')->with(['message' => 'Added successfully']);
    }

    public function edit(Request $request)
    {
        $currentDate = \Carbon\Carbon::now()->toDateString();
        $livestock_id = $request->livestock_id;

        $livestocks = null;

        $sire = null;
        $sireGPSire = null;
        $sireGPDam = null;
        $sireGGPSire1 = null;
        $sireGGPDam1 = null;
        $sireGGPSire2 = null;
        $sireGGPDam2 = null;

        $dam =  null;
        $damGPSire = null;
        $damGPDam = null;
        $damGGPSire1 = null;
        $damGGPDam1 = null;
        $damGGPSire2 = null;
        $damGGPDam2 = null;
        $sireTag = null;
        $damTag = null;

        $livestocks = LivestockRegistration::query()
            ->with('livestockInfo', 'characteristic', 'birthInfo')
            ->where('RFID_TAG', '=', $livestock_id)
            ->first();
        if ($livestocks) {

            $sireTag = $livestocks->livestockInfo->sire;
            $damTag = $livestocks->livestockInfo->dam;


            $livestockQuery = LivestockRegistration::query()
                ->with('livestockInfo')
                ->get();

            $sire = $livestockQuery->where('RFID_TAG', $sireTag)->first();

            $dam = $livestockQuery->where('RFID_TAG', $damTag)->first();

            if ($sire) {
                $sireGPSire = $livestockQuery->where('RFID_TAG', $sire->livestockInfo->sire)->first();
                $sireGPDam = $livestockQuery->where('RFID_TAG', $sire->livestockInfo->dam)->first();

                if ($sireGPSire) {
                    $sireGGPSire1 = $livestockQuery->where('RFID_TAG', $sireGPSire->livestockInfo->sire)->first();
                    $sireGGPDam1 = $livestockQuery->where('RFID_TAG', $sireGPSire->livestockInfo->dam)->first();
                }

                if ($sireGPDam) {
                    $sireGGPSire2 = $livestockQuery->where('RFID_TAG', $sireGPDam->livestockInfo->sire)->first();
                    $sireGGPDam2 = $livestockQuery->where('RFID_TAG', $sireGPDam->livestockInfo->dam)->first();
                }
            }

            if ($dam) {
                $damGPSire = $livestockQuery->whereIn('RFID_TAG', $dam->livestockInfo->sire)->first();
                $damGPDam = $livestockQuery->whereIn('RFID_TAG', $dam->livestockInfo->dam)->first();

                if ($damGPSire) {
                    $damGGPSire1 = $livestockQuery->where('RFID_TAG', $damGPSire->livestockInfo->sire)->first();
                    $damGGPDam1 = $livestockQuery->where('RFID_TAG', $damGPSire->livestockInfo->dam)->first();
                }

                if ($damGPDam) {
                    $damGGPSire2 = $livestockQuery->where('RFID_TAG', $damGPDam->livestockInfo->sire)->first();
                    $damGGPDam2 = $livestockQuery->where('RFID_TAG', $damGPDam->livestockInfo->dam)->first();
                }
            }
        }


        $breedDetails = BreedDetails::query()
            ->whereIn('BID', function ($query) use ($livestock_id) {
                $query->select('BID')
                    ->from('breed_details')
                    ->where('sire_id', $livestock_id)
                    ->orWhere('dam_id', $livestock_id);
            })
            ->get();


        $breed = BreedRegistration::query()
            ->with('breedKidBirth', 'breedDetails')
            ->select('BID', DB::raw('GROUP_CONCAT(KID_ID) AS KID_IDs'))
            ->groupBy('BID')
            ->whereIn("BID",  $breedDetails->pluck('BID'))
            ->paginate(1, ['*'], 'breedPage');

        // dd($breedDetails);

        $milk = MilkRegistration::query()
            ->with('milkInfo', 'milkLactation', 'livestockRegistration')
            ->where('RFID_TAG', $livestock_id)
            ->where('milking_date', $currentDate)
            ->get();

        $forage = ForageRegistration::query()
            ->with('forageEst', 'forageInfo')
            ->where('RFID_TAG', $livestock_id)
            ->paginate(1, ['*'], 'foragePage');

        $progress = Progress::query()
            ->where('RFID_TAG', $livestock_id)
            ->orderBy('date', 'DESC')
            ->paginate(1, ['*'], 'progressPage');

        $dateFilter = Progress::query()
            ->where('RFID_TAG', $livestock_id)
            ->orderBy('date', 'DESC')
            ->get();

        $vaccinations = DB::table('schedule')
            ->join('livestock_reg', 'schedule.RFID_TAG', '=', 'livestock_reg.RFID_TAG')
            ->join('livestock_info', 'livestock_reg.IID', '=', 'livestock_info.IID')
            ->orderBy('schedule.date', 'DESC')
            ->where('schedule.RFID_TAG', $livestock_id)
            ->where('schedule.event', 'Vaccination')
            ->where('livestock_info.farm_name', Auth::user()->farm_name)
            ->get();

        $deworming = DB::table('schedule')
            ->join('livestock_reg', 'schedule.RFID_TAG', '=', 'livestock_reg.RFID_TAG')
            ->join('livestock_info', 'livestock_reg.IID', '=', 'livestock_info.IID')
            ->orderBy('schedule.date', 'DESC')
            ->where('schedule.RFID_TAG', $livestock_id)
            ->where('schedule.event', 'Deworming')
            ->where('livestock_info.farm_name', Auth::user()->farm_name)
            ->get();

        // dd($deworming);


        return view('Livestock.edit-herd')->with([
            'livestock' => $livestocks,
            'vaccinations' => $vaccinations,
            'deworming' => $deworming,
            'breed' => $breed,
            'milk' => $milk,
            'forage' => $forage,
            'progress' => $progress,
            'dateFilter' => $dateFilter,
            'sire' => $sire,
            'dam' => $dam,
            'sireGPSire' => $sireGPSire,
            'sireGPDam' => $sireGPDam,
            'damGPSire' => $damGPSire,
            'damGPDam' => $damGPDam,
            'sireGGPSire1' => $sireGGPSire1,
            'sireGGPDam1' => $sireGGPDam1,
            'sireGGPSire2' => $sireGGPSire2,
            'sireGGPDam2' => $sireGGPDam2,
            'damGGPSire1' => $damGGPSire1,
            'damGGPDam1' => $damGGPDam1,
            'damGGPSire2' => $damGGPSire2,
            'damGGPDam2' => $damGGPDam2,

        ]);
    }

    public function status(Request $request)
    {
        // dd($request->all());

        $idsToUpdate = $request->livestock_checkbox;

        $currentTime = Carbon::now();


        if ($request->status == "generatePDF") {

            $livestocks = LivestockRegistration::query()
                ->with('livestockInfo', 'characteristic', 'birthInfo')
                ->whereIn('IID', $idsToUpdate)
                ->get();

            $progress = Progress::all();

            // dd($progress);

            $pdfData = [
                'livestocks' => $livestocks->toArray(),
                'progress' => $progress->toArray(),
            ];


            $pdf = PDF::loadView('components.generate-pdf', $pdfData);

            return $pdf->stream();
        } else if ($request->status == "schedule") {

            $validated = $request->validate([
                'event' => 'required',
                'event_date' => 'required',
            ]);

            $livestocks = LivestockRegistration::query()
                ->select("RFID_TAG")
                ->whereIn('IID', $idsToUpdate)
                ->get();

            foreach ($livestocks as $livestock) {

                $schedule = ScheduleModel::create([
                    "event" => $validated['event'],
                    "date" => $validated['event_date'],
                    "RFID_TAG" => $livestock['RFID_TAG'],
                ]);
            }

            $msg = "Scheduled " . $validated['event'] . ' successfully';
        } else if ($request->status == "sold") {


            $validated = $request->validate([
                'buyer_name' => 'required',
                'buyer_address' => 'required',
                'buyer_contact' => 'required',
                'animal_weight' => 'required| min:1',
                'sold_date' => 'required',
                'animal_value' => 'required',
                'transaction_type' => 'required',
                'remarks' => 'required',

            ]);


            $livestocks = LivestockRegistration::query()
                ->with('livestockInfo')
                ->whereIn('IID', $idsToUpdate)
                ->get();

            foreach ($livestocks as $livestock) {
                $sex = $livestock->livestockInfo->sex;

                $sold = BuyerInfo::create([
                    "buyer_name" => $validated['buyer_name'],
                    "buyer_address" => $validated['buyer_address'],
                    "buyer_contact" => $validated['buyer_contact'],
                    "sold_date" => $validated['sold_date'],
                    "animal_value" => $validated['animal_value'],
                    "animal_weight" => $validated['animal_weight'],
                    "transaction_type" => $validated['transaction_type'],
                    "remarks" => $validated['remarks'],
                    "sex" => $sex,
                    "RFID_TAG" => $livestock['RFID_TAG'],
                ]);
            }

            foreach ($idsToUpdate as $id) {
                $item = LivestockInfo::find($id);

                if ($item) {
                    $item->sold_date = $currentTime;
                    $item->save();
                }
            }
            $msg = "Sold the goat successfully";
        } else if ($request->status == "dead") {

            foreach ($idsToUpdate as $id) {
                $item = LivestockInfo::find($id);

                if ($item) {
                    $item->death_date = $currentTime;
                    $item->save();
                }
            }
            $msg = "The goat is dead x_x";
        } else if ($request->status == "excel") {
            return Excel::download(new livestockExport($idsToUpdate), 'users.xlsx');
        }

        return redirect('/herd')->with(['message' => $msg]);
    }

    public function addBreed(BreedForm $request)
    {
        $index = array();

        $breedDetails = BreedDetails::create([
            'breed_type' => $request['breed_type'],
            'dam_id' => $request['dam_id'],
            'sire_id' => $request['sire_id'],
            'sire_breed_count' => $request['sire_breed_count'],
            'dam_breed_count' => $request['dam_breed_count'],
            'breed_date' => $request['breed_date'],
        ]);

        for ($i = 0; $i < count($request['birth_date']); $i++) {
            $breedKidBirth = BreedKidBirth::create([
                'kid_birth_date' => $request['birth_date'][$i],
                'kid_weight' => $request['birth_weight'][$i],
                'kid_length' => $request['birth_length'][$i],
            ]);

            $index[] = $breedKidBirth->KID_ID;
        }

        for ($i = 0; $i < count($index); $i++) {
            $breedReg = BreedRegistration::create([
                "BID" => $breedDetails->BID,
                "KID_ID" => $index[$i],
            ]);
        }

        return redirect()->back()->with(['message' => 'Added Breed successfully']);
    }

    public function editBreed(BreedForm $request)
    {

        $breedDetails = BreedDetails::find($request->breed_details_id);
        if ($breedDetails) {
            $breedDetails->breed_type = $request->breed_type;
            $breedDetails->dam_id = $request->dam_id;
            $breedDetails->sire_id = $request->sire_id;
            $breedDetails->dam_breed_count = $request->dam_breed_count;
            $breedDetails->sire_breed_count = $request->sire_breed_count;
            $breedDetails->breed_date = $request->breed_date;

            BreedRegistration::query()
                ->where('BID', $request->breed_details_id)
                ->update(['updated_at' => now()]);

            $breedDetails->save();
        }

        $breed = BreedRegistration::query()
            ->with('breedKidBirth', 'breedDetails')
            ->select('BID', DB::raw('GROUP_CONCAT(KID_ID) AS KID_IDs'))
            ->groupBy('BID')
            ->where("BID",  $request->breed_details_id)
            ->first();

        $originalIndex = explode(',', $breed->KID_IDs);
        $newIndex = $request->breed_kid_id;

        $diffOrig = array_diff($originalIndex, $newIndex);
        $diffNew = array_diff($newIndex, $originalIndex);

        $diffValOrig = array();
        $diffValNew = array();

        foreach ($diffOrig as $indexOrig) {
            $diffValOrig[] = $indexOrig;
        }

        foreach ($diffNew as $indexNew) {
            $diffValNew[] = $indexNew;
        }

        $temp = 0;

        // dd($diffValOrig);

        if ($originalIndex == $newIndex) {
            echo "Add";
            foreach ($newIndex as $index) {
                $breedKid = BreedKidBirth::find($index);
                if ($breedKid) {
                    $breedKid->kid_birth_date = $request->birth_date[$temp];
                    $breedKid->kid_weight = $request->birth_weight[$temp];
                    $breedKid->kid_length = $request->birth_length[$temp];

                    $temp++;
                    $breedKid->save();
                }
            }
        } else if (count($originalIndex) > count($newIndex)) {

            for ($i = 0; $i < count($request->breed_kid_id); $i++) {
                $breedKidUpdate = BreedKidBirth::find($request->breed_kid_id[$i]);
                $breedKidUpdate->kid_birth_date = $request->birth_date[$i];
                $breedKidUpdate->kid_weight = $request->birth_weight[$i];
                $breedKidUpdate->kid_length = $request->birth_length[$i];

                $breedKidUpdate->save();
            }


            foreach ($diffValOrig as $index) {
                $breedKid = BreedKidBirth::find($index);
                $breedKid->delete();
            }
        } else if (count($originalIndex) < count($newIndex)) {
            $upsertData = [];

            for ($i = 0; $i < count($request->breed_kid_id); $i++) {

                $upsertData[] = [
                    "KID_ID" => $request->breed_kid_id[$i],
                    "kid_birth_date" => $request->birth_date[$i],
                    "kid_weight" => $request->birth_weight[$i],
                    "kid_length" => $request->birth_length[$i]
                ];
            }

            $breedKid = BreedKidBirth::upsert($upsertData, ['KID_ID'], ['kid_birth_date', 'kid_weight', 'kid_length']);


            foreach ($diffValNew as $index) {
                $breedReg = BreedRegistration::create([
                    "BID" => $breedDetails->BID,
                    "KID_ID" => $index,
                ]);
            }
        }

        return redirect()->back()->with(['message' => 'Updated breed successfully']);
    }

    public function deleteBreed(Request $request, BreedDetails $breed)
    {


        $url = url()->previous();
        $find = "&breedPage=" . $request['page'];
        $replace = "";

        $newUrl = str_replace($find, $replace, $url);

        $breeds = BreedRegistration::query()
            ->with('breedKidBirth', 'breedDetails')
            ->select('BID', DB::raw('GROUP_CONCAT(KID_ID) AS KID_IDs'))
            ->groupBy('BID')
            ->where("BID",  $breed->BID)
            ->first();

        $kidIdsEdit = explode(',', $breeds->KID_IDs);

        $breedDetail = BreedDetails::find($breed->BID);
        $breedDetail->delete();

        foreach ($kidIdsEdit as $id) {
            $breedKid = BreedKidBirth::find($id);
            $breedKid->delete();
        }

        return redirect()->to($newUrl)->with(['message' => 'Deleted breed successfully']);
    }

    public function addMilk(MilkForm $request)
    {


        $milkingTime = $request['milking_time_hour'] . " hour " . $request['milking_time_minute'] . " minutes";
        // dd($milkingTime);

        $milkInfo = MilkInfo::create([
            'milk_yield' => $request['milk_yield'],
            'milking_time' => $milkingTime,
            'milk_temp' => $request['milking_temperature'],
            'milk_quality' => $request['milk_quality'],
            'milk_fat' => $request['milk_fat'],
            'milk_protein' => $request['milk_protein'],
            'milker_name' => $request['milker_name']
        ]);

        $milkLactation = MilkLactation::create([
            'lact_season' => $request['lact_season'],
            'lact_start' => $request['lact_start'],
            'lact_end' => $request['lact_end'],
            'lact_length' => $request['lact_length']
        ]);

        $milkReg = MilkRegistration::create([
            'RFID_TAG' => $request['RFID_TAG'],
            'MILK_MID' => $milkInfo->MILK_MID,
            'MILK_LID' => $milkLactation->MILK_LID,
            'milking_date' => Carbon::now(),

        ]);


        return redirect()->back()->with(['message' => 'Added Milk successfully']);
    }

    public function editMilk(MilkForm $request)
    {
        // dd($request->all());

        $milkingTime = $request['milking_time_hour'] . " hour " . $request['milking_time_minute'] . " minutes";

        $milkInfo = MilkInfo::find($request['MILK_MID']);
        if ($milkInfo) {
            //Update milk info table

            $milkInfo->milk_yield = $request['milk_yield'];
            $milkInfo->milking_time = $milkingTime;
            $milkInfo->milk_temp = $request['milking_temperature'];
            $milkInfo->milk_quality = $request['milk_quality'];
            $milkInfo->milk_fat = $request['milk_fat'];
            $milkInfo->milk_protein = $request['milk_protein'];
            $milkInfo->milker_name = $request['milker_name'];

            $milkInfo->save();
        }

        $milkLact = MilkLactation::find($request['MILK_LID']);
        if ($milkLact) {
            $milkLact->lact_season = $request['lact_season'];
            $milkLact->lact_start = $request['lact_start'];
            $milkLact->lact_end = $request['lact_end'];
            $milkLact->lact_length = $request['lact_length'];

            $milkLact->save();
        }

        return redirect()->back()->with(['message' => 'Updated Milk successfully']);
    }

    public function deleteMilk(Request $request)
    {

        $milkInfoID = $request['milkID'];
        $milkInfo = MilkInfo::query()
            ->where('MILK_MID', $milkInfoID)
            ->delete();

        return back()->with(['message' => 'Deleted milk successfully']);
    }

    public function addMilkToday(Request $request)
    {
        $currentDate = \Carbon\Carbon::now()->toDateString();

        $validated = $request->validate([
            'milk_yield' => ['required', 'min:0'],
            'milking_time_hour' => ['required', 'min:0', 'max:24'],
            'milking_time_minute' => ['required', 'min:1', 'max:60'],
            'milking_temperature' => ['required', 'min:0'],
            'milk_quality' => ['required'],
            'milk_fat' => ['required'],
            'milk_protein' => ['required'],
            'milker_name' => ['required'],
        ]);

        $milkingTime = $validated['milking_time_hour'] . " hour " . $validated['milking_time_minute'] . " minutes";

        $milkInfo = MilkInfo::create([
            'milk_yield' => $validated['milk_yield'],
            'milking_time' => $milkingTime,
            'milk_temp' => $validated['milking_temperature'],
            'milk_quality' => $validated['milk_quality'],
            'milk_fat' => $validated['milk_fat'],
            'milk_protein' => $validated['milk_protein'],
            'milker_name' => $validated['milker_name']
        ]);


        $lactationPeriod = MilkRegistration::query()
            ->where("RFID_TAG", $request->RFID_TAG)
            ->whereHas('milkLactation', function ($query) use ($currentDate) {
                $query->whereDate('lact_start', '<=', $currentDate)
                    ->whereDate('lact_end', '>=', $currentDate);
            })
            ->first();

        $milkReg = MilkRegistration::create([
            'RFID_TAG' => $request['RFID_TAG'],
            'MILK_MID' => $milkInfo->MILK_MID,
            'MILK_LID' => $lactationPeriod['MILK_LID'],
            'milking_date' => Carbon::now(),

        ]);

        return redirect()->back()->with(['message' => 'Added Milk successfully']);

        // dd($lactationPeriod['MILK_LID']);
    }

    public function herdEdit(EditHerdForm $request)
    {
        // dd($request);

        $filenameBirth = "";
        // Livestock Info
        if ($request->hasFile('birth_image')) {

            $oldImagePath = public_path(parse_url($request->old_image, PHP_URL_PATH));

            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            $filenameBirth = $request->getSchemeAndHttpHost() . '/img/uploads/birth/' . $request['info_given_name'] . '_' . time() . '.' . $request->birth_image->extension();

            $request->birth_image->move(public_path('/img/uploads/birth/'), $filenameBirth);
        }
        $livestockInfo = LivestockInfo::find($request['IID']);
        $characteristic = Characteristic::find($request['CID']);
        $birthInfo = BirthInfo::find($request['IID']);
        $livestockReg = LivestockRegistration::find($request['RFID_TAG']);

        // dd($livestockReg);

        if ($livestockInfo) {
            $livestockInfo->given_name = $request['info_given_name'];
            $livestockInfo->farm_name = $request['info_farm_name'];
            $livestockInfo->sex = $request['info_sex'];
            $livestockInfo->breed = $request['info_breed'];
            $livestockInfo->sire = $request['info_sire_id'];
            $livestockInfo->dam = $request['info_dam_id'];
            $livestockInfo->birth_date = $request['birth_date'];

            $livestockInfo->save();
        }

        if ($characteristic) {
            $characteristic->jaw = $request['jaw'];
            $characteristic->teat = $request['teat'];
            $characteristic->body = $request['body'];
            $characteristic->ear = $request['ear'];
            $characteristic->horn = $request['horn'];

            $characteristic->save();
        }

        if ($birthInfo) {
            $birthInfo->birth_date = $request['birth_date'];
            $birthInfo->birth_season = $request['birth_season'];
            $birthInfo->birth_type = $request['birth_type'];
            $birthInfo->milk_type = $request['milk_type'];
            if (!empty($filenameBirth)) {
                $birthInfo->birth_image = $filenameBirth;
            }

            $birthInfo->save();
        }

        if ($livestockReg) {
            $livestockReg->RFID_TAG  = $request['reg_num'];
            $livestockReg->save();
        }

        return redirect()->back()->with(['message' => 'Updated Herd successfully']);
    }

    public function progressEdit(Request $request)
    {


        $validatedData = $request->validate([
            "weight" => "required",
            "date" => "required",
            "length" => "required",
            "wither" => "required",

        ]);

        if ($request->hasFile('image')) {
            $filenameProgress = $request->getSchemeAndHttpHost() . '/img/uploads/progress/' . $request['info_given_name'] . '_' . time() . '.' . $request->image->extension();

            $request->image->move(public_path('/img/uploads/progress/'), $filenameProgress);

            $progress = Progress::query()
                ->where("PID", $request->PID)
                ->update([
                    "weight" => $validatedData['weight'],
                    "date" => $validatedData['date'],
                    "length" => $validatedData['length'],
                    "wither" => $validatedData['wither'],
                    "image" => $filenameProgress,
                ]);
        } else {

            $progress = Progress::query()
                ->where("PID", $request->PID)
                ->update([
                    "weight" => $validatedData['weight'],
                    "date" => $validatedData['date'],
                    "length" => $validatedData['length'],
                    "wither" => $validatedData['wither'],
                ]);
        }


        return redirect()->back()->with(['message' => 'Updated progress successfully']);
    }

    public function addEstablishment()
    {
        $currentTemp = 0;
        $api = env('OPEN_WEATHER_API');
        $lon =  env('OPEN_WEATHER_LON');
        $lat =  env('OPEN_WEATHER_LAT');

        $url = 'https://api.openweathermap.org/data/2.5/weather?lat=' . $lat . '&lon=' . $lon . '&appid=' . $api;

        $response = file_get_contents($url);

        if ($response) {
            $data = json_decode($response);

            $temp = $data->main->temp;
            $description = $data->weather[0]->description;

            $currentTemp = $temp - 273.15;

            $climateCondition = $description . " - " . $currentTemp . '°C';
        }


        return view("Livestock.add-forage-establishment")->with(['climateCondition' => $climateCondition]);
    }

    public function storeEstablishment(Request $request)
    {

        $validated = $request->validate([
            'est' => 'required',
            'est_status' => 'required',
            'soil_type' => 'required',
            'forage_type' => 'required',
            'climate_condition' => 'required',
            'date_planted' => 'required',
            'date_harvested' => 'required'
        ]);

        $forageEst = ForageEst::create([
            'est' => $validated['est'],
            'est_status' => $validated['est_status'],
            'soil_type' => $validated['soil_type'],
            'forage_type' => $validated['forage_type'],
            'climate_condition' => $validated['climate_condition'],
            'date_planted' => $validated['date_planted'],
            'date_harvested' => $validated['date_harvested'],
        ]);

        $message = 'Added';
        return response()->view('components.closeWindow', ['message' => $message]);
    }

    public function storeForage(Request $request)
    {

        $validated = $request->validate([
            'forage_establishment' => 'required',
            'dry_matter' => ['required', 'min:0', 'max:100'],
            'feed_intake' => ['required', 'min:0'],
            'duration_start' => 'required',
            'duration_end' => 'required',
            'RFID_TAG' => 'required',

        ]);

        $forageEst = ForageEst::find($validated['forage_establishment']);

        if ($forageEst) {
            $forageType = $forageEst->forage_type;
        }

        // dd($forageEst); 

        $forageInfo = ForageInfo::create([
            'forage_type' => $forageEst->forage_type,
            'dry_matter' => $validated['dry_matter'],
            'feed_intake' => $validated['feed_intake'],
            'duration_start' => $validated['duration_start'],
            'duration_end' => $validated['duration_end'],
        ]);

        $forageReg = ForageRegistration::create([
            'RFID_TAG' => $validated['RFID_TAG'],
            'FEED_ID' => $forageInfo->FEED_ID,
            'EST_ID' => $forageEst->EST_ID,
        ]);

        return redirect()->back()->with(['message' => 'Forage successfully added']);
    }

    public function deleteForage(Request $request)
    {

        // dd($request->all());

        $url = url()->previous();
        $find = "&foragePage=" . $request['page'];
        $replace = "";

        $newUrl = str_replace($find, $replace, $url);


        $forageReg = ForageRegistration::find($request->forage);

        // dd($newUrl);

        $forageInfo = ForageInfo::query()
            ->where('FEED_ID', $forageReg->FEED_ID)
            ->delete();

        $forageReg->delete();

        return redirect()->to($newUrl)->with(['message' => 'Deleted progress successfully']);
    }

    public function editForage(Request $request)
    {
        $validated = $request->validate([
            'forage_establishment' => 'required',
            'dry_matter' => ['required', 'min:0', 'max:100'],
            'feed_intake' => ['required', 'min:0'],
            'duration_start' => 'required',
            'duration_end' => 'required',
            'RFID_TAG' => 'required',

        ]);

        $forageEst = ForageEst::find($request->forage_establishment);
        $forageInfo = ForageInfo::find($request->FEED_ID);


        if ($forageInfo) {
            $forageInfo->forage_type = $forageEst->forage_type;
            $forageInfo->dry_matter =  $validated['dry_matter'];
            $forageInfo->feed_intake = $validated['feed_intake'];
            $forageInfo->duration_start = $validated['duration_start'];
            $forageInfo->duration_end = $validated['duration_end'];

            $forageInfo->save();
        }

        $forageReg = ForageRegistration::find($request->FID);

        if ($forageReg) {
            $forageReg->RFID_TAG = $validated['RFID_TAG'];
            $forageReg->FEED_ID = $forageInfo->FEED_ID;
            $forageReg->EST_ID = $request->forage_establishment;

            $forageReg->save();
        }

        return redirect()->back()->with(['message' => 'Forage successfully updated']);
    }

    public function editEstablishment(Request $request)
    {


        $forageEst = ForageEst::query()
            ->where('EST_ID', $request->input('forageEstId'))
            ->get();

        // dd($forageEst);

        return view('Livestock.edit-forage-establishment')->with(['forageEst' => $forageEst]);
    }

    public function updateEstablishment(Request $request)
    {
        // dd($request->all());

        $forageEst = ForageEst::find($request->EST_ID);

        if ($forageEst) {
            $forageEst->est = $request->est;
            $forageEst->est_status = $request->est_status;
            $forageEst->soil_type = $request->soil_type;
            $forageEst->forage_type = $request->forage_type;
            $forageEst->climate_condition = $request->climate_condition;
            $forageEst->date_planted = $request->date_planted;
            $forageEst->date_harvested = $request->date_harvested;

            $forageEst->save();
        }
        $message = 'Updated';
        return response()->view('components.closeWindow', ['message' => $message]);
    }

    public function deleteEstablishment(Request $request)
    {

        $forageEst = ForageEst::query()
            ->where('EST_ID', $request->EST_ID)
            ->delete();

        $message = 'Deleted';
        return response()->view('components.closeWindow', ['message' => $message]);
    }

    public function ajax(Request $request)
    {
        $rfid = $request['RFID_TAG'];
        $dateFilter = $request['dateFilter'];


        $milk = MilkRegistration::query()
            ->with('milkInfo', 'milkLactation', 'livestockRegistration')
            ->where('RFID_TAG', $rfid)
            ->where('milking_date', $dateFilter)
            ->get();

        return response()->json(['milk' => $milk]);
    }

    public function getDisease(Request $request)
    {
        $sched = ScheduleModel::where('SCHED_ID', $request->id)
            ->first();

        return response()->json(['sched' => $sched]);
    }

    public function updateDisease(Request $request)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'event' => 'required',
            'medicine' => 'required',
            'treatment' => 'required',
            'symptoms' => 'required',
            'weight' => 'required',
            'temperature' => 'required',
            'date' => 'required',
        ]);

        if (!ScheduleModel::where('SCHED_ID', $request->SCHED_ID)->update($validatedData)) {
            $msg = "There's a problem in updating the data, Please try again!";
        } else {
            $msg = "You've successfully updated a data!";
        }

        return redirect()->back()->with(['message' => $msg]);
    }

    public function milkAjax(Request $request)
    {
        list($year, $months) = explode('-', $request['month']);
        // dd($month);
        // $year = '2023';
        // $month = '09';

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
            ->whereYear('milk_reg.milking_date', $year)
            ->whereMonth('milk_reg.milking_date', $months)
            ->select('milk_reg.RFID_TAG', 'milk_info.milk_yield')
            ->get();



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


        // $milkPerMonth['total'] = $allMilkYield;
        // $milkPerMonth['goat'] = $milkTotals;

        // dd($milkPerMonth);

        return response()->json(['total_milk_yield' => $milkTotals, 'all_milk' => $allMilkYield]);
    }

    public function progressAjax(Request $request)
    {
        $RFID = $request->RFID_TAG;

        if ($request->action == "overview") {

            $progress = Progress::query()
                ->where('RFID_TAG', $RFID)
                ->whereIn('date', $request->dateFilterValue)
                ->get(); // Use 'get' to retrieve the results


            return response()->json(['progress' => $progress]);
        }

        if ($request->action == "graph") {

            if ($request->filter == "Monthly") {
                $year = $request->year; // Assuming the year is sent as a request parameter
                // dd($year);
                $data = Progress::whereYear('date', $year)
                    ->where('RFID_TAG', $RFID)
                    ->groupBy(DB::raw('YEAR(date)'), DB::raw('MONTH(date)'))
                    ->select(
                        DB::raw('YEAR(date) as year'),
                        DB::raw('MONTH(date) as month'),
                        DB::raw('AVG(weight) as avg_weight'),
                        DB::raw('AVG(length) as avg_length'),
                        DB::raw('AVG(wither) as avg_wither')
                    )
                    ->get();

                // dd($data);

                return response()->json(['success' => $data]);
            } else if ($request->filter == "Custom") {

                $selectedDateFrom = $request->dateFrom;
                $selectedDateTo = $request->dateTo;

                if ($selectedDateFrom != null && $selectedDateTo == null) {
                    $data = Progress::whereDate('date', '>=', $selectedDateFrom)
                        ->where('RFID_TAG', $RFID)
                        ->get();
                } else if ($selectedDateFrom == null && $selectedDateTo != null) {
                    $data = Progress::whereDate('date', '<=', $selectedDateTo)
                        ->where('RFID_TAG', $RFID)
                        ->get();
                } else {
                    $data = Progress::whereDate('date', '>=', $selectedDateFrom)
                        ->whereDate('date', '<=', $selectedDateTo)
                        ->where('RFID_TAG', $RFID)
                        ->get();
                }

                return response()->json(['success' => $data]);
            } else if ($request->filter == "Yearly") {

                $data = Progress::where('RFID_TAG', $RFID)
                    ->groupBy(DB::raw('YEAR(date)'))
                    ->select(
                        DB::raw('YEAR(date) as year'),
                        DB::raw('AVG(weight) as avg_weight'),
                        DB::raw('AVG(length) as avg_length'),
                        DB::raw('AVG(wither) as avg_wither')
                    )
                    ->get();

                return response()->json(['success' => $data]);
            }
        }
    }

    public function progressStore(Request $request)
    {

        $validatedData = $request->validate([
            "weight" => "required",
            "length" => "required",
            "wither" => "required",
            "date" => "required",
        ]);

        if ($request->hasFile('image')) {
            $filenameProgress = $request->getSchemeAndHttpHost() . '/img/uploads/progress/' . $request['info_given_name'] . '_' . time() . '.' . $request->image->extension();

            $request->image->move(public_path('/img/uploads/progress/'), $filenameProgress);
        } else {
            $filenameProgress = NULL;
        }

        $progress = Progress::create([
            'weight' => $validatedData['weight'],
            'length' => $validatedData['length'],
            'wither' => $validatedData['wither'],
            'date' => $validatedData['date'],
            'RFID_TAG' => $request['RFID_TAG'],
            'image' => $filenameProgress,
        ]);

        return redirect()->back()->with(['message' => 'Added successfully']);
    }

    public function generateReport(Request $request)
    {
        $livestock_id = $request->rfid_tag;

        $livestocks = LivestockRegistration::query()
            ->with('livestockInfo', 'characteristic', 'birthInfo')
            ->where('RFID_TAG', $livestock_id)
            ->get();

        $progress = Progress::all();

        // dd($progress);

        $pdfData = [
            'livestocks' => $livestocks->toArray(),
            'progress' => $progress->toArray(),
        ];


        $pdf = PDF::loadView('components.generate-pdf', $pdfData);

        return $pdf->stream();

        return $pdf->stream();
        // download PDF file with download method
        //   return $pdf->download('pdf_file.pdf');
    }

    public function showFinance()
    {

        $buyers = BuyerInfo::query()
            ->paginate(10, ['*'], 'financePage');

        $buyersCount = BuyerInfo::all()->count();

        $buyersSum = BuyerInfo::sum('animal_value');

        return view("Livestock.finance")->with(compact('buyers', 'buyersCount', 'buyersSum'));
    }

    public function showBatch()
    {

        $currentDate = Carbon::now();

        $livestocks = LivestockRegistration::query()
            ->with("livestockInfo", "characteristic", "birthInfo")
            ->whereHas('livestockInfo', function ($query) {
                $query->where('farm_name', Auth::user()->farm_name)
                    ->where('death_date', null)
                    ->where('sold_date', null);
            })->get();

        $forageEstablishments = ForageEst::query()
            ->get();

        // dd($forageEstablishments);

        $milks = MilkRegistration::query()
            ->with("milkInfo", "milkLactation")
            ->whereHas('milkLactation', function ($query) use ($currentDate) {
                $query->where('lact_start', '<=', $currentDate)
                    ->where('lact_end', '>=', $currentDate);
            })
            ->get();

        // dd($milks);

        $rfidMapping = [];
        $forageMapping = [];

        foreach ($livestocks as $livestock) {
            $rfidMapping[$livestock->RFID_TAG] = [
                'given_name' => $livestock->livestockInfo->given_name,
                'breed' => $livestock->livestockInfo->breed,
                'sex' => $livestock->livestockInfo->sex,
                'lact_season' => null,
                'lact_start' => null,
                'lact_end' => null,
                'lact_length' => null,
            ];
        }

        foreach ($forageEstablishments as $forageEstablishment) {
            $est = $forageEstablishment->est . " (" . $forageEstablishment->forage_type . ") ";

            $forageMapping[$est] = [
                'est_status' => $forageEstablishment->est_status,
                'soil_type' => $forageEstablishment->soil_type,
                'forage_type' => $forageEstablishment->forage_type,
                'climate_condition' => $forageEstablishment->climate_condition,
                'date_planted' => $forageEstablishment->date_planted,
                'date_harvested' => $forageEstablishment->date_harvested,
            ];
        }

        // dd($rfidMapping);

        foreach ($milks as $milk) {
            $rfidTag = $milk->RFID_TAG;

            if (isset($rfidMapping[$rfidTag])) {
                $rfidMapping[$rfidTag]['lact_season'] = $milk->milkLactation->lact_season;
                $rfidMapping[$rfidTag]['lact_start'] = $milk->milkLactation->lact_start;
                $rfidMapping[$rfidTag]['lact_end'] = $milk->milkLactation->lact_end;
                $rfidMapping[$rfidTag]['lact_length'] = $milk->milkLactation->lact_length;
            }
        }
        // dd($rfidMapping);
        return view("Livestock.batch-input")->with(['livestocks' => $rfidMapping, 'forage' => $forageMapping]);
    }

    public function batchWeightStore(Request $request)
    {
        if ($request->hasFile('image')) {
            $filenameProgress = $request->getSchemeAndHttpHost() . '/img/uploads/progress/' . $request['info_given_name'] . '_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('/img/uploads/progress/'), $filenameProgress);
        } else {
            $filenameProgress = null;
        }

        for ($i = 0; $i < count($request['RFID_TAG']); $i++) {
            Progress::create([
                'weight' => $request['weight'][$i],
                'length' => $request['length'][$i],
                'wither' => $request['wither'][$i],
                'date' => $request['date'][$i],
                'RFID_TAG' => $request['RFID_TAG'][$i],
                'image' => $filenameProgress,
            ]);
        }

        return redirect()->back()->with(['message' => 'Added weight successfully']);
    }

    public function batchMilkStore(Request $request)
    {
        // dd($request->all());

        for ($i = 0; $i < count($request['RFID_TAG']); $i++) {

            $milkLactation = MilkLactation::where('lact_season', $request['lact_season'][$i])
                ->where('lact_start', $request['lact_start'][$i])
                ->where('lact_end', $request['lact_end'][$i])
                ->where('lact_length', $request['lact_length'][$i])
                ->firstOrNew();

            if (!$milkLactation->exists) {
                // The record with the provided data does not exist, so set the values and save it
                $milkLactation->lact_season = $request['lact_season'][$i];
                $milkLactation->lact_start = $request['lact_start'][$i];
                $milkLactation->lact_end =  $request['lact_end'][$i];
                $milkLactation->lact_length = $request['lact_length'][$i];
                $milkLactation->save();
            }

            $milkingTime = $request['milking_time_hour'][$i] . " hour " . $request['milking_time_minute'][$i] . " minutes";

            $milkInfo = MilkInfo::create([
                'milk_yield' => $request['milking_yield'][$i],
                'milking_time' => $milkingTime,
                'milk_temp' => $request['milking_temp'][$i],
                'milk_quality' => $request['milk_quality'][$i],
                'milk_fat' => $request['milk_fat'][$i],
                'milk_protein' => $request['milk_protein'][$i],
                'milker_name' => $request['milker_name'][$i]
            ]);

            $milkReg = MilkRegistration::create([
                'RFID_TAG' => $request['RFID_TAG'][$i],
                'MILK_MID' => $milkInfo->MILK_MID,
                'MILK_LID' => $milkLactation['MILK_LID'],
                'milking_date' => $request['milking_date'][$i],

            ]);
        }


        return redirect()->back()->with(['message' => 'Added milk info successfully']);
    }

    public function batchForageStore(Request $request)
    {
        for ($i = 0; $i < count($request['RFID_TAG']); $i++) {

            $estValue = $request['est'][$i];

            // Split the value by parentheses
            $parts = explode('(', $estValue);

            $estName = trim($parts[0]);
            $forageType = trim(str_replace(')', '', $parts[1]));

            $forageEstablishment = ForageEst::query()
                ->where('est', $estName)
                ->where('forage_type', $forageType)
                ->first();

            // dd($forageEstablishment->forage_type);

            $forageInfo = ForageInfo::create([
                'forage_type' => $forageEstablishment->forage_type,
                'dry_matter' => $request['dry_matter'][$i],
                'feed_intake' => $request['feed_intake'][$i],
                'duration_start' => $request['duration_start'][$i],
                'duration_end' => $request['duration_end'][$i],
            ]);

            $forageReg = ForageRegistration::create([
                'RFID_TAG' => $request['RFID_TAG'][$i],
                'FEED_ID' => $forageInfo->FEED_ID,
                'EST_ID' => $forageEstablishment->EST_ID,
            ]);
        }

        return redirect()->back()->with(['message' => 'Added forage info successfully']);
    }

    public function batchBuyerStore(Request $request)
    {
        // dd($request->all());

        for ($i = 0; $i < count($request['RFID_TAG']); $i++) {
            $livestocks = LivestockRegistration::query()
                ->with('livestockInfo')
                ->where('RFID_TAG', $request['RFID_TAG'][$i])
                ->first();

            // dd($livestocks->IID);

            $sold = BuyerInfo::create([
                "buyer_name" => $request['buyer_name'][$i],
                "buyer_address" => $request['buyer_add'][$i],
                "buyer_contact" => $request['buyer_contact'][$i],
                "sold_date" => $request['sold_date'][$i],
                "animal_value" => $request['price'][$i],
                "animal_weight" => $request['weight'][$i],
                "transaction_type" => $request['transaction_type'][$i],
                "remarks" => $request['remarks'][$i],
                "sex" => $livestocks->livestockInfo->sex,
                "RFID_TAG" => $request['RFID_TAG'][$i],
            ]);

            $item = LivestockInfo::find($livestocks->IID);
            $item->sold_date = $request['sold_date'][$i];
            $item->save();
        }

        return redirect()->back()->with(['message' => 'Sold the goat successfully']);
    }

    public function batchHealthStore(Request $request)
    {
        // dd($request->all());

        for ($i = 0; $i < count($request['RFID_TAG']); $i++) {

            $schedule = ScheduleModel::create([
                'event' => $request['event'][$i],
                'medicine' => $request['medicine'][$i],
                'treatment' => $request['treatment'][$i],
                'symptoms' => $request['symptoms'][$i],
                'weight' => $request['weight'][$i],
                'temperature' => $request['temperature'][$i],
                'date' => $request['date'][$i],
                'RFID_TAG' => $request['RFID_TAG'][$i],
            ]);
        }

        return redirect()->back()->with(['message' => 'Set a schedule succesfully']);
    }

    public function batchDeathStore(Request $request)
    {
        // dd($request->all());
        for ($i = 0; $i < count($request['RFID_TAG']); $i++) {
            $dead = Dead::create([
                'RFID_TAG' => $request['RFID_TAG'][$i],
                'death_cause' => $request['death_cause'][$i],
                'death_date' => $request['death_date'][$i],
                'remarks' => $request['remarks'][$i],
            ]);

            $livestocks = LivestockRegistration::query()
                ->with('livestockInfo')
                ->where('RFID_TAG', $request['RFID_TAG'][$i])
                ->first();

            $item = LivestockInfo::find($livestocks->IID);
            $item->death_date = $request['death_date'][$i];
            $item->save();
        }

        return redirect()->back()->with(['message' => 'Data succesfully updated']);
    }

    public function RFIDAJAX()
    {

        // Get the list of files matching the pattern 'log_*.txt' in the directory
        $file_pattern = 'rfid/log_rfid.txt';

        // Open the file with a file handle
        $file_handle = fopen($file_pattern, 'r');

        if ($file_handle) {
            // Initialize an empty array for this file's RFID data
            $file_rfid_data = array();

            // Iterate through the lines and extract RFID lines
            while (($line = fgets($file_handle)) !== false) {
                if (strpos($line, "RFID: ") === 0) {
                    $parts = explode(" -> ", $line);
                    $rfid = trim(str_replace("RFID: ", "", $parts[0]));
                    $date_explode = explode("-", $parts[1]);
                    $date = trim($date_explode[1]);
                    $file_rfid_data[] = array("RFID" => $rfid, "date" => $date);
                }
            }

            // Close the file handle
            fclose($file_handle);

            // Store the RFID data for this file using its date as the key
            $rfid_data_by_file[$file_pattern] = $file_rfid_data;
        }

        return response()->json(['rfid_history' => $rfid_data_by_file]);
    }

    public function openApp()
    {

        $publicPath = public_path();

        // dd($publicPath);

        $exePath = '"' . $publicPath . '\RFID-Reader.exe"';
        // Replace with the actual path to your .exe file

        // dd($exePath);
        // Use exec function to run the executable
        $output = shell_exec($exePath . " 2>&1");
        if ($output) {
            // An error occurred
            return response()->json(['error' => $output]);
        } else {
            $msg = "FOO";
            return response()->json(['msg' => $msg]);
        }
    }

    public function updateSched(Request $request)
    {
        $sched = ScheduleModel::find($request->SCHED_ID);

        $sched->status = 'finish';
        $sched->save();
        return redirect()->back()->with(['message' => 'Activity was success!']);
    }
}
