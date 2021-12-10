<div class="sidebar-container shadow">
    <div class="sidebar-navigation">
        <a href="{{route('home')}}" class="sidebar-nav-button" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard"><i
                class="bi bi bi-speedometer text-primary"></i>
        </a>
        <a href="{{route('companies.index')}}" class="sidebar-nav-button" data-bs-toggle="tooltip" data-bs-placement="right" title="Companies List"><i
                class="bi bi-building text-primary"></i>
        </a>
        <a href="{{route('employees.index')}}" class="sidebar-nav-button" data-bs-toggle="tooltip"
            data-bs-placement="right" title="Employees List">
            <i class="bi bi-people text-primary"></i>
        </a>
        <a class="sidebar-nav-button" id="logout">
            <i class="bi bi-box-arrow-left text-danger"></i>
        </a>
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <button style="display: none" id="btn_logout">

            </button>
        </form>
    </div>
</div>
