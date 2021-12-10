@extends('templates.main')

@section("title","Import Employees by Excel")


@section("content")
<div class="container">
    <h3 id="how-it-work">How it work?</h3>
    <p>The excel file (.xlsx or .csv) that you upload will be processed by the server. The file is checked first. If
        there is an inappropriate format, the import process will stop and issue an error result. If successful then you
        try to manage your menu (Company / Employee). The process may take a while depending on how much data is
        imported, so please wait.</p>
    <h3 id="requirements">Requirements</h3>
    <ul>
        <li>File must be .xlsx or .csv extension.</li>
        <li>File size not greater than 2MB.</li>
        <li>Header/title column on row 1 must be defined.</li>
        <li>Format Row: Row 1 is Name, Row 2 is Email, Row 3 is Company ID</li>
    </ul>
</div>
@if(Session::has("message"))
<div class="container mt-3">
    <div class="alert alert-{{Session::get('status')}}" role="alert">
        {{Session::get('message')}}
    </div>
</div>
@endif
<div class="container mt-3">
    <form enctype="multipart/form-data" method="POST" action="{{route('import_employees.store')}}">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Import File</label>
            <input class="form-control" type="file" name="import_file" id="file">
            {{-- @error("import_file") --}}
            {{-- <small class="text-danger">{{$message}}</small> --}}
            {{-- @enderror --}}
        </div>
        <button class="btn btn-primary">Import</button>
    </form>
</div>
@if(Session::has("errors"))
<div class="container mt-3">
    <h3 class="mb-3">Error Message:</h3>
    <div class="alert alert-danger" role="alert">
        @foreach (Session::get('errors') as $failure)
        <ul>
            <li>Row: {{$failure->row()}}</li>
            <li>Attribute: {{$failure->attribute()}}</li>
            {{-- <li>Error: {{$failure->errors()}}</li> --}}
            {{-- <li>Value: {{$failure->values()}}</li> --}}
        </ul>
        @endforeach
    </div>
</div>
@endif
@endsection
