<?php

namespace App\Http\Livewire\Order;

use App\Models\DetailPemesanan;
use App\Models\Menu;
use App\Models\Pemesanan;
use Livewire\Component;
use Livewire\WithPagination;

class Detail extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $cariMenu, $pemesananId, $no_transaksi, $status, $nama, $total, $cart, $uang, $kembali;

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
            $this->cart         = $cart;
            $this->uang         = 0;
            $this->kembali      = 0;
        }
    }

    public function back()
    {
        return redirect()->route('pemesanan.index');
    }

    public function render()
    {
        return view('livewire.order.detail', [
            'menu'  => Menu::where('status', 'tersedia')
                ->where('nama', 'like', '%' . $this->cariMenu . '%')
                ->orWhere('harga', 'like', '%' . $this->cariMenu . '%')
                ->paginate(10),
        ])
            ->layout('layouts.myview', [
                'title'     => 'pemesanan',
                'subtitle'  => 'invoice',
                'active'    => 'pemesanan.index'
            ]);
    }
}
