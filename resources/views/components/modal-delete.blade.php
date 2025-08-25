<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0">
                    <i data-feather="alert-triangle" class="me-3"></i>
                    <span style="margin-left:5px;">Are you sure you want to delete this {{ $resource }} ?</span>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                <form id="deleteForm" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger text-white">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

