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
        border: 2px solid transparent;
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

    @media (max-width: 1094px) {
        .lg\:flex {
            display: none !important;
        }
        .modalBtn button{
            width: 100% !important;
        }
    }

    @media (max-width: 768px) {
        .user-container {
            margin-right: 20px;
            margin-left: 20px;
        }
    }
    
</style>


<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white md:w-2/3 w-4/5 user-container border-b-[20px] border-accent lg:ml-[70px] sm:mx-3 mt-5 mb-5 sm:px-10 px-8 py-10 bg-opacity-30 rounded-3xl " style="box-shadow: 0px 4px 9px 5px rgba(0, 0, 0, 0.25);"> 
        
        <div class="sm:flex-row sm:flex flex-col sm:gap-0 gap-3 text-center sm:justify-between w-full">
            <div class="whitespace-nowrap px-4">
                <span class="font-bold text-[27px]  text-[#273617]">USER ACCOUNTS</span>
            </div>
            <form action="{{route('user.search')}}" method="GET">
                <div class="group sm:mt-0 mt-4">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
                    <input autocomplete="off" autofocus placeholder="Search" type="search" name="search" class="search" id="searchInput">
                </div>
            </form>
        </div>

        <hr class="mt-5 border-[1px] rounded-md border-gray-500">

        
        <div class="sm:flex flex-row justify-between pt-4">
            <h1 class=" text-md font-bold">FARM NAME: <span>{{Auth::User()->farm_name}}</span></h1>
            <div class="text-gray-600 sm:mt-0 mt-3">
                Showing {{ $users->firstItem() }} - {{ $users->lastItem() }} out of {{ $users->total() }}
             </div>
        </div>

        <div class="relative overflow-x-scroll shadow-md sm:rounded-lg">


            <table class="w-full text-sm text-left overflow-x-scroll" id="dataTable">
                <thead class="text-sm text-black uppercase bg-gray-100 ">
                    <tr>
                        <th scope="col" class="px-6 py-4 whitespace-nowrap">
                            @sortablelink('id', 'User ID')
                        </th>
                        <th scope="col" class="px-6 py-4  whitespace-nowrap">
                            @sortablelink('first_name', 'First Name')
                        </th>
                        <th scope="col" class="px-6 py-4  whitespace-nowrap">
                            @sortablelink('last_name', 'Last Name')
                        </th>
                        <th scope="col" class="px-6 py-4  whitespace-nowrap">
                            @sortablelink('role', 'Role')
                        </th>
                        <th scope="col" class="px-6 py-4  whitespace-nowrap">
                            @sortablelink('email', 'Email')
                        </th>
                        <th scope="col" class="px-6 py-4  whitespace-nowrap">
                            @sortablelink('created_at', 'Created')
                        </th>
                        <th scope="col" class="px-6 py-4  whitespace-nowrap ">
                            @sortablelink('last_login', 'Last Login')
                        </th>
                        <th scope="col" class="px-2 py-3 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="whitespace-nowrap">
                    @if ($empty)
                        <tr class="hover:bg-gray-200">
                            <td colspan="7" class="text-center text-gray-400 text-xl py-20">
                                <h1>No records found!</h1>
                            </td>
                        </tr>
                    @else
                        @foreach ($users as $key => $user)
                        <tr class="bg-white border-b ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{$user->id}}
                            </th>
                            <td class="px-6 py-4">
                                {{$user->first_name}}
                            </td>
                            <td class="px-6 py-4">
                                {{$user->last_name}}
                            </td>
                            <td class="px-6 py-4">
                                {{$user->role}}
                            </td>
                            <td class="px-6 py-4">
                                {{$user->email}}
                            </td>
                            <td class="px-6 py-4">
                                {{\Carbon\Carbon::parse($user->created_at)->format('F d Y')}}
                            </td>
                            <td class="px-6 py-4">
                                @if ($user->last_login == NULL)
                                    No Login Activity
                                @else
                                    {{\Carbon\Carbon::parse($user->last_login)->format('F d Y - D h:i A')}}
                                @endif
                            </td>
                            <td class="px-2 py-4 flex items-center justify-center">
                                <button class="text-white mx-2 w-20 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300  rounded-lg text-sm px-2.5 py-2.5 text-center inline-flex items-center" onclick="openDialog({{$user}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square mr-3" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                    Edit
                                </button>
                                
                                

                                <form action="{{route('user.delete', ['user' => $user->id])}}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300  rounded-lg text-sm px-2.5 py-2.5 text-center inline-flex items-center disabled:bg-gray-500 " {{Auth::User()->id === $user->id ? 'disabled' : ''}}>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3 mr-3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                                
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{$users->appends(\Request::except('page'))->links('pagination::tailwind')}}
        </div>

        <button onclick="addUser.showModal()" class="w-full py-2.5 mt-4 text-white font-bold bg-green-900 hover:bg-green-700 duration-200 rounded-xl">Add User</button>
    </div>
    <dialog id="editBtn" class="w-full lg:w-2/5 sm:2/4 backdrop:bg-black backdrop:opacity-80 rounded-2xl p-0 pb-2 pt-7">
        <span class="text-3xl text-gray-700 font-semibold ml-7">Update User</span>
        <hr class="w-full border-[1px] border-gray-300 mt-4">
        <form action="{{route('user.update')}}" method="POST">
            @method('PUT')
            @csrf
            <input type="hidden" name="id" id='userid'>
            <div class="grid lg:grid-cols-2 lg:gap-6 px-10 sm:pt-10 pt-4">
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="first_name" id="floating_first_name" class="block py-2.5 px-0 w-full text-md text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " autocomplete="off" />
                    <label for="floating_first_name" class="peer-focus:font-medium absolute text-md text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First name</label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="last_name" id="floating_last_name" class="block py-2.5 px-0 w-full text-md text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " autocomplete="off" />
                    <label for="floating_last_name" class="peer-focus:font-medium absolute text-md text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last name</label>
                </div>
            </div>

            <div class="grid lg:grid-cols-1 lg:gap-6 mb-5 px-10">
                <div class="relative z-0 w-full group">
                    <input type="email" name="email" id="floating_email" class="block py-2.5 px-0 w-full text-md text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " autocomplete="off" />
                    <label for="floating_email" class="peer-focus:font-medium absolute text-md text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                </div>
            </div>

            <div class="grid lg:grid-cols-1 lg:gap-6 mb-5 px-10">
                <div class="relative z-0 w-full group">
                    <input type="password" name="password" id="floating_password" class="block py-2.5 px-0 w-full text-md text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " autocomplete="off" />
                    <label for="floating_password" class="peer-focus:font-medium absolute text-md text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 lg:gap-6 mb-10 px-10">
                <div class="relative z-0 w-full group mt-2">
                    
                    <label for="floating_role" class="peer-focus:font-medium absolute text-md text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Role</label>
                    <select id="floating_role" name="role" class="bg-gray-100 mt-4 border-0 border-b-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 shadow-md">
                    <option selected disabled>Choose a role</option>
                    <option value="Farmer">Farmer</option>
                    <option value="Admin">Admin</option>
                    </select>


                </div>
                <div class="relative z-0 w-full mt-2 group">
                    
                    <div class="relative z-0 w-full group">
                        <input type="text" name="farm_name" value="{{Auth::User()->farm_name}}" readonly id="farm_name_edit" class="block py-2.5 px-0 w-full text-md text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " autocomplete="off" />
                        <label for="farm_name_edit" class="peer-focus:font-medium absolute text-md text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Farm</label>
                    </div>



                </div>
            </div>



            <hr class="w-full border-[1px] border-gray-300 mb-4">
            <div class="lg:flex-row-reverse flex flex-col-reverse gap-2 modalBtn mx-8 mb-3">
                <button type="button" class="text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-md px-5 py-2.5  w-44 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800" onclick="closeModal()">
                    <i class="fa fa-times pr-1" aria-hidden="true"></i>
                    Close
                </button>
                <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-md px-5 py-2.5 w-44 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    <i class="fa fa-pencil-square-o pr-1" aria-hidden="true"></i>
                    Update
                </button>
            </div>
              

        </form>
    </dialog>

    <dialog id="addUser" class="w-full lg:w-2/5 sm:2/4 backdrop:bg-black backdrop:opacity-80 rounded-2xl p-0 pb-2 pt-7">
        <span class="text-3xl text-gray-700 font-semibold ml-7">Update User</span>
        <hr class="w-full border-[1px] border-gray-300 mt-4">
        <form action="{{route('add.user')}}" method="POST">
            @csrf
            <div class="grid lg:grid-cols-2 lg:gap-6 px-10 sm:pt-10 pt-4">
                <div class="flex flex-col relative z-0 w-full mb-6 group">
                    <div class="relative z-0 w-full group">
                        <input type="text" value='{{old('first_name')}}' name="first_name" id="first_name_add" class="block py-2.5 px-0 w-full text-md text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " autocomplete="off" />
                        <label for="first_name_add" class="peer-focus:font-medium absolute text-md text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First name</label>
                        
                    </div>
                    @error('first_name')
                        <p class="text-red-500 text-xs pt-1 w-full text-left">
                            {{$message}}
                        </p>
                    @enderror
                    
                </div>
                
                <div class="flex flex-col relative z-0 w-full mb-6 group">
                    <div class="relative z-0 w-full group">
                        <input type="text" value='{{old('last_name')}}' name="last_name" id="last_name_add" class="block py-2.5 px-0 w-full text-md text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " autocomplete="off" />
                        <label for="last_name_add" class="peer-focus:font-medium absolute text-md text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last name</label>
                    </div>
                    @error('last_name')
                        <p class="text-red-500 text-xs pt-1 w-full text-left">
                            {{$message}}
                        </p>
                    @enderror
                </div>
            </div>
            <div class="grid lg:grid-cols-1 lg:gap-6 mb-5 px-10">
                <div class="flex flex-col relative z-0 w-full group">
                    <div class="relative z-0 w-full group">
                        <input type="text" name="username" id="username_add" class="block py-2.5 px-0 w-full text-md text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " autocomplete="off" />
                        <label for="username_add" class="peer-focus:font-medium absolute text-md text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
                    </div>
                    @error('username')
                        <p class="text-red-500 text-xs pt-1 w-full text-left">
                            {{$message}}
                        </p>
                    @enderror
                </div>
            </div>

            <div class="grid lg:grid-cols-1 lg:gap-6 mb-5 px-10">
                <div class="flex flex-col relative z-0 w-full group">
                    <div class="relative z-0 w-full group">
                        <input type="email" value='{{old('email')}}' name="email" id="email_add" class="block py-2.5 px-0 w-full text-md text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " autocomplete="off" />
                        <label for="email_add" class="peer-focus:font-medium absolute text-md text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs pt-1 w-full text-left">
                            {{$message}}
                        </p>
                    @enderror
                </div>
            </div>
            <div class="grid lg:grid-cols-1 lg:gap-6 mb-5 px-10">
                <div class="flex flex-col relative z-0 w-full group">
                    <div class="relative z-0 w-full group">
                        <input type="password" name="password" id="password_add" class="block py-2.5 px-0 w-full text-md text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " autocomplete="off" />
                        <label for="password_add" class="peer-focus:font-medium absolute text-md text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs pt-1 w-full text-left">
                            {{$message}}
                        </p>
                    @enderror
                </div>
            </div>

            <div class="grid lg:grid-cols-2 lg:gap-6 mb-10 px-10">
                <div class="relative z-0 w-full mt-2 group">
                    <div class="flex flex-col relative z-0 w-full group">
                        <div class="relative z-0 w-full group">
                            <input type="text" name="farm_name" value="{{Auth::User()->farm_name}}" readonly id="farm_add" class="block py-2.5 px-0 w-full text-md text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer" placeholder=" " autocomplete="off" />
                            <label for="farm_add" class="peer-focus:font-medium absolute text-md text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Farm</label>
                        </div>
                        @error('farm_name')
                            <p class="text-red-500 text-xs pt-1 w-full text-left">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-col relative z-0 w-full group">
                    <div class="relative z-0 w-full group">
                    
                        <label for="role_add" class="peer-focus:font-medium absolute text-md text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Role</label>
                        <select id="role_add" name="role" class="bg-gray-100 mt-4 border-0 border-b-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 shadow-md">
                        <option selected disabled>Choose a role</option>
                        <option value="Farmer">Farmer</option>
                        <option value="Admin">Admin</option>
                        </select>
                    </div>

                    @error('role')
                        <p class="text-red-500 text-xs pt-1 w-full text-left">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                
            </div>



            <hr class="w-full border-[1px] border-gray-300 mb-4">
            <div class="lg:flex-row-reverse flex flex-col-reverse gap-2 modalBtn mx-8 mb-3">
                <button type="button" class="text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-md px-5 py-2.5  w-44 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800" onclick="addUser.close()">
                    <i class="fa fa-times pr-1" aria-hidden="true"></i>
                    Close
                </button>
                <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-md px-5 py-2.5 w-44 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    <i class="fa fa-pencil-square-o pr-1" aria-hidden="true"></i>
                    Add
                </button>
            </div>
              

        </form>
    </dialog>
</div>

<script>
    function openDialog(user){
        var dialog = document.getElementById('editBtn');
        var nameInput = document.getElementById('nameInput');
        var id = document.getElementById('userid');
        var first_name = document.getElementById('floating_first_name');
        var last_name = document.getElementById('floating_last_name');
        var role = document.getElementById('floating_role');
        var email = document.getElementById('floating_email');

        id.value = user['id'];
        first_name.value = user['first_name'];
        last_name.value = user['last_name'];
        role.value = user['role'];
        email.value = user['email'];

        console.log(user);

        dialog.showModal();
    }
    function closeModal(){
        editBtn.close();

    }
</script>

@include('partials.__footer')