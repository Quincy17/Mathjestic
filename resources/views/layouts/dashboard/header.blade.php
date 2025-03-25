<div class="search">
    <form>
        <input class="form-control" type="text" placeholder="Type here..." aria-label="Search">
    </form>
    <a href="#" class="toggle-search"><i class="material-icons">close</i></a>
</div>
<div class="app-header">
    <nav class="navbar navbar-light navbar-expand-lg">
        <div class="container-fluid">
            <div class="navbar-nav" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link hide-sidebar-toggle-button" href="#"><i
                                class="material-icons">first_page</i></a>
                    </li>
                </ul>
            </div>
            <div class="d-flex">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link text-danger" role="button"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
