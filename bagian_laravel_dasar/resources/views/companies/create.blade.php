@extends("templates.main")

@section("title","Create Company")

@section("content")
<form class="row g-3" action="{{route('companies.store')}}" method="POST">
    @csrf
    <div class="col-md-6 col-12">
        <label for="input_name" class="form-label">Name</label>
        <input value="{{old('name')}}" name="name" type="text" max="255" required class="form-control" id="input_name"
            placeholder="Name Company">
        @error("name")
        <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="col-md-6 col-12">
        <label for="input_email" class="form-label">Email</label>
        <input value="{{old('email')}}" name="email" type="email" required class="form-control" id="input_email"
            placeholder="Email Company">
        @error("email")
        <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="col-12">
        <label for="input_website" class="form-label">Website</label>
        <input value="{{old('website')}}" name="website" type="text" required class="form-control" id="input_website"
            placeholder="Website Company">
        @error("website")
        <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="col-md-6 col-12">
        <label for="input_logo" class="form-label">Logo</label>
        <div class="my-3">
            <button id="create_upload_logo" class="btn btn-primary" type="button">Upload Logo</button>
        </div>
        <span>Filename: </span><a id="fileurl" href="{{$url??''}}">
            <p id="filename">{{$filename??"Not Uploaded"}}</p>
        </a>
        <input style="display: none" type="file" accept=".png" class="form-control" id="input_logo"
            placeholder="Logo Company">
        @error("logo")
        <small class="text-danger">{{$message}}</small>
        @enderror
        <small>Logo need minimal 100x100 px and '.png' extension only. Maximum 2MB File. After upload you will be crop
            the image by website.</small>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Create</button>
    </div>
</form>

<div id="modal_crop" class="modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="crop_cancel" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button id="crop_accept" type="button" class="btn btn-outline-primary">Accept</button>
            </div>
        </div>
    </div>
</div>

@endsection
