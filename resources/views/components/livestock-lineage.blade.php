<style>
    .parent {
        display: grid;
        grid-template-columns: repeat(9, 1fr);
        grid-template-rows: repeat(7, 1fr);
        grid-column-gap: 0px;
        padding: 1rem 2rem;
        grid-row-gap: 0px;
        gap: 0px 10px;
        overflow-x: scroll;
    }

    /* Add a new class for the style */

    .GGP1M { grid-area: 1 / 1 / 2 / 2; }
    .GGP2M { grid-area: 3 / 1 / 4 / 2; }
    .GGP3M { grid-area: 5 / 1 / 6 / 2; }
    .GGP4M { grid-area: 7 / 1 / 8 / 2; }
    .GP1M { grid-area: 2 / 2 / 3 / 3; }
    .GP2M { grid-area: 6 / 2 / 7 / 3; }
    .M { grid-area: 4 / 3 / 5 / 4; }
    .ME { grid-area: 4 / 5 / 5 / 6; }
    .F { grid-area: 4 / 7 / 5 / 8; }
    .GP1F { grid-area: 2 / 8 / 3 / 9; }
    .GP2F { grid-area: 6 / 8 / 7 / 9; }
    .GGP1F { grid-area: 7 / 9 / 8 / 10; }
    .GGP2F { grid-area: 5 / 9 / 6 / 10; }
    .GGP3F { grid-area: 3 / 9 / 4 / 10; }
    .GGP4F { grid-area: 1 / 9 / 2 / 10; }
</style>

<h1 class="form-title font-bold text-3xl text-green-950 uppercase pb-2 w-full text-center my-5">Lineage Information</h1>

<div class="parent border-2 px-4 py-5 bg-gray-200 rounded-lg shadow-lg" id="lineageContainer">
        
        @if(!empty($sireGGPSire1))
            <a href="/herd/edit?livestock_id={{$sireGGPSire1->RFID_TAG}}" target="_blank" class="GGP1M border-gray-200 border-2 hover:shadow-2xl hover:border-green-500 hover:shadow-green-400 duration-200 bg-white drop-shadow-xl rounded-xl text-center">
                <div class="px-10 pt-10 pb-5">
                    <h1 class="font-bold text-lg uppercase">{{$sireGGPSire1->livestockInfo->given_name}}</h1>
                    <p>{{$sireGGPSire1->RFID_TAG}}</p>
                </div>
                <div class="w-full bg-primary py-3 rounded-b-lg">
                    <h1 class="text-center font-bold uppercase text-white">Great-grandparents</h1>
                </div>
            </a>
        @endif

        @if(!empty($sireGGPDam1))
            <a href="/herd/edit?livestock_id={{$sireGGPDam1->RFID_TAG}}" target="_blank" class="GGP2M border-gray-200 border-2 hover:shadow-2xl hover:border-green-500 hover:shadow-green-400 duration-200 bg-white drop-shadow-xl rounded-xl text-center">
                <div class="px-10 pt-10 pb-5">
                    <h1 class="font-bold text-lg uppercase">{{$sireGGPDam1->livestockInfo->given_name}}</h1>
                    <p>{{$sireGGPDam1->RFID_TAG}}</p>
                </div>
                <div class="w-full bg-primary py-3 rounded-b-lg">
                    <h1 class="text-center font-bold uppercase text-white">Great-grandparents</h1>
                </div>
            </a>    
        @endif

        @if(!empty($sireGGPSire2))
            <a href="/herd/edit?livestock_id={{$sireGGPSire2->RFID_TAG}}" target="_blank" class="GGP3M border-gray-200 border-2 hover:shadow-2xl hover:border-green-500 hover:shadow-green-400 duration-200 bg-white drop-shadow-xl rounded-xl text-center">
                <div class="px-10 pt-10 pb-5">
                    <h1 class="font-bold text-lg uppercase">{{$sireGGPSire2->livestockInfo->given_name}}</h1>
                    <p>{{$sireGGPSire2->RFID_TAG}}</p>
                </div>
                <div class="w-full bg-primary py-3 rounded-b-lg">
                    <h1 class="text-center font-bold uppercase text-white">Great-grandparents</h1>
                </div>
            </a>
        @endif

        @if(!empty($sireGGPDam2))
            <a href="/herd/edit?livestock_id={{$sireGGPDam2->RFID_TAG}}" target="_blank" class="GGP4M border-gray-200 border-2 hover:shadow-2xl hover:border-green-500 hover:shadow-green-400 duration-200 bg-white drop-shadow-xl rounded-xl text-center">
                <div class="px-10 pt-10 pb-5">
                    <h1 class="font-bold text-lg uppercase">{{$sireGGPDam2->livestockInfo->given_name}}</h1>
                    <p>{{$sireGGPDam2->RFID_TAG}}</p>
                </div>
                <div class="w-full bg-primary py-3 rounded-b-lg">
                    <h1 class="text-center font-bold uppercase text-white">Great-grandparents</h1>
                </div>
            </a>
        @endif

        @if(!empty($sireGPSire))
            <a href="/herd/edit?livestock_id={{$sireGPSire->RFID_TAG}}" target="_blank" class="GP1M border-gray-200 border-2 hover:shadow-2xl hover:border-green-500 hover:shadow-green-400 duration-200 bg-white drop-shadow-xl rounded-xl text-center">
                <div class="px-10 pt-10 pb-5">
                    <h1 class="font-bold text-lg uppercase">{{$sireGPSire->livestockInfo->given_name}}</h1>
                    <p>{{$sireGPSire->RFID_TAG}}</p>
                </div>
                <div class="w-full bg-primary py-3 rounded-b-lg">
                    <h1 class="text-center font-bold uppercase text-white">grandparents</h1>
                </div>
            </a>
        @endif

        @if(!empty($sireGPDam))
            <a href="/herd/edit?livestock_id={{$sireGPDam->RFID_TAG}}" target="_blank" class="GP2M border-gray-200 border-2 hover:shadow-2xl hover:border-green-500 hover:shadow-green-400 duration-200 bg-white drop-shadow-xl rounded-xl text-center">
                <div class="px-10 pt-10 pb-5">
                    <h1 class="font-bold text-lg uppercase">{{$sireGPDam->livestockInfo->given_name}}</h1>
                    <p>{{$sireGPDam->RFID_TAG}}</p>
                </div>
                <div class="w-full bg-primary py-3 rounded-b-lg">
                    <h1 class="text-center font-bold uppercase text-white">grandparents</h1>
                </div>
            </a>
        @endif

        @if(!empty($sire))
            <a href="/herd/edit?livestock_id={{$sire->RFID_TAG}}" target="_blank" class="M border-gray-200 border-2 hover:shadow-2xl hover:border-green-500 hover:shadow-green-400 duration-200 bg-white drop-shadow-xl rounded-xl text-center">
                <div class="px-10 pt-10 pb-5">
                    <h1 class="font-bold text-lg uppercase">{{$sire->livestockInfo->given_name}}</h1>
                    <p>{{$sire->RFID_TAG}}</p>
                </div>
                <div class="w-full bg-primary py-3 rounded-b-lg">
                    <h1 class="text-center font-bold uppercase text-white">Mother</h1>
                </div>
            </a>
        @endif

        @if(!empty($livestock))
            <a href="/herd/edit?livestock_id={{$livestock->RFID_TAG}}" target="_blank" class="ME border-gray-200 border-2 hover:shadow-2xl hover:border-green-900 hover:shadow-green-800 duration-200 bg-white drop-shadow-xl rounded-xl text-center">
                <div class="px-10 pt-10 pb-5">
                    <h1 class="font-bold text-lg uppercase">{{$livestock->livestockInfo->given_name}}</h1>
                    <p>{{$livestock->RFID_TAG}}</p>
                </div>
                <div class="w-full bg-accent py-3 rounded-b-lg">
                    <h1 class="text-center font-bold uppercase text-white">YOU</h1>
                </div>
            </a>
        @endif

        @if(!empty($dam))
            <a href="/herd/edit?livestock_id={{$dam->RFID_TAG}}" target="_blank" class="F border-gray-200 border-2 hover:shadow-2xl hover:border-orange-500 hover:shadow-orange-400 duration-200 bg-white drop-shadow-xl rounded-xl text-center">
                <div class="px-10 pt-10 pb-5">
                    <h1 class="font-bold text-lg uppercase">{{$dam->livestockInfo->given_name}}</h1>
                    <p>{{$dam->RFID_TAG}}</p>
                </div>
                <div class="w-full bg-secondary py-3 rounded-b-lg">
                    <h1 class="text-center font-bold uppercase text-white">Father</h1>
                </div>
            </a>
        @endif
        
        @if(!empty($damGPSire))
            <a href="/herd/edit?livestock_id={{$damGPSire->RFID_TAG}}" target="_blank" class="GP1F border-gray-200 border-2 hover:shadow-2xl hover:border-orange-500 hover:shadow-orange-400 duration-200 bg-white drop-shadow-xl rounded-xl text-center">
                <div class="px-10 pt-10 pb-5">
                    <h1 class="font-bold text-lg uppercase">{{$damGPSire->livestockInfo->given_name}}</h1>
                    <p>{{$damGPSire->RFID_TAG}}</p>
                </div>
                <div class="w-full bg-secondary py-3 rounded-b-lg">
                    <h1 class="text-center font-bold uppercase text-white">grandparents</h1>
                </div>
            </a>
        @endif

        @if(!empty($damGPDam))
            <a href="/herd/edit?livestock_id={{$damGPDam->RFID_TAG}}" target="_blank" class="GP2F border-gray-200 border-2 hover:shadow-2xl hover:border-orange-500 hover:shadow-orange-400 duration-200 bg-white drop-shadow-xl rounded-xl text-center">
                <div class="px-10 pt-10 pb-5">
                    <h1 class="font-bold text-lg uppercase">{{$damGPDam->livestockInfo->given_name}}</h1>
                    <p>{{$damGPDam->RFID_TAG}}</p>
                </div>
                <div class="w-full bg-secondary py-3 rounded-b-lg">
                    <h1 class="text-center font-bold uppercase text-white">grandparents</h1>
                </div>
            </a>
        @endif

        @if(!empty($damGGPSire1))
            <a href="/herd/edit?livestock_id={{$damGGPSire1->RFID_TAG}}" target="_blank" class="GGP1F border-gray-200 border-2 hover:shadow-2xl hover:border-orange-500 hover:shadow-orange-400 duration-200 bg-white drop-shadow-xl rounded-xl text-center">
                <div class="px-10 pt-10 pb-5">
                    <h1 class="font-bold text-lg uppercase">{{$damGGPSire1->livestockInfo->given_name}}</h1>
                    <p>{{$damGGPSire1->RFID_TAG}}</p>
                </div>
                <div class="w-full bg-secondary py-3 rounded-b-lg">
                    <h1 class="text-center font-bold uppercase text-white">Great-grandparents</h1>
                </div>
            </a>
        @endif

        @if(!empty($damGGPDam1))
            <a href="/herd/edit?livestock_id={{$damGGPDam1->RFID_TAG}}" target="_blank" class="GGP2F border-gray-200 border-2 hover:shadow-2xl hover:border-orange-500 hover:shadow-orange-400 duration-200 bg-white drop-shadow-xl rounded-xl text-center">
                <div class="px-10 pt-10 pb-5">
                    <h1 class="font-bold text-lg uppercase">{{$damGGPDam1->livestockInfo->given_name}}</h1>
                    <p>{{$damGGPDam1->RFID_TAG}}</p>
                </div>
                <div class="w-full bg-secondary py-3 rounded-b-lg">
                    <h1 class="text-center font-bold uppercase text-white">Great-grandparents</h1>
                </div>
            </a>
        @endif

        @if(!empty($damGGPSire2))
            <a href="/herd/edit?livestock_id={{$damGGPSire2->RFID_TAG}}" target="_blank" class="GGP3F border-gray-200 border-2 hover:shadow-2xl hover:border-orange-500 hover:shadow-orange-400 duration-200 bg-white drop-shadow-xl rounded-xl text-center">
                <div class="px-10 pt-10 pb-5">
                    <h1 class="font-bold text-lg uppercase">{{$damGGPSire2->livestockInfo->given_name}}</h1>
                    <p>{{$damGGPSire2->RFID_TAG}}</p>
                </div>
                <div class="w-full bg-secondary py-3 rounded-b-lg">
                    <h1 class="text-center font-bold uppercase text-white">Great-grandparents</h1>
                </div>
            </a>
        @endif

        @if(!empty($damGGPDam2))
            <a href="/herd/edit?livestock_id={{$damGGPDam2->RFID_TAG}}" target="_blank" class="GGP4F border-gray-200 border-2 hover:shadow-2xl hover:border-orange-500 hover:shadow-orange-400 duration-200 bg-white drop-shadow-xl rounded-xl text-center">
                <div class="px-10 pt-10 pb-5">
                    <h1 class="font-bold text-lg uppercase">{{$damGGPDam2->livestockInfo->given_name}}</h1>
                    <p>{{$damGGPDam2->RFID_TAG}}</p>
                </div>
                <div class="w-full bg-secondary py-3 rounded-b-lg">
                    <h1 class="text-center font-bold uppercase text-white">Great-grandparents</h1>
                </div>
            </a>
        @endif
</div>

<script>
    // Function to scroll to the center of the container
    function scrollToCenter() {
            const container = document.getElementById('lineageContainer');
            container.scrollLeft = (container.scrollWidth - container.clientWidth) / 2;
        }

        // Scroll to the center when the page is reloaded
        window.addEventListener('load', scrollToCenter);
</script>



{{-- 
OUTLINE:

1. GGP1M & GGP2M -> GP1M
2. GGP3M & GGP4M -> GP2M

3. GP1M & GP2M -> M

4. M & F -> ME

5. GP1F & GP2F -> F

6. GGP1F & GGP2F -> GP1F
7. GGP3F & GGP4F -> GP2F --}}