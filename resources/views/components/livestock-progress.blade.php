
<!-- Add these script tags to include the required libraries -->
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<style>
    select {
    // A reset of styles, including removing the default dropdown arrow
    appearance: none;
    background-color: transparent;
    border: 1px solid rgba(0,0,0,0.5);
    padding: 1rem;
    margin: 0;
    width: 100%;
    font-family: inherit;
    font-size: inherit;
    cursor: inherit;
    line-height: inherit;

    // Stack above custom arrow
    z-index: 1;

    // Remove dropdown arrow in IE10 & IE11
    // @link https://www.filamentgroup.com/lab/select-css.html
    &::-ms-expand {
        display: none;
    }
    }


    select[multiple] {
    padding-right: 0;

    height: 6rem;

    option {
        white-space: normal;

        // Only affects Chrome
        outline-color: rgb(21 128 61);
    }

    /* 
    * Experimental - styling of selected options
    * in the multiselect
    * Not supported crossbrowser
    */
    //   &:not(:disabled) option {
    //     border-radius: 12px;
    //     transition: 120ms all ease-in;

    //     &:checked {
    //       background: linear-gradient(hsl(242, 61%, 76%), hsl(242, 61%, 71%));
    //       padding-left: 0.5em;
    //       color: black !important;
    //     }
    //   }
}


</style>
<h1 class="form-title font-bold text-3xl text-green-950 uppercase pb-2 w-full text-center">Progress Information</h1>
<div class="flex flex-row text-right justify-end ml-auto button-container mt-5 mb-4" x-show="progressView === 'Overview'">
    <button onclick="addProgress.showModal()" class="text-white mx-2 bg-green-700 text-md hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-16 py-2.5 text-center inline-flex items-center">
        Add Progress
    </button>
    <button onclick="editProgress.showModal()" class="text-white mx-2 bg-green-700 text-md hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-16 py-2.5 text-center inline-flex items-center">
        Edit Progress
    </button>
</div>

<div class="lower-container grid grid-cols-4 gap-y-3">
    <div class="col-span-4 ">
        <label class="inline-flex items-center ml-4" @click="progressView = 'Overview'">
            <input type="radio" class="form-radio text-green-600" name="progressView" value="Overview" x-bind:checked="progressView === 'Overview'">
            <span class="ml-2">Overview</span>
        </label>
    
        <label class="inline-flex items-center ml-4" @click="progressView = 'Graph'">
            <input type="radio" class="form-radio text-green-600" name="progressView" value="Graph" x-bind:checked="progressView === 'Graph'">
            <span class="ml-2">Graph</span>
        </label>
    </div>

    <div class="col-span-4 mx-4" >
        <div class="select select--multiple w-full" x-show="progressView === 'Overview'">
            <label for="multi-select" class="text-lg uppercase">Select a timeline progress</label>
        <select id="multi-select" name="progress" class="w-full border-green-800 focus:border-green-800 focus:ring-0 border-y-2 border-x-0 my-2 px-4 py-4 gap-4" multiple>
          @foreach ($dateFilter as $item)
            <option value="{{$item->date}}" class="checked:bg-green-300 active:ring-green-300 py-1.5 px-4 mx-auto"> {{\Carbon\Carbon::parse($item->date)->format('F d Y')}}</option>
          @endforeach
        </select>
        <span>
    </div>

    <div x-show="progressView === 'Overview'" class="col-span-4">
       
        <div>
            @if($progress->isEmpty())
                <h1 class="form-title text-5xl mt-10 text-gray-300 pb-2 w-full text-center col-span-2">Information is not yet available</h1>
            @else
                @foreach ($progress as $item)
                    
                    <div class="grid grid-cols-2" id="originalContainer">
                        <input type="hidden" id="RFID_TAG" name="RFID_TAG" value="{{$item->RFID_TAG}}">
                        <div class="py-10  col-span-1 max-[600px]:col-span-2">
                            @if($item->image)
                                <img src="" id="image" class="w-[50%] h-auto rounded-lg  mx-auto">
                            @else
                                <img src="{{ asset('img/livestock_default.png') }}" id="normalImage" class="w-[50%] h-auto rounded-lg  mx-auto">

                            @endif
                        </div>
                        <div class="py-10 mt-10 ml-10 col-span-1 max-[1250px]:mt-0 max-[600px]:col-span-2 text-center">
                            <h1 class="form-title font-bold text-2xl text-green-950 uppercase pb-2 w-full whitespace-nowrap">Body Measurement</h1>

                            <div class="flex flex-row gap-1 w-full mt-4">
                                <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Body Weight:</h1>
                                <span class="md:text-xl text-md" id="weight1"></span>
                            </div>
                            <div class="flex flex-row gap-1 w-full mt-4">
                                <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Body Lenght:</h1>
                                <span class="md:text-xl text-md" id="length"></span>
                            </div>
                            <div class="flex flex-row gap-1 w-full mt-4">
                                <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Wither Height:</h1>
                                <span class="md:text-xl text-md" id="wither"></span>
                            </div>
                        </div>
                    </div>
                    <div id="resultContainer"></div>
                @endforeach
            @endif

            <dialog id="addProgress" class="w-2/3 max-[1250px]:w-full px-5 backdrop:bg-black backdrop:opacity-80 rounded-2xl">
                <div class="flex justify-between">
            
                    <button onclick="addProgress.close()">
                        <div class="add bg-orange-500 hover:bg-orange-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                            <i class='bx bx-x'></i>
                        </div>
                    </button>
            
                    <button type="submit" form="progressForm">
                        <div class="add bg-green-500 hover:bg-green-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                            <i class='bx bx-save'></i>
                        </div>
                    </button>
                
                </div>

                <form action="{{route('livestock.progress.store')}}" method="POST" enctype="multipart/form-data" id="progressForm" >
                    @csrf
                    @foreach ($progress as $item)
                        <div class="form-container border-t-[2px] my-5 grid grid-cols-2">
                            <h1 class="form-title font-bold text-3xl text-green-950 uppercase my-3 w-full text-center col-span-2">Add Progress Information</h1>
                            <input type="hidden" name="RFID_TAG" value="{{$item->RFID_TAG}}">
                            <div class="col-span-1 mt-10 max-[800px]:col-span-2">
                                <label for="addImage">
                                    <img src="{{asset('img/add_goat.png')}}" class="w-[50%] h-auto rounded-full  mx-auto" id="originalImage">
                                </label>
                                <input type="file" id="addImage" name="image" class="hidden" accept=".png,.jpeg,.jpg,.webp">

                            </div>


                            <div class="col-span-1 mt-16 max-[800px]:col-span-2">
                                <h1 class="form-title font-bold text-2xl text-green-950 uppercase pb-2 w-full whitespace-nowrap text-center">Body Measurement</h1>

                                <div class="flex flex-col sm:px-10 px-5 mb-1">
                                    <h1 class="text-left mb-2 w-full text-green-950">Progress Date</h1>
                                    <input type="date" autocomplete="off" name="date" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter breed type">
                                    @error('date')
                                        <p class="text-red-500 w-full text-sm py-3 ml-3">
                                            {{$message}}
                                        </p>
                                    @enderror
                                </div>
                                <div class="flex flex-col sm:px-10 px-5 mb-1">
                                    <h1 class="text-left mb-2 w-full text-green-950">Body Weight</h1>
                                    <input type="text" autocomplete="off" placeholder="Enter the body weight" name="weight" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter breed type">
                                    @error('weight')
                                        <p class="text-red-500 w-full text-sm py-3 ml-3">
                                            {{$message}}
                                        </p>
                                    @enderror
                                </div>
                                <div class="flex flex-col sm:px-10 px-5 mb-1">
                                    <h1 class="text-left mb-2 w-full text-green-950">Body Length</h1>
                                    <input type="text" autocomplete="off" placeholder="Enter the body length" name="length" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter breed type">
                                    @error('length')
                                        <p class="text-red-500 w-full text-sm py-3 ml-3">
                                            {{$message}}
                                        </p>
                                    @enderror
                                </div>
                                <div class="flex flex-col sm:px-10 px-5 mb-1">
                                    <h1 class="text-left mb-2 w-full text-green-950">Wither Height</h1>
                                    <input type="text" autocomplete="off" placeholder="Enter the wither height" name="wither" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter breed type">
                                    @error('wither')
                                        <p class="text-red-500 w-full text-sm py-3 ml-3">
                                            {{$message}}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        
                        </div>
                    @endforeach
                </form>
            
            </dialog>

            <dialog id="editProgress" class="w-2/3 max-[1250px]:w-full px-5 backdrop:bg-black backdrop:opacity-80 rounded-2xl">
                <div class="flex justify-between">
            
                    <button onclick="editProgress.close()">
                        <div class="add bg-orange-500 hover:bg-orange-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                            <i class='bx bx-x'></i>
                        </div>
                    </button>
            
                    <button type="submit" form="progressEditForm">
                        <div class="add bg-green-500 hover:bg-green-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                            <i class='bx bx-save'></i>
                        </div>
                    </button>
                
                </div>

                <form action="{{route('livestock.progress.edit')}}" method="POST" enctype="multipart/form-data" id="progressEditForm" >
                    @csrf
                    @foreach ($progress as $item)
                        <div class="form-container border-t-[2px] my-5 grid grid-cols-2">
                            <h1 class="form-title font-bold text-3xl text-green-950 uppercase my-3 w-full text-center col-span-2">Edit Progress Information</h1>
                            <input type="hidden" name="RFID_TAG" id="RFID_TAG_EDIT">
                            <input type="hidden" name="PID" id="PID">
                            <div class="col-span-1 mt-10 max-[800px]:col-span-2">
                                <label for="editImage">
                                    <img src="" class="w-[50%] h-auto rounded-full  mx-auto" id="originalImageEdit">
                                </label>
                                <input type="file" id="editImage" name="image" class="hidden" accept=".png,.jpeg,.jpg,.webp">

                            </div>


                            <div class="col-span-1 mt-16 max-[800px]:col-span-2">
                                <h1 class="form-title font-bold text-2xl text-green-950 uppercase pb-2 w-full whitespace-nowrap text-center">Body Measurement</h1>
                                <div class="flex flex-col sm:px-10 px-5 mb-1">
                                    <h1 class="text-left mb-2 w-full text-green-950">Progress Date</h1>
                                    <input type="date" id="dateEdit" autocomplete="off" name="date" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter breed type">
                                    @error('date')
                                        <p class="text-red-500 w-full text-sm py-3 ml-3">
                                            {{$message}}
                                        </p>
                                    @enderror
                                </div>
                                <div class="flex flex-col sm:px-10 px-5 mb-1">
                                    <h1 class="text-left mb-2 w-full text-green-950">Body Weight</h1>
                                    <input type="text" id="weightEdit" autocomplete="off" placeholder="Enter the body weight" name="weight" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter breed type">
                                    @error('weight')
                                        <p class="text-red-500 w-full text-sm py-3 ml-3">
                                            {{$message}}
                                        </p>
                                    @enderror
                                </div>
                                <div class="flex flex-col sm:px-10 px-5 mb-1">
                                    <h1 class="text-left mb-2 w-full text-green-950">Body Length</h1>
                                    <input type="text" id="lengthEdit" autocomplete="off" placeholder="Enter the body length" name="length" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter breed type">
                                    @error('length')
                                        <p class="text-red-500 w-full text-sm py-3 ml-3">
                                            {{$message}}
                                        </p>
                                    @enderror
                                </div>
                                <div class="flex flex-col sm:px-10 px-5 mb-1">
                                    <h1 class="text-left mb-2 w-full text-green-950">Wither Height</h1>
                                    <input type="text" id="witherEdit" autocomplete="off" placeholder="Enter the wither height" name="wither" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter breed type">
                                    @error('wither')
                                        <p class="text-red-500 w-full text-sm py-3 ml-3">
                                            {{$message}}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        
                        </div>
                    @endforeach
                </form>
            
            </dialog>

            {{-- <dialog id="progressThree" class="w-2/3 max-[1250px]:w-full px-5 backdrop:bg-black backdrop:opacity-80 rounded-2xl">
                <div class="flex justify-between">
            
                    <button onclick="progressThree.close()">
                        <div class="add bg-orange-500 hover:bg-orange-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                            <i class='bx bx-x'></i>
                        </div>
                    </button>
            
                    <button type="submit" form="progressThreeForm">
                        <div class="add bg-green-500 hover:bg-green-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                            <i class='bx bx-save'></i>
                        </div>
                    </button>
                
                </div>

                <form action="{{route('livestock.progress.edit')}}" method="POST" enctype="multipart/form-data" id="progressThreeForm" >
                    @csrf
                    <div class="form-container border-t-[2px] my-5 grid grid-cols-2">
                        <h1 class="form-title font-bold text-3xl text-green-950 uppercase my-3 w-full text-center col-span-2">Three Months Progress Information</h1>
                        <input type="hidden" name="timeline" value="ThreeMonth">
                        <input type="hidden" name="old_image_three" value="{{$livestock->progress->three_month_image ?? ""}}">
                        <input type="hidden" name="RFID_TAG" value="{{$livestock->RFID_TAG}}">
                        <div class="col-span-1 mt-10 max-[800px]:col-span-2">
                            <label for="three_month_image">
                                @if($livestock->progress->three_month_image)
                                    <img src="{{$livestock->progress->three_month_image}}" class="w-[50%] h-auto rounded-full  mx-auto" id="three-month">
                                @else
                                    <img src="{{asset('img/add_goat.png')}}" class="w-[50%] h-auto rounded-full  mx-auto" id="three-month">
                                @endif
                            </label>
                            <input type="file" id="three_month_image" name="three_month_image" class="hidden" accept=".png,.jpeg,.jpg,.webp">

                        </div>


                        <div class="col-span-1 mt-16 max-[800px]:col-span-2">
                            <h1 class="form-title font-bold text-2xl text-green-950 uppercase pb-2 w-full whitespace-nowrap text-center">Body Measurement</h1>

                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">Body Weight</h1>
                                <input type="text" autocomplete="off" value="{{ $livestock->progress->three_month_weight ?? '' }}" name="three_month_weight" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter breed type">
                                @error('three_month_weight')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">Body Length</h1>
                                <input type="text" autocomplete="off" value="{{ $livestock->progress->three_month_length ?? '' }}" name="three_month_length" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter breed type">
                                @error('three_month_length')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">Wither Height</h1>
                                <input type="text" autocomplete="off" value="{{ $livestock->progress->three_month_wither ?? '' }}" name="three_month_wither" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter breed type">
                                @error('three_month_wither')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    
                    </div>
                    
                </form>
            
            </dialog> --}}
        </div>


    </div>

    <div x-show="progressView === 'Graph'" class="col-span-4 flex flex-col w-full overflow-scroll" x-data="{ graphFilter: $persist('') }">
        <select class="rounded-lg" x-model="graphFilter" @change="updateGraph()" id="selectFilter">
            <option value="Yearly">Yearly</option>
            <option value="Monthly">Monthly</option>
            <option value="Custom">Custom Range</option>
        </select>

        <div class="p-10 w-full flex flex-row items-center gap-4 flex-wrap" x-show="graphFilter === 'Monthly'">
            <label for="monthFilter" class="text-lg font-bold uppercase">Select a year:</label>
            <input id="monthFilter" type="number" min="1900" max="2099" step="1" value="2023" class="w-1/2 rounded-full" onchange="handleMonthlyChange()"/>
        </div>
        <div class="p-10 w-full flex flex-row items-center gap-4 flex-wrap" x-show="graphFilter === 'Custom'">
            <div class="flex flex-col justify-start flex-1">
                <label for="dateFrom" class="text-lg font-bold uppercase">Date from:</label>
                <input id="dateFrom" type="date" class="w-full rounded-full" onchange="handleDateChange()"/>
            </div>
            <div class="flex flex-col justify-start flex-1">
                <label for="dateTo" class="text-lg font-bold uppercase">Date to:</label>
                <input id="dateTo" type="date" class="w-full rounded-full" onchange="handleDateChange()"/>
            </div>
        </div>

        <div class="w-full mt-5 max-[1250px]:w-[900px] max-[500px]:w-[600px]">
            <div class="w-full overflow-x-scroll">
                <canvas id="chartId" aria-label="chart" class="w-full"></canvas>
            </div>
        </div>

        <button id="downloadButtonProgress" class="w-full flex flex-row items-center justify-center gap-4 bg-green-900 hover:bg-green-700 duration-200 text-white font-bold py-2.5 rounded-lg"><i class='bx bxs-download text-xl'></i> Download Graph</button>
    </div>
    
</div>


<script>
    document.getElementById("addImage").onchange = function(){
        document.getElementById('originalImage').src = URL.createObjectURL(addImage.files[0]);
    }
    document.getElementById("editImage").onchange = function(){
        document.getElementById('originalImage').src = URL.createObjectURL(editImage.files[0]);
    }
</script>

<script>

    $(document).ready(function() {
        let jsProg = @json($progress);
        updateElementText('weight1', jsProg['data'][0]['weight'] + " kg");
        updateElementText('wither', jsProg['data'][0]['wither']+ " kg");
        updateElementText('length', jsProg['data'][0]['length']+ " kg");
        updateElementSrc('image', jsProg['data'][0]['image']);
        updateElementSrc('originalImageEdit', jsProg['data'][0]['image']);
        updateElementInput('RFID_TAG_EDIT', jsProg['data'][0]['RFID_TAG']);
        updateElementInput('PID', jsProg['data'][0]['PID']);
    });

    function updateElementText(elementId, text) {
        $('#' + elementId).text(text);
    }
    function updateElementSrc(elementId, text) {
        $('#' + elementId).attr('src', text);
    }
    function updateElementInput(elementId, newValue) {
        $('#' + elementId).val(newValue); // Set the value directly
    }

    let select = $('#multi-select');
    let RFID_TAG = $('#RFID_TAG').val();

    select.on('change', () => {
        const selectValues = select.val(); // Assuming select.val() returns an array
        const dateFilterValue = [];

        for (let i = 0; i < selectValues.length; i++) {
            dateFilterValue.push(selectValues[i]);
        }

        $.ajax({
            url: '/progressAjax',
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                'RFID_TAG': RFID_TAG,
                'dateFilterValue': dateFilterValue, 
                'action': "overview", 
            },
            success: function (result) {
                updateElementText('weight1', result['progress'][0]['weight'] + " kg");
                updateElementText('wither', result['progress'][0]['wither']+ " kg");
                updateElementText('length', result['progress'][0]['length']+ " kg");

                var defaultImagePath = "{{ asset('img/livestock_default.png') }}";
                var defaultImagePath2 = "{{asset('img/add_goat.png')}}";

                if(result['progress'][0]['image'] == ""){
                    updateElementSrc('image', defaultImagePath);
                    updateElementSrc('normalImage', defaultImagePath);
                } else if(result['progress'][0]['image'] == null){
                    updateElementSrc('image', defaultImagePath);
                    updateElementSrc('normalImage', defaultImagePath);
                }else {
                    updateElementSrc('image', result['progress'][0]['image']);
                    updateElementSrc('normalImage', result['progress'][0]['image']);
                }
                
                
                updateElementInput('dateEdit', result['progress'][0]['date'])
                updateElementInput('weightEdit', result['progress'][0]['weight'])
                updateElementInput('lengthEdit', result['progress'][0]['length'])
                updateElementInput('witherEdit', result['progress'][0]['wither'])
                updateElementInput('PID',  result['progress'][0]['PID']);

                if(result['progress'][0]['image'] == ""){
                    updateElementSrc('originalImageEdit', defaultImagePath2);
                } else if(result['progress'][0]['image'] == null){
                    updateElementSrc('originalImageEdit', defaultImagePath2);
                }else {
                    updateElementSrc('originalImageEdit', result['progress'][0]['image']);
                }
            },
            error: function (e) {
                console.log(e);
            }
        });
    });
</script>


<script>
    var x = [];
    var weight = []
    var length = []
    var height = []

    var chrt = document.getElementById("chartId");

    var charts = new Chart(chrt, {
        type: "line",
        data: {
            labels: x,
            datasets: [{
                data: weight,
                borderColor: "red",
                fill: false,
                label: "Body Weight",
                pointStyle: 'circle',
                pointRadius: 5,
                pointHoverRadius: 15,
                tension: 0.2
            },{
                data: length,
                borderColor: "green",
                fill: false,
                label: "Body Length",
                pointStyle: 'circle',
                pointRadius: 5,
                pointHoverRadius: 15,
                tension: 0.2
            },{
                data: height,
                borderColor: "blue",
                fill: false,
                label: "Wither Height",
                pointStyle: 'circle',
                pointRadius: 5,
                pointHoverRadius: 8,
                tension: 0.2
            },]
        },
        options: {
            legend: {display: true},
            maintainAspectRation: false,
            responsive: true,
        }
    });



    function handleDateChange() {
        let jsProg = @json($progress);
        const dateFrom = $('#dateFrom').val();
        const dateTo = $('#dateTo').val();
        const RFID_TAG = jsProg['data'][0]['RFID_TAG'];
        
        function formatDate(originalDate) {
            var date = new Date(originalDate);
            var options = { year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString(undefined, options);
        }


        $.ajax({
                url: '/progressAjax',
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    'RFID_TAG': RFID_TAG,
                    'dateFrom': dateFrom,
                    'dateTo': dateTo,
                    'action': "graph", 
                    'filter': "Custom",
                },success:function(result){
                    x = [];
                    weight = [];
                    length = [];
                    height = [];

                    for (var i = 0; i < result.success.length; i++) {
                        var originalDate = result.success[i].date;
                        var formattedDate = formatDate(originalDate);
                        x.push(formattedDate);

                        var newweight = result.success[i].weight;
                        var newlength = result.success[i].length;
                        var newwither = result.success[i].wither;

                        weight.push(newweight);
                        length.push(newlength);
                        height.push(newwither);
                    }

                    charts.data.labels = x;
                    charts.data.datasets[0].data = weight;
                    charts.data.datasets[1].data = length;
                    charts.data.datasets[2].data = height;

                    charts.update();
                },error:function(e){
                    console.log(e);
                }
            })
    }
    
    function handleMonthlyChange(){
        let jsProg = @json($progress);
        const year = $('#monthFilter').val();
        const RFID_TAG = jsProg['data'][0]['RFID_TAG'];

        $.ajax({
                url: '/progressAjax',
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    'RFID_TAG': RFID_TAG,
                    'year': year,
                    'action': "graph", 
                    'filter': "Monthly",
                },success:function(result){
                    console.log(result);      
                    x = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November"];
                    weight = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                    length = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                    height = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

                    // console.log(result.success[0].avg_weight)

                    for (var i = 0; i < result.success.length; i++) {

                        weight[result.success[i].month - 1] = result.success[i].avg_weight;
                        length[result.success[i].month - 1] = result.success[i].avg_length;
                        height[result.success[i].month - 1] = result.success[i].avg_wither;

                    }

                    charts.data.labels = x;
                    charts.data.datasets[0].data = weight;
                    charts.data.datasets[1].data = length;
                    charts.data.datasets[2].data = height;

                    charts.update();
                },error:function(e){
                    console.log(e);
                }
            })
    }

    function ajaxYearly(){
        let jsProg = @json($progress);
        const RFID_TAG = jsProg['data'][0]['RFID_TAG'];
        // console.log("Access Granmted");
        $.ajax({
                url: '/progressAjax',
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    'RFID_TAG': RFID_TAG,
                    'action': "graph", 
                    'filter': "Yearly",
                },success:function(result){

                    console.log(result);

                    x = [];
                    weight = [];
                    length = [];
                    height = [];


                    var datas = result.success;

                    for (var i = 0; i < datas.length; i++) {
                        x.push(datas[i].year);
                        weight.push(datas[i].avg_weight);
                        length.push(datas[i].avg_length);
                        height.push(datas[i].avg_wither);
                    }
                   
                    charts.data.labels = x;
                    charts.data.datasets[0].data = weight;
                    charts.data.datasets[1].data = length;
                    charts.data.datasets[2].data = height;

                    charts.update();
                },error:function(e){
                    console.log(e);
                }
            })
    }

    $('#selectFilter').on('change', () => {
        if($('#selectFilter').val() == "Yearly"){
            ajaxYearly();
        }
    })

    $(document).ready(function() {
        if($('#selectFilter').val() == "Yearly"){
            ajaxYearly();
        }
    })

    function updateGraph() {
        const selectedValue = this.graphFilter;
    }

    document.getElementById('downloadButtonProgress').addEventListener('click', function () {
        html2canvas(document.querySelector('#chartId'), {
            scale: 5, // Increase scale for better quality
        }).then(canvas => {
            var link = document.createElement('a');
            link.href = canvas.toDataURL();
            link.download = 'line_graph_progress.png';
            link.click();
        });
    });
 </script>