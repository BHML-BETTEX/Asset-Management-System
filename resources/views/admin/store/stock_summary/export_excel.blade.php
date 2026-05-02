<table>
    <thead>
        <tr style="background-color: #495057; color: white; font-weight: bold;">
            <th>Company</th>
            <th>Asset Name</th>
            <th>Total Asset</th>
            <th>Units</th>
            <th>Issue Qty</th>
            <th>Waste Product</th>
            <th>Stock Qty</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $company => $products)
            @foreach($products as $product)
                <tr>
                    <td>{{ $company }}</td>
                    <td>{{ $product->asset_type->product ?? 'N/A' }}</td>
                    <td>{{ $product->TotalAssets ?? 0 }}</td>
                    <td>{{ $product->units->size ?? 'N/A' }}</td>
                    <td>{{ $product->IssueQty ?? 0 }}</td>
                    <td>{{ $product->WastProduct ?? 0 }}</td>
                    <td>{{ $product->StockQty ?? 0 }}</td>
                </tr>
            @endforeach
        @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 10px;">No data available</td>
            </tr>
        @endforelse
    </tbody>
</table>
