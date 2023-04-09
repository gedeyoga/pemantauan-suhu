<?php

namespace App\Http\Controllers;

use App\Models\Perangkat;
use App\Models\PerangkatItem;
use Illuminate\Http\Request;

class PerangkatItemController extends Controller
{
    public function store(Request $request)
    {
        $perangkat = Perangkat::find($request->get('perangkat_id'));

        if(is_null($request->get('product_ids'))) {
            return redirect(route('perangkats.show', $perangkat->id))->with('warning', 'Barang belum dipilih!');
        };

        $perangkat_items = array_map( fn($product_id) => [
            'perangkat_id' => $request->geT('perangkat_id'),
            'product_id' => $product_id
        ] , $request->product_ids);

        $perangkat->perangkat_items()->createMany($perangkat_items);

        return redirect(route('perangkats.show' , $perangkat->id))->with('success', 'Barang berhasil ditambahkan ke perangkat!');
    }

    public function destroy($id) 
    {
        $perangkatItem = PerangkatItem::find($id);
        $id = $perangkatItem->perangkat_id;
        $perangkatItem->delete();

        return redirect(route('perangkats.show' , ['perangkat' => $id]))->with('success', 'Data Berhasil Dihapus');
    }
}
