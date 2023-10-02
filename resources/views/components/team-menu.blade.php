@if (auth()->user()->role=="team")
<li class="nav-item">
    <a href="/team" wire:navigate class="nav-link {{ (request()->is('team')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Beranda
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="/team/proyek" wire:navigate class="nav-link {{ (request()->is('team/proyek')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Proyek
        </p>
    </a>
</li>
@endif
