<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Certificate Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 30px;
        }

        .card {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            max-width: 800px;
            margin: auto;
        }

        .details {
            flex: 1;
        }

        .details h2 {
            margin: 0 0 20px;
            font-size: 22px;
            color: #222;
        }

        .row {
            margin-bottom: 12px;
            font-size: 14px;
        }

        .label {
            display: inline-block;
            width: 120px;
            font-weight: bold;
            color: #555;
        }

        .value {
            color: #111;
        }

        .value a {
            color: #0066cc;
            text-decoration: none;
        }

        .value a:hover {
            text-decoration: underline;
        }

        .qr {
            margin-left: 40px;
            flex-shrink: 0;
        }

        .qr img {
            width: 180px;
            height: 180px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 6px;
            background: #fff;
        }
    </style>
</head>

<body>

    <div class="card">
        <!-- Left side: Certificate details -->
        <div class="details">
            <h2>Certificate Details</h2>

            <div class="row"><span class="label">Certificate #:</span> <span class="value">3</span></div>
            <div class="row"><span class="label">Student:</span> <span class="value">{{ $certificate->student->name }}</span>
            </div>
            <div class="row"><span class="label">Phone Number:</span> <span class="value">{{ $certificate->student->mobile }}</span></div>
            <div class="row"><span class="label">Course:</span> <span class="value">{{ $certificate->course->name }} <span
                        style="color:#888;font-size:12px;">(908678)</span></span></div>
            <div class="row"><span class="label">Issue Date:</span> <span class="value">{{ optional($certificate->created_at)->format('d M Y') ?? '—' }}</span></div>
        </div>

        <!-- Right side: QR code -->
        <div class="qr">
            <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code" height="200" width="200">
        </div>
    </div>

</body>

</html>