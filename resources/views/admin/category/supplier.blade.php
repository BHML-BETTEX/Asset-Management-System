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
                <div class="card-header" style="background-color: #0cb0b7; color:white;">
                    <h3>Supplier List</h3>
                </div>
        <div class="card-body">
            <!-- Search Form -->
            <form method="GET" action="{{ route('supplier') }}" class="mb-3">
                <div class="row g-3 align-items-end">
                    <div class="col-md-9">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" class="form-control" id="search" name="search" value="{{ $search }}" placeholder="Search suppliers...">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                    </div>
                </div>
            </form>

          <table class="table table-bordered">
            <tr>
                <th>SL</th>
                <th>supplier_name</th>
                <th>address</th>
                <th>phone</th>
                <th>email</th>
                <th>web</th>
                <th>Action</th>
            </tr>
            @foreach($all_supplier as $key=>$supplier)
               <tr class="" style="height: 25px;">
                    <td>{{$key+1}}</td>
                    <td>{{$supplier->supplier_name}}</td>
                    <td>{{$supplier->address}}</td>
                    <td>{{$supplier->phone}}</td>
                    <td>{{$supplier->email}}</td>
                    <td>{{$supplier->web}}</td>
                    <td>
                    <button class="border-0 bg-white"><a class="text-primary" href=""><i class="fa fa-edit " style="font-size:20px;"></a></i></button>
                    <!--<button class="border-0  bg-white"><a class="text-danger" href="{{route('supplier.delete', $supplier->id)}}"><i class="fa fa-trash " style="font-size:20px;"></a></i></button>-->
                    </td>
                </tr>
            @endforeach
        </table>

        <!-- Pagination -->
        @if ($all_supplier instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                {{-- Left: Showing X to Y of Z --}}
                <div class="d-flex align-items-center mb-2">
                    <span class="me-2">
                        Showing {{ $all_supplier->firstItem() }} to {{ $all_supplier->lastItem() }} of {{ $all_supplier->total() }} rows
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
                        {{ $all_supplier->appends(request()->query())->links() }}
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
                <h3 class="text-white">Add Supplier</h3>
            </div>
            @error('suppler_add')
                <strong>{{$message}}</strong>
            @enderror   
            <div class="card-body">
                <form action="{{route('supplier.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Supplier Name *</label>
                            <input type="text" class="form-control" name="supplier_name" placeholder="supplier name" required> 
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Address *</label>
                            <input type="text" class="form-control" name="address" placeholder="Address" required>  
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Phone *</label>
                            <input type="number" class="form-control" name="phone" placeholder="phone" required>  
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email *</label>
                            <input type="text" class="form-control" name="email" placeholder="email" required>  
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Web</label>
                            <input type="text" class="form-control" name="web" placeholder="web">  
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Others1</label>
                            <input type="text" class="form-control" name="others1" placeholder="others1">  
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Others2</label>
                            <input type="text" class="form-control" name="others2" placeholder="others2">  
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

