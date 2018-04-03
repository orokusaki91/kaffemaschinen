
<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <a class="navbar-brand text-white" href="{{ route('admin.product.index') }}">
        <p style="border:0; color: #fff; font-size: 24px; margin: 0;">Willkommen Admin</p>
    </a>

    <button class="navbar-toggler" type="button"
            data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link text-white"  style="color: #fff !important;" href="{{ route('admin.logout') }}">
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>