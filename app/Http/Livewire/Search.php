<?php

namespace App\Http\Livewire;

use App\Barang;
use Livewire\Component;

class Search extends Component
{

    public $searchTerm;
    public $barang;

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $this->barang = Barang::where('namaBarang', 'ilike', $searchTerm)->get();
        return view('livewire.search');
    }
}
