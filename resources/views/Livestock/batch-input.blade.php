<meta name="csrf-token" content="{{ csrf_token() }}">


@include('partials.__header')
{{-- @include('partials.__loader') --}}

<x-sidebar/>

<style>
    body{
        background-color: #f4f4f4;
        font-family: 'Lato', sans-serif;
        min-height: 100vh;
        /* overflow-y: scroll; */
    }
    ::-webkit-scrollbar {
            width: 10px;
            height: 5px;
        }
        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px #FEFADF; 
            border-radius: 10px;
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #047F03; 
            border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #006300; 
        }

</style>

<div class="min-h-screen flex justify-center items-center ml-10 max-[800px]:ml-0">
    <div class="p-10 w-[80%] ml-20 max-[800px]:ml-0 max-[800px]:w-[90%] max-[500px]:w-full bg-white rounded-lg flex flex-col gap-y-4" style="box-shadow: 0px 4px 9px 5px rgba(0, 0, 0, 0.25);" x-data="{ activitySelect: $persist('') }">
        <div class="w-full rounded-lg" >
            <select id="activitySelect" class="w-full focus:ring-0 focus:border-green-600 border-t-2 border-b-2 border-l-0 border-r-0 border-green-600" x-model="activitySelect">
                <option value="" selected >Select an activity</option>
                <option value="Dead">Dead</option>
                <option value="Forage">Forage</option>
                <option value="Milking">Milking</option>
                <option value="Sell Goat">Sell Goat</option>
                <option value="Health">Vaccination/Deworming</option>
                <option value="Weight">Weight</option>
            </select>
        </div>
        <div class="py-4 w-full flex flex-col" x-show="activitySelect === 'Weight'">

            <div class="relative mb-4 w-full flex flex-row justify-end flex-wrap  items-center gap-x-4" x-data="{ rfidState: 'off' }">
                <button id="RFIDBTN" onclick="openReader()" class="py-2.5 px-4 bg-green-900 hover:bg-green-700 focus:ring-0 text-white rounded-2xl duration-200 flex flex-row justify-between items-center gap-x-4 text-md">
                    Open RFID Reader
                </button>
                <button id="RFIDBTN" onclick="StartRFIDWeight()" class="py-2.5 px-4 bg-green-900 hover:bg-green-700 focus:ring-0 text-white rounded-2xl duration-200 flex flex-row justify-between items-center gap-x-4 text-md">
                    Import Batch Scan
                </button>

            </div>

            <h1 class="text-3xl font-bold uppercase text-green-900 w-full border-b-2 border-green-900 text-center pb-2">Add Weight Progress</h1>
            <form action="{{route('livestock.batch.weight.store')}}" method="POST" class="relative px-4 my-4 w-full">
                @csrf
                <div class="overflow-x-auto w-full">
                    <table class="border-2 text-center text-md border-green-900 my-4">
                        <thead class="border-b-2 border-green-900 font-medium uppercase">
                            <tr>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    RFID TAG
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Goat's Name
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Breed
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Body Weight
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Body Length
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Wither Height
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Date
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="border-b-2 border-green-900 font-medium" id="tableBodyWeight">
                            <tr class="border-b-2 border-green-900" id="originalRowWeight">
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap flex flex-col" >
                                    <select name="RFID_TAG[]" id="RFID_SELECT" class="w-[200px] whitespace-nowrap border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900" value="">
                                        <option value="" selected  >SELECT RFID TAG</option>
                                        @foreach ($livestocks as $rfid => $livestockInfo)
                                            <option value="{{ $rfid }}">{{ $rfid }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <span id="given_name"></span>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <span id="breed"></span>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="number" name="weight[]" min="0" max="1000" step="0.01" class="w-full border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="number" name="length[]" min="0" max="1000" step="0.01" class="w-full border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="number" name="wither[]" min="0" max="1000" step="0.01" class="w-full border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="date" name="date[]" class="w-full border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <button class="rounded-xl text-md px-4 py-1.5 bg-red-900 text-white hover:bg-red-700 duration-100 flex flex-row items-center justify-between whitespace-nowrap gap-x-4 delete-row-btn" onclick="deleteTableRowWeight(this)">
                                        <i class='bx bx-trash'></i>
                                        Delete goat
                                    </button>
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                </div>
                <div class="w-full flex flex-row max-[500px]:flex-col max-[500px]:justify-center justify-end mt-4 gap-x-4 gap-y-2 flex-wrap">
                    <button class="rounded-xl text-md px-10 py-1.5 bg-green-900 text-white hover:bg-green-700 duration-100 flex flex-row items-center justify-between whitespace-nowrap gap-x-4" onclick="addTableRowWeight()" type="button">
                        <i class='bx bx-plus'></i>
                        Add goat
                    </button>
                    <button class="rounded-xl text-md px-10 py-1.5 bg-green-900 text-white hover:bg-green-700 duration-100 flex flex-row items-center justify-between whitespace-nowrap gap-x-4" type="submit">
                        <i class='bx bx-save' ></i>
                        Save
                    </button>
                </div>
            </form>
        </div>
        
        <div class="py-4 w-full flex flex-col" x-show="activitySelect === 'Milking'">
            <div class="relative mb-4 w-full flex flex-row justify-end flex-wrap  items-center gap-x-4" x-data="{ rfidState: 'off' }">
                <button id="RFIDBTN" onclick="openReader()" class="py-2.5 px-4 bg-green-900 hover:bg-green-700 focus:ring-0 text-white rounded-2xl duration-200 flex flex-row justify-between items-center gap-x-4 text-md">
                    Open RFID Reader
                </button>
                <button id="RFIDBTN" onclick="StartRFIDMilk()" class="py-2.5 px-4 bg-green-900 hover:bg-green-700 focus:ring-0 text-white rounded-2xl duration-200 flex flex-row justify-between items-center gap-x-4 text-md">
                    Import Batch Scan
                </button>

            </div>

            <h1 class="text-3xl font-bold uppercase text-green-900 w-full border-b-2 border-green-900 text-center pb-2">Add Milk Information</h1>
            <form action="{{route('livestock.batch.milk.store')}}" method="POST" class="relative px-4 my-4 w-full">
                @csrf
                <div class="overflow-x-auto w-full">
                    <table class="border-2 text-center text-md border-green-900 my-4">
                        <thead class="border-b-2 border-green-900 font-medium uppercase">
                            <tr>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    RFID TAG
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Goat's Name
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Breed
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Start of Lactation
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Milking Date
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Milker's Name
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Milking Yield
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Milking Time
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Milking Temp
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Milk Quality
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Milk Fat
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Milk Protein
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Lactation Season
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Lactation Lenght
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    End of Lactation
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="border-b-2 border-green-900 font-medium" id="tableBodyMilk">
                            <tr class="border-b-2 border-green-900" id="originalRowMilk">
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap flex flex-col" >
                                    <select name="RFID_TAG[]" id="RFID_SELECT" class="w-[200px] whitespace-nowrap border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900" value="">
                                        <option value="" selected  >SELECT RFID TAG</option>
                                        @foreach ($livestocks as $rfid => $livestockInfo)
                                            <option value="{{ $rfid }}">{{ $rfid }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <span id="given_name"></span>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <span id="breed"></span>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="date" name="lact_start[]" id="lact_start" class="w-full border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="date" name="milking_date[]" class="w-full border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="text" name="milker_name[]" placeholder="Enter milker's name" class="w-[200px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="number" name="milking_yield[]" min="0" max="999" step="0.01" placeholder="in kg" class="w-full border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap flex flex-row items-center gap-4">
                                    <input type="number" name="milking_time_hour[]" min="0" max="999" step="1" placeholder="Hour" class="w-[100px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                    <input type="number" name="milking_time_minute[]" min="0" max="999" step="1" placeholder="Minute" class="w-[100px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="number" name="milking_temp[]" min="0" max="100" step="0.01" placeholder="in celcius" class="w-[100px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="text" name="milk_quality[]" placeholder="Milk Quality" class="w-[150px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="text" name="milk_fat[]" placeholder="Milk Fat" class="w-[150px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="text" name="milk_protein[]" placeholder="Milk Protein" class="w-[150px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <select name="lact_season[]" value="" id="lact_season" class="w-[200px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                        <option value="" selected  >Select a season</option>
                                        <option value="Wet">Wet</option>
                                        <option value="Dry">Dry</option>
                                    </select>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="text" name="lact_length[]" id="lact_length" placeholder="Enter lactation length" class="w-[200px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="date" name="lact_end[]" id="lact_end" class="w-[200px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <button class="rounded-xl text-md px-4 py-1.5 bg-red-900 text-white hover:bg-red-700 duration-100 flex flex-row items-center justify-between whitespace-nowrap gap-x-4 delete-row-btn" onclick="deleteTableRowMilk(this)">
                                        <i class='bx bx-trash'></i>
                                        Delete goat
                                    </button>
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                </div>
                <div class="w-full flex flex-row max-[500px]:flex-col max-[500px]:justify-center justify-end mt-4 gap-x-4 gap-y-2 flex-wrap">
                    <button class="rounded-xl text-md px-10 py-1.5 bg-green-900 text-white hover:bg-green-700 duration-100 flex flex-row items-center justify-between whitespace-nowrap gap-x-4" onclick="addTableRowMilk()" type="button">
                        <i class='bx bx-plus'></i>
                        Add goat
                    </button>
                    <button class="rounded-xl text-md px-10 py-1.5 bg-green-900 text-white hover:bg-green-700 duration-100 flex flex-row items-center justify-between whitespace-nowrap gap-x-4" type="submit">
                        <i class='bx bx-save' ></i>
                        Save
                    </button>
                </div>
            </form>
        </div>

        <div class="py-4 w-full flex flex-col" x-show="activitySelect === 'Forage'">
            <div class="relative mb-4 w-full flex flex-row justify-end flex-wrap  items-center gap-x-4" x-data="{ rfidState: 'off' }">
                <a href="{{route('add.forage.establishment')}}" target="_blank">
                    <button class="py-2.5 px-4 bg-green-900 hover:bg-green-700 focus:ring-0 text-white rounded-2xl duration-200 flex flex-row justify-between items-center gap-x-4 text-md">
                        <i class='bx bx-plus'></i>
                        Add Forage Establishment
                    </button>
                </a>
                <button id="RFIDBTN" onclick="openReader()" class="py-2.5 px-4 bg-green-900 hover:bg-green-700 focus:ring-0 text-white rounded-2xl duration-200 flex flex-row justify-between items-center gap-x-4 text-md">
                    Open RFID Reader
                </button>
                <button id="RFIDBTN" onclick="StartRFIDForage()" class="py-2.5 px-4 bg-green-900 hover:bg-green-700 focus:ring-0 text-white rounded-2xl duration-200 flex flex-row justify-between items-center gap-x-4 text-md">
                    Import Batch Scan
                </button>
                {{-- <button x-show="rfidState === 'on'" onclick="StartRFID()" @click="rfidState = 'off'" class="py-2.5 px-4 bg-red-900 hover:bg-red-700 focus:ring-0 text-white rounded-2xl duration-200 flex flex-row justify-between items-center gap-x-4 text-md">
                    Stop RFID Reader
                </button> --}}
            </div>
            
            <h1 class="text-3xl font-bold uppercase text-green-900 w-full border-b-2 border-green-900 text-center pb-2">Add Forage Information</h1>
            <form action="{{route('livestock.batch.forage.store')}}" method="POST" class="relative px-4 my-4 w-full">
                @csrf
                <div class="overflow-x-auto w-full">
                    <table class="border-2 text-center text-md border-green-900 my-4">
                        <thead class="border-b-2 border-green-900 font-medium uppercase">
                            <tr>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    RFID TAG
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Goat's Name
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Breed
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Establishment
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Dry Matter
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Feed Intake
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Duration Start
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Duration End
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Establishment Status
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Soil Type
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Forage  Type
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Climate Condition
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Date Planted
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Date Harvested
                                </th>
                                
                                
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="border-b-2 border-green-900 font-medium" id="tableBodyForage">
                            <tr class="border-b-2 border-green-900" id="originalRowForage">
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap flex flex-col" >
                                    <select name="RFID_TAG[]" id="RFID_SELECT" class="w-[200px] whitespace-nowrap border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900" value="">
                                        <option value="" selected disabled>SELECT RFID TAG</option>
                                        @foreach ($livestocks as $rfid => $livestockInfo)
                                            <option value="{{ $rfid }}">{{ $rfid }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <span id="given_name"></span>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <span id="breed"></span>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <select name="est[]" id="est_select" class="w-[200px] whitespace-nowrap border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900" value="">
                                        <option value="" selected disabled>SELECT ESTABLISHMENT</option>
                                        @foreach ($forage as $est => $forageEst)
                                            <option value="{{ $est }}">{{ $est }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="number" name="dry_matter[]" min="0" max="100" step="0.01" placeholder="in percentage" class="w-[150px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="number" name="feed_intake[]" min="0" max="1000" step="0.01"  placeholder="in kilogram" class="w-[150px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="date" name="duration_start[]" class="w-[150px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="date" name="duration_end[]" class="w-[150px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <span id="est_status"></span>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <span id="soil_type"></span>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <span id="forage_type"></span>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <span id="climate_condition"></span>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <span id="date_planted"></span>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <span id="date_harvested"></span>
                                </td>
                                
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <button class="rounded-xl text-md px-4 py-1.5 bg-red-900 text-white hover:bg-red-700 duration-100 flex flex-row items-center justify-between whitespace-nowrap gap-x-4 delete-row-btn" onclick="deleteTableRowForage(this)">
                                        <i class='bx bx-trash'></i>
                                        Delete goat
                                    </button>
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                </div>
                <div class="w-full flex flex-row max-[500px]:flex-col max-[500px]:justify-center justify-end mt-4 gap-x-4 gap-y-2 flex-wrap">
                    <button class="rounded-xl text-md px-10 py-1.5 bg-green-900 text-white hover:bg-green-700 duration-100 flex flex-row items-center justify-between whitespace-nowrap gap-x-4" onclick="addTableRowForage()" type="button">
                        <i class='bx bx-plus'></i>
                        Add goat
                    </button>
                    <button class="rounded-xl text-md px-10 py-1.5 bg-green-900 text-white hover:bg-green-700 duration-100 flex flex-row items-center justify-between whitespace-nowrap gap-x-4" type="submit">
                        <i class='bx bx-save' ></i>
                        Save
                    </button>
                </div>
            </form>
        </div>

        <div class="py-4 w-full flex flex-col" x-show="activitySelect === 'Sell Goat'">
            <h1 class="text-3xl font-bold uppercase text-green-900 w-full border-b-2 border-green-900 text-center pb-2">Sell goat information</h1>
            <form action="{{route('livestock.batch.buyer.store')}}" method="POST" class="relative px-4 my-4 w-full">
                @csrf
                <div class="overflow-x-auto w-full">
                    <table class="border-2 text-center text-md border-green-900 my-4">
                        <thead class="border-b-2 border-green-900 font-medium uppercase">
                            <tr>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    RFID TAG
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Goat's Name
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Breed
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Gender
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Animal Weight
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Selling Price
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Buyer's Name
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Buyer's Address
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Buyer's Contact
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Sold Date
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Transaction Type
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Remarks
                                </th>
                                
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="border-b-2 border-green-900 font-medium" id="tableBodySell">
                            <tr class="border-b-2 border-green-900" id="originalRowSell">
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap flex flex-col" >
                                    <select name="RFID_TAG[]" id="RFID_SELECT" class="w-[200px] whitespace-nowrap border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900" value="">
                                        <option value="" selected disabled>SELECT RFID TAG</option>
                                        @foreach ($livestocks as $rfid => $livestockInfo)
                                            <option value="{{ $rfid }}">{{ $rfid }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <span id="given_name"></span>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <span id="breed"></span>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <span id="sex"></span>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="number" name="weight[]" min="0" max="1000" placeholder="in kilogram" step="0.01" class="w-[150px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    ₱<input type="number" name="price[]" min="0" step="0.01" placeholder="₱0.00" class="w-[150px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="text" name="buyer_name[]" placeholder="Enter name" class="w-[150px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="text" name="buyer_add[]" placeholder="Enter address" class="w-[150px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="text" name="buyer_contact[]" placeholder="Enter contact" class="w-[150px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="date" name="sold_date[]" class="w-[150px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <select name="transaction_type[]" value="" class="w-[200px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900"> 
                                        <option value="" selected disabled>Select a transaction type</option>
                                        <option value="Cash" >Cash</option>
                                        <option value="Digital Bank" >Digital Bank</option>
                                        <option value="Bank Transfer" >Bank Transfer</option>

                                    </select>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="text" name="remarks[]" placeholder="Enter remarks" class="w-[200px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <button class="rounded-xl text-md px-4 py-1.5 bg-red-900 text-white hover:bg-red-700 duration-100 flex flex-row items-center justify-between whitespace-nowrap gap-x-4 delete-row-btn" onclick="deleteTableRowSell(this)">
                                        <i class='bx bx-trash'></i>
                                        Delete goat
                                    </button>
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                </div>
                <div class="w-full flex flex-row max-[500px]:flex-col max-[500px]:justify-center justify-end mt-4 gap-x-4 gap-y-2 flex-wrap">
                    <button class="rounded-xl text-md px-10 py-1.5 bg-green-900 text-white hover:bg-green-700 duration-100 flex flex-row items-center justify-between whitespace-nowrap gap-x-4" onclick="addTableRowSell()" type="button">
                        <i class='bx bx-plus'></i>
                        Add goat
                    </button>
                    <button class="rounded-xl text-md px-10 py-1.5 bg-green-900 text-white hover:bg-green-700 duration-100 flex flex-row items-center justify-between whitespace-nowrap gap-x-4" type="submit">
                        <i class='bx bx-save' ></i>
                        Save
                    </button>
                </div>
            </form>
        </div>

        <div class="py-4 w-full flex flex-col" x-show="activitySelect === 'Health'">

            <div class="relative mb-4 w-full flex flex-row justify-end flex-wrap  items-center gap-x-4" x-data="{ rfidState: 'off' }">
                <button id="RFIDBTN" onclick="openReader()" class="py-2.5 px-4 bg-green-900 hover:bg-green-700 focus:ring-0 text-white rounded-2xl duration-200 flex flex-row justify-between items-center gap-x-4 text-md">
                    Open RFID Reader
                </button>
                <button id="RFIDBTN" onclick="StartRFIDVaccination()" class="py-2.5 px-4 bg-green-900 hover:bg-green-700 focus:ring-0 text-white rounded-2xl duration-200 flex flex-row justify-between items-center gap-x-4 text-md">
                    Import Batch Scan
                </button>

            </div>
            <h1 class="text-3xl font-bold uppercase text-green-900 w-full border-b-2 border-green-900 text-center pb-2">Schedule an activity</h1>
            <form action="{{route('livestock.batch.health.store')}}" method="POST" class="relative px-4 my-4 w-full">
                @csrf
                <div class="overflow-x-auto w-full">
                    <table class="border-2 text-center text-md border-green-900 my-4">
                        <thead class="border-b-2 border-green-900 font-medium uppercase">
                            <tr>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    RFID TAG
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Goat's Name
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Breed
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Activity
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Scheduled Date
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Type of Medicine
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Symptoms
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Type of Treatment
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Weight
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Temperature
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="border-b-2 border-green-900 font-medium" id="tableBodySchedule">
                            <tr class="border-b-2 border-green-900" id="originalRowSchedule">
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap flex flex-col" >
                                    <select name="RFID_TAG[]" id="RFID_SELECT" class="w-[200px] whitespace-nowrap border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900" value="">
                                        <option value="" selected disabled>SELECT RFID TAG</option>
                                        @foreach ($livestocks as $rfid => $livestockInfo)
                                            <option value="{{ $rfid }}">{{ $rfid }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <span id="given_name"></span>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <span id="breed"></span>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <select name="event[]" class="w-[200px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900"> 
                                        <option value="" selected disabled>Select activity</option>
                                        <option value="Vaccination">Vaccination</option>
                                        <option value="Deworming">Deworming</option>
                                    </select>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="date" name="date[]" class="w-full border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="text" name="medicine[]" placeholder="Enter medicine" class="w-[200px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="text" name="symptoms[]" placeholder="Enter symptoms" class="w-[200px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="text" name="treatment[]" placeholder="Enter treatment" class="w-[200px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="number" name="weight[]" min="0" max="999" step="0.01" placeholder="in kilogram" class="w-[150px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="number" name="temperature[]" min="0" max="999" step="0.01" placeholder="in celsius" class="w-[150px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <button class="rounded-xl text-md px-4 py-1.5 bg-red-900 text-white hover:bg-red-700 duration-100 flex flex-row items-center justify-between whitespace-nowrap gap-x-4 delete-row-btn" onclick="deleteTableRowSchedule(this)">
                                        <i class='bx bx-trash'></i>
                                        Delete goat
                                    </button>
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                </div>
                <div class="w-full flex flex-row max-[500px]:flex-col max-[500px]:justify-center justify-end mt-4 gap-x-4 gap-y-2 flex-wrap">
                    <button class="rounded-xl text-md px-10 py-1.5 bg-green-900 text-white hover:bg-green-700 duration-100 flex flex-row items-center justify-between whitespace-nowrap gap-x-4" onclick="addTableRowSchedule()" type="button">
                        <i class='bx bx-plus'></i>
                        Add goat
                    </button>
                    <button class="rounded-xl text-md px-10 py-1.5 bg-green-900 text-white hover:bg-green-700 duration-100 flex flex-row items-center justify-between whitespace-nowrap gap-x-4" type="submit">
                        <i class='bx bx-save' ></i>
                        Save
                    </button>
                </div>
            </form>
        </div>

        <div class="py-4 w-full flex flex-col" x-show="activitySelect === 'Dead'">
            <h1 class="text-3xl font-bold uppercase text-green-900 w-full border-b-2 border-green-900 text-center pb-2">Add Dead Goat</h1>
            <form action="{{route('livestock.batch.death.store')}}" method="POST" class="relative px-4 my-4 w-full">
                @csrf
                <div class="overflow-x-auto w-full">
                    <table class="border-2 text-center text-md border-green-900 my-4">
                        <thead class="border-b-2 border-green-900 font-medium uppercase">
                            <tr>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    RFID TAG
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Goat's Name
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Breed
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Date of Death
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Cause of Death
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Remarks
                                </th>
                                <th scope="col" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="border-b-2 border-green-900 font-medium" id="tableBodyWeight">
                            <tr class="border-b-2 border-green-900" id="originalRowWeight">
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap flex flex-col" >
                                    <select name="RFID_TAG[]" id="RFID_SELECT" class="w-[200px] whitespace-nowrap border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900" value="">
                                        <option value="" selected disabled>SELECT RFID TAG</option>
                                        @foreach ($livestocks as $rfid => $livestockInfo)
                                            <option value="{{ $rfid }}">{{ $rfid }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <span id="given_name"></span>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <span id="breed"></span>
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="date" name="death_date[]" class="w-[200px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="text" name="death_cause[]" class="w-[200px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <input type="text" name="remarks[]" class="w-[300px] border-x-0 border-t-0 border-b-2 border-green-900 focus:ring-0 focus:border-green-900">
                                </td>
                                <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap">
                                    <button class="rounded-xl text-md px-4 py-1.5 bg-red-900 text-white hover:bg-red-700 duration-100 flex flex-row items-center justify-between whitespace-nowrap gap-x-4 delete-row-btn" onclick="deleteTableRowWeight(this)">
                                        <i class='bx bx-trash'></i>
                                        Delete goat
                                    </button>
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                </div>
                <div class="w-full flex flex-row max-[500px]:flex-col max-[500px]:justify-center justify-end mt-4 gap-x-4 gap-y-2 flex-wrap">
                    <button class="rounded-xl text-md px-10 py-1.5 bg-green-900 text-white hover:bg-green-700 duration-100 flex flex-row items-center justify-between whitespace-nowrap gap-x-4" onclick="addTableRowWeight()" type="button">
                        <i class='bx bx-plus'></i>
                        Add goat
                    </button>
                    <button class="rounded-xl text-md px-10 py-1.5 bg-green-900 text-white hover:bg-green-700 duration-100 flex flex-row items-center justify-between whitespace-nowrap gap-x-4" type="submit">
                        <i class='bx bx-save' ></i>
                        Save
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>

    document.addEventListener("DOMContentLoaded", (event) => {
        reload();
    });
    // Define the RFID mapping (assuming it's in JSON format)
    const rfidMapping = @json($livestocks);
    const forageMapping = @json($forage);

    // console.log(rfidMapping);
    // console.log(forageMapping);

    // Function to update given_name and breed based on the selected RFID tag
    function updateLivestockInfo(event) {
        const selectElement = event.target;
        const givenNameElement = selectElement.closest('tr').querySelector('#given_name');
        const breedElement = selectElement.closest('tr').querySelector('#breed');
        const sex = selectElement.closest('tr').querySelector('#sex');
        const LactSeason = selectElement.closest('tr').querySelector('#lact_season');
        const LactStart = selectElement.closest('tr').querySelector('#lact_start');
        const LactEnd = selectElement.closest('tr').querySelector('#lact_end');
        const LactLength = selectElement.closest('tr').querySelector('#lact_length');


        
        const selectedRFID = selectElement.value;
        if (rfidMapping[selectedRFID]) {
            givenNameElement.textContent = rfidMapping[selectedRFID].given_name;
            breedElement.textContent = rfidMapping[selectedRFID].breed;

            
            sex.textContent = rfidMapping[selectedRFID].sex == null ? "" : rfidMapping[selectedRFID].sex;

            LactSeason.value = rfidMapping[selectedRFID].lact_season == null ? "" : rfidMapping[selectedRFID].lact_season;
            LactStart.value = rfidMapping[selectedRFID].lact_start == null ? "" : rfidMapping[selectedRFID].lact_start;
            LactEnd.value = rfidMapping[selectedRFID].lact_end == null ? "" : rfidMapping[selectedRFID].lact_end;
            LactLength.value = rfidMapping[selectedRFID].lact_length == null ? "" : rfidMapping[selectedRFID].lact_length;
        }
    }

    function updateLivestockInfoAjax(event) {
        const selectElement = event.target;
        const givenNameElement = selectElement.closest('tr').querySelector('#given_name');
        const breedElement = selectElement.closest('tr').querySelector('#breed');
        const sex = selectElement.closest('tr').querySelector('#sex');
        const LactSeason = selectElement.closest('tr').querySelector('#lact_season');
        const LactStart = selectElement.closest('tr').querySelector('#lact_start');
        const LactEnd = selectElement.closest('tr').querySelector('#lact_end');
        const LactLength = selectElement.closest('tr').querySelector('#lact_length');


        
        const selectedRFID = selectElement.value;
        if (rfidMapping[selectedRFID]) {
            givenNameElement.textContent = rfidMapping[selectedRFID].given_name;
            breedElement.textContent = rfidMapping[selectedRFID].breed;
        }
    }

    function updateForageEstablishment(event) {
        const selectElement = event.target;
        const est_status = selectElement.closest('tr').querySelector('#est_status');
        const soil_type = selectElement.closest('tr').querySelector('#soil_type');
        const forage_type = selectElement.closest('tr').querySelector('#forage_type');
        const climate_condition = selectElement.closest('tr').querySelector('#climate_condition');
        const date_planted = selectElement.closest('tr').querySelector('#date_planted');
        const date_harvested = selectElement.closest('tr').querySelector('#date_harvested');


        const selectedEST = selectElement.value;
        if (forageMapping[selectedEST]) {
            est_status.textContent = forageMapping[selectedEST].est_status;
            soil_type.textContent = forageMapping[selectedEST].soil_type;
            forage_type.textContent = forageMapping[selectedEST].forage_type;
            climate_condition.textContent = forageMapping[selectedEST].climate_condition;
            date_planted.textContent = dateFormat(forageMapping[selectedEST].date_planted);
            date_harvested.textContent = dateFormat(forageMapping[selectedEST].date_harvested);
        }

    }

    function dateFormat(inputDate){
        const options = { year: 'numeric', month: 'long', day: '2-digit' };
        const formattedDate = new Date(inputDate).toLocaleDateString('en-US', options);

        // Update the date_harvested element with the formatted date
        return formattedDate;
    }
    // Attach the onchange event handler to all select elements with the 'RFID_SELECT' class
    
    function reload() {
        selectElementsRFID = document.querySelectorAll('#RFID_SELECT');
        selectElementsRFID.forEach(selectElement => {
            selectElement.addEventListener('change', updateLivestockInfo);
            // console.log('1');
        });

        selectElementsEST = document.querySelectorAll('#est_select');
        selectElementsEST.forEach(selectElement => {
            selectElement.addEventListener('change', updateForageEstablishment);
            // console.log('2');
        });

    }



</script>

<script>
    function addTableRowWeight() {
        
        const originalRow = document.getElementById("originalRowWeight");
        const tableBody = document.getElementById("tableBodyWeight");
        const newRow = originalRow.cloneNode(true); // Clone the original row


        // Clear the select and input fields in the new row
        const selectElement = newRow.querySelectorAll("select");
        const inputElements = newRow.querySelectorAll("input");

        selectElement.value = "";
        inputElements.forEach(input => {
            input.value = "";
        });

        // Append the new row to the table
        tableBody.appendChild(newRow);

        reload();
    }
    function deleteTableRowWeight(button) {
        const tableBody = document.getElementById("tableBodyWeight");
        const rowToDelete = button.closest("tr");
        tableBody.removeChild(rowToDelete);
    }

    function addTableRowMilk() {
        
        const originalRow = document.getElementById("originalRowMilk");
        const tableBody = document.getElementById("tableBodyMilk");
        const newRow = originalRow.cloneNode(true); // Clone the original row


        // Clear the select and input fields in the new row
        const selectElement = newRow.querySelectorAll("select");
        const inputElements = newRow.querySelectorAll("input");

        selectElement.value = "";
        inputElements.forEach(input => {
            input.value = "";
        });

        // Append the new row to the table
        tableBody.appendChild(newRow);

        reload();
    }
    function deleteTableRowMilk(button) {
        const tableBody = document.getElementById("tableBodyMilk");
        const rowToDelete = button.closest("tr");
        tableBody.removeChild(rowToDelete);
    }

    function addTableRowForage() {
        
        const originalRow = document.getElementById("originalRowForage");
        const tableBody = document.getElementById("tableBodyForage");
        const newRow = originalRow.cloneNode(true); // Clone the original row


        // Clear the select and input fields in the new row
        const selectElement = newRow.querySelectorAll("select");
        const inputElements = newRow.querySelectorAll("input");

        selectElement.value = "";
        inputElements.forEach(input => {
            input.value = "";
        });

        // Append the new row to the table
        tableBody.appendChild(newRow);

        reload();
    }
    function deleteTableRowForage(button) {
        const tableBody = document.getElementById("tableBodyForage");
        const rowToDelete = button.closest("tr");
        tableBody.removeChild(rowToDelete);
    }

    function addTableRowSell() {
        
        const originalRow = document.getElementById("originalRowSell");
        const tableBody = document.getElementById("tableBodySell");
        const newRow = originalRow.cloneNode(true); // Clone the original row


        // Clear the select and input fields in the new row
        const selectElement = newRow.querySelectorAll("select");
        const inputElements = newRow.querySelectorAll("input");

        selectElement.value = "";
        inputElements.forEach(input => {
            input.value = "";
        });

        // Append the new row to the table
        tableBody.appendChild(newRow);

        reload();
    }
    function deleteTableRowSell(button) {
        const tableBody = document.getElementById("tableBodySell");
        const rowToDelete = button.closest("tr");
        tableBody.removeChild(rowToDelete);
    }

    function addTableRowSchedule() {
        
        const originalRow = document.getElementById("originalRowSchedule");
        const tableBody = document.getElementById("tableBodySchedule");
        const newRow = originalRow.cloneNode(true); // Clone the original row


        // Clear the select and input fields in the new row
        const selectElement = newRow.querySelectorAll("select");
        const inputElements = newRow.querySelectorAll("input");

        selectElement.value = "";
        inputElements.forEach(input => {
            input.value = "";
        });

        // Append the new row to the table
        tableBody.appendChild(newRow);

        reload();
    }
    function deleteTableRowSchedule(button) {
        const tableBody = document.getElementById("tableBodySchedule");
        const rowToDelete = button.closest("tr");
        tableBody.removeChild(rowToDelete);
    }

    function StartRFIDForage() {
        $.ajax({
            url: '/RFID-AJAX',
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {},
            success: function (result) {

                var datas = result.rfid_history['rfid/log_rfid.txt'];

                var uniqueRFIDs = []; // Array to store unique RFID values

                for (var i = 0; i < datas.length; i++) {
                    const currentRFID = datas[i]['RFID'];

                    // Check if the RFID is already in the array
                    if (uniqueRFIDs.includes(currentRFID)) {
                        // Skip this iteration if the RFID is repeated
                        continue;
                    }

                    // Add the current RFID to the array
                    uniqueRFIDs.push(currentRFID);

                    // The rest of your existing code
                    const originalRow = document.getElementById("originalRowForage");
                    const tableBody = document.getElementById("tableBodyForage");
                    const newRow = originalRow.cloneNode(true); // Clone the original row

                    // Clear the select and input fields in the new row
                    const selectElement = newRow.querySelector("#RFID_SELECT");
                    const inputElements = newRow.querySelectorAll("input");

                    selectElement.value = currentRFID;
                    inputElements.forEach(input => {
                        input.value = "";
                    });

                    // Call the updateLivestockInfo function after setting the value
                    updateLivestockInfoAjax({ target: selectElement });

                    // Append the new row to the table
                    tableBody.appendChild(newRow);
                }
                
            },
            error: function (error) {
                console.error("Error:", error);
            },
            async: false // Make the request synchronous
        });
    }

    
    function StartRFIDWeight() {
        $.ajax({
            url: '/RFID-AJAX',
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {},
            success: function (result) {

                var datas = result.rfid_history['rfid/log_rfid.txt'];

                var uniqueRFIDs = []; // Array to store unique RFID values

                for (var i = 0; i < datas.length; i++) {
                    const currentRFID = datas[i]['RFID'];

                    // Check if the RFID is already in the array
                    if (uniqueRFIDs.includes(currentRFID)) {
                        // Skip this iteration if the RFID is repeated
                        continue;
                    }

                    // Add the current RFID to the array
                    uniqueRFIDs.push(currentRFID);

                    // The rest of your existing code
                    const originalRow = document.getElementById("originalRowWeight");
                    const tableBody = document.getElementById("tableBodyWeight");
                    const newRow = originalRow.cloneNode(true); // Clone the original row

                    // Clear the select and input fields in the new row
                    const selectElement = newRow.querySelector("#RFID_SELECT");
                    const inputElements = newRow.querySelectorAll("input");

                    selectElement.value = currentRFID;
                    inputElements.forEach(input => {
                        input.value = "";
                    });

                    // Call the updateLivestockInfo function after setting the value
                    updateLivestockInfoAjax({ target: selectElement });

                    // Append the new row to the table
                    tableBody.appendChild(newRow);
                }

                
            },
            error: function (error) {
                console.error("Error:", error);
            },
            async: false // Make the request synchronous
        });
    }

    
    function StartRFIDMilk() {
        $.ajax({
            url: '/RFID-AJAX',
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {},
            success: function (result) {

                var datas = result.rfid_history['rfid/log_rfid.txt'];

                var uniqueRFIDs = []; // Array to store unique RFID values

                for (var i = 0; i < datas.length; i++) {
                    const currentRFID = datas[i]['RFID'];

                    // Check if the RFID is already in the array
                    if (uniqueRFIDs.includes(currentRFID)) {
                        // Skip this iteration if the RFID is repeated
                        continue;
                    }

                    // Add the current RFID to the array
                    uniqueRFIDs.push(currentRFID);

                    // The rest of your existing code
                    const originalRow = document.getElementById("originalRowMilk");
                    const tableBody = document.getElementById("tableBodyMilk");
                    const newRow = originalRow.cloneNode(true); // Clone the original row

                    // Clear the select and input fields in the new row
                    const selectElement = newRow.querySelector("#RFID_SELECT");
                    const inputElements = newRow.querySelectorAll("input");

                    selectElement.value = currentRFID;
                    inputElements.forEach(input => {
                        input.value = "";
                    });

                    // Call the updateLivestockInfo function after setting the value
                    updateLivestockInfoAjax({ target: selectElement });

                    // Append the new row to the table
                    tableBody.appendChild(newRow);
                }

                
            },
            error: function (error) {
                console.error("Error:", error);
            },
            async: false // Make the request synchronous
        });
    }

    
    function StartRFIDVaccination() {
        $.ajax({
            url: '/RFID-AJAX',
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {},
            success: function (result) {

                var datas = result.rfid_history['rfid/log_rfid.txt'];

                var uniqueRFIDs = []; // Array to store unique RFID values

                for (var i = 0; i < datas.length; i++) {
                    const currentRFID = datas[i]['RFID'];

                    // Check if the RFID is already in the array
                    if (uniqueRFIDs.includes(currentRFID)) {
                        // Skip this iteration if the RFID is repeated
                        continue;
                    }

                    // Add the current RFID to the array
                    uniqueRFIDs.push(currentRFID);

                    // The rest of your existing code
                    const originalRow = document.getElementById("originalRowSchedule");
                    const tableBody = document.getElementById("tableBodySchedule");
                    const newRow = originalRow.cloneNode(true); // Clone the original row

                    // Clear the select and input fields in the new row
                    const selectElement = newRow.querySelector("#RFID_SELECT");
                    const inputElements = newRow.querySelectorAll("input");

                    selectElement.value = currentRFID;
                    inputElements.forEach(input => {
                        input.value = "";
                    });

                    // Call the updateLivestockInfo function after setting the value
                    updateLivestockInfoAjax({ target: selectElement });

                    // Append the new row to the table
                    tableBody.appendChild(newRow);
                }


                
            },
            error: function (error) {
                console.error("Error:", error);
            },
            async: false // Make the request synchronous
        });
    }

    function openReader(){
        $.ajax({
            url: '/OPEN-RFID',
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {},
            success:function(result){
                console.log(result);
            }, error:function(error){
                console.log(error);
            }
        })
    }

    
</script>

@include('partials.__footer')