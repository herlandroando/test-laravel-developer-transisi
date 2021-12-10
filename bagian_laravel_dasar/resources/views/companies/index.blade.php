@extends("templates.main")

@section("title","Companies List")

@section("content")
<div class="container mb-3">
    <a href="{{route('companies.create')}}" class="btn btn-success">Create Company</a>
    <a href="{{route('import_companies.index')}}" class="btn btn-primary mx-3">Import Excel Companies</a>
</div>
@if ($companies->isEmpty())
<div class="container">
    <p>Company Data is Empty. Create new Company data or upload excel with Companies data.</p>
</div>
@else
<div class="container ">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Company Name</th>
                    <th style="width: 100px" scope="col">Website</th>
                    <th style="min-width: 130px" scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                <tr>
                    <td>{{$company->id}}</td>
                    <td>{{$company->name}}</td>
                    <td>{{$company->email}}</td>
                    <td>{{$company->website}}</td>
                    <td>
                        <a class="btn btn-secondary"
                            href="{{route('companies.show',['company'=>$company->id])}}">Show</a>
                        |
                        <button onclick="toggleDelete({{$company->id}})" data-bs-toggle="modal"
                            data-bs-target="#modal_alert" class="btn btn-danger btn-delete">Delete</button>
                        <form action="{{route('companies.destroy',['company'=>$company->id])}}" method="POST">
                            @method("DELETE")
                            @csrf
                            <button id="delete{{$company->id}}" style="display: none"></button>
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
                    href="{{url(route('companies.index').'?').\Illuminate\Support\Arr::query(request()->except('page')+['page' => $companies->currentPage()-1])}}"
                    aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @if ($companies->currentPage() > 2) <li class="page-item">
                <a class="page-link"
                    href="{{url(route('companies.index').'?').\Illuminate\Support\Arr::query(request()->except('page')+['page' => 1])}}">
                    <span aria-hidden="true">1</span>
                </a>
            </li>
            <li>...</li>
            @endif
            {{-- {{dd($companies)}} --}}
            @for ($i = $companies->currentPage()-2; $i <= $companies->currentPage()+2; $i++)
                @if ($i > $companies->lastPage())
                @break;
                @endif
                @if ($i < 1) @continue; @endif <li class="page-item {{$companies->currentPage()==$i ?'active':''}}"><a class="page-link"
                        href="{{url(route('companies.index').'?').\Illuminate\Support\Arr::query(request()->except('page')+['page' => $i])}}">{{$i}}</a>
                    </li>
                    @endfor
                    @if ($companies->currentPage() < $companies->lastPage()-2)
                        <li>...</li>
                        <li class="page-item">
                            <a class="page-link"
                                href="{{url(route('companies.index').'?').\Illuminate\Support\Arr::query(request()->except('page')+['page' => $companies->lastPage()])}}">
                                <span aria-hidden="true">{{$companies->lastPage()}}</span>
                            </a>
                        </li>
                        @endif
                        <li class="page-item">
                            <a class="page-link"
                                href="{{url(route('companies.index').'?').\Illuminate\Support\Arr::query(request()->except('page')+['page' => $companies->currentPage()+1])}}"
                                aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
        </ul>
    </nav>
</div>

@endif
<div id="modal_alert" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Warning!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure to delete this company?</p>
            </div>
            <div class="modal-footer">
                <button id="delete_cancel" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button id="delete_accept" data-id="" type="button" class="btn btn-outline-primary">Accept</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<script>
    function toggleDelete(id) {
    $('#delete_accept').data("id", id);
}

</script>
@endsection
