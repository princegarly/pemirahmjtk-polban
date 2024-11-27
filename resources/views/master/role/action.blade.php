@canany(['role-edit', 'role-delete'])
    <div class="d-flex">
        @can('role-edit')
            <a href="{{ route('role.edit', Crypt::encrypt($uuid)) }}" class="ml-2 btn btn-warning">
                <span class="fas fa-edit"></span>
            </a>
        @endcan

        @can('role-delete')
            <a href="{{ route('role.destroy', Crypt::encrypt($uuid)) }}" class="ml-2 btn btn-danger" data-confirm-delete="true">
                <span class="fas fa-trash"></span>
            </a>
        @endcan
    </div>
@endcanany