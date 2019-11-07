<?php

namespace App\Http\Controllers\ManajemenPeserta;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

use Mail;
use App\Mail\APL01Verified;
use App\Mail\PaymentVerified;

use App\Models\Member;
use App\Models\MemberCertification;

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

		$json = $dataTables->eloquent($data)->addColumn('action', function ($member) {
            $action = "<a href='#' class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip'>
                              <i class='la la-search'></i>
                            </a>";

            return $action;
        })->make(true);

		return $json;
	}

	public function APL01()
	{
		return view('ManajemenPeserta.APL01');
	}

	public function getAPL01Data(DataTables $dataTables)
	{
		$data = MemberCertification::with(['members', 'schedules', 'schedules.programs'])->select('member_certification.*');

		return $dataTables->eloquent($data)
		->editColumn('payment_file', function ($c) {
			return $c->payment_file ? '<a href="'.env('GOOGLE_CLOUD_STORAGE_API_URI').'/'.$c->payment_file.'" target="_blank"/><i class="la la-file"></i> View</a>' : null;
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
		$data = MemberCertification::where('status', 2)->with(['members', 'schedules', 'schedules.programs'])->select('member_certification.*');

		return $dataTables->eloquent($data)
		->editColumn('payment_file', function ($c) {
			return $c->payment_file ? '<a href="'.env('GOOGLE_CLOUD_STORAGE_API_URI').'/'.$c->payment_file.'" target="_blank"/><i class="la la-file"></i> Click</a>' : null;
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

	public function viewAPL01($token)
	{
		$c = MemberCertification::with(['members', 'apl01', 'schedules', 'schedules.programs'])->where('token', $token)->firstOrFail();	
		return view('ManajemenPeserta.viewAPL01',compact('c'));
	}

	public function verifyAPL01()
	{
		try {
			$cert = MemberCertification::where('token', request('token'))->firstOrFail();
			MemberCertification::where('token', request('token'))
				->update([
					'status' => 2,
					'updated_at' => date('Y-m-d H:i:s')
				]);

			Mail::to($cert->members->email)->send(new APL01Verified($cert));
		} catch (\Exception $e) {
			dd($e);
		}

		return redirect()->route('peserta.pendaftaran.sertifikasi');

	}

	public function viewPaymentList()
	{
		return view('ManajemenPeserta.paymentList');
	}

	public function verifyAPL01Payment()
	{
		try {
			$cert = MemberCertification::where('token', request('token'))->firstOrFail();
			MemberCertification::where('token', request('token'))
				->update([
					'status' => 3,
					'updated_at' => date('Y-m-d H:i:s')
				]);

			CreateAPL02::dispatch($cert);
			Mail::to($cert->members->email)->send(new PaymentVerified($cert));
		} catch (\Exception $e) {
			dd($e);
		}

		return redirect()->route('peserta.pendaftaran.sertifikasi');
	}
}