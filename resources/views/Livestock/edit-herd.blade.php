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
    .info-container {
        display: flex;
        flex-wrap: wrap;
    }
    @media (max-width: 500px) {
        .main-container{
            margin: 0rem 0rem !important;
            width: 100% !important;
        }
        .info-container > div {
            flex-basis: calc(100% - 20px) !important;
            margin: 10px !important;
        }
        .characteristic-section,
        .birth-section{
            padding-top: 1rem;
        }
        .form-title{
            font-size: 20px;
            text-align: center;
        }
        .lower-info-container{
            grid-column: span 4/ span 4 !important;
            margin-top: 2rem;
            
        }
        #addBreed,
        #editBreed,
        #editHerd{
            width: 100%;
        }

        #profilePicture{
            width: 50%;
        }
    }

    @media (max-width: 800px) {
        .main-container{
            margin-left: 0rem !important;
            margin-top: 0px !important;
            width: 95%;
        }
        .navbar-container
        {
            grid-column: span 5/ span 5;
            border: 0px;
            display: none;
        }
        .lower-info-container{
            grid-column: span 2/ span 2;
            margin-top: 2rem;
            margin-left: 0rem;
            
        }

        .navbar-info-container{
            grid-column: span 5/ span 5;
        }
        
        .image-container
        {
            grid-column: span 5/ span 5;
        }
        .image-container img{
            width: 30%;
        }
        .name-container,
        .info-container{
            grid-column: span 5/ span 5;
        }
        .button-container {
            flex-direction: column;
            margin-top:1rem;
            gap: 1rem;
            white-space: nowrap;
            justify-content: center;
            margin-left: 0rem;
            margin-top: 1rem;
            text-align: center;
            margin-bottom: 1rem;
        }
        .top-row-justify{

            white-space: nowrap;
            justify-content: center
        }
        .info-container > div {
            flex-basis: calc(50% - 20px);
            margin: 10px;
        }
        #navbarModalBtn{
            display: block;
        }
        .formBreed,
        .formBird{
            grid-template-columns: span 2/ span 2;
        }
        #formDiv{
            grid-template-columns: repeat(1, minmax(0, 1fr)) !important;
        }
        #editBreed{
            width: 100%;
        }
    }

    @media (max-width:1250px){
        .info-container > div {
            flex-basis: calc(50% - 20px);
            margin: 10px;
        }
        .image-container
        {
            grid-column: span 5/ span 5;
        }
        .navbar-container button{
            gap: 1rem;
            margin-left: 0rem;
            flex-direction: column;
        }

        .lower-info-container{
            grid-column: span 4/ span 4;
            margin-top: 2rem !important;
            
        } 
        .image-container img{
            width: 30%;
        }
        .name-container,
        .info-container{
            grid-column: span 5/ span 5;
        }
        .button-container {
            flex-direction: column;
            margin-top:1rem;
            gap: 1rem;
            white-space: nowrap;
            justify-content: center;
            margin-left: 0rem;
            margin-top: 1rem;
            text-align: center;
            margin-bottom: 1rem;
        }
        .top-row-justify{

            white-space: nowrap;
            justify-content: center
        }
        .addFormBreed,
        .addFormBirth,
        .editFormBreed,
        .editFormBirth
        {
            grid-column: span 4/ span 4;
        }   
        .addFormMilk,
        .addFormLactation,
        .editFormMilk,
        .editFormLactation{
            grid-column: span 4/ span 4;
        } 

        #addMilk,
        #editMilk,
        #editHerd{
            width: 100%;
        }

        .editHerdTop{
            grid-column: span 4/ span 4;
        }

        .parentTitle{
            margin-top: 1.25rem;
        }
        
        
    }

</style>


<div class="flex flex-container items-center justify-center">
    <div class="main-container w-[80%] ml-20 mt-10 py-10 bg-opacity-30">
        <div class="container-box bg-white w-full border-b-[20px] border-accent rounded-2xl px-10 pt-10 pb-10 col-span-1s" style="box-shadow: 0px 4px 9px 5px rgba(0, 0, 0, 0.25);">
            
            <div class="grid grid-cols-5 grid-rows-3">
                <div class="image-container col-span-1 row-span-3 w-full">
                    <img src="{{$livestock->birthInfo->birth_image}}" alt="" class="w-[70%] border-[1px] border-black mx-auto rounded-full">
                </div>

                <div class="flex flex-col name-container col-span-4 row-span-1 w-full border-b-[1px] border-gray-300 pb-2 mb-3">
                    <div class="flex flex-row gap-2 w-full top-row-justify">
                        <h1 class="font-bold sm:text-4xl text-2xl text-green-950 text-center">{{$livestock->livestockInfo->given_name}}</h1>
                        <span class="text-md sm:mt-3 mt-0">{{$livestock->livestockInfo->farm_name}}</span>
                    </div>
                    <div class="flex flex-row gap-1 w-full top-row-justify">
                        <h1 class="font-bold sm:text-xl text-md text-green-950 text-center">Breed Type:</h1>
                        <span class="sm:text-xl text-md">{{$livestock->livestockInfo->breed}}</span>
                    </div>
                    <div class="flex flex-row gap-1 w-full top-row-justify">
                        <h1 class="text-md text-green-950 text-center">Registration Number:</h1>
                        <span class="text-md font-normal">{{$livestock->RFID_TAG}}</span>
                    </div>
                    <div class="flex flex-row-reverse text-right justify-end ml-auto button-container lg:-mt-10 mt-2">
                        
                        <a href="/generate-qr-code"><button class="text-white mx-2 hidden bg-green-700 text-md hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-lg px-8 py-2.5 text-center inline-flex items-center">
                            <i class="fa fa-qrcode" aria-hidden="true"></i> <span class="text-sm ml-2">QR code</span>
                        </button></a>

                        <button onclick="editHerd.showModal()" class="text-white mx-2 bg-green-700 text-md hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-16 py-2.5 text-center inline-flex items-center">
                            Edit Info
                        </button>
                        <a href="/generate-report?rfid_tag={{$livestock->RFID_TAG}}"><button class="text-white mx-2 bg-green-700 text-md hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-16 py-2.5 text-center inline-flex items-center">
                            Generate Report
                        </button></a>
                    </div>
                </div>
                

                <div class="inline-flex flex-row info-container col-span-4 row-span-2 pt-5 w-full justify-between align-top">
                    {{-- Parent section --}}
                    <div class="flex flex-col flex-1 gap-2">
                        <h1 class="form-title font-bold text-2xl text-green-950 text-left w-full uppercase pb-2">Parents</h1>
                        <div class="flex flex-row gap-1 w-full">
                            <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Sire Name:</h1>
                            <span class="md:text-xl text-md">{{ $livestock->livestockInfo->sire ?? 'None' }}</span>
                        </div>
                        <div class="flex flex-row gap-1 w-full">
                            <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Dam Name:</h1>
                            <span class="md:text-xl text-md">{{ $livestock->livestockInfo->dam ?? 'None' }}</span>
                        </div>
                    </div>

                    {{-- Birth Section --}}
                    <div class="birth-section flex flex-col flex-1 gap-2">
                        <h1 class="form-title font-bold text-2xl text-green-950 text-left uppercase pb-2 w-full">Birth Info</h1>
                        <div class="flex flex-row gap-1 w-full">
                            <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Birth Date:</h1>
                            <span class="md:text-xl text-md">{{ $livestock->birthInfo->birth_date ?? 'None' }}</span>
                        </div>
                        <div class="flex flex-row gap-1 w-full">
                            <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Birth Season:</h1>
                            <span class="md:text-xl text-md">{{ $livestock->birthInfo->birth_season ?? 'None' }}</span>
                        </div>
                        <div class="flex flex-row gap-1 w-full">
                            <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Birth Type:</h1>
                            <span class="md:text-xl text-md">{{ $livestock->birthInfo->birth_type ?? 'None' }}</span>
                        </div>
                        <div class="flex flex-row gap-1 w-full">
                            <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Milk Type at Birth:</h1>
                            <span class="md:text-xl text-md">{{ $livestock->livestockInfo->milk_type ?? 'None' }}</span>
                        </div>
                        <div class="flex flex-row gap-1 w-full">
                            <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Date of Sold:</h1>
                            <span class="md:text-xl text-md">{{ $livestock->livestockInfo->milk_type ?? 'None' }}</span>
                        </div>
                        <div class="flex flex-row gap-1 w-full">
                            <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Date of Death:</h1>
                            <span class="md:text-xl text-md">{{ $livestock->livestockInfo->milk_type ?? 'None' }}</span>
                        </div>
                    </div>

                    {{-- Characteristic Section --}}
                    <div class="characteristic-section flex flex-col flex-1 gap-2">
                        <h1 class="form-title font-bold text-2xl text-green-950 text-left uppercase pb-2 w-full">Parents</h1>
                        <div class="flex flex-row gap-1 w-full">
                            <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Jaw:</h1>
                            <span class="md:text-xl text-md">{{ $livestock->characteristic->jaw ?? 'None' }}</span>
                        </div>
                        <div class="flex flex-row gap-1 w-full">
                            <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Teat:</h1>
                            <span class="md:text-xl text-md">{{ $livestock->characteristic->teat ?? 'None' }}</span>
                        </div>
                        <div class="flex flex-row gap-1 w-full">
                            <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Ear Type:</h1>
                            <span class="md:text-xl text-md">{{ $livestock->characteristic->ear ?? 'None' }}</span>
                        </div>
                        <div class="flex flex-row gap-1 w-full">
                            <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Horn Type:</h1>
                            <span class="md:text-xl text-md">{{ $livestock->characteristic->horn ?? 'None' }}</span>
                        </div>
                        <div class="flex flex-row gap-1 w-full">
                            <h1 class="font-bold md:text-xl text-md text-green-950 text-center">Body Color:</h1>
                            <span class="md:text-xl text-md">{{ $livestock->characteristic->body ?? 'None' }}</span>
                        </div>
                    </div>

                </div>
            </div>

            <hr class="border-gray-400 mt-6 w-full">

            <div class="grid grid-cols-5 mt-5 gap-3" x-data="{ currentComponent: $persist('livestock-breed') }">
                <div class="navbar-container col-span-1 border-r-[2px]">
                    <ul class="text-center">
                        <li @click="currentComponent = 'livestock-breed'"
                        :class="currentComponent === 'livestock-breed' ? 'bg-accent text-[#DCA15F] fill-[#DCA15D]' : 'hover:bg-accent hover:text-[#DCA15F] fill-black hover:fill-[#DCA15D]'"
                        class="py-2 border-t-[1px]">
                            <button class="w-full inline-flex flex-row justify-left items-center gap-10 ml-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 48 48"><g fill-rule="evenodd" clip-rule="evenodd"><path d="M32.028 29.822c1.304 0 2.36-1.043 2.36-2.329c0-1.286-1.056-2.328-2.36-2.328c-1.304 0-2.361 1.042-2.361 2.328c0 1.287 1.057 2.33 2.36 2.33Zm0-2c.225 0 .36-.173.36-.329c0-.155-.135-.328-.36-.328c-.226 0-.361.173-.361.328c0 .156.135.33.36.33Z"/><path d="M7.935 6.645a1 1 0 0 0-1.87.71c.871 2.291 2.925 3.44 5.008 3.44c1.63 0 3.293-.7 4.473-2.074c1.187 1.326 2.645 2.073 4.204 2.073c1.552 0 3.005-.74 4.189-2.056c1.088 1.333 2.558 2.057 4.134 2.057c1.61 0 3.18-.754 4.42-2.133c.424.482.883.89 1.369 1.216c-1.377 1.076-2.322 2.559-2.942 3.816c-.42.852-.713 1.645-.9 2.224l-.007.02a11.383 11.383 0 0 0-4.413.162c-.536.126-1.053.286-1.55.478c-.106-2.012-1.792-3.591-3.828-3.591c-.454 0-.89.078-1.296.222a4.015 4.015 0 0 0-2.825-1.154a4.006 4.006 0 0 0-3.743 2.552c-2.057.156-3.696 1.854-3.696 3.952c0 .313.036.617.106.91a3.949 3.949 0 0 0-1.824 3.324a3.93 3.93 0 0 0 1.141 2.77a3.919 3.919 0 0 0-.282 1.464c0 1.712 1.091 3.157 2.61 3.717a3.939 3.939 0 0 0 1.4 3.557a4.268 4.268 0 0 0-.146 1.11c0 .62.131 1.213.371 1.739a3.291 3.291 0 0 0-.371 1.522c0 1.851 1.518 3.329 3.36 3.329c1.844 0 3.362-1.478 3.362-3.33c0-.547-.134-1.065-.371-1.521c.24-.526.37-1.12.37-1.739c0-.77-.203-1.501-.567-2.114c.36-.595.568-1.291.568-2.035a3.947 3.947 0 0 0-1.683-3.23a9.664 9.664 0 0 1-.298-1.486a12.178 12.178 0 0 1-.075-2.514c.072-.843.253-1.494.508-1.89a.954.954 0 0 1 .347-.346c.103-.054.252-.096.487-.074c.223.02.438.028.645.024c-.856 1.78-1.13 3.79-.651 5.781c1.202 5.006 6.703 8.006 12.286 6.702c5.583-1.305 9.134-6.42 7.932-11.427c-.724-3.013-3.006-5.3-5.926-6.358a14.83 14.83 0 0 1 .769-1.885c.754-1.528 1.88-3.077 3.446-3.771a.933.933 0 0 0 .046-.022c.175.019.35.028.528.028c1.976 0 3.79-1.2 5.095-3.259a1 1 0 1 0-1.69-1.07c-1.057 1.668-2.312 2.33-3.405 2.33s-2.348-.662-3.405-2.33a1 1 0 0 0-1.69 0c-1.037 1.636-2.4 2.33-3.582 2.33c-1.163 0-2.381-.669-3.181-2.247a1 1 0 0 0-1.737-.083c-1.057 1.668-2.312 2.33-3.405 2.33s-2.348-.662-3.405-2.33a1 1 0 0 0-1.737.083c-.767 1.514-2.185 2.247-3.535 2.247c-1.341 0-2.593-.715-3.138-2.15Zm22.567 11.438a1.016 1.016 0 0 1-.174-.055a9.275 9.275 0 0 0-4.26.017c-4.71 1.1-7.35 5.286-6.452 9.027c.899 3.74 5.162 6.313 9.872 5.212c4.71-1.1 7.35-5.286 6.451-9.027c-.592-2.466-2.647-4.424-5.328-5.157a1.036 1.036 0 0 1-.11-.017ZM14.113 15.76c.127-.952.96-1.706 1.988-1.706c.724 0 1.354.374 1.707.933l.544.86l.85-.559c.291-.19.64-.302 1.02-.302c.971 0 1.747.731 1.827 1.639c-.251.654-.625 1.138-1.114 1.49l-.147.107l-.1.15c-.484.725-1.321 1.497-2.828 1.357a2.833 2.833 0 0 0-1.602.295a2.94 2.94 0 0 0-1.099 1.034c-.515.799-.736 1.833-.818 2.803c-.085.993-.033 2.036.084 2.94c.115.89.303 1.72.527 2.266l.131.32l.302.171a1.956 1.956 0 0 1 1.004 1.703c0 .517-.203.988-.542 1.342l-.668.7l.676.69c.308.315.534.817.534 1.417c0 .477-.143.896-.36 1.206l-.438.628l.492.587a1.3 1.3 0 0 1 .306.84c0 .72-.596 1.329-1.361 1.329s-1.361-.608-1.361-1.33c0-.318.113-.609.306-.84l.491-.586l-.438-.627a2.11 2.11 0 0 1-.36-1.207c0-.389.096-.74.25-1.026l.49-.91l-.926-.46a1.96 1.96 0 0 1-1.101-1.753c0-.302.069-.585.19-.839l.66-1.366l-1.515-.068c-1.075-.048-1.911-.92-1.911-1.962c0-.422.135-.812.367-1.133l.63-.872l-.916-.565a1.953 1.953 0 0 1-.94-1.664c0-.863.572-1.61 1.384-1.868l1.16-.37l-.588-1.065a1.919 1.919 0 0 1-.238-.93c0-1.073.884-1.965 2.005-1.965c.105 0 .207.008.307.023l1.005.15l.134-1.007Z"/></g></svg>
                                    Breed</button>
                        </li>
                        <li @click="currentComponent = 'livestock-disease'"
                        :class="currentComponent === 'livestock-disease' ? 'bg-accent text-[#DCA15F] fill-[#DCA15D]' : 'hover:bg-accent hover:text-[#DCA15F] fill-black hover:fill-[#DCA15D]'"
                        class="py-2 border-t-[1px]">
                            <button  class="w-full inline-flex flex-row justify-left items-center gap-10 ml-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 .5a1.746 1.746 0 0 0-1 3.18v1.4c-.9.13-1.74.42-2.5.86L7.39 4.35c.19-.52.14-1.12-.2-1.6C6.84 2.26 6.3 2 5.75 2c-.35 0-.7.1-1 .32c-.79.55-.99 1.64-.43 2.43c.34.49.88.75 1.43.75l1.18 1.68c-.43.43-.77.91-1.06 1.44c-.2-.08-.41-.12-.62-.12c-.45 0-.9.17-1.25.5c-.67.7-.67 1.8 0 2.5c.29.27.64.42 1 .5c0 .54.07 1.06.18 1.56l-1.31.35c-.31-.26-.71-.41-1.12-.41c-.15 0-.31 0-.46.06a1.752 1.752 0 0 0-1.23 2.15C1.27 16.5 2 17 2.75 17c.15 0 .3 0 .46-.06c.57-.16 1-.58 1.18-1.1l1.51-.41c.45.79 1.05 1.49 1.75 2.07l-1.1 2c-.55.08-1.05.39-1.34.92a1.749 1.749 0 1 0 3.08 1.66c.28-.52.27-1.12.02-1.61l1.07-1.97c.81.32 1.69.5 2.62.5h.18c-.13.26-.18.56-.18.88c.08.92.84 1.62 1.75 1.62h.13c.97-.08 1.69-.92 1.62-1.88c-.04-.5-.29-.94-.65-1.23c.47-.21.92-.48 1.34-.79l2.34 2.34c-.1.56.06 1.13.47 1.56c.35.33.8.5 1.25.5s.9-.17 1.25-.5c.67-.7.67-1.8 0-2.5c-.35-.33-.8-.5-1.25-.5c-.1 0-.2 0-.31.03l-2.34-2.34c.49-.65.87-1.39 1.11-2.19h1.11A1.746 1.746 0 0 0 23 13a1.746 1.746 0 0 0-3.18-1H19c0-1.57-.5-3-1.4-4.19l1.34-1.34c.11.03.21.03.31.03c.45 0 .9-.17 1.25-.5c.67-.69.67-1.8 0-2.5c-.35-.33-.8-.5-1.25-.5s-.9.17-1.25.5c-.41.43-.57 1-.47 1.56L16.19 6.4c-.92-.69-2-1.15-3.19-1.32v-1.4A1.746 1.746 0 0 0 12 .5M12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5s5 2.24 5 5s-2.24 5-5 5m-1.5-8C9.67 9 9 9.67 9 10.5s.67 1.5 1.5 1.5s1.5-.67 1.5-1.5S11.33 9 10.5 9m3.5 4c-.55 0-1 .45-1 1s.45 1 1 1s1-.45 1-1s-.45-1-1-1Z"/></svg>                                   
                                    Disease</button>
                        </li>
                        <li @click="currentComponent = 'livestock-milk'"
                        :class="currentComponent === 'livestock-milk' ? 'bg-accent text-[#DCA15F] stroke-[#DCA15D]' : 'hover:bg-accent hover:text-[#DCA15F] stroke-black hover:stroke-[#DCA15D]'"
                        class="py-2 border-t-[1px]">
                            <button  class="w-full inline-flex flex-row justify-left items-center gap-10 ml-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M8 6h8V4a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2zm8 0l1.094 1.759a6 6 0 0 1 .906 3.17V19a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-8.071a6 6 0 0 1 .906-3.17L8 6"/><path d="M10 16a2 2 0 1 0 4 0a2 2 0 1 0-4 0m0-6h4"/></g></svg>                                   
                                    Milk</button>
                        </li>
                        {{-- <li @click="currentComponent = 'livestock-forage'"
                            :class="currentComponent === 'livestock-forage' ? 'bg-accent text-[#DCA15F] fill-[#DCA15D]' : 'hover:bg-accent hover:text-[#DCA15F] fill-black hover:fill-[#DCA15D]'"
                            class="py-2 border-t-[1px]">
                            <button class="w-full inline-flex flex-row justify-left items-center gap-10 ml-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><g fill="none"><path d="M24 0v24H0V0h24ZM12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036c-.01-.003-.019 0-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.016-.018Zm.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01l-.184-.092Z"/><path fill="currentColor" d="M6.356 3.235a1 1 0 0 1 1.168-.087c3.455 2.127 5.35 4.818 6.36 7.78c.25.733.445 1.48.596 2.236c1.029-1.73 2.673-3.102 5.149-4.092a1 1 0 0 1 1.329 1.215l-.181.604C19.417 15.419 19 16.806 19 20a1 1 0 1 1-2 0c0-3.055.38-4.7 1.37-8.042c-1.122.744-1.861 1.608-2.357 2.565C15.248 15.997 15 17.805 15 20a1 1 0 1 1-2 0c0-2.992-.13-5.847-1.009-8.427c-.59-1.729-1.522-3.351-3.018-4.802C9.99 10.631 10 14.355 10 19.745V20a1 1 0 1 1-2 0c0-2.29-.01-4.371-.577-6.13c-.326-1.013-.84-1.92-1.683-2.674C6.66 14.348 7 16.683 7 20a1 1 0 1 1-2 0c0-3.864-.472-6.255-1.949-10.684a1 1 0 0 1 1.32-1.244c1.395.557 2.455 1.301 3.255 2.18a24.109 24.109 0 0 0-1.554-5.88a1 1 0 0 1 .284-1.137Z"/></g></svg> 
                                Forage
                            </button>
                        </li> --}}
                        <li @click="currentComponent = 'livestock-progress'"
                        :class="currentComponent === 'livestock-progress' ? 'bg-accent text-[#DCA15F] fill-[#DCA15D]' : 'hover:bg-accent hover:text-[#DCA15F] fill-black hover:fill-[#DCA15D]'"
                        class="py-2 border-t-[1px]">
                            <button  class="w-full inline-flex flex-row justify-left items-center gap-10 ml-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="currentColor" d="m16 11.78l4.24-7.33l1.73 1l-5.23 9.05l-6.51-3.75L5.46 19H22v2H2V3h2v14.54L9.5 8l6.5 3.78Z"/></svg>                                   
                                Progress</button>
                        </li>
                        <li @click="currentComponent = 'livestock-lineage'"
                        :class="currentComponent === 'livestock-lineage' ? 'bg-accent text-[#DCA15F] fill-[#DCA15D]' : 'hover:bg-accent hover:text-[#DCA15F] fill-black hover:fill-[#DCA15D]'"
                        class="py-2 border-t-[1px]">
                            <button  class="w-full inline-flex flex-row justify-left items-center gap-10 ml-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="currentColor" d="M12 1a2.5 2.5 0 0 0-2.5 2.5A2.5 2.5 0 0 0 11 5.79V7H7a2 2 0 0 0-2 2v.71A2.5 2.5 0 0 0 3.5 12A2.5 2.5 0 0 0 5 14.29V15H4a2 2 0 0 0-2 2v1.21A2.5 2.5 0 0 0 .5 20.5A2.5 2.5 0 0 0 3 23a2.5 2.5 0 0 0 2.5-2.5A2.5 2.5 0 0 0 4 18.21V17h4v1.21a2.5 2.5 0 0 0-1.5 2.29A2.5 2.5 0 0 0 9 23a2.5 2.5 0 0 0 2.5-2.5a2.5 2.5 0 0 0-1.5-2.29V17a2 2 0 0 0-2-2H7v-.71A2.5 2.5 0 0 0 8.5 12A2.5 2.5 0 0 0 7 9.71V9h10v.71A2.5 2.5 0 0 0 15.5 12a2.5 2.5 0 0 0 1.5 2.29V15h-1a2 2 0 0 0-2 2v1.21a2.5 2.5 0 0 0-1.5 2.29A2.5 2.5 0 0 0 15 23a2.5 2.5 0 0 0 2.5-2.5a2.5 2.5 0 0 0-1.5-2.29V17h4v1.21a2.5 2.5 0 0 0-1.5 2.29A2.5 2.5 0 0 0 21 23a2.5 2.5 0 0 0 2.5-2.5a2.5 2.5 0 0 0-1.5-2.29V17a2 2 0 0 0-2-2h-1v-.71A2.5 2.5 0 0 0 20.5 12A2.5 2.5 0 0 0 19 9.71V9a2 2 0 0 0-2-2h-4V5.79a2.5 2.5 0 0 0 1.5-2.29A2.5 2.5 0 0 0 12 1m0 1.5a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1M6 11a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1m12 0a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1M3 19.5a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1m6 0a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1m6 0a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1m6 0a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1Z"/></svg>                                   
                                Lineage</button>
                        </li>
                    </ul>
                </div>

                <div class="navbar-info-container col-span-4 w-full">
                    <div x-show="currentComponent === 'livestock-breed'">
                        <x-livestock-breed :breed="$breed" />
                    </div>
                    <div x-show="currentComponent === 'livestock-lineage'" class="block">
                        <x-livestock-lineage
                            :livestock="$livestock"
                            :sire="$sire"
                            :dam="$dam"
                            :sireGPSire="$sireGPSire"
                            :sireGPDam="$sireGPDam"
                            :damGPSire="$damGPSire"
                            :damGPDam="$damGPDam"
                            :sireGGPSire1="$sireGGPSire1"
                            :sireGGPDam1="$sireGGPDam1"
                            :sireGGPSire2="$sireGGPSire2"
                            :sireGGPDam2="$sireGGPDam2"
                            :damGGPSire1="$damGGPSire1"
                            :damGGPDam1="$damGGPDam1"
                            :damGGPSire2="$damGGPSire2"
                            :damGGPDam2="$damGGPDam2"
                        />
                    </div>
                    <div x-show="currentComponent === 'livestock-disease'">
                        <x-livestock-disease :deworming="$deworming" :vaccinations="$vaccinations" :livestock="$livestock"/>
                    </div>
                    <div x-show="currentComponent === 'livestock-milk'">
                        <x-livestock-milk :milk="$milk" :livestock="$livestock"/>
                    </div>
                    {{-- <div x-show="currentComponent === 'livestock-forage'">
                        <x-livestock-forage :forage="$forage" :livestock="$livestock"/>
                    </div> --}}
                    <div x-show="currentComponent === 'livestock-progress'"  x-data="{ progressView: 'Overview' }">
                        <x-livestock-progress :progress="$progress" :dateFilter="$dateFilter" />
                    </div>
                    
                    
                </div>

                <dialog id="navbarModal" class="w-2/3 overflow-x-hidden py-3 backdrop:bg-black backdrop:opacity-80 rounded-2xl">
                    <ul class="text-center">
                        <li @click="currentComponent = 'livestock-breed'"
                        :class="currentComponent === 'livestock-breed' ? 'bg-accent text-[#DCA15F] fill-[#DCA15D]' : 'hover:bg-accent hover:text-[#DCA15F] fill-black hover:fill-[#DCA15D]'"
                        class="py-2 rounded-2xl">
                            <button class="w-full inline-flex flex-row justify-left items-center gap-10 ml-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 48 48"><g fill-rule="evenodd" clip-rule="evenodd"><path d="M32.028 29.822c1.304 0 2.36-1.043 2.36-2.329c0-1.286-1.056-2.328-2.36-2.328c-1.304 0-2.361 1.042-2.361 2.328c0 1.287 1.057 2.33 2.36 2.33Zm0-2c.225 0 .36-.173.36-.329c0-.155-.135-.328-.36-.328c-.226 0-.361.173-.361.328c0 .156.135.33.36.33Z"/><path d="M7.935 6.645a1 1 0 0 0-1.87.71c.871 2.291 2.925 3.44 5.008 3.44c1.63 0 3.293-.7 4.473-2.074c1.187 1.326 2.645 2.073 4.204 2.073c1.552 0 3.005-.74 4.189-2.056c1.088 1.333 2.558 2.057 4.134 2.057c1.61 0 3.18-.754 4.42-2.133c.424.482.883.89 1.369 1.216c-1.377 1.076-2.322 2.559-2.942 3.816c-.42.852-.713 1.645-.9 2.224l-.007.02a11.383 11.383 0 0 0-4.413.162c-.536.126-1.053.286-1.55.478c-.106-2.012-1.792-3.591-3.828-3.591c-.454 0-.89.078-1.296.222a4.015 4.015 0 0 0-2.825-1.154a4.006 4.006 0 0 0-3.743 2.552c-2.057.156-3.696 1.854-3.696 3.952c0 .313.036.617.106.91a3.949 3.949 0 0 0-1.824 3.324a3.93 3.93 0 0 0 1.141 2.77a3.919 3.919 0 0 0-.282 1.464c0 1.712 1.091 3.157 2.61 3.717a3.939 3.939 0 0 0 1.4 3.557a4.268 4.268 0 0 0-.146 1.11c0 .62.131 1.213.371 1.739a3.291 3.291 0 0 0-.371 1.522c0 1.851 1.518 3.329 3.36 3.329c1.844 0 3.362-1.478 3.362-3.33c0-.547-.134-1.065-.371-1.521c.24-.526.37-1.12.37-1.739c0-.77-.203-1.501-.567-2.114c.36-.595.568-1.291.568-2.035a3.947 3.947 0 0 0-1.683-3.23a9.664 9.664 0 0 1-.298-1.486a12.178 12.178 0 0 1-.075-2.514c.072-.843.253-1.494.508-1.89a.954.954 0 0 1 .347-.346c.103-.054.252-.096.487-.074c.223.02.438.028.645.024c-.856 1.78-1.13 3.79-.651 5.781c1.202 5.006 6.703 8.006 12.286 6.702c5.583-1.305 9.134-6.42 7.932-11.427c-.724-3.013-3.006-5.3-5.926-6.358a14.83 14.83 0 0 1 .769-1.885c.754-1.528 1.88-3.077 3.446-3.771a.933.933 0 0 0 .046-.022c.175.019.35.028.528.028c1.976 0 3.79-1.2 5.095-3.259a1 1 0 1 0-1.69-1.07c-1.057 1.668-2.312 2.33-3.405 2.33s-2.348-.662-3.405-2.33a1 1 0 0 0-1.69 0c-1.037 1.636-2.4 2.33-3.582 2.33c-1.163 0-2.381-.669-3.181-2.247a1 1 0 0 0-1.737-.083c-1.057 1.668-2.312 2.33-3.405 2.33s-2.348-.662-3.405-2.33a1 1 0 0 0-1.737.083c-.767 1.514-2.185 2.247-3.535 2.247c-1.341 0-2.593-.715-3.138-2.15Zm22.567 11.438a1.016 1.016 0 0 1-.174-.055a9.275 9.275 0 0 0-4.26.017c-4.71 1.1-7.35 5.286-6.452 9.027c.899 3.74 5.162 6.313 9.872 5.212c4.71-1.1 7.35-5.286 6.451-9.027c-.592-2.466-2.647-4.424-5.328-5.157a1.036 1.036 0 0 1-.11-.017ZM14.113 15.76c.127-.952.96-1.706 1.988-1.706c.724 0 1.354.374 1.707.933l.544.86l.85-.559c.291-.19.64-.302 1.02-.302c.971 0 1.747.731 1.827 1.639c-.251.654-.625 1.138-1.114 1.49l-.147.107l-.1.15c-.484.725-1.321 1.497-2.828 1.357a2.833 2.833 0 0 0-1.602.295a2.94 2.94 0 0 0-1.099 1.034c-.515.799-.736 1.833-.818 2.803c-.085.993-.033 2.036.084 2.94c.115.89.303 1.72.527 2.266l.131.32l.302.171a1.956 1.956 0 0 1 1.004 1.703c0 .517-.203.988-.542 1.342l-.668.7l.676.69c.308.315.534.817.534 1.417c0 .477-.143.896-.36 1.206l-.438.628l.492.587a1.3 1.3 0 0 1 .306.84c0 .72-.596 1.329-1.361 1.329s-1.361-.608-1.361-1.33c0-.318.113-.609.306-.84l.491-.586l-.438-.627a2.11 2.11 0 0 1-.36-1.207c0-.389.096-.74.25-1.026l.49-.91l-.926-.46a1.96 1.96 0 0 1-1.101-1.753c0-.302.069-.585.19-.839l.66-1.366l-1.515-.068c-1.075-.048-1.911-.92-1.911-1.962c0-.422.135-.812.367-1.133l.63-.872l-.916-.565a1.953 1.953 0 0 1-.94-1.664c0-.863.572-1.61 1.384-1.868l1.16-.37l-.588-1.065a1.919 1.919 0 0 1-.238-.93c0-1.073.884-1.965 2.005-1.965c.105 0 .207.008.307.023l1.005.15l.134-1.007Z"/></g></svg>
                                    Breeding Partners</button>
                        </li>
                        <li @click="currentComponent = 'livestock-disease'"
                        :class="currentComponent === 'livestock-disease' ? 'bg-accent text-[#DCA15F] fill-[#DCA15D]' : 'hover:bg-accent hover:text-[#DCA15F] fill-black hover:fill-[#DCA15D]'"
                        class="py-2 rounded-2xl">
                            <button  class="w-full inline-flex flex-row justify-left items-center gap-10 ml-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 .5a1.746 1.746 0 0 0-1 3.18v1.4c-.9.13-1.74.42-2.5.86L7.39 4.35c.19-.52.14-1.12-.2-1.6C6.84 2.26 6.3 2 5.75 2c-.35 0-.7.1-1 .32c-.79.55-.99 1.64-.43 2.43c.34.49.88.75 1.43.75l1.18 1.68c-.43.43-.77.91-1.06 1.44c-.2-.08-.41-.12-.62-.12c-.45 0-.9.17-1.25.5c-.67.7-.67 1.8 0 2.5c.29.27.64.42 1 .5c0 .54.07 1.06.18 1.56l-1.31.35c-.31-.26-.71-.41-1.12-.41c-.15 0-.31 0-.46.06a1.752 1.752 0 0 0-1.23 2.15C1.27 16.5 2 17 2.75 17c.15 0 .3 0 .46-.06c.57-.16 1-.58 1.18-1.1l1.51-.41c.45.79 1.05 1.49 1.75 2.07l-1.1 2c-.55.08-1.05.39-1.34.92a1.749 1.749 0 1 0 3.08 1.66c.28-.52.27-1.12.02-1.61l1.07-1.97c.81.32 1.69.5 2.62.5h.18c-.13.26-.18.56-.18.88c.08.92.84 1.62 1.75 1.62h.13c.97-.08 1.69-.92 1.62-1.88c-.04-.5-.29-.94-.65-1.23c.47-.21.92-.48 1.34-.79l2.34 2.34c-.1.56.06 1.13.47 1.56c.35.33.8.5 1.25.5s.9-.17 1.25-.5c.67-.7.67-1.8 0-2.5c-.35-.33-.8-.5-1.25-.5c-.1 0-.2 0-.31.03l-2.34-2.34c.49-.65.87-1.39 1.11-2.19h1.11A1.746 1.746 0 0 0 23 13a1.746 1.746 0 0 0-3.18-1H19c0-1.57-.5-3-1.4-4.19l1.34-1.34c.11.03.21.03.31.03c.45 0 .9-.17 1.25-.5c.67-.69.67-1.8 0-2.5c-.35-.33-.8-.5-1.25-.5s-.9.17-1.25.5c-.41.43-.57 1-.47 1.56L16.19 6.4c-.92-.69-2-1.15-3.19-1.32v-1.4A1.746 1.746 0 0 0 12 .5M12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5s5 2.24 5 5s-2.24 5-5 5m-1.5-8C9.67 9 9 9.67 9 10.5s.67 1.5 1.5 1.5s1.5-.67 1.5-1.5S11.33 9 10.5 9m3.5 4c-.55 0-1 .45-1 1s.45 1 1 1s1-.45 1-1s-.45-1-1-1Z"/></svg>                                   
                                    Disease</button>
                        </li>
                        <li @click="currentComponent = 'livestock-milk'"
                        :class="currentComponent === 'livestock-milk' ? 'bg-accent text-[#DCA15F] stroke-[#DCA15D]' : 'hover:bg-accent hover:text-[#DCA15F] stroke-black hover:stroke-[#DCA15D]'"
                        class="py-2 rounded-2xl">
                            <button  class="w-full inline-flex flex-row justify-left items-center gap-10 ml-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M8 6h8V4a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2zm8 0l1.094 1.759a6 6 0 0 1 .906 3.17V19a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-8.071a6 6 0 0 1 .906-3.17L8 6"/><path d="M10 16a2 2 0 1 0 4 0a2 2 0 1 0-4 0m0-6h4"/></g></svg>                                   
                                    Milk</button>
                        </li>
                        {{-- <li @click="currentComponent = 'livestock-forage'"
                            :class="currentComponent === 'livestock-forage' ? 'bg-accent text-[#DCA15F] fill-[#DCA15D]' : 'hover:bg-accent hover:text-[#DCA15F] fill-black hover:fill-[#DCA15D]'"
                            class="py-2 rounded-2xl">
                            <button class="w-full inline-flex flex-row justify-left items-center gap-10 ml-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><g fill="none"><path d="M24 0v24H0V0h24ZM12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036c-.01-.003-.019 0-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.016-.018Zm.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01l-.184-.092Z"/><path fill="currentColor" d="M6.356 3.235a1 1 0 0 1 1.168-.087c3.455 2.127 5.35 4.818 6.36 7.78c.25.733.445 1.48.596 2.236c1.029-1.73 2.673-3.102 5.149-4.092a1 1 0 0 1 1.329 1.215l-.181.604C19.417 15.419 19 16.806 19 20a1 1 0 1 1-2 0c0-3.055.38-4.7 1.37-8.042c-1.122.744-1.861 1.608-2.357 2.565C15.248 15.997 15 17.805 15 20a1 1 0 1 1-2 0c0-2.992-.13-5.847-1.009-8.427c-.59-1.729-1.522-3.351-3.018-4.802C9.99 10.631 10 14.355 10 19.745V20a1 1 0 1 1-2 0c0-2.29-.01-4.371-.577-6.13c-.326-1.013-.84-1.92-1.683-2.674C6.66 14.348 7 16.683 7 20a1 1 0 1 1-2 0c0-3.864-.472-6.255-1.949-10.684a1 1 0 0 1 1.32-1.244c1.395.557 2.455 1.301 3.255 2.18a24.109 24.109 0 0 0-1.554-5.88a1 1 0 0 1 .284-1.137Z"/></g></svg> 
                                Forage
                            </button>
                        </li> --}}
                        <li @click="currentComponent = 'livestock-progress'"
                        :class="currentComponent === 'livestock-progress' ? 'bg-accent text-[#DCA15F] fill-[#DCA15D]' : 'hover:bg-accent hover:text-[#DCA15F] fill-black hover:fill-[#DCA15D]'"
                        class="py-2 rounded-2xl">
                            <button  class="w-full inline-flex flex-row justify-left items-center gap-10 ml-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="currentColor" d="m16 11.78l4.24-7.33l1.73 1l-5.23 9.05l-6.51-3.75L5.46 19H22v2H2V3h2v14.54L9.5 8l6.5 3.78Z"/></svg>                                   
                                Progress</button>
                        </li>
                        <li @click="currentComponent = 'livestock-lineage'"
                        :class="currentComponent === 'livestock-lineage' ? 'bg-accent text-[#DCA15F] fill-[#DCA15D]' : 'hover:bg-accent hover:text-[#DCA15F] fill-black hover:fill-[#DCA15D]'"
                        class="py-2 rounded-2xl">
                            <button  class="w-full inline-flex flex-row justify-left items-center gap-10 ml-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="currentColor" d="M12 1a2.5 2.5 0 0 0-2.5 2.5A2.5 2.5 0 0 0 11 5.79V7H7a2 2 0 0 0-2 2v.71A2.5 2.5 0 0 0 3.5 12A2.5 2.5 0 0 0 5 14.29V15H4a2 2 0 0 0-2 2v1.21A2.5 2.5 0 0 0 .5 20.5A2.5 2.5 0 0 0 3 23a2.5 2.5 0 0 0 2.5-2.5A2.5 2.5 0 0 0 4 18.21V17h4v1.21a2.5 2.5 0 0 0-1.5 2.29A2.5 2.5 0 0 0 9 23a2.5 2.5 0 0 0 2.5-2.5a2.5 2.5 0 0 0-1.5-2.29V17a2 2 0 0 0-2-2H7v-.71A2.5 2.5 0 0 0 8.5 12A2.5 2.5 0 0 0 7 9.71V9h10v.71A2.5 2.5 0 0 0 15.5 12a2.5 2.5 0 0 0 1.5 2.29V15h-1a2 2 0 0 0-2 2v1.21a2.5 2.5 0 0 0-1.5 2.29A2.5 2.5 0 0 0 15 23a2.5 2.5 0 0 0 2.5-2.5a2.5 2.5 0 0 0-1.5-2.29V17h4v1.21a2.5 2.5 0 0 0-1.5 2.29A2.5 2.5 0 0 0 21 23a2.5 2.5 0 0 0 2.5-2.5a2.5 2.5 0 0 0-1.5-2.29V17a2 2 0 0 0-2-2h-1v-.71A2.5 2.5 0 0 0 20.5 12A2.5 2.5 0 0 0 19 9.71V9a2 2 0 0 0-2-2h-4V5.79a2.5 2.5 0 0 0 1.5-2.29A2.5 2.5 0 0 0 12 1m0 1.5a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1M6 11a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1m12 0a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1M3 19.5a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1m6 0a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1m6 0a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1m6 0a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1Z"/></svg>                                   
                                Lineage</button>
                        </li>
                    </ul>
                </dialog>
            </div>
        </div>
    </div>
</div>

<button id="navbarModalBtn" onclick="navbarModal.showModal()" class="fixed hidden right-5 bottom-5 rounded-full px-5 py-5 bg-green-800 cursor-pointer">
    <i class="bx bx-menu text-white text-2xl"> </i>
</button>

<dialog id="editHerd" class="w-2/3 px-5 backdrop:bg-black backdrop:opacity-80 rounded-2xl">
    <div class="flex justify-between">

        <button onclick="editHerd.close()">
            <div class="add bg-orange-500 hover:bg-orange-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                <i class='bx bx-x'></i>
            </div>
        </button>


        <button type="submit" form="editHerdForm">
            <div class="add bg-green-500 hover:bg-green-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                <i class='bx bx-save'></i>
            </div>
        </button>
    
    </div>
    <form action="{{route('livestock.herd.edit')}}" method="POST" id="editHerdForm" enctype="multipart/form-data">
        @csrf
            <div class="form-container border-t-[2px] my-5">
                <h1 class="form-title font-bold text-3xl text-green-950 uppercase my-3 w-full text-center">Edit HERD Information</h1>
                <input type="hidden" name="RFID_TAG" value="{{$livestock->RFID_TAG}}">
                <input type="hidden" name="IID" value="{{$livestock->IID}}">
                <input type="hidden" name="CID" value="{{$livestock->CID}}">
                <input type="hidden" name="BID" value="{{$livestock->BID}}">
                <input type="hidden" name="old_image" value="{{$livestock->birthInfo->birth_image}}">
                <div class=" w-full text-center mb-14 mt-5">
                    <img src="{{$livestock->birthInfo->birth_image}}" class="w-1/6 mb-8 rounded-full mx-auto" id="profilePicture">
                    <input type="file" name="birth_image" id="profile" class="hidden"  accept=".png,.jpeg,.jpg,.webp">
                    <label for="profile" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-md px-8 py-3.5 cursor-pointer whitespace-nowrap">Choose Birth Image</label>

                    @error('birth_image')
                        <p class="text-red-500 text-sm pt-5">
                            {{$message}}
                        </p>
                    @enderror
                    
                </div>

                <div class=" grid grid-cols-4">
                    <div class="editHerdTop col-span-2  w-full">
                        <div class="flex flex-col sm:px-10 px-5 mb-1">
                            <h1 class="text-left mb-2 w-full text-green-950">Registration Number</h1>
                            <input type="text" autocomplete="off" value="{{$livestock->RFID_TAG}}" name="reg_num" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter registration number">
                            @error('reg_num')
                                <p class="text-red-500 w-full text-sm py-3 ml-3">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                        <div class="flex flex-col sm:px-10 px-5 mb-1">
                            <h1 class="text-left mb-2 w-full text-green-950">Given Name</h1>
                            <input type="text" autocomplete="off" value="{{$livestock->livestockInfo->given_name}}" name="info_given_name" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter given name">
                            @error('info_given_name')
                                <p class="text-red-500 w-full text-sm py-3 ml-3">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                        <div class="flex flex-col sm:px-10 px-5 mb-1">
                            <h1 for="breed" class="text-left mb-2 w-full px-2 text-green-950">Breed</h1>
                            <select id="breed" name="info_breed" class="bg-gray-100 border-0 border-b-[1px] border-accent text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
                                <option value="" {{ $livestock->livestockInfo->breed ? '' : 'selected' }}>Choose a breed</option>
                                <option value="Boer" {{ $livestock->livestockInfo->breed == 'Boer' ? 'selected' : '' }}>Boer</option>
                                <option value="Alpine" {{ $livestock->livestockInfo->breed == 'Alpine' ? 'selected' : '' }}>Alpine</option>
                                <option value="Anglo Nubian" {{ $livestock->livestockInfo->breed == 'Anglo Nubian' ? 'selected' : '' }}>Anglo Nubian</option>
                                <option value="Saanen" {{ $livestock->livestockInfo->breed == 'Saanen' ? 'selected' : '' }}>Saanen</option>
                            </select>
                            
                            
                            @error('info_breed')
                            <p class="text-red-500 text-sm pt-2 text-left px-2 w-full">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                        <div class="flex flex-col sm:px-10 px-5 mb-1">
                            <h1 class="text-left mb-2 w-full text-green-950">Farm Name</h1>
                            <input type="text" autocomplete="off" name="info_farm_name" value='{{$livestock->livestockInfo->farm_name}}' class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter farm name">
                            @error('info_farm_name')
                                <p class="text-red-500 w-full text-sm py-3 ml-3">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                        <div class="flex flex-col sm:px-10 px-5 mb-1">
                            <h1 class="text-left mb-2 w-full text-green-950">Sex</h1>
                            <select id="sex" name="info_sex" class="bg-gray-100 border-0 border-b-[1px] border-accent text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block py-2.5 px-5 w-full" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);">
                                <option value="" {{ $livestock->livestockInfo->sex ? '' : 'selected' }}>Choose a sex</option>
                                <option value="Male" {{ $livestock->livestockInfo->sex == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $livestock->livestockInfo->sex == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            

                            @error('info_sex')
                                <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                    {{$message}}
                                </p>
                            @enderror 
                        </div>
                    </div>
                    <div class="editHerdTop col-span-2 w-full">
                        <div class="flex justify-normal">
                            <h1 class="parentTitle text-left text-2xl mb-2 pl-8 font-bold text-green-950">PARENTS <span class="text-sm ml-3 font-normal text-gray-400"> (If not available leave it blank) </span></h1>
                        </div>
                        <div class="sm:px-10 px-5 flex flex-col w-full pt-2">
                            <h1 class="text-left mb-2 w-full text-green-950">Sire ID</h1>
                            <input type="text" name="info_sire_id" value="{{ $livestock->livestockInfo->sire ?? '' }}"
                            autocomplete="off" class="w-full bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter Sire Name">
                            @error('info_sire_id')
                                <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>

                        <div class="sm:px-10 px-5 flex flex-col w-full pt-2">
                            <h1 class="text-left mb-2 w-full text-green-950">Dam ID</h1>
                            <input type="text" name="info_dam_id" id="dam_name" value="{{ $livestock->livestockInfo->dam ?? '' }}" autocomplete="off" class="w-full bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter Dam Name">
                            @error('info_dam_id')
                                <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="editHerdTop col-span-2 w-full mt-4">
                        <div class="pt-5 flex justify-normal">
                            <h1 class="text-left text-2xl mb-2 pl-8 font-bold text-green-950">BIRTH INFO</h1>
                        </div>
                        <div class="sm:px-10 px-5 flex flex-col w-full pt-2">
                            <h1 class="text-left mb-2 w-full text-green-950">Birth Date</h1>
                            <input type="date" name="birth_date" value="{{ $livestock->birthInfo->birth_date}}"
                            autocomplete="off" class="w-full bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter Birth Date">
                            @error('birth_date')
                                <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                        <div class="sm:px-10 px-5 flex flex-col w-full pt-2">
                            <h1 class="text-left mb-2 w-full text-green-950">Birth Season</h1>
                            <select type="text" name="birth_season"
                            autocomplete="off" class="w-full bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter Birth Season">
                                <option value="Wet" {{$livestock->birthInfo->birth_season == "Wet" ? 'selected' : ''}}>Wet</option>
                                <option value="Dry" {{$livestock->birthInfo->birth_season == "Dry" ? 'selected' : ''}}>Dry</option>
                            </select>
                            @error('birth_season')
                                <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                        <div class="sm:px-10 px-5 flex flex-col w-full pt-2">
                            <h1 class="text-left mb-2 w-full text-green-950">Birth Type</h1>
                            <select type="text" name="birth_type"
                            autocomplete="off" class="w-full bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter Birth Type"> 
                                <option value="Single" {{$livestock->birthInfo->birth_type == "Single" ? 'selected' : ''}}>Single</option>
                                <option value="Twin" {{$livestock->birthInfo->birth_type == "Twin" ? 'selected' : ''}}>Twin</option>
                                <option value="Triplets" {{$livestock->birthInfo->birth_type == "Triplets" ? 'selected' : ''}}>Triplets</option>
                                <option value="Quadruplets" {{$livestock->birthInfo->birth_type == "Quadruplets" ? 'selected' : ''}}>Quadruplets</option>
                                <option value="Quintuplets" {{$livestock->birthInfo->birth_type == "Quintuplets" ? 'selected' : ''}}>Quintuplets</option>
                            
                            </select>
                            @error('birth_type')
                                <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                        <div class="sm:px-10 px-5 flex flex-col w-full pt-2">
                            <h1 class="text-left mb-2 w-full text-green-950">Milk Type at Birth</h1>
                            <input type="text" name="milk_type" value="{{ $livestock->birthInfo->milk_type}}"
                            autocomplete="off" class="w-full bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter Milk at birth">
                            @error('milk_type')
                                <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                        
                    </div>

                    <div class="editHerdTop col-span-2 w-full mt-4">
                        <div class="pt-5 flex justify-normal">
                            <h1 class="text-left text-2xl mb-2 pl-8 font-bold text-green-950">CHARACTERISTIC</h1>
                        </div>
                        <div class="sm:px-10 px-5 flex flex-col w-full pt-2">
                            <h1 class="text-left mb-2 w-full text-green-950">Jaw</h1>
                            <input type="text" name="jaw" value="{{ $livestock->characteristic->jaw}}"
                            autocomplete="off" class="w-full bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Jaw State">
                            @error('jaw')
                                <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                        <div class="sm:px-10 px-5 flex flex-col w-full pt-2">
                            <h1 class="text-left mb-2 w-full text-green-950">Ear Type</h1>
                            <input type="text" name="ear" value="{{ $livestock->characteristic->ear}}"
                            autocomplete="off" class="w-full bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Ear State">
                            @error('ear')
                                <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                        <div class="sm:px-10 px-5 flex flex-col w-full pt-2">
                            <h1 class="text-left mb-2 w-full text-green-950">Body Color</h1>
                            <input type="text" name="body" value="{{ $livestock->characteristic->body}}"
                            autocomplete="off" class="w-full bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Body Color">
                            @error('body')
                                <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                        <div class="sm:px-10 px-5 flex flex-col w-full pt-2">
                            <h1 class="text-left mb-2 w-full text-green-950">Teat Type</h1>
                            <input type="text" name="teat" value="{{ $livestock->characteristic->teat}}"
                            autocomplete="off" class="w-full bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Teat State">
                            @error('teat')
                                <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                        <div class="sm:px-10 px-5 flex flex-col w-full pt-2">
                            <h1 class="text-left mb-2 w-full text-green-950">Horn Type</h1>
                            <input type="text" name="horn" value="{{ $livestock->characteristic->horn}}"
                            autocomplete="off" class="w-full bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Horn State">
                            @error('horn')
                                <p class="text-red-500 text-sm pt-2 text-left px-8 w-full">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
    </form>
</dialog>


<script>
    const myDialog = document.getElementById('navbarModal');
    const editHerd = document.getElementById('editHerd');

    myDialog.addEventListener('click', (event) => {
    if (event.target === myDialog) {
        myDialog.close();
    }
  });

  editHerd.addEventListener('click', (event) => {
    if (event.target === editHerd) {
        editHerd.close();
    }
  });

  document.getElementById("profile").onchange = function(){
        document.getElementById('profilePicture').src = URL.createObjectURL(profile.files[0]);
    }
</script>

@include('partials.__footer')