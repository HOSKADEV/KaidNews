<div class="modal fade" id="createSubjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('dashboard.subjects.store') }}" method="POST">
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">{{ trans('subject.create') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <label for="name" class="form-label">{{ trans('subject.label.name') }}</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="{{ trans('subject.placeholder.name') }}">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="coef" class="form-label">{{ trans('subject.label.coef') }}</label>
                            <input type="number" id="coef" name="coef" class="form-control"
                                placeholder="{{ trans('subject.placeholder.coef') }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">{{ trans('app.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('app.create') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
