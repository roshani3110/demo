<?php

namespace App\Imports;

use App\Product;
use App\ProductCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        Log::info($row);
        $unique_code = Product::where('unique_code', $row['unique_code'])->distinct()->get();
        Log::info($unique_code);
        if(count($unique_code) == 0){   
            $category = ProductCategory::where('name', $row['category'])->first();
            if ($category != null) {
                $category = $category;
            } else {
                $category = ProductCategory::create(['name' => $row['category']]);
            }         
            return Product::updateOrCreate([
                'unique_code' => $row['unique_code'],
            ], [
                'name'    => $row['product_name'], 
                'description' => $row['description'],
                'category_id'     => $category->id            
            ]);            
        }
    }
}
