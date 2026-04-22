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
        <div class="card">
            <div class="card-header">
                <h3>Product List</h3>
            </div>
            <div class="card-body">
                <!-- Search Form -->
                <form method="GET" action="{{ route('product_type') }}" class="mb-3">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-9">
                            <label for="search" class="form-label">Search</label>
                            <input type="text" class="form-control" id="search" name="search" value="{{ $search }}" placeholder="Search products...">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100">Search</button>
                        </div>
                    </div>
                </form>

                <table class="table table-striped">
                    <tr>
                        <th>SL</th>
                        <th>product</th>
                        <th>Action</th>
                    </tr>


                @if (session ('delete_producttype'))
                    <div class="alert alert-success">{{ session('delete_producttype') }}</div>
                @endif

                @if (session ('add_producttype'))
                    <div class="alert alert-success">{{ session('add_producttype') }}</div>
                @endif

                    @foreach($all_producttypes as $key=>$ProductType)

                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$ProductType->product}}</td>
                            <!--<td><a href="{{ route ('product.delete', $ProductType->id)}}" class="text-danger"><i class="fa fa-trash"></i></a>-->
                            <td><a href="" class="text-primary"><i class="fa fa-edit"></i></a>

                            </td>
                        </tr>

                    @endforeach

                    <tr>

                    </tr>
                </table>

                <!-- Pagination -->
                @if ($all_producttypes instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                        {{-- Left: Showing X to Y of Z --}}
                        <div class="d-flex align-items-center mb-2">
                            <span class="me-2">
                                Showing {{ $all_producttypes->firstItem() }} to {{ $all_producttypes->lastItem() }} of {{ $all_producttypes->total() }} rows
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
                                {{ $all_producttypes->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add product</h3>
            </div>
            
            <div class="card-body">
                <form action="{{route ('product.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Product</label>
                        <input type="text" class="form-control" name="product">
                        
                        @error('product')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">submit</button>
                    </div>


                </form>

            </div>
        </div>
    </div>
</div>

@endsection