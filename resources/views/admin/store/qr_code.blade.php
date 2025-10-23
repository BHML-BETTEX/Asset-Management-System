<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>QR Code</title>

    @push('css_or_js')
    <link rel="stylesheet" href="{{ asset('public/assets/back-end/css/qrcode.css') }}" />
    @endpush

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 9pt;
            text-align: center;
        }

        .print-button {
            margin: 10px;
            padding: 6px 18px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 10pt;
        }

        .print-button:hover {
            background-color: #0056b3;
        }

        /* PRINT STYLES */
        @media print {
            @page {
                size: 1in 1.5in;
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
                width: 1in;
                height: 1.5in;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
                margin: auto;
            }

            img {
                display: block;
                width: 0.9in;
                height: 0.9in;
                object-fit: contain;
                margin-bottom: 4px;
            }

            samp {
                font-size: 8pt;
                font-weight: bold;
                display: block;
            }
        }
    </style>
</head>

<body>
    <button class="print-button" onclick="printQRCode()">🖨️ Print QR Code</button>

    <div id="print-area">
        <img
            src="data:image/png;base64,{{ base64_encode(
                QrCode::format('png')
                    ->size(600)          // High pixel size for print (300 DPI+)
                    ->margin(0)          // No white borders
                    ->errorCorrection('H') // Highest error correction for durability
                    ->generate('https://asset.bettex.com/public/store/qr_code_view/' . $qrCode->id)
            ) }}"
            alt="QR Code">
        <samp>{{ $qrCode->asset_tag }}</samp>
    </div>

    <script>
        function printQRCode() {
            window.print();
        }
    </script>
</body>
</html>
