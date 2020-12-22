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
                    action="{{route('admin.tags.store')}}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                  <div class="row">
                        <div class="form-group col-md-6 mb-2">
                        <label>{{__('admin/tag.tag_name')}}</label>
                        <input value="{{old('name')}}"
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
                        {{__('admin\dashboard.botton_add')}} 
                    </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

@endsection





