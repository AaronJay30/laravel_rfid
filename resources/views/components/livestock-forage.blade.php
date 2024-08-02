<?php 
use App\Models\ForageEst;
      
$forageData = ForageEst::select('forage_type', 'est', 'date_planted', 'date_harvested', 'EST_ID')
    ->get();

$groupedForageData = [];

foreach ($forageData as $item) {
    $groupedForageData[$item['est']][] = [
        'forage_type' => $item['forage_type'],
        'date_planted' => $item['date_planted'],
        'date_harvested' => $item['date_harvested'],
        'EST_ID' => $item['EST_ID'],
    ];
}
?>

<h1 class="form-title font-bold text-3xl text-green-950 uppercase pb-2 w-full text-center">Forage Information</h1>
    <div class="flex flex-row text-right justify-end ml-auto button-container mt-5 mb-4">
        <button onclick="addForage.showModal()" class="text-white mx-2 bg-green-700 text-md hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-16 py-2.5 text-center inline-flex items-center">
            Add Forage
        </button>
        @if($forage->isNotEmpty())
            <button onclick="editForage.showModal()" class="text-white mx-2 bg-green-700 text-md hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-16 py-2.5 text-center inline-flex items-center">
                Edit Forage
            </button>
        @endif
    </div>

    @if($forage->isNotEmpty())
        @foreach ($forage as $forages)

        <?php
            $forageId = $forages->FID;
        ?>
            <div class="grid grid-cols-2 mt-12">
                <div class="col-span-1 max-[1250px]:col-span-2 max-[1250px]:mt-12 max-[1250px]:text-center text-left ml-12">
                    <span class="form-title font-bold text-2xl text-green-950 uppercase w-full whitespace-nowrap">Forage Establishment</span>
                    
                    <div class="flex flex-row gap-1 w-full mt-4">
                        <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Establishment:</h1>
                        <span class="md:text-xl text-md">{{ $forages->forageEst->est ?? 'None' }}</span>
                    </div>
                    <div class="flex flex-row gap-1 w-full mt-4">
                        <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Establishment Status:</h1>
                        <span class="md:text-xl text-md">{{ $forages->forageEst->est_status ?? 'None' }}</span>
                    </div>  
                    <div class="flex flex-row gap-1 w-full mt-4">
                        <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Soil Type:</h1>
                        <span class="md:text-xl text-md">{{ $forages->forageEst->soil_type ?? 'None' }}</span>
                    </div>
                    <div class="flex flex-row gap-1 w-full mt-4">
                        <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Climate Condition:</h1>
                        <span class="md:text-xl text-md">{{ $forages->forageEst->climate_condition ?? 'None' }}</span>
                    </div>
                    <div class="flex flex-row gap-1 w-full mt-4">
                        <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Forage Type:</h1>
                        <span class="md:text-xl text-md">{{ $forages->forageEst->forage_type ?? 'None' }}</span>
                    </div>
                    <div class="flex flex-row gap-1 w-full mt-4">
                        <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Date Planted:</h1>
                        @if (!empty($forages->forageEst->date_planted))
                            <span class="md:text-xl text-md">{{ \Carbon\Carbon::parse($forages->forageEst->date_planted)->format('F d Y') }}</span>
                        @else
                            <span class="md:text-xl text-md">None </span> 
                        @endif
                    </div>
                    <div class="flex flex-row gap-1 w-full mt-4">
                        <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Date Harvested:</h1>
                        @if (!empty($forages->forageEst->date_harvested))
                            <span class="md:text-xl text-md">{{ \Carbon\Carbon::parse($forages->forageEst->date_harvested)->format('F d Y') }}</span>
                        @else
                            <span class="md:text-xl text-md">None </span> 
                        @endif
                    </div>
                </div>
                <div class="col-span-1 max-[1250px]:col-span-2 max-[1250px]:mt-12 max-[1250px]:text-center text-left ml-12">
                    <span class="form-title font-bold text-2xl text-green-950 uppercase w-full whitespace-nowrap">Forage Information</span>
                    
                    <div class="flex flex-row gap-1 w-full mt-4">
                        <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Forage Type:</h1>
                        <span class="md:text-xl text-md">{{ $forages->forageInfo->forage_type ?? 'None' }}</span>
                    </div>
                    <div class="flex flex-row gap-1 w-full mt-4">
                        <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Dry Matter:</h1>
                        <span class="md:text-xl text-md">{{ $forages->forageInfo->dry_matter ?? 'None' }}%</span>
                    </div>  
                    <div class="flex flex-row gap-1 w-full mt-4">
                        <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Feed Intake:</h1>
                        <span class="md:text-xl text-md">{{ $forages->forageInfo->feed_intake ?? 'None' }}kg</span>
                    </div>
                    <div class="flex flex-row gap-1 w-full mt-4">
                        <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Duration Start:</h1>
                        @if (!empty($forages->forageInfo->duration_start))
                            <span class="md:text-xl text-md">{{ \Carbon\Carbon::parse($forages->forageInfo->duration_start)->format('F d Y') }}</span>
                        @else
                            <span class="md:text-xl text-md">None </span> 
                        @endif
                    </div>
                    <div class="flex flex-row gap-1 w-full mt-4">
                        <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Duration End:</h1>
                        @if (!empty($forages->forageInfo->duration_end))
                            <span class="md:text-xl text-md">{{ \Carbon\Carbon::parse($forages->forageInfo->duration_end)->format('F d Y') }}</span>
                        @else
                            <span class="md:text-xl text-md">None </span> 
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        <div class="mt-12 col-span-4 w-full">
            {{ $forage->appends(\Request::except('foragePage'))->links('pagination::tailwind') }}
            

        </div>
    @else 
        <h1 class="form-title text-5xl mt-10 text-gray-300 pb-2 w-full text-center col-span-4">No Forage Information</h1>
    @endif

<dialog id="addForage" class="w-2/3 max-[1250px]:w-full px-5 backdrop:bg-black backdrop:opacity-80 rounded-2xl">
    <div class="flex justify-between">
            
        <button onclick="addForage.close()">
            <div class="add bg-orange-500 hover:bg-orange-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                <i class='bx bx-x'></i>
            </div>
        </button>

        <button type="submit" form="addForageForm">
            <div class="add bg-green-500 hover:bg-green-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                <i class='bx bx-save'></i>
            </div>
        </button>
    
    </div>
    <h1 class="form-title font-bold text-3xl text-green-950 uppercase my-3 w-full text-center border-t-2 pt-4">Add Forage Information</h1>



    <form action="{{route('store.forage')}}" method="POST" id="addForageForm" class="grid grid-cols-2 p-4 gap-x-8 gap-y-4">
        @csrf

        <h1 class="form-title my-3 font-bold text-lg text-green-950 uppercase w-full whitespace-nowrap col-span-2 text-center">Forage Establishment</h1>

        <div class="flex flex-col col-span-1 max-[1250px]:col-span-2">

            <h1 class="text-left mb-2 w-full text-green-950">Forage Establishment</h1>
            <select id="establishment" name="forage_establishment" class="bg-gray-100 border-0 border-b-[1px] border-accent text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block py-2.5 px-5 w-full" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
                <option value="" disabled selected>Select a forage establishment</option>
                @foreach ($groupedForageData as $est => $types)
                    <optgroup label="{{ $est }}">
                        @foreach ($types as $type)
                            <option value="{{ $type['EST_ID']}}">
                                {{ $type['forage_type'] }} (Planted: {{\Carbon\Carbon::parse($type['date_planted'])->format('F d Y')}}, Harvested: {{\Carbon\Carbon::parse($type['date_harvested'])->format('F d Y')}})
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            
            
        </div>

        <div class="flex flex-row justify-start button-container mt-7 col-span-1 max-[1250px]:col-span-2">
            <a href="{{route('add.forage.establishment')}}" target="_blank"><button type="button" class="text-white mx-2 bg-green-700 text-md hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-16 py-2.5 text-center inline-flex items-center">
                Add Establishment
            </button></a>
        </div>

        <div class="flex flex-col mb-1 max-[1250px]:col-span-2 col-span-1">
            <h1 class="text-left mb-2 w-full text-green-950">Dry Matter <span class="text-sm text-gray-500">(in percentage)</span></h1>
            <input type="number" step="0.01" min="0" max="100" autocomplete="off" name="dry_matter" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter the dry matter percentage">
            @error('dry_matter')
                <p class="text-red-500 w-full text-sm ml-3">
                    {{$message}}
                </p>
            @enderror
        </div>

        <input type="hidden" name="RFID_TAG" value="{{$livestock->RFID_TAG}}">

        <div class="flex flex-col mb-1 max-[1250px]:col-span-2 col-span-1">
            <h1 class="text-left mb-2 w-full text-green-950">Feed Intake <span class="text-sm text-gray-500">(in kilograms)</span></h1>
            <input type="number" min="0" step="0.01" autocomplete="off" name="feed_intake" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter the amount of feed intake">
            @error('feed_intake')
                <p class="text-red-500 w-full text-sm ml-3">
                    {{$message}}
                </p>
            @enderror
        </div>

        <div class="flex flex-col mb-1 max-[1250px]:col-span-2 col-span-1">
            <h1 class="text-left mb-2 w-full text-green-950">Duration Start</h1>
            <input type="date" autocomplete="off" name="duration_start" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
            @error('duration_start')
                <p class="text-red-500 w-full text-sm ml-3">
                    {{$message}}
                </p>
            @enderror
        </div>

        <div class="flex flex-col mb-1 max-[1250px]:col-span-2 col-span-1">
            <h1 class="text-left mb-2 w-full text-green-950">Duration End</h1>
            <input type="date" min="0" step="0.01" autocomplete="off" name="duration_end" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
            @error('duration_end')
                <p class="text-red-500 w-full text-sm ml-3">
                    {{$message}}
                </p>
            @enderror
        </div>

    </form>

</dialog>

@if($forage->isNotEmpty())
    <dialog id="editForage" class="w-2/3 max-[1250px]:w-full px-5 backdrop:bg-black backdrop:opacity-80 rounded-2xl">
        <div class="flex justify-between">

            <button onclick="editForage.close()">
                <div class="edit bg-orange-500 hover:bg-orange-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                    <i class='bx bx-x'></i>
                </div>
            </button>

            <form action="{{route('delete.forage', ['forage' => $forageId])}}" method="POST">
                @method('delete')
                @csrf
                <input type="hidden" name="page" value="{{$forage->currentPage()}}">
                <button type="submit">
                    <div class="add bg-red-500 hover:bg-red-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                        <i class='bx bx-trash'></i>
                    </div>
                </button>
            </form>

            <button type="submit" form="editForageForm">
                <div class="edit bg-green-500 hover:bg-green-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                    <i class='bx bx-save'></i>
                </div>
            </button>
        
        </div>

        <h1 class="form-title font-bold text-3xl text-green-950 uppercase my-3 w-full text-center border-t-2 pt-4">Edit Forage Information</h1>

        <form action="{{route('edit.forage')}}" method="POST" id="editForageForm" class="grid grid-cols-2 p-4 gap-x-8 gap-y-4">
            @csrf
            
            @foreach ($forage as $forages)     
                <div class="flex flex-col col-span-1 max-[1250px]:col-span-2">
        
                    <h1 class="text-left mb-2 w-full text-green-950">Forage Establishment</h1>
                    <select id="Editestablishment" name="forage_establishment" class="bg-gray-100 border-0 border-b-[1px] border-accent text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block py-2.5 px-5 w-full" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
                        <option value="" disabled selected>Select a forage establishment</option>
                        @foreach ($groupedForageData as $est => $types)
                            <optgroup label="{{ $est }}">
                                @foreach ($types as $type)
                                    <option value="{{ $type['EST_ID']}}" {{$forages->EST_ID == $type['EST_ID'] ? 'selected' : ''}}>
                                        {{ $type['forage_type'] }} (Planted: {{\Carbon\Carbon::parse($type['date_planted'])->format('F d Y')}}, Harvested: {{\Carbon\Carbon::parse($type['date_harvested'])->format('F d Y')}})
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    
                    
                </div>
        
                <div class="flex flex-row justify-start button-container mt-7 col-span-1 max-[1250px]:col-span-2">
                    {{-- <a href="{{route('add.forage.establishment')}}" target="_blank"><button type="button" class="text-white mx-2 bg-green-700 text-md hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-16 py-2.5 text-center inline-flex items-center">
                        Add Establishment
                    </button></a> --}}
                    <button type="button" id="editEstablishmentBtn" onclick="editEstablishment()" data-url="{{ route('edit.forage.establishment') }}" class="text-white mx-2 bg-orange-700 text-md hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-16 py-2.5 text-center inline-flex items-center">
                        Edit Establishment
                    </button>
                </div>
                <div class="flex flex-col mb-1 max-[1250px]:col-span-2 col-span-1">
                    <h1 class="text-left mb-2 w-full text-green-950">Dry Matter <span class="text-sm text-gray-500">(in percentage)</span></h1>
                    <input type="number" value="{{$forages->forageInfo->dry_matter}}" step="0.01" min="0" max="100" autocomplete="off" name="dry_matter" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter the dry matter percentage">
                    @error('dry_matter')
                        <p class="text-red-500 w-full text-sm ml-3">
                            {{$message}}
                        </p>
                    @enderror
                </div>
        
                <input type="hidden" name="RFID_TAG" value="{{$livestock->RFID_TAG}}">
                <input type="hidden" name="FEED_ID" value="{{$forages->FEED_ID}}">
                <input type="hidden" name="FID" value="{{$forages->FID}}">
        
                <div class="flex flex-col mb-1 max-[1250px]:col-span-2 col-span-1">
                    <h1 class="text-left mb-2 w-full text-green-950">Feed Intake <span class="text-sm text-gray-500">(in kilograms)</span></h1>
                    <input type="number" min="0" value="{{$forages->forageInfo->feed_intake}}" step="0.01" autocomplete="off" name="feed_intake" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter the amount of feed intake">
                    @error('feed_intake')
                        <p class="text-red-500 w-full text-sm ml-3">
                            {{$message}}
                        </p>
                    @enderror
                </div>
        
                <div class="flex flex-col mb-1 max-[1250px]:col-span-2 col-span-1">
                    <h1 class="text-left mb-2 w-full text-green-950">Duration Start</h1>
                    <input type="date" autocomplete="off" value="{{$forages->forageInfo->duration_start}}" name="duration_start" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
                    @error('duration_start')
                        <p class="text-red-500 w-full text-sm ml-3">
                            {{$message}}
                        </p>
                    @enderror
                </div>
        
                <div class="flex flex-col mb-1 max-[1250px]:col-span-2 col-span-1">
                    <h1 class="text-left mb-2 w-full text-green-950">Duration End</h1>
                    <input type="date" min="0" step="0.01" autocomplete="off" value="{{$forages->forageInfo->duration_end}}" name="duration_end" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
                    @error('duration_end')
                        <p class="text-red-500 w-full text-sm ml-3">
                            {{$message}}
                        </p>
                    @enderror
                </div>
            @endforeach
        </form>
    </dialog>
@endif


<script>

    // Get the button element by its class
    var buttonElement = document.getElementById("editEstablishmentBtn");

    // Get the select element by its id
    var selectElement = document.getElementById("Editestablishment");

    // Add a click event listener to the button
    function editEstablishment() {
        // Get the selected value from the select element
        var selectedValue = selectElement.value;

        // Get the base URL from the data attribute
        var baseUrl = buttonElement.getAttribute("data-url");

        // Construct the URL with the selected value
        var url = baseUrl + '?forageEstId=' + selectedValue;

        // Open a new tab with the constructed URL
        window.open(url, '_blank');
    };

</script>