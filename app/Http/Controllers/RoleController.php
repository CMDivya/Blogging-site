<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\config;
use App\Permission;
use App\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/
    public function index(Request $request)
    {
        abort_if(!Auth::user()->hasPermission('read-roles'), 403);

        $name=$request->name ? $request->name :'';
        $roles = Role::search('name', $name)->paginate(config('setting.pages'));
        return view('role.index')->withRoles($roles)->withName($name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        abort_if(!Auth::user()->hasPermission('create-roles'), 403);
        $permissions=Permission::all();
        $roles=Role::all();
        return view('role.create')->withRoles($roles)->withPermissions($permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        abort_if(!Auth::user()->hasPermission('create-roles'), 403);
        $request->validate([
            'name'=>'required|unique:roles,title',
            'display_name'=>'required|unique:roles,title',
            'description'=>'required|max:300',
            'permission_id'=>'required',
             ]);

        $role=new Role;
        $role->name=$request->name;
        $role->display_name=$request->display_name;
        $role->description=$request->description;
        $role->save();

        $role->permissions()->sync($request->permission_id);
        return redirect()->route('role.index');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
     public function show($id)
    {
        abort_if(!Auth::user()->hasPermission('read-roles'), 403);
        $role=Role::find($id);
        
        return view('role.show')->withRole($role);
       
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // abort_if(!Auth::user()->hasPermission('update-roles'), 403);
        $permissions=Permission::all();
        $role=Role::find($id);
        return view('role.update')->withRole($role)->withPermissions($permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       abort_if(!Auth::user()->hasPermission('update-roles'), 403);
        $role= Role::find($id);
        $role->name=$request->name;
        $role->description=$request->description;
        $role->save();
        $role->permissions()->sync($request->permission_id);
        return redirect('role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
      public function destroy($id)
    {
        abort_if(!Auth::user()->hasPermission('delete-roles'), 403);
        $role= role::find($id);
        $role->delete();
        return redirect('role');
    } 

}
    




