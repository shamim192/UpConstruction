@extends('admin.layouts.layout')


@section('content')
<section class="section">
    <div class="section-header">
      <div class="section-header-back">
        <a href="features-posts.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Alt Service Section Setting </h1>
     
    </div>

    <div class="section-body">
      

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Update Alt Serivce Setting </h4>
            </div>
            <div class="card-body">
                <form action="{{route('admin.alt-service-setting.update',1)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" name="title" class="form-control" value="{{$altService->title}}">
                </div>
              </div>

              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sub title</label>
                <div class="col-sm-12 col-md-7">
                 <textarea name="sub_title" class="form-control" style="height: 100px" id="" >{{$altService->sub_title}}</textarea>
                </div>
              </div>

              @if($altService->image)
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Preview Image</label>
                <div class="col-sm-12 col-md-7">
                <img class="w-25" src="{{asset($altService->image)}}" alt="">
              </div>
              </div>
              @endif             
            

              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                <div class="col-sm-12 col-md-7">
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                </div>
              </div>
          
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                <div class="col-sm-12 col-md-7">
                  <button class="btn btn-primary">Update</button>
                </div>
              </div>
            </form>
          
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection