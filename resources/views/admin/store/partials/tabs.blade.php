@php
    $storeData = $stores ?? $store ?? null;
@endphp

@if ($storeData)
<div class="row mb-2 bg-white rounded-3 shadow-sm">
    <ul class="nav nav-tabs mb-3 w-100 d-flex align-items-center" id="employeeTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('store_info') ? 'active' : '' }}"
                href="{{ route('store_info', $storeData->id) }}" role="tab">Info</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('issue') ? 'active' : '' }}"
                href="{{ route('issue', $storeData->id) }}" role="tab">History</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('maintenance_list') ? 'active' : '' }}"
                href="{{ route('maintenance_list', $storeData->id) }}" role="tab">Maintenance</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#files" role="tab">Files</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#uploadsModal" href="#">
                <i class="fa fa-paperclip"></i> Uploads
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                <i class="fa fa-gear"></i> Action
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Action One</a></li>
                <li><a class="dropdown-item" href="#">Action Two</a></li>
            </ul>
        </li>
    </ul>
</div>
@endif
