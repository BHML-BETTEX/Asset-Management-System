<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Handover Form</title>
    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;

        }

        h1 {
            margin: 0;
            padding: 20px;
            text-align: center;
            background-color: #078dd2;
            color: white;
            font-size: 24px;
        }

        .content {
            text-align: right;
            padding-right: 20px;
            margin-bottom: 10px;
        }

        .content p {
            font-size: 16px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #6bccfe;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        tr:hover {
            background-color: #ddd;
        }

        .footer {
            width: 100%;
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-top: 1px solid #ddd;
        }

        .footer p {
            color: #555;
            font-size: 14px;
            line-height: 1.6;
            text-align: justify;
        }

        .signature-block {
            margin-top: 40px;
            text-align: center;
        }

        .signature-line {
            width: 250px;
            height: 1px;
            border-bottom: 1px solid #000;
            margin: 20px auto;
        }

        .signature-label {
            font-weight: bold;
            margin-top: 10px;
        }

        .printed-info {
            font-size: 12px;
            color: #666;
            text-align: center;
            margin-top: 40px;
        }

        .title,
        .employee-info,
        .asset-info {
            margin: 10px 20px;
        }

        .employee-info b,
        .asset-info b {
            font-size: 14px;
        }

        hr {
            margin: 30px 0;
            border: none;
            border-top: 1px solid #ccc;
        }

        @media print {
            body {
                background-color: #fff;
            }

            .footer {
                position: absolute;
                bottom: 0;
                page-break-before: always;
            }

            table {
                page-break-before: always;
            }

            .signature-line {
                page-break-after: always;
                text-align: left;
            }
        }
    </style>
</head>

<body>

    <!-- Title and Date Section -->
    <div class="title" style="text-align: center;">
        <img style="margin: auto; height: 100px; width: 600px;" src="uploads/bettex_logo.jpeg" alt="Bettex Logo">
        <p></p>
    </div>

    <!-- Employee Info Section -->
    <div class="employee-info">
        <p><b>Employee Information</b></p>
        <table>
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Employee ID</th>
                    <th>Designation</th>
                    <th>Department</th>
                    <th>Phone No</th>
                    <th>Email</th>
                    <th>Organization</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $employee->emp_name ?? 'N/A' }}</td>
                    <td>{{ $employee->emp_id ?? 'N/A' }}</td>
                    <td>{{ $employee->rel_to_designation->designation ?? 'N/A' }}</td>
                    <td>{{ $employee->rel_to_departmet->department ?? 'N/A' }}</td>
                    <td>{{ $employee->phone_number ?? 'N/A' }}</td>
                    <td>{{ $employee->email ?? 'N/A' }}</td>
                    <td>{{ $employee->rel_to_companies->name ?? 'N/A' }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Asset Info Section -->
    <div class="asset-info">
        <p><b>Asset Information</b></p>
        <table>
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
                @forelse($issue_info as $issue)
                @php
                    $store = $store_info->firstWhere('asset_tag', $issue->asset_tag);
                @endphp
                <tr>
                    <td>{{ $issue->asset_tag }}</td>
                    <td>{{ $issue->asset_type }}</td>
                    <td>{{ $issue->model }}</td>
                    <td>{{ $store->asset_sl_no ?? 'N/A' }}</td>
                    <td>{{ $store->description ?? 'N/A' }}</td>
                    <td>{{ $issue->issue_date }}</td>
                    <td>{{ $issue->return_date }}</td>
                    <td>{{ $store->qty ?? 'N/A' }}</td>
                    <td>pcs</td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align: center;">No assets found for this employee</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <h4><strong><b>Please read carefully before proceeding:</b></strong></h4>
        <p>
            By accepting this device, I understand that I am solely responsible for it until it is returned to Bettex (HK) Ltd, IT Department. I acknowledge that any physical or accidental damage during my possession is my responsibility, and I will be held accountable.
            <br><br>
            While using this laptop, I agree not to commit any acts of cybercrime or illegal activity, share company information with unauthorized users, view explicit content, install unauthorized software without IT consent, or lend the laptop to others. I understand that this device is strictly for work purposes only.
            <br><br>
            By signing this document, I accept and agree to all the terms of use for this device.
        </p>

        <div class="signature-block">
            <p class="signature-label">User Signature:</p>
        </div>
        <hr>

        <p class="printed-info">
            Printed by: {{ Auth::user()->name }} / Print Date: {{ $date }}/ BETTEX Asset Managment System
        </p>
    </div>

</body>

</html>