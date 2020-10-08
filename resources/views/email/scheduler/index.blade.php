@include('layouts.sidebar')

<div class="container" style="margin-top:20px">
    <div class="card">
        <h5 class="card-header">Send Scheduler</h5>
        <div class="card-body">
            <a class="btn btn-primary btn-sm" href="{{route('email-scheduler')}}">CREATE SCHEDULE</a>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Alias</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Body</th>
                    <th scope="col">Send Date</th>
                    <th scope="col">Status</th>
                    <th colspan="3"></th>
                </tr>
                </thead>

                @foreach($emailScheduler as $key => $scheduler)

                    <tbody>
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$scheduler->email_alias}}</td>
                    <td>{{$scheduler->email_subject}}</td>
                    <td>{{$scheduler->email_body}}</td>
                    <td>{{$scheduler->send_date}}</td>
                    <td>@if($scheduler->send_status == 0)
                            PENDING
                        @else
                            SEND
                        @endif
                    </td>

                    <td><button  class="btn btn-success btn-sm send"  id="send">SEND MAIL</button></td>
                </tr>

                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>



<script>

    $(document).ready(function(){

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".send").click(function(e){
            e.preventDefault();
           // var data = $('#email_scheduler').serialize();
            $.ajax({
                type: "GET",
                url:'{{ url('/email/scheduler/send/.$scheduler->id') }}',
               // data:data,
                success: function(){
                    Swal.fire({
                        title: 'success',
                        text: 'The Email was send',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                },
                beforeSend:function () {
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
