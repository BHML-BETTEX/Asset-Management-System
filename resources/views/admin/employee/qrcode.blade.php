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
                            <td style="font-size: 12pt; font-family: Arial, sans-serif; padding-left: 10px;"> <span style="text-transform:uppercase; font-size: 12pt; font-family: Arial Black; color:#06A5CC;"> {{$employee->emp_name}}</span><br>
                                <span style="font-size: 10pt; font-family: Arial, sans-serif; color:#5D6D7E;"><strong> {{$employee->designation_id}} || {{$employee->department_id}}<br>
                                        <span style="font-size: 10pt; font-family: Arial, sans-serif; color:#5D6D7E;"><strong> {{$employee->phone_number}}<br>
                                                <span style="font-size: 10pt; font-family: Arial, sans-serif; color:#16b0e5"><strong> <a href="https://bettex.com/">BETTEX HK Ltd</a></strong><br></span></strong></span>
                            </td>
                        </tr>
                        <!-- <tr>
              <td style="vertical-align:top;" valign="top">
               <hr>
              </td> 
             </tr>   -->
                        <!-- <tr><td style="font-size: 8pt; line-height:12px; font-family: Arial, sans-serif;  padding-top: 5px; vertical-align:top;" valign="top">
                 <span style="font-size: 8pt; font-family: Arial, sans-serif; color:#7b7b7b">Mobile: %%MobileNumber%%<br></span>
                 <span style="font-size: 8pt; font-family: Arial, sans-serif; color:#7b7b7b;">Email: %%Email%%<br></span>                                                           
                 </td>
              </tr>    -->

                    </tbody>
                </table>

            </td>
        </tr>

    </table>

</body>

</html>