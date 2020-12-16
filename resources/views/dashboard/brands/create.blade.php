@extends('layouts.admin')

@section('content')

      <div class="app-content content">
        <div class="content-wrapper">
          <div class="content-body">
          <h4 class="card-title" id="file-repeater">{{__('admin\brand.add_brand')}}</h4>
          </div>
          <div class="card-content collapse show">
            <div class="card-body">
              <form class="form" 
                    action="{{route('admin.brand.store')}}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                  <div class="row">
                        <div class="form-group col-md-6 mb-2">
                        <label>{{__('admin/brand.brand_name')}}</label>
                        <input value="{{old('name')}}"
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
                  
                 
                        <div class="col-md-6">
                            <div class="form-group mt-1">
                                <input type="checkbox" value="1"
                                    name="is_active"
                                    id="switcheryColor4"
                                    class="switchery" data-color="success"
                                   checked  />
                                <label for="switcheryColor4"
                            class="card-title ml-1">{{__('admin\category.status')}}</label>
                                @error("is_active")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                  <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i>
                        {{__('admin\dashboard.botton_add')}} 
                    </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

@endsection





