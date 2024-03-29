<?php

namespace App\Http\Controllers\PengaturanAplikasi;

use App\Models\PermissionModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use DataTables;

class PermissionController extends Controller
{
    /**
     * PermissionController constructor.
     */
    public function __construct()
    {
        $this->middleware(['permission:Permission']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('PengaturanAplikasi.PermissionController.index');
    }

    /**
     * Untuk feeder data ke datatable manajemen permission
     *
     * @param \DataTables $dataTables
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPermissionData(DataTables $dataTables)
    {
        $data = PermissionModel::with(['children'])->where('parent_id', 0)->get();

        $permissionJson = DataTables::collection($data)->addColumn('action', function (PermissionModel $permission) {
            $action = '';
            if (auth()->user()->can('Permission Edit')) {
                $action .= "<a href='" . route('permission.edit', ['permission' => $permission]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm' title='Edit'>
                              <i class='la la-edit'></i>
                            </a>";
            }
            if (auth()->user()->can('Permission Delete')) {
                $action .= "<a href='" . route('permission.delete', ['permission' => $permission]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm delconfirm' title='Hapus'>
                              <i class='la la-trash'></i>
                            </a>";
            }

            return $action;
        })->editColumn('children', function (PermissionModel $permission) {
            $children    = $permission->children;
            $newChildren = [];
            if (is_object($permission->children) && $permission->children->count() > 0) {
                foreach ($permission->children as $item) {
                    $action         = "<a href='" . route('permission.edit', ['permission' => $item]) . "' class='btn btn-xs btn-icon btn-clean btn-icon-sm' title='Edit'>
                                  <i class='la la-edit'></i>
                                </a>
                                <a href='" . route('permission.delete', ['permission' => $item]) . "' class='btn btn-xs btn-icon btn-clean btn-icon-sm delconfirm' title='Hapus'>
                                  <i class='la la-trash'></i>
                                </a>";
                    $item['action'] = $action;
                    $newChildren[]  = $item;
                }
            }

            return $newChildren;
        })->escapeColumns([])->setRowClass(function ($newPermission) {
            if ($newPermission->children && $newPermission->children()->count() > 0) return 'has-child';
            else return '';
        })->make(true);

//        $permissionJson = $dataTables->eloquent($permission)->addColumn('action', function (Permission $permission) {
//            $action = "<a href='".route('permission.edit',['permission'=>$permission])."' class='btn btn-xs btn-icon btn-clean btn-icon-xs' title='Edit'>
//                          <i class='la la-edit'></i>
//                        </a>
//                        <a href='".route('permission.delete',['permission'=>$permission])."' class='btn btn-xs btn-icon btn-clean btn-icon-xs delconfirm' title='Hapus'>
//                          <i class='la la-trash'></i>
//                        </a>";
//
//            return $action;
//        })->escapeColumns([])->make(true);

        return $permissionJson;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /** Cek akses dahulu */
        if (auth()->user()->can('Permission Add')) {
            $permission     = null;
            $permissionList = Permission::where('parent_id', 0)->pluck('name', 'id')->put(0, 'Sebagai Parent')->sortKeys();
            return view('PengaturanAplikasi.PermissionController.create', compact('permission', 'permissionList'));
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menambah Permission');
            return redirect()->route('permission.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** Cek akses dahulu */
        if (auth()->user()->can('Permission Add')) {
            $request->validate([
                                   'name'       => 'required',
                                   'guard_name' => 'required'
                               ]);
            $role = Permission::create(['name' => $request->get('name'), 'parent_id' => $request->get('parent_id')]);
            if ($role) {
                flash()->success('Sukses menambah data Permission');
                return redirect()->route('permission.index');
            } else {
                flash()->error('Gagal menambah data Permission');
                return redirect()->route('permission.create');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menambah Permission');
            return redirect()->route('permission.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PermissionModel $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(PermissionModel $permission)
    {
        if (auth()->user()->can('Permission Edit')) {
            $permissionList = Permission::where('parent_id', 0)->pluck('name', 'id')->put(0, 'Sebagai Parent')->sortKeys();
            return view('PengaturanAplikasi.PermissionController.edit', compact('permission', 'permissionList'));
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk mengubah Permission');
            return redirect()->route('permission.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PermissionModel $permission)
    {
        /** Cek akses terlebih dahulu */
        if (auth()->user()->can('Permission Edit')) {
            $request->validate([
                                   'name'       => 'required',
                                   'guard_name' => 'required'
                               ]);
            $role = $permission->update(['name' => $request->get('name'), 'parent_id' => $request->get('parent_id')]);
            if ($role) {
                flash()->success('Sukses mengubah data Permission');
                return redirect()->route('permission.index');
            } else {
                flash()->error('Gagal mengubah data Permission');
                return redirect()->route('permission.edit', ['permission' => $permission]);
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk mengubah Permission');
            return redirect()->route('permission.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PermissionModel $permission
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function delete(PermissionModel $permission)
    {
        if (auth()->user()->can('Permission Delete')) {
            if ($permission->delete()) {
                flash()->success('Berhasil menghapus Permission');
            } else {
                flash()->error('Gagal menghapus permission');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menghapus Permission');
        }
        return redirect()->route('permission.index');
    }
}
