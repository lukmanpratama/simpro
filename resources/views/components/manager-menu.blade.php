@if (auth()->user()->role=="manager")
<li class="nav-item">
    <a href="/manager" wire:navigate class="nav-link {{ (request()->is('manager')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Beranda
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="/manager/proyek" wire:navigate class="nav-link {{ (request()->is('manager/proyek')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Proyek
        </p>
    </a>
</li>
@endif
