<form method="POST" action="{{ route('invitations.store') }}">
    @csrf

    <input type="text" name="name" placeholder="Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>

    <select name="role_id" required>
        @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
    </select><br><br>

    <button type="submit">Send Invitation</button>
</form>
