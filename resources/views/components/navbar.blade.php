<nav class="main-header navbar navbar-expand navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" wire:navigate class="nav-link {{ (request()->is('hone')) ? 'active' : '' }}">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/contact" wire:navigate class="nav-link {{ (request()->is('contact')) ? 'active' : '' }}">Contact</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button class="btn btn-primary" type="submit">Log Out</button>
            </form>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

    </ul>
</nav>
