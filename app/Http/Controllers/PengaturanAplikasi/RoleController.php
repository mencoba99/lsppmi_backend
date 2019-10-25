<?php

namespace App\Http\Controllers\PengaturanAplikasi;

use App\Models\PermissionModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('PengaturanAplikasi.RoleController.index');
    }

    /**
     * Method untuk retrieve data Role yang akan dikonsumsi oleh datatable pada halaman index
     *
     * @param DataTables $dataTables
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getRoleData(DataTables $dataTables)
    {
        $roles = Role::query();

        $roleJson = $dataTables->eloquent($roles)->addColumn('action', function (Role $role) {
            $action = "<a href='" . route('role.edit', ['role' => $role]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm' data-toggle='kt-tooltip' title='Edit' data-original-tooltip='Edit'>
                          <i class='la la-edit'></i>
                        </a>
                        <a href='" . route('role.delete', ['role' => $role]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm delconfirm' data-toggle='kt-tooltip' title='Hapus' data-original-tooltip='Hapus'>
                          <i class='la la-trash'></i>
                        </a>
                        <a href='" . route('role.permission', ['role' => $role]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='Role Permission' data-original-title='Role Permission'>
                          <i class='la la-lock'></i>
                        </a>";

            return $action;
        })->escapeColumns([])->make(true);

        return $roleJson;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = null;
        return view('PengaturanAplikasi.RoleController.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
                               'name'       => 'required',
                               'guard_name' => 'required'
                           ]);
        $role = Role::create(['name' => $request->get('name')]);
        if ($role) {
            flash()->success('Sukses menambah data Role');
        } else {
            flash()->error('Gagal menambah data Role');
        }

        return redirect()->route('role.create');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('PengaturanAplikasi.RoleController.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
                               'name'       => 'required',
                               'guard_name' => 'required'
                           ]);

        if ($role->update(['name' => $request->get('name')])) {
            flash()->success('Sukses mengubah data Role');
        } else {
            flash()->error('Gagal mengubah data Role');
        }
        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $role = Role::destroy($id);
        if ($role) {
            flash()->success('Berhasil menghapus Role');
        } else {
            flash()->error('Gagal menghapus Role');
        }

        return redirect()->route('role.index');
    }

    /**
     * Method untuk menampilkan permission yang dimiliki role
     *
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function permission(Role $role)
    {
        $permissions = PermissionModel::with(['children'])->where('parent_id', 0)->get();
        return view('PengaturanAplikasi.RoleController.permission', compact('role', 'permissions'));
    }

    /**
     * Method untuk menyimpan/update permission untuk role
     *
     * @param Request $request
     * @param Role $role
     * @param PermissionModel $permission
     * @return array
     */
    public function permissionStore(Request $request, Role $role, PermissionModel $permission)
    {
        $state = $request->get('state');
        $status = ['status'=>false];

        if ($state == "true") {
            $role->givePermissionTo($permission);
            $status['status'] = true;
            $status['action'] = 'attach';
        } else {
            $role->revokePermissionTo($permission);
            $status['status'] = true;
            $status['action'] = 'revoke';
        }

        echo json_encode($status,JSON_PRETTY_PRINT);
    }
}
