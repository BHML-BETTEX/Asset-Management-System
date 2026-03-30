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

<div class="row">
    <div class="col-lg-8">
        <div class="card p-1">
            <div class="card">
                <div class="card-header">
                    <h3>Department List</h3>
                </div>
        <div class="card-body">
            <!-- Search Form -->
            <form method="GET" action="{{ route('department') }}" class="mb-3">
                <div class="row g-3 align-items-end">
                    <div class="col-md-9">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" class="form-control" id="search" name="search" value="{{ $search }}" placeholder="Search departments...">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                    </div>
                </div>
            </form>

          <table class="table table-bordered">
            <tr>
                <th>SL</th>
                <th>Department</th>
                <th>Action</th>
            </tr>

            @if (session ('delete_department'))
                    <div class="alert alert-success">{{ session('delete_department') }}</div>
                @endif
            @foreach($all_departments as $key=>$department)
               <tr class="" style="height: 25px;">
                    <td>{{$key+1}}</td>
                    <td>{{$department->department_name}}</td>
                    <td>
                    <button class="border-0 bg-white"><a class="text-primary" href="{{route('department_edit',$department->id)}}"><i class="fa fa-edit " style="font-size:20px;"></a></i></button>
                   <!-- <button class="border-0  bg-white"><a class="text-danger" href="{{route('department.delete',$department->id)}}"><i class="fa fa-trash " style="font-size:20px;"></a></i></button>-->
                    </td>
                </tr>
            @endforeach
        </table>

        <!-- Pagination -->
        @if ($all_departments instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                {{-- Left: Showing X to Y of Z --}}
                <div class="d-flex align-items-center mb-2">
                    <span class="me-2">
                        Showing {{ $all_departments->firstItem() }} to {{ $all_departments->lastItem() }} of {{ $all_departments->total() }} rows
                    </span>

                    {{-- Dropdown --}}
                    <form method="GET" action="{{ url()->current() }}" class="d-flex align-items-center">
                        <select name="per_page" class="form-select form-select-sm w-auto me-1" onchange="this.form.submit()">
                            @php $options = [10, 25, 50, 100, 'all']; @endphp
                            @foreach ($options as $option)
                            <option value="{{ $option }}" {{ request('per_page', 13) == $option ? 'selected' : '' }}>
                                {{ is_numeric($option) ? $option : 'All' }}
                            </option>
                            @endforeach
                        </select>
                        <span>rows per page</span>

                        {{-- Keep filters --}}
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    </form>
                </div>

                {{-- Right: Pagination links --}}
                <div class="mb-2">
                    <div class="pagination-wrapper">
                        {{ $all_departments->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        @endif
            </div>
          </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card p-1" >
            <div class="card-header " style="background-color: #0cb0b7;">
                <h3 class="text-white">Add Department</h3>
            </div>
            <div class="card-body">
                <form action="{{route ('department.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Department_name</label>
                            <input type="text" class="form-control" name="department_name" placeholder="Department Name">
                                @error('department_name')
                                <strong>{{$message}}</strong>
                                @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

