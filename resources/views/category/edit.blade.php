
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<form action="{{route('category.update', $category->slug)}}" method="POST">
@csrf()
@method('PUT')
<div class="jumbotron"style="background-color:#ccebff;">
<div class="form-group">
      <h2><label for="Name">Update Category</label></h2>

  </div>
    <div class="form-group">
      <label for="Name">Name</label>
      <input type="text" class="form-control" name="name" id="name" value="{{$category->name}}"placeholder=" Category Name ">

  </div>
  <div class="form-group">
    <label for="description">Description</label>
  </div>
  <div class="form-group">
    <textarea rows="5" cols="184" name="description"  id="description" placeholder="Enter Category Description">{{$category->description}}</textarea>
  </div>
  <button href="" type="Submit" class="btn btn-primary">Update Category</button>
  </div>

</form>
</body>
</html>
