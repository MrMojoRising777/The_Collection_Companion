<x-mail::message>
  # New Contact Form Submission

  **Subject:** {{ $data['subject'] }}
  **Email:** {{ $data['email'] }}

  **Message:**
  {{ $data['message'] }}

  Thanks,<br>
  {{ config('app.name') }}
</x-mail::message>
