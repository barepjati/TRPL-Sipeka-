<?php

namespace App\Http\Livewire\Order;

use App\Models\DetailPemesanan;
use App\Models\Pemesanan;
use Livewire\Component;

class Invoice extends Component
{
    public $cariMenu, $pemesananId, $no_transaksi, $status, $nama, $total, $cart, $uang, $kembali, $user;

    /**
     * mount or construct function
     */
    public function mount($id)
    {
        $target = Pemesanan::findOrFail($id);
        $cart   = DetailPemesanan::where('transaksi_id', $id)->get();
        // dd($cart);
        if ($target) {
            $this->pemesananId  = $target->id;
            $this->no_transaksi = $target->no_transaksi;
            $this->status       = $target->status;
            $this->nama         = $target->nama;
            $this->total        = $target->total;
            $this->user         = $target->user->karyawan->nama;
            $this->cart         = $cart;
            $this->uang         = 0;
            $this->kembali      = $this->total - $this->uang;
        }
    }

    public function render()
    {
        return view('livewire.order.invoice');
    }
}
