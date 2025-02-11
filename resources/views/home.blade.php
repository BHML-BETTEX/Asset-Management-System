@extends('master')

@section('content')
    </div>
    <div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row" style="display: inline-block;">
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
                            <h3>Network Activities <small>Graph title sub-title</small></h3>
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

        <div class="row">


            <div class="col-md-4 col-sm-4 ">
                <div class="x_panel tile fixed_height_320">
                    <div class="x_title">
                        <h2>BETTEX HK Ltd</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                        <h4>Asset Details</h4>
                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>Total Assets</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>{{ DB::table('stores')->where('company', 2)->count() }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>Total Laptop</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                                        <span class="sr-only"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>{{ DB::table('stores')->where('company', 2)->where('asset_type', 1)->count() }}
                                </span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>Total Desktop</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>{{ DB::table('stores')->where('company', 2)->where('asset_type', 2)->count() }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>Total Printer</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>{{ DB::table('stores')->where('company', 2)->where('asset_type', 3)->count() }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 ">
                <div class="x_panel tile fixed_height_320">
                    <div class="x_title">
                        <h2>BHML Industries Ltd</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                        <h4>Asset Details</h4>
                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>Total Assets</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>{{ DB::table('stores')->where('company', 1)->count() }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>Total Laptop</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                                        <span class="sr-only"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>{{ DB::table('stores')->where('company', 1)->where('asset_type', 1)->count() }}
                                </span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>Total Desktop</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>{{ DB::table('stores')->where('company', 1)->where('asset_type', 2)->count() }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>Total Printer</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>{{ DB::table('stores')->where('company', 1)->where('asset_type', 3)->count() }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4 col-sm-4 ">
                <div class="x_panel tile fixed_height_320">
                    <div class="x_title">
                        <h2>BETTEX PREMIUM</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                        <h4>Asset Details</h4>
                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>Total Assets</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>{{ DB::table('stores')->where('company', 3)->count() }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>Total Laptop</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                                        <span class="sr-only"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>{{ DB::table('stores')->where('company', 3)->where('asset_type', 1)->count() }}
                                </span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>Total Desktop</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>{{ DB::table('stores')->where('company', 3)->where('asset_type', 2)->count() }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>Total Printer</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>{{ DB::table('stores')->where('company', 3)->where('asset_type', 3)->count() }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($stores as $key => $store)
  
            <div class="container">
                <div class="col">
                    <div class="col-md-4 col-sm-4">
                        <h2>Basic Table</h2>
                        <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>John</td>
                                    <td>Doe</td>
                                    <td>john@example.com</td>
                                </tr>
                                <tr>
                                    <td>Mary</td>
                                    <td>Moe</td>
                                    <td>mary@example.com</td>
                                </tr>
                                <tr>
                                    <td>July</td>
                                    <td>Dooley</td>
                                    <td>july@example.com</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </div>

            @endforeach


            {{-- <div class="row">
            <div class="col-md-4 col-sm-4 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Recent Activities <small>Sessions</small></h2>
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
                  <div class="dashboard-widget-content">

                    <ul class="list-unstyled timeline widget">
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-md-8 col-sm-8 ">



              <div class="row">

                <div class="col-md-12 col-sm-12 ">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Visitors location <small>geo-presentation</small></h2>
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
                      <div class="dashboard-widget-content">
                        <div class="col-md-4 hidden-small">
                          <h2 class="line_30">125.7k Views from 60 countries</h2>

                          <table class="countries_list">
                            <tbody>
                              <tr>
                                <td>United States</td>
                                <td class="fs15 fw700 text-right">33%</td>
                              </tr>
                              <tr>
                                <td>France</td>
                                <td class="fs15 fw700 text-right">27%</td>
                              </tr>
                              <tr>
                                <td>Germany</td>
                                <td class="fs15 fw700 text-right">16%</td>
                              </tr>
                              <tr>
                                <td>Spain</td>
                                <td class="fs15 fw700 text-right">11%</td>
                              </tr>
                              <tr>
                                <td>Britain</td>
                                <td class="fs15 fw700 text-right">10%</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div id="world-map-gdp" class="col-md-8 col-sm-12 " style="height:230px;"></div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <div class="row">


                <!-- Start to do list -->
                <div class="col-md-6 col-sm-6 ">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>To Do List <small>Sample tasks</small></h2>
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

                      <div class="">
                        <ul class="to_do">
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Schedule meeting with new client </p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Create email address for new intern</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Create email address for new intern</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End to do list -->
                
                <!-- start of weather widget -->
                <div class="col-md-6 col-sm-6 ">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Daily active users <small>Sessions</small></h2>
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
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="temperature"><b>Monday</b>, 07:30 AM
                            <span>F</span>
                            <span><b>C</b></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="weather-icon">
                            <canvas height="84" width="84" id="partly-cloudy-day"></canvas>
                          </div>
                        </div>
                        <div class="col-sm-8">
                          <div class="weather-text">
                            <h2>Texas <br><i>Partly Cloudy Day</i></h2>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="weather-text pull-right">
                          <h3 class="degrees">23</h3>
                        </div>
                      </div>

                      <div class="clearfix"></div>

                      <div class="row weather-days">
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Mon</h2>
                            <h3 class="degrees">25</h3>
                            <canvas id="clear-day" width="32" height="32"></canvas>
                            <h5>15 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Tue</h2>
                            <h3 class="degrees">25</h3>
                            <canvas height="32" width="32" id="rain"></canvas>
                            <h5>12 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Wed</h2>
                            <h3 class="degrees">27</h3>
                            <canvas height="32" width="32" id="snow"></canvas>
                            <h5>14 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Thu</h2>
                            <h3 class="degrees">28</h3>
                            <canvas height="32" width="32" id="sleet"></canvas>
                            <h5>15 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Fri</h2>
                            <h3 class="degrees">28</h3>
                            <canvas height="32" width="32" id="wind"></canvas>
                            <h5>11 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Sat</h2>
                            <h3 class="degrees">26</h3>
                            <canvas height="32" width="32" id="cloudy"></canvas>
                            <h5>10 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- end of weather widget -->
              </div>
            </div>
          </div> --}}
        </div>
        <!-- /page content -->
    </div>
@endsection
