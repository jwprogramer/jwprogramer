@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Rent') }}</div>

                <div class="card-body">


                    @if ($data->id == "")
                        <form id="main" method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                    @else
                        <form id="main" method="POST" action="{{ route('post.update',$data) }}" enctype="multipart/form-data">
                        @method('PUT')
                    @endif

                        @csrf
                        
                        <div class="row mb-3">
                            <label for="cont" class="col-md-4 col-form-label text-md-end">
                                {{ __('Contractor') }}
                            </label>

                            <div class="col-md-6">
                                <input id="cont" type="text" 
                                    class="form-control @error('cont') is-invalid @enderror" 
                                    name="cont" value="{{ old('cont', $data->cont) }}"  
                                    autofocus>

                                @error('cont')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">
                                {{ __('Address') }}
                            </label>

                            <div class="col-md-6">
                                <input id="address" type="text" 
                                    class="form-control @error('address') is-invalid @enderror" 
                                    name="address" value="{{ old('address', $data->address) }}"  
                                    autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="model" class="col-md-4 col-form-label text-md-end">
                                {{ __('Model') }}
                            </label>


                            <div class="col-md-6">
                                <input id="model" type="text" 
                                    class="form-control @error('model') is-invalid @enderror" 
                                    name="model" value="{{ old('model', $data->model) }}"  
                                    autofocus>

                                @error('model')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="manuf_id" class="col-md-4 col-form-label text-md-end">
                                {{ __('Manufacturer') }}
                            </label>

                            <div class="col-md-6">
                                <select id="manuf_id" name="manuf_id" class="form-select @error('manuf_id') is-invalid @enderror" aria-label="Default select 
                                example">
                                    <option value="">{{__('Select one option')}}</option>
                                    @foreach($manuf_rents as $inf)
                                
                                    <option value='{{$inf->id}}'
                                        @if (old('manuf_id',$data->manuf_id) == $inf->id)
                                            selected
                                        @endif
                                        >{{$inf->name}}</option>
                                @endforeach
                                </select>

                                @error('manuf_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="rent_date" class="col-md-4 col-form-label text-md-end">
                                {{ __('Rent date') }}
                            </label>

                            <div class="col-md-6">
                                <input id="rent_date" type="date" 
                                    class="form-control @error('rent_date') is-invalid @enderror" 
                                    name="rent_date" value="{{ old('rent_date',$data->rent_date == "" ? "" : $data->rent_date->format('Y-m-d')) }}"  >

                                @error('rent_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">
                                {{ __('Vehicle photo') }}
                            </label>

                            <div class="col-md-6">
                                <input id="image" type="file" 
                                    class="form-control @error('image') is-invalid @enderror" 
                                    name="image" value="{{ old('image', $data->image) }}"  >


                                @if ($data->id)
                                    <img src="{{asset($data->image)}}" class="rounded" width='200'/>
                                @endif
                                

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                      
                    </form>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                @can('view',$data)
                                <button type="submit" class="btn btn-primary" form="main">
                                    {{ __('Save') }}
                                </button>
                                @endcan
                                <a class='btn btn-secondary' href="{{route('post.create')}}">
                                    {{__('New rent')}}
                                </a>


                                @can('view',$data)                                
                                @if ($data->id != "")
                                <form name='delete' action="{{route('post.destroy',$data)}}"
                                    method="post"
                                    style='display: inline-block;'
                                    >
                                    @csrf
                                    @method("DELETE")
                                    <button type="button" onclick="confirmDeleteModal(this)" class="btn btn-danger">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                                @endif
                                @endcan
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
