
@permission('delete_coupons')
    <form action="{{ route("ads.destroy", $ad->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endpermission
