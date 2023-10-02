@if (auth()->user()->role=="owner")
<li class="nav-item">
    <a href="/owner" wire:navigate class="nav-link {{ (request()->is('owner')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Beranda
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="/owner/proyek" wire:navigate class="nav-link {{ (request()->is('owner/proyek')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Proyek
        </p>
    </a>
</li>
@endif
