<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }



        .fixed_footer {
            width: 100%;
            height: 350px;
            background: white;
            position: fixed;
            left: 0;
            bottom: 0;
            z-index: -100;
        }

        .fixed_footer p {
            color: #696969;
            column-count: 2;
            column-gap: 50px;
            font-size: 1em;
            font-weight: 300;
            text-align-last: center;
            border: 1px solid black;
        }

        #employee {
            font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #employee td,
        #employee th {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
        }

        
        #employee tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #employee tr:hover {
            background-color: #ddd;
        }

        #employee th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #bf8df5;
            color: white;
        }
    </style>
</head>

<body>

    <div class="title" style="text-align:center;">
        <h1>{{ $title }}</h1>
        <p>{{ $content }}</p>
    </div>
    <div class="content">
        <p>Date: {{ $date }}</p>
    </div>

    
        <!-- Emoloyee info -->
        <p>Employee Information</p>
        <table id="employee">
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Employee ID</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Phone No</th>
                <th>Mail</th>
                <th>Organization</th>
            </tr>
        </thead>

        <tbody>
         @foreach($employee_info as $key => $employee_infos)
            <tr>
                <td>{{ $employee_infos->emp_name }}</td>
                <td>{{ $employee_infos->emp_id }}</td>
                <td>{{ $employee_infos->designation_id }}</td>
                <td>{{ $employee_infos->department_id }}</td>
                <td>{{ $employee_infos->phone_number }}</td>
                <td>{{ $employee_infos->email }}</td>
                <td>{{ $employee_infos->others }}</td>

            </tr>
            @endforeach
        </tbody>

       
    </table>

        <!-- product info -->
    </div>
    <br>

    <p>Asset Information</p>
    <table id="customers">
        <thead>
            <tr>
                <th>Asset Tag</th>
                <th>Asset Type</th>
                <th>Model</th>
                <th>Asset SL No</th>
                <th>Description</th>
                <th>Issue Date</th>
                <th>Return Date</th>
                <th>Qty</th>
                <th>Units</th>
            </tr>
        </thead>

        <tbody>
            @foreach($issue_info as $key => $issue_info)
            <tr>
                <td>{{ $issue_info->asset_tag }}</td>
                <td>{{ $issue_info->asset_type }}</td>
                <td>{{ $issue_info->model }}</td>
                <td>{{ isset($store_info[$key]) ? $store_info[$key]->asset_sl_no : 'N/A' }}</td>
                <td>{{ isset($store_info[$key]) ? $store_info[$key]->description : 'N/A' }}</td>
                <td>{{ $issue_info->issue_date }}</td>
                <td>{{ $issue_info->return_date }}</td>
                <td>{{ isset($store_info[$key]) ? $store_info[$key]->qty : 'N/A' }}</td>
                <td>{{ 'pcs' }}</td>
            </tr>

            <!-- <p class="lead">Picture:</p>
            <img src="{{ asset('/uploads/store/') }}/{{ isset($store_info[$key]) ? $store_info[$key]->picture : 'N/A'}}" id="blah"
                alt="" width="200"> -->
            @endforeach
        </tbody>
    </table>


    <footer class="fixed_footer">
        <div class="content">
            <p>Please read carefully before proceeding.</p>
            <p class="" style="margin-top: 10px;">
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
        </div>
    </footer>
</body>

</html>