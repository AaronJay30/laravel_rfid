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

</style>

<div class="min-h-screen flex my-10 items-center justify-center">
    <div class="bg-white w-3/5 whitespace-nowrap ml-52 max-[1465px]:w-4/5 max-[1250px]:ml-20 max-[1100px]:px-4 max-[800px]:w-full max-[800px]:m-4 user-container border-b-[20px] border-accent px-10 pt-4 pb-8 bg-opacity-30 rounded-3xl max-[800px]:whitespace-normal" style="box-shadow: 0px 4px 9px 5px rgba(0, 0, 0, 0.25);"> 
        <h1 class="w-full text-center font-bold uppercase text-3xl border-b-2 border-green-900 py-4">RFID SCAN HISTORY</h1>
        
        @php
            // Sort the $rfid_history array by date in descending order
            krsort($rfid_history);
            $index = 0;

            $current_date_time = \Carbon\Carbon::now();
            $yesterday_date_time = \Carbon\Carbon::yesterday();;

        @endphp

        @foreach ($rfid_history as $date => $history)    
            <div class="whitespace-nowrap px-4 my-8">
                <span class="font-bold text-2xl text-[#273617]">
                    @if($current_date_time->format('l, F d, Y') == \Carbon\Carbon::parse($date)->format('l, F d, Y'))
                        Today - {{\Carbon\Carbon::parse($date)->format('l, F d, Y')}}
                    @elseif($yesterday_date_time->format('l, F d, Y') == \Carbon\Carbon::parse($date)->format('l, F d, Y'))
                        Yesterday - {{\Carbon\Carbon::parse($date)->format('l, F d, Y')}}
                    @else
                        {{\Carbon\Carbon::parse($date)->format('l, F d, Y')}}
                    @endif
                </span>
                <hr class="border-gray-300 mt-3">
            </div>
            @foreach ($history as $item)
                <div class="flex flex-row gap-x-16 max-[910px]:gap-x-4 px-8 py-4">
                    <div class="text-[16px] text-gray-500">
                        <span>{{$item['date']}}</span>
                    </div>
                    <div class="text-lg text-gray-600 flex gap-x-2">
                        <img src="{{asset('img/sample.png')}}" class="w-[25px] rounded-full">
                        <a href="{{url('/rfid-tags?livestock_id='. $item["RFID"])}}" class="flex flex-row gap-x-20 max-[1050px]:gap-x-12 max-[850px]:gap-x-4"><h1>MehMeh - RFID Scan </h1>
                        <h1 class="text-gray-500 text-[16px] max-[1050px]:text-[12px]">{{url('/rfid-tags/'. $item["RFID"])}}</h1></a>
                    </div>
                </div>
            @endforeach
            <?php $index += 1; ?>
        @endforeach


    </div>
</div>


@include('partials.__footer')