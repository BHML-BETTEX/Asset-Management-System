<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">    

    <title>BHML</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


    <!-- Custom styles for this template-->
    <link href="{{ asset('/backend/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

    </head>

    <body id="page-top">
        <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header text-center">
                <div class="bg-primary">..</div><br>
                    <h2 class="font-weight-bold text-primary">BHML Industries Ltd.</h2>
                    <p class="pt-0">kamarjuri, Natunbazar, National university, Gazipur</p>
            </div>
            <div class="card-body">
                <div class="container">
                <div class="row">
                    <div class="col-xl-8">
                        <ul class="list-unstyled">
                        <li class="text-muted"><h5 style="color:#5d9fc5 ;" class="font-weight-bold">Product Acknoladge Form</h5></li>
                        <li class="text-muted">Employee Name: <span style="color:#5d9fc5 ;">{{$desktop_info->emp_name}}</span></li>
                        <li class="text-muted">Employee ID: <span style="color:#5d9fc5 ;">{{$desktop_info->emp_id}}</span></li>
                        <li class="text-muted">Designation: <span style="color:#5d9fc5 ;">{{$desktop_info->designation_id}}</span></li>
                        <li class="text-muted">Department: <span style="color:#5d9fc5 ;">{{$desktop_info->department_id}}</span></li>
                        <li class="text-muted"><i class="fas fa-phone"></i>{{$desktop_info->phone_number}}</li>
                        </ul>
                    </div>
                    <div class="col-xl-4">
                        <p class="text-muted">Invoice</p>
                        <ul class="list-unstyled">
                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                            class="fw-bold">ID:</span>#123-456</li>
                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                            class="fw-bold">Creation Date: </span>{{$desktop_info->issue_date}}</li>
                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                            class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
                            Unpaid</span></li>
                        </ul>
                    </div>
                    </div>

                    <div class="row my-2 mx-1 justify-content-center">
                    <table class="table table-striped table-borderless">
                        <thead style="background-color:#84B0CA ;" class="text-white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Item</th>
                            <th scope="col">Description</th>
                            <th scope="col">Picture</th>
                            <th scope="col">others</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>{{$desktop_info->products_id}}</td>
                            <td>{{$desktop_info->product_details}}</td>
                            <td><img width="50" src="{{asset('uploads/desktop')}}/{{$desktop_info->picture}}" alt=""></td>
                            <td></td>
                        </tr>

                        </tbody>

                    </table>
                    </div>
                    <div class="row">
                    <div class="col-xl-12">
                    <p>In doing so ,I, do infact  understand that I am solely resposible for this device until it is returned to Bettex (HK)Ltd ,IT Department .   While under my care ,I acknowledge that any physical or accidental damage is my fault and I will be accountable for it. While using this laptop device ,I willl not commit any acts of cyber crime ,illegal activity,share any company information with unauthorised users,search or watch any explicit contents ,install any software without IT consent or lend laptop to friends or family members.I will strictly use this laptop for work purpose.                                                                                                                                            By signing this document ,I am accepting and agreeing to the terms and use for this Product.</p>
                    </div>
                    </div>
                    <hr>
                    <div class="row">
                    <div class="col-xl-10">
                        <p>www.bhml-bettex.com.bd</p>
                    </div>
                    </div><br><hr><br><br>

                    <div class="mb-3">
                        <div class="float-left">
                            <span>Employee Signature</span>   
                        </div>    
                        <div class="float-right">
                            <span>Authorized Signature</span>   
                        </div>   
                    </div><br><br>


                    <footer class="bg-primary">
                        <p class="text-center text-white-50">bhml Industries Ltd.</p>
                    </footer>

            </div>
        </div>
    </div>


<!-- Bootstrap core JavaScript-->
<script src="{{ asset('/backend/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('/backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('/backend/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('/backend/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('/backend/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('/backend/js/demo/chart-pie-demo.js') }}"></script>

</body>