@extends('layouts.template')

@section('content')
<!-- Page Header-->
<header class="masthead" style="background-image: url('{{asset('layout_aluguei/assets/img/loja.jpg')}}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-10">
                <div class="page-heading">
                    <h1>{{__("About our Company")}}</h1>
                    <span class="subheading">{{__("the beginning of everything.")}}</span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main Content-->
<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-10">
                <p class="text-center">{{__("Our company was born from a dream and to meet the needs of the Rio Grande do Norte market.")}}</p>
                <p class="text-center">{{__("Our mission is to satisfy our customer, including making conditions accessible to everyone. Visit us!")}}</p>
            </div>
        </div>
    </div>
</main>
<!-- Footer-->
@endsection