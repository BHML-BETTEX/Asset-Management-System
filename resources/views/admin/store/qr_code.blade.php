<!DOCTYPE html>
<html>



<head>
    <title>QR Code</title>
</head>
@push('css_or_js')
    <link rel="stylesheet" href="{{ asset('public/assets/back-end') }}/css/qrcode.css"/>
@endpush


<body>
    <table style="width: 350px; font-size: 10pt; font-family: Arial, sans-serif;" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <img src="data:image/png;base64,{!! base64_encode(QrCode::format('png')->size(80)->generate("https://asset.bettex.com/public/store/qr_code_view/$qrCode->id")) !!}"><br>
                <span style="font-size: 10pt; font-family: Arial, sans-serif; color:#5D6D7E;"><strong>{{$qrCode->products_id}}<br>
            </td>
        </tr>
    </table>
</body>

</html>
