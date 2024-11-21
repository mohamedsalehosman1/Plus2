@permission('delete_admins')
    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endpermission
