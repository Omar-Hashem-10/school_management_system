<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Important Notice for Your Child</title>
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
            Important Notice for Your Child
        </div>
        <div class="email-body">
            <p><strong>Dear {{ $data['guardianName'] }},</strong></p>
            <p>We would like to inform you about the following important updates regarding your child:</p>
            <p><strong>Student Name:</strong> <span class="highlight">{{ $data['studentName'] }}</span></p>
            <p><strong>Subject:</strong> <span class="highlight">{{ $data['subject'] }}</span></p>
            <p><strong>Important Notes:</strong></p>
            <p>{{ $data['importantNotes'] }}</p>
            <p>We kindly ask you to review this information and get in touch with the school if you have any questions or concerns.</p>
        </div>
        <div class="email-footer">
            Thank you for your continued support. If you need any further assistance, please don't hesitate to contact us.
        </div>
    </div>
</body>
</html>
