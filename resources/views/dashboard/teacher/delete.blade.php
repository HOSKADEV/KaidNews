<div class="modal fade" id="deleteTeacherModal{{ $teacher->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('dashboard.teachers.destroy', 'test') }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" id="id" name="id" class="form-control" value="{{ $teacher->id }}">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">{{ trans('teacher.delete') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ trans('teacher.delete_confirmation') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">{{ trans('app.close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ trans('app.delete') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
