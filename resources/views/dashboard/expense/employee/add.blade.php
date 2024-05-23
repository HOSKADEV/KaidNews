<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">{{ trans('expense.Add employee expenses') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form action="{{ route('dashboard.employee.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data" >
                  @csrf
                  <div class="mb-3">
                    <label class="form-label" for="categories">{{ trans('expense.job') }}</label>
                    <select class="selectpicker form-control" name="job" id="job">
                      <option value="" disabled selected>{{ trans('expense.Select job') }}</option>
                      @foreach ($jobs as $job)
                          <option value="{{ $job->id }}">{{ $job->name }}</option>
                      @endforeach
                      <option value="0">{{ trans('expense.Select another') }}</option>
                    </select>
                  </div>
                  <div class="mb-3" id="newJobInput" style="display: none">
                    <label class="form-label" for="">{{ trans('expense.Name Job') }}</label>
                    <input type="text" class="form-control"  name="newjob" placeholder="{{ trans('expense.Name Job') }}" >
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="">{{ trans('expense.First Name & Last Name') }}</label>
                    <input type="text" class="form-control" name="name" placeholder="{{ trans('expense.First Name & Last Name') }}"/>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="">{{ trans('expense.Outflows') }}</label>
                    <input type="number" class="form-control"  name="amount" placeholder="{{ trans('expense.Outflows') }}"/>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="">{{ trans('expense.Notes') }}</label>
                    <textarea class="form-control" name="notes" placeholder="{{ trans('expense.Notes') }}"></textarea>
                  </div>

          </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary"
                          data-bs-dismiss="modal">{{ trans('app.close') }}</button>
                      <button type="submit" class="btn btn-primary">{{ trans('app.create') }}</button>
                  </div>
              </form>
      </div>
  </div>
</div>


