{{-- <x-mail::message>
  # Thank You for Contacting Us

  We have received your message and will get back to you shortly.

  **Your Message:**
  {{ $data['message'] }}

  Thanks,<br>
  {{ config('app.name') }}
</x-mail::message> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <style>
        /* Inline CSS for styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333333;
        }

        /* Add more styles as needed */
    </style>
</head>
<body>
    <div class="container">
        <h1>Contact Form Submission</h1>
        {{-- <p><strong>Subject:</strong> {{ $data['subject'] }}</p>
        <p><strong>Email:</strong> {{ $data['email'] }}</p> --}}
        <p><strong>Message:</strong> {{ $data['message'] }}</p>
        <hr>
        <p>Thank you for contacting us. We will get back to you shortly.</p>
    </div>
</body>
</html>
