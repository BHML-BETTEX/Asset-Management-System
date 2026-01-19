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
                size: 1.5in 2rem;
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
                width: 1.5in;
                height: 2in;
                margin: auto;
                display: flex;
                margin-bottom: 1px;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
                box-sizing: border-box;
            }


            table {
                width: 100%;
                height: 100%;
                border-collapse: collapse;
            }

            img {
                display: block;
                width: 80px;
                height: 80px;
                margin: auto;
            }
        }
    </style>
</head>

<body>
    <button class="print-button" onclick="printQRCode()">Print QR Code</button>

    <div id="print-area">
        <table>
            <tr>
                <td align="center">
                    <img
                        src="data:image/png;base64,{{ base64_encode(
            QrCode::format('png')
                ->size(180)        // Higher resolution
                ->margin(0)        // Remove extra padding
                ->generate('https://asset.bettex.com/public/store/qr_code_view/' . $qrCode->id)
        ) }}"
                        alt="QR Code"
                        style="display: block; width: 75px; height: 75px; margin: auto;">
                    <samp>{{ $qrCode->asset_tag }}</samp>
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