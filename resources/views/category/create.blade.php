<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<form action="/category/store" method="POST">
@csrf()
<div class="jumbotron"style="background-color:#ccebff;">
<div class="form-group">
      <h2><label for="Name">Description</label></h2>

  </div>
  
  <!--@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif-->
  
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Enter Category Name">
  </div>
  @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
  <div class="form-group">
    <label for="description">Description</label>
  </div>
  @error('description')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
  <div class="form-group">
    <textarea rows="5" cols="184" name="description" id="description" placeholder="Enter Category Description"></textarea>
  </div>
  <button type="Submit" class="btn btn-primary">Add Description</button>
  </div>
  
</form>
</body>
</html>