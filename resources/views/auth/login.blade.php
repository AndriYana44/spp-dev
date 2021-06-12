<link rel="shortcut icon" sizes="196x196" href="{{ asset('') }}img/user-side.png">

<!-- style -->
<link rel="stylesheet" href="../assets/animate.css/animate.min.css" type="text/css" />
<link rel="stylesheet" href="../assets/glyphicons/glyphicons.css" type="text/css" />
<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css" type="text/css" />
<link rel="stylesheet" href="../assets/material-design-icons/material-design-icons.css" type="text/css" />

<link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
<!-- build:css ../assets/styles/app.min.css -->
<link rel="stylesheet" href="../assets/styles/app.css" type="text/css" />
<!-- endbuild -->
<link rel="stylesheet" href="../assets/styles/font.css" type="text/css" />
<style>
    .login-display {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .card {
        padding: 40px 0;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 30%;
        flex-direction: column;
        border-radius: 15px;
        box-shadow: -6px 35px 14px -25px rgba(0, 0, 0, 0.3);
    }
    .card b {
        color: #8d448b;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 19px;
        margin-bottom: 20px;
    }
    span {
        width: 80px;
        height: 80px;
        background-color: #8d448b;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        margin-bottom: 20px;
        box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.5);
    }
    .card form {
        width: 60%;
    }
    .input-login {
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 100%;
    }
    .input-login input {
        width: 100%;
        height: 40px;
        margin-bottom: 15px;
        border: none;
        padding-left: 10px;
        color: #777;
        border-bottom: 1px solid #999;
        transition: .3s;
        background-color: rgba(0, 0, 0, 0);
    }
    .input-login input:focus {
        color: #8d448b;
        border-bottom: 1px solid #d175ce;
        font-size: 13px;
    }
    button {
        width: 100%;
        height: 40px;
        margin-top: 10px;
        border: none;
        background-color: #8d448b;
        color: #FFF;
        border-radius: 5px;
        transition: .3s;
    }
    button:hover {
        background-color: #9e2c9b;
    }
    .errors {
        color: rgb(153, 18, 18);
        text-align: center;
    }
    .captha {
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }
    .captha div {
        padding: 3px;
    }
    .captha input {
        border: none;
        margin-left: 5px;
        width: 55px;
        height: 30px;
        border-bottom: 1px solid rgba(0, 0, 0, .4);
        text-align: left;
        padding-left: 8px;
        font-size: 14px;
        transition: .3s;
    }
    .captha input:focus {
        font-size: 13px;
        border-bottom: 1px solid #d175ce;
    }
    #range {
        position: absolute;
        top: 0;
    }
    @media only screen and (max-width: 1080px) {
        .card{
            width: 50%;
        }
    }
    @media only screen and (max-width: 600px) {
        .card{
            width: 80%;
        }
    }
</style>
<div class="container">
    <div class="login-display">
        <div class="card shadow">
            <span>
                <i class="fa fa-user fa-3x text-white" aria-hidden="true"></i>
            </span>
            <b>Form Login</b>
            <div class="errors">
                <x-jet-validation-errors class="mb-4" />
            </div>
            <div class="mb-4 font-medium text-sm error_captha text-danger"></div>
            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="input-login">
                    <input type="text" autocomplete="off" name="username" placeholder="Username">
                    <input type="password" autocomplete="off" name="password" placeholder="Password">
                </div>
                <div class="captha">
                    <div class="one"></div>
                    <div>+</div>
                    <div class="two"></div>
                    <div>=</div>
                    <div class="hasil">
                        <input type="text" class="result" placeholder="0">
                    </div>
                </div>
                <button class="btn-login" type="submit">Login</button>
            </form>
        </div>
    </div>
</div>
<script src="../libs/jquery/jquery/dist/jquery.js"></script>
<script>
    const num_one = Math.round(Math.random() * (1, 20))
    const num_two = Math.round(Math.random() * (1, 20))

    const el_one = document.querySelector('.one')
    const el_two = document.querySelector('.two')
    el_one.innerHTML = num_one
    el_two.innerHTML = num_two

    const result = num_one + num_two

    $(function() {
        $('.hasil').on('keyup', '.result', function(e){
            if($.inArray(e.key, ['0','1','2','3','4','5','6','7','8','9']) == -1) {
                $('.result').val('')
            }
        });
    })

    document.querySelector('.btn-login')
    .addEventListener('click', function(e) {
        if($('.result').val() != result) {
            e.preventDefault()
            $('.error_captha').html('Captcha Wrong!')
        }
    })
</script>
