@extends('master')

@section('content')

<div class="container">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">

                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="  invoice-header">
                          <h3>
                            <i class="fa fa-globe"></i> Acknowledgement Form.
                          </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          From
                          <address>
                            <strong>{{$stores_info->rel_to_Company->company}}</strong>
                            <br>Kamarjuri, Natun Bazar
                            <br>Gazipur
                            <br>Phone: 1 (804) 123-9876
                            <br>Email: bhml-bettex.com.bd
                        </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          To
                          <address>
                            <strong>John Doe</strong>
                            <br>795 Freedom Ave, Suite 600
                            <br>New York, CA 94107
                            <br>Phone: 1 (804) 123-9876
                            <br>Email: jon@ironadmin.com
                          </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b>Invoice #007612</b>
                          <br>
                          <br>
                          <b>Order ID:</b> 4F3S8J
                          <br>
                          <b>Payment Due:</b> 2/22/2014
                          <br>
                          <b>Account:</b> 968-34567
                        </div>
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
                                <td>{{$stores_info->rel_to_ProductType->product}}</td>
                                <td>{{$stores_info->products_id}}</td>
                                <td>{{$stores_info->model}}</td>
                                <td>{{$stores_info->asset_sl_no}}</td>
                                <td>{{$stores_info->description}}</td>
                                <td>{{$stores_info->qty}}</td>
                                <td>{{$stores_info->rel_to_SizeMaseurment->size}}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-md-6">
                          <p class="lead">Acknowledgement:</p>
                          <img src="{{asset('/uploads/store/')}}/{{$stores_info->picture}}" id="blah" alt="" width="200">

                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                          In doing so ,I, do infact  understand that I am solely resposible for this device until it is returned to Bettex (HK)Ltd ,IT Department .                                                                                While under my care ,I acknowledge that any physical or accidental damage is my fault and I will be accountable for it. While using this laptop device ,I willl not commit any acts of cyber crime ,illegal activity,share any company information with unauthorised users,search or watch any explicit contents ,install any software without IT consent or lend laptop to friends or family members.I will strictly use this laptop for work purpose.                                                                                                         By signing this document ,I am accepting and agreeing to the terms and use for this laptop.
                          </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                          <p class="lead">Amount Due 2/22/2014</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Subtotal:</th>
                                  <td>$250.30</td>
                                </tr>
                                <tr>
                                  <th>Tax (9.3%)</th>
                                  <td>$10.34</td>
                                </tr>
                                <tr>
                                  <th>Shipping:</th>
                                  <td>$5.80</td>
                                </tr>
                                <tr>
                                  <th>Total:</th>
                                  <td>$265.24</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class=" ">
                          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                          <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

      </div>
    </div>
    </div>


    @endsection
