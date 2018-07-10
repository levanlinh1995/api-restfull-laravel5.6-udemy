Hello {{ $user->name }}
Thank you for create an account. Please verify your email use this link:
{{ route('verify', $user->verification_token) }}