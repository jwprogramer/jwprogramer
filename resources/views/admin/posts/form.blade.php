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
                            <label for="manuf" class="col-md-4 col-form-label text-md-end">
                                {{ __('Manufacturer') }}
                            </label>

                            <div class="col-md-6">
                                <select id="manuf" name="manuf" class="form-select @error('manuf') is-invalid @enderror" aria-label="Default select 
                                example">
                                    <option value="">Selecione uma Opção</option>
                                    <option {{ ($data->manuf) == 'Chevrolet' ? 'selected' : '' }} value="Chevrolet">Chevrolet</option>
                                    <option {{ ($data->manuf) == 'Fiat' ? 'selected' : '' }} value="Fiat">Fiat</option>
                                    <option {{ ($data->manuf) == 'Toyota' ? 'selected' : '' }} value="Toyota">Toyota</option>
                                    <option {{ ($data->manuf) == 'Hyundai' ? 'selected' : '' }} value="Hyundai">Hyundai</option>
                                    <option {{ ($data->manuf) == 'Volkswagen' ? 'selected' : '' }} value="Volkswagen">Volkswagen</option>
                                </select>
                    
                                @error('manuf')
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
                                <button type="submit" class="btn btn-primary" form="main">
                                    {{ __('Save') }}
                                </button>

                                <a class='btn btn-secondary' href="{{route('post.create')}}">
                                    {{__('New rent')}}
                                </a>


                                                                
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

                                
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
