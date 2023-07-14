<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/imagehover.css/2.0.0/css/imagehover.min.css" integrity="sha512-SYBBAnJsPEzSQ/kBqkR/9krJ+EUgF624c8uaMBww1Q26pnCw5k7zVmtc48BfXjZ9MRNNBveIdhx/na1xRLWgjw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>
        @yield('title')
    </title>
    <link rel="icon" href="{{ asset('uploadfile/logo.png') }}" type="image/x-icon">


    <style>
        .body {
            margin: 0%;
            padding: 0%;
            box-sizing: border-box;
        }

        #myNav {
            background-color: #fff !important;
        }

        .btnlink {
            background-color: rgb(210, 233, 233);
            border: 1px solid #17a2b8;
            border-radius: 100px;
            width: 150px;
            color: #000;
            margin-right: 20px;
            padding: 5px;
            outline: none;

        }

        .btnlink:hover {
            background-color: #17a2b8;
            color: #fff;
            transition-duration: 0.3s;
            border: 1px solid #17a2b8;
            padding: 7px;
            font-weight: bolder;

        }

        body {
            background-color: rgb(236, 248, 249);
        }

        #routshow {
            background-color: rgb(236, 248, 249);
            z-index: 100;
        }

        .aTag:hover {
            text-decoration: none;
        }

        /* dropdown  */
        .dropbtn {
            border: none;
            cursor: pointer;
            margin-top: 5px;
            background-color: #fff;
        }

        .dropdown {
            position: relative;
            display: inline-block;

        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: rgb(210, 233, 233);
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
            border: 1px solid #17a2b8;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;


        }

        .dropdown-content a:hover {
            background-color: #17a2b8;
            color: #fff;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            /* background-color: #3e8e41; */
        }

        .image {
            border: 2px solid #fff;
            border-radius: 50%;
        }

        @yield('style')
    </style>



</head>

<body>
    <div class="container-fluid sticky-top">
        <div class="row shadow-sm py-2" id="myNav">
            <div class="col-5">
                <a href="{{ route('item.lists') }}" class="aTag">
                    <div class="row">
                        <div class="col-1">
                            <img src="{{ asset('uploadfile/logo.png') }}" alt="" width="30px" height="30px">

                        </div>
                        <div class="col-11">
                            <h3 class="title text-info">{{ trans('language.produc_registration_system') }}</h3>

                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <a href="{{ route('load.register') }}"><button class="btnlink btn">{{ trans('language.register') }}</button></a>
                <a href="{{ route('item.lists') }}"><button class="btnlink btn">{{ trans('language.list') }}</button></a>
            </div>

            <div class="col-2 d-flex flex-row-reverse mt-2">
                <div class="dropdown">
                    <a class="dropbtn">
                        <span class="text-info h6">{{ trans('language.languages') }}</span>
                        <i class="fa-solid fa-language text-info h4 text-center"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="{{ route('lang.change', 'en') }}">
                            <img src="{{ asset("uploadfile/enflag.png") }}" alt="" width="30px" class="image">
                            {{ trans('language.english') }}

                        </a>
                        <a href="{{ route('lang.change', 'my') }}">
                            <img src="{{ asset("uploadfile/mmflag.png") }}" alt="" width="30px" class="image">
                            {{ trans('language.myanmar') }}
                        </a>

                    </div>
                </div>
            </div>

            <div class="col-1 d-flex flex-row-reverse mt-2">
                <div class="dropdown">
                    <a class="dropbtn">
                        <span class="text-info h6">User</span>
                        <i class="fa-solid fa-user text-info"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="{{ route('pages.login') }}"><i class="fa-solid fa-arrow-right-from-bracket"></i>{{ trans('language.logout') }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-1" id="routshow">
            <div class="col-1"></div>
            <div class="col-11">
                @yield('route')
            </div>
        </div>
    </div>

    @yield('body')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    @stack('script')

</body>

</html>