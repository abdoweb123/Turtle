<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
</head>
<body style="background-color:#f7f7f7; padding:0; margin:0; text-align:center;">
<div style="margin:0 auto; padding:70px 0; width:100%; max-width:600px;">
    <table border="0" cellpadding="0" cellspacing="0" style="background-color:#fff; border:1px solid #dedede; border-radius:3px; margin:0 auto; padding:0; width:100%;">
        <tr>
            <td align="center" valign="top">
                <table border="0" cellpadding="0" cellspacing="0" style="background-color:#b9a16b; color:#202020; border-bottom:0; font-weight:bold; line-height:100%; vertical-align:middle; font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif; border-radius:3px 3px 0 0; margin:0; padding:36px 48px; display:block; width:100%;">
                    <tr>
                        <td style="margin:0; padding:0; text-align:left; color:#202020; background-color:inherit;">
                            <h1 style="font-size:30px; font-weight:300; line-height:150%; margin:0; text-align:left; color:#202020; background-color:inherit;">Password Reset Request</h1>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">
                <table border="0" cellpadding="0" cellspacing="0" style="background-color:#fff; margin:0 auto; padding:48px 48px 32px; width:100%;">
                    <tr>
                        <td valign="top" style="margin:0; padding:0; text-align:left; color:#636363; font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif; font-size:14px; line-height:150%;">
                            <p style="margin:0 0 16px;">Hi {{$client->name?? $client->email}},</p>
                            <p style="margin:0 0 16px;">Someone has requested a new password for the following account on {{env('APP_NAME')}}:</p>
                            <p style="margin:0 0 16px;">If you didn't make this request, just ignore this email. If you'd like to proceed:</p>
                            <p style="margin:0 0 16px;">
                                <a href="{{ route('Client.showResetForm',[$token,$client->email]) }}">Click here to reset your password</a>
                            </p>
                            <p style="margin:0 0 16px;">Thanks for reading.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">
                <table border="0" cellpadding="10" cellspacing="0" style="border-radius:6px; margin:0 auto; padding:0; width:100%;">
                    <tr>
                        <td valign="top" style="border-radius:6px; border:0; color:#8a8a8a; font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif; font-size:12px; line-height:150%; text-align:center; padding:24px 0;">
                            <p style="margin:0 0 16px;">© 2024 {{env('APP_NAME')}}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
