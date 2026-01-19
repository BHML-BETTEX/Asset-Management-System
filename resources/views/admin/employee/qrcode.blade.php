<!DOCTYPE html>
<html>

<head>
    <title>QR Code</title>
</head>

<body>
    <p>Thanks and Best Regards,</p>
    <table style="width: 350px; font-size: 10pt; font-family: Arial, sans-serif;" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate('https://asset.bettex.com/employee/view/' . $employee->emp_id)
                    ) !!}"
                    alt="QR Code">
            </td>
            <td>
                <table style="width: 350px; font-size: 10pt; font-family: Arial, sans-serif;" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td style="font-size: 12pt; font-family: Arial, sans-serif; padding-left: 10px;"> <strong> <span style="text-transform:uppercase; font-size: 12pt; font-family: Arial Black; color:#06A5CC;"> {{$employee->emp_name}}</span><br>
                                <p style="font-size: 10pt; font-family: Arial, sans-serif; color:#5D6D7E;">{{$employee->rel_to_designation->designation_name}} || {{$employee->rel_to_departmet->department_name}}</p><br>
                                        <p style="font-size: 10pt; font-family: Arial, sans-serif; color:#5D6D7E;">{{$employee->phone_number}}</p><br>
                                                <span style="font-size: 10pt; font-family: Arial, sans-serif; color:#16b0e5">
                                                    <strong>
                                                        @if($employee->company == 1)
                                                        <a href="https://bettex.com/">BETTEX INDUSTRIES LTD.</a>
                                                        @elseif($employee->company == 2)
                                                        <a href="https://bettex.com/">BETTEX HK LTD</a>
                                                        @elseif($employee->company == 3)
                                                        <a href="https://bettex.com/">BETTEX INDUSTRIES LTD.</a>
                                                        @elseif($employee->company == 4)
                                                        <a href="https://bettex.com/">UNIONTEX INDIA</a>
                                                        @else
                                                        <a href="https://bettex.com/">BETTEX HK LTD</a>
                                                        @endif
                                                    </strong>
                                                    <br>
                                                </span>
                            </td>
                        </tr>

                    </tbody>
                </table>

            </td>
        </tr>

    </table>

</body>

</html>