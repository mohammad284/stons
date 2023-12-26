<?php

namespace App\Http\Livewire\Admin\Store;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Store;
use Illuminate\Support\Facades\Validator;

class StoreList extends AdminComponent
{
    public function render()
    {
        $products = Store::with('category')->get();
        return view('livewire.admin.store.store-list',[
            'products' => $products
        ]);
    }
}
