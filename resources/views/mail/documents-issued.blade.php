<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documents Issued</title>
</head>

<body>

    <div class="main" style="box-sizing: border-box; border: 2px solid #eae0e0; width: 800px; margin: 0 auto; padding: 15px 40px; border-radius: 5px;">
        <p class="subject">Subject: Confirmation of Registration with LAPT Ltd</p>
        <p class="dear">Dear, <span>{{ $certificate->student->name }}</span></p>
        <p>We are writing this email to confirm your successfull registration with LAPT for <span class="course-name">{{ $certificate->course->name }}</span>. Your registration has been processed, and you have been issued a unique Verification ID number. This number will be used for all future correspondence and communication with LAPT.</p>
        <p>As a part of the Registration process, LAPT issues two important documents - Admit Card and Registration Letter. Both these documents are critical to your registration and identity verificatin process. The Admit Card is also used as a valid Identity document, which you would need to present to the LAPT assessor during the examination and assessment process</p>
        <p>We have attached both the Admit Card and Registration Letter to this mail. Both these documents contain a QR code that can be scanned to verify their authenticity.</p>
        <p>We urge you to keep the Admit Card safely as it is an essential document for your assessment process. Any issues with the Admit Card could prevent you from taking the assessment, so we recommend you keep it secure and produce whenever required.</p>
        <p>Important - </p>
        <p>Please be advised that it is essential to ensure that the name on all LAPT documents is identical to the name on the submitted ID card document. We regret to inform you that any requests for name changes will not be accommodated.</p>
        <p>Certification Process</p>
        <p>Step 1: Registration with LAPT prior to commencing training at an LAPT Accredited Training Provide.</p>
        <p>Step 2: Upon completion of training, submit internal assessments and assignments to the LAPT-accredited training provider.</p>
        <p>Step 3: Attend the LAPT External Assesments and Examination.</p>
        <p>Step 4: Results are declared.</p>
        <p>Step 5: Certification and Marksheet issuance.</p>
        <p>Thank you for choosing LAPT Ltd as your certification body. Please feel free to contact us if you have any queries or concerns. Please see our terms on https://lapt.org/terms_condition. You are certified based on these terms.</p>
        <p>Best Regards,</p>
        <p>Registration Team</p>

        <address>LAPT Ltd</address>
        <address>85 Great Portland Street</address>
        <address>London W1W1 7LT</address>
        <address>United Kingdom</address>

        <table width="600" border="1" cellpadding="4" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;" bordercolor="#ECE9D8">
            <tr>
                <td colspan="2" align="center" bgcolor="#CC0000">
                    <span style="color:#ffffff;">Student Issued Documents</span>
                </td>
            </tr>

            <tr>
                <td>Admit Card Attachment Link</td>
                <td><a href="{{ $admitCard->path }}">Admit Card</td>
            </tr>

            <tr>
                <td>Registration Letter Attachment Link</td>
                <td><a href="{{ $registrationLetter['target_path'] }}">Registration Letter</td>
            </tr>

            <tr>
                <td>Admit Card Link</td>
                <td><a href="{{ $admitCard->url }}">View Attachment</td>
            </tr>

            <tr>
                <td>Registration letter Link</td>
                <td><a href="{{ $registrationLetter['url'] }}">View Attachment</td>
            </tr>
        </table>
    </div>
</body>

</html>