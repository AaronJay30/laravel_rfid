<meta name="csrf-token" content="{{ csrf_token() }}">

<h1 class="form-title font-bold text-3xl text-green-950 uppercase pb-2 w-full text-center">Milk Information</h1>
{{-- 
<div class="col-span-4 ml-16 mt-6 -mb-5 max-[1250px]:flex max-[1250px]:justify-center max-[1250px]:w-full max-[1250px]:ml-0 max-[1250px]:mb-4">
    <label class="inline-flex items-center ml-4" @click="milkView = 'Overview'">
        <input type="radio" class="form-radio text-green-600" name="progressView" value="Overview" x-bind:checked="progressView === 'Overview'">
        <span class="ml-2">Overview</span>
    </label>

    <label class="inline-flex items-center ml-4" @click="milkView = 'Graph'">
        <input type="radio" class="form-radio text-green-600" name="progressView" value="Graph" x-bind:checked="progressView === 'Graph'">
        <span class="ml-2">Graph</span>
    </label>
</div> --}}


<div class="flex flex-row text-right justify-end ml-auto button-container mt-5 mb-4">
    <?php 
        $currentDate = \Carbon\Carbon::now()->toDateString(); 
        

        $lactationPeriod = App\Models\MilkRegistration::query()
                        ->where("RFID_TAG", $livestock->RFID_TAG)
                        ->whereHas('milkLactation', function ($query) use ($currentDate) {
                            $query->where('lact_start', '<=', $currentDate)
                                ->where('lact_end', '>=', $currentDate);
                        })
                        ->get();  


        $lactationToday = App\Models\MilkRegistration::query()
                          ->where('milking_date', $currentDate)
                          ->where('RFID_TAG', $livestock->RFID_TAG)
                          ->get();
        
                        
    ?>

    @if($lactationPeriod->isNotEmpty())

        @if($lactationToday->isEmpty())
            <button onclick="milkNow.showModal()" class="text-white mx-2 bg-green-700 text-md hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-16 py-2.5 text-center inline-flex items-center">
                Milk Now
            </button>
        @else
            <button onclick="editMilk.showModal()" id="editMilkBtn" class="text-white mx-2 bg-green-700 text-md hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-16 py-2.5 text-center inline-flex items-center">
                Edit Info
            </button>
        @endif
    @else
        <button onclick="startMilking.showModal()" class="text-white mx-2 bg-green-700 text-md hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-16 py-2.5 text-center inline-flex items-center">
            Add Lactation Period
        </button>
    @endif
    
    

</div>


<div class="lower-container grid grid-cols-4 gap-5 mt-5" id="milkContainer">
    @if($milk->isNotEmpty() && $lactationToday->isNotEmpty() && $lactationPeriod->isNotEmpty())
        @foreach ($milk as $item)

            @php
                $milkID = $item->MILK_ID
            @endphp
            <div class="col-span-1 max-[1200px]:col-span-4 ml-16">
                <h1 class="form-title font-bold text-xl text-green-950 text-left pb-2 w-full">Choose a date: </h1>
            </div>
            <div class="col-span-2 w-full my-4 -mt-4 max-[1200px]:col-span-4 flex flex-row justify-center">

                <input type="date" name="dateFilter" id="dateFilter" class="rounded-3xl w-full mt-2 max-[1200px]:w-2/3 max-[700px]:w-3/4">
            </div>

            <div class="lower-info-container col-span-2 ml-16 flex flex-col gap-2 mb-5">

                <h1 class="form-title font-bold text-2xl text-green-950 text-left uppercase pb-2 w-full">MILKING PROCESS</h1>
                
                <div class="flex flex-row gap-4 w-full">
                    <h1 class="font-bold md:text-xl text-md text-green-950 text-left whitespace-nowrap">Milk Yield:</h1>
                        <span class="md:text-xl text-md" id="spanMilkYield"></span>
                </div>

                <div class="flex flex-row gap-4 w-full">
                    <h1 class="font-bold md:text-xl text-md text-green-950 text-left whitespace-nowrap">Milking Time:</h1>
                        <span class="md:text-xl text-md" id="spanMilkTime"></span>
                </div>

                <div class="flex flex-row gap-4 w-full">
                    <h1 class="font-bold md:text-xl text-md text-green-950 text-left whitespace-nowrap">Milking Temperature:</h1>
                        <span class="md:text-xl text-md whitespace-nowrap" id="spanMilkTemp"></span>
                </div>
                <div class="flex flex-row gap-4 w-full">
                    <h1 class="font-bold md:text-xl text-md text-green-950 text-left whitespace-nowrap">Milker's Name:</h1>
                        <span class="md:text-xl text-md whitespace-nowrap" id="spanMilkerName"></span>
                </div>
                <h1 class="form-title font-bold text-2xl text-green-950 text-left uppercase pb-2 w-full mt-7">Category</h1>

                <div class="flex flex-row gap-4 w-full">
                    <h1 class="font-bold md:text-xl text-md text-green-950 text-left">Milk Quality:</h1>
                        <span class="md:text-xl text-md" id="spanMilkQuality"> </span>
                </div>

                <div class="flex flex-row gap-4 w-full">
                    <h1 class="font-bold md:text-xl text-md text-green-950 text-left">Milk Fat:</h1>
                        <span class="md:text-xl text-md" id="spanMilkFat"></span>
                </div>

                <div class="flex flex-row gap-4 w-full">
                    <h1 class="font-bold md:text-xl text-md text-green-950 text-left">Milk Protein:</h1>
                        <span class="md:text-xl text-md" id="spanMilkProtein"></span>
                </div>

                
            </div>
            <div class="lower-info-container col-span-2 flex flex-col gap-2 ml-16 mb-5 mt-3">

                <h1 class="form-title font-bold text-2xl text-green-950 text-left uppercase pb-2 w-full">MILKING PROCESS</h1>

                <div class="flex flex-row gap-4 w-full">
                    <h1 class="font-bold md:text-xl text-md text-green-950 text-left whitespace-nowrap">Lactation Season:</h1>
                        <span class="md:text-xl text-md" id="spanLactSeason"></span>
                </div>

                <div class="flex flex-row gap-4 w-full">
                    <h1 class="font-bold md:text-xl text-md text-green-950 text-left whitespace-nowrap">Start of Lactation:</h1>
                        <span class="md:text-xl text-md" id="spanLactStart"></span>
                </div>

                <div class="flex flex-row gap-4 w-full">
                    <h1 class="font-bold md:text-xl text-md text-green-950 text-left whitespace-nowrap">End of Lactation:</h1>
                        <span class="md:text-xl text-md" id="spanLactEnd"></span>
                </div>

                <div class="flex flex-row gap-4 w-full">
                    <h1 class="font-bold md:text-xl text-md text-green-950 text-left whitespace-nowrap">Lactation Length:</h1>
                        <span class="md:text-xl text-md" id="spanLactLength"></span>
                </div>
                
            </div>
        @endforeach
    @else 
        <h1 class="form-title text-5xl mt-10 text-gray-300 pb-2 w-full text-center col-span-4">No Milk Information</h1>
    @endif

</div>


<dialog id="milkNow" class="w-2/3 px-5 backdrop:bg-black backdrop:opacity-80 rounded-2xl">
    <div class="flex justify-between">

        <button onclick="milkNow.close()">
            <div class="add bg-orange-500 hover:bg-orange-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                <i class='bx bx-x'></i>
            </div>
        </button>

        <button type="submit" form="milkNowForm">
            <div class="add bg-green-500 hover:bg-green-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                <i class='bx bx-save'></i>
            </div>
        </button>
    
    </div>
    <form action="{{route('livestock.milk.add.today')}}" method="POST" id="milkNowForm">
        @csrf
    
        <div class="form-container border-t-[2px] my-5">
            <h1 class="form-title font-bold text-3xl text-green-950 uppercase my-3 w-full text-center">Add Milk Today</h1>

            {{-- FORM --}}
            <div class="grid-cols-1 grid gap-4">
                <div class="addFormMilk col-span-1">
                    <h1 class="form-title font-bold text-2xl mt-7 sm:px-10 px-5 text-green-950 text-left uppercase pb-2 w-full mb-2">MILKING PROCESS</h1>

                    <input type="hidden" name="RFID_TAG" value="{{$livestock->RFID_TAG}}">
                    
                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Milk Yield</h1>
                        <input type="number" step="0.01" autocomplete="off" value="{{old('milk_yield')}}" name="milk_yield" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter total milk yield in liters">
                        @error('milk_yield')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Milking Time</h1>
                        <div class="w-full flex flex-row gap-5">
                            <div class="flex flex-col w-1/2">
                                <input type="number" placeholder="Enter the hour" min="0" autocomplete="off" value="{{old('milking_time_hour')}}" name="milking_time_hour" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
                                @error('milking_time_hour')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div class="flex flex-col w-1/2">
                                <input type="number" min="1" max="60" placeholder="Enter the minutes" autocomplete="off" value="{{old('milking_time_minute')}}" name="milking_time_minute" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
                                @error('milking_time_minute')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            
                        </div>
                    </div>

                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Milking Temperature</h1>
                        <input type="number" min="1" max="100" autocomplete="off" value="{{old('milking_temperature')}}" name="milking_temperature" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter the average milking time temperature">
                        @error('milking_temperature')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Milker's Name</h1>
                        <input type="text" placeholder="Enter milker's name" autocomplete="off" value="{{old('milker_name')}}" name="milker_name" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter the average milking time temperature">
                        @error('milker_name')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>

                    <h1 class="form-title font-bold text-2xl mt-7 sm:px-10 px-5 text-green-950 text-left uppercase pb-2 w-full mb-2">Category</h1>
                    
                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Milk Quality</h1>
                        <input type="text" autocomplete="off" value="{{old('milk_quality')}}" name="milk_quality" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter milk quality">
                        @error('milk_quality')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Milk Fat</h1>
                        <input type="text" autocomplete="off" value="{{old('milk_fat')}}" name="milk_fat" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter milk fat">
                        @error('milk_fat')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Milk Protein</h1>
                        <input type="text" autocomplete="off" value="{{old('milk_protein')}}" name="milk_protein" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter milk protein">
                        @error('milk_protein')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                    
                </div>
            </div>
        </div>
    </form>

</dialog>

<dialog id="startMilking" class="w-2/3 px-5 backdrop:bg-black backdrop:opacity-80 rounded-2xl">
    <div class="flex justify-between">

        <button onclick="startMilking.close()">
            <div class="add bg-orange-500 hover:bg-orange-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                <i class='bx bx-x'></i>
            </div>
        </button>

        <button type="submit" form="startMilkingForm">
            <div class="add bg-green-500 hover:bg-green-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                <i class='bx bx-save'></i>
            </div>
        </button>
    
    </div>
    <form action="{{route('livestock.milk.add')}}" method="POST" id="startMilkingForm">
        @csrf
    
        <div class="form-container border-t-[2px] my-5">
            <h1 class="form-title font-bold text-3xl text-green-950 uppercase my-3 w-full text-center">Add Milk Information</h1>

            {{-- FORM --}}
            <div class="grid-cols-2 grid gap-4">
                <div class="addFormMilk col-span-1">
                    <h1 class="form-title font-bold text-2xl mt-7 sm:px-10 px-5 text-green-950 text-left uppercase pb-2 w-full mb-2">MILKING PROCESS</h1>

                    <input type="hidden" name="RFID_TAG" value="{{$livestock->RFID_TAG}}">
                    
                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Milk Yield</h1>
                        <input type="number" step="0.01" autocomplete="off" value="{{old('milk_yield')}}" name="milk_yield" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter total milk yield in liters">
                        @error('milk_yield')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Milking Time</h1>
                        <div class="w-full flex flex-row gap-5">
                            <div class="flex flex-col w-1/2">
                                <input type="number" placeholder="Enter the hour" min="0" autocomplete="off" value="{{old('milking_time_hour')}}" name="milking_time_hour" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
                                @error('milking_time_hour')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div class="flex flex-col w-1/2">
                                <input type="number" min="1" max="60" placeholder="Enter the minutes" autocomplete="off" value="{{old('milking_time_minute')}}" name="milking_time_minute" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
                                @error('milking_time_minute')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            
                        </div>
                    </div>

                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Milking Temperature</h1>
                        <input type="number" min="1" max="100" autocomplete="off" value="{{old('milking_temperature')}}" name="milking_temperature" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter the average milking time temperature">
                        @error('milking_temperature')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Milker's Name</h1>
                        <input type="text" placeholder="Enter milker's name" autocomplete="off" value="{{old('milker_name')}}" name="milker_name" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter the average milking time temperature">
                        @error('milker_name')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>

                    <h1 class="form-title font-bold text-2xl mt-7 sm:px-10 px-5 text-green-950 text-left uppercase pb-2 w-full mb-2">Category</h1>
                    
                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Milk Quality</h1>
                        <input type="text" autocomplete="off" value="{{old('milk_quality')}}" name="milk_quality" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter milk quality">
                        @error('milk_quality')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Milk Fat</h1>
                        <input type="text" autocomplete="off" value="{{old('milk_fat')}}" name="milk_fat" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter milk fat">
                        @error('milk_fat')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Milk Protein</h1>
                        <input type="text" autocomplete="off" value="{{old('milk_protein')}}" name="milk_protein" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter milk protein">
                        @error('milk_protein')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                    
                </div>
        
                <div class="addFormLactation col-span-1">
                    <h1 class="form-title font-bold text-2xl mt-7 sm:px-10 px-5 text-green-950 text-left uppercase pb-2 w-full">LACTATION</h1>
        
                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Lactation Season</h1>
                        <select id="lact_season" autocomplete="off" value="{{old('lact_season')}}" name="lact_season" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" >
                            <option value="" selected disabled>Select lactation season</option>
                            <option value="Wet" {{old('lact_season') == "Wet" ?? 'selected'}}>Wet</option>
                            <option value="Dry" {{old('lact_season') == "Dry" ?? 'selected'}}>Dry</option>
                        </select>
                        @error('lact_season')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Start of Lactation</h1>
                        <input type="date" id="start_lact" autocomplete="off" value="{{old('lact_start')}}" name="lact_start" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
                        @error('lact_start')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                    
                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">End of Lactation</h1>
                        <input type="date" id="end_lact" autocomplete="off" value="{{old('lact_end')}}" name="lact_end" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" >
                        @error('lact_end')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Lactation Length</h1>
                        <input type="text" id="lact_length" autocomplete="off" placeholder="Enter lactation length" value="{{old('lact_length')}}" name="lact_length" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" >
                        @error('lact_length')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                
                </div>
            </div>
        </div>
    </form>

</dialog>

@if($milk->isNotEmpty() && $lactationToday->isNotEmpty() && $lactationPeriod->isNotEmpty())
<dialog id="editMilk" class="w-2/3 px-5 backdrop:bg-black backdrop:opacity-80 rounded-2xl">
        <div class="flex justify-between">

            <button onclick="editMilk.close()">
                <div class="edit bg-orange-500 hover:bg-orange-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                    <i class='bx bx-x'></i>
                </div>
            </button>

            <form action="{{route('livestock.milk.delete')}}" method="POST">
                @method('delete')
                @csrf
                <input type="hidden" name="milkID" id="deleteMilkId">
                <button type="submit">
                    <div class="add bg-red-500 hover:bg-red-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                        <i class='bx bx-trash'></i>
                    </div>
                </button>
            </form>

            <button type="submit" form="editMilkForm">
                <div class="edit bg-green-500 hover:bg-green-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                    <i class='bx bx-save'></i>
                </div>
            </button>
        
        </div>
        <form action="{{route('livestock.milk.edit')}}" method="POST" id="editMilkForm">
            @csrf
            @foreach ($milk as $item)
                <div class="form-container border-t-[2px] my-5">
                    <h1 class="form-title font-bold text-3xl text-green-950 uppercase my-3 w-full text-center">Edit Milk Information</h1>

                    {{-- FORM --}}
                    <div class="grid-cols-2 grid gap-4">
                        <div class="editFormMilk col-span-1">
                            <h1 class="form-title font-bold text-2xl mt-7 sm:px-10 px-5 text-green-950 text-left uppercase pb-2 w-full mb-2">MILKING PROCESS</h1>

                            <input type="hidden" name="RFID_TAG" id="form_RFID_TAG">
                            <input type="hidden" name="MILK_MID" id="form_MILK_MID">
                            <input type="hidden" name="MILK_LID" id="form_MILK_LID">
                            
                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">Milk Yield</h1>
                                <input type="number" id="form_milk_yield" step="0.01" autocomplete="off" name="milk_yield" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter total milk yield in liters">
                                @error('milk_yield')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>

                            @php
                                preg_match_all('/\d+/', $item->milkInfo->milking_time, $matches);

                                $hour = $matches[0][0];
                                $minute = $matches[0][1];
                            @endphp


                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">Milking Time</h1>
                                <div class="w-full flex flex-row gap-5">
                                    <div class="flex flex-col w-1/2">
                                        <input type="number" id="form_milking_time_hour" placeholder="Enter the hour" min="0" autocomplete="off"  name="milking_time_hour" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
                                        @error('milking_time_hour')
                                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col w-1/2">
                                        <input type="number" id="form_milking_time_minute" min="1" max="60" placeholder="Enter the minutes" autocomplete="off" name="milking_time_minute" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
                                        @error('milking_time_minute')
                                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">Milking Temperature</h1>
                                <input type="number" id="form_milking_temperature" min="1" max="100" autocomplete="off" name="milking_temperature" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter the average milking time temperature">
                                @error('milking_temperature')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>

                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">Milking Temperature</h1>
                                <input type="text" id="form_milker_name" placeholder="Enter milker's name" autocomplete="off" name="milker_name" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter the average milking time temperature">
                                @error('milker_name')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>

                            <h1 class="form-title font-bold text-2xl mt-7 sm:px-10 px-5 text-green-950 text-left uppercase pb-2 w-full mb-2">Category</h1>
                            
                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">Milk Quality</h1>
                                <input type="text" id="form_milk_quality" autocomplete="off" name="milk_quality" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter milk quality">
                                @error('milk_quality')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>

                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">Milk Fat</h1>
                                <input type="text" id="form_milk_fat" autocomplete="off" name="milk_fat" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter milk fat">
                                @error('milk_fat')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>

                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">Milk Protein</h1>
                                <input type="text" id="form_milk_protein" autocomplete="off" name="milk_protein" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter milk protein">
                                @error('milk_protein')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            
                        </div>
                
                        <div class="editFormLactation col-span-1">
                            <h1 class="form-title font-bold text-2xl mt-7 sm:px-10 px-5 text-green-950 text-left uppercase pb-2 w-full">LACTATION</h1>
                
                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">Lactation Season</h1>
                                <select id="form_lact_season" autocomplete="off" name="lact_season" value="" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" >
                                    <option value="" selected disabled>Select lactation season</option>
                                    <option value="Wet">Wet</option>
                                    <option value="Dry">Dry</option>
                                </select>
                                @error('lact_season')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>

                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">Start of Lactation</h1>
                                <input type="date" id="form_lact_start" autocomplete="off" name="lact_start" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
                                @error('lact_start')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            
                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">End of Lactation</h1>
                                <input type="date" id="form_lact_end" autocomplete="off" name="lact_end" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" >
                                @error('lact_end')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>

                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">Lactation Length</h1>
                                <input type="text" placeholder="Enter lactation length" id="form_lact_length" autocomplete="off" name="lact_length" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" >
                                @error('lact_length')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                        
                        </div>
                    </div>
                </div>
            @endforeach
        </form>

    </dialog>
@endif

<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
    dd = '0' + dd;
    }

    if (mm < 10) {
    mm = '0' + mm;
    } 
        
    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("start_lact").setAttribute("min", today);
    document.getElementById("end_lact").setAttribute("min", today);
</script>


<script>

    $(document).ready(function() {
        let jsMilk = @json($milk);
        fillInfo(jsMilk[0]);
        console.log(jsMilk[0].milk_lactation.lact_start);
    });

    function updateElementText(elementId, text) {
        $('#' + elementId).text(text);
    }

    function updateElementInput(elementId, newValue) {
        $('#' + elementId).val(newValue); // Set the value directly
    }


    function formatDate(inputDate) {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(inputDate).toLocaleDateString(undefined, options);
    }

    function fillInfo(result){
        if(result){
            const milkInfo = result.milk_info;
            const milkLactation = result.milk_lactation;

            updateElementText('spanMilkYield', milkInfo.milk_yield + " Liters");
            updateElementText('spanMilkTime', milkInfo.milking_time);
            updateElementText('spanMilkTemp', milkInfo.milk_temp + " Degrees");
            updateElementText('spanMilkQuality', milkInfo.milk_quality);
            updateElementText('spanMilkerName', milkInfo.milker_name);
            updateElementText('spanMilkFat', milkInfo.milk_fat);
            updateElementText('spanMilkProtein', milkInfo.milk_protein);
            updateElementText('spanLactStart', formatDate(milkLactation.lact_start));
            updateElementText('spanLactSeason', milkLactation.lact_season);
            updateElementText('spanLactLength', milkLactation.lact_length);
            updateElementText('spanLactEnd', formatDate(milkLactation.lact_end));

            let milking_time =  milkInfo.milking_time;
            let matches = milking_time.match(/\d+/g);
            let hour = matches[0];
            let minute = matches[1];

            updateElementInput('form_milk_yield', milkInfo.milk_yield);
            updateElementInput('form_milking_time_hour', hour);
            updateElementInput('form_milking_time_minute', minute);
            updateElementInput('form_milking_temperature', milkInfo.milk_temp);
            updateElementInput('form_milk_quality', milkInfo.milk_quality);
            updateElementInput('form_milk_fat', milkInfo.milk_fat);
            updateElementInput('form_milker_name', milkInfo.milker_name);
            updateElementInput('form_milk_protein', milkInfo.milk_protein);
            updateElementInput('form_lact_season', milkLactation.lact_season);
            updateElementInput('form_lact_start', milkLactation.lact_start);
            updateElementInput('form_lact_end', milkLactation.lact_end);
            updateElementInput('form_lact_length', milkLactation.lact_length);
            updateElementInput('form_RFID_TAG', result.RFID_TAG);
            updateElementInput('form_MILK_MID', result.MILK_MID);
            updateElementInput('deleteMilkId', result.MILK_MID);
            updateElementInput('form_MILK_LID', result.MILK_LID);
        }
    }

    function unfillInfo(){
        const noRecords = "No Records!";
        updateElementText('spanMilkYield', noRecords);
        updateElementText('spanMilkTime', noRecords);
        updateElementText('spanMilkTemp', noRecords);
        updateElementText('spanMilkQuality', noRecords);
        updateElementText('spanMilkFat', noRecords);
        updateElementText('spanMilkProtein', noRecords);
        updateElementText('spanLactStart', noRecords);
        updateElementText('spanLactSeason', noRecords);
        updateElementText('spanLactLength', noRecords);
        updateElementText('spanLactEnd', noRecords);

        updateElementInput('form_milk_yield', '');
        updateElementInput('form_milking_time_hour', '');
        updateElementInput('form_milking_time_minute', '');
        updateElementInput('form_milking_temperature', '');
        updateElementInput('form_milk_quality', '');
        updateElementInput('form_milk_fat', '');
        updateElementInput('form_milk_protein', '');
        updateElementInput('form_lact_season', '');
        updateElementInput('form_lact_start', '');
        updateElementInput('form_lact_end', '');
        updateElementInput('form_lact_length', '');
    }

    $('#dateFilter').on('change', () => {
        const dateFilterValue = $('#dateFilter').val();
        let jsMilk = @json($milk);
        let RFID_TAG = jsMilk[0].RFID_TAG;
        var editMilkBtn = document.getElementById('editMilkBtn');

        $.ajax({
            url: '/ajax',
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'RFID_TAG': RFID_TAG,
                'dateFilter': dateFilterValue,
            }, success:function(result){
                if (result.milk.length > 0) {
                    fillInfo(result.milk[0]);         
                    editMilkBtn.style.display= "inline";
                } else {
                    editMilkBtn.style.display= "none";
                    unfillInfo();
                }



            }, error:function(e){
                console.log(e);
            }
        })
    })
</script>