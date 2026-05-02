<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Stock Summary Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            color: #666;
            font-size: 12px;
        }
        .company-section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }
        .company-title {
            background-color: #495057;
            color: white;
            padding: 10px 15px;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
        }
        thead {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }
        th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #dee2e6;
            background-color: #f8f9fa;
        }
        td {
            padding: 10px 12px;
            border: 1px solid #dee2e6;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tbody tr:hover {
            background-color: #f0f0f0;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Asset Stock Summary Report</h1>
        <p>Generated on {{ date('Y-m-d H:i:s') }}</p>
    </div>

    @forelse($data as $company => $products)
        <div class="company-section">
            <div class="company-title">{{ $company }}</div>
            <table>
                <thead>
                    <tr style="background-color: #495057; color: white;">
                        <th>Asset Name</th>
                        <th class="text-center">Total Asset</th>
                        <th class="text-center">Units</th>
                        <th class="text-center">Issue Qty</th>
                        <th class="text-center">Waste Product</th>
                        <th class="text-center">Stock Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total_assets = 0; @endphp
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->asset_type->product ?? 'N/A' }}</td>
                            <td class="text-center">{{ $product->TotalAssets ?? 0 }}</td>
                            <td class="text-center">{{ $product->units->size ?? 'N/A' }}</td>
                            <td class="text-center">{{ $product->IssueQty ?? 0 }}</td>
                            <td class="text-center">{{ $product->WastProduct ?? 0 }}</td>
                            <td class="text-center">{{ $product->StockQty ?? 0 }}</td>
                        </tr>
                        @php $total_assets += $product->TotalAssets ?? 0; @endphp
                    @endforeach
                    <tr style="background-color: #f0f0f0; font-weight: bold;">
                        <td>Total</td>
                        <td class="text-center">{{ $total_assets }}</td>
                        <td colspan="4"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    @empty
        <div class="no-data">
            <p>No data available to display.</p>
        </div>
    @endforelse

    <div class="footer">
        <p>This is an automated report. For inquiries, please contact the IT department.</p>
    </div>
</body>
</html>
