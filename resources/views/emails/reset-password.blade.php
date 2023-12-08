<x-mail::message>
 Dear {{$name}},

 

Oops! If you've forgotten your Thereyougo password, don't worry. 

<x-mail::button url="{{route('reset-password.confirm', $reset_password_id)}}">Click Here</x-mail::button> to reset it and regain access to your account.

 

If you didn't request this reset, please ignore this email.

 

Best,

 

The Thereyougo Team

Simone Formica

Founder | Thereyougo

Book 30 min HERE
</x-mail::message>
