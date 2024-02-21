@extends('layouts.app')

@push('extraCss')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />
@endpush

@section('content')


<section aria-label="header">
    <div class="d-flex justify-content-between align-items-center">
        <span class="fs-1">User List</span>
        <div>
            @include('partials.add-user-modal')
            <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-user-modal">
                <i class="lni lni-plus"></i>
                Add user
            </button>
        </div>
    </div>
</section>

<section class="breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('superadmin.home')}}">Home</a></li>
          <li class="breadcrumb-item active">Users</li>
        </ol>
    </nav>
</section>

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p>{{ $message }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif ($errors->any())
    <div class="alert alert-danger alert-dismissable fade show" role="alert">
        <div class="d-flex">
            <div class="flex-grow-1">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

<section aria-label="table">
    <div class="card ">
        <!-- Table body -->
        <div class="card-body">

            {{ $dataTable->table() }}
        </div>
    </div>
</section>

@endsection

@push('extraJs')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush