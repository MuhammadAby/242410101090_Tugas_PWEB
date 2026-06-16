```blade
<div class="sidebar">

    {{-- Logo --}}
    <div class="logo">

        <h2>PeduliKita</h2>

        <p>Portal Transparansi</p>

    </div>

    {{-- Tombol Program Baru --}}
    <a href="{{ route('admin.program-donasi.create') }}"
       class="btn-program">

        <i class="fa-solid fa-plus"></i>

        <span>Program Baru</span>

    </a>

    {{-- Menu --}}
    <div class="menu">

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
           class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

            <i class="fa-solid fa-house"></i>

            <span>Dashboard</span>

        </a>

        {{-- Program Donasi --}}
        <a href="{{ route('admin.program-donasi.index') }}"
           class="{{ request()->routeIs('admin.program-donasi.*') ? 'active' : '' }}">

            <i class="fa-solid fa-gift"></i>

            <span>Program Donasi</span>

        </a>

        {{-- Riwayat Donasi --}}
        <a href="{{ route('admin.donasi') }}"
           class="{{ request()->routeIs('admin.donasi') ? 'active' : '' }}">

            <i class="fa-solid fa-credit-card"></i>

            <span>Riwayat Donasi</span>

        </a>

    </div>

    {{-- Logout --}}
    <div class="sidebar-footer">

        <form action="{{ route('logout') }}"
              method="POST">

            @csrf

            <button type="submit"
                    class="logout-btn">

                <i class="fa-solid fa-right-from-bracket"></i>

                <span>Logout</span>

            </button>

        </form>

    </div>

</div>

<style>

.logout-btn{

    width:100%;

    border:none;

    background:none;

    cursor:pointer;

    text-align:left;

    padding:14px 18px;

    border-radius:14px;

    color:#dc2626;

    font-size:15px;

    font-weight:500;

    display:flex;

    align-items:center;

    gap:14px;

    transition:.2s;

}

.logout-btn:hover{

    background:#fef2f2;

}

</style>
```
