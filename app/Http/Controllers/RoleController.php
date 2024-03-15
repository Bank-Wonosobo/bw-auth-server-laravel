<?php

namespace App\Http\Controllers;

use App\Http\Requests\Roles\RoleAddPermissionRequest;
use App\Http\Requests\Roles\RoleAddRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Repositories\RoleRepository;
use Spatie\Permission\Models\Permission as PermissionSpatie;

class RoleController extends Controller
{
    private RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository) {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $data = $this->roleRepository->getAllRoles();
        return view('admin.roles.index', compact('data', 'permissions', 'roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(RoleAddRequest $request)
    {
        $roleDetail =[
            'name' => $request->input('name'),
            'guard_name' => 'web',
            'label' => $request->input('label')
        ];

        $this->roleRepository->createRole($roleDetail);

        return redirect()->back()->with('success', 'Berhasil menambah role');
    }

    public function add_permission(RoleAddPermissionRequest $request){
        $data = $request->validated();

        $permissions = PermissionSpatie::create(['name' => $data['name'], 'guard_name' => 'web']);

        $permissions->assignRole($data['roles']);

        return redirect()->back()->with('success', 'Berasil menambah permission');
    }
}
