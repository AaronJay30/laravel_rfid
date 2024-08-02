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

<div class="min-h-screen flex justify-center items-center ml-10">
    <div class="absolute opacity-10">
        <svg xmlns="http://www.w3.org/2000/svg" width="300" height="300" viewBox="0 0 24 24"><path fill="#000042" d="M18.364 18.364a9 9 0 0 0 0-12.728l1.414-1.414c4.296 4.295 4.296 11.26 0 15.556l-1.414-1.414ZM5.636 5.636a9 9 0 0 0 0 12.728l-1.414 1.414c-4.296-4.296-4.296-11.26 0-15.556l1.414 1.414Zm9.9 9.9a5 5 0 0 0 0-7.072L16.95 7.05a7 7 0 0 1 0 9.9l-1.414-1.415ZM8.463 8.463a5 5 0 0 0 0 7.071L7.05 16.95a7 7 0 0 1 0-9.9l1.414 1.414ZM12 14a2 2 0 1 0 0-4a2 2 0 0 0 0 4Z"/></svg>
    </div>

    <h1 class="font-bold text-7xl opacity-50">[PLEASE SCAN RFID]</h1>
</div>



@include('partials.__footer')