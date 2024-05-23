<div class="modal fade" id="editSituationalModal{{ $situational->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">{{ trans('expense.Edit employee expenses') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form action="{{ route('dashboard.situational.update', $situational->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data" >
                  @csrf
                  @method('PUT')
                  <div class="mb-3">
                    <label class="form-label" for="categories">{{ trans('expense.job') }}</label>
                    <select class="selectpicker form-control" name="job" id="job" value="{{ $situational->types_of_expenses_id }}">
                      <option value="{{ $situational->types_of_expenses_id }}" selected>{{ $situational->typeExpenses->name }}</option>
                      @foreach ($jobs as $job)
                          <option value="{{ $job->id }}">{{ $job->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="mb-3" id="newJobInput" style="display: none">
                    <label class="form-label" for="">{{ trans('expense.Name Job') }}</label>
                    <input type="text" class="form-control"  name="newjob" placeholder="{{ trans('expense.Name Job') }}" >
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="">{{ trans('expense.Outflows') }}</label>
                    <input type="number" class="form-control"  name="amount" value="{{ $situational->amount }}" placeholder="{{ trans('expense.Outflows') }}"/>
                  </div>
                  <div class="mb-3">
                    <label for="month" class="form-label">{{ trans('attendence.label.month') }}</label>
                    <select class="form-select" name="month" >
                        <option value="{{ $situational->month }}">{{ trans('attendence.months.' . $situational->month) }}</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ trans('attendence.months.' . $i) }}</option>
                        @endfor
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="">{{ trans('expense.Notes') }}</label>
                    <textarea class="form-control" name="notes" placeholder="{{ trans('expense.Notes') }}">{{ $situational->notes }}</textarea>
                  </div>

          </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary"
                          data-bs-dismiss="modal">{{ trans('app.close') }}</button>
                      <button type="submit" class="btn btn-primary">{{ trans('app.update') }}</button>
                  </div>
              </form>
      </div>
  </div>
</div>


