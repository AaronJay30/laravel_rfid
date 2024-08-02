<h1 class="form-title font-bold text-3xl text-green-950 uppercase pb-2 w-full text-center">Breed Information</h1>
<div class="flex flex-row text-right justify-end ml-auto button-container mt-5 mb-4">
    <button onclick="addBreed.showModal()" class="text-white mx-2 bg-green-700 text-md hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-16 py-2.5 text-center inline-flex items-center">
        Add Breed
    </button>

    @if($breed->isNotEmpty())
        <button onclick="editBreed.showModal()" class="text-white mx-2 bg-green-700 text-md hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-16 py-2.5 text-center inline-flex items-center">
            Edit Info
        </button>
    @endif
</div>

<div class="lower-container grid grid-cols-4 gap-5 mt-5">
    @if($breed->isNotEmpty())
        @foreach ($breed as $item)
            <div class="lower-info-container col-span-2 flex flex-col gap-2 ml-16 mb-5">
                <div class="flex flex-row gap-4 w-full">
                    <h1 class="font-bold md:text-xl text-md text-green-950 text-left">Breed Type:</h1>
                        <span class="md:text-xl text-md">{{ $item->breedDetails->breed_type }}</span>
                </div>
                <div class="flex flex-row gap-4 w-full">
                    <h1 class="font-bold md:text-xl text-md text-green-950 text-left">Dam ID:</h1>
                        <span class="md:text-xl text-md">{{ $item->breedDetails->dam_id }}</span>
                </div>
                <div class="flex flex-row gap-4 w-full">
                    <h1 class="font-bold md:text-xl text-md text-green-950 text-left">Sire ID:</h1>
                        <span class="md:text-xl text-md">{{ $item->breedDetails->sire_id }}</span>
                </div>
                <div class="flex flex-row gap-4 w-full">
                    <h1 class="font-bold md:text-xl text-md text-green-950 text-left">Dam Breed Count:</h1>
                        <span class="md:text-xl text-md">{{ $item->breedDetails->dam_breed_count }}</span>
                </div>
                <div class="flex flex-row gap-4 w-full">
                    <h1 class="font-bold md:text-xl text-md text-green-950 text-left">Sire Breed Count:</h1>
                        <span class="md:text-xl text-md">{{ $item->breedDetails->sire_breed_count }}</span>
                </div>
                <div class="flex flex-row gap-4 w-full">
                    <h1 class="font-bold md:text-xl text-md text-green-950 text-left">Breed Date:</h1>
                        <span class="md:text-xl text-md">{{\Carbon\Carbon::parse($item->breedDetails->breed_date)->format('F d Y')}}</span>
                </div>
            </div>

            @php
                $kidIds = explode(',', $item->KID_IDs);
                $kidNum = 0;
                $breedId = $item->breedDetails->BID;
            @endphp

            @foreach ($kidIds as $kidId)

                @php
                    $kidBirth = App\Models\BreedKidBirth::find($kidId);
                    $kidNum ++;
                @endphp
                
                    @if ($kidBirth)
                        <div class="lower-info-container col-span-2 flex flex-col gap-2 ml-16 mt-5">
                            <h1 class="form-title font-bold text-2xl text-green-950 text-left uppercase pb-2 w-full mb-5">Birth Progress - (KID {{$kidNum}})</h1>
                            <div class="flex flex-row gap-4 w-full">
                                <h1 class="font-bold md:text-xl text-md text-green-950 text-left">Kid Birth Date:</h1>
                                @if (!empty($kidBirth->kid_birth_date))
                                    <span class="md:text-xl text-md">{{ \Carbon\Carbon::parse($kidBirth->kid_birth_date)->format('F d Y') }}</span>
                                @else
                                    <span class="md:text-xl text-md">Not Available </span> 
                                @endif
                            </div>
                            <div class="flex flex-row gap-4 w-full">
                                <h1 class="font-bold md:text-xl text-md text-green-950 text-left">Kid Birth Weight:</h1>
                                <span class="md:text-xl text-md">{{$kidBirth->kid_weight ?? "Not Available"}}</span>
                            </div>
                            <div class="flex flex-row gap-4 w-full">
                                <h1 class="font-bold md:text-xl text-md text-green-950 text-left">Kid Birth Height:</h1>
                                <span class="md:text-xl text-md">{{$kidBirth->kid_length ?? "Not Available"}}</span>
                            </div>
                        </div>
                    @endif
            @endforeach
            <div class="mt-4 col-span-4 w-full">
                {{ $breed->appends(\Request::except('breedPage'))->links('pagination::tailwind') }}
                

            </div>
        @endforeach
    @else 
        <h1 class="form-title text-5xl mt-10 text-gray-300 pb-2 w-full text-center col-span-4">No Breed Information</h1>
    @endif

    
</div>

<dialog id="addBreed" class="w-2/3 px-5 backdrop:bg-black backdrop:opacity-80 rounded-2xl">
    <div class="flex justify-between">

        <button onclick="addBreed.close()">
            <div class="add bg-orange-500 hover:bg-orange-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                <i class='bx bx-x'></i>
            </div>
        </button>

        <button type="submit" form="addBreedForm">
            <div class="add bg-green-500 hover:bg-green-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                <i class='bx bx-save'></i>
            </div>
        </button>
    
    </div>
    <form action="{{route('livestock.breed.add')}}" method="POST" id="addBreedForm">
        @csrf
    
        <div class="form-container border-t-[2px] my-5">
            <h1 class="form-title font-bold text-3xl text-green-950 uppercase my-3 w-full text-center">Add Breed Information</h1>

            {{-- FORM --}}
            <div class="grid-cols-2 grid gap-4">
                <div class="addFormBreed col-span-1">
                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Breed Type</h1>
                        <input type="text" autocomplete="off" value="{{old('breed_type')}}" name="breed_type" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter breed type">
                        @error('breed_type')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
        
                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Dam ID:</h1>
                        <input type="text" autocomplete="off" value="{{old('dam_id', '9910050010090')}}" name="dam_id" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Scan the RFID or manual entering of Dam ID">
                        @error('dam_id')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
        
                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Sire ID:</h1>
                        <input type="text" autocomplete="off" value="{{old('sire_id', '9910050010090')}}" name='sire_id' class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Scan the RFID or manual entering of Sire ID">
                        @error('sire_id')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror    
                    </div>
                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Sire Breed Count:</h1>
                        <input type="number" min="0" max="99" autocomplete="off" value="{{old('sire_breed_count')}}" name="sire_breed_count" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter Sire Breed Count">
                        @error('sire_breed_count')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
        
                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Dam Breed Count</h1>
                        <input type="number" min="0" max="99" autocomplete="off" value="{{old('dam_breed_count')}}" name="dam_breed_count" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter Dam Breed Count">
                        @error('dam_breed_count')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
        
                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Breed Date</h1>
                        <input type="date" autocomplete="off" value="{{old('breed_date')}}" name="breed_date" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter breeding date">
                        @error('breed_date')
                            <p class="text-red-500 w-full text-sm py-3 ml-3">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                    
                </div>
        
                <div class="addFormBirth col-span-1">
                    <h1 class="form-title font-bold text-2xl mt-7 sm:px-10 px-5 text-green-950 text-left uppercase pb-2 w-full">Kid Birth Progress</h1>
        
                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Birth Date</h1>
                        <input type="date" autocomplete="off"  name="birth_date[]" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter Birth Date">
                        
                    </div>
        
                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Birth Weight</h1>
                        <input type="text" autocomplete="off" name="birth_weight[]" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter Birth Weight">
                        
                    </div>
        
                    <div class="flex flex-col sm:px-10 px-5 mb-1">
                        <h1 class="text-left mb-2 w-full text-green-950">Birth Length</h1>
                        <input type="text" autocomplete="off" name="birth_length[]" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter Birth Length">
                        
                    </div>
                    <button type="button" class="deleteKidButton ml-10 mr-2 mt-5 bg-red-500 hover:bg-red-700 duration-200 rounded-lg sm:px-10 px-5 py-2.5 text-md text-white">Delete Kid</button>
                    <button type="button" id="addKidButton" class="ml-8 mr-2 mt-5 bg-green-500 hover:bg-green-700 duration-200 rounded-lg sm:px-10 px-5 py-2.5 text-md text-white">Add Kid</button>
                </div>
            </div>
        </div>
    </form>

</dialog>

@if($breed->isNotEmpty())
    <dialog id="editBreed" class="w-2/3 px-5 backdrop:bg-black backdrop:opacity-80 rounded-2xl">
        <div class="flex justify-between">

            <button onclick="editBreed.close()">
                <div class="add bg-orange-500 hover:bg-orange-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                    <i class='bx bx-x'></i>
                </div>
            </button>

            <form action="{{route('livestock.breed.delete', ['breed' => $breedId])}}" method="POST">
                @method('delete')
                @csrf
                <input type="hidden" name="page" value="{{$breed->currentPage()}}">
                <button type="submit">
                    <div class="add bg-red-500 hover:bg-red-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                        <i class='bx bx-trash'></i>
                    </div>
                </button>
            </form>

            <button type="submit" form="editBreedForm">
                <div class="add bg-green-500 hover:bg-green-700 duration-200 rounded-lg px-3 py-2.5 text-3xl text-white">
                    <i class='bx bx-save'></i>
                </div>
            </button>
        
        </div>
        <form action="{{route('livestock.breed.edit')}}" method="POST" id="editBreedForm">
            @csrf
            @foreach ($breed as $item)
                <div class="form-container border-t-[2px] my-5">
                    <h1 class="form-title font-bold text-3xl text-green-950 uppercase my-3 w-full text-center">Edit Breed Information</h1>

                    {{-- FORM --}}
                    <div class="grid-cols-2 grid gap-4">
                        <input type="hidden" name="breed_details_id" value="{{$item->breedDetails->BID}}">
                        <div class="addFormBreed col-span-1">
                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">Breed Type</h1>
                                <input type="text" autocomplete="off" value="{{$item->breedDetails->breed_type}}" name="breed_type" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter breed type">
                                @error('breed_type')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                
                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">Dam ID:</h1>
                                <input type="text" autocomplete="off" value="{{$item->breedDetails->dam_id}}" name="dam_id" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Scan the RFID or manual entering of Dam ID">
                                @error('dam_id')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                
                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">Sire ID:</h1>
                                <input type="text" autocomplete="off" value="{{$item->breedDetails->sire_id}}" name='sire_id' class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Scan the RFID or manual entering of Sire ID">
                                @error('sire_id')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror    
                            </div>
                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">Sire Breed Count:</h1>
                                <input type="number" min="0" max="99" autocomplete="off" value="{{$item->breedDetails->dam_breed_count}}" name="sire_breed_count" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter Sire Breed Count">
                                @error('sire_breed_count')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                
                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">Dam Breed Count</h1>
                                <input type="number" min="0" max="99" autocomplete="off" value="{{$item->breedDetails->sire_breed_count}}" name="dam_breed_count" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter Dam Breed Count">
                                @error('dam_breed_count')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                
                            <div class="flex flex-col sm:px-10 px-5 mb-1">
                                <h1 class="text-left mb-2 w-full text-green-950">Breed Date</h1>
                                <input type="date" autocomplete="off" value="{{$item->breedDetails->breed_date}}" name="breed_date" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter breeding date">
                                @error('breed_date')
                                    <p class="text-red-500 w-full text-sm py-3 ml-3">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            
                        </div>
                        
                        @php
                            $kidIdsEdit = explode(',', $item->KID_IDs);
                            $kidNextIncrement = App\Models\BreedKidBirth::query()
                                                ->max('KID_ID') + 1;
                            $kidNumEdit = 0;
                        @endphp
            
                        @foreach ($kidIdsEdit as $kidIdEdit)
            
                        @php
                            $kidBirthEdit = App\Models\BreedKidBirth::find($kidIdEdit);
                            $kidNumEdit ++;
                        @endphp

                            
                            <div class="editFormBirth col-span-1">
                                <input type="hidden" name="breed_kid_id[]" value="{{$kidBirthEdit->KID_ID}}">

                                <h1 class="form-title font-bold text-2xl mt-7 sm:px-10 px-5 text-green-950 text-left uppercase pb-2 w-full">Kid Birth Progress</h1>
                    
                                <div class="flex flex-col sm:px-10 px-5 mb-1">
                                    <h1 class="text-left mb-2 w-full text-green-950">Birth Date</h1>
                                    <input type="date" autocomplete="off" value="{{$kidBirthEdit->kid_birth_date}}"  name="birth_date[]" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter Birth Date">
                                    
                                </div>
                    
                                <div class="flex flex-col sm:px-10 px-5 mb-1">
                                    <h1 class="text-left mb-2 w-full text-green-950">Birth Weight</h1>
                                    <input type="text" autocomplete="off" value="{{$kidBirthEdit->kid_weight}}" name="birth_weight[]" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter Birth Weight">
                                    
                                </div>
                    
                                <div class="flex flex-col sm:px-10 px-5 mb-1">
                                    <h1 class="text-left mb-2 w-full text-green-950">Birth Length</h1>
                                    <input type="text" autocomplete="off" value="{{$kidBirthEdit->kid_length}}" name="birth_length[]" class="w-[100%] bg-gray-100 rounded-lg border-0 border-b-[1px] border-accent focus:ring-green-500 focus:border-green-500 text-gray-900 text-sm block py-2.5 px-5" style="box-shadow: 0px 2px 4px 2px rgba(0, 0, 0, 0.25);" placeholder="Enter Birth Length">
                                    
                                </div>
                                <button type="button" class="deleteKidButton_edit ml-10 mr-2 mt-5 bg-red-500 hover:bg-red-700 duration-200 rounded-lg sm:px-10 px-5 py-2.5 text-md text-white">Delete Kid</button>
                                <button type="button" id="addKidButton_edit" class="ml-8 mr-2 mt-5 bg-green-500 hover:bg-green-700 duration-200 rounded-lg sm:px-10 px-5 py-2.5 text-md text-white">Add Kid</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </form>

    </dialog>
@endif

@if($breed->isNotEmpty())
    <script>
        let kidNextIncrement = {{ $kidNextIncrement }};
    </script>
@endif

<script>
    $(document).ready(function() {

        // Handle duplication when the "Add Kid" button is clicked
        $(document).on('click', '#addKidButton_edit', function() {
            const kidForm = $('.editFormBirth').first(); // Get the first .editFormBirth element

            const clonedBreedKidBirth = kidForm.clone();

            // Clear the values of the cloned form inputs
            const clonedInputs = clonedBreedKidBirth.find("input[type='text'], input[type='date'], input[type='hidden']");
            clonedInputs.val("");

            kidNextIncrement++;

            const clonedInput = clonedBreedKidBirth.find("input[name='breed_kid_id[]']");
            clonedInput.val(kidNextIncrement);

            // Append the cloned form after the last .editFormBirth element
            $('.editFormBirth').last().after(clonedBreedKidBirth);

            // Check if there's at least one duplicate and show the delete buttons accordingly
            toggleDeleteButtonsEdit();
        });

        // Handle deletion when the "Delete" button is clicked
        $(document).on('click', '.deleteKidButton_edit', function() {
            $(this).closest('.editFormBirth').remove();

            kidNextIncrement--;

            // Check if there's at least one duplicate and show/hide the delete buttons accordingly
            toggleDeleteButtonsEdit();
        });

        // Initially check and toggle the delete button visibility when the page loads
        toggleDeleteButtonsEdit();

        // Function to check if there's at least one duplicate and show/hide the delete buttons accordingly
        function toggleDeleteButtonsEdit() {
            const formsCount = $('.editFormBirth').length;
            $('.deleteKidButton_edit').toggle(formsCount > 1);
        }
    });
</script>

<script>
    $(document).ready(function() {

        // Handle duplication when the "Add Kid" button is clicked
        $(document).on('click', '#addKidButton', function() {
            const kidForm = $('.addFormBirth').first(); // Get the first .addFormBirth element

            const clonedBreedKidBirth = kidForm.clone();

            // Clear the values of the cloned form inputs
            const clonedInputs = clonedBreedKidBirth.find("input[type='text'], input[type='date']");
            clonedInputs.val("");

            // Append the cloned form after the last .addFormBirth element
            $('.addFormBirth').last().after(clonedBreedKidBirth);

            // Check if there's at least one duplicate and show the delete buttons accordingly
            toggleDeleteButtonsAdd();
        });

        // Handle deletion when the "Delete" button is clicked
        $(document).on('click', '.deleteKidButton', function() {
            $(this).closest('.addFormBirth').remove();

            // Check if there's at least one duplicate and show/hide the delete buttons accordingly
            toggleDeleteButtonsAdd();
        });

        // Initially check and toggle the delete button visibility when the page loads
        toggleDeleteButtonsAdd();

        // Function to check if there's at least one duplicate and show/hide the delete buttons accordingly
        function toggleDeleteButtonsAdd() {
            const formsCount = $('.addFormBirth').length;
            $('.deleteKidButton').toggle(formsCount > 1);
        }
    });
</script>


