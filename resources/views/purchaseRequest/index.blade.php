@extends('layouts.app')

@section('content')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="row d-flex">
        <div class="col">
            <h1 class="h1">Purchase Requisition List</h1>
        </div>
        <div class="col-auto">
            @if (Auth::user()->department->name !== 'DIRECTOR')
                <a href="{{ route('purchaserequest.create') }}" class="btn btn-primary">Create PR </a>
            @endif
        </div>
    </div>

    <section class="content">
        <div class="card mt-5">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped text-center mb-0">
                        <thead>
                            <tr>
                                <th class="fw-semibold fs-5">No</th>
                                <th class="fw-semibold fs-5">Date PR</th>
                                <th class="fw-semibold fs-5">To Department</th>
                                <th class="fw-semibold fs-5">PR No </th>
                                <th class="fw-semibold fs-5">Supplier</th>
                                <th class="fw-semibold fs-5">Action</th>
                                <th class="fw-semibold fs-5">Status</th>
                                <th class="fw-semibold fs-5">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($purchaseRequests as $pr)
                                <tr class="align-middle">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pr->date_pr }}</td>
                                    <td>{{ $pr->to_department }}</td>
                                    <td>{{ $pr->pr_no }}</td>
                                    <td>{{ $pr->supplier }}</td>
                                    <td>
                                        <a href="{{ route('purchaserequest.detail', ['id' => $pr->id]) }}"
                                            class="btn btn-secondary">
                                            <i class='bx bx-info-circle'></i> Detail
                                        </a>
                                        @if ($pr->user_id_create === Auth::user()->id)
                                            @if ($pr->status == 1 && $pr->status != -1)
                                                <a href="{{ route('purchaserequest.edit', $pr->id) }}"
                                                    class="btn btn-primary">
                                                    <i class='bx bx-edit'></i></i> Edit
                                                </a>
                                                @include('partials.delete-pr-modal', [
                                                    'id' => $pr->id,
                                                    'doc_num' => $pr->doc_num,
                                                ])
                                                <button class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#delete-pr-modal-{{ $pr->id }}">
                                                    <i class='bx bx-trash-alt'></i> <span
                                                        class="d-none d-sm-inline">Delete</span>
                                                </button>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if ($pr->status === 5)
                                            <span class="badge text-bg-danger px-3 py-2 fs-6">REJECTED</span>
                                        @elseif($pr->status === 0)
                                            <span class="badge text-bg-warning px-3 py-2 fs-6">WAITING FOR
                                                PREPARATION</span>
                                        @elseif($pr->status === 1)
                                            <span class="badge text-bg-warning px-3 py-2 fs-6">WAITING FOR DEPT
                                                HEAD</span>
                                        @elseif($pr->status === 2)
                                            <span class="badge text-bg-warning px-3 py-2 fs-6">WAITING FOR
                                                VERIFICATION</span>
                                        @elseif($pr->files === null)
                                            <span class="badge text-bg-warning px-3 py-2 fs-6">WAITING ATTACHMENT</span>
                                        @elseif($pr->status === 3)
                                            <span class="badge text-bg-warning px-3 py-2 fs-6">WAITING FOR
                                                DIRECTOR</span>
                                        @elseif($pr->status === 4)
                                            <span class="badge text-bg-success px-3 py-2 fs-6">APPROVED</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $pr->description }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">No Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ $purchaseRequests->links() }}
        </div>
    </section>
@endsection
