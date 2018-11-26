<div>
    <p>Halo, {{$user->name}}</p>
    <p>Silakan klik link di bawah ini untuk melakukan verifikasi...</p>
    <a href="{{ route('User.verif', $user->email_token)}}">{{ route('User.verif', $user->email_token)}}</a>
</div>

