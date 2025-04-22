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

        @media print {
            @page {
                size: 2in 3in;
                margin: 0;
            }

            body {
                margin: 0;
                padding: 0;
            }

            .print-button {
                display: none;
            }

            #print-area {
                width: 2in;
                height: 3in;
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
            }

            table {
                width: 100%;
                height: 100%;
            }

            img {
                width: 80px;
                height: 80px;
            }
        }
    </style>
</head>

<body>
    <button class="print-button" onclick="printQRCode()">Print QR Code</button>

    <div id="print-area">
        <table cellpadding="0" cellspacing="0">
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
            window.print();
        }
    </script>
</body>
</html>
