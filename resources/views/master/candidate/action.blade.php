@canany(['candidate-update', 'candidate-delete'])
    <div class="d-flex">
        @can('candidate-update')
            <a href="{{ route('candidate.edit', Crypt::encrypt($id)) }}" class="ml-2 btn btn-warning">
                <span class="fas fa-edit"></span>
            </a>
        @endcan

        @can('candidate-delete')
            <a href="{{ route('candidate.destroy', Crypt::encrypt($id)) }}" class="ml-2 btn btn-danger" data-confirm-delete="true">
                <span class="fas fa-trash"></span>
            </a>
        @endcan
    </div>
@endcanany