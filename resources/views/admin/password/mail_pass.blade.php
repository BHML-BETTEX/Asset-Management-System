@extends('master')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left p-1">
                <h4 class="text-white">Mail password List</h4>
            </div>
            <div class="title_right">
                <div class="">
                    <div class= "col-md-6">
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalForm1">
                            Add
                        </button>
                    </div>
                    <div class= "col-md-6 top_search">
                        <form action="" method="GET">
                            <div class="input-group">
                                <input type="search" class="form-control" name="search" placeholder="Search for..."
                                    value={{ $search }}>
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="submit">Go!</button>
                                </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!--First Model-->
    <div class="modal fade" id="modalForm1" tabindex="-1" aria-labelledby="modalForm1Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalForm1Label">Add Info</h5>
                    <button type="button" class="btn-close btn-border-none" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('mail_pass_store') }}" Method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Display Name</label>
                            <input class="form-control" name="display_name" required></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Mail Address</label>
                            <input class="form-control" type="mail" name="mail_address" required></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Password</label>
                            <input class="form-control" type="password" name="password" required></input>
                        </div>
                        <div class="form-group">
                            <label for="form_label">Company </span><a class="text-success" href=""><i
                                        class="fa fa-plus" style="font-size:10px;"></a></i></label>
                            <select id="form_need" name="company" class="form-control" required>
                                <option value="" selected disabled>--Select Your
                                    Issue--</option>
                                @foreach ($all_company as $all_company)
                                    <option value="{{ $all_company->company }}">
                                        {{ $all_company->company }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Note</label>
                            <input class="form-control" type="note" name="others"></input>
                        </div>
                        <button class="btn btn-primary">Submit</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--First Modal end-->

    <!--display form start-->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @if (session('delete_mail'))
                    <div class="alert alert-success">{{ session('delete_mail') }}</div>
                @endif
                <div class="card-body">
                    <table class="table table-striped table table-bordered ">
                        <thead class="bg-info text-white">
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Display Name</th>
                                <th scope="col">Mail Address</th>
                                <th scope="col">Password</th>
                                <th scope="col">Company</th>
                                <th scope="col">Note</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <thead>
                            @foreach ($Mail_pass as $key => $Mail_pass)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $Mail_pass->display_name }}</td>
                                    <td>{{ $Mail_pass->mail_address }}</td>
                                    <td>{{ $Mail_pass->password }}</td>
                                    <td>{{ $Mail_pass->company }}</td>
                                    <td>{{ $Mail_pass->others }}</td>
                                    <td>
                                        <button class="border-0  bg-white"><a class="text-primary"
                                            href="{{ route('mail_pass_edit', $Mail_pass->id) }}"><i
                                                class="fa fa-edit " style="font-size:20px;"></a></i></button>
                                        <button class="border-0  bg-white"><a class="text-danger"
                                                href="{{ route('mail_pass_delete', $Mail_pass->id) }}"><i
                                                    class="fa fa-trash " style="font-size:20px;"></a></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Ajax code -->
@endsection
