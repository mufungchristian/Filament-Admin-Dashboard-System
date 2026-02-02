<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'sku' => strtoupper($this->faker->unique()->bothify('SKU-#####')),
            'description' => $this->faker->optional()->paragraph(),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'supplier_id' => $this->faker->boolean(70) ? (Supplier::inRandomOrder()->first()->id ?? Supplier::factory()) : null,
            'purchase_price' => $this->faker->randomFloat(2, 10, 200),
            'selling_price' => $this->faker->randomFloat(2, 20, 300),
            'current_stock' => $this->faker->numberBetween(0, 200),
            'minimum_stock' => $this->faker->numberBetween(0, 20),
            'unit' => $this->faker->randomElement(['pcs', 'kg', 'liters', 'box']),
            'barcode' => $this->faker->optional()->ean13(),
            'image' => $this->faker->optional()->imageUrl(),
            'is_active' => $this->faker->boolean(95),
        ];
    }
}
