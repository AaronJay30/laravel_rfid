@include('partials.__header')
{{-- @include('partials.__loader') --}}

<x-sidebar/>

<style>
    body{
        background-color: #f4f4f4;
        font-family: 'Lato', sans-serif;
        min-height: 100vh;
        overflow-y: scroll;
    }
    
    #editBtn {
        box-shadow: 0 0 10px 5px rgba(0, 255, 0, 0.5);
    }
    .group {
        display: flex;
        line-height: 28px;
        align-items: center;
        position: relative;
    }

    .search {
        width: 100%;
        height: 40px;
        line-height: 28px;
        padding: 0 1rem;
        padding-left: 2.5rem;
        border: 2px solid #8ca63d85;
        border-radius: 8px;
        outline: none;
        background-color: #f3f3f4;
        color: #0d0c22;
        transition: .3s ease;
    }

    .search::placeholder {
        color: #8CA63D;
    }

    .search:focus, search:hover {
        outline: none;
        border-color: rgb(140, 166, 61);
        background-color: #fff;
        box-shadow: 0 0 0 4px rgb(140, 166, 61, 0.2);
    }

    .icon {
        position: absolute;
        left: 1rem;
        fill: #8CA63D;
        width: 1rem;
        height: 1rem;
    }

    @media (max-width: 1100px) {
        .filter{
            grid-template-columns: repeat(2, minmax(0, 1fr))
        }
        .filter-search{
            grid-column: span 2 / span 2 !important; 
        }
        .filter-btn{
            grid-column: span 2 / span 2 !important;
            margin-top: 1rem/* 20px */ !important;
        }
    }

    @media screen and (min-width: 800px) and (max-width: 1025px) {
        .main-container{
            margin-left: 100px;
        }
    }

    @media (max-width: 600px) {
        .main-container{
            margin: auto;
            padding-left: 1.25rem;
            padding-right: 1.25rem;
            width:  90%;
        }
        .btn-section{
            display:grid;
            margin-top: 1rem;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
        }
        /* .filter{
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }
        .filter-search{
            grid-column: span 1 / span 1 !important; 
        }
        .filter-btn{
            grid-column: span 1 / span 1 !important;
            margin-top: 1rem !important;
        } */
        .filter-show{
            display: inline-flex;
        }
        .filter-show,
        .add-btn{
            grid-column: span 1 / span 1 !important;
            text-align: left;
            grid-column: span 1 / span 1 !important;
            width: 100%;
        }
        .filter-section{
            display: none;
        }
        .container-title{
            text-align: center;
        }
    }   
    
</style>


<dialog id='masterTable' class="w-1/3 max-[1250px]:w-full px-8 backdrop:bg-black backdrop:opacity-80 rounded-2xl" x-data="
    { 
        checkbox: $persist(true), 
        RFID_TAG: $persist(true), 
        name: $persist(true),  
        sex: $persist(true),  
        breed: $persist(true),  
        birthdate: $persist(true),  
        goat_status: $persist(true),  
        farm_name: $persist(true),  
        sire: $persist(true),  
        dam: $persist(false),  
        birth_season: $persist(false),  
        birth_type: $persist(false),  
        milk_type: $persist(false),  
        jaw: $persist(false),  
        ear: $persist(false),  
        body: $persist(false),  
        teat: $persist(false),  
        horn: $persist(false),  
    }">
    <div class="w-full border-b-black border-b">
        <h1 class="form-title font-bold text-3xl text-green-950 uppercase my-3 w-full text-center col-span-2">Show/Hide Columns</h1>
    </div>
    <div class="grid grid-cols-2 max-[600px]:grid-cols-1 items-center mt-4 w-full gap-8 px-16 py-8 bg-gray-200 rounded-2xl">
        <div class="flex flex-row items-center gap-5">
            <input type="checkbox" class="column-checkbox" x-bind:id="'checkbox'" x-model="checkbox" id="checkbox">
            <label for="checkbox">Checkbox</label>
        </div>
        <div class="flex flex-row items-center gap-5">
            <input type="checkbox" class="column-checkbox" x-bind:id="'RFID_TAG'" x-model="RFID_TAG" id="RFID_TAG">
            <label for="RFID_TAG">RFID Number</label>
        </div>
        <div class="flex flex-row items-center gap-5">
            <input type="checkbox" class="column-checkbox" x-bind:id="'name'" x-model="name" id="name">
            <label for="name">Name</label>
        </div>
        <div class="flex flex-row items-center gap-5">
            <input type="checkbox" class="column-checkbox" x-bind:id="'sex'" x-model="sex" id="sex">
            <label for="sex">Sex</label>
        </div>
        <div class="flex flex-row items-center gap-5">
            <input type="checkbox" class="column-checkbox" x-bind:id="'breed'" x-model="breed" id="breed">
            <label for="breed">Breed</label>
        </div>
        <div class="flex flex-row items-center gap-5">
            <input type="checkbox" class="column-checkbox" x-bind:id="'birthdate'" x-model="birthdate" id="birthdate">
            <label for="birthdate">Birthdate</label>
        </div>
        <div class="flex flex-row items-center gap-5">
            <input type="checkbox" class="column-checkbox" x-bind:id="'goat_status'" x-model="goat_status" id="goat_status">
            <label for="goat_status">Status</label>
        </div>
        <div class="flex flex-row items-center gap-5">
            <input type="checkbox" class="column-checkbox" x-bind:id="'farm_name'" x-model="farm_name" id="farm_name">
            <label for="farm_name">Farm Name</label>
        </div>
        <div class="flex flex-row items-center gap-5">
            <input type="checkbox" class="column-checkbox" x-bind:id="'sire'" x-model="sire" id="sire">
            <label for="sire">Sire</label>
        </div>
        <div class="flex flex-row items-center gap-5">
            <input type="checkbox" class="column-checkbox" x-bind:id="'dam'" x-model="dam" id="dam">
            <label for="dam">Dam</label>
        </div>
        <div class="flex flex-row items-center gap-5">
            <input type="checkbox" class="column-checkbox" x-bind:id="'birth_season'" x-model="birth_season" id="birth_season">
            <label for="birth_season">Birth Season</label>
        </div>
        <div class="flex flex-row items-center gap-5">
            <input type="checkbox" class="column-checkbox" x-bind:id="'birth_type'" x-model="birth_type" id="birth_type">
            <label for="birth_type">Birth Type</label>
        </div>
        <div class="flex flex-row items-center gap-5">
            <input type="checkbox" class="column-checkbox" x-bind:id="'milk_type'" x-model="milk_type" id="milk_type">
            <label for="milk_type">Milk Type</label>
        </div>
        <div class="flex flex-row items-center gap-5">
            <input type="checkbox" class="column-checkbox" x-bind:id="'ear'" x-model="ear" id="ear">
            <label for="ear">Ear Type</label>
        </div>
        <div class="flex flex-row items-center gap-5">
            <input type="checkbox" class="column-checkbox" x-bind:id="'horn'" x-model="horn" id="horn">
            <label for="horn">Horn Type</label>
        </div>
        <div class="flex flex-row items-center gap-5">
            <input type="checkbox" class="column-checkbox" x-bind:id="'body'" x-model="body" id="body">
            <label for="body">Body Type</label>
        </div>
        <div class="flex flex-row items-center gap-5">
            <input type="checkbox" class="column-checkbox" x-bind:id="'teat'" x-model="teat" id="teat">
            <label for="teat">Teat Type</label>
        </div>
        <div class="flex flex-row items-center gap-5">
            <input type="checkbox" class="column-checkbox" x-bind:id="'jaw'" x-model="jaw" id="jaw">
            <label for="jaw">Jaw Type</label>
        </div>
    </div>
</dialog>



<div class="min-h-screen flex items-center justify-center">
    <div class=" main-container bg-white md:w-3/4 w-4/5 user-container border-b-[20px] border-accent lg:ml-[70px] xl:ml-52 mt-5 mb-5 px-10 py-10 bg-opacity-30 rounded-3xl " style="box-shadow: 0px 4px 9px 5px rgba(0, 0, 0, 0.25);"> 
        <div class="whitespace-nowrap px-4 container-title flex justify-between flex-row flex-wrap">
            <span class="font-bold text-[27px]  text-[#273617] max-[550px]:w-full">MY HERD</span>

            <button type="button" onclick="masterTable.showModal()" class="bg-green-700 max-[550px]:w-full hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center justify-center mr-2 text-white">
                <i class="fa fa-wrench pr-4"></i>
                Master Table
            </button>
        </div>

        <div class="filter-section bg-white w-full px-10 pt-3 pb-5 rounded-3xl mt-5" style="box-shadow: 0px 4px 9px 5px rgba(0, 0, 0, 0.25);"> 
            <div class="whitespace-nowrap px-4">
                <span class="font-bold text-[20px]  text-[#273617]">Search Filter</span>

                <hr class="mt-2 border-[1px] rounded-md border-gray-300">

                <form action="{{route('livestock.search')}}" method="GET">
                    @csrf
                    <div class="grid grid-cols-3 gap-5 w-full mt-5 filter">
                        
                        <div class="group mt-4 filter-search">
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
                            <input autocomplete="off" autofocus placeholder="Search" type="search" name="search" class="search">
                        </div>

                        <div class="relative z-0">
                    
                            <label for="floating_breed" class="peer-focus:font-medium absolute text-md text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Breed</label>
                            <select id="floating_breed" name="breed" class="bg-gray-100 mt-4 border-0 border-b-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 shadow-md">
                            <option selected value="" disabled>Choose a breed</option>
                            @foreach ($breeds as $breed)
                                <option value="{{$breed->breed}}">{{$breed->breed}}</option>
                            @endforeach
                            </select>
        
        
                        </div>
                        <div class="relative z-0">
                    
                            <label for="floating_sex" class="peer-focus:font-medium absolute text-md text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Sex</label>
                            <select id="floating_sex" name="sex" class="bg-gray-100 mt-4 border-0 border-b-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 shadow-md">
                            <option selected value="" disabled>Choose a sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-5 filter">
                        <div class="mt-5">
                            <label for="date_from" class="absolute text-sm text-gray-500">Status: </label>
                            <select id="floating_sex" name="status" class="bg-gray-100 mt-7 border-0 border-b-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 shadow-md">
                                <option selected value="" disabled>Choose a status</option>
                                <option value="Active">Active</option>
                                <option value="Sold">Sold</option>
                                <option value="Dead">Dead</option>
                            </select>
                        </div>
                        
                        <div class="mt-5">
                            <label for="date_from" class="absolute text-sm text-gray-500">Date of birth from: </label>
                            <input type="date" name="date_from" id="date_from" class="mt-7 bg-gray-100 w-full border-0 border-b-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5 shadow-md">
                        </div>
                        <div class="mt-5">
                            <label for="date_to" class="absolute text-sm text-gray-500">Date of birth to: </label>
                            <input type="date" name="date_to" id="date_to" class="mt-7 bg-gray-100 w-full border-0 border-b-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5 shadow-md">
                        </div>
                        
                    </div>
                    <div class="mt-8 text-right filter-btn">
                        <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center justify-center mr-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 w-1/3">
                            <i class="fa fa-search pr-2"></i>
                            Search
                        </button>
                    </div>

                </form>

            </div>
        </div>

        <div class="mt-6 btn-section text-right flex flex-row ">
                <div class="filterBtn ">
                    <button type="button" class="hidden filter-show  text-white w-auto bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2.5 items-center justify-center mr-2" onclick="filter_modal_show()" type="button">
                        <i class="fa fa-filter pr-4"></i>
                        Filter
                    </button>
                </div>
                <div class="addBtn ">
                    <a href="{{route('livestock.add.herd')}}">
                        <button type="button" class="text-white  add-btn w-auto bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2.5 inline-flex items-center justify-center mr-2 ">
                            <i class="fa fa-plus pr-4"></i>
                            Add new herd
                        </button>
                    </a>
                </div>
                <div id="status" class="col-span-2 hidden">
                    <form action="{{route('livestock.status')}}" method="POST" id="statusForm" class="grid sm:grid-cols-4 grid-cols-2 sm:gap-0 gap-3">
                        @csrf
                        @method('PUT')
                        {{-- <button type="button" onclick="soldModal.showModal()" id="sold" name="status" value="sold" class="col-span-1 text-white add-btn w-auto bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center justify-center mr-2">
                            <i class="bx bx-money text-lg pr-4"></i>
                            Sold
                        </button>

                        <dialog id='soldModal' class="w-full sm:w-2/3 backdrop:bg-black backdrop:opacity-80 rounded-2xl pb-5"> 
                            <div class="flex justify-between">

                                <button onclick="soldModal.close()" type="button">
                                    <div class="add bg-orange-500 hover:bg-orange-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                                        <i class='bx bx-x'></i>
                                    </div>
                                </button>
                        
                        
                                <button type="submit" form="statusForm" name="status" value="sold">
                                    <div class="add bg-green-500 hover:bg-green-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                                        <i class='bx bx-save'></i>
                                    </div>
                                </button>
  
                            </div>

                            <div class="form-container border-t-[2px] my-5">
                                <h1 class="form-title font-bold text-3xl text-green-950 uppercase my-3 w-full text-center">Buyer Information</h1>
                                
                                <div class="grid grid-cols-2 gap-4 px-6 max-[900px]:grid-cols-1">
                                    <div class="flex flex-col mb-1 col-span-1">
                                        <h1 class="text-left mb-2 w-full text-green-950">Full Name</h1>
                                        <input type="text" autocomplete="off" name="buyer_name" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" value="{{old('buyer_name')}}" placeholder="Enter buyer's name">
                                        @error('buyer_name')
                                        <p class="text-red-500 w-full text-sm text-left pt-2 ml-3">
                                            {{$message}}
                                        </p>
                                        @enderror
                                    </div>

                                    <div class="flex flex-col mb-1 col-span-1">
                                        <h1 class="text-left mb-2 w-full text-green-950">Address</h1>
                                        <input type="text" autocomplete="off" name="buyer_address" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" value="{{old('buyer_address')}}" placeholder="Enter buyer's address">
                                        @error('buyer_address')
                                        <p class="text-red-500 w-full text-sm text-left pt-2 ml-3">
                                            {{$message}}
                                        </p>
                                        @enderror
                                    </div>

                                    <div class="flex flex-col mb-1 col-span-1">
                                        <h1 class="text-left mb-2 w-full text-green-950">Contact Number</h1>
                                        <input type="text" autocomplete="off" name="buyer_contact" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" value="{{old('buyer_contact')}}" placeholder="Enter buyer's contact number">
                                        @error('buyer_contact')
                                        <p class="text-red-500 w-full text-sm text-left pt-2 ml-3">
                                            {{$message}}
                                        </p>
                                        @enderror
                                    </div>

                                    <div class="flex flex-col mb-1 col-span-1">
                                        <h1 class="text-left mb-2 w-full text-green-950">Animal Weight</h1>
                                        <input type="number" step="0.01" autocomplete="off" name="animal_weight" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" value="{{old('animal_weight')}}" placeholder="Enter animal weight">
                                        @error('animal_weight')
                                        <p class="text-red-500 w-full text-sm text-left pt-2 ml-3">
                                            {{$message}}
                                        </p>
                                        @enderror
                                    </div>

                                    <div class="flex flex-col mb-1 col-span-1">
                                        <h1 class="text-left mb-2 w-full text-green-950">Date of Sold</h1>
                                        <input type="date" autocomplete="off" name="sold_date" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" value="{{old('sold_date')}}">
                                        @error('sold_date')
                                            <p class="text-red-500 w-full text-sm text-left pt-2 ml-3">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="flex flex-col mb-1 col-span-1">
                                        <h1 for="transaction_type" class="text-left mb-2 w-full px-2 text-green-950">Type of transaction</h1>
                                        <select id="transaction_type" name="transaction_type" class="bg-gray-100 border-0 border-b-[1px] border-accent text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
                                            <option value="" selected disabled>Select the type of transaction</option>
                                            <option value="Cash" >Cash</option>
                                            <option value="Digital Bank" >Digital Bank</option>
                                            <option value="Bank Transfer" >Bank Transfer</option>
                                        </select>
                                        
                                        
                                        @error('transaction_type')
                                        <p class="text-red-500 text-sm pt-2 text-left px-2 w-full">
                                            {{$message}}
                                        </p>
                                        @enderror
                                    </div>

                                    <div class="flex flex-col mb-1 col-span-1">
                                        <h1 class="text-left mb-2 w-full text-green-950">Animal Value</h1>
                                        <input type="number" autocomplete="off" name="animal_value" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" value="{{old('animal_value')}}" placeholder="Enter the animal value">
                                        @error('animal_value')
                                        <p class="text-red-500 w-full text-sm text-left pt-2 ml-3">
                                            {{$message}}
                                        </p>
                                        @enderror
                                    </div>

                                    <div class="flex flex-col mb-1 col-span-2">
                                        <h1 class="text-left mb-2 w-full text-green-950">Remarks</h1>
                                        <textarea name="remarks" rows="5" cols="20" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" value="{{old('remarks')}}" placeholder="Reasons for Sale"></textarea>
                                        @error('remarks')
                                        <p class="text-red-500 w-full text-sm text-left pt-2 ml-3">
                                            {{$message}}
                                        </p>
                                        @enderror
                                        
                                    </div>

                                    
                                    
                                </div>
                            </div>

                        </dialog>
    
                        <button type="submit" id="dead" name="status" value="dead" class="col-span-1 text-white add-btn w-auto bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center justify-center mr-2">
                            <i class="bx bxs-skull text-lg pr-4"></i>
                            Dead
                        </button> --}}

                        {{-- <button type="button" onclick="scheduleModal.showModal()"  class="col-span-1 text-white add-btn w-auto bg-yellow-800 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center justify-center mr-2">
                            <i class="fa fa-calendar text-lg pr-4"></i>
                            Schedule
                        </button> --}}

                        <button type="button" onclick="exportModal.showModal()" class="col-span-1 text-white add-btn w-auto bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center justify-center mr-2">
                            <i class="bx bxs-report text-lg pr-4"></i>
                            Export
                        </button>

                        <dialog id='exportModal' class="w-1/3 max-[1250px]:w-full px-8 backdrop:bg-black backdrop:opacity-80 rounded-2xl">
                            <div class="flex justify-between">

                                <button onclick="exportModal.close()" type="button">
                                    <div class="add bg-orange-500 hover:bg-orange-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                                        <i class='bx bx-x'></i>
                                    </div>
                                </button>
  
                            </div>

                            <div class="form-container border-t-[2px] my-5">
                                <h1 class="form-title font-bold text-3xl text-green-950 uppercase my-3 w-full text-center">Export Data</h1>
                            </div>

                            <div class="flex flex-row flex-wrap gap-4 justify-center items-center">
                                <button type="submit" form="statusForm" id="generatePDF" name="status" value="generatePDF" id="generatePDF" name="status" value="generatePDF" class="w-full text-white add-btn bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center justify-center mr-2">
                                    <i class="fa fa-download text-lg pr-4"></i>
                                    Download PDF
                                </button>

                                <button type="submit" form="statusForm" name="status" value="excel" class="w-full text-white add-btn bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center justify-center mr-2">
                                    <i class="fa fa-file-excel-o text-lg pr-4"></i>
                                    Export as Excel
                                </button>
                            </div>
                        </dialog>

                        <dialog id='scheduleModal' class="w-full sm:w-2/3 backdrop:bg-black backdrop:opacity-80 rounded-2xl pb-5"> 
                            <div class="flex justify-between">

                                <button onclick="scheduleModal.close()" type="button">
                                    <div class="add bg-orange-500 hover:bg-orange-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                                        <i class='bx bx-x'></i>
                                    </div>
                                </button>
                        
                        
                                <button type="submit" form="statusForm" name="status" value="schedule">
                                    <div class="add bg-green-500 hover:bg-green-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                                        <i class='bx bx-save'></i>
                                    </div>
                                </button>
  
                            </div>

                            <div class="form-container border-t-[2px] my-5">
                                <h1 class="form-title font-bold text-3xl text-green-950 uppercase my-3 w-full text-center">Add Schedule</h1>

                                <div class="grid grid-cols-2 gap-4 px-6 max-[900px]:grid-cols-1">
                                    <div class="flex flex-col mb-1 col-span-1">
                                        <h1 for="event" class="text-left mb-2 w-full px-2 text-green-950">Select an event</h1>
                                        <select id="event" name="event" class="bg-gray-100 border-0 border-b-[1px] border-accent text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
                                            <option value="" selected disabled>Select an event</option>
                                            <option value="Deworming" >Deworming</option>
                                            <option value="Vaccination" >Vaccination</option>
                                            <option value="Feeding" >Feeding</option>
                                            <option value="Milking" >Milking</option>
                                        </select>
                                        
                                        
                                        @error('event')
                                        <p class="text-red-500 w-full text-sm text-left pt-2 ml-3">
                                            {{$message}}
                                        </p>
                                        @enderror
                                    </div>
                                    
                                    <div class="flex flex-col mb-1 col-span-1">
                                        <h1 class="text-left mb-2 w-full text-green-950">Scheduled Date</h1>
                                        <input type="date" autocomplete="off" name="event_date" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" value="{{old('event_date')}}" placeholder="Enter farm name">
                                        @error('event_date')
                                        <p class="text-red-500 w-full text-sm text-left pt-2 ml-3">
                                            {{$message}}
                                        </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </dialog>
                    </form>
                </div>

                <div class="text-gray-600 sm:mt-0 mt-3 flex-grow text-right">
                    Showing {{ $livestocks->firstItem() }} - {{ $livestocks->lastItem() }} out of {{ $livestocks->total() }}
                </div>
        </div>

        

        <div class="relative overflow-x-scroll mt-4">
           
            <table class="w-full text-sm text-left rounded-lg" id="dataTable">
                <thead class="text-sm text-black uppercase bg-gray-300 ">
                    <tr>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap ">
                                <input type="checkbox" id="main_checkbox" class="ml-5 text-xl bg-gray-200 rounded text-green-600 focus:ring-0 duration-200"> 
                        </th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">
                            RFID No.
                        </th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">
                            Sex
                        </th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">
                            Breed
                        </th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">
                            Birth Date
                        </th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">
                            Farm Name
                        </th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">
                            Sire
                        </th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">
                            Dam
                        </th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">
                            Birth Season 
                        </th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">
                            Birth Type
                        </th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">
                            Milk Type
                        </th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">
                            Ear Type
                        </th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">
                            Horn Type
                        </th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">
                            Body Type
                        </th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">
                            Teat Type
                        </th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">
                            Jaw Type
                        </th>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">Action</th>  
                    </tr>
                </thead>
                <tbody class="whitespace-nowrap">
                    @if ($livestocks->isEmpty())
                        <tr class="hover:bg-gray-200">
                            <td colspan="20" class="text-center text-gray-400 text-xl py-20">
                                <h1>No records found!</h1>
                            </td>
                        </tr>
                    @else
                        @foreach ($livestocks as $livestock)
                            @if($livestock->livestockInfo->death_date)
                                <tr class="bg-red-200 border-b border-b-gray-400">
                            @elseif($livestock->livestockInfo->sold_date)
                                <tr class="bg-orange-200 border-b border-b-gray-400">
                            @else 
                                <tr class="bg-white border-b border-b-gray-400">
                            @endif
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                @unless ($livestock->livestockInfo->death_date || $livestock->livestockInfo->sold_date)
                                    <input type="checkbox" name="livestock_checkbox[]" class="livestock_checkbox ml-5 text-xl bg-gray-200 rounded text-green-600 focus:ring-0 duration-200" value="{{ $livestock->livestockInfo->IID }}" form="statusForm">
                                @endunless
                                    </td>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        {{$livestock->RFID_TAG}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$livestock->livestockInfo->given_name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$livestock->livestockInfo->sex}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$livestock->livestockInfo->breed}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{\Carbon\Carbon::parse($livestock->livestockInfo->birth_date)->format('F d Y')}}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($livestock->livestockInfo->death_date)
                                            Dead
                                        @elseif ($livestock->livestockInfo->sold_date)
                                            Sold
                                        @else
                                            Active
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">{{$livestock->livestockInfo->farm_name}}</td>
                                    <td class="px-6 py-4">{{$livestock->livestockInfo->sire ?? "Not Available"}}</td>
                                    <td class="px-6 py-4">{{$livestock->livestockInfo->dam ?? "Not Available"}}</td>
                                    <td class="px-6 py-4">{{$livestock->birthInfo->birth_season ?? "Not Available"}}</td>
                                    <td class="px-6 py-4">{{$livestock->birthInfo->birth_type ?? "Not Available"}}</td>
                                    <td class="px-6 py-4">{{$livestock->birthInfo->milk_type ?? "Not Available"}}</td>
                                    <td class="px-6 py-4">{{$livestock->characteristic->ear ?? "Not Available"}}</td>
                                    <td class="px-6 py-4">{{$livestock->characteristic->horn ?? "Not Available"}}</td>
                                    <td class="px-6 py-4">{{$livestock->characteristic->body ?? "Not Available"}}</td>
                                    <td class="px-6 py-4">{{$livestock->characteristic->teat ?? "Not Available"}}</td>
                                    <td class="px-6 py-4">{{$livestock->characteristic->jaw ?? "Not Available"}}</td>
                                    <td class="px-2 py-4 flex gap-2">
                                        <form action="{{route('livestock.edit')}}" method="GET">
                                            @csrf
                                            <input type="hidden" name="livestock_id" value="{{$livestock->RFID_TAG}}">
                                            <button class="text-white mx-2 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square mr-3" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                                Edit
                                            </button>
                                        </form>
                                            
                                        

                                        <form action="{{route('livestock.delete', ['herd' => $livestock->RFID_TAG])}}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="button" onclick="confirmDelete(this)" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300  rounded-lg text-sm px-2.5 py-2.5 text-center inline-flex items-center disabled:bg-gray-500 ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3 mr-3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                        
                                    </td>
                        @endforeach
                    @endif

                </tbody>
            </table>
            
        </div>
        <div class="mt-4">
            {{$livestocks->appends(\Request::except('page'))->links('pagination::tailwind')}}
        </div>

        </div>
    </div>
</div>

<dialog id='filter-modal' class="w-full backdrop:bg-black backdrop:opacity-80 rounded-2xl pb-5">
        <div class="whitespace-nowrap px-4">

            <div class="flex justify-between">
                <span class="font-bold text-[20px]  text-[#273617]">Search Filter</span>
                <span class="font-bold cursor-pointer" onclick="close_modal()">X</span>
            </div>
            

            <hr class="mt-2 border-[1px] rounded-md border-gray-300">

            <form action="{{route('livestock.search')}}" method="GET">
                @csrf
                <div class="grid grid-cols-3 gap-5 w-full mt-5 filter">
                    
                    <div class="group mt-4 filter-search max-[550px]:col-span-3">
                        <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
                        <input autocomplete="off" autofocus placeholder="Search" type="search" name="search" class="search">
                    </div>

                    <div class="relative z-0 max-[550px]:col-span-3">
                
                        <label for="floating_breed" class="peer-focus:font-medium absolute text-md text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Breed</label>
                        <select id="floating_breed" name="breed" class="bg-gray-100 mt-4 border-0 border-b-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 shadow-md">
                        <option selected value="">Choose a breed</option>
                        @foreach ($breeds as $breed)
                            <option value="{{$breed->breed}}">{{$breed->breed}}</option>
                        @endforeach
                        </select>
    
    
                    </div>
                    <div class="relative z-0 max-[550px]:col-span-3">
                
                        <label for="floating_sex" class="peer-focus:font-medium absolute text-md text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Sex</label>
                        <select id="floating_sex" name="sex" class="bg-gray-100 mt-4 border-0 border-b-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 shadow-md">
                        <option selected value="">Choose a sex</option>
                        @foreach ($sex as $gender)
                            <option value="{{$gender->sex}}">{{$gender->sex}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-5 filter max-[550px]:col-span-3">
                    <div class="mt-5 max-[550px]:col-span-3">
                        <label for="date_from" class="absolute text-sm text-gray-500">Status: </label>
                        <select id="floating_sex" name="status" class="bg-gray-100 mt-7 border-0 border-b-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 shadow-md">
                            <option selected value="" disabled>Choose a status</option>
                            <option value="Active">Active</option>
                            <option value="Sold">Solds</option>
                            <option value="Dead">Dead</option>
                        </select>
                    </div>
                    <div class="mt-5 max-[550px]:col-span-3">
                        <label for="date_from" class="absolute text-sm text-gray-500">Date of birth from: </label>
                        <input type="date" name="date_from" id="date_from_phone" class="mt-7 bg-gray-100 w-full border-0 border-b-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5 shadow-md">
                    </div>
                    <div class="mt-3 max-[550px]:col-span-3">
                        <label for="date_to" class="absolute text-sm text-gray-500">Date of birth to: </label>
                        <input type="date" name="date_to" id="date_to_phone" class="mt-7 bg-gray-100 w-full border-0 border-b-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5 shadow-md">
                    </div>
                </div>
                <div class="mt-10 text-right max-[550px]:col-span-3">
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center justify-center mr-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 w-full">
                        <i class="fa fa-search pr-2"></i>
                        Search
                    </button>
                </div>

            </form>

        </div>
</dialog>

{{-- <script>
                            <button class="move-left-button" data-column="RFID_TAG">&lt;</button>
                        <button class="move-right-button" data-column="RFID_TAG">&gt;</button>
  document.addEventListener('DOMContentLoaded', function () {
    const columnCheckboxes = document.querySelectorAll('.column-checkbox');
    const moveLeftButtons = document.querySelectorAll('.move-left-button');
    const moveRightButtons = document.querySelectorAll('.move-right-button');
    const myTable = document.getElementById('dataTable');
    const rows = myTable.querySelectorAll('tr');

    columnCheckboxes.forEach((checkbox, index) => {
      let dataIndexModulus = (index + 1) % 11;

      // Initially hide columns for unchecked checkboxes
      if (!checkbox.checked) {
        rows.forEach((row) => {
          const datas = row.querySelectorAll('td, th');
          datas.forEach((data, dataIndex) => {
            if (dataIndexModulus === dataIndex) {
              data.style.display = 'none';
            }
          });
        });
      }

      checkbox.addEventListener('change', function () {
        rows.forEach((row) => {
          const datas = row.querySelectorAll('td, th');
          datas.forEach((data, dataIndex) => {
            if (dataIndexModulus === dataIndex) {
              data.style.display = this.checked ? 'table-cell' : 'none';
            }
          });
        });
      });
    });

    moveLeftButtons.forEach((button, index) => {
      button.addEventListener('click', function () {
        moveColumnLeft(myTable, index + 1);
      });
    });

    moveRightButtons.forEach((button, index) => {
      button.addEventListener('click', function () {
        moveColumnRight(myTable, index + 1);
      });
    });

    function moveColumnLeft(table, columnIndex) {
      if (columnIndex === 0) return; // Cannot move the first column to the left

      for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].cells;
        const currentCell = cells[columnIndex];
        const previousCell = cells[columnIndex - 1];
        rows[i].insertBefore(currentCell, previousCell);
      }
    }

    function moveColumnRight(table, columnIndex) {
      if (columnIndex === rows[0].cells.length - 1) return; // Cannot move the last column to the right

      for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].cells;
        const currentCell = cells[columnIndex];
        const nextCell = cells[columnIndex + 1];
        rows[i].insertBefore(nextCell, currentCell);
      }
    }
  });

</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const columnCheckboxes = document.querySelectorAll('.column-checkbox');
        const myTable = document.getElementById('dataTable');
        const rows = myTable.querySelectorAll('tr');

        columnCheckboxes.forEach((checkbox, index) => {
            let dataIndexModulus = (index) % 18;

            // Initially hide columns for unchecked checkboxes
            if (!checkbox.checked) {
                rows.forEach((row) => {
                    const datas = row.querySelectorAll('td, th');
                    datas.forEach((data, dataIndex) => {
                        if (dataIndexModulus === dataIndex) {
                            data.style.display = 'none';
                        }
                    });
                });
            }

            checkbox.addEventListener('change', function () {
                rows.forEach((row) => {
                    const datas = row.querySelectorAll('td, th');
                    datas.forEach((data, dataIndex) => {
                        if (dataIndexModulus === dataIndex) {
                            data.style.display = this.checked ? 'table-cell' : 'none';
                        }
                    });
                });
            });
        });
    });
</script>

<script>
    function filter_modal_show(){
        document.getElementById("filter-modal").showModal();
    }

    function close_modal(){
        document.getElementById("filter-modal").close();
    }
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
        
    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("date_to").setAttribute("max", today);
    document.getElementById("date_from").setAttribute("max", today);
    document.getElementById("date_to_phone").setAttribute("max", today);
    document.getElementById("date_from_phone").setAttribute("max", today);
</script>

<script>
    $('#main_checkbox').click(function(event) {   
        if(this.checked) {
            let anyCheckboxChecked = false;

            $(':checkbox:not(#main_checkbox)').each(function() {
                anyCheckboxChecked = true;
            });

            if (anyCheckboxChecked) {
                $(':checkbox').each(function() {
                    this.checked = true;                        
                });
                $('#main_checkbox').checked = true;
                $('#status').removeClass('hidden');
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;                       
                });
                $('#main_checkbox').checked = true;
                $('#status').addClass('hidden');
            }
        } else {
            $(':checkbox').each(function() {
                this.checked = false;                       
            });
            $('#status').addClass('hidden');
        }
    }); 

    $('.livestock_checkbox').click(function(event){

        const checkedCount = $('.livestock_checkbox:checked').length;
        if(checkedCount >= 1){
            $('#status').removeClass('hidden');
        } else{
            $('#status').addClass('hidden');
        }
    });
</script>

<script>
    function confirmDelete(button){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'px-4 py-2 bg-green-700 rounded-lg mx-2 text-white hover:bg-green-900',
            cancelButton: 'px-4 py-2 bg-red-700 rounded-lg text-white hover:bg-red-900'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            // Show a confirmation message first
            swalWithBootstrapButtons.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            ).then((result) => {
                if (result.isConfirmed) {
                    const form = button.closest('form');
                    form.submit();
                }
            });

        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your file is safe :)',
            'error'
            )
        }
        })
    }
</script>


@include('partials.__footer')