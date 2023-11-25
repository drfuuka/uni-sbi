<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS2D;

class BarangController extends Controller
{
    public function index()
    {
        $data['barang'] = Barang::get();

        return view('pages.admin.barang.index', $data);
    }

    public function create()
    {
        return view('pages.admin.barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang'  => ['required', 'string'],
            'jenis_barang' => ['required'],
            'status'       => ['required'],
            'pemilik'      => ['required'],
            'department'   => ['required'],
            'kondisi'      => ['required'],
        ]);

        $barcode = new DNS2D();
        $kodeBarang = generate_number('barang', 'kode_barang', 3, 'ALT');

        // Generate the barcode image and save it to a file
        $barcodeImage = $barcode->getBarcodePNG($kodeBarang, "QRCODE");
        $barcodeImagePath = 'images/barang/' . $kodeBarang . '-' . time() . '.png';

        // Save the barcode image to the public disk
        Storage::disk('public')->put($barcodeImagePath, base64_decode($barcodeImage));

        Barang::create([
            'kode_barang'  => $kodeBarang,
            'nama_barang'  => $request->nama_barang,
            'jenis_barang' => $request->jenis_barang,
            'status'       => $request->status,
            'pemilik'      => $request->pemilik,
            'department'   => $request->department,
            'barcode'      => $barcodeImagePath,
            'kondisi'      => $request->kondisi,
        ]);



        return redirect()->route('admin.barang.index');
    }

    public function edit($id)
    {
        $data['barang'] = Barang::find($id);

        return view('pages.admin.barang.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => ['required', 'string'],
            'jenis_barang' => ['required'],
            'status'       => ['required'],
            'pemilik'      => ['required'],
            'department'   => ['required'],
            'kondisi'      => ['required'],
        ]);

        $barang = Barang::findOrFail($id);

        $barang->update([
            'nama_barang'  => $request->nama_barang,
            'status'       => $request->status,
            'jenis_barang' => $request->jenis_barang,
            'pemilik'      => $request->pemilik,
            'department'   => $request->department,
            'kondisi'      => $request->kondisi,
        ]);

        return redirect()->route('admin.barang.index');
    }

    public function destroy($id)
    {   
        
        $barang = Barang::find($id);

        if(Storage::disk('public')->exists($barang->barcode)) {
            Storage::disk('public')->delete($barang->barcode);
        }

        Barang::destroy($id);

        return redirect()->route('admin.barang.index');
    }
}
