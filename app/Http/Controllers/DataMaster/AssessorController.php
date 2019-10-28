<?php

namespace App\Http\Controllers\DataMaster;

use App\Models\Assessor;
use App\Models\Program;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Storage;
use Yajra\DataTables\DataTables;
use function GuzzleHttp\Psr7\str;

class AssessorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Assessor']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('DataMaster.AssessorController.index');
    }

    /**
     * Method untuk retrieve data Assessor untuk feed datatable dihalaman index assessor
     *
     * @param DataTables $dataTables
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getAssessorData(DataTables $dataTables)
    {
        $assessor = Assessor::query();

        $assessorJson = $dataTables->eloquent($assessor)->addColumn('action', function (Assessor $assessor) {
            $action = "<a href='" . route('assessor.show', ['assessor' => $assessor]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='View ".$assessor->name."' data-original-tooltip='View ".$assessor->name."'>
                              <i class='la la-search'></i>
                            </a>";
            if (auth()->user()->can('Assessor Edit')) {
                $action .= "<a href='" . route('assessor.edit', ['assessor' => $assessor]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm' data-toggle='kt-tooltip' title='Edit' data-original-tooltip='Edit'>
                              <i class='la la-edit'></i>
                            </a>";
            }
            if (auth()->user()->can('Assessor Delete')) {
                $action .= "<a href='" . route('assessor.delete', ['assessor' => $assessor]) . "' class='btn btn-sm btn-icon btn-clean btn-icon-sm delconfirm' data-toggle='kt-tooltip' title='Hapus' data-original-tooltip='Hapus'>
                              <i class='la la-trash'></i>
                            </a>";
            }

            return $action;
        })->editColumn('company', function (Assessor $assessor) {
            return strtoupper($assessor->company) . ' (' . $assessor->position . ')';
        })->escapeColumns([])->make(true);

        return $assessorJson;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('Assessor Add')) {
            $assessor = null;
            $program  = Program::all();
            return view('DataMaster.AssessorController.create', compact('assessor', 'program'));
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menambah Assessor');
        }
        return redirect()->route('assessor.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('Assessor Add')) {
            $message = '';
            $request->validate([
                                   'name'               => 'required',
                                   'password'           => 'required|confirmed',
                                   'assessment_ability' => 'required'
                               ]);

            $assessor = new Assessor($request->all());

            /** Cek jika ada foto upload */
            $imgName = null;
            if ($request->hasFile('pasfoto')) {
                $image = $request->file('pasfoto');

                /** set nama file foto untuk diupload */
                $name           = $request->get('name');
                $name           = Str::slug($name);
                $imgName        = $name . '-' . time() . '.' . $image->getClientOriginalExtension();
                $assessor->foto = $imgName;
            }

            /** Simpan data ke database */
            if ($assessor->save()) {

                /** Proses upload foto
                 *  1. Cek apakah folder sudah ada atau belum, create jika belum ada
                 */
                if ($imgName) {
                    $uploadPath = 'upload/backend/assessor/' . $assessor->id;
                    if (!Storage::has($uploadPath)) {
                        Storage::makeDirectory($uploadPath);
                    }
                    $imageResize = Image::make($image)->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    $putFile     = Storage::put($uploadPath . '/' . $imgName, $imageResize);
                }

                /** Menyimpan data user account, tapi sebelumnya cek dahulu apakah sudah punya user account atau belum */
                $cekUser = User::where('email', $request->get('email'))->first();
                if (!$cekUser) {
                    /** Jika belum ada maka buat user akun baru */
                    $user                    = new User();
                    $user->name              = $request->get('name');
                    $user->email             = $request->get('email');
                    $user->password          = bcrypt($request->get('password'));
                    $user->email_verified_at = date('Y-m-d H:i:s');
                    $user->save();
                    $message .= "<br/>Berhasil membuat user dengan akun '{$user->email}'";

                    /** Attach Role */
                    $user->assignRole('Assessor');
                    $message .= "<br/>Berhasil menambah Role Assessor";
                } else {
                    /** Jika sudah ada maka tidak buat akun baru dan tambahkan Role Assesor ke akun tersebut */
                    $message .= "<br/>User akun dengan email '{$cekUser->email}' sudah ada. Tidak membuat akun baru";

                    /** Attach Role */
                    if (!$cekUser->hasRole('Assessor')) {
                        $cekUser->assignRole('Assessor');
                    }
                }

                flash()->success('Berhasil menyimpan data Assessor.' . $message);
            } else {
                flash()->error('Gagal menyimpan data Assessor, mohon untuk mencoba kembali');
            }
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menambah Assessor');
        }

        return redirect()->route('assessor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Assessor $assessor)
    {
        return view('DataMaster.AssessorController.show', compact('assessor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Assessor $assessor)
    {
        if (auth()->user()->can('Assessor Edit')) {
            $program = Program::all();
            return view('DataMaster.AssessorController.edit', compact('program', 'assessor'));
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk mengubah Assessor');
        }
        return redirect()->route('assessor.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Assessor $assessor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assessor $assessor)
    {
        if (auth()->user()->can('Assessor Edit')) {
            $message = '';
            /** Set form validation */
            $request->validate([
                                   'name'               => 'required',
                                   'password'           => 'confirmed',
                                   'assessment_ability' => 'required'
                               ]);

            /** Get Updated data Assessor */
            $update = [
                'name'               => $request->get('name'),
                'mobile_phone'       => $request->get('mobile_phone'),
                'company'            => $request->get('company'),
                'position'           => $request->get('position'),
                'status'             => $request->get('status'),
                'profile'            => $request->get('profile'),
                'assessment_ability' => $request->get('assessment_ability'),
            ];

            /** @var  $updateUser | Get updated data akun assessor */
            $updateUser = [
                'name' => $request->get('name')
            ];

            /** Cek Password jika ada perubahan */
            $password = $request->get('password');
            if (!empty($password)) {
                $updateUser['password'] = bcrypt($password);
            }

            /** Cek jika ada foto upload */
            $imgName = null; $imgOldName = $assessor->foto;
            if ($request->hasFile('pasfoto')) {
                $image = $request->file('pasfoto');

                /** set nama file foto untuk diupload */
                $name           = $request->get('name');
                $name           = Str::slug($name);
                $imgName        = $name . '-' . time() . '.' . $image->getClientOriginalExtension();
                $update['foto'] = $imgName;
            }

            if ($assessor->update($update)) {

                /** Proses upload foto
                 *  1. Cek apakah folder sudah ada atau belum, create jika belum ada
                 */
                if ($imgName) {
                    $uploadPath = 'upload/backend/assessor/' . $assessor->id;
                    /** Cek dir jika belum ada maka buat */
                    if (!Storage::has($uploadPath)) {
                        Storage::makeDirectory($uploadPath);
                    }
                    /** Cek file yang sebelumnya, jika ada maka hapus */
                    if (Storage::exists($uploadPath.'/'.$imgOldName)) {
                        Storage::delete($uploadPath.'/'.$imgOldName);
                    }
                    /** @var  $imageResize | Proses resize image yang diupload, setelah itu upload ke cloud */
                    $imageResize = Image::make($image)->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    $putFile     = Storage::put($uploadPath . '/' . $imgName, $imageResize);
                }

                /**
                 * Melakukan perubahan User Akun Asseessor
                 */
                $assessorAkun = User::where('email', $assessor->email)->first();
                if ($assessorAkun->update($updateUser)) {
                    $message .= "<br/>Berhasil update data akun '{$assessorAkun->email}'";
                }
                flash()->success('Berhasil melakukan perubahan data Assessor '.$message);
            } else {
                flash()->error('Gagal melakukan perubahan data Assessor');
            }



        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk mengubah Assessor');
        }
        return redirect()->route('assessor.index');
    }

    /**
     * Remove the specified resource from storage. Untuk menghapus data Assessor
     *
     * @param Assessor $assessor
     * @return void
     */
    public function delete(Assessor $assessor)
    {
        if (auth()->user()->can('Assessor Delete')) {
            
        } else {
            flash()->error('Maaf, Anda tidak mempunyai akses untuk menghapus data Assessor');
        }
        return redirect()->route('assessor.index');
    }
}
