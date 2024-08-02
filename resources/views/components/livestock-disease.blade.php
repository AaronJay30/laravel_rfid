{{-- <h1 class="form-title text-5xl mt-10 text-gray-300 pb-2 w-full text-center col-span-4">No Disease Information</h1> --}}
<h1 class="form-title font-bold text-3xl text-green-950 uppercase pb-2 w-full text-center">Breed Information</h1>
{{-- <div class="flex flex-row text-right justify-end ml-auto button-container mb-4">
    <button onclick="addBreed.showModal()" class="text-white mx-2 bg-green-700 text-md hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-16 py-2.5 text-center inline-flex items-center">
        Add Disease Information
    </button>
</div> --}}

@if($deworming->isEmpty() && $vaccinations->isEmpty())
    <h1 class="form-title text-5xl mt-10 text-gray-300 pb-2 w-full text-center col-span-4">No Disease Information</h1>
@else 
    <div class="w-full p-10 flex flex-col">
        <div class="flex flex-col w-full">
            <h2 class="text-xl font-medium uppercase text-green-900 text-left w-full">Vaccination Information</h2>
            <div class="relative overflow-x-auto w-full max-h-[300px]">
                <table class="border-2 text-center text-md border-green-900 my-4 w-full">
                    <thead class="border-b-2 border-green-900 font-medium uppercase">
                        <tr>
                            <th scope="col" class="border-r-2 font-bold uppercase bg-green-950 text-white border-green-900 px-6 py-4 whitespace-nowrap">
                                Scheduled Date
                            </th>
                            <th scope="col" class="border-r-2 font-bold uppercase bg-green-950 text-white border-green-900 px-6 py-4 whitespace-nowrap">
                                Type of Medicine
                            </th>
                            <th scope="col" class="border-r-2 font-bold uppercase bg-green-950 text-white border-green-900 px-6 py-4 whitespace-nowrap">
                                Symptoms
                            </th>
                            <th scope="col" class="border-r-2 font-bold uppercase bg-green-950 text-white border-green-900 px-6 py-4 whitespace-nowrap">
                                Type of Treatment
                            </th>
                            <th scope="col" class="border-r-2 font-bold uppercase bg-green-950 text-white border-green-900 px-6 py-4 whitespace-nowrap">
                                Weight
                            </th>
                            <th scope="col" class="border-r-2 font-bold uppercase bg-green-950 text-white border-green-900 px-6 py-4 whitespace-nowrap">
                                Temperature
                            </th>
                            <th scope="col" class="border-r-2 font-bold uppercase bg-green-950 text-white border-green-900 px-6 py-4 whitespace-nowrap">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="border-b-2 border-green-900 font-medium">
                        @if($vaccinations->isEmpty())
                            <tr class="border-b-2 border-green-900">
                                <td colspan="10" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap" >
                                    No Vaccination Record
                                </td>
                            </tr>
                        @else
                            @foreach ($vaccinations as $vaccination)
                                <tr class="border-b-2 border-green-900">
                                    <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap" >
                                        {{ \Carbon\Carbon::parse($vaccination->date)->format('F d, Y') }}
                                    </td>
                                    <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap" >
                                        {{$vaccination->medicine}}
                                    </td>
                                    <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap" >
                                        {{$vaccination->symptoms}}
                                    </td>
                                    <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap" >
                                        {{$vaccination->treatment}}
                                    </td>
                                    <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap" >
                                        {{$vaccination->weight}} KG
                                    </td>
                                    <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap" >
                                        {{$vaccination->temperature}} °C
                                    </td>
                                    <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap" >
                                        <button class="py-2.5 px-5 bg-green-700 hover:bg-green-500 duration-100 text-white rounded-xl"  onclick="getDisease({{$vaccination->SCHED_ID}})">Edit</button>
                                    </td>
                                </tr>
                            @endforeach
                            
                        @endif
                       
                        
                    </tbody>
                </table>
            </div>

            <h2 class="text-xl font-medium uppercase text-green-900 text-left w-full mt-10">Deworming Information</h2>
            <div class="relative overflow-x-auto w-full max-h-[300px]">
                <table class="border-2 text-center text-md border-green-900 my-4 w-full">
                    <thead class="border-b-2 border-green-900 font-medium uppercase">
                        <tr>
                            <th scope="col" class="border-r-2 font-bold uppercase bg-green-950 text-white border-green-900 px-6 py-4 whitespace-nowrap">
                                Scheduled Date
                            </th>
                            <th scope="col" class="border-r-2 font-bold uppercase bg-green-950 text-white border-green-900 px-6 py-4 whitespace-nowrap">
                                Type of Medicine
                            </th>
                            <th scope="col" class="border-r-2 font-bold uppercase bg-green-950 text-white border-green-900 px-6 py-4 whitespace-nowrap">
                                Symptoms
                            </th>
                            <th scope="col" class="border-r-2 font-bold uppercase bg-green-950 text-white border-green-900 px-6 py-4 whitespace-nowrap">
                                Type of Treatment
                            </th>
                            <th scope="col" class="border-r-2 font-bold uppercase bg-green-950 text-white border-green-900 px-6 py-4 whitespace-nowrap">
                                Weight
                            </th>
                            <th scope="col" class="border-r-2 font-bold uppercase bg-green-950 text-white border-green-900 px-6 py-4 whitespace-nowrap">
                                Temperature
                            </th>
                            <th scope="col" class="border-r-2 font-bold uppercase bg-green-950 text-white border-green-900 px-6 py-4 whitespace-nowrap">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="border-b-2 border-green-900 font-medium">
                        @if($deworming->isEmpty())
                            <tr class="border-b-2 border-green-900">
                                <td colspan="10" class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap" >
                                    No Deworming Record
                                </td>
                            </tr>
                        @else
                            @foreach ($deworming as $deworm)
                                <tr class="border-b-2 border-green-900">
                                    <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap" >
                                        {{ \Carbon\Carbon::parse($deworm->date)->format('F d, Y') }}
                                    </td>
                                    <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap" >
                                        {{$deworm->medicine}}
                                    </td>
                                    <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap" >
                                        {{$deworm->symptoms}}
                                    </td>
                                    <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap" >
                                        {{$deworm->treatment}}
                                    </td>
                                    <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap" >
                                        {{$deworm->weight}} KG
                                    </td>
                                    <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap" >
                                        {{$deworm->temperature}} °C
                                    </td>
                                    <td class="border-r-2 border-green-900 px-6 py-4 whitespace-nowrap" >
                                        <button class="py-2.5 px-8 bg-green-700 hover:bg-green-500 duration-100 text-white rounded-xl" onclick="getDisease({{$deworm->SCHED_ID}})">Edit</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

<dialog id="editDisease" class="w-2/3 max-[1100px]:w-full px-5 backdrop:bg-black backdrop:opacity-80 rounded-2xl">
    <div class="flex justify-between">

        <button onclick="editDisease.close()">
            <div class="add bg-orange-500 hover:bg-orange-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                <i class='bx bx-x'></i>
            </div>
        </button>

        <button type="submit" form="editDiseaseForm">
            <div class="add bg-green-500 hover:bg-green-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                <i class='bx bx-save'></i>
            </div>
        </button>
    
    </div>
    <form action="{{route('update.disease')}}" method="POST" id="editDiseaseForm">
        @csrf
    
        <div class="form-container border-t-[2px] my-5">
            <h1 class="form-title font-bold text-3xl text-green-950 uppercase my-3 w-full text-center">Edit Disease Information</h1>

            {{-- FORM --}}

            <input type="hidden" name="RFID_TAG" value="{{$livestock->RFID_TAG}}">
            <input type="hidden" name="SCHED_ID" id="SCHED_ID" value="">
            <div class="grid-cols-2 max-[1000px]:grid-cols-1 grid gap-4">
                <div class="flex flex-col sm:px-10 px-5 mb-1 col-span-1">
                    <h1 class="text-left mb-2 w-full text-green-950">Event</h1>
                    <select autocomplete="off" name="event" value="" id="event" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);"> 
                        <option value="" selected disabled>Select an event</option>
                        <option value="Deworming">Deworming</option>
                        <option value="Vaccination">Vaccination</option>
                    </select>
                    @error('event')
                        <p class="text-red-500 w-full text-sm py-3 ml-3">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col sm:px-10 px-5 mb-1 col-span-1">
                    <h1 class="text-left mb-2 w-full text-green-950">Medicine</h1>
                    <input type="text" autocomplete="off" name="medicine" id="medicine" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter the medicine" value="">
                    @error('medicine')
                        <p class="text-red-500 w-full text-sm py-3 ml-3">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col sm:px-10 px-5 mb-1 col-span-1">
                    <h1 class="text-left mb-2 w-full text-green-950">Treatment</h1>
                    <input type="text" autocomplete="off" name="treatment" id="treatment" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter the treatment" value="">
                    @error('treatment')
                        <p class="text-red-500 w-full text-sm py-3 ml-3">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col sm:px-10 px-5 mb-1 col-span-1">
                    <h1 class="text-left mb-2 w-full text-green-950">Symptoms</h1>
                    <input type="text" autocomplete="off" name="symptoms" id="symptoms" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter the symptoms" value="">
                    @error('symptoms')
                        <p class="text-red-500 w-full text-sm py-3 ml-3">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col sm:px-10 px-5 mb-1 col-span-1">
                    <h1 class="text-left mb-2 w-full text-green-950">Weight</h1>
                    <input type="number" min="0" step="0.01" autocomplete="off" id="weight" name="weight" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter the weight" value="">
                    @error('weight')
                        <p class="text-red-500 w-full text-sm py-3 ml-3">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col sm:px-10 px-5 mb-1 col-span-1">
                    <h1 class="text-left mb-2 w-full text-green-950">Temperature</h1>
                    <input type="number" min="0" step="0.01" autocomplete="off" name="temperature" id="temperature" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter the temperature" value="">
                    @error('temperature')
                        <p class="text-red-500 w-full text-sm py-3 ml-3">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col sm:px-10 px-5 mb-1 col-span-1">
                    <h1 class="text-left mb-2 w-full text-green-950">Activity Date</h1>
                    <input type="date" autocomplete="off" name="date" id="date" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter the date" value="">
                    @error('date')
                        <p class="text-red-500 w-full text-sm py-3 ml-3">
                            {{$message}}
                        </p>
                    @enderror
                </div>

            </div>
        </div>
    </form>

</dialog>

<script>
    function getDisease(id){
        console.log(id);
        $.ajax({
            url: '/ajaxDisease',
            method: "POST",
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            data: {
                'id': id,
            }, success:function(result){
                let modal = document.getElementById('editDisease');

                var datas = result.sched;

                let event = document.getElementById('event');
                let medicine = document.getElementById('medicine');
                let treatment = document.getElementById('treatment');
                let symptoms = document.getElementById('symptoms');
                let date = document.getElementById('date');
                let temperature = document.getElementById('temperature');
                let weight = document.getElementById('weight');
                let SCHED_ID = document.getElementById('SCHED_ID');

                
                event.value = datas.event;
                medicine.value = datas.medicine;
                treatment.value = datas.treatment;
                symptoms.value = datas.symptoms;
                date.value = datas.date;
                temperature.value = datas.temperature;
                weight.value = datas.weight;
                SCHED_ID.value = datas.SCHED_ID;
   

                modal.showModal();
            }, error:function(e){
                console.log(e);
            }
        });
    }
</script>