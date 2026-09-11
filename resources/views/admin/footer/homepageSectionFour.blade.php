<div class="card card-dark ">
    <div class="card-header">
        <h3 class="card-title">Section Four</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-12">
                <label for="sectionFourTitle" class="col-form-label">Section
                    Title</label>
                <textarea name="sectionFourTitle" id="sectionFourTitle" class="form-control" aria-required="true"
                    aria-invalid="false">
                    @if (!empty($allData) && isset($allData['sectionFourTitle']) && $allData['sectionFourTitle'] != '')
                    {{ $allData['sectionFourTitle'] }}
                    @endif
                </textarea>
            </div>

            <div class="col-sm-12">
                <label for="sectionFourItems" class="col-form-label">Select Items</label>
                <select class="form-control select2" name="sectionFourItems[]" id="sectionFourItems" multiple>
                </select>
            </div>
        </div>
    </div>
</div>
