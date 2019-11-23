<?php

namespace App\Http\Controllers\ManajemenPeserta;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;

use DB;
use Mail;

use App\Mail\APL01Verified;
use App\Mail\APL01Rejected;
use App\Mail\PaymentVerified;
use App\Mail\SendVerificationEmail;
use App\Mail\SendPaymentEmail;

use App\Models\Member;
use App\Models\MemberCertification;
use App\Models\MemberCertificationPayment;

use App\Jobs\CreateAPL02;

class MemberController extends Controller
{
	public function __construct()
	{

	}

	public function index()
	{
		return view('ManajemenPeserta.index');
	}

	public function getPesertaData(DataTables $dataTables)
	{
		$data = Member::query();

		$json = $dataTables->eloquent($data)
		->addColumn('action', function ($member) {
			if ($member->status == 1)
            $action = "<a href='".route('peserta.email', ['token' => $member->token])."' class='btn btn-sm btn-icon btn-clean btn-icon-sm' title='Kirim Email Verifikasi' data-original-tooltip='Kirim Email Verifikasi'>
                      <i class='la la-envelope'></i>
                    </a>";
            else {
            	$action = null;
            }

            return $action;
        })
        ->editColumn('status', function ($m) {
        	return $m->status == 2 ? 'Aktif': 'Non-aktif';
        })
        ->make(true);

		return $json;
	}

	public function APL01()
	{
		return view('ManajemenPeserta.APL01');
	}

	public function getAPL01Data(DataTables $dataTables)
	{
		$data = MemberCertification::with(['members', 'schedules', 'schedules.programs'])
		->orderBy('created_at', 'asc')
		->select('member_certification.*');

		return $dataTables->eloquent($data)
		->editColumn('payment_file', function ($c) {
			return $c->payment_file ? '<a href="'.env('GOOGLE_CLOUD_STORAGE_API_URI').$c->payment_file.'" target="_blank"/><i class="la la-file"></i> View</a>' : null;
		})
		->editColumn('status', function ($c) {
			$s = null;

			if ($c->status == 1) {
				$s = 'Diterima';
			} else if ($c->status == 2) {
				$s = 'Menunggu Pembayaran';
			} else if ($c->status == 3) {
				$s = 'Menunggu APL02';
			} else {
				$s = 'Ditolak';
			}

			return $s;
		})
		->addColumn('actions', function ($c) {
			$action = "<a href='".route('peserta.pendaftaran.sertifikasi.apl01', ['token' => $c->token])."' class='btn btn-sm btn-icon btn-clean btn-icon-sm'>
                              <i class='la la-eye'></i>
                            </a>";

            return $action;
		})
		->rawColumns(['actions', 'payment_file'])
		->make(true);
	}

	public function getPaymentData(DataTables $dataTables)
	{
		$data = MemberCertificationPayment::with(['certification', 'certification.schedules.programs']);

		return $dataTables->eloquent($data)
		->editColumn('payment_file', function ($c) {
			return $c->payment_file ? '<a href="'.env('GOOGLE_CLOUD_STORAGE_API_URI').$c->payment_file.'" target="_blank"/><i class="la la-file"></i> Click</a>' : null;
		})
		->editColumn('status', function ($c) {
			return $c->status == 2 ? 'Diverifikasi' : 'Diterima';
		})
		->addColumn('actions', function ($c) {
			if ($c->status == 1) {
			$action = "<a href='".route('peserta.pendaftaran.sertifikasi.pembayaran.confirm', ['id' => $c->id])."' class='btn btn-sm btn-icon btn-clean btn-icon-sm' title='Approve' data-original-tooltip='Approve'>
                              <i class='la la-check'></i>
                            </a>";
            } else {
            	$action = null;
            }
            return $action;
		})
		->rawColumns(['actions', 'payment_file'])
		->make(true);
	}

	public function viewAPL01($token)
	{
		$c = MemberCertification::with(['members', 'apl01', 'schedules', 'schedules.programs', 'apl02'])->where('token', $token)->firstOrFail();
		
		$units = [];
		if ($c->apl02->count() > 0) {
			$units = $c->schedules->programs->unit_kompetensi;
			//dd($units[0]->elements[0]->kuk[0]->kuk02);
		}

		return view('ManajemenPeserta.viewAPL01',compact('c', 'units'));
	}

	public function verifyAPL01()
	{
		try {
			DB::beginTransaction();

			$cert = MemberCertification::where('token', request('token'))->firstOrFail();
			$cert->status = 2;
			$cert->updated_at = date('Y-m-d H:i:s');
			$cert->save();

			Member::where('id', $cert->member_id)
			->update([
				'ktp_verified' => request('ktp_verified'),
				'foto_verified' => request('foto_verified'),
				'ijazah_verified' => request('ijazah_verified'),
				'skb_verified' => request('skb_verified')
			]);

			DB::commit();

			Mail::to($cert->members->email)->send(new APL01Verified($cert));
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
		}

		return redirect()->route('peserta.pendaftaran.sertifikasi');

	}

	public function rejectAPL01()
	{
		try {
			DB::beginTransaction();

			$cert = MemberCertification::where('token', request('token'))->firstOrFail();
			$cert->status = 0;
			$cert->updated_at = date('Y-m-d H:i:s');
			$cert->save();

			DB::commit();

			Mail::to($cert->members->email)->send(new APL01Rejected($cert));
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
		}

		return redirect()->route('peserta.pendaftaran.sertifikasi');

	}

	public function viewPaymentList()
	{
		return view('ManajemenPeserta.paymentList');
	}

	public function viewPayment($id)
	{
		$p = MemberCertificationPayment::findOrFail($id);
		return view('ManajemenPeserta.viewPayment', compact('p'));
	}

	public function sendPaymentEmail()
	{
		$cert = MemberCertification::where('token', request('token'))->firstOrFail();
		Mail::to($cert->members->email)->send(new SendPaymentEmail($cert));

		return redirect()->route('peserta.pendaftaran.sertifikasi');
	}

	public function verifyAPL01Payment()
	{
		try {
			DB::beginTransaction();

			$pay = MemberCertificationPayment::where('id', request('id'))->firstOrFail();
			$pay->status = 2;
			$pay->updated_at = date('Y-m-d H:i:s');
			$pay->save();

			$cert = MemberCertification::findOrFail($pay->member_certification_id);
			$cert->status = 3;
			$cert->updated_at = date('Y-m-d H:i:s');
			$cert->save();

			CreateAPL02::dispatch($cert);

			DB::commit();

			Mail::to($cert->members->email)->send(new PaymentVerified($cert));
		} catch (\Exception $e) {
			DB::rollBack();
			dd($e);
		}

		return redirect()->route('peserta.pendaftaran.sertifikasi');
	}

	public function sendVerificationEmail()
	{
		$member = Member::where('token', request('token'))->firstOrFail();
		Mail::to($member->email)->send(new SendVerificationEmail($member));

		return redirect()->route('peserta.pendaftaran');
	}
}