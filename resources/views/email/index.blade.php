@include('layouts.sidebar')
    <div class="container" style="margin-top:20px">


        <div class="card">
  <h5 class="card-header">Email Manager</h5>
  <div class="card-body">
  <div class="float-right">
  <a class="btn btn-primary btn-sm" href="{{route('excel.download')}}" style="margin-left:900px" >Download Excel Formate</a>
</div>
<form action="{{route('excel-import')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">

                            <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input"  id="validatedCustomFile" required>
                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
            </div>
    <button type="submit" class="btn btn-warning btn-sm">Import data</button>
</form>
    <div class="float-right">


    </div>
  </div>
</div>
    </div>
@include('layouts.footer')
