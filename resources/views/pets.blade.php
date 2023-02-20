<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>
                    Pets
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6 text-center">
                <div class="card">
                    <div class="card-header">
                        Add pet
                    </div>
                    <div class="card-body">
                        <form action="/pet" method="post" class="d-block">
                            @csrf
                            <div class="col-12">
                                <label for="">Name</label>
                                <input type="text" name="name">
                            </div>
                            <div class="col-12" id="singleUrl">
                                <label for="">Photo url</label>
                                <input type="text" name="photoUrls[]">
                            </div>
                            <div class="button btn btn-primary m-1" id="addNextUrl">
                                Add next url
                            </div>
                            <div class="col-12" id="singleUrl">
                                <label for="">Category name</label>
                                <input type="text" name="category[name]">
                            </div>

                            <div class="col-12" id="singleTag">
                                <label for="">Tag name</label>
                                <input type="text" name="tags[][name]">
                            </div>
                            <div class="button btn btn-primary m-1" id="addTag">
                                Add tag
                            </div>
                            
                            <div class="col-12">
                                <label for="">Status</label>
                                <select name="status" id="">
                                    <option value="available">Available</option>
                                    <option value="pending">Pending</option>
                                    <option value="sold">Sold</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <input type="submit" value="Submit" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header text-center">
                        Find by status
                    </div>
                    <div class="card-body d-block">
                        <label for="status" class="text-center">
                            Type status seperated by comma and space
                        </label>
                        <input type="text" name="statusQueryStringName" id="statusQueryString">
                        <button class="btn btn-primary w-100 mt-2" id="searchByStatus">
                            Search
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header text-center">
                        Find by id
                    </div>
                    <div class="card-body d-block text-center">
                        <label for="status" class="text-center">
                            Type pet id
                        </label>
                        <input type="text" name="statusQueryString" id="idSlug">
                        <button class="btn btn-primary w-100 mt-2" id="searchById">
                            Search
                        </button>
                    </div>
                </div>
            </div>
        

            <table class="table mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Photo Urls</th>
                    <th scope="col">Status</th>
                    <th scope="col">Category id</th>
                    <th scope="col">Category name</th>
                    <th scope="col">Tag id</th>
                    <th scope="col">Tag name</th>
                    <th scope="col">Delete pet</th>
                    <th scope="col">Go to pet</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($pets as $pet)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{ $pet->id }}</td>
                        <td>{{ $pet->name }}</td>
                        <td class="d-block">
                            @foreach ($pet->photoUrls as $item)
                                <div class="">{{ $item }}</div> 
                            @endforeach
                        </td>
                        <td>{{ $pet->status }}</td>
                        <td>{{ $pet->category->id ?? '-' }}</td>
                        <td>{{ $pet->category->name ?? '-' }}</td>
                        <td class="">
                            <div class="d-block">
                                @foreach ($pet->tags as $item)
                                    <div class="">
                                        {{ $item->id }}
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td class="">
                            <div class="d-block">
                                @foreach ($pet->tags as $item)
                                    <div class="">
                                        {{ $item->name }}
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <form action="/pet/{{$pet->id}}" method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button class="btn btn-danger">
                                    DELETE
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="/pet/{{$pet->id}}">
                                <button class="btn btn-primary">
                                    ->
                                </button>
                            </a>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $(function(){
                $("#addNextUrl").on('click', function(){
                    let ele = $('#singleUrl').clone();
                    $('#singleUrl').after(ele);
                })
            })

            $(function(){
                $("#addTag").on('click', function(){
                    let ele = $('#singleTag').clone();
                    $('#singleTag').after(ele);
                })
            })

            $(function(){
                $("#searchByStatus").on('click', function(){
                    let value = $('#statusQueryString').val();
                    window.location.href = "/pet/findByStatus?status=" + value;
                })
            })

            $(function(){
                $("#searchById").on('click', function(){
                    let value = $('#idSlug').val();
                    console.log(value);
                    window.location.href = "/pet/" + value;
                })
            })
        });

        
    </script>
</body>
</html>
