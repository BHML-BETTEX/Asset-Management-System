@extends('master')

@section('content')

<style>
    .pagination-wrapper nav {
        margin-bottom: 0;
    }

    .form-select-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        height: auto;
    }
</style>

<div class="row ">
    <div class="col-md-12">
        <div class="col-md-7 p-2">
            <h5 class="text-white">History List</h5>
        </div>

        <div class="col-md-2 top_search">
            <form action="" method="GET">
                <div class="input-group">
                    <input type="search" class="form-control" name="search" placeholder="Search for..."
                        value="{{$search}}">
                    <button class="btn btn-info" type="submit"><span class="fa fa-search"></span></button>
                </div>
            </form>
        </div>
        <div class="col-md-2 ">
            <form action="{{route('history_export')}}" method="GET">
                <div class="input-group">
                    @foreach ($_GET as $key=> $item)
                    <input type="hidden" name="{{$key}}" value="{{$item}}">
                    @endforeach
                    <select name="type" class="form-control">
                        <option value="">Select Type</option>
                        <option value="xlsx">XLSX</option>
                        <option value="csv">CSV</option>
                        <option value="xls">XLS</option>
                    </select>
                    <button type="submit" class="btn btn-success"><span class="fa fa-file-excel-o"></button>
                </div>
            </form>
        </div>
        <div class="col-md-1 ">
            <div class="input-group">
                <a href="{{route('pdf.history', $_GET)}}">
                    <button class="btn btn-info"><i class="fa fa-download"></i> PDF</button>
            </div>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped table-bordered">
                        <thead class="bg-info text-white table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>ASSET TAG</th>
                                <th>ASSET TYPE</th>
                                <th>MODEL</th>
                                <th>DESCRIPTION</th>
                                <th>COMPANY</th>
                                <th>EMP ID</th>
                                <th>EMP NAME</th>
                                <th>DESIGNATION</th>
                                <th>DEPARTMENT</th>
                                <th>PHONE NUMBER</th>
                                <th>EMAIL</th>
                                <th>NOTE</th>
                                <th>ISSUE DATE</th>
                                <th>RETURN DATE</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($issue_info as $key => $issue_infos)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $issue_infos->asset_tag }}</td>
                                <td>{{ $issue_infos->asset_type }}</td>
                                <td>{{ $issue_infos->model }}</td>
                                <td>{{ $issue_infos->description }}</td>
                                <td>{{ $issue_infos->others }}</td>
                                <td>{{ $issue_infos->emp_id }}</td>
                                <td>{{ $issue_infos->emp_name }}</td>
                                <td>{{ $issue_infos->designation_id }}</td>
                                <td>{{ $issue_infos->department_id }}</td>
                                <td>{{ $issue_infos->phone_number }}</td>
                                <td>{{ $issue_infos->email }}</td>
                                <td></td>
                                <td>{{ $issue_infos->issue_date }}</td>
                                <td>{{ $issue_infos->return_date }}</td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                                    <!-- pagination start-->
                    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                        {{-- Showing rows info + dropdown in one line --}}
                        <div class="d-flex align-items-center mb-2">
                            {{-- Showing count --}}
                            @if ($issue_info instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            <span class="me-2">
                                Showing {{ $issue_info->firstItem() }} to {{ $issue_info->lastItem() }} of {{ $issue_info->total() }} rows
                            </span>
                            @else
                            <span class="me-2">Showing all {{ $issue_info->count() }} rows</span>
                            @endif

                            {{-- Per page dropdown --}}
                            <form method="GET" action="{{ url()->current() }}" class="d-flex align-items-center">
                                <select name="per_page" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                                    @php $options = [10, 25, 50, 100, 'all']; @endphp
                                    @foreach ($options as $option)
                                    <option value="{{ $option }}" {{ request('per_page', 10) == $option ? 'selected' : '' }}>
                                        {{ is_numeric($option) ? $option : 'All' }}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="ms-1">rows per page</span>

                                {{-- Retain other filters --}}
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            </form>
                        </div>

                        {{-- Pagination links --}}
                        <div class="mb-2">
                            @if ($issue_info instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            <div class="pagination-wrapper">
                                {{ $issue_info->appends(request()->query())->links() }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <!-- pagination End-->
            </div>
        </div>
    </div>
</div>
@endsection