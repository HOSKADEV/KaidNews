<div class="modal fade" id="deleteEmployeeModal{{ $employee->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <form action="{{ route('dashboard.employee.destroy', $employee->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel1">{{ trans('expense.delete') }}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <p>{{ trans('expense.delete_confirmation') }}</p>
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
