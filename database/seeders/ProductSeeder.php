<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Size;
use App\Models\Category;
use App\Models\Color;
use App\Models\Type;
use App\Models\Sign;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $sizes = Size::pluck('id')->toArray();
        $categories = Category::pluck('id')->toArray();
        $colors = Color::pluck('id')->toArray();
        $types = Type::pluck('id')->toArray();
        $signs = Sign::pluck('id')->toArray();

        Product::create([
            'name' => 'Kerudung bergo',
            'size_id' => $sizes[array_rand($sizes)],
            'category_id' => $categories[array_rand($categories)],
            'color_id' => $colors[array_rand($colors)],
            'type_id' => $types[array_rand($types)],
            'sign_id' => $signs[array_rand($signs)],
            'code' => 'KRDBG01',
            'purchase_price' => 0,
            // @AR, start
            //'selling_price' => 7000,
            'selling_price' => 500000,
            // @AR, end
            'stock' => 20,
        ]);

        Product::create([
            'name' => 'Gamis pria merah',
            'size_id' => $sizes[array_rand($sizes)],
            'category_id' => $categories[array_rand($categories)],
            'color_id' => $colors[array_rand($colors)],
            'type_id' => $types[array_rand($types)],
            'sign_id' => $signs[array_rand($signs)],
            'code' => 'GMSPR01',
            'purchase_price' => 0,
            // @AR, start
            //'selling_price' => 9000,
            'selling_price' => 500000,
            // @AR, end
            'stock' => 10,
        ]);

        Product::create([
            'name' => 'Gamis wanita putih',
            'size_id' => $sizes[array_rand($sizes)],
            'category_id' => $categories[array_rand($categories)],
            'color_id' => $colors[array_rand($colors)],
            'type_id' => $types[array_rand($types)],
            'sign_id' => $signs[array_rand($signs)],
            'code' => 'GMSWT01',
            'purchase_price' => 0,
            // @AR, start
            //'selling_price' => 9000,
            'selling_price' =>  720000,
            // @AR, end
            'stock' => 15,
        ]);
    }
}
