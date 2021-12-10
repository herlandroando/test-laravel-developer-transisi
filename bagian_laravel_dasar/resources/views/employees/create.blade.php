@extends("templates.main")

@section("title","Create Employee")

@section("content")
<form class="row g-3" action="{{route('employees.store')}}" method="POST">
    @csrf
    <div class="col-md-6 col-12">
        <label for="input_name" class="form-label">Name</label>
        <input value="{{old('name')}}" name="name" type="text" max="255" required class="form-control" id="input_name"
            placeholder="Name employee">
        @error("name")
        <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="col-md-6 col-12">
        <label for="input_email" class="form-label">Email</label>
        <input value="{{old('email')}}" name="email" type="email" required class="form-control" id="input_email"
            placeholder="Email employee">
        @error("email")
        <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="col-12">
        <label for="input_company" class="form-label">Company</label>
        <select style="width=100%" class="form-control" value="{{old('company_id')}}" name="company_id" required id="input_company_create"
            placeholder="Select employee's company">
        </select>
        @error("website")
        <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Create</button>
    </div>
</form>
@endsection
