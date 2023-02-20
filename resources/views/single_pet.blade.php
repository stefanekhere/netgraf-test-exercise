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
                    Single Pet
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
            <div class="col-12 text-center">
                <div class="card">
                    <div class="card-header">
                        Pet
                    </div>
                    <div class="card-body">
                        <form action="/pet" method="post" class="d-block">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="col-12">
                                <label for="">ID</label>
                                <input type="text" name="id" value="{{$pet->id}}" readonly>
                            </div>
                            <div class="col-12">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{$pet->name}}">
                            </div>
                            @foreach ($pet->photoUrls as $item)
                                <div class="col-12" id="singleUrl">
                                    <label for="">Photo url</label>
                                    <input type="text" name="photoUrls[]" value="{{$item}}" class="classCnt">
                                </div>
                            @endforeach
                            <div class="button btn btn-primary m-1" id="addNextUrl">
                                Add next url
                            </div>
                            <div class="col-12" id="singleUrl">
                                <label for="">Category name</label>
                                <input type="text" name="category[name]" value="{{$pet->category->name}}">
                            </div>

                            @foreach ($pet->tags as $item)
                                <div class="col-12" id="">
                                    <label for="">Tag ID</label>
                                    <input type="text" name="tags[{{$loop->index}}][id]" value="{{$item->id}}" readonly>
                                </div>
                                <div class="col-12" id="singleTag">
                                    <label for="">Tag name</label>
                                    <input type="text" name="tags[{{$loop->index}}][name]" value="{{$item->name}}">
                                </div>
                            @endforeach
                            <div class="button btn btn-primary m-1" id="addTag">
                                Add tag
                            </div>
                            <div class="col-12">
                                <label for="">Status</label>
                                <select name="status" id="">
                                    <option value="available" {{$pet->status == 'available' ? 'selected' : ''}}>Available</option>
                                    <option value="pending" {{$pet->status == 'pending' ? 'selected' : ''}}>Pending</option>
                                    <option value="sold" {{$pet->status == 'sold' ? 'selected' : ''}}>Sold</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <input type="submit" value="Update" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $(function(){
                $("#addNextUrl").on('click', function(){
                    var ele = $('#singleUrl').clone();
                    $('#singleUrl').after(ele);
                })
            })

            $(function(){
                $("#addTag").on('click', function(){
                    var len = $('.classCnt').length-1;
                    console.log(len);
                    var str = 'tags['+len+'][name]';
                    console.log(str);

                    var ele = $('#singleTag').clone();
                    var input = ele.find("input").attr('name', str).addClass('classCnt');
                    $('#singleTag').after(ele);
                })
            })
        });
        
    </script>
</body>
</html>
