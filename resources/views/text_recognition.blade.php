@extends('master')

@section('content')
  <div class="row">
    <div class="col-12">
      <h1>Text Recognition</h1>

      <form action="{{ route('text_recognition.submit') }}" method="POST" enctype="multipart/form-data"
            id="submit-form">
        @csrf
        <div class="mb-3">
          <label for="formFile" class="form-label">Please Insert The Photo To Analyze</label>
          <input class="form-control" type="file" id="formFile" name="image">
        </div>
      </form>

      <div id="result-panel" style="display: none">
        <h1>Result</h1>
        <div class="row">
          <div class="col" id="image-shower"></div>
          <div class="col-10" id="table-shower">
          </div>
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
            data = data.filter((item) => item.Confidence > 90);
            let template = '';

            template += `
              <table class="table-bordered table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Recognized Text</th>
                    <th scope="col">Type</th>
                    <th scope="col">Confidence</th>
                  </tr>
                </thead>
                <tbody id="tbody-table">
                ${data.map((text, i) => `
                  <tr>
                    <td>${i + 1}</td>
                    <td>${text.DetectedText}</td>
                    <td>${text.Type}</td>
                    <td>${text.Confidence}%</td>
                  </tr>
                `).join('')}
                </tbody>
              </table>
              `;

            $("#table-shower").empty().append(template);

            $("#result-panel").show();
          },
        });
      }));

      $("#formFile").on("change", function () {
        const file = this.files[0];
        if (file) {
          $("#image-shower").empty();
          let reader = new FileReader();
          reader.onload = function (event) {
            $("#image-shower").html(
              `<img src="${event.target.result}" class="img-fluid" alt="Responsive image" style="height:300px">`
            );
          };
          reader.readAsDataURL(file);
        }
        $("#result-panel").hide();

        $("#submit-form").submit();
      });
    });
  </script>
@endsection
