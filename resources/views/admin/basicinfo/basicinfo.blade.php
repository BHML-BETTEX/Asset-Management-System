@extends('master')

@section('content')

<style>
    .nav-link:hover {
      color: #0056b3 !important; /* Change text color on hover */
      background-color: #e9ecef; /* Add light background on hover */
      transition: 0.3s;         /* Smooth transition */
    }
  </style>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Basic Info</li>
    </ol>
</nav>

<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #0cb0b7;">
    <a class="navbar-brand text-white" href="{{route ('department')}}">Department</a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link text-white " href="#">Designation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Employee</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Brand</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Supplier</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Asset Type</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Location</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Units</a>
        </li>
      </ul>
    </div>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

@endsection