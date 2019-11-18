<?php

namespace App\Http\Controllers\PengaturanAplikasi;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:User']);
    }

    /**
     * Method untuk menampilkan data user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('PengaturanAplikasi.UserController.index');
    }

    /**
     * Method untuk suply data untuk datatable pada halaman index permission
     *
     * @param DataTables $dataTables
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getData(DataTables $dataTables)
    {
        $users = User::query();

        $userJson = $dataTables->eloquent($users)->addColumn('action', function (User $users) {
            $action = '';
            if (auth()->user()->can('User Edit')) {
                $action .= "<a href='" . route('user.edit', ['user' => $users]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm' data-toggle='kt-tooltip' title='Edit' data-original-tooltip='Edit'>
                              <i class='la la-edit'></i>
                            </a>";
            }
            if (auth()->user()->can('User Delete')) {
                $action .= "<a href='" . route('user.delete', ['user' => $users]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm delconfirm' data-toggle='kt-tooltip' title='Hapus' data-original-tooltip='Hapus'>
                              <i class='la la-trash'></i>
                            </a>";
            }
            if (auth()->user()->can('User Permission')) {
                $action .= "<a href='" . route('user.permission', ['user' => $users]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='Role Permission' data-original-title='Role Permission'>
                          <i class='la la-lock'></i>
                        </a>";
            }

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
        if (auth()->user()->can('User Add')) {
            $user = null;
            $role = Role::all()->pluck('name', 'id')->put(0, 'Pilih Role')->sortKeys();
            return view('PengaturanAplikasi.UserController.create', compact('role', 'user'));
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menambah User');
            return redirect()->route('user.index');
        }
    }

    /**
     * Method untuk proses menyimpan data user ke database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('User Add')) {
            $request->validate([
                                   'name'     => 'required',
                                   'email'    => 'required|email|unique:users',
                                   'password' => 'required|confirmed',
                                   'role'     => 'required'
                               ]);

            $user           = new User($request->all());
            $password       = $request->get('password');
            $password       = bcrypt($password);
            $user->password = $password;
            if ($user->save()) {
                /** Attach Role */
                $role_id = $request->get('role');
                $role    = Role::findById($role_id);
                $user->assignRole($role);

                flash()->success('Sukses menambah User baru');
            } else {
                flash()->error('Gagal menambah User baru');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menambah User');
        }

        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        if (auth()->user()->can('User Edit')) {
            $role = Role::all()->pluck('name', 'id')->put(0, 'Pilih Role')->sortKeys();
            return view('PengaturanAplikasi.UserController.edit', compact('user', 'role'));
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk mengubah User');
            return redirect()->route('user.index');
        }
    }

    public function update(Request $request, User $user)
    {
        if (auth()->user()->can('User Edit')) {
            $request->validate([
                                   'name'     => 'required',
                                   'password' => 'confirmed',
                                   'role'     => 'required'
                               ]);
            /** @var  $update - Buat array untuk tampung data */
            $update = [
                'name' => $request->get('name'),
                'role' => $request->get('role')
            ];
            /** @var  $new_password - Set Password baru jika ada perubahan */
            $new_password = $request->get('password');
            if ($new_password) {
                $new_password       = bcrypt($new_password);
                $update['password'] = $new_password;
            }

            if ($user->update($update)) {
                /** @var  $role_id - Sync Role ke data user */
                $role_id = $request->get('role');
                $role    = Role::findById($role_id);
                $user->syncRoles($role);

                flash()->success('Berhasil mengubah data User');
            } else {
                flash()->error('Gagal mengubah data user ke database');
            }

        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk mengubah data User');
        }
        return redirect()->route('user.index');
    }

    public function delete(User $user)
    {
        if (auth()->user()->can('User Delete')) {
            if ($user->delete()) {
                flash()->success('Berhasil menghapus data User');
            } else {
                flash()->error('Gagal menghapus data User');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menghapus User');
        }

        return redirect()->route('user.index');
    }

    public function permission()
    {

    }
}
