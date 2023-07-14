<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>
        Login Form
    </title>

    <style>
        body {
            background-color: rgb(236, 248, 249);
            margin-top: 150px;
            /* background-image: url("{{ asset('uploadfile/cover.png') }}");
            background-repeat: no-repeat;
            background-size: cover; */
        }

        .productImage {
            height: 350px;
            border-radius: 5px;

        }

        .loginFild {
            border-radius: 50px !important;
        }

        .pjtitle {
            height: 100px;
        }

        .login {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        .loginForm {
            animation: fadeIn 1s ease-in;
            opacity: 1;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .pjImage {
            animation: rightAnimation 1s ease-in;
            opacity: 1;
        }


        @keyframes rightAnimation {
            0% {
                transform: translateX(-100%);
                opacity: 0;
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .pjTitle {
            animation: topAnimation 1s ease-in;
            opacity: 1;
        }

        @keyframes topAnimation {
            0% {
                transform: translateY(-100%);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>

</head>

<body>
    <div class="container">


        <div class="row mt-5">
            <div class="row m-auto pjTitle">
                <img src="{{ asset('uploadfile/prstitle.png') }}" alt="" class="pjtitle">

            </div>
            <div class="col-6 pjImage">
                <img src="{{ asset('uploadfile/product.png') }}" alt="" class="">
            </div>
            <div class="col-6 mt-5">
                <div class="text-info">
                    <h4 class="text-center w-75 login">Login Form</h4>
                </div>

                @if (session('fail'))
                <div class="alert alert-danger w-75">
                    {{ session('fail') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger w-75" id="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('check.employee') }}" method="POST" class="loginForm">
                    @csrf
                    @method('POST')
                    <div class="form-group w-75">
                        <label for="employee_id">Employee ID</label>
                        <input type="text" class="form-control border border-info loginFild" placeholder="Enter employee ID" name="employee_id" value="{{ old('employee_id') }}">
                    </div>

                    <div class="form-group w-75">
                        <label for="password">Password</label>
                        <input type="password" class="form-control border border-info loginFild" placeholder="Enter your password" name="password" value="{{ old('password') }}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-info w-75 text-center loginFild mt-4">Login</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>