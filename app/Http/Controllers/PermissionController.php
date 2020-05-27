<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Config;
use App\Permission;


class PermissionController extends Controller
{
    public function index(Request $request)
    {
        abort_if(!Auth::user()->hasPermission('read-permissions'), 403);
        $name=$request->name? $request->name:'';
        $permissions = Permission::search('name', $name )->paginate(config('setting.pages'));
        return view('permission.index')->withPermissions($permissions);
    }
}
