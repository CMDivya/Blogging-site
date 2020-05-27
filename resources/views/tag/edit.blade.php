
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<form action="/tag/{{$tag->id}}/update" method="POST">
@csrf()
@method('PUT')
<div class="jumbotron"style="background-color:#ccebff;">
<div class="form-group">
      <h2><label for="Name">Update Tag</label></h2>

  </div>
    <div class="form-group">
      <label for="Name">Name</label>
      <input type="text" class="form-control" name="name" id="name" value="{{$tag->name}}"placeholder=" Tag Name ">

  <button href="" type="Submit" class="btn btn-primary">Update Tag</button>
  </div>

</form>
</body>
</html>
