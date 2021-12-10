@extends("templates.main")

@section("title","Employees List")

@section("content")
<div class="container mb-3">
    <a href="{{route('employees.create')}}" class="btn btn-success">Create Employee</a>
    <a href="{{route('import_employees.index')}}" class="btn btn-primary mx-3">Import Excel Employees</a>
</div>
@if ($employees->isEmpty())
<div class="container">
    <p>Employee Data is Empty. Create new Employee data or upload excel with Employees data.</p>
</div>
@else
<div class="container">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Company Name</th>
                    <th style="min-width: 130px" scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr>
                    <td>{{$employee->id}}</td>
                    <td>{{$employee->name}}</td>
                    @if(empty($employee->company))
                    <td>Company Deleted</td>
                    @else
                    <td>{{$employee->company->name}}</td>
                    @endif
                    <td>
                        <a class="btn btn-secondary"
                            href="{{route('employees.show',['employee'=>$employee->id])}}">Show</a>
                        |
                        <button onclick="toggleDelete({{$employee->id}})" data-bs-toggle="modal"
                            data-bs-target="#modal_alert" class="btn btn-danger btn-delete">Delete</button>
                        <form action="{{route('employees.destroy',['employee'=>$employee->id])}}" method="POST">
                            @method("DELETE")
                            @csrf
                            <button id="delete{{$employee->id}}" style="display: none"></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="container mt-5">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link"
                    href="{{url(route('employees.index').'?').\Illuminate\Support\Arr::query(request()->except('page')+['page' => $employees->currentPage()-1])}}"
                    aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @if ($employees->currentPage() > 2) <li class="page-item">
                <a class="page-link"
                    href="{{url(route('employees.index').'?').\Illuminate\Support\Arr::query(request()->except('page')+['page' => 1])}}">
                    <span aria-hidden="true">1</span>
                </a>
            </li>
            <li>...</li>
            @endif
            {{-- {{dd($employees)}} --}}
            @for ($i = $employees->currentPage()-2; $i <= $employees->currentPage()+2; $i++)
                @if ($i > $employees->lastPage())
                @break;
                @endif
                @if ($i < 1) @continue; @endif <li class="page-item {{$employees->currentPage()==$i ?'active':''}}"><a
                        class="page-link"
                        href="{{url(route('employees.index').'?').\Illuminate\Support\Arr::query(request()->except('page')+['page' => $i])}}">{{$i}}</a>
                    </li>
                    @endfor
                    @if ($employees->currentPage() < $employees->lastPage()-2)
                        <li>...</li>
                        <li class="page-item">
                            <a class="page-link"
                                href="{{url(route('employees.index').'?').\Illuminate\Support\Arr::query(request()->except('page')+['page' => $employees->lastPage()])}}">
                                <span aria-hidden="true">{{$employees->lastPage()}}</span>
                            </a>
                        </li>
                        @endif
                        <li class="page-item">
                            <a class="page-link"
                                href="{{url(route('employees.index').'?').\Illuminate\Support\Arr::query(request()->except('page')+['page' => $employees->currentPage()+1])}}"
                                aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
        </ul>
    </nav>
</div>
<div id="modal_alert" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Warning!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure to delete this employee?</p>
            </div>
            <div class="modal-footer">
                <button id="delete_cancel" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button id="delete_accept" data-id="" type="button" class="btn btn-outline-primary">Accept</button>
            </div>
        </div>
    </div>
</div>
@endif

@endsection


@section("script")
<script>
    function toggleDelete(id) {
    $('#delete_accept').data("id", id);
}

</script>
@endsection
