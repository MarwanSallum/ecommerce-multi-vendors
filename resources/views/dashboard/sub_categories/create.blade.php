@extends('layouts.admin')

@section('content')

      <div class="app-content content">
        <div class="content-wrapper">
          <div class="content-body">
          <h4 class="card-title" id="file-repeater">{{__('admin\category.category_create')}} </h4>
          </div>
          <div class="card-content collapse show">
            <div class="card-body">
              <form class="form" 
                    action="{{route('admin.sub_categories.store')}}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="">

                    <h4 class="form-section"><i class="ft-home"></i> بيانات القسم </h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projectinput2"> أختر القسم </label>
                                    <select name="parent_id" class="select2 form-control">
                                        <optgroup label="من فضلك أختر القسم ">
                                            @if($categories && $categories -> count() > 0)
                                                @foreach($categories as $category)
                                                    <option
                                                        value="{{$category -> id }}">{{$category -> name}}</option>
                                                @endforeach
                                            @endif
                                        </optgroup>
                                    </select>
                                    @error('parent_id')
                                    <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                  <div class="row">
                        <div class="form-group col-md-6 mb-2">
                        <label>{{__('admin/category.category_name')}}</label>
                        <input value="{{old('name')}}"
                            type="text" class="form-control" 
                            name="name">
                            @error("name")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        
                  </div>
                  
                    <div class="form-group col-md-4 mb-2">
                      <input type="file" class="file" id="inputGroupFile01"  >
                      <label class="file center-block" for="inputGroupFile01"></label>
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





