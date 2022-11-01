@extends('master')

@section('content')
  <div class="row">
    <div class="col-12">
      <h1>Face Comparison</h1>

      <form action="{{ route('face_compare.submit') }}" method="POST" enctype="multipart/form-data"
            id="submit-form">
        @csrf
        <div class="mb-3">
          <label for="formFile" class="form-label">Please Insert The Photo As Source</label>
          <input class="form-control" type="file" id="image_source" name="image_source">
        </div>
        <div class="mb-3">
          <label for="formFile" class="form-label">Please Insert The Photo As Target</label>
          <input class="form-control" type="file" id="image_target" name="image_target">
        </div>
        <div class="d-grid">
          <button class="btn btn-primary" id="compare-btn">Compare!</button>
        </div>
      </form>

      <div id="gallery" class="my-2">
        <div class="row">
          <div id="image-source-shower" class="col"></div>
          <div id="image-target-shower" class="col"></div>
        </div>
      </div>

      <div id="result-panel" class="my-2" style="display: none">
        <h1>Result</h1>
        <div class="row" id="similarities">
        </div>
      </div>
    </div>
  </div>
@endsection


@section('js')
  <script>
    $(document).ready(function (e) {
      $('#submit-form').on('submit', (function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
          type: 'POST',
          url: $(this).attr('action'),
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          success: function (data) {
            let template = 'Identical: 0%';

            $.each(data, function (key, v) {
              template = `Identical: ${v.Similarity}%\n`;

            });

            $('#similarities').empty().append(template);

            $("#result-panel").show();
          },
        });
      }));

      $("#image_source").on("change", function () {
        const file = this.files[0];
        if (file) {
          $("#image-source-shower").empty();
          let reader = new FileReader();
          reader.onload = function (event) {
            $("#image-source-shower").html(
              `<img src="${event.target.result}" class="img-fluid" alt="Responsive image" style="height:300px">`
            );
          };
          reader.readAsDataURL(file);
        }
      });

      $("#image_target").on("change", function () {
        const file = this.files[0];
        if (file) {
          $("#image-target-shower").empty();
          let reader = new FileReader();
          reader.onload = function (event) {
            $("#image-target-shower").html(
              `<img src="${event.target.result}" class="img-fluid" alt="Responsive image" style="height:300px">`
            );
          };
          reader.readAsDataURL(file);
        }
      });

      $(document).on('click', '#compare-btn', function (e) {
        e.preventDefault();
        $("#result-panel").hide();
        $('#submit-form').submit();
      });
    });
  </script>
@endsection
