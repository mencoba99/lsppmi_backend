<?php

namespace App\Http\Controllers\PengaturanAplikasi;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Method untuk menampilkan data user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('PengaturanAplikasi.UserController.index');
    }

    public function getData(DataTables $dataTables)
    {
        $users = User::query();

        $userJson = $dataTables->eloquent($users)->addColumn('action', function (User $users) {
            $action = "<a href='" . route('user.edit', ['user' => $users]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm' data-toggle='kt-tooltip' title='Edit' data-original-tooltip='Edit'>
                          <i class='la la-edit'></i>
                        </a>
                        <a href='" . route('user.delete', ['user' => $users]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm delconfirm' data-toggle='kt-tooltip' title='Hapus' data-original-tooltip='Hapus'>
                          <i class='la la-trash'></i>
                        </a>
                        <a href='" . route('user.permission', ['user' => $users]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='Role Permission' data-original-title='Role Permission'>
                          <i class='la la-lock'></i>
                        </a>";

            return $action;
        })->escapeColumns([])->make(true);

        return $userJson;
    }

    /**
     * Method untuk menampilkan halaman form menambah user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $role = Role::all()->pluck('name', 'id')->put(0, 'Pilih Role')->sortKeys();
        return view('PengaturanAplikasi.UserController.create', compact('role'));
    }

    /**
     * Method untuk proses menyimpan data user ke database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
                               'name'     => 'required',
                               'email'    => 'required|email|unique:users',
                               'password' => 'required|confirmed',
                               'role'     => 'required'
                           ]);

        $user = new User($request->all());
        if ($user->save()) {
            /** Attach Role */
            $role_id = $request->get('role');
            $role    = Role::findById($role_id->id);
            $user->assignRole($role);

            flash()->success('Sukses menambah User baru');
        } else {
            flash()->error('Gagal menambah User baru');
        }

        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        $role = Role::all()->pluck('name', 'id')->put(0, 'Pilih Role')->sortKeys();
        return view('PengaturanAplikasi.UserController.edit', compact('user', 'role'));
    }

    public function update(Request $request, User $user)
    {

    }

    public function delete($id)
    {

    }

    public function permission()
    {

    }
}
