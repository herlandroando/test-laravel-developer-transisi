@extends("templates.main")

@section("title","Show Employee")

@section("content")
<a class="btn btn-primary mb-3" href="{{route('employees.edit',['employee'=>$employee->id])}}">Edit</a>
<form class="row g-3">
    <div class="col-12">
        <label for="input_employee" class="form-label">ID Employee</label>
        <input readonly value="{{$employee->id}}" name="id" type="text" max="255" required class="form-control"
            id="input_employee" placeholder="ID Employee">
    </div>
    <div class="col-md-6 col-12">
        <label for="input_name" class="form-label">Name</label>
        <input readonly value="{{$employee->name}}" name="name" type="text" max="255" required class="form-control"
            id="input_name" placeholder="Name employee">

    </div>
    <div class="col-md-6 col-12">
        <label for="input_email" class="form-label">Email</label>
        <input readonly value="{{$employee->email}}" name="email" type="email" required class="form-control"
            id="input_email" placeholder="Email employee">

    </div>
    <div class="col-12">
        <label for="input_company" class="form-label">Company</label>
        <select data-id='{{$employee->id}}' disabled style="width=100%" class="form-control" name="company_id" required
            id="input_company_create" placeholder="Select employee's company">
            <option selected value="{{$employee->id}}">{{$employee->company->name}}</option>
        </select>

    </div>
</form>
@endsection
