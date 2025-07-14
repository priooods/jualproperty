<?php

namespace App\Http\Controllers;

use App\Models\TKavlingTab;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = null;
        if ($request->has('title') && $request->filled('title')) {
            $query = $request->query('title');
        }
        $imageList = array(
            ['title' => 'Bantarwangi Residence Hills', 'path' => 'images/kav1.jpg'],
            ['title' => 'Kavling di tengah kota Serang', 'path' => 'images/kav2.jpeg'],
            ['title' => 'Tersedia kavling berbagai ukuran', 'path' => 'images/kav3.jpg'],
        );
        if (isset($query)) {
            $list = TKavlingTab::where('m_status_tabs_transaction_id', 5)->where('title', 'like', '%' . $query . '%')
                ->where('m_status_tabs_id', 4)
                ->with([
                    'status_kavling',
                    'status',
                    'type',
                    'description',
                    'images',
                ])->get();
        } else {
            $list = TKavlingTab::where('m_status_tabs_transaction_id', 5)
                ->where('m_status_tabs_id', 4)
                ->with([
                    'status_kavling',
                    'status',
                    'type',
                    'description',
                    'images',
                ])->get();
        }
        $listAll = TKavlingTab::where('m_status_tabs_id', 4)
            ->with([
                'status_kavling',
                'status',
                'type',
                'description',
                'images',
            ])
            ->get();
        return view('pages.beranda' , [
            'imageList' => $imageList,
            'data' => $list,
            'list' => $listAll,
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
}
