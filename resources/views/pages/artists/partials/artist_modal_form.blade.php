<div class="modal fade" id="artistModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="artistModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="artistModalLabel">Artist Details</h5>
            </div>

            <div class="modal-body">
                <form id="artistForm">
                    @csrf
                    <input type="hidden" class="form-control" id="artist" name="artist">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <span id="name_error" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                        <span id="description_error" class="text-danger"></span>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="saveArtist">Save</button>
            </div>

        </div>
    </div>
</div>
