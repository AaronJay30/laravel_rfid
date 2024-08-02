<?php

namespace App\Http\Controllers;

use App\Models\BreedDetails;
use App\Models\BreedRegistration;
use App\Models\ForageRegistration;
use App\Models\LivestockRegistration;
use App\Models\MilkRegistration;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\CSRFToken;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RFIDTagController extends Controller
{
    // public function show($tag)
    // {


    //     $livestocks = LivestockRegistration::query()
    //         ->with('livestockInfo', 'characteristic', 'birthInfo', 'nineMonth', 'sixMonth', 'threeMonth', 'oneYear')
    //         ->where('RFID_TAG', '=', $tag)
    //         ->first();

    //     // dd($livestocks);

    //     $livestock_id = $tag;

    //     $breedDetails = BreedDetails::query()
    //         ->whereIn('BID', function ($query) use ($livestock_id) {
    //             $query->select('BID')
    //                 ->from('breed_details')
    //                 ->where('sire_id', $livestock_id)
    //                 ->orWhere('dam_id', $livestock_id);
    //         })
    //         ->get();

    //     // dd($breedDetails);

    //     $breed = BreedRegistration::query()
    //         ->with('breedKidBirth', 'breedDetails')
    //         ->select('BID', DB::raw('GROUP_CONCAT(KID_ID) AS KID_IDs'))
    //         ->groupBy('BID')
    //         ->whereIn("BID",  $breedDetails->pluck('BID'))
    //         ->paginate(1, ['*'], 'breedPage');

    //     $milk = MilkRegistration::query()
    //         ->with('milkInfo', 'milkLactation', 'livestockRegistration')
    //         ->where('RFID_TAG', $livestock_id)
    //         ->paginate(1, ['*'], 'milkPage');

    //     $forage = ForageRegistration::query()
    //         ->with('forageEst', 'forageInfo')
    //         ->where('RFID_TAG', $livestock_id)
    //         ->paginate(1, ['*'], 'foragePage');

    //     return view('Livestock.edit-herd')->with(['livestock' => $livestocks, 'breed' => $breed, 'milk' => $milk, 'forage' => $forage]);
    // }

    public function show(Request $request)
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

    public function history()
    {

        // Initialize an empty array to store the RFID data
        $rfid_data_by_file = array();

        // Specify the directory where your log files are located
        $log_directory = 'logs/';

        // Get the list of files matching the pattern 'log_*.txt' in the directory
        $file_pattern = 'log_*.txt';
        $matching_files = glob($log_directory . $file_pattern);

        // Iterate through the matching files
        foreach ($matching_files as $file_path) {
            // Extract the date from the filename
            $file_name = basename($file_path);
            $file_name_date = substr($file_name, 4, 10); // Extract date from the filename

            // Open the file with a file handle
            $file_handle = fopen($file_path, 'r');

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
                $rfid_data_by_file[$file_name_date] = $file_rfid_data;
            }
        }

        return view('Livestock.rfid-history')->with(['rfid_history' => $rfid_data_by_file]);
    }

    public function test()
    {
        $RFID_TAG = request()->input('RFID_TAG'); // Retrieve the RFID_TAG from the request

        return view('sample')->with('RFID_TAG', $RFID_TAG);
    }
    // public function getCsrfToken()
    // {
    //     return response()->json(['csrf_token' => CSRFToken::getToken()]);
    // }
}
