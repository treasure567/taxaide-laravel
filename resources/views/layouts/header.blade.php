<!DOCTYPE html>
<html lang="zxx" dir="ltr" class="light">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>Taxaide</title>
    <!-- BEGIN: Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- END: Google Font -->
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/sidebar-menu.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/SimpleBar.css">
    <link rel="stylesheet" href="{{ assets('css/rt-plugins.css') }}">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/app.css">
    <link rel="stylesheet" href="{{ assets('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ assets('css/toastr.min.css') }}">
    <style>
      /* Add your custom CSS styles here */
      .input-area {
          margin-bottom: 20px;
      }

      .input-with-verify {
          display: flex;
          align-items: center;
      }

      .input-with-verify input {
          flex: 1;
          margin-right: 10px;
      }

      .verify-text {
          font-size: 14px;
          font-weight: 100px;
          color: #1100ff;
      }
      
      #refresh-icon {
        cursor: pointer;
      }
      .loader {
        width: 25px;
        height: 25px;
        border: 5px solid #000000;
        border-bottom-color: transparent;
        border-radius: 50%;
        display: inline-block;
        box-sizing: border-box;
        animation: rotation 1s linear infinite;
      }

      .counter {
          background-color: rgb(255, 0, 0);
          color: rgb(255, 255, 255);
          border-radius: 20%;
          padding: 0.2em 0.5em; /* Adjust padding as needed */
          margin-left: 5em; /* Adjust margin as needed */
          font-size: 0.8em; /* Adjust font size as needed */
          font-weight: bold;
      }
      
       /* Custom styles */
       .verified-text {
            font-style: italic;
            font-size: 1.3em;
            color: #28a745; /* Bootstrap green color */
        }

        .green-tick {
            color: #28a745; /* Bootstrap green color */
        }

        .not-verified-text {
            font-style: italic;
            font-size: 1.3em;
            color: #dc3545; /* Bootstrap red color */
        }

        .red-cross {
            color: #dc3545; /* Bootstrap red color */
        }


      @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
      } 
  </style>
    <!-- END: Theme CSS-->
    <script src="{{ assets('js/settings.js') }}" sync></script>
  </head>
  <body class=" font-inter dashcode-app" id="body_class">
    <main class="app-wrapper extend">
      <!-- BEGIN: Sidebar -->
      <!-- BEGIN: Sidebar -->
      <div class="sidebar-wrapper group">
        <div id="bodyOverlay" class="w-screen h-screen fixed top-0 bg-slate-900 bg-opacity-50 backdrop-blur-sm z-10 hidden"></div>
        <div class="logo-segment">
          @php
              $r = route('todo.index');
          @endphp
          <a class="flex items-center" href="{{ $r }}">
            {{-- <img src="{{ url('/') }}/assets/images/logo/logo-c.svg" class="black_logo" alt="logo"> --}}
            {{-- <img src="{{ url('/') }}/assets/images/logo/logo-c-white.svg" class="white_logo" alt="logo"> --}}
            {{-- <span class="ltr:ml-3 rtl:mr-3 text-xl font-Inter font-bold text-slate-900 dark:text-white">{{ env('APP_NAME', 'Falcon') }}</span> --}}
          </a>
          <!-- Sidebar Type Button -->
          {{-- <div id="sidebar_type" class="cursor-pointer text-slate-900 dark:text-white text-lg">
            <iconify-icon class="sidebarDotIcon extend-icon text-slate-900 dark:text-slate-200" icon="fa-regular:dot-circle"></iconify-icon>
            <iconify-icon class="sidebarDotIcon collapsed-icon text-slate-900 dark:text-slate-200" icon="material-symbols:circle-outline"></iconify-icon>
          </div> --}}
          <button class="sidebarCloseIcon text-2xl">
            <iconify-icon class="text-slate-900 dark:text-slate-200" icon="clarity:window-close-line"></iconify-icon>
          </button>
        </div>
        <div id="nav_shadow" class="nav_shadow h-[60px] absolute top-[80px] nav-shadow z-[1] w-full transition-all duration-200 pointer-events-none
      opacity-0"></div>
      {{-- <div class="user-card"><div class="main"><div class="avatar-cont"><span class="ant-avatar ant-avatar-circle" style="width: 38px; height: 38px; line-height: 38px; font-size: 18px; background-color: rgb(0, 184, 194);"><span class="ant-avatar-string" style="line-height: 38px; transform: scale(1) translateX(-50%);">O</span></span></div><div class="text-cont"><div class="greeting">Cheap Data Naija</div><div class="name ellipsis"><span>Osetebese</span> <span>Agbator</span></div><span class="env-indicator live">Live</span></div></div></div> --}}
        @include('layouts.nav')
      </div>
      <!-- End: Sidebar -->
      <!-- End: Sidebar -->
      <div class="flex flex-col justify-between min-h-screen">
        <div>
          <!-- BEGIN: Header -->
          <!-- BEGIN: Header -->
          <div class="z-[9] sticky top-0" id="app_header">
            <div class="app-header z-[999] ltr:ml-[248px] rtl:mr-[248px] bg-white dark:bg-slate-800 shadow-sm dark:shadow-slate-700">
              <div class="flex justify-between items-center h-full">
                <div class="flex items-center md:space-x-4 space-x-2 xl:space-x-0 rtl:space-x-reverse vertical-box">
                  <a href="{{ route('todo.index') }}" class="mobile-logo xl:hidden inline-block">
                    {{-- <img src="{{ assets('images/logo/logo-c.svg') }}" class="black_logo" alt="logo"> --}}
                    {{-- <img src="{{ url('/') }}/assets/images/logo/logo-c-white.svg" class="white_logo" alt="logo"> --}}
                  </a>
                </div>
                <!-- end vertcial -->
                <div class="nav-tools flex items-center lg:space-x-5 space-x-3 rtl:space-x-reverse leading-0">
                  <!-- BEGIN: Toggle Theme -->

                  <div>
                    <button id="themeMood" class="h-[28px] w-[28px] lg:h-[32px] lg:w-[32px] lg:bg-gray-500-f7 bg-slate-50 dark:bg-slate-900 lg:dark:bg-slate-900 dark:text-white text-slate-900 cursor-pointer rounded-full text-[20px] flex flex-col items-center justify-center">
                      <iconify-icon class="text-slate-800 dark:text-white text-xl dark:block hidden" id="moonIcon" icon="line-md:sunny-outline-to-moon-alt-loop-transition"></iconify-icon>
                      <iconify-icon class="text-slate-800 dark:text-white text-xl dark:hidden block" id="sunIcon" icon="line-md:moon-filled-to-sunny-filled-loop-transition"></iconify-icon>
                    </button>
                  </div>
                  <!-- END: TOggle Theme -->
                  <!-- BEGIN: Profile Dropdown -->
                  <!-- Profile DropDown Area -->
                  <div class="md:block hidden w-full">
                    <span class="text-slate-800 dark:text-white focus:ring-0 focus:outline-none font-medium rounded-lg text-sm text-center
      inline-flex items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <div class="lg:h-8 lg:w-8 h-7 w-7 rounded-full flex-1 ltr:mr-[10px] rtl:ml-[10px]">
                        <img src="{{ url('/') }}/assets/images/all-img/user.png" alt="user" class="block w-full h-full object-cover rounded-full">
                      </div>
                      @php
                        $name = user()->name;
                      @endphp
                      <span class="flex-none text-slate-600 dark:text-white text-sm font-normal items-center lg:flex hidden overflow-hidden text-ellipsis whitespace-nowrap">{{ $name }}</span>
                    </span>
                  </div>
                  <!-- END: Header -->
                  <button class="smallDeviceMenuController md:hidden block leading-0">
                    <iconify-icon class="cursor-pointer text-slate-900 dark:text-white text-2xl" icon="heroicons-outline:menu-alt-3"></iconify-icon>
                  </button>
                  <!-- end mobile menu -->
                </div>
                <!-- end nav tools -->
              </div>
            </div>
          </div>