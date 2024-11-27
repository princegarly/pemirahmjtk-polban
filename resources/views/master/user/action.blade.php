@canany(['role-update', 'role-delete'])
    <div class="d-flex">
        @canany(['user-update'])
            <a href="{{ route('user.edit', Crypt::encrypt($id)) }}" class="ml-2 btn btn-warning">
                <span class="fas fa-edit"></span>
            </a>
        @endcan

        @canany(['user-delete'])
            <a href="{{ route('user.destroy', Crypt::encrypt($id)) }}" class="ml-2 btn btn-danger" data-confirm-delete="true">
                <span class="fas fa-trash"></span>
            </a>
        @endcan
    </div>
@endcanany