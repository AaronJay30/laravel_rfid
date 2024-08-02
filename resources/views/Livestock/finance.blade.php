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

<div class="min-h-screen flex items-center justify-center">
    <div class=" main-container bg-white md:w-3/4 w-4/5 user-container border-b-[20px] border-accent lg:ml-[70px] xl:ml-52 mt-5 mb-5 px-10 py-10 bg-opacity-30 rounded-3xl " style="box-shadow: 0px 4px 9px 5px rgba(0, 0, 0, 0.25);"> 
        <div class="whitespace-nowrap px-4 container-title w-full border-b border-gray-300 pb-2">
            <span class="font-bold text-[27px]  text-[#273617]">TRANSACTION HISTORY</span>
        </div>
        <div class="flex flex-row justify-evenly flex-wrap items-center w-full p-4">
            <div class="p-4 bg-accent flex flex-row flex-wrap items-center justify-evenly rounded-2xl drop-shadow-lg w-1/3">
                <svg xmlns="http://www.w3.org/2000/svg" width="58" height="58" viewBox="0 0 48 48"><g fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"><path d="M39 6H9a3 3 0 0 0-3 3v30a3 3 0 0 0 3 3h30a3 3 0 0 0 3-3V9a3 3 0 0 0-3-3Z"/><path d="m21 31l5 4l8-10M14 15h20m-20 8h8"/></g></svg>
                <div class="text-right flex flex-col justify-end">
                    <h1 class="font-bold text-white text-xl uppercase">Total Transaction</h1>
                    <span class="text-white text-xl uppercase">{{$buyersCount}}</span>
                </div>
            </div>
            <div class="p-4 bg-accent flex flex-row flex-wrap items-center justify-evenly rounded-2xl drop-shadow-lg w-1/3">
                <svg xmlns="http://www.w3.org/2000/svg" width="58" height="58" viewBox="0 0 24 24"><path fill="#fff" d="M12 12.5a3.5 3.5 0 1 0 0 7a3.5 3.5 0 0 0 0-7ZM10.5 16a1.5 1.5 0 1 1 3 0a1.5 1.5 0 0 1-3 0Z"/><path fill="#fff" d="M17.526 5.116L14.347.659L2.658 9.997L2.01 9.99V10H1.5v12h21V10h-.962l-1.914-5.599l-2.098.715ZM19.425 10H9.397l7.469-2.546l1.522-.487L19.425 10ZM15.55 5.79L7.84 8.418l6.106-4.878l1.604 2.25ZM3.5 18.169v-4.34A3.008 3.008 0 0 0 5.33 12h13.34a3.009 3.009 0 0 0 1.83 1.83v4.34A3.009 3.009 0 0 0 18.67 20H5.332A3.01 3.01 0 0 0 3.5 18.169Z"/></svg>                <div class="text-right flex flex-col justify-end">
                    <h1 class="font-bold text-white text-xl uppercase">Total Profit</h1>
                    <span class="text-white text-xl uppercase">₱ {{$buyersSum}}.00 </span>
                </div>
            </div>
        </div>
        
        <div class="relative overflow-x-scroll mt-4">
            <table class="w-full text-sm text-left rounded-lg" id="dataTable">
                <thead class="text-sm text-black uppercase bg-gray-300 ">
                    <tr>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap ">Full Name</th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">Address</th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">Contact Number</th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">Animal RFID</th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">Animal Sex</th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">Animal weight</th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">Animal Value</th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">Transaction Type</th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">Sold Date</th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($buyers->isEmpty())
                        <tr class="hover:bg-gray-200">
                            <td colspan="10" class="text-center text-gray-400 text-xl py-20">
                                <h1>No records found!</h1>
                            </td>
                        </tr>
                    @else
                        @foreach ($buyers as $buyer)
                            <tr class="bg-white border-b border-b-gray-400 hover:bg-gray-100 cursor-pointer">
                                <td class="px-6 py-6 text-center whitespace-nowrap">
                                    {{$buyer->buyer_name}}
                                </td>
                                <td class="px-6 py-6 text-center whitespace-nowrap">
                                    {{$buyer->buyer_address}}
                                </td>
                                <td class="px-6 py-6 text-center whitespace-nowrap">
                                    {{$buyer->buyer_contact}}
                                </td>
                                <td class="px-6 py-6 text-center whitespace-nowrap">
                                    {{$buyer->RFID_TAG}}
                                </td>
                                <td class="px-6 py-6 text-center whitespace-nowrap">
                                    {{$buyer->sex}}
                                </td>
                                <td class="px-6 py-6 text-center whitespace-nowrap">
                                    {{$buyer->animal_weight}} kg
                                </td>
                                <td class="px-6 py-6 text-center whitespace-nowrap">
                                    ₱{{$buyer->animal_value}}
                                </td>
                                <td class="px-6 py-6 text-center whitespace-nowrap">
                                    {{$buyer->transaction_type}}
                                </td>
                                <td class="px-6 py-6 text-center whitespace-nowrap">
                                    {{\Carbon\Carbon::parse($buyer->sold_date)->format('F d Y')}}
                                </td>
                                <td class="px-6 py-6 text-center">
                                    {{$buyer->remarks}}
                                </td>
                            <tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>



@include('partials.__footer')