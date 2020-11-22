{{ $title }}
<br />
{!! QrCode::size(250)->generate($email) !!}