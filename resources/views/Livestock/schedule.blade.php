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
    
    @media (max-width: 800px) {
        .main-container{
            margin-left: .5rem !important;
            margin-top: 0px !important;
        }
        .container{
            padding-left: 2rem;
            padding-right: 2rem;
        }
    }
</style>

<div class="flex items-center justify-center h-screen">
    <div class="main-container w-[80%] ml-20 py-10 bg-opacity-30 h-full">
        <div class="grid grid-rows-2 gap-14 h-full">
            <div class="container bg-white w-full border-b-[20px] border-accent rounded-2xl px-20 pt-10 pb-10 col-span-1s overflow-auto" style="box-shadow: 0px 4px 9px 5px rgba(0, 0, 0, 0.25);">
                <h1 class="text-4xl text-green-950 font-bold mb-4">Activities</h1>
                <hr class="border-b-[1px] border-gray-200 mb-4">
                @if($schedules->isEmpty())
                    <h1 class="py-32 text-center w-full text-lg text-gray-400">You have no activity at this time</h1>
                @else
                    @foreach ($schedules as $schedule)
                        
                            <div class="flex flex-row justify-between w-full border-b border-b-gray-200 rounded-lg p-4 hover:bg-gray-200 duration-200">
                                <a href="/herd/edit?livestock_id={{$schedule->RFID_TAG}}" target="_blank">
                                    <div class="flex-col text-left justify-normal items-start">
                                        <h1 class="text-xl font-bold uppercase">{{$schedule->event}}</h1>
                                        <div class="flex flex-row">
                                            <h1 class="uppercase text-md font-medium">{{$schedule->given_name}}</h1>
                                            <h1 class="text-md"> : {{$schedule->RFID_TAG}}</h1>
                                        </div>
                                    </div>
                                </a>    
                                <div class="ml-auto">
                                    @php
                                        $formattedDate = \Carbon\Carbon::parse($schedule->date)->format('Y-m-d');
                                        $today = \Carbon\Carbon::now()->format('Y-m-d');
                                        $tomorrow = \Carbon\Carbon::now()->addDay()->format('Y-m-d');
                                    @endphp
                                    <h1 class="uppercase text-md font-bold">
                                        @if ($formattedDate === $today)
                                            Today
                                        @elseif ($formattedDate === $tomorrow)
                                            Tomorrow
                                        @else
                                            {{ \Carbon\Carbon::parse($schedule->date)->format('F d, Y') }}
                                        @endif
                                    </h1>
                                </div>
                                <form action="/updateSched" method="POST">
                                    @csrf
                                    <input type="hidden" name="SCHED_ID" value="{{$schedule->SCHED_ID}}">
                                    <button type="submit" class="ml-8 p-2.5 bg-green-900 hover:bg-green-700 duration-200 text-white rounded-xl z-10">
                                        ✔ Done
                                    </button>
                                </form>
                                
                            </div>
                        
                  @endforeach
                @endif
            </div>
            <div class="container bg-white w-full border-b-[20px] border-accent rounded-2xl px-20 pt-10 pb-10 col-span-1s overflow-y-auto" style="box-shadow: 0px 4px 9px 5px rgba(0, 0, 0, 0.25);">
                <h1 class="text-4xl text-green-950 font-bold mb-4">Past Activities</h1>
                <hr class="border-b-[1px] border-gray-200 mb-4">
                @if($pastSchedules->isEmpty())
                    <h1 class="py-32 text-center w-full text-lg text-gray-400">You have no past activities</h1>
                @else
                    @foreach ($pastSchedules as $schedule)
                        <a href="/herd/edit?livestock_id={{$schedule->RFID_TAG}}" target="_blank">
                            <div class="flex flex-row flex-wrap justify-between w-full border-b border-b-gray-200 rounded-lg p-4 hover:bg-gray-200 duration-200">
                                <div class="flex-col text-left justify-normal items-start">
                                    <h1 class="text-xl font-bold uppercase">{{$schedule->event}}</h1>
                                    <div class="flex flex-row">
                                        <h1 class="uppercase text-md font-medium">{{$schedule->given_name}}</h1>
                                        <h1 class="text-md"> : {{$schedule->RFID_TAG}}</h1>
                                    </div>
                                </div>
                                <div class="ml-auto">
                                    @php
                                        $formattedDate = \Carbon\Carbon::parse($schedule->date)->format('Y-m-d');
                                        $today = \Carbon\Carbon::now()->format('Y-m-d');
                                        $tomorrow = \Carbon\Carbon::now()->addDay()->format('Y-m-d');
                                    @endphp
                                    <h1 class="uppercase text-md font-bold">
                                        @if ($formattedDate === $today)
                                            Today
                                        @elseif ($formattedDate === $tomorrow)
                                            Tomorrow
                                        @else
                                            {{ \Carbon\Carbon::parse($schedule->date)->format('F d, Y') }}
                                        @endif
                                    </h1>
                                </div>
                                
                            </div>
                        </a>
                    @endforeach
                    
                @endif
            </div>
        </div>
    </div>
</div>

@include('partials.__footer')