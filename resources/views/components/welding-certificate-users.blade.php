<div>
    {{ $users->map(fn($user) => $user->name)->join(", ") }}
</div>
