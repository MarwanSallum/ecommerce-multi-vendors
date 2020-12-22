@extends('layouts.admin')

@section('content')

      <div class="app-content content">
        <div class="content-wrapper">
          <div class="content-body">
          <h3 class="card-title" id="file-repeater">{{__('admin\brand.edit_brand')}} {{'  |  '}} {{$tag ->name}}</h3>
          </div>
          <div class="card-content collapse show">
            <div class="card-body">
              <form class="form" 
                    action="{{route('admin.tags.update', $tag ->id)}}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{$tag ->id}}">
                  <div class="row">

                        <div class="form-group col-md-6 mb-2">
                        <label>{{__('admin/category.category_name')}}</label>
                        <input value="{{$tag ->name}}"
                            type="text" class="form-control" 
                            name="name">
                            @error("name")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
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





