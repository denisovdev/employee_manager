<div class="row mt-1">
    <div class="col" style="font-size: 26px; font-weight: 200;">
        <span class="ms-5">
            <b>manage</b>IT
        </span>
    </div>
</div>

<div>
    <a href="{{route('home')}}" style="text-decoration: none">
        @if (Request::url() == route('home'))
        <div class="sidebar-item-flag"></div>
        @endif
        <div class="col-12 mb-2 mt-2 ps-5 pe-4 pt-1 pb-1 sidebar-item {{Request::url() == route('home') ? 'sidebar-item-active' : ''}}">
            <span>Главная</span>
        </div>
    </a>
    <a href="{{route('user.show', Auth::user())}}" style="text-decoration: none">
        @if (Request::url() == route('user.show', Auth::user()))
        <div class="sidebar-item-flag"></div>
        @endif
        <div class="col-12 mb-2 mt-2 ps-5 pe-4 pt-1 pb-1 sidebar-item {{Request::url() == route('user.show', Auth::user()) ? 'sidebar-item-active' : ''}}">
            <span>Мой профиль</span>
        </div>
    </a>
    @can('user.view')
    <a href="{{route('user.index')}}" style="text-decoration: none">
        @if (Request::url() == route('user.index'))
        <div class="sidebar-item-flag"></div>
        @endif
        <div class="col-12 mb-2 mt-2 ps-5 pe-4 pt-1 pb-1 sidebar-item {{Request::url() == route('user.index') ? 'sidebar-item-active' : ''}}">
            <span>Сотрудники</span>
        </div>
    </a>
    @endcan

    @can('role.view')
    <a href="{{route('role.index')}}" style="text-decoration: none">
        @if (Request::url() == route('role.index'))
        <div class="sidebar-item-flag"></div>
        @endif
        <div class="col-12 mb-2 mt-2 ps-5 pe-4 pt-1 pb-1 sidebar-item {{Request::url() == route('role.index') ? 'sidebar-item-active' : ''}}">
            <span>Роли</span>
        </div>
    </a>
    @endcan

    
    <div class="row ms-auto me-auto mb-3" style="position: absolute; bottom: 0">
        <div class="col mt-auto mb-auto" style="font-size: 12px; font-weight: 600">
            {{ Auth::user()->last_name . ' ' .Auth::user()->first_name }}
        </div>

        <div class="col-auto mt-auto mb-auto p-0">
            <button class="btn p-0" style="border: 0"><i class="fa fa-sign-out"></i></button>
        </div>
    </div>
    

    {{-- @if (@Auth::user()->role->id == @Auth::user()->role::USER)
    <a href="{{route('account')}}" style="text-decoration: none">
        @if (Request::url() == route('account'))
        <div class="sidebar-item-flag"></div>
        @endif
        <div class="col-12 mb-2 mt-2 ps-5 pe-4 pt-1 pb-1 sidebar-item {{Request::url() == route('account') ? 'sidebar-item-active' : ''}}">
            <span>Профиль</span>
        </div>
    </a>
    @endif --}}
</div>

<style>
    .sidebar-item span{
        position: relative;
        font-size: 21px;
        font-weight: 200;
        color: #7a7d82;
    }

    .sidebar-item:hover{
        background: rgba(129, 138, 222, 0.15);
        border-radius: 0 5px 5px 0;
        cursor: pointer;
    }

    .sidebar-item:hover span{
        color: #818ADE;
    }

    .sidebar-item-flag{
        position: absolute;
        height: 39px;
        width: 8px;
        background: rgba(129, 138, 222, 1);
        border-radius: 0 5px 5px 0;
    }

    .sidebar-item-active{
        background: rgba(129, 138, 222, 0.15);
        border-radius: 0 5px 5px 0;
        cursor: pointer;
    }

    .sidebar-item-active span{
        color: #818ADE;
    }
</style>
