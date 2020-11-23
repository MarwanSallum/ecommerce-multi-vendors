@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">{{__('admin\profile.edit_profile')}}</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close" href=""><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                    <form class="form" action="{{route('update.profile')}}"
                                            method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input name="id" value="" type="hidden">

                                            <div class="form-body">
                                                <input type="hidden" name="id" value="{{$admin -> id}}">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                <label for="projectinput1">{{__('admin\profile.full_name')}}</label>
                                                                <input type="text" id="name" value="{{$admin -> name}}"
                                                                        class="form-control"
                                                                        placeholder=""
                                                                        name="name">
                                                                    @error("name")
                                                                <span class="text-danger"></span>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">{{__('admin\profile.email')}}</label>
                                                                <input disabled type="text" id="email" value="{{$admin -> email}}"
                                                                        class="form-control"
                                                                        placeholder=""
                                                                        name="email">
                                                                    @error("email")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">{{__('admin\dashboard.mobile')}}</label>
                                                                <input type="text" id="mobile" value="{{$admin -> mobile}}"
                                                                        class="form-control"
                                                                        placeholder=""
                                                                        name="mobile">
                                                                    @error("mobile")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                            </div>


                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i>{{__('admin/dashboard.botton_update')}}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">{{__('admin\profile.change_password')}}</h4>
                                        <a class="heading-elements-toggle"><i
                                                class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close" href=""><i class="ft-x"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                    <form class="form" action="{{route('update.password')}}"
                                            method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label for="projectinput1">{{__('admin\profile.current_password')}}</label>
                                                        <input type="password" id="" value=""
                                                                class="form-control"
                                                                placeholder=""
                                                                name="current_password">
                                                            @error("current_password")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                            <label for="projectinput1">{{__('admin\profile.new_password')}}</label>
                                                            <input type="password" id="" value=""
                                                                    class="form-control"
                                                                    placeholder=""
                                                                    name="new_password">
                                                                @error("new_password")
                                                            <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1">{{__('admin\profile.confirm_password')}}</label>
                                                            <input type="password" id="" value=""
                                                                    class="form-control"
                                                                    placeholder=""
                                                                    name="new_confirm_password"
                                                                    >
                                                            </div>
                                                        </div>
                                                    </div>


                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i>{{__('admin/dashboard.botton_change_password')}}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection