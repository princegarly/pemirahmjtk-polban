@canany(['grade-update', 'grade-delete'])
    <div class="d-flex">
        @can('grade-update')
            <a href="{{ route('grade.edit', Crypt::encrypt($id)) }}" class="ml-2 btn btn-warning">
                <span class="fas fa-edit"></span>
            </a>
        @endcan

        @can('grade-delete')
            <a href="{{ route('grade.destroy', Crypt::encrypt($id)) }}" class="ml-2 btn btn-danger" data-confirm-delete="true">
                <span class="fas fa-trash"></span>
            </a>
        @endcan
    </div>
@endcanany