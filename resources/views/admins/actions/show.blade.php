@permission('show_admins')
<a href="{{ route('admins.show', $admin->id) }}" class="btn btn-success">Show</a>
@endpermission
