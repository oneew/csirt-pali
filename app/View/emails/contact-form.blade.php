<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Submission</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2563eb;">New Contact Form Submission</h2>
        
        <div style="background: #f8fafc; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <h3>Contact Details:</h3>
            <p><strong>Name:</strong> {{ $contact->name }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            @if($contact->organization)
                <p><strong>Organization:</strong> {{ $contact->organization }}</p>
            @endif
            <p><strong>Subject:</strong> {{ $contact->subject }}</p>
        </div>

        <div style="background: #ffffff; padding: 20px; border: 1px solid #e5e7eb; border-radius: 8px;">
            <h3>Message:</h3>
            <p>{{ $contact->message }}</p>
        </div>

        <div style="margin-top: 20px; font-size: 12px; color: #666;">
            <p>Submitted on: {{ $contact->created_at->format('F d, Y at H:i:s') }}</p>
            <p>You can view and manage this contact in the <a href="{{ route('admin.contacts.index') }}">admin panel</a>.</p>
        </div>
    </div>
</body>
</html>