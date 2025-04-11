<!DOCTYPE html>
<html>
<head>
    <title>QR Code</title>
    @push('css_or_js')
        <link rel="stylesheet" href="{{ asset('public/assets/back-end') }}/css/qrcode.css"/>
    @endpush

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
        }

        .print-button {
            margin-bottom: 10px;
            padding: 5px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .print-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <button class="print-button" onclick="printQRCode()">Print QR Code</button>

    <div id="print-area">
        <table style="width: 350px;" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <img src="data:image/png;base64,{!! base64_encode(QrCode::format('png')->size(80)->generate("https://asset.bettex.com/public/store/qr_code_view/$qrCode->id")) !!}"><br>
                    <span style="color:#5D6D7E;"><strong>{{ $qrCode->products_id }}</strong></span>
                </td>
            </tr>
        </table>
    </div>

    <script>
        function printQRCode() {
            let printContents = document.getElementById('print-area').innerHTML;
            let originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload(); // Optional: refresh after print to restore event bindings
        }
    </script>
</body>
</html>
