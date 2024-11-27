@canany(['study-program-edit', 'study-program-delete'])
    <div class="d-flex">
        @can('study-program-edit')
            <a href="{{ route('study-program.edit', Crypt::encrypt($id)) }}" class="ml-2 btn btn-warning">
                <span class="fas fa-edit"></span>
            </a>
        @endcan

        @can('study-program-delete')
            <a href="{{ route('study-program.destroy', Crypt::encrypt($id)) }}" class="ml-2 btn btn-danger" data-confirm-delete="true">
                <span class="fas fa-trash"></span>
            </a>
        @endcan
    </div>
@endcanany