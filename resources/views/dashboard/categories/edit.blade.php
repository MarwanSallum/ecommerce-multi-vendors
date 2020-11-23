@extends('layouts.admin')

@section('content')

      <div class="app-content content">
        <div class="content-wrapper">
          <div class="content-body">
          <h4 class="card-title" id="file-repeater">{{__('admin\category.category_edit')}} {{' - '}} {{$category ->name}}</h4>
          </div>
          <div class="card-content collapse show">
            <div class="card-body">
                    <div class="media-left pl-2 pt-2">
                        <a href="#" class="profile-image">
                          <img src="{{asset('assets/admin/images/avatar.jpg')}}" class="rounded-circle img-border height-200"
                          alt="Card image">
                        </a>
                      </div>

                  <br>
                  <br>

              <form class="form">
                  <div class="row">

                        <div class="form-group col-md-6 mb-2">
                        <input type="text" class="form-control" placeholder="{{__('admin/category.category_name')}}" name="name">
                        </div>

                        <div class="form-group col-md-6 mb-2">
                            <input type="text" class="form-control" placeholder="{{__('admin/category.category_name_url')}}" name="company">
                        </div>

                  </div>
                  
                  <div class="row">

                    
                        <div class="col-md-6">
                            <div class="form-group mt-1">
                                <input type="checkbox" value="1"
                                    name="category[0][active]"
                                    id="switcheryColor4"
                                    class="switchery" data-color="success"
                                   checked />
                                <label for="switcheryColor4"
                            class="card-title ml-1">{{__('admin\category.status')}}</label>

                                @error("category.0.active")
                                <span class="text-danger"> </span>
                                @enderror
                            </div>
                        </div>
                  

                      <div class="form-group col-md-4 mb-2">
                                <input type="file" class="file" id="inputGroupFile01"  >
                                <label class="file center-block" for="inputGroupFile01"></label>
                      </div>

                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>

@endsection





