@extends('layouts.app')

@section('content')


<section aria-label="header">
    <div class="d-flex justify-content-between align-items-center">
        <span class="fs-1">Department List</span>
        <div>
            @include('partials.add-department-modal')
            <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-department-modal">
                <i class="lni lni-plus"></i>
                Add department
            </button>
        </div>
    </div>
</section>

<section class="breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('superadmin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Departments</li>
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
        <div class="card-body p-0">
            <div class="table-responsive-lg">
                <table class="table table-striped table-hover align-middle m-0 text-center">
                    <thead>
                        <tr class="fs-5">
                            <th class="py-3">No</th>
                            <th class="py-3">ID</th>
                            <th class="py-3">Name</th>
                            <th class="py-3">Created At</th>
                            <th class="py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider ">
                        @forelse ($departments as $department)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$department->id}}</td>
                                <td>{{$department->name}}</td>
                                <td>{{$department->created_at}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit-department-modal-{{ $department->id }}">Edit</button>
                                    @include('partials.edit-department-modal')

                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-department-modal-{{ $department->id }}">Delete</button>
                                    @include('partials.delete-department-modal')

                                    {{-- <input type="checkbox"></input> --}}
                                </td>
                            </tr>
                        @empty
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
