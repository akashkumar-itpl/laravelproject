<div class="card card-dark ">
    <div class="card-header">
        <h3 class="card-title">Section Three</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-12">
                <label for="sectionThreeTitle" class="col-form-label">Section
                    Title</label>
                <textarea name="sectionThreeTitle" id="sectionThreeTitle" class="form-control" aria-required="true"
                    aria-invalid="false">
                    @if (!empty($allData) && isset($allData['sectionThreeTitle']) && $allData['sectionThreeTitle'] != '')
                    {{ $allData['sectionThreeTitle'] }}
                    @endif
                </textarea>
            </div>

            <div class="col-sm-12">
                <label for="sectionThreeItems" class="col-form-label">Select Items</label>
                <select class="form-control select2" name="sectionThreeItems[]" id="sectionThreeItems" multiple>
                </select>
            </div>
        </div>
    </div>
</div>
