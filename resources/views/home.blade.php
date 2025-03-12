@extends('master')

@section('content')
    </div>
    <div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row" style="display: inline;">
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
                    <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i></i> Number Of Laptop (pcs)</span>
                </div>
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Desktop</span>
                    <div class="count">{{ DB::table('stores')->where('asset_type', 2)->count() }}</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> Number Of Desktop (pcs)</span>
                </div>
                <div class="col-md-1 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Printer</span>
                    <div class="count">{{ DB::table('stores')->where('asset_type', 3)->count() }}</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> Number Of Printer (pcs)</span>
                </div>

                <div class="col-md-1 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Others Asset</span>
                    <div class="count">{{ DB::table('stores')->whereNotIn('asset_type', [1, 2, 3])->count(); }}</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> Number Of Asset (pcs)</span>
                </div>

            </div>
        </div>
        <!-- /top tiles -->

        <div class="row">
            <div class="col-md-8 col-sm-12 ">
                <div class="dashboard_graph">

                    <div class="row x_title">
                        <div class="col-md-6">
                            <h3>Transition Details</h3>
                        </div>
                        <div class="col-md-6">
                            <div id="reportrange" class="pull-right"
                                style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 ">
                        <div id="chart_plot_01" class="demo-placeholder"></div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
<div class="col-md-4 col-sm-4 ">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Device Usage</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">Settings 1</a>
                          <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>Top 5</p>
                      </th>
                      <th>
                        <div class="col-lg-7 col-md-7 col-sm-7 ">
                          <p class="">Device</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 ">
                          <p class="">Progress</p>
                        </div>
                      </th>
                    </tr>
                    <tr>
                      <td>
                        <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>Laptop </p>
                            </td>
                            <td>95%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Desktop </p>
                            </td>
                            <td>98%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Printer </p>
                            </td>
                            <td>100%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Scanner </p>
                            </td>
                            <td>100%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Others </p>
                            </td>
                            <td>95%</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
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
