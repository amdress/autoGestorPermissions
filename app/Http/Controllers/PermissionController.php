<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller implements HasMiddleware
{
    // TODO> Middleware
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view permissions', only: ['index']),
            new Middleware('permission:edit permissions', only: ['edit']),
            new Middleware('permission:create permissions', only: ['create']),
            new Middleware('permission:delete permissions', only: ['destroy']),
        ];
    }
    //TODO> will show the permissions-list page
    public function index() {

        $permissions = Permission::orderBy('created_at', 'DESC')->paginate(25);

        return view('permissions.list', ['permissions' => $permissions]);
    }

    //TODO> will show the create permission page
    public function create() {
        return view('permissions.create');
    }

    //TODO> will insert permission in the database
    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions|min:3'
        ]);

        if ($validator->passes()) {   
            

            Permission::create(['name' => $request->name]);
            
            return redirect()->route('permissions.index')->with('success', 'Permissions added successfuly');

        } else {
            return redirect()->route('permissions.create')
                ->withInput()
                ->withErrors($validator); 
        }
    }

    //TODO> will show edit permission page
    public function edit( $id) {

        $permission = Permission::findOrFail($id);

        return view('permissions.edit', [
            'permission' => $permission
        ]);
    }

    //TODO> will update a permission 
    public function update($id, Request $request) {

        $permission = Permission::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:permissions,name, '.$id.',id'
        ]);

        if ($validator->passes()) {   
          

            $permission->name = $request->name;
            $permission->save();
            
            return redirect()->route('permissions.index')->with('success', 'Permissions update successfuly');

        } else {
            return redirect()->route('permissions.edit', $id)
                ->withInput()
                ->withErrors($validator); 
        }

    }



    //TODO> will delete a permission 
    public function destroy(Request $request) {

        $id = $request->id;

        $permission = Permission::find($id);

        if($permission == null){

            session()->flash('error', 'Permission not Found');
            return response()->json([
                'status' => false
            ]);
        }

        $permission->delete();

        session()->flash('success', 'Permission delete successfuly');
        return response()->json([
            'status' => true
        ]);

    }
}
