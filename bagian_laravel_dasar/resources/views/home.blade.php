@extends('templates.main')

@section("title","Dashboard")

@section("content")
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body bg-secondary">
                    <h5 class="card-title">Employees</h5>
                    <h3 class="card-text">{{$count["employees"]}}</h3>
                </div>

            </div>

        </div>
        <div class="col">
            <div class="card">
                <div class="card-body bg-info">
                    <h5 class="card-title">Companies</h5>
                    <h3 class="card-text">{{$count["companies"]}}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
