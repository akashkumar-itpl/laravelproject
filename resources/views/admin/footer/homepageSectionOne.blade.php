<div class="card card-dark ">

    <div class="card-header">

        <h3 class="card-title">Admission Procedure</h3>

        <div class="card-tools">

            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>

            </button>

        </div>

    </div>



    <div class="card-body">

        <div class="form-group row">



            <div class="col-md-12">

                <label for="admission_open_text" class="col-form-label">Content</label>

                <textarea name="admission_open_text" id="admission_open_text" class="summernote form-control" aria-required="true"
                    aria-invalid="false">
@if (!empty($allData) && isset($allData['admission_open_text']) && $allData['admission_open_text'] != '')
{{ $allData['admission_open_text'] }}
@endif
</textarea>



                <label for="admissionDescription" class="col-form-label">Description</label>

                <textarea name="admissionDescription" id="admissionDescription" class="summernote form-control" aria-required="true"
                    aria-invalid="false">
@if (!empty($allData) && isset($allData['admissionDescription']) && $allData['admissionDescription'] != '')
{{ $allData['admissionDescription'] }}
@endif
</textarea>

            </div>

        </div>

    </div>

</div>
