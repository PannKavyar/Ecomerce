<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Brand;
use Livewire\Component;
use App\Models\Products;

class Index extends Component
{
    public $products, $category, $brandInputs = [], $priceInput;
    protected $queryString = [
        'brandInputs' => ['except' => '', 'as' => 'brand'],
        'priceInput' => ['except' => '', 'as' => 'price'],

    ];

    public function mount($category)
    {
        $this->category = $category;
    }
    public function render()
    {
        $this->products = Products::join('brands', 'brands.id', '=', 'products.brand_id')
            ->where('products.category_id', $this->category->id)
            ->when($this->brandInputs, function ($q) {
                $q->whereIn('brands.name', $this->brandInputs);
            })
            ->when($this->priceInput, function ($q) {
                $q->when($this->priceInput == 'high-to-low', function ($q2) {
                    $q2->orderBy('products.selling_price', 'DESC');
                })
                    ->when($this->priceInput == 'low-to-high', function ($q2) {
                        $q2->orderBy('products.selling_price', 'ASC');
                    });
            })
            ->where('products.status', '0')
            ->select('products.*') // Select only columns from the products table
            ->get();

        // dd($this->products);

        return view('livewire.frontend.product.index', [
            'products' => $this->products,
            'category' => $this->category
        ]);
    }
}
