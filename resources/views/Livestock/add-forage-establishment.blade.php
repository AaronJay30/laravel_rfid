@include('partials.__header')

<style>
    body{
        background-color: #ece4b0;
        font-family: 'Lato', sans-serif;
        min-height: 100vh;
        /* overflow-y: scroll; */
    }
</style>

<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white w-2/3 max-[1250px]:w-full max-[1250px]:mx-12 max-[400px]:mx-4 user-container border-b-[20px] border-accent px-8 py-6 bg-opacity-30 rounded-3xl " style="box-shadow: 0px 4px 9px 5px rgba(0, 0, 0, 0.25);"> 
        
        <h1 class="form-title font-bold text-4xl max-[800px]:text-2xl max-[500px]:text-xl text-green-950 uppercase my-3 w-full text-center border-b-2 pb-4">Add Forage Establishment</h1>

        <form action="{{route('store.forage.establishment')}}" method="post" class="grid grid-cols-2  mt-5 gap-x-8 gap-y-4 ">
            @csrf

            <div class="flex flex-col col-span-1 max-[800px]:col-span-2">
                <h1 class="text-left mb-2 w-full text-green-950">Area</h1>
                <input type="text" autocomplete="off" name="est" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter forage area">
                @error('est')
                    <p class="text-red-500 w-full mt-2 text-sm ml-3">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <div class="flex flex-col col-span-1 max-[800px]:col-span-2">
                <h1 class="text-left mb-2 w-full text-green-950">Area status</h1>
                <input type="text" autocomplete="off" name="est_status" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter area status">
                @error('est_status')
                    <p class="text-red-500 w-full mt-2 text-sm ml-3">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <div class="flex flex-col col-span-1 max-[800px]:col-span-2">
                <h1 class="text-left mb-2 w-full text-green-950">Soil type</h1>
                <input type="text" autocomplete="off" name="soil_type" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter soil type">
                @error('soil_type')
                    <p class="text-red-500 w-full mt-2 text-sm ml-3">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <div class="flex flex-col col-span-1 max-[800px]:col-span-2">
                <h1 class="text-left mb-2 w-full text-green-950">Forage type</h1>
                <input type="text" autocomplete="off" name="forage_type" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter forage type">
                @error('forage_type')
                    <p class="text-red-500 w-full mt-2 text-sm ml-3">
                        {{$message}}
                    </p>
                @enderror
            </div>

            <div class="flex flex-col col-span-1 max-[800px]:col-span-2">
                <h1 class="text-left mb-2 w-full text-green-950">Climate condition</h1>
                <input type="text" value="{{$climateCondition}}" autocomplete="off" name="climate_condition" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter climate condition">
                @error('climate_condition')
                    <p class="text-red-500 w-full mt-2 text-sm ml-3">
                        {{$message}}
                    </p>
                @enderror
            </div>

            <div class="flex flex-col col-span-1 max-[800px]:col-span-2">
                <h1 class="text-left mb-2 w-full text-green-950">Date planted</h1>
                <input type="date" autocomplete="off" name="date_planted" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter date planted">
                @error('date_planted')
                    <p class="text-red-500 w-full mt-2 text-sm ml-3">
                        {{$message}}
                    </p>
                @enderror
            </div>

            <div class="flex flex-col col-span-1 max-[800px]:col-span-2">
                <h1 class="text-left mb-2 w-full text-green-950">Date harvested</h1>
                <input type="date" autocomplete="off" name="date_harvested" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter date harvested">
                @error('date_harvested')
                    <p class="text-red-500 w-full mt-2 text-sm ml-3">
                        {{$message}}
                    </p>
                @enderror
            </div>

            
            <div class="flex col-span-1 max-[800px]:col-span-2 mt-7 justify-end">
                <button type="submit" class="w-1/2 max-[800px]:w-1/2 max-[500px]:w-full text-white px-4 py-2.5 bg-green-500 hover:bg-green-700 cursor-pointer rounded-lg duration-100">Submit</button>
            </div>


        </form>

    </div>
</div>

@include('partials.__footer')