<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email From LAPT.ORG About Membership Card</title>
</head>

<body>
    <p>This LAPT Professional Membership Card (Wallet Certificate) above verifies that {{ $student->name }} has been certified based on a proctored exam conducted by an external assessor for the Certification , as taught by LAPT Accredited training provider Send us an email at info@lapt.org for further verification.</p>
    <p>To know more about LAPT please visit https://lapt.org/</p>
    <p><a href='{{ $membershipCard->path }}'>Click Here to Download Your Card.</a></p>
</body>

</html>