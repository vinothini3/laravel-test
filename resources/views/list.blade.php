<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Laravel CRUD</h2>
                    </div>
                    <div class="pull-right mb-2">
                        <a class="btn btn-success" href="{{ route('create') }}"> Create User</a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th> name</th>
                        <th> Age  </th>
                        <th> Gender </th>
                        <th> Willing to work</th>
                        <th> Language </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td> {{$user->name}} </td>
                            <td> {{$user->age}} </td>
                            <td> {{$user->gender}} </td>
                            <td> {{$user->willing_to_work}} </td>
                            <td> 
                                @foreach($user->languages as $lang)
                                    {{ $lang->language }}
                                    {{ $loop->last ? '' : ',' }}
                                @endforeach
                            </td>
                            <td>
                                <form action="{{ route('delete', $user->id) }}" method="post">
                                    <a class="btn btn-primary" href="{{ route('edit',$user->id) }}">Edit</a>
                                    
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
               </tbody>
            </table>

            {!! $users->links() !!}
        </div>
    </body>
</html>