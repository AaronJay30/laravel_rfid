@include('partials.__header')
{{-- @include('partials.__loader') --}}

<x-sidebar/>

<style>
    body{
        background-color: #f4f4f4;
        font-family: 'Lato', sans-serif;
        min-height: 100vh;
    }

    @media (max-width: 500px) {
        .container-box{
            padding-left: .5rem !important;
            padding-right: .5rem !important;
        }
        .parent{
            flex-direction: column;
            align-items: flex-start;
        }
        .parent h1{
            padding-left: 2rem;
        }
        .parent div{
            margin: .25rem 0 1rem 1rem;
        }

        .progress-input h1{
            width: 100%;
            text-align: left;
        }

        .progress-input{
            flex-direction: column;
            text-align: left;
            margin-left: auto;
            margin-right: auto;
            width: 100% !important;
        }

        .progress-input,
        .progress-input input{
            width: 90% !important;
            margin-right: 1rem;
        }
        .submit-btn{
            text-align: center !important;
        }
        .characteristic-section .grid{
            margin-right: 1rem;
            white-space: nowrap;
        }
        .gender-section{
            margin-right: 1rem !important;
            margin-left: 0rem !important;
        }
    }

    @media (max-width: 800px) {
        .main-container{
            margin-left: .5rem !important;
            margin-top: 0px !important;
        }
        .container-box{
            padding-left: 2rem;
            padding-right: 2rem;
        }
        .image-group{
            grid-column: span 5/ span 5 !important;
            margin-top: 3rem !important;
        }
        .image-group img{
            width: 200px;
            height: 200px;
            margin-left: auto;
            margin-right: auto;
        }
        .main-grid{
            grid-template-columns: repeat(5,minmax(0,1fr));
        }

        .form-group{
            grid-column: span 5/ span 5 !important;
        }
        .container{
            padding-left: 3rem;
            padding-right: 3rem;
        }
        .form-title{
            font-size: 2rem/* 48px */;
        }
        .three-month-form{
            grid-column: span 5/ span 5;
        }
        .progress-form{
            grid-column: span 5/ span 5;
        }
        .progress-form h1{
            text-align: center!important;
        }

        #three-month{
            width:50% !important;
        }

        .three-month-form{
            margin-top: 5rem!important;
        }

        .progress-input,
        .progress-input input{
            width: 80% ;
        }
        .submit-btn{
            text-align: right;
            margin: .25rem 0 .25rem 0;
        }
        .progress-form{
            margin-left: 1.5rem;
        }
        .gender-section{
            margin-right: 1rem;
            margin-left: 1rem;
        }
        .characteristic-section .grid{
            margin-right: 1rem;
        }
        .gender-section{
            margin-right: 0rem;
            margin-left: 0rem;
        }
    }

    @media (max-width:1250px){
        .form-grid{
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        .birth-col,
        .breed-col{
            grid-column: span 2/ span 2;

        }
        .birth-col input,
        .breed-col select   {
            width: 90%;           
        }

        .birth-col h1,
        .breed-col h1{
            padding-left: 2rem/* 32px */;
            padding-right: 2rem/* 32px */;
        }

        .image-group{
            grid-column: span 2/ span 2;
        }

        .form-group{
            grid-column: span 4/ span 4;
        }
        #three-month{
            width:70%;
        }
        .progress-input,
        .progress-input input{
            width: 100%;
        }

        .progress-input h1{
            font-size: 16px;
        }

        .progress-form{
            margin-left: 0rem;
        }
        .characteristic-section .grid{
            margin-right: 1rem;
        }
        .gender-section{
            margin-right: 1rem;
            margin-left: 1rem;
        }
    }
</style>

<div class="flex items-center justify-center">
    <div class="main-container w-[80%] ml-20 mt-10 py-10 bg-opacity-30">
        <div class="container-box bg-white w-full border-b-[20px] border-accent rounded-2xl px-20 pt-10 pb-10 col-span-1s" style="box-shadow: 0px 4px 9px 5px rgba(0, 0, 0, 0.25);">
            <form action="{{route('livestock.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <h1 class="form-title font-bold text-4xl text-green-950 text-center">ADD NEW HERD</h1>
                <hr class="border-gray-400 mt-3 w-full">
                <div class="main-grid grid grid-cols-6">
                    
                    {{-- Image Holder --}}
                    <div class="image-group col-span-1 text-center mt-20">
                        <img src="{{asset('img/livestock_default.png')}}" class="w-full mb-8 rounded-full" id="profilePicture">
                        <input type="file" name="birth_image" id="profile" class="hidden"  accept=".png,.jpeg,.jpg,.webp,.jfif">
                        <label for="profile" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-md px-8 py-3.5 cursor-pointer whitespace-nowrap">Choose Birth Image</label>

                        @error('birth_image')
                            <p class="text-red-500 text-sm pt-5">
                                {{$message}}
                            </p>
                        @enderror
                        
                    </div>

                    {{-- Form Group --}}
                    <div class="form-group col-span-5 pl-5">

                        {{-- First Layer --}}
                            <div class="form-grid grid grid-cols-5 gap-2 mt-3">
                           
                                <div class="col-span-2 flex flex-col pt-2">
                                    <h1 class="text-left mb-2 w-full px-8 text-green-950">Given Name</h1>
                                    <input type="text" autocomplete="off" name="info_given_name" value='{{old('info_given_name')}}' id="given_name" class="w-[90%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter given name">

                                    @error('info_given_name')
                                        <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                            {{$message}}
                                        </p>
                                    @enderror
                                </div>

                                <div class="breed-col col-span-1 flex flex-col pt-2">
                                    <h1 for="breed" class="text-left mb-2 w-full px-2 text-green-950">Breed</h1>
                                    <select id="breed" name="info_breed" class="bg-gray-100 border-0 border-b-[1px] border-accent text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
                                        <option value="" {{ old('info_breed') ? '' : 'selected' }}>Choose a breed</option>
                                        <option value="Boer" {{ old('info_breed') == 'Boer' ? 'selected' : '' }}>Boer</option>
                                        <option value="Alpine" {{ old('info_breed') == 'Alpine' ? 'selected' : '' }}>Alpine</option>
                                        <option value="Anglo Nubian" {{ old('info_breed') == 'Anglo Nubian' ? 'selected' : '' }}>Anglo Nubian</option>
                                        <option value="Saanen" {{ old('info_breed') == 'Saanen' ? 'selected' : '' }}>Saanen</option>
                                    </select>
                                    

                                    @error('info_breed')
                                        <p class="text-red-500 text-sm pt-2 text-left px-2 w-full">
                                            {{$message}}
                                        </p>
                                    @enderror

                                </div>

                                <div class="col-span-2 grid grid-cols-2 pt-2 gender-section">
                                    <div class="col-span-1">
                                        <h1 for="farm_name" class="text-left mb-2 w-full px-8 text-green-950 sm:text-sm whitespace-nowrap">Farm Name</h1>
                                        <input type="text" autocomplete="off" name="info_farm_name" value='{{Auth::User()->farm_name}}' readonly id="farm_name" class="w-[90%] ml-4 bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);"  placeholder="Enter farm name">

                                        @error('info_farm_name')
                                            <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                                {{$message}}
                                            </p>
                                        @enderror         
                                    </div>
                                    <div class="col-span-1">
                                        <h1 for="farm_name" class="text-left mb-2 w-full px-8 text-green-950">Sex</h1>
                                        <select id="sex" name="info_sex" class="bg-gray-100 border-0 border-b-[1px] border-accent text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block ml-4 py-2.5 px-5 w-[90%]" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
                                            <option value="" {{ old('info_sex') ? '' : 'selected' }}>Choose a sex</option>
                                            <option value="Male" {{ old('info_sex') == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('info_sex') == 'Female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                        

                                        @error('info_sex')
                                            <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                                {{$message}}
                                            </p>
                                        @enderror         
                                    </div>                                                                                     

                                </div>
                                
                                {{-- Parents Section --}}
                                <div class="col-span-2">
                                    <div class="parent pt-5 flex justify-normal">
                                        <h1 class="text-left text-2xl mb-2 pl-8 font-bold text-green-950">PARENTS</h1>
                                        <div class="inline-flex -mt-1">
                                            <input type="checkbox" autocomplete="off" name="parents_checkbox" id="parentsCheck" class="ml-5 text-xl bg-gray-200 border-black text-orange-600 focus:ring-0 duration-200" {{ old('parents_checkbox') ? 'checked' : '' }}>
                                                <span class="font-normal pl-2 text-[16px] -mt-2 whitespace-nowrap">Check if available</span>

                                        </div>

                                    </div>

                                    <div class="col-span-2 flex flex-col w-full pt-2">
                                        <h1 class="text-left mb-2 w-full px-8 text-green-950">Sire ID</h1>
                                        <input type="text" name="info_sire_id" value='{{old('info_sire_id')}}' id="sire_name" autocomplete="off" readonly class="w-[90%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Not available">
                                        @error('info_sire_id')
                                            <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="col-span-2 flex flex-col w-full pt-2">
                                        <h1 class="text-left mb-2 w-full px-8 text-green-950">Dam ID</h1>
                                        <input type="text" name="info_dam_id" id="dam_name" value='{{old('info_dam_id')}}'  autocomplete="off" readonly class="w-[90%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Not available">
                                        @error('info_dam_id')
                                            <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="col-span-2 flex flex-col w-full pt-2">
                                        <h1 class="text-left mb-2 w-full px-8 text-green-950">Registration Number</h1>
                                        <input type="text" name="registration_number" value='{{old('registration_number', '9910050010090')}}' autocomplete="off" id="registration_number" class="w-[90%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" value= style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter registration number">
                                        @error('registration_number')
                                            <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Birth Info Section --}}
                                <div class="birth-col col-span-1">
                                    <div class=" flex pt-5">
                                        <h1 class="text-left text-2xl mb-2 w-full font-bold text-green-950">BIRTH INFO</h1>
                                    </div>
                                    <div class="col-span-1 flex flex-col w-full pt-2">
                                        <h1 class="text-left mb-2 w-full text-green-950 px-2">Birth Date</h1>
                                        <input type="date" name="birth_date" value='{{old('birth_date')}}'  autocomplete="off" id="birth_date" class="w-full bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" max="">
                                        @error('birth_date')
                                            <p class="text-red-500 text-sm pt-2 text-left px-2 w-full">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="col-span-1 flex flex-col w-full pt-2">
                                        <h1 class="text-left mb-2 w-full text-green-950 px-2">Birth Season</h1>
                                        <select type="text" name="birth_season"  autocomplete="off" id="birth_season" class="w-full bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" max="">
                                            <option value="" selected disabled>Select the birth season</option>
                                            <option value="Wet" {{old('birth_season') == "Wet" ? 'selected' : ''}}>Wet</option>
                                            <option value="Dry" {{old('birth_season') == "Dry" ? 'selected' : ''}}>Dry</option>
                                        </select>
                                        @error('birth_season')
                                            <p class="text-red-500 text-sm pt-2 text-left px-2 w-full">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="col-span-1 flex flex-col w-full pt-2">
                                        <h1 class="text-left mb-2 w-full text-green-950 px-2">Birth Type</h1>
                                        <select type="text" name="birth_type" autocomplete="off" id="birth_type" class="w-full bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" max="">
                                            <option value="" selected disabled>Select the birth type</option>
                                            <option value="Single" {{old('birth_type') == "Single" ? 'selected' : ''}}>Single</option>
                                            <option value="Twin" {{old('birth_type') == "Twin" ? 'selected' : ''}}>Twin</option>
                                            <option value="Triplets" {{old('birth_type') == "Triplets" ? 'selected' : ''}}>Triplets</option>
                                            <option value="Quadruplets" {{old('birth_type') == "Quadruplets" ? 'selected' : ''}}>Quadruplets</option>
                                            <option value="Quintuplets" {{old('birth_type') == "Quintuplets" ? 'selected' : ''}}>Quintuplets</option>
                                        </select>
                                        @error('birth_type')
                                            <p class="text-red-500 text-sm pt-2 text-left px-2 w-full">
                                                {{$message}}
                                            </p>    
                                        @enderror
                                    </div>
                                    <div class="col-span-1 flex flex-col w-full pt-2">
                                        <h1 class="text-left mb-2 w-full text-green-950 px-2">Milk Type at Birth</h1>
                                        <input type="text" name="birth_milk" value='{{old('birth_milk')}}' autocomplete="off" id="birth_milk" class="w-full bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" max="">
                                        @error('birth_milk')
                                            <p class="text-red-500 text-sm pt-2 text-left px-2 w-full">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                
                                {{-- Characteristic Section --}}
                                <div class="col-span-2 characteristic-section">
                                    <div class="col-span-1 flex pt-5">
                                        <h1 class="text-left text-2xl mb-2 w-full font-bold text-green-950 pl-8">CHARACTERISTIC</h1>
                                    </div>

                                    <div class="grid grid-cols-2 pt-2">
                                        <div class="col-span-1 flex flex-col w-full">
                                            <h1 class="text-left mb-2 w-full px-8 text-green-950">Jaw</h1>
                                            <input type="text" name="char_jaw" value='{{old('char_jaw')}}' id="jaw" autocomplete="off" class="w-[90%] ml-4 bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Jaw State">
                                            @error('char_jaw')
                                                <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                                    {{$message}}
                                                </p>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-span-1 flex flex-col w-full">
                                            <h1 class="text-left mb-2 w-full px-8 text-green-950">Teat</h1>
                                            <input type="text" name="char_teat" value='{{old('char_teat')}}' id="teat" autocomplete="off" class="w-[90%] ml-4 bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Teat State">
                                            @error('char_teat')
                                                <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                                    {{$message}}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 pt-2">
                                        <div class="col-span-1 flex flex-col w-full">
                                            <h1 class="text-left mb-2 w-full px-8 text-green-950">Ear Type</h1>
                                            <input type="text" name="char_ear_type" value='{{old('char_ear_type')}}' id="ear_type" autocomplete="off" class="w-[90%] ml-4 bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Ear Type">
                                            @error('char_ear_type')
                                                <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                                    {{$message}}
                                                </p>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-span-1 flex flex-col w-full">
                                            <h1 class="text-left mb-2 w-full px-8 text-green-950">Horn Type</h1>
                                            <input type="text" name="char_horn_type" value='{{old('char_horn_type')}}' id="horn_type" autocomplete="off" class="w-[90%] ml-4 bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Horn Type">
                                            @error('char_horn_type')
                                                <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                                    {{$message}}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 pt-2">
                                        <div class="col-span-1 flex flex-col w-full">
                                            <h1 class="text-left mb-2 w-full px-8 text-green-950">Body Color</h1>
                                            <input type="text" name="char_body_color" value='{{old('char_body_color')}}' id="body_color" autocomplete="off" class="w-[90%] ml-4 bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Body Color">
                                            @error('char_body_color')
                                                <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                                    {{$message}}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
    
                    </div>
                </div>

                <hr class="border-gray-400 mt-6 w-full">
                <h1 class="form-title font-bold text-4xl text-green-950 text-center mt-10">PROGRESS INFORMATION <span class="sm:absolute hidden  ml-5 mt-3 text-sm font-normal text-red-500">Not Required</span></h1>
                
                <div class="grid grid-cols-5">
                    <div class="col-span-2 w-full mt-12 three-month-form">
                        <label for="image" class="cursor-pointer">
                            <img src="{{asset('img/add_goat.png')}}" alt="Progress image" class="w-[50%] z-10 h-auto rounded-full  mx-auto" id="imageHolder">
                        </label>
                        <input type="file" id="image" name="image" class="hidden" accept=".png,.jpeg,.jpg,.webp">
                    </div>
                    <div class="col-span-3 w-full mt-10 progress-form ml-6">
                        <div class="flex justify-between pt-6 w-[70%] progress-input">
                            <h1 class="text-left sm:text-[18px] text-[14px] mb-2 whitespace-nowrap px-4 text-green-950">Progress Date</h1>
                            <input type="date" name="date" value='{{old('date')}}' id="date" autocomplete="off" class="w-[80%] ml-4 bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter body weight">
                        </div>
                        <div class="flex justify-between pt-6 w-[70%] progress-input">
                            <h1 class="text-left sm:text-[18px] text-[14px] mb-2 whitespace-nowrap px-4 text-green-950">Body Weight</h1>
                            <input type="text" name="body_weight" value='{{old('body_weight')}}' id="body_weight" autocomplete="off" class="w-[80%] ml-4 bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter body weight">
                        </div>
                        <div class="flex justify-between pt-6 w-[70%] progress-input">
                            <h1 class="text-left sm:text-[18px] text-[14px] mb-2 whitespace-nowrap px-4 text-green-950">Body Length</h1>
                            <input type="text" name="body_length" value='{{old('body_length')}}' id="body_length" autocomplete="off" class="w-[80%] ml-5 bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter body length">
                        </div>
                        <div class="flex justify-between pt-6 w-[70%] progress-input">
                            <h1 class="text-left sm:text-[18px] text-[14px] mb-2 whitespace-nowrap px-4 text-green-950">Wither Height</h1>
                            <input type="text" name="wither_height" value='{{old('wither_height')}}' id="wither_height" autocomplete="off" class="w-[80%] bg-gray-100 rounded-lg border-0 border-b-[1px] sm:ml-1 ml-4 border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter wither height">
                        </div>
                        
                    </div>
                    <div class="col-span-5 text-right submit-btn">
                        <button type="submit" class="flex-shrink-0 mt-6 ml-6 bg-green-500 hover:bg-green-700 border-green-500 hover:border-green-700 text-[16px] border-4 text-white py-2 px-20 rounded-lg" type="button">
                            Submit
                          </button>
                    </div>
                    
                </div>

                <hr class="border-gray-400 mt-6 w-full">

                <div class="grid grid-cols-5 py-5">

                </div>

            </form>
        </div>
    </div>
</div>





<script>
        document.getElementById('parentsCheck').onchange = function () {
        var inputSire = document.getElementById('sire_name');
        var inputDam = document.getElementById('dam_name');
        var isChecked = this.checked;

        if (isChecked) {
            inputSire.removeAttribute('readonly');
            inputSire.value = "9910050010090";
            inputDam.removeAttribute('readonly');
            inputDam.value = "9910050010090";
        } else {
            inputSire.setAttribute('readonly', true);
            inputSire.placeholder = "Not Available";
            inputSire.value = "";
            inputDam.setAttribute('readonly', true);
            inputDam.value = "";

            // Clear the values when the checkbox is not checked
            // inputSire.value = "";
            // inputDam.value = "";
        }
    };
</script>


<script>
    document.getElementById("image").onchange = function(){
        document.getElementById('imageHolder').src = URL.createObjectURL(document.getElementById('image').files[0]);
    };

    document.getElementById("profile").onchange = function(){
        document.getElementById('profilePicture').src = URL.createObjectURL(profile.files[0]);
    }

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
    document.getElementById("birth_date").setAttribute("max", today);
</script>


@include('partials.__footer')