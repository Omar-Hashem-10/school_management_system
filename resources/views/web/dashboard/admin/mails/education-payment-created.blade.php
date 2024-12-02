<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }
        .email-header {
            background-color: #004085;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
        .email-body {
            padding: 20px;
            line-height: 1.6;
        }
        .email-body p {
            margin: 0 0 10px;
        }
        .email-footer {
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #555;
        }
        .highlight {
            color: #004085;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            Payment Receipt
        </div>
        <div class="email-body">
            <p><strong>Dear {{ $data['guardianName'] }},</strong></p>
            <p>We have received your payment for the following details:</p>
            <p><strong>Payment Date:</strong> <span class="highlight">{{ $data['paymentDate'] }}</span></p>
            <p><strong>Amount Paid:</strong> <span class="highlight">{{ $data['amountPaid'] }}</span></p>
            <p><strong>Semester:</strong> <span class="highlight">{{ $data['semester'] }}</span></p>
            <p><strong>Academic Year:</strong> <span class="highlight">{{ $data['academicYear'] }}</span></p>
            <p><strong>Student Academic Year:</strong> <span class="highlight">{{ $data['studentAcademicYear'] }}</span></p>
        </div>
        <div class="email-footer">
            Thank you for your payment. If you have any questions, please contact the school administration.
        </div>
    </div>
</body>
</html>
