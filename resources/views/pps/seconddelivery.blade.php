@extends('layouts.app')

@section('content')

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-body p-0">
                    <h1>Delivery Menu for second
                    </h1>

                    <a href="{{ route('itemsecond') }}" class="btn btn-secondary float-right"> Lanjut</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection