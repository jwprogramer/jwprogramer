@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Control Panel') }}</div>

                <div class="card-body">
                    <form method="GET" action="{{ route('post.list') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="busca" class="col-md-4 col-form-label text-md-end">{{ __('Contractor') }}</label>
                            <div class="col-md-6">
                                <input id="busca" type="text" class="form-control" 
                                         name="busca" value="{{ old('busca') }}" 
                                         autofocus>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="manuf" class="col-md-4 col-form-label text-md-end">{{ __('Manufacturer') }}</label>
                            <div class="col-md-6">
                                <input id="manuf" type="text" class="form-control" 
                                         name="manuf" value="{{ old('manuf') }}" 
                                         autofocus>
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <label for="text" class="col-md-4 col-form-label text-md-end">{{ __('Model') }}</label>
                            <div class="col-md-6">
                                <input id="text" type="text" class="form-control" 
                                         name="text" value="{{ old('text') }}" 
                                         autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="rent_date" class="col-md-4 col-form-label text-md-end">{{ __('Rent date') }}</label>
                            <div class="col-md-6">
                                <input id="rent_date" type="date" class="form-control" 
                                         name="rent_date" value="{{ old('rent_date') }}" 
                                         autofocus>
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Search') }}
                                </button>

                                <a class='btn btn-secondary' href="{{route('post.create')}}">
                                    {{__('New rent')}}
                                </a>
                                
                            </div>
                        </div>
                    </form>


                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col">{{__("Model")}}</th>
                            <th scope="col">{{__("Manufacturer")}}</th>
                            <th scope="col">{{__("Contractor")}}</th>
                            <th scope="col">{{__("Rent date")}}</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $item)
                                <tr>
                                    <td>
                                        <a href="{{route("post.edit",$item)}}" class="btn btn-primary">
                                            {{ __('Edit') }}
                                        </a>
                                    </td>
                                    <td>{{$item->model}}</td>    
                                    <td>{{$item->manuf}}</td>    
                                    <td>{{$item->cont}}</td>
                                    <td>{{$item->rent_date->format("d-m-Y")}}</td>    
                                    <td>
                                        <form action="{{route('post.destroy',$item)}}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            <button class="btn btn-danger" type="button" onclick="confirmDeleteModal(this)"  >
                                                {{ __('Close') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                      </table>


                    
                        
                    
                    {{ $list->links() }}
                


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
