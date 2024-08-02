
<!-- Add these script tags to include the required libraries -->
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>


@include('partials.__header')
{{-- @include('partials.__loader') --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<x-sidebar/>

<style>
    body{
        background-color: #f4f4f4;
        font-family: 'Lato', sans-serif;
        min-height: 100vh;
        /* overflow-y: scroll; */
    }

    .legendColor{
        color: white;
        padding-left: 2rem;
        padding-right: 2rem;
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
        text-align: center;
        font-size: 1.5rem;
        border-radius: 1.5rem;
        white-space: nowrap;
        width: 100%;
    }

    .legendColor:nth-child(1){

        background-color: #5F6C37;
    }
    .legendColor:nth-child(2){
        background-color: #BC6C25;
    }

    .draggable-item {
        transition: transform 0.2s ease; /* Add a smooth transition for the transform property */
    }

    .dragging {
        transform: scale(1.1); /* Apply a scale transformation when dragging */
        z-index: 2; /* Bring the dragging element to the top */
    }


    @media screen and (min-width: 1350px) and (max-width: 1600px) {
        .total {
            font-size: 1.25rem;
        }
    }

    @media (max-width: 1350px) {
        .top-row {
            grid-column: span 2;
        }
    }

    @media (max-width: 650px) {
        .main-container {
            width: 90%;
        }

        .total {
            font-size: calc(100% + 5px);
            margin-top: 10px;
        }

        .image{
            margin-top: 1rem;
        }
        .programming-stats{
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }
    }

    @media (max-width: 800px) {
        .top-row {
            grid-column: span 2;
        }
        .main-container{
            margin-left: .5rem !important;
            margin-top: 0px !important;
        }
    }
</style>

<div class="flex items-center justify-center">
    <div class="main-container w-[80%] ml-20 mt-10 py-10 bg-opacity-30 rounded-3xl" id="main_container"> 

        <div class="grid grid-cols-2 gap-8">
            
            {{-- Grid Section --}}
            <div class="grid grid-cols-2 col-span-2 gap-8" id="grid-section">
                {{-- 2x2 --}}
                <div class="grid grid-cols-2 max-[550px]:grid-cols-1 w-full gap-3 col-span-1 top-row" id="outer-container">
                    
                    <div class="relative flex items-center justify-center count-container draggable-item">
                        <div class="bg-[#f4f8e7] hover:bg-[#e6f1c1] cursor-pointer w-full border-b-[20px] border-accent rounded-2xl px-2 py-4 flex flex-col relative" style="box-shadow: 0px 4px 9px 5px rgba(0, 0, 0, 0.25);">
                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute mt-5 opacity-25" width="150" height="150" viewBox="0 0 32 32"><g fill="none"><g fill="rgba(68, 68, 68, 0.26666666666666666)" clip-path="url(#fluentEmojiHighContrastGoat0)"><path d="m8.78 10.43l1.79-.89l1.3 2.54c.2.39-.1.87-.54.84c-.79-.05-1.58-.57-1.94-1.28l-.61-1.21Zm-1.28 1c-.28 0-.5-.22-.5-.5v-.75c0-.28.22-.5.5-.5s.5.22.5.5v.75c0 .28-.22.5-.5.5Z"/><path d="m24.01 27.316l.99.708v1.666A2.312 2.312 0 0 0 27.31 32h2.38A2.312 2.312 0 0 0 32 29.69v-5.04a3.534 3.534 0 0 0-1.051-2.519L30 21.182V12a4 4 0 0 0-2.7-3.781a2.509 2.509 0 0 0-2.263.328A2.457 2.457 0 0 0 24 10.57V11h-8.764l-1.757-3.515a4.538 4.538 0 0 0-1.007-1.316A3.22 3.22 0 0 1 13.5 6c.616 0 1.19.188 1.674.507A.851.851 0 0 0 16.5 5.8a.899.899 0 0 0-.173-.52l-.014-.02l-.015-.017A5.005 5.005 0 0 0 12.5 3.5c-1.354 0-2.57.587-3.463 1.5H6.91a4.218 4.218 0 0 0-2.96 1.226L.9 9.276A3.04 3.04 0 0 0 0 11.44a3.564 3.564 0 0 0 1.67 3.015v1.305c0 .68.55 1.24 1.24 1.24h.59v-2h.291l1.501 5.9A5.957 5.957 0 0 0 8 24.346v5.334A2.318 2.318 0 0 0 10.31 32h2.38A2.312 2.312 0 0 0 15 29.69v-1.907A4.787 4.787 0 0 0 16 25h3v3.378c0 .168-.03.326-.1.472l-1.67 2.644c-.1.236.05.506.28.506h3.03c.3 0 .57-.157.75-.427l2.41-2.476c.2-.303.31-.675.31-1.057v-.724ZM7.699 7.315c-.272.966.467 1.905 1.451 1.905c.698 0 1.288-.483 1.463-1.141l.002-.006c.056-.224.143-.435.255-.63c.347.239.629.56.82.937l1.79 3.579A1.868 1.868 0 0 0 15.16 13h10.839v-2.43a.474.474 0 0 1 .2-.395a.539.539 0 0 1 .463-.061A2 2 0 0 1 28 12v10.01l1.545 1.545A1.531 1.531 0 0 1 30 24.65V28h-3v-1l-5.588-4H14v1.85a2.79 2.79 0 0 1-.736 1.892l-.264.287V28h-3v-4.935l-.611-.257A3.9 3.9 0 0 1 7.21 20.33l-1.72-6.76l.01-4.309V9.26c0-.507-.245-.914-.596-1.164l.456-.456c.412-.409.97-.639 1.55-.64h.887a4.986 4.986 0 0 0-.098.315ZM30 29v.7a.31.31 0 0 1-.31.31h-2.38a.31.31 0 0 1-.31-.31V29h3Zm-20 .68V29h3v.69a.31.31 0 0 1-.31.31h-2.38a.314.314 0 0 1-.31-.32ZM2.31 10.69l1.852-1.852a.433.433 0 0 1 .338.422L4.492 13H3.56a1.562 1.562 0 0 1-1.455-1h.955c.64-.04.6-1-.04-1H2.1a.93.93 0 0 0-.07.183a1.056 1.056 0 0 1 .28-.493Z"/></g><defs><clipPath id="fluentEmojiHighContrastGoat0"><path fill="#fff" d="M0 0h32v32H0z"/></clipPath></defs></g></svg>
                            <div class="flex flex-row w-full justify-evenly">
                                <h1 class="text-2xl font-light text-center uppercase total">Herd Count</h1>
                            </div>                
                            <div class="flex-grow w-full py-12 mt-2 border-t border-gray-300">
                                <h1 class="text-6xl max-[500px]:text-4xl text-center">{{$herd_count}}</h1>
                            </div>
                        </div>
                    </div>
                
                    <!-- Death Percentage Container -->
                    <div class="relative flex items-center justify-center count-container draggable-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute mt-20 ml-10 opacity-25" width="200" height="200" viewBox="0 0 32 32"><g fill="none"><g fill="rgba(68, 68, 68, 0.26666666666666666)" clip-path="url(#fluentEmojiHighContrastGoat0)"><path fill="rgba(68, 68, 68, 0.26666666666666666)" d="M8 22L5 8l3-6h8l3 6l-3 14H8m3-16v2H9v2h2v5h2v-5h2V8h-2V6h-2Z"/></svg>
                        <div class="bg-[#f4f8e7] hover:bg-[#e6f1c1] cursor-pointer w-full border-b-[20px] border-accent rounded-2xl px-2 py-4 flex flex-col" style="box-shadow: 0px 4px 9px 5px rgba(0, 0, 0, 0.25);">
                            <div class="flex flex-row w-full justify-evenly">
                                <h1 class="text-2xl font-light text-center uppercase total">Death Percentage</h1>
                            </div>
                            <div class="flex-grow w-full py-12 mt-2 border-t border-gray-300">
                                <h1 class="text-6xl max-[500px]:text-4xl text-center">{{$death_percent}} %</h1>
                            </div>
                        </div>
                    </div>
                
                    <!-- Kid Count Container -->
                    <div class="relative flex items-center justify-center count-container draggable-item">

                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute opacity-25" width="150" height="150" viewBox="0 0 512 512"><path fill="rgba(68, 68, 68, 0.26666666666666666)" d="M256 41c-20.794 0-44.2 5.78-63.58 17.39l.02-.097c-.22.156-.446.327-.667.484c-6.127 3.73-11.838 8.045-16.923 12.955c-23.71 19.373-47.905 44.71-60.37 72.948c8.37-4.155 16.365-9.44 24.41-14.576c-7.315 12.505-12.044 25.924-11.728 40.148c5.928-5.75 14.24-14.91 23.656-23.375c1.76 12.773 5.742 26.938 12.49 42.68l1.772 4.138l-14.135 24.522L176 243.273l17.398-17.4l24.973 37.46l7.51-53.526l92.542 51.045l59.848-59.848c6.983-28.36 2.508-55.906-8.856-80.26C347.812 74.447 299.554 41 256 41zm178.535 22.518l-67.35 19.24c7.213 9.367 13.49 19.55 18.54 30.375c4.977 10.666 8.705 21.998 10.947 33.763l58.512-43.18l-57.584 2.608l36.935-42.806zM295.12 94.525l17.76 2.95s-1.25 7.662-4.126 16.035c-1.438 4.186-3.263 8.626-5.897 12.746c-2.633 4.12-6.164 8.334-12.01 10.283c-5.848 1.948-11.2.694-15.78-1.022c-4.577-1.716-8.704-4.172-12.366-6.66c-7.323-4.972-12.92-10.352-12.92-10.352l12.44-13.012s4.745 4.505 10.592 8.475c2.924 1.984 6.092 3.764 8.575 4.694c2.482.93 3.958.734 3.767.797c-.19.064 1.108-.664 2.535-2.897c1.427-2.234 2.893-5.56 4.04-8.9c2.296-6.685 3.39-13.138 3.39-13.138zM384 220.727l-62.422 62.42l-81.504-44.954l-10.445 74.475l-39.028-58.54l-14.602 14.6l-33.777-33.777l-52.444 26.224c7.958 61.16 20 117.686 43.968 158.248C158.542 461.382 194.625 487 256 487c61.375 0 97.458-25.62 122.252-67.578c24.226-40.998 36.277-98.293 44.232-160.21L384 220.726z"/></svg>
                        <div class="bg-[#f4f8e7] hover:bg-[#e6f1c1] cursor-pointer w-full border-b-[20px] border-accent rounded-2xl px-2 py-4 flex flex-col " style="box-shadow: 0px 4px 9px 5px rgba(0, 0, 0, 0.25);">
                            <div class="flex flex-row w-full justify-evenly">
                                <h1 class="text-2xl font-light text-center uppercase total">Kid Count</h1>
                            </div>
                            <div class="flex-grow w-full py-12 mt-2 border-t border-gray-300">
                                <h1 class="text-6xl max-[500px]:text-4xl text-center">{{$kid_count}}</h1>
                            </div>
                        </div>
                    </div>
                
                    <!-- Sold Herd Count Container -->
                    <div class="relative flex items-center justify-center count-container draggable-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute mt-10 ml-10 opacity-25" width="200" height="200" viewBox="0 0 32 32"><g fill="none"><g fill="rgba(68, 68, 68, 0.26666666666666666)" clip-path="url(#fluentEmojiHighContrastGoat0)"><path fill="rgba(68, 68, 68, 0.26666666666666666)" d="M12 12.5a3.5 3.5 0 1 0 0 7a3.5 3.5 0 0 0 0-7ZM10.5 16a1.5 1.5 0 1 1 3 0a1.5 1.5 0 0 1-3 0Z"/><path fill="rgba(68, 68, 68, 0.26666666666666666)" d="M17.526 5.116L14.347.659L2.658 9.997L2.01 9.99V10H1.5v12h21V10h-.962l-1.914-5.599l-2.098.715ZM19.425 10H9.397l7.469-2.546l1.522-.487L19.425 10ZM15.55 5.79L7.84 8.418l6.106-4.878l1.604 2.25ZM3.5 18.169v-4.34A3.008 3.008 0 0 0 5.33 12h13.34a3.009 3.009 0 0 0 1.83 1.83v4.34A3.009 3.009 0 0 0 18.67 20H5.332A3.01 3.01 0 0 0 3.5 18.169Z"/></svg>
                        <div class="bg-[#f4f8e7] hover:bg-[#e6f1c1] cursor-pointer w-full border-b-[20px] border-accent rounded-2xl px-2 py-4 flex flex-col" style="box-shadow: 0px 4px 9px 5px rgba(0, 0, 0, 0.25);">
                            <div class="flex flex-row w-full justify-evenly">
                                <h1 class="text-2xl font-light text-center uppercase total">Sold Herd Count</h1>
                            </div>
                            <div class="flex-grow w-full py-12 mt-2 border-t border-gray-300">
                                <h1 class="text-6xl max-[500px]:text-4xl text-center">{{$sold_count}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
    
                {{-- Pie Chart --}}
                <div id="pieChartCon" class="bg-[#f4f8e7] relative w-full border-b-[20px] border-accent rounded-2xl px-5 md:pt-14 pt-5 pb-5 col-span-1 top-row" style="box-shadow: 0px 4px 9px 5px rgba(0, 0, 0, 0.25);">
                    <div class="grid w-full grid-cols-2 programming-stats">
                    <button id="downloadButton" class="absolute max-[550px]:relative right-5 top-5 text-right col-span-2 px-2 py-1 text-4xl text-green-800"><i class='bx bxs-download'></i></button>

                        <div class="col-span-2 w-1/2 max-[550px]:w-full mx-auto">
                            <h1 class="text-[#273617] font-bold uppercase text-4xl border-b-[1px] pb-3 px-10 whitespace-nowrap">Population</h1>
                            <canvas class="w-full mt-4 pie-chart whitespace-nowrap"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Line Chart --}}
            <div id="line-graph-section" class="bg-[#f4f8e7] relative  w-full border-b-[20px] border-accent rounded-2xl p-5 col-span-2 overflow-x-scroll" style="box-shadow: 0px 4px 9px 5px rgba(0, 0, 0, 0.25);">
                
                <div class="flex flex-col px-5 py-5">
                    <div class="details mb-4 flex flex-col w-full max-[1250px]:w-[900px] max-[500px]:w-[600px] mx-auto">
                        <div class="flex flex-row w-full border-b border-gray-300 just">
                            <h1 class="text-[#273617] w-full font-bold uppercase text-3xl  whitespace-nowrap mb-1 pb-2">Total Milk Yield Per Goat</h1>
                            
                            <input type="month" name="month" id="monthPicker" class="outline-none rounded-xl mb-2 px-4 py-2.5">
                            <button id="downloadButtonLineGraph" class="col-span-2 px-2 py-1 text-4xl text-right text-green-800"><i class='bx bxs-download'></i></button>
                        </div>
                        <p class="mt-2 mb-3">"Total Milk Yield per Goat" is a graph that visually represents the cumulative milk production of individual goats over a specific period. This graph provides valuable insights into the overall milk output of a group of goats, helping farmers and researchers monitor productivity, make informed management decisions, and optimize their dairy operations. This graph is a vital tool for goat farmers and dairy enthusiasts, allowing them to track the performance of each goat within their herd and identify high-yield producers. It serves as a key metric for assessing the efficiency and profitability of a goat milk production operation.</p>
                    </div>
                    <div class="chart-container" style="width: 100%; overflow-x: scroll;">
                        <canvas class="line-chart" height="400px"></canvas>
                    </div>
                    
                                        
                    <div class="flex flex-col w-full max-[1250px]:w-[900px] max-[500px]:w-[600px] mx-auto">
                        <h1 class="text-[#273617] w-full font-bold uppercase text-xl mt-4" id="totalMilkID"></h1>
                    </div>

                </div>

            </div>
            
            {{-- Recently Added --}}
            <div id="table-section" class="bg-[#f4f8e7] w-full border-b-[20px] border-accent rounded-2xl p-5 col-span-2" style="box-shadow: 0px 4px 9px 5px rgba(0, 0, 0, 0.25);">
                <div class="flex flex-col px-5 py-5">
                    <div class="details">
                        <div class="flex flex-row items-center justify-between">
                            <h1 class="text-[#273617] font-bold uppercase text-3xl border-b-[1px] border-gray-300 whitespace-nowrap mb-1 pb-2">Recently Added</h1>
                            <button id="downloadButtonTable" class="col-span-2 px-2 py-1 text-4xl text-right text-green-800"><i class='bx bxs-download'></i></button>
                        </div>
                        <p class="mt-2 mb-3">This table is a structured dataset that provides essential information about the recently introduced goats into a herd. This table typically includes details such as the goat's RFID identification, name, sex, breed, birth date and status. It serves as a valuable reference for farmers and livestock managers to keep track of the latest additions to their goat population, ensuring proper care and integration into the existing herd. </p>
                    </div>
                    <div class="relative w-full mt-4 overflow-x-scroll">
                        <?php 
                            $recentlyAdded = App\Models\LivestockRegistration::whereHas('livestockInfo', function ($query) {
                                    $query->where('farm_name', Auth::user()->farm_name);
                                })->orderBy('created_at', 'desc')->limit(5)->get();    
                        ?>
                        <table class="w-full text-sm text-left rounded-lg" id="dataTable">
                            <thead class="text-sm text-black uppercase bg-gray-300 ">
                                <tr>
                                    <th scope="col" class="px-6 py-4 whitespace-nowrap ">RFID No.</th>
                                    <th scope="col" class="px-6 py-4 whitespace-nowrap">Name</th>
                                    <th scope="col" class="px-6 py-4 whitespace-nowrap">Sex</th>
                                    <th scope="col" class="px-6 py-4 whitespace-nowrap">Breed</th>
                                    <th scope="col" class="px-6 py-4 whitespace-nowrap">Birth Date</th>
                                    <th scope="col" class="px-6 py-4 whitespace-nowrap">Status</th>
                                </tr>
                            </thead>
                            <tbody class="whitespace-nowrap">
                                @if ($recentlyAdded->isEmpty())
                                    <tr class="hover:bg-gray-200">
                                        <td colspan="8" class="py-20 text-xl text-center text-gray-400">
                                            <h1>No records found!</h1>
                                        </td>
                                    </tr>
                                @else
                                    @forEach($recentlyAdded as $newLivestock)
                                    <tr class="border-b-[1px] hover:bg-gray-100 cursor-pointer" data-href="/herd/edit?livestock_id={{$newLivestock->RFID_TAG}}" target="_blank">
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                    {{$newLivestock->RFID_TAG}}
                                                </th>
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                    {{$newLivestock->livestockInfo->given_name}}
                                                </th>
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                    {{$newLivestock->livestockInfo->sex}}
                                                </th>
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                    {{$newLivestock->livestockInfo->breed}}
                                                </th>
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                    {{$newLivestock->livestockInfo->birth_date}}
                                                </th>
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                    @if($newLivestock->livestockInfo->sold_date)
                                                        Sold
                                                    @elseif($newLivestock->livestockInfo->death_date)
                                                        Dead
                                                    @else
                                                        Active
                                                    @endif
                                                </th>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

</div>

               
<script>
    let kid_count = @json($kid_goat);
    let buck_count = @json($buck_count);
    let doe_count = @json($doe_count);
    let doeling_count = @json($doeling_count);


    const pieChart = document.querySelector(".pie-chart");
    const ul = document.querySelector(".programming-stats .details ul");

    const data = {
        labels: [
            'Doe',
            'Buck',
            'Doeling',
            'Kids',
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [doe_count, buck_count, doeling_count, kid_count],
            backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)',
            'rgb(4, 127, 3)',
            ],
            hoverOffset: 4
        }]
    };

    // Pie Chart
    new Chart(pieChart, {
        type: "doughnut",
        data: data,
        options: {
            hoverBorderWidth: 0,
            plugins: {
                legend: {
                    display: true,
                },
            },
        },
    });

</script>

<script>
    let names = [];
    let total_milk = [];
    let maxMilk = 0;
    let myChart; // Define myChart variable here


    $(document).ready(function() {

        function renderChart(names, total_milk, maxMilk, overAllMilk) {

            $('#totalMilkID').text('Total Milk Yeild: ' + overAllMilk + ' Liters')

            if (names.length === 0) {
                // Set a default data point with a value of 0
                names = ['No Data'];
                total_milk = [0];
                maxMilk = 5; // Set a reasonable maximum value
            }

            const data = {
                labels: names,
                datasets: [{
                    label: 'Total Milk Yield',
                    backgroundColor: '#5F6C37',
                    borderColor: '#5F6C37',
                    data: total_milk,
                }]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    maintainAspectRatio: false, // Allow the chart to adjust to its container
                    responsive: true, // Make the chart responsive
                    animations: {
                        // Your animation settings here
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                        },
                        y: {
                            min: 0,
                            max: maxMilk + 5,
                        },
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        },
                        zoom: {
                            // Enable zooming and scrolling on the x-axis
                            zoom: {
                                wheel: {
                                    enabled: true,
                                },
                                pinch: {
                                    enabled: true,
                                },
                                mode: 'x',
                            },
                            // Limit zoom to the x-axis
                            pan: {
                                enabled: true,
                                mode: 'x',
                            },
                        },
                    },
                },
            };


            // Destroy the existing chart (if it exists)
            if (myChart) {
                myChart.destroy();
            }

            // Create a new chart with updated data
            myChart = new Chart(
                document.querySelector('.line-chart'),
                config
            );
        }

        $('#monthPicker').on('change', function() {
            const month = $('#monthPicker').val();

            $.ajax({
                url: '/milkAjax',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "month": month,
                },
                success: function(result) {
                    console.log(result.total_milk_yield);

                    let names = [];
                    let total_milk = [];
                    let maxMilk = 0;

                    for (const key in result.total_milk_yield) {
                        names.push(result.total_milk_yield[key]['given_name']);
                        total_milk.push(result.total_milk_yield[key]['tot_milk']);

                        if (maxMilk < result.total_milk_yield[key]['tot_milk']) {
                            maxMilk = result.total_milk_yield[key]['tot_milk'];
                        }
                    }
                    let overAllMilk = result.all_milk;

                    overAllMilk = parseFloat(overAllMilk.toFixed(2));        

                    
                    total_milk.sort((a, b) => parseInt(b) - parseInt(a));

                    // Call the renderChart function with updated data
                    renderChart(names, total_milk, maxMilk, overAllMilk);

                },
                error: function(error) {
                    console.log("Oops something went wrong! " + error);
                }
            });
        });

        // Initial chart rendering
        let totMilkPerNames = @json($total_milk_yield);

        let overAllMilk = @json($all_milk);
        overAllMilk = parseFloat(overAllMilk.toFixed(2));        


        for (const key in totMilkPerNames) {
            names.push(totMilkPerNames[key]['given_name']);
            total_milk.push(totMilkPerNames[key]['tot_milk']);

            if (maxMilk < totMilkPerNames[key]['tot_milk']) {
                maxMilk = totMilkPerNames[key]['tot_milk'];
            }
        }

        total_milk.sort((a, b) => parseInt(b) - parseInt(a));

        // Initial chart rendering
        renderChart(names, total_milk, maxMilk, overAllMilk);
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get all the table rows with the "data-href" attribute
        const rows = document.querySelectorAll("tr[data-href]");

        // Attach a click event listener to each row
        rows.forEach(function (row) {
            row.addEventListener("click", function (event) {
                // Prevent the default behavior of following the link
                event.preventDefault();

                // Get the URL from the "data-href" attribute of the clicked row
                const url = row.getAttribute("data-href");

                // Open the URL in a new tab or window
                window.open(url, "_blank");
            });
        });
    });
</script>
          
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

    today = yyyy + '-' + mm; // Format as yyyy-mm for input type "month"
    document.getElementById("monthPicker").setAttribute("value", today);
</script>

<script>
    // Define variables to store the dragged element and the target element
    let draggedElement = null;
    let targetElement = null;

    // Event handler for when dragging starts
    function dragStart(event) {
        draggedElement = event.target;
        event.dataTransfer.setData('text/plain', ''); // Set data to enable dragging
        draggedElement.classList.add('dragging'); // Apply the dragging class for animation
    }

    // Event handler for when a dragged element is over the outer container
    function dragOver(event) {
        event.preventDefault(); // Prevent default to allow dropping
        targetElement = event.currentTarget;
    }

    // Event handler for when a dragged element is dropped
    function drop(event) {
        if (targetElement && draggedElement) {
            // Swap the position of the dragged and target elements
            const temp = document.createElement('div');
            targetElement.parentNode.insertBefore(temp, targetElement);
            draggedElement.parentNode.insertBefore(targetElement, draggedElement);
            temp.parentNode.insertBefore(draggedElement, temp);
            temp.parentNode.removeChild(temp);
        }
        draggedElement = null;
        targetElement = null;
        // Remove the dragging class after dropping
        setTimeout(() => {
            document.querySelectorAll('.draggable-item').forEach((item) => {
                item.classList.remove('dragging');
            });
        }, 0);
    }

    // Add event listeners to the draggable items
    const draggableItems = document.querySelectorAll('.draggable-item');
    draggableItems.forEach((item) => {
        item.addEventListener('dragstart', dragStart);
        item.addEventListener('dragover', dragOver);
        item.addEventListener('drop', drop);
        item.setAttribute('draggable', 'true');
    });
</script>

<script>
    document.getElementById('downloadButton').addEventListener('click', function () {
        html2canvas(document.querySelector('.pie-chart'), {
            scale: 2, // Increase scale for better quality
        }).then(canvas => {
            var link = document.createElement('a');
            link.href = canvas.toDataURL();
            link.download = 'pie_graph.png';
            link.click();
        });
    });

    document.getElementById('downloadButtonLineGraph').addEventListener('click', function () {
        html2canvas(document.querySelector('.chart-container'), {
            scale: 2, // Increase scale for better quality
        }).then(canvas => {
            var link = document.createElement('a');
            link.href = canvas.toDataURL();
            link.download = 'line_graph.png';
            link.click();
        });
    });

    document.getElementById('downloadButtonTable').addEventListener('click', function () {
        html2canvas(document.querySelector('#dataTable'), {
            scale: 2, // Increase scale for better quality
        }).then(canvas => {
            var link = document.createElement('a');
            link.href = canvas.toDataURL();
            link.download = 'recent_added_table.png';
            link.click();
        });
    });
    
</script>

@include('partials.__footer')