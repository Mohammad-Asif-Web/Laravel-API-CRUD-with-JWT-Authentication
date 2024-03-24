@extends('auth.master')
@section('title', 'Log In Page')

@section('content')
<h1>Log In User</h1>
<form id="login_form">
    <label for="">Your Email: </label>
    <input type="email" name="email" placeholder="Enter email"><br><br>
    <label for="">Your Password: </label>
    <input type="password" name="password" placeholder="Enter password"><br><br>
    <button type="submit">Submit</button>
</form>
<ul id="error" style="color:red"></ul>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js" integrity="sha512-PJa3oQSLWRB7wHZ7GQ/g+qyv6r4mbuhmiDb8BjSFZ8NZ2a42oTtAq5n0ucWAwcQDlikAtkub+tPVCw4np27WCg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){
        let DomainName = window.location.origin;
        $('#login_form').submit(function(event){
            event.preventDefault();
            let formData = $(this).serialize();
            $('#error').empty()
            $.ajax({
                url: `${DomainName}/api/login`,
                type: 'POST',
                data: formData,
                success: function(res){
                    if (res.success == false) {
                        $('#error').append(`<li>${res.msg}</li>`)
                    } else if(res.success == true){
                        $('#error').append(`<li>${res.msg}</li>`);
                        localStorage.setItem("token", `${res.token_type} ${res.token}`);
                        window.open('/profile', '_self')
                    } else {
                        $.each(res, function(key, value) {
                            $('#error').append(`<li>${value}</li>`)
                        });
                    }
                }
            })
        })
    })
</script>
@endpush
