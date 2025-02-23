@extends('master')

@section('content')
    </div>
    <div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row" style="display: inline-block;">
            <h4>Centralize Details</h4>
            <div class="tile_count">
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
                    <div class="count">{{ DB::table('users')->count() }}</div>
                    <span class="count_bottom"><i class="green"></i> Total Active Users</span>
                </div>
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-clock-o"></i> Total Employee</span>
                    <div class="count">{{ DB::table('employees')->count() }}</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> Asset User</span>
                </div>
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Assets</span>
                    <div class="count green">{{ DB::table('stores')->count() }}</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> Total IT Assets</span>
                </div>
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Laptop</span>
                    <div class="count">{{ DB::table('stores')->where('asset_type', 1)->count() }}</div>
                    <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i></i> Number Of Laptop</span>
                </div>
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Desktop</span>
                    <div class="count">{{ DB::table('stores')->where('asset_type', 2)->count() }}</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> Number Of Desktop</span>
                </div>
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Printer</span>
                    <div class="count">{{ DB::table('stores')->where('asset_type', 3)->count() }}</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> Number Of Printer</span>
                </div>
                
            </div>
        </div>
        <!-- /top tiles -->

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="dashboard_graph">

                    <div class="row x_title">
                        <div class="col-md-6">
                            <h3>Transition Details <small>Graph title sub-title</small></h3>
                        </div>
                        <div class="col-md-6">
                            <div id="reportrange" class="pull-right"
                                style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9 col-sm-9 ">
                        <div id="chart_plot_01" class="demo-placeholder"></div>
                    </div>
                    <div class="col-md-3 col-sm-3  bg-white">
                        <div class="x_title">
                            <h2>Top Campaign Performance</h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="col-md-12 col-sm-12 ">
                            <div>
                                <p>Facebook Campaign</p>
                                <div class="">
                                    <div class="progress progress_sm" style="width: 76%;">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>Twitter Campaign</p>
                                <div class="">
                                    <div class="progress progress_sm" style="width: 76%;">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 ">
                            <div>
                                <p>Conventional Media</p>
                                <div class="">
                                    <div class="progress progress_sm" style="width: 76%;">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>Bill boards</p>
                                <div class="">
                                    <div class="progress progress_sm" style="width: 76%;">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
        <br />


        <!-- BETTEX HK product summary start -->
        <div class="container">
            <div class="col">
                <div class="col-md-4 col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            <h2>BETTEX HK LTD.</h2>
                        </div>
                        <div class="card-body">
                            <table class="table  table-bordered ">
                                <thead class="bg-info text-white">
                                    <tr>
                                        <th>Asset Name</th>
                                        <th>Total Asset</th>
                                        <th>Units</th>
                                        <th>Issue Qty</th>
                                        <th>Stock Qty</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product_summary_bt as $product_summary)
                                        <tr>
                                            <td>{{ $product_summary->asset_type->product }}</td>
                                            <td>{{ $product_summary->TotalAssets }}</td>
                                            <td>{{ $product_summary->units->size }}</td>
                                            <td>{{ $product_summary->IssueQty }}</td>
                                            <td>{{ $product_summary->StockQty }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            <h2>BHML INDUSTRIES LTD.</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="bg-info text-white">
                                    <tr>
                                        <th>Asset Name</th>
                                        <th>Total Asset</th>
                                        <th>Units</th>
                                        <th>Issue Qty</th>
                                        <th>Stock Qty</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product_summary_bhml as $product_summary_bhml)
                                        <tr>
                                            <td>{{ $product_summary_bhml->asset_type->product }}</td>
                                            <td>{{ $product_summary_bhml->TotalAssets }}</td>
                                            <td>{{ $product_summary_bhml->units->size }}</td>
                                            <td>{{ $product_summary_bhml->IssueQty }}</td>
                                            <td>{{ $product_summary_bhml->StockQty }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            <h2>BETTEX PREMIUM</h2>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="bg-info text-white">
                                    <tr>
                                        <th>Asset Name</th>
                                        <th>Total Asset</th>
                                        <th>Units</th>
                                        <th>Issue Qty</th>
                                        <th>Stock Qty</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product_summary_bp as $product_summary_bp)
                                        <tr>
                                            <td>{{ $product_summary_bp->asset_type->product }}</td>
                                            <td>{{ $product_summary_bp->TotalAssets }}</td>
                                            <td>{{ $product_summary_bp->units->size }}</td>
                                            <td>{{ $product_summary_bp->IssueQty }}</td>
                                            <td>{{ $product_summary_bp->StockQty }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BETTEX HK product summary end -->

        <!-- BHML product summary start -->

        <!-- BHML HK product summary end -->

    </div>
@endsection
