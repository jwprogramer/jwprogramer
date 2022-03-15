@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Rental Cars') }}</div>

                <div class="card-body">


                    
                        <form id="main" method="POST" action="{{route('users.update', $data)}}" enctype="multipart/form-data">
                        @method('PUT')

                        @csrf

                      
                        
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">
                                {{ __('Name') }}
                            </label>

                            <div class="col-md-6">
                                <input id="name" type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    name="name" value="{{ old('name', $data->name) }}"  
                                    autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">
                                {{ __('E-mail') }}
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    name="email" value="{{ old('email', $data->email) }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="level" class="col-md-4 col-form-label text-md-end">
                                {{ __('Level') }}
                            </label>
                            <div class="col-md-6">
                                <select id="level" name="level" class="form-select @error('level') is-invalid @enderror" aria-label="Default select 
                                example">
                                    

                                
                                    <option value='{{10}}'
                                    @if ($list[$data->id-1]->level == 10)
                                        selected
                                    @endif
                                    >ADMINISTRADOR</option>
                                <option value='{{0}}'
                                    @if ($list[$data->id-1]->level == 0)
                                            selected
                                    @endif
                                    >PADRÃO</option>
                        
                                </select>

                                @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                               
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary" form="main">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                        



                        <table class="table table-striped table-hover text-center">
                            <thead>
                              <tr>
                                <th scope="col">{{ __('Contractor') }}</th>
                                <th scope="col">{{ __('Car') }}</th>
                                <th scope="col">{{ __('Rent date') }}</th>
                              </tr>
                            </thead>
                                @foreach ($posts as $post)
                                <tbody style="color: rgb(0, 0, 0)">
                                <tr>
                                <th scope="row">
                                    <a style="display: block; height: 100%; width: 100%; text-decoration: none; color: rgb(0, 0, 0); border: 0;" 
                                    href='{{route('post.edit',$post)}}'>{{ $post->cont }}</a>
                                </th>
                                <td>
                                    <a style="display: block; height: 100%; width: 100%; text-decoration: none; color: gray; border: 0;" 
                                    href='{{route('post.edit',$post)}}'>{{ $post->model }} </a>     
                                </td>
                                <td>
                                    <a style="display: block; height: 100%; width: 100%; text-decoration: none; color: gray; border: 0;" 
                                    href='{{route('post.edit',$post)}}'>{{ $post->rent_date->format('d-m-Y') }} </a>     
                                </td>
                                </tr>    
                                </tbody>
                            @endforeach
                        </table>   

                        {{ $posts->links() }}
                            

                    </form>


                                
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
