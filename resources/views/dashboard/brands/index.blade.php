@extends('layouts.admin')

@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                            <h3 class="card-title">{{__('admin\brand.brands')}}</h3>
                                <a class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            @include('dashboard.includes.alerts.success')
                            @include('dashboard.includes.alerts.errors')

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table
                                        class="table display nowrap table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>{{__('admin\brand.brand_name')}}</th>
                                            <th>{{__('admin\dashboard.status')}}</th>
                                            <th>{{__('admin\brand.brand_image')}}</th>
                                            <th>{{__('admin\dashboard.procedure')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            @isset($brands)
                                                @foreach($brands as $brand)
                                                <tr>
                                                <td>{{$brand ->name}}</td>
                                                <td>{{$brand ->getActive()}}</td>
                                                <td><img style="width: 60px; height:60px;" src="{{$brand->photo}}" ></td>
                                                    
                                                    <td>
                                                        <div class="btn-group" role="group"
                                                            aria-label="Basic example">
                                                    <a href="{{route('admin.brand.edit',$brand ->id)}}"
                                                    class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">{{__('admin\dashboard.botton_update')}}</a>

                                                            <a onclick="return confirm('Are you sure?')"  href="{{route('admin.brand.delete',$brand ->id)}}"
                                                            class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">{{__('admin\dashboard.botton_delete')}}</a>
                                                    
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach()
                                            @endisset()
                                        </tbody>
                                    </table>
                                    {{ $brands-> links()  }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection