@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Rental Cars') }}</div>

                <div class="card-body">


                    @if ($data->id == "")
                        <form id="main" method="POST" action="{{-- route('user.store') --}}" enctype="multipart/form-data">
                    @else
                        <form id="main" method="POST" action="{{-- route('user.update',$data) --}}" enctype="multipart/form-data">
                        @method('PUT')
                    @endif

                        @csrf

                        
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">
                                {{ __('Name') }}
                            </label>

                            <div class="col-md-6">
                                <input id="name" type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    name="name" value="{{ old('name', $data->name) }}"  
                                    autofocus disabled>

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
                                    name="email" value="{{ old('email', $data->email) }}" disabled>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <ol class="list-group list-group-flush">
                                <li class="list-group-item list-group-item-dark text-center" style="font-weight: bold;">    
                                     Carro &emsp; &emsp; &emsp; | &emsp; &emsp; &emsp; Data do Aluguel
                                </li>
                            @foreach ($posts as $post)
                                <li class="list-group-item">
                                    <a class="list-group-item list-group-item-action text-center" href='{{route('post.edit',$post)}}'>
                                    {{ $post->subject }} &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; {{ $post->publish_date->format('d-m-Y') }}</a>
                                </li>
                            @endforeach
                        </ol>

                        {{ $posts->links() }}
                            

                    </form>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                {{--<button type="submit" class="btn btn-primary" form="main">
                                    {{ __('Save') }}
                                </button>

                                <a class='btn btn-secondary' href="{{route('user.create')}}">
                                    {{__('New user')}}
                                </a>


                                                                
                                @if ($data->id != "")
                                <form name='delete' action="{{route('user.destroy',$data)}}"
                                    method="user"
                                    style='display: inline-block;'
                                    >
                                    @csrf
                                    @method("DELETE")
                                    <button type="button" onclick="confirmDeleteModal(this)" class="btn btn-danger">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                                @endif
--}}
                                
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
