<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<form action="/tag/store" method="POST">
<div class="jumbotron"  style="background-color:#ccebff; margin-top:150px;">
<h2>Show tags</h2>
<table class="table table-dark" >
<tr>
<th>Tag Name</th>
<th>Blog_list</th>
</tr>
<tr>
<td>{{$tag->name}}</td>
</tr>
<tr>
<td><a class='btn btn-info' href="/tag">Create tag</a></td>
</tr>
</table>
</div>
</form>
</body>
</html>
