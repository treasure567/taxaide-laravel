<div class="sidebar-menus bg-white dark:bg-slate-800 py-2 px-4 h-[calc(100%-80px)] overflow-y-auto z-50" id="sidebar_menus">
    <ul class="sidebar-menu">
        <li class="sidebar-menu-title">MENU</li>
        <li class="">
            <a href="{{ route('todo.index') }}" class="navItem {{ active_menu('todo.index') }}">
            <span class="flex items-center">
                {!! icon('heroicons-outline:home') !!}
                <span>TODO</span>
            </span>
            </a>
        </li>
        <li class="">
            <a href="#" class="navItem">
            <span class="flex items-center">
                {!! icon('majesticons:logout') !!}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="">
                        LOGOUT
                    </button>
                </form>
            </span>
            </a>
        </li>
    </ul>
  </div>