@extends('master')

@section('content')
  <div class="row">
    <div class="col-12">
      <h1>Face Detector</h1>

      <form action="{{ route('face_detector.submit') }}" method="POST" enctype="multipart/form-data" id="submit-form">
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

            let template = '';

            $.each(data, function (index, v) {
              template += `
                  <table class="table-bordered table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Parameter</th>
                        <th scope="col">Value</th>
                      </tr>
                    </thead>
                    <tbody id="tbody-table">
                      <tr>
                        <td>1</td>
                        <td>Age Range</td>
                        <td id="age_range">${v.AgeRange.Low} - ${v.AgeRange.High}</td>
                      </tr>

                      <tr>
                        <td>2</td>
                        <td>Beard</td>
                        <td id="beard">${v.Beard.Value} (${v.Beard.Confidence}%)</td>
                      </tr>

                      <tr>
                        <td>3</td>
                        <td>Emotions</td>
                        <td id="emotions">
                          <ul>
                            ${v.Emotions.map((emotion) => `<li>${emotion.Type} (${emotion.Confidence}%)</li>`).join('')}
                          </ul>
                        </td>
                      </tr>

                      <tr>
                        <td>4</td>
                        <td>Eyeglasses</td>
                        <td id="eyeglasses">${v.Eyeglasses.Value} (${v.Eyeglasses.Confidence}%)</td>
                      </tr>

                      <tr>
                        <td>5</td>
                        <td>Eyes Open</td>
                        <td id="eyes_open">${v.EyesOpen.Value} (${v.EyesOpen.Confidence}%)</td>
                      </tr>

                      <tr>
                        <td>6</td>
                        <td>Gender</td>
                        <td id="gender">${v.Gender.Value} (${v.Gender.Confidence}%)</td>
                      </tr>

                      <tr>
                        <td>7</td>
                        <td>Mouth Open</td>
                        <td id="mouth_open">${v.MouthOpen.Value} (${v.MouthOpen.Confidence}%)</td>
                      </tr>

                      <tr>
                        <td>8</td>
                        <td>Mustache</td>
                        <td id="mustache">${v.Mustache.Value} (${v.Mustache.Confidence}%)</td>
                      </tr>

                      <tr>
                        <td>9</td>
                        <td>Smile</td>
                        <td id="smile">${v.Smile.Value} (${v.Smile.Confidence}%)</td>
                      </tr>

                      <tr>
                        <td>10</td>
                        <td>Sunglasses</td>
                        <td id="sunglasses">${v.Sunglasses.Value} (${v.Sunglasses.Confidence}%)</td>
                      </tr>
                      <tr>
                        <td>11</td>
                        <td>Confidence</td>
                        <td id="sunglasses">${v.Confidence}%</td>
                      </tr>
                    </tbody>
                  </table>
              `;
            });

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
