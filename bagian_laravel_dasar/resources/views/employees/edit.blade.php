@extends("templates.main")

@section("title","Edit Employee")

@section("content")
@if(Session::has("message"))
<div class="alert alert-success" role="alert">
    {{Session::get("message")}}
</div>
@endif
<form class="row g-3" action="{{route('employees.update',['employee'=>$employee->id])}}" method="POST">
    @method("PUT")
    @csrf
    <div class="col-12">
        <label for="input_employee" class="form-label">ID Employee</label>
        <input readonly value="{{$employee->id}}" name="id" type="text" max="255" required class="form-control"
            id="input_employee" placeholder="ID Employee">
    </div>
    <div class="col-md-6 col-12">
        <label for="input_name" class="form-label">Name</label>
        <input value="{{old('name')??$employee->name}}" name="name" type="text" max="255" required class="form-control"
            id="input_name" placeholder="Name employee">
        @error("name")
        <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="col-md-6 col-12">
        <label for="input_email" class="form-label">Email</label>
        <input value="{{old('email')??$employee->email}}" name="email" type="email" required class="form-control"
            id="input_email" placeholder="Email employee">
        @error("email")
        <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="col-12">
        <label for="input_company" class="form-label">Company</label>
        <select data-search-id="{{old('company_id')??$employee->company_id}}" style="width=100%" class="form-control"
            name="company_id" required id="input_company_edit" placeholder="Select employee's company">
        </select>
        @error("website")
        <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Edit</button>
    </div>
</form>
@endsection
