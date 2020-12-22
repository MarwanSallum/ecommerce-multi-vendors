@extends('layouts.admin')

@section('content')

      <div class="app-content content">
        <div class="content-wrapper">
          <div class="content-body">
          <h3 class="card-title" id="file-repeater">{{__('admin\brand.edit_brand')}} {{'  |  '}} {{$brand ->name}}</h3>
          </div>
          <div class="card-content collapse show">
            <div class="card-body">
                    <div class="media-left pl-2 pt-2">
                        <a href="#" class="profile-image">
                          <img src="{{$brand -> photo}}" class="rounded-circle img-border height-200"
                          alt="Card image">
                        </a>
                      </div>

                  <br>
                  <br>

              <form class="form" 
                    action="{{route('admin.brand.update', $brand ->id)}}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{$brand ->id}}">
                  <div class="row">

                        <div class="form-group col-md-6 mb-2">
                        <label>{{__('admin/category.category_name')}}</label>
                        <input value="{{$brand ->name}}"
                            type="text" class="form-control" 
                            name="name">
                            @error("name")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 mb-2">
                          <label >{{__('admin/brand.brand_image')}}</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">{{__('admin/dashboard.upload_image')}}</span>
                          </div>
                          <div class="custom-file">
                            <label for="upload_image" class="custom-file-label" >{{__('admin/dashboard.choose_image')}}</label>
                            <input name="photo" type="file" class="custom-file-input" id="upload_image" >
                          </div>
                        </div>
                        @error("photo")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>

                  </div>
                  
                  <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-1">
                                <input type="checkbox" value="1"
                                    name="is_active"
                                    id="switcheryColor4"
                                    class="switchery" data-color="success"
                                   @if($brand ->is_active == 1 )checked @endif />
                                <label for="switcheryColor4"
                            class="card-title ml-1">{{__('admin\category.status')}}</label>
                                @error("is_active")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                  </div>

                  <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i>
                        {{__('admin\dashboard.botton_update')}} 
                    </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

@endsection





