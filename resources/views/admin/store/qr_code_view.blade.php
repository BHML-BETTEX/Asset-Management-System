<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta property="og:image" itemprop="image" content="../assets/uploads/card-profile/1627534264-waptechy-card-profile.jpg" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">



    <link rel="shortcut icon" href="../assets/uploads/card-profile/1627534264-waptechy-card-profile.jpg">

    <!--Bootstrap style sheet-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!--Font Awsome style sheet-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Asset Managment</title>
</head>

<body>


    <!-- Background image -->
    <!-- <div class="bg-image d-flex justify-content-center align-items-center img-fluid Responsive image"
  style="
    background-image: url('assets/uploads/BACKGROUND.jpg');
    height: auto;
  "> -->

    <!-- Background image -->


    <div class="container ">


        <!--Thumbnil start-->
        <div class="row">
            <div class="col-lg-6 col-sm-12 mx-auto">
                <section style="background-color: #9de2ff;">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 ">
                                            <img src="{{ asset('/uploads/store/') }}/{{ $stores_info->picture }}"
                                                alt="Generic placeholder image" class="img-fluid "
                                                style="width: 180px; border-radius: 10px;" />
                                        </div>
                                        <div class="flex-grow-1 p-5 m-auto">
                                            <h3>Product Type</h3>
                                            <h1 class="mb-1"><strong>{{$stores_info->rel_to_ProductType->product}}</strong></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <!--Thumbnil end-->


        <!--Contact start-->
        <div class="row">
            <div class="col-lg-6 col-sm-12 mx-auto">
                <div class="card">
                    <div class="card-header text-white" style="background-color:#337ca6 ;">
                        <h3>Product Details</h3>
                    </div>
                    <div class="card-body" style="background-color:#DDEAFC ;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>Product Tag: {{ $stores_info->products_id }}</h4>
                            </div>
                            <div class="panel-body">
                                <h4>Model: {{ $stores_info->model }}</h4>
                            </div>
                            <div class="panel-heading">
                                <h4>Serial #: {{ $stores_info->asset_sl_no }}</h4>
                            </div>
                            <div class="panel-body">
                                <h4>Description: {{ $stores_info->description }}</h4>
                            </div>
                        </div>
                        <!-- /.col -->
                        <h3>Vendor: <strong>{{ $stores_info->rel_to_Supplier->supplier_name }}</strong></h3>
                        <h3>Purchase Date: <strong>{{ $stores_info->purchase_date }}</strong></h3>
                        <h3>Warrenty Validation: <strong>{{ $stores_info->warrenty }} {{ $stores_info->durablity }}</strong></h3>
                        <h1 class="text-success">Product By: <strong>{{ $stores_info->rel_to_Company->company }}</strong></h1>
                    </div>

                    <div>
                        <div class="card-header text-white" style="background-color:#337ca6 ;">
                            <h3>User Details</h3>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>Employee Id: {{ $issue_info->emp_id }}</h4>
                            </div>
                            <div class="panel-body">
                                <h4>User Name: {{ $issue_info->emp_name }}</h4>
                            </div>
                            <div class="panel-heading">
                                <h4>Designation: {{ $issue_info->designation_id }}</h4>
                            </div>
                            <div class="panel-body">
                                <h4>Issue Date: {{ $issue_info->issue_date }}</h4>
                            </div>
                        </div>
                    </div>
                    <!--Contact end-->
                    <footer>
                        <div class="card-header text-white" style="background-color:#337ca6 ;">
                            <h6 class="text-center">Powered By: Asset Managment System</h6>
                        </div>
                    </footer>

                    <!--QR Code Start-->
                    <!--QR Code end-->

                </div>


            </div>

            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>