@extends('master')

@section('content')
<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>{{ isset($is_clone) && $is_clone ? 'Clone Asset' : 'Edit Products' }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ isset($is_clone) && $is_clone ? route('store.clone.save') : route('store.update') }}" Method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="controls">
                        <!-- Asset Type & brand start -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_name">Asset Type <span class="">

                                        </span>
                                    </label>
                                    @if(!isset($is_clone) || !$is_clone)
                                    <input type="hidden" value="{{ $all_store->id }}" name="stores_id">
                                    @endif
                                    <select id="form_need" name="asset_type" class="form-control" required="required"
                                        data-error="Please specify your need.">
                                        @foreach ($all_product_types as $all_product_types)
                                        <option value="{{ $all_product_types->id }}"
                                            {{ $all_product_types->id == $all_store->asset_type ? 'selected' : '' }}>
                                            {{ $all_product_types->product }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_name">Brand <span class="text-danger">* <a class="text-success"
                                                href="{{ route('brand') }}"><i class="fa fa-plus"
                                                    style="font-size:10px;"></a></i></span>
                                    </label>
                                    <select id="form_need" name="brand_id" class="form-control" required="required"
                                        data-error="Please specify your need.">
                                        @foreach ($all_brands as $all_brands)
                                        <option value="{{ $all_brands->id }}"
                                            {{ $all_brands->id == $all_store->brand_id ? 'selected' : '' }}>
                                            {{ $all_brands->brand_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Asset Type & brand start -->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_label">Model</label>
                                    <input type="hidden" value="{{ $all_store->id }}" name="model">
                                    <input type="text" class="form-control" name="model"
                                        value="{{ $all_store->model }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_label">SL No</label>
                                    <input type="hidden" value="{{ $all_store->id }}" name="sl_no">
                                    <input type="text" class="form-control" name="asset_sl_no"
                                        value="{{ $all_store->asset_sl_no }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_label">Description</label>
                                    <input type="hidden" value="{{ $all_store->id }}" name="description">
                                    <input id="text" name="description" class="form-control"
                                        value="{{ $all_store->description }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_label">Cost</label>
                                    <input type="hidden" value="{{ $all_store->id }}" name="cost">
                                    <input id="" type="number" name="cost" class="form-control"
                                        value="{{ $all_store->cost }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_label">Currency</label>
                                    <input type="hidden" value="{{ $all_store->id }}" name="currency">
                                    <input id="" type="text" name="currency" class="form-control"
                                        value="{{ $all_store->currency }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_label">Warrenty</label>
                                    <input type="hidden" value="{{ $all_store->id }}" name="warrenty">
                                    <input id="" type="number" name="warrenty"
                                        class="form-control" value="{{ $all_store->warrenty }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_label">Durability</label>
                                    <input type="hidden" value="{{ $all_store->id }}" name="durablity">
                                    <input id="" type="text" name="durablity"
                                        class="form-control" value="{{ $all_store->durablity }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_label">Quantity <span class="text-danger">*</span></label>
                                    <input type="hidden" value="{{ $all_store->id }}" name="qty">
                                    <input type="text" class="form-control" name="qty"
                                        value="{{ $all_store->qty }} ">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_label">Units </span><a class="text-success" href=""><i
                                                class="fa fa-plus" style="font-size:10px;"></a></i></label>
                                    <select id="form_need" name="units_id" class="form-control">
                                        @foreach ($all_SizeMaseurment as $all_SizeMaseurment)
                                        <option value="{{ $all_SizeMaseurment->id }}"
                                            {{ $all_SizeMaseurment->id == $all_store->units_id ? 'selected' : '' }}>
                                            {{ $all_SizeMaseurment->size }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_label">Purchase date</label>
                                    <input type="hidden" value="{{ $all_store->id }}" name="purchase_date">
                                    <input type="date" class="form-control" name="purchase_date"
                                        value="{{ $all_store->purchase_date }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_label">Vendor </span><a class="text-success" href=""><i
                                                class="fa fa-plus" style="font-size:10px;"></a></i></label>
                                    <select id="form_need" name="vendor" class="form-control">
                                        @foreach ($all_supplier as $all_supplier)
                                        <option value="{{ $all_supplier->id }}"
                                            {{ $all_supplier->id == $all_store->vendor ? 'selected' : '' }}>
                                            {{ $all_supplier->supplier_name }}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_label">Company </span><a class="text-success" href=""><i
                                                class="fa fa-plus" style="font-size:10px;"></a></i></label>
                                    <select id="form_need" name="company_id" class="form-control">
                                        @foreach ($all_company as $all_company)
                                        <option value="{{ $all_company->id }}"
                                            {{ $all_company->id == $all_store->company_id ? 'selected' : '' }}>
                                            {{ $all_company->company }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_label">Location<span class="text-danger">* </span><a
                                            class="text-success" href=""><i class="fa fa-plus"
                                                style="font-size:10px;"></a></i></span></label>
                                    <select id="form_need" name="location" class="form-control" required="required"
                                        data-error="location">
                                        @foreach ($all_departments as $all_departments)
                                        <option value="{{ $all_departments->id }}"
                                            {{ $all_departments->id == $all_store->location ? 'selected' : '' }}>
                                            {{ $all_departments->department_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_label">Status </span><a class="text-success" href=""><i
                                                class="fa fa-plus" style="font-size:10px;"></a></i></label>
                                    <select id="form_need" name="status_id" class="form-control" data-error="status_id">
                                        @foreach ($all_status as $all_status)
                                        <option value="{{ $all_status->id }}"
                                            {{ $all_status->id == $all_store->status_id ? 'selected' : '' }}>
                                            {{ $all_status->status_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_label">Challan Number</label>
                                    <input type="hidden" value="{{ $all_store->id }}" name="challan_no">
                                    <input type="text" class="form-control" name="challan_no"
                                        value="{{ $all_store->challan_no }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_label">Note</label>
                                    <input type="hidden" value="{{ $all_store->id }}" name="others">
                                    <input type="text" class="form-control" name="note"
                                        value="{{ $all_store->others }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="form_label">Picture</label>
                                <input type="file" name="picture" value="" class="form-control"
                                    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                <img src="{{ asset('/uploads/store/') }}/{{ $all_store->picture }}" id="blah"
                                    alt="" width="200">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 offset-md-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>

                                <a href="{{route('store')}}" class="btn btn-info">Back</a>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection