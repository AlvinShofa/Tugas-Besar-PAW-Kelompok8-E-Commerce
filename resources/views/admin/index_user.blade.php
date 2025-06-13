@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Kelola Pengguna</h3>
    
    <form action="{{ route('admin.users.deleteMultiple') }}" method="POST" id="deleteForm">
        @csrf
        @method('DELETE')
        <div class="mb-3 text-end">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus pengguna terpilih?')">
                <i class="bi bi-trash me-2"></i><span>Hapus Akun</span>
            </button>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th>ID Akun</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>
                        <input class="form-check-input user-checkbox" type="checkbox" name="user_ids[]" value="{{ $user->id }}">
                    </td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus akun ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>

<script>
    // Select all checkbox
    document.getElementById('checkAll').addEventListener('click', function () {
        let checkboxes = document.querySelectorAll('.user-checkbox');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });
</script>
@endsection
