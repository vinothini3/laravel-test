<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .container {
                max-width: 600px;
                margin: 50px auto;
                text-align: left;
                font-family: sans-serif;
            }
            form {
                /*border: 1px solid #1A33FF;*/
                /*background: #ecf5fc;*/
                padding: 40px 50px 45px;
            }
            .form-control:focus {
                border-color: #000;
                box-shadow: none;
            }
            label {
                font-weight: 600;
            }
            .error {
                color: red;
                font-weight: 400;
                display: block;
                padding: 6px 0;
                font-size: 14px;
            }
            .form-control.error {
                border-color: red;
                padding: .375rem .75rem;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <a href="{{ route('list') }}">Go Back</a>


            <div class="">
                @if(count($errors) > 0)
                    <p class="alert-danger text-center">
                        @foreach($errors->all() as $error)
                            {{ $error }}
                            <br>
                        @endforeach
                    </p>
                @endif
                @if(Session::has('success'))
                    <p class="alert-success text-center">
                        {{ Session::get('success') }}
                    </p>
                @endif
            </div>
            <div>
            <div>
                <form method="post" action="{{ route('update', $userData->id) }}">
                    @csrf
                    @method('PUT')

                    <div>
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $userData->name }}">
                    </div>

                    <div>
                        <label>Age</label>
                        <input type="number" name="age" value="{{ $userData->age }}">
                    </div>
                    <div>
                        <label>Gender : </label>
                        <select name="gender">
                            <option {{ ($userData->gender == 'Male') ? "selected" : '' }} value="1">Male</option>
                            <option {{ ($userData->gender == 'Female') ? "selected" : '' }} value="2">Female</option>
                        </select>
                    </div>
                    <div>
                        <label>Willing to Work : </label>
                        <input {{ ($userData->willing_to_work == 'yes') ? "checked" : '' }} type="radio" name="willing_to_work" value="yes"> Yes
                        <input {{ ($userData->willing_to_work == 'no') ? "checked" : '' }} type="radio" name="willing_to_work" value="no"> No
                    </div>

                    <div>
                        <label>Language known : </label>
                        @foreach($userData->languages as $language)
                            @php $languages[] = $language->language @endphp
                        @endforeach
                        <input {{ in_array('English', $languages) ? "checked" : '' }} type="checkbox" name="languages[]" value="1"> English
                        <input {{ in_array('French', $languages) ? "checked" : '' }} type="checkbox" name="languages[]" value="2"> French
                        <input {{ in_array('Spanish', $languages) ? "checked" : '' }} type="checkbox" name="languages[]" value="3"> Spanish
                        <input {{ in_array('Chinese', $languages) ? "checked" : '' }} type="checkbox" name="languages[]" value="4"> Chinese
                    </div>

                    <div>
                        <button type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
