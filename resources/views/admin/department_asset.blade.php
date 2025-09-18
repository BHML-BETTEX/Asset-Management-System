@extends('master')
@section('content')

<div class="container">
    <div class="page-title">
        <div class="row ">
            <div class="col-md-12">
                <div class="col-md-5 p-2">
                    <h5 class="text-white">Department Asset List</h5>
                </div>
                <div class="col-md-4 top_search">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="search" class="form-control" name="search" placeholder="Search for..."
                                value="">
                            <button class="btn btn-secondary" type="submit">Go!</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-2 ">
                    <form action="" method="GET">
                        <div class="input-group">
                            <select name="type" class="form-control">
                                <option value="">Select Type</option>
                                <option value="xlsx">XLSX</option>
                                <option value="csv">CSV</option>
                                <option value="xls">XLS</option>
                            </select>
                            <button type="submit" class="btn btn-success">Export</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--display form start-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped table-bordered">
                                <thead class="bg-info text-white">
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Employee Name</th>
                                        <th>Designation</th>
                                        <th>Department</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Company</th>
                                        <th>Asset</th>
                                        <th>Consumable</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($employees as $emp)
                                    <tr>
                                        <td>{{ $emp->emp_id }}</td>
                                        <td>{{ $emp->emp_name }}</td>
                                        <td>{{ $emp->designation_name ?? '-' }}</td>
                                        <td>{{ $emp->department_name ?? '-' }}</td>
                                        <td>{{ $emp->email ?? '-' }}</td>
                                        <td>{{ $emp->phone ?? '-' }}</td>
                                        <td>{{ $emp->company ?? '-' }}</td>
                                        <td>{{ $emp->total_asset ?? 0 }}</td>
                                        <td>{{ $emp->total_consumable ?? 0 }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No employees found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            {{-- Pagination Links --}}
                            <div>
                                @if (!$showAll && method_exists($employees, 'links'))
                                {{ $employees->links() }}
                                @endif
                            </div>

                            {{-- Show All Link (inline with pagination) --}}
                            <div>
                                @if (!$showAll)
                                <a href="{{ request()->fullUrlWithQuery(['show_all' => 1]) }}" class="btn btn-sm btn-link text-danger">
                                    Show all
                                </a>
                                @else
                                <a href="{{ request()->fullUrlWithQuery(['show_all' => 0]) }}" class="btn btn-sm btn-link text-secondary">
                                    Paginate
                                </a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ajax code -->

<!--display form end-->
@endsection