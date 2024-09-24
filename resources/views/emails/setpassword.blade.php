
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Set Your Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        /* General email styles */
        body, table, td, a {
            text-size-adjust: 100%;
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse !important;
        }
        img {
            border: 0;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }
        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }
        /* More styles for email content */
        .email-container {
            padding: 40px;
            max-width: 600px;
            margin: 0 auto;
        }
        .button {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 0;
            cursor: pointer;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td bgcolor="#ffffff" align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="email-container">
                    <tr>
                        <td align="left" bgcolor="#ffffff" style="padding: 20px 0 30px 0;">
                            <h2>Hello, {{ $name }}</h2>
                            <p>You are receiving this email because you need to set your password for your new account.</p>
                            <p>Please click the button below to set your password:</p>
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" style="padding: 20px 0;">
                                        <a href="{{ $setPasswordUrl }}" class="button" target="_blank">Set Password</a>
                                    </td>
                                </tr>
                            </table>
                            <p>If you did not request this action, no further action is required.</p>
                            <p>Thank you,<br>Admin Office</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
