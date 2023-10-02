@if (auth()->user()->role=="admin")
<li class="nav-item">
    <a href="/admin" wire:navigate class="nav-link {{ (request()->is('admin')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Beranda
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="/admin/proyek" wire:navigate class="nav-link {{ (request()->is('admin/proyek')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Proyek
        </p>
    </a>
</li>
@endif
