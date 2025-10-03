<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Certificate - {{ $certificate->student->name }}</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <meta name="format-detection" content="telephone=no" />

    <style>
        @page {
            margin: 8px;
            size: 512px 302px;
        }

        body {
            padding: 0;
            margin: 0;
            background: url({{ public_path('/images/id_card_template.jpeg') }});
            background-size: 100% 100%;
            position: relative;
        }

        body * {
            font-family: Arial, Helvetica, sans-serif;
            position: absolute;
        }
    </style>
</head>

<body>
    <p style="left:200px; color:white;">{{ $certificate->student->centre->name }}</p>
    <p style="left:200px; font-weight:700; top:70px">{{ $certificate->student->name }}</p>
    <p style="left:200px; font-weight:700; top:95px">{{ $certificate->student->care_of }}</p>
    <p style="left:200px; font-weight:700; top:120px">{{ $certificate->student->id }}</p>
    <p style="left:200px; font-weight:700; top:145px">{{ $certificate->student->course->name }}</p>
    <p style="left:200px; font-weight:700; top:170px">{{ $certificate->student->session }}</p>

    <div style="left:210px; top:210px">
        <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code" height="50" width="50" />
    </div>
</body>

</html>