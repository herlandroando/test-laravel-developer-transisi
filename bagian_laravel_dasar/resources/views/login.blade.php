@extends("templates.main")

@section("content")
<div class="container login-container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card px-5 py-5" id="form1">
                <h2 class="text-center mb-3">Login</h2>
                @if(!empty(Session::get("alert")))
                <div class="alert alert-danger" role="alert">
                    {{Session::get("alert")}}
                </div>

                @endif

                <form action="{{route('login.post')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="emailFormInput" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="emailFormInput"
                            value="{{old('email')}}" placeholder="name@example.com">
                        @error("email")
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="passwordFormInput" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="passwordFormInput"
                            value="{{old('password')}}" placeholder="Password anda...">
                        @error("password")
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3"> <button type="submit" class="btn btn-primary w-100">Login</button> </div>
                </form>
                {{-- <div class="success-data" v-else>
                    <div class="text-center d-flex flex-column"> <i class='bx bxs-badge-check'></i> <span
                            class="text-center fs-1">You have been logged in <br> Successfully</span> </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
