<?php

namespace App\Http\Controllers;

use App\Models\TKavlingTab;
use App\Models\TKavlingTransactionTab;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KavlingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = TKavlingTab::with([
            'status_kavling',
            'status',
            'type',
            'description',
            'images',
        ])->get();
        return view('pages.kavling', [
            'data' => $list
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function payment($id, Request $request){
        $request->validate([
            'nama_lengkap' => 'required',
            'nomor_ktp' => 'required',
            'nomor_kk' => 'required',
            'nomor_hp' => 'required',
            'email' => 'required|email',
            'upload_ktp' => 'required|image|mimes:jpg,jpeg,png|max:5048',
        ], [
            'nama_lengkap.required' => 'Silakan masukan Nama Lengkap Anda.',
            'nomor_ktp.required' => 'Silakan masukan Nomor KTP Anda.',
            'nomor_kk.required' => 'Silakan masukan Nomor KK Anda.',
            'nomor_hp.required' => 'Silakan masukan Nomor Hp Aktif Anda.',
            'email.required' => 'Silakan masukan Email Anda.',
            'email.email' => 'Email anda tidak valid.',
            'upload_ktp.required' => 'Silakan unggah foto KTP Anda.',
            'upload_ktp.image' => 'File yang diunggah harus berupa gambar.',
            'upload_ktp.mimes' => 'Format gambar harus jpg, jpeg, atau png.',
            'upload_ktp.max' => 'Ukuran gambar tidak boleh lebih dari 5MB.',
        ]);

        try {
            DB::beginTransaction();
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = false;
            $orderId = 'ORDER-' . uniqid();
            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $request->down_payment,
                ],
                'customer_details' => [
                    'first_name' => $request->nama_lengkap,
                    'phone' => $request->nomor_hp,
                    'email' => $request->email,
                ]
            ];
            TKavlingTransactionTab::create([
                'order_id' => $orderId,
                'name' => $request->nama_lengkap,
                'nomor_ktp' => $request->nomor_ktp,
                'nomor_kk' => $request->nomor_kk,
                'nomor_hp' => $request->nomor_hp,
                'email' => $request->email,
                'upload_ktp' => $request->nomor_hp,
                'payment' => $request->down_payment,
                'payment' => $request->down_payment,
                'agent_id' => isset($request->agent_id) ? $request->agent_id : null,
                'catatan' => isset($request->catatan) ? $request->catatan : null,
                't_kavling_tabs_id' => $id,
            ]);
            DB::commit();

            $snapToken = \Midtrans\Snap::createTransaction($params)->redirect_url;
            return redirect($snapToken);
        } catch (\Throwable $th) {
            DB::rollBack();
            abort(400, $th->getMessage());
        }
    }

    public function callback(Request $request){
        try {
            DB::beginTransaction();
            switch ($request->transaction_status) {
                case 'capture':
                case 'settlement':
                    $trasaction = TKavlingTransactionTab::where('order_id', $request->order_id)->first();
                    if (isset($trasaction)) {
                        $trasaction->update([
                            'm_status_id' => 8
                        ]);
                        TKavlingTab::where('id', $trasaction->t_kavling_tabs_id)->update([
                            'm_status_tabs_transaction_id' => 11
                        ]);
                    }
                    DB::commit();
                    return view('invoice.success');
                    break;
                case 'deny':
                case 'cancel':
                case 'expire':
                case 'failure':
                    TKavlingTransactionTab::where('order_id', $request->order_id)->update([
                        'm_status_id' => 9
                    ]);
                    DB::commit();
                    return view('failure.success');
                    break;
                case 'refund':
                case 'partial_refund':
                    $trasaction = TKavlingTransactionTab::where('order_id', $request->order_id)->first();
                    if (isset($trasaction)) {
                        $trasaction->update([
                            'm_status_id' => 10
                        ]);
                        TKavlingTab::where('id', $trasaction->t_kavling_tabs_id)->update([
                            'm_status_tabs_transaction_id' => 5
                        ]);
                    }
                    break;
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            abort(500, $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $detail = TKavlingTab::find($id);
        if(isset($detail)) redirect('/');
        return view('pages.detail', [
            'data' => $detail
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $detail = TKavlingTab::find($id);
        $agent = User::where('m_user_role_tabs_id',3)->get();
        if (isset($detail)) redirect('/');
        return view('pages.form', [
            'data' => $detail,
            'agent' => $agent
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function informasi()
    {
        return view('pages.informasi');
    }

    public function tentang()
    {
        return view('pages.tentang');
    }
}
