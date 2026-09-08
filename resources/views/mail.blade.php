<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>Student Access Code</title>
```

</head>

<body style="margin:0; padding:0; background-color:#f4f7fb; font-family:Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f4f7fb; padding:40px 15px;">
    <tr>
        <td align="center">

```
        <!-- Main Card -->
        <table width="600" cellpadding="0" cellspacing="0" border="0"
               style="max-width:600px; width:100%; background-color:#ffffff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.08);">

            <!-- Header -->
            <tr>
                <td align="center"
                    style="background-color:#2563eb; padding:32px 20px;">

                    <div style="
                        width:60px;
                        height:60px;
                        background-color:#ffffff;
                        border-radius:50%;
                        margin:0 auto 15px auto;
                        line-height:60px;
                        font-size:28px;
                        font-weight:bold;
                        color:#2563eb;
                    ">
                        S
                    </div>

                    <h1 style="
                        margin:0;
                        color:#ffffff;
                        font-size:25px;
                        font-weight:700;
                    ">
                        School Management
                    </h1>

                    <p style="
                        margin:8px 0 0 0;
                        color:#dbeafe;
                        font-size:14px;
                    ">
                        Student Access &amp; Parent Portal
                    </p>

                </td>
            </tr>

            <!-- Content -->
            <tr>
                <td style="padding:35px 35px 25px 35px;">

                    <h2 style="
                        margin:0 0 12px 0;
                        color:#111827;
                        font-size:22px;
                    ">
                        Hello Parent 👋
                    </h2>

                    <p style="
                        margin:0 0 25px 0;
                        color:#4b5563;
                        font-size:15px;
                        line-height:1.7;
                    ">
                        You can use the access code below to link your child
                        to your account in the School Management application.
                    </p>

                    @foreach ($students as $student)

                        <!-- Student Box -->
                        <table width="100%" cellpadding="0" cellspacing="0" border="0"
                               style="
                                   margin-bottom:20px;
                                   background-color:#f8fafc;
                                   border:1px solid #e5e7eb;
                                   border-radius:12px;
                               ">

                            <tr>
                                <td style="padding:22px;">

                                    <p style="
                                        margin:0 0 6px 0;
                                        color:#6b7280;
                                        font-size:13px;
                                    ">
                                        Student
                                    </p>

                                    <h3 style="
                                        margin:0 0 20px 0;
                                        color:#111827;
                                        font-size:18px;
                                    ">
                                        {{ $student->full_name }}
                                    </h3>

                                    <p style="
                                        margin:0 0 8px 0;
                                        color:#6b7280;
                                        font-size:13px;
                                    ">
                                        Access Code
                                    </p>

                                    <!-- Code -->
                                    <div style="
                                        background-color:#eff6ff;
                                        border:2px dashed #2563eb;
                                        border-radius:10px;
                                        padding:16px;
                                        text-align:center;
                                    ">
                                        <span style="
                                            color:#1d4ed8;
                                            font-size:30px;
                                            font-weight:700;
                                            letter-spacing:6px;
                                        ">
                                            {{ $student->code }}
                                        </span>
                                    </div>

                                </td>
                            </tr>

                        </table>

                    @endforeach

                    <!-- Instructions -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0"
                           style="
                               margin-top:25px;
                               background-color:#f0fdf4;
                               border-left:4px solid #22c55e;
                           ">
                        <tr>
                            <td style="padding:16px 18px;">

                                <p style="
                                    margin:0 0 7px 0;
                                    color:#166534;
                                    font-size:14px;
                                    font-weight:bold;
                                ">
                                    How to link your child
                                </p>

                                <p style="
                                    margin:0;
                                    color:#166534;
                                    font-size:13px;
                                    line-height:1.7;
                                ">
                                    Open the School Management app, sign in to
                                    your account, and enter the access code
                                    shown above when prompted.
                                </p>

                            </td>
                        </tr>
                    </table>

                    <p style="
                        margin:28px 0 0 0;
                        color:#6b7280;
                        font-size:13px;
                        line-height:1.6;
                        text-align:center;
                    ">
                        Please keep this code private and do not share it
                        with anyone else.
                    </p>

                </td>
            </tr>

            <!-- Footer -->
            <tr>
                <td style="
                    background-color:#f8fafc;
                    border-top:1px solid #e5e7eb;
                    padding:22px;
                    text-align:center;
                ">

                    <p style="
                        margin:0 0 6px 0;
                        color:#374151;
                        font-size:13px;
                        font-weight:bold;
                    ">
                        School Management System
                    </p>

                    <p style="
                        margin:0;
                        color:#9ca3af;
                        font-size:12px;
                    ">
                        This is an automated email. Please do not reply.
                    </p>

                </td>
            </tr>

        </table>

    </td>
</tr>
```

</table>

</body>
</html>
