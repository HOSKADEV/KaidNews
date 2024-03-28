<div class="modal fade" id="createCertificateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog " role="document">
        {{-- modal-lg --}}
        <form action="{{ route('dashboard.certificates.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="modal-content ">
                <div class="modal-header mb-0">
                    <h5 class="modal-title" id="exampleModalLabel1">{{ trans('certificate.create') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0 pb-0">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <label for="student_id" class="form-label">{{ trans('certificate.label.student') }}</label>
                            <select class="form-select" id="student_id" name="student_id"
                                aria-label="Default select example">
                                <option value="">{{ trans('certificate.select.student') }}</option>
                                @foreach ($listStduents as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-5 mt-4">
                            <label for="upload" class="btn btn-primary btn-md mt-1" tabindex="0">
                                <span class="d-none d-sm-block">{{ trans('certificate.uploadnew') }}</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="upload" name="certificate" class="account-file-input" hidden
                                    accept="application/pdf" />
                            </label>
                        </div>
                        <div class="col-sm-12 col-md-3 mt-4">
                            <button type="button" class="btn btn-secondary account-image-reset mb-4">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">{{ trans('certificate.reset') }}</span>
                            </button>
                        </div>
                        <div class="col-12 mt-2">
                            <embed src="{{ asset('assets/certificate/certificate.pdf') }}" class="responsive"
                                width="500px" height="300px" id="uploadedAvatar" background-color="0xFF525659"
                                top-toolbar-height="0" full-frame="" internalinstanceid="21" title="CHROME" />
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
