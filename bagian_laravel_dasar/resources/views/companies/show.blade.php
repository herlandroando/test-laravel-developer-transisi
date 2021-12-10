@extends("templates.main")

@section("title","Show Company")

@section("content")
<a class="btn btn-primary mb-3" href="{{route('companies.edit',['company'=>$company->id])}}">Edit</a>
<form class="row g-3">
    @csrf
    <div class="col-12">
        <label for="input_company" class="form-label">ID Company</label>
        <input readonly value="{{$company->id}}" name="id" type="text" max="255" required class="form-control"
            id="input_name" placeholder="ID Company">
    </div>
    <div class="col-md-6 col-12">
        <label for="input_name" class="form-label">Name</label>
        <input readonly value="{{$company->name}}" name="name" type="text" max="255" required class="form-control"
            id="input_name" placeholder="Name Company">
    </div>
    <div class="col-md-6 col-12">
        <label for="input_email" class="form-label">Email</label>
        <input readonly value="{{$company->email}}" name="email" type="email" required class="form-control"
            id="input_email" placeholder="Email Company">
    </div>
    <div class="col-12">
        <label for="input_website" class="form-label">Website</label>
        <input readonly value="{{$company->website}}" name="website" type="text" required class="form-control"
            id="input_website" placeholder="Website Company">
    </div>
    <div class="col-md-6 col-12">
        <label for="input_logo" class="form-label">Logo</label>
        @if (empty($company->path_logo))
        <span>Filename: <p>Not Uploaded</p> </span>
        @else
        <span>Filename: </span><a id="fileurl"
            href="{{route('companies.show.file',['company'=>$company->id,'filename'=>$company->path_logo])??''}}">
            <p id="filename">{{$company->path_logo??"Not Uploaded"}}</p>
        </a>
        @endif

    </div>
    <div class="col-12">
        <a class="btn btn-primary" target="_blank" href="{{route('companies.show.employees',['company'=>$company->id])}}">List of
            Company's Employees</a>
    </div>
</form>
@endsection
