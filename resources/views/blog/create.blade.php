<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<form action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data">
@csrf()
<div class="jumbotron"style="background-color:#ccebff;">
<div class="form-group">
      <h2><label for="Name">Create Your Blog</label></h2>
  </div>
 

    <div class="form-group">
      <label for="Name">Blog Title</label>
      <input type="text" class="form-control" name="title" id="name" placeholder="Enter Blog Title">
  </div>
  @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

  <div class="form-group">
    <label for="description">Write Blog</label>
  </div>
  <div class="form-group">
    <textarea rows="5" cols="184" name="description" id="description" placeholder="Enter blog Description"></textarea>
  </div>
  @error('description')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="image">Add Image</label>
  </div>
  <div class="form-group">
  <input name="image" type="file" class="form-control" id="image">
  </div>

  <div class="form-group">
    <label for="category">Blog Category</label>
  </div>
  <div>
  <select class="browser-default custom-select" name="category_id">
  <option selected>Select Blog category</option>
  @foreach($categories as $category)
  <option value="{{$category->id}}">{{$category->name}}</option>
  @endforeach
</select>
</div>
@error('category_id')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="tag">Select Tag</label>
  </div>
<div>
<select class="mdb-select md-form colorful-select dropdown-danger" name="tag_id[]" multiple>
  <option value="" disabled selected>Choose your tags</option>
  @foreach($tags as $tag)
<option value="{{$tag->id}} "> {{$tag->name}} </option>
@endforeach
</select>
</div>
@error('tag_id')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div>
<button type="Submit" class="btn btn-primary">Save Blog</button>
</div>
</form>
</body>
</html>