    @include('layouts.sidebar')


    <div class="container" style="margin-top:20px">
    <div class="card">
      <h5 class="card-header">Send Scheduler</h5>
      <div class="card-body">
      <form method="post" action="#" method="POST" enctype="multipart/form-data" id="email_scheduler">
      @csrf
      <div class="row">
        <div class="col">
            <lable>alias</lable>
          <input type="text" class="form-control" name="email_alias" placeholder="EX : Marketing Mail">
        </div>
        <div class="col">
        <lable>Subject</lable>
          <input type="text" class="form-control" name="email_subject" placeholder="Ex : Hooray! This is the email subject">
        </div>

      </div>
      <div class="row">
      <div class="col">
        <lable>Body</lable>
          <textarea type="text" class="form-control" name="email_body" placeholder="Your Text Here" ></textarea>
        </div>
      </div>
      <div class="row">
            <div class="col">
                <lable> Attachment</lable>
                <input type="file"  class="form-control" name="email_attach_file" placeholder="select file">
            </div>
      </div>
      <div class="row">
            <div class="col">
                <lable> Send Date</lable>
                <input type="date" name="send_date" class="form-control">
            </div>
            <div class="col">
                <lable> Select Batche(s)</lable>
                <select multiple class="form-control" id="sel2" name="batch">
                  @foreach($userBatch as $batch)

                  <option value="{{$batch->batch_id}}">{{$batch->batch_no}}</option>
                  @endforeach

          </select>
            </div>
      </div>
      <div class="float-right">
    <input type="hidden" id="batch_values" name="batch_values">
    </div>
      <br>
      <button  class="btn btn-primary btn-sm" class="frmSubmit" id="frmsubmit" >SCHEDULE</button>
    </form>

      </div>
    </div>
    </div>



    <script>
        $(document).ready(function(){

            $('#frmsubmit').on('click', function () {
                console.log('ok');
                var array = [];
                $('select#sel2 option:checked').each(function() {
                        array.push($(this).val());
                });

                $('#batch_values').attr('value',array);
            });


            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#frmsubmit").click(function(e){
                e.preventDefault();
                    var data = $('#email_scheduler').serialize();
                        $.ajax({
                            type: "POST",
                            url:'{{route('email.scheduler')}}',
                            data:data,
                                success: function(){
                                  Swal.fire({
                                    title: 'success',
                                    text: 'Schedule Is Save',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                  });
                                }, beforeSend:function () {
                                Swal.fire({
                                    title: 'Please Wait a Second',
                                });
                                swal.showLoading();
                            }
                        });
            });
        });




    </script>

    @include('layouts.footer')
