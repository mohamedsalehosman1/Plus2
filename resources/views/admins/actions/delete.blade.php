@permission('delete_admins')
    <form action="{{ route('admins.delete', $admin->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endpermission
