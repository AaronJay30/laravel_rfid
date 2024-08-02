<link rel="stylesheet" type="text/css" href="{{ asset('css/sidebar.css') }}" />

<nav class="sidebar locked z-10">

    <div class="logo_items flex pl-[10px]">
        <a href="{{route('home')}}">
            <span class="nav_image">
                <img src="{{asset('img/TagMyHerd-icon.png')}}" alt="logo_img" />
            </span>
        </a>
        <div class="logo_flex flex-col pl-1 overflow-x-hidden">
            <span class="logo_name font-bold">Tag My Herd</span>
            <span class="logo_tagline font-light -mt-1">Tracking Made Easy</span>
        </div>

        <i class="bx bx-lock-alt shadow-xl" id="lock-icon" title="Unlock Sidebar"></i>
        <i class="bx bx-x" id="sidebar-close"></i> 

    </div>

    <hr class="mt-5 -mb-7 border-[1px] rounded-md mx-[10px]">

    <div class="menu_container">
        <div class="menu_items mt-3">
            <ul class="menu_item">
                <li class="item">
                    <a href="{{route('home')}}" class="link flex px-[10px] {{ Request::is('/') ? 'active fill-secondary' : 'fill-[#FEFADF] hover:fill-secondary' }}">
                        <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="30" height="30"><path d="M4 21V9l8-6l8 6v12h-6v-7h-4v7H4Z"/></svg></i>
                        <span class="pl-3 whitespace-nowrap ">Dashboard</span>
                    </a>
                </li>
                <li class="item">
                    <a href="{{route('livestock.my.herd')}}" class="link flex px-[10px]  {{ Request::is('herd*') ? 'active fill-secondary' : 'fill-[#FEFADF] hover:fill-secondary' }}">
                        <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30" height="30"><path d="m273 459l7.79-20l6.21 20l5.79-23.33l-4.25-48c-7.76 7.94-17.54 17.85-29.74 30.27zm38.5-380.86a115.06 115.06 0 0 0-21.13-19.6c-17.315-11.88-35.418-18.913-55.08-22.14c-18.751-3.067-37.99-2.743-56.33.12A203.86 203.86 0 0 0 133 49.42a184.2 184.2 0 0 0-29.62 15.36c-12.304 8.597-10.431 6.828.95 1.82a179.6 179.6 0 0 1 30.9-10c50.427-4.832 98.41-7.579 134.17 27.17a80 80 0 0 1 12.28 16c4.714 8.06 7.805 16.877 9.66 25.59l45.69 2.84c-5.032-17.752-15.256-37.574-25.53-50.06zm50.05 26.63c-8.531-13.217-18.495-25.428-29.66-34.88a78.24 78.24 0 0 0-15.79-10.38c2.67 2.68 5.22 5.45 7.61 8.32a138.13 138.13 0 0 1 9.13 12.11l.1.14l.09.14c9.772 15.14 17.164 33.862 20.78 49.15l22.19 1.3a253.49 253.49 0 0 0-14.43-25.91zm29.89 43l70 179.4l-11.82 28.37l-65.77-37.94l-8 13.86l67.56 39l-4.327 5.754L394.12 372l-65.33-31.47a42.41 42.41 0 0 0-9.29-1.43c-5.71 0-9.52 2.06-12.71 6.62c-2.53 3.61-78.5 80.52-147.64 150.28H16V243.73l92.85 3.85l96.61-33.26l10.13-11a214.71 214.71 0 0 1 38 24.27a18.57 18.57 0 0 0 11.61 3.93c13.792-1.574 22.025-9.12 32.83-17.83c-3.267-21.244-6.724-43.71-9.56-62.1c-6.463-2.155-12.926-4.308-19.39-6.46l4.39-4.78zm-37.25 65.02c-4.024-14.705-20.114-19.427-30.58-18.14c-3.073.432-6.167 1.427-8.77 2.68c.868 3.09 2.17 7.87 3.79 10.35c6.527 9.211 17.348 13.898 27.64 12.51c3.967-.672 8.94-3.676 7.92-7.4zm61.63 105.47l19 20l11.6-11l-19-20zM475 172.99s-40.54-27.8-57-1.2l11.25 28.83zM294 382.05l13.4 22.28l-.4-35.64c-3.29 3.45-7.53 7.82-12.95 13.36zm-30.6-167c5.858 1.872 17.61-6.048 17.33-8.01l-6.67-43.33l-28-9.31c-17.65-2.861-58.224-4.989-67.27 9.28c39.596 39.732 39.526 16.87 84.61 51.37zm127.08 172.89c-15.313-7.704-30.838-14.996-46.28-22.44c5.153 29.387 10.895 58.672 15.75 88.11l25.26 37.33l-2.6-34L400 469.61v-28.67l10.19-41.95l6.67-11.05z"/></svg>
                        </i>
                        <span class="pl-3 whitespace-nowrap">My Herd</span>
                    </a>
                </li>
                <li class="item">
                    <a href="{{route('livestock.batch')}}" class="link flex px-[10px] {{ Request::is('batch*') ? 'active fill-secondary' : 'fill-[#FEFADF] hover:fill-secondary' }}">
                        <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="30" height="30"><path fill="currentColor" d="M32 26v-2h-2.101a4.968 4.968 0 0 0-.732-1.753l1.49-1.49l-1.414-1.414l-1.49 1.49A4.964 4.964 0 0 0 26 20.101V18h-2v2.101a4.968 4.968 0 0 0-1.753.732l-1.49-1.49l-1.414 1.414l1.49 1.49A4.964 4.964 0 0 0 20.101 24H18v2h2.101a4.97 4.97 0 0 0 .732 1.753l-1.49 1.49l1.414 1.414l1.49-1.49a4.964 4.964 0 0 0 1.753.732V32h2v-2.101a4.968 4.968 0 0 0 1.753-.732l1.49 1.49l1.414-1.414l-1.49-1.49A4.964 4.964 0 0 0 29.899 26H32zm-7 2c-1.654 0-3-1.346-3-3s1.346-3 3-3s3 1.346 3 3s-1.346 3-3 3zm-5-11h-8a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2zm-8-2h8V4h-8v11z"/><path fill="currentColor" d="M17 21H8a2 2 0 0 1-2-2V7h2v12h9v2Z"/><path fill="currentColor" d="M13 25H4c-1.103 0-2-.897-2-2V11h2v12h9v2Z"/></svg>
                        </i>
                        <span class="pl-3 whitespace-nowrap">Batch Inputs</span>
                    </a>
                </li>
                {{-- <li class="item">
                    <a href="{{route('livestock.rfid')}}" class="link flex px-[10px] {{ Request::is('rfid*') ? 'active fill-secondary' : 'fill-[#FEFADF] hover:fill-secondary' }}">
                        <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="30" height="30"><path d="M18.364 18.364a9 9 0 0 0 0-12.728l1.414-1.414c4.296 4.295 4.296 11.26 0 15.556l-1.414-1.414ZM5.636 5.636a9 9 0 0 0 0 12.728l-1.414 1.414c-4.296-4.296-4.296-11.26 0-15.556l1.414 1.414Zm9.9 9.9a5 5 0 0 0 0-7.072L16.95 7.05a7 7 0 0 1 0 9.9l-1.414-1.415ZM8.463 8.463a5 5 0 0 0 0 7.071L7.05 16.95a7 7 0 0 1 0-9.9l1.414 1.414ZM12 14a2 2 0 1 0 0-4a2 2 0 0 0 0 4Z"/></svg>
                        </i>
                        <span class="pl-3 whitespace-nowrap">RFID Section</span>
                    </a>
                </li> --}}
                <li class="item">
                    <a href="{{route('livestock.schedule')}}" class="link flex px-[10px] {{ Request::is('schedule*') ? 'active fill-secondary' : 'fill-[#FEFADF] hover:fill-secondary' }}">
                        <div class="relative">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024"  width="30" height="30"><path d="M928 224H768v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H548v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H328v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H96c-17.7 0-32 14.3-32 32v576c0 17.7 14.3 32 32 32h832c17.7 0 32-14.3 32-32V256c0-17.7-14.3-32-32-32zm-40 568H136V296h120v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h148v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h148v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h120v496zM416 496H232c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm0 136H232c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm308.2-177.4L620.6 598.3l-52.8-73.1c-3-4.2-7.8-6.6-12.9-6.6H500c-6.5 0-10.3 7.4-6.5 12.7l114.1 158.2a15.9 15.9 0 0 0 25.8 0l165-228.7c3.8-5.3 0-12.7-6.5-12.7H737c-5-.1-9.8 2.4-12.8 6.5z"/></svg>
                            </i>
                            @php
                                use Carbon\Carbon;
                                use App\Models\ScheduleModel;

                                $today = Carbon::now()->toDateString();

                                $count = ScheduleModel::query()
                                    ->whereDate('date', $today)
                                    ->where('status', 'unfinished')
                                    ->count();
                            @endphp
                            <h1 class="absolute notification top-0 bg-red-700 text-white uppercase rounded-full px-2">{{$count >= 1 ? $count : ''}}</h1>
                        </div>
                        <span class="pl-3 whitespace-nowrap">Schedule</span>
                    </a>
                </li>
                @if(Auth::user()->role === 'Admin')
                    <li class="item">
                        <a href="{{route('rfid.history')}}" class="link flex items-center px-[10px] {{ Request::is('history*') ? 'active fill-secondary' : 'fill-[#FEFADF] hover:fill-secondary' }}">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 21q-3.45 0-6.013-2.288T3.05 13H5.1q.35 2.6 2.313 4.3T12 19q2.925 0 4.963-2.038T19 12q0-2.925-2.038-4.963T12 5q-1.725 0-3.225.8T6.25 8H9v2H3V4h2v2.35q1.275-1.6 3.113-2.475T12 3q1.875 0 3.513.713t2.85 1.924q1.212 1.213 1.925 2.85T21 12q0 1.875-.713 3.513t-1.924 2.85q-1.213 1.212-2.85 1.925T12 21Zm2.8-4.8L11 12.4V7h2v4.6l3.2 3.2l-1.4 1.4Z"/></svg>
                        </i>
                        <span class="pl-3 whitespace-nowrap">History</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="{{route('finance')}}" class="link flex px-[10px] {{ Request::is('finance*') ? 'active fill-secondary' : 'fill-[#FEFADF] hover:fill-secondary' }}">
                            <i><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="m6 16.5l-3 2.94V11h3m5 3.66l-1.57-1.34L8 14.64V7h3m5 6l-3 3V3h3m2.81 9.81L17 11h5v5l-1.79-1.79L13 21.36l-3.47-3.02L5.75 22H3l6.47-6.34L13 18.64"/></svg>
                            </i>
                            <span class="pl-3 whitespace-nowrap">Finance</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="{{route('user.management')}}" class="link flex px-[10px] {{ Request::is('user') ? 'active fill-secondary' : 'fill-[#FEFADF] hover:fill-secondary' }}">
                            <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="30" height="30"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 20c0-1.742-1.67-3.223-4-3.773M15 20c0-2.21-2.686-4-6-4s-6 1.79-6 4m12-7a4 4 0 0 0 0-8m-6 8a4 4 0 1 1 0-8a4 4 0 0 1 0 8Z"/></svg>
                            </i>
                            <span class="pl-3 whitespace-nowrap">User Management</span>
                        </a>
                    </li>
                @endif
                <li class="item">
                    <form action="{{route('logout')}}" method="POST" id="myForm">
                        @csrf
                        <a href="#" onclick="document.getElementById('myForm').submit()" class="link flex px-[10px] hover:fill-[#DCA15D] fill-[#FEFADF]">
                            <i><svg xmlns="http://www.w3.org/2000/svg"  width="30" height="30" viewBox="0 0 24 24"><path d="M5 21q-.825 0-1.413-.588T3 19V5q0-.825.588-1.413T5 3h7v2H5v14h7v2H5Zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5l-5 5Z"/></svg>
                            </i>
                            <span class="pl-3 whitespace-nowrap">Logout</span>
                        </a>

                    </form>
                </li>
            </ul>
    </div>

    <div class="sidebar_profile flex px-[10px] pb-4">
            <span class="nav_image">
                <img src="{{asset('img/default.avif')}}" alt="logo_img" />
            </span>
            
            <div class="data_text logo_flex flex-col">
                <span class="name duration-200  whitespace-nowrap">{{Auth::User()->first_name}} {{ Auth::user()->last_name }}</span>
                <span class="email duration-200 -mt-2  whitespace-nowrap">{{Auth::User()->role}}</span>
            </div>
    </div>

    </div>
  </nav>

  <nav class="navbar">
    <i class="bx bx-menu" id="sidebar-open"></i>
    <span class="nav_image">
      <img src="{{asset('img/sample.png')}}" alt="logo_img" />
    </span>
  </nav>

<script>
    // Selecting the sidebar and buttons
    const sidebar = document.querySelector(".sidebar");
    const sidebarOpenBtn = document.querySelector("#sidebar-open");
    const sidebarCloseBtn = document.querySelector("#sidebar-close");
    const sidebarLockBtn = document.querySelector("#lock-icon");

    // Function to toggle the lock state of the sidebar
    const toggleLock = () => {
        sidebar.classList.toggle("locked");
        // If the sidebar is not locked
        if (!sidebar.classList.contains("locked")) {
            sidebar.classList.add("hoverable");
            sidebarLockBtn.classList.replace("bx-lock-alt", "bx-lock-open-alt");
        } else {
            sidebar.classList.remove("hoverable");
            sidebarLockBtn.classList.replace("bx-lock-open-alt", "bx-lock-alt");
        }
    };

    // Function to hide the sidebar when the mouse leaves
    const hideSidebar = () => {
        if (sidebar.classList.contains("hoverable")) {
            sidebar.classList.add("close");
        }
    };

    // Function to show the sidebar when the mouse enter
    const showSidebar = () => {
        if (sidebar.classList.contains("hoverable")) {
            sidebar.classList.remove("close");
        }
    };

    // Function to show and hide the sidebar
    const toggleSidebar = () => {
        sidebar.classList.toggle("close");
    };

    // If the window width is less than 800px, close the sidebar and remove hoverability and lock
    if (window.innerWidth < 800) {
    sidebar.classList.add("close");
    sidebar.classList.remove("locked");
    sidebar.classList.remove("hoverable");
    }

    // Adding event listeners to buttons and sidebar for the corresponding actions
    sidebarLockBtn.addEventListener("click", toggleLock);
    sidebar.addEventListener("mouseleave", hideSidebar);
    sidebar.addEventListener("mouseenter", showSidebar);
    sidebarOpenBtn.addEventListener("click", toggleSidebar);
    sidebarCloseBtn.addEventListener("click", toggleSidebar);
</script>