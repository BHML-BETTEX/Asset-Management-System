<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Asset Managment</title>

    <!-- Bootstrap -->
    <link href="{{ asset('backend/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('backend/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('backend/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('backend/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{ asset('backend/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}"
        rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('backend/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('backend/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('backend/build/css/custom.min.css') }}" rel="stylesheet">

<style>
    @media print{
        .no-print{
            display:none;
        }
    }
</style>

</head>

<div class="container">

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">

                <div class="x_content">

                    <section class="content invoice">
                        <!-- title row -->

                        <!--<strong>{{ $stores_info->rel_to_Company->company }}</strong>-->
                        <div class="row">
                            <div class="  invoice-header">
                                <h3>
                                    <i class="fa fa-globe"></i> Acknowledgement Form.
                                </h3>
                            </div><br>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <b>From</b> 
                                <address>
                                    <strong>{{ $stores_info->rel_to_Company->company }}</strong>
                                    <br>{{ $stores_info->rel_to_Company->company }}
                                    <br>{{ $stores_info->rel_to_Company->location }}
                                    <br>Phone: 1 (804) 123-9876
                                    <br>Email: bhml-bettex.com.bd
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 m-auto invoice-col text-left">
                                <b>To</b> 
                                <address>
                                    <strong>ID: {{ $issue_info->emp_id }}</strong>
                                    <br>Name: {{ $issue_info->emp_name }}
                                    <br>Phone Number: {{ $issue_info->phone_number }}
                                    <br>Email: {{ $issue_info->email }}
                                </address>
                            </div>
                            <!-- /.col -->

                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="  table">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Product Type</th>
                                            <th>Product Tag</th>
                                            <th>Model</th>
                                            <th>Serial #</th>
                                            <th style="">Description</th>
                                            <th>Qty</th>
                                            <th>Unit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $stores_info->rel_to_ProductType->product }}</td>
                                            <td>{{ $stores_info->products_id }}</td>
                                            <td>{{ $stores_info->model }}</td>
                                            <td>{{ $stores_info->asset_sl_no }}</td>
                                            <td>{{ $stores_info->description }}</td>
                                            <td>{{ $stores_info->qty }}</td>
                                            <td>{{ $stores_info->rel_to_SizeMaseurment->size }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-md-12">
                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                    In doing so ,I, do infact understand that I am solely resposible for this device
                                    until it is returned to Bettex (HK)Ltd ,IT Department . While under my care ,I
                                    acknowledge that any physical or accidental damage is my fault and I will be
                                    accountable for it. While using this laptop device ,I willl not commit any acts of
                                    cyber crime ,illegal activity,share any company information with unauthorised
                                    users,search or watch any explicit contents ,install any software without IT consent
                                    or lend laptop to friends or family members.I will strictly use this laptop for work
                                    purpose. By signing this document ,I am accepting and agreeing to the terms and use
                                    for this laptop.
                                </p>
                                <p class="lead">Picture:</p>
                                <img src="{{ asset('/uploads/store/') }}/{{ $stores_info->picture }}" id="blah"
                                    alt="" width="200">
                            </div>
                            <!-- /.col -->

                            <!-- /.col -->
                        </div><br>


                        <footer class="" style="margin-top: 150px;">
                            <div class="row ">
                                <div class="col-lg-3 col-sm-4">
                                    <div class="">
                                        <a href="">User Signature</a>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-4 text-center">
                                    <div class="">
                                        <a href="">IT Responsible</a>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-4 text-right">
                                    <div class="">
                                        <a href="">IT Head</a>
                                    </div>
                                </div>
                            </div>
                        </footer>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class=" ">
                                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i>
                                    Print</button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>