<html>
<head>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<h2>Show role Details</h2>
<div class="jumbotron"  style="background-color:#ccebff; margin-top:50px;">
<table class="table table-dark" >
<tr>
<th>Role Name</th>
<th>Description</th>
<th>permission Name </td>
</tr>
<tr>
<td>{{$role->name}}</td>
<td>{{$role->description}}</td>
@if($role->permissions->count()>0)
@foreach($role->permissions as  $permission)
<td>{{$permission->name}}</td>
@endforeach
@endif
</tr>
<tr>
<td><a class='btn btn-primary' href="/role">Go Back To role List</a></td>
</tr>
</table>
</div>

</div>
</body>
</html>
