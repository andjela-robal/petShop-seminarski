<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str; 
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Voyager Reflective Dog Leash',
                'description' => 'Premium All-Purpose Dog Leash – Voyager 5’ dog leash is designed to support pet owners and dogs who lead active lifestyles which means they’re ideal for jogging, running, trips to the dog park, hiking, late-night walks, and more',
                'price' => 499.99,
                'stock' => 50,
                'category_id' => 1,
                'user_id' => 1,
                'cover_image' => 'dog_leash.jpg',
            ],
            [
                'name' => 'Pedigree Adult Dry Dog Food',
                'description' => 'Great Tasting: Pedigree Complete Nutrition, Adult Dry Dog Food, Roasted Chicken & Vegetable Flavor is a great-tasting dry dog food recipe with whole grains, protein, and accents of vegetables. 1 pack',
                'price' => 2499.99,
                'stock' => 100,
                'category_id' => 1,
                'user_id' => 1,
                'cover_image' => 'dog_food.jpg',
            ],
            [
                'name' => 'IRIS USA Large Cat Litter Box',
                'description' => 'The IRIS USA open top kitty litter tray offers a functional and comfortable solution to your cat\'s bathroom needs. With the open air kitty litter pan, getting in and out of the tray has never been easier for your cat and the tall walls keep any litter or spraying inside the tray.',
                'price' => 1299.99,
                'stock' => 30,
                'category_id' => 2,
                'user_id' => 1,
                'cover_image' => 'cat_litter.jpg',
            ],
            [
                'name' => 'Marina LED Aquarium Kit',
                'description' => '10 U.S. gallon glass aquarium that includes a Marina Slim S15 clip on filter with quick change filter cartridges',
                'price' => 10599.99,
                'stock' => 10,
                'category_id' => 3,
                'user_id' => 1,
                'cover_image' => 'fish_tank.jpg',
            ],
            [
                'name' => 'Favola Hamster Cage',
                'description' => 'Hamster Cage Includes 2 Spacious Floors; First floor is a deep 4.75 height inches to promote playful borrowing w/ a Hamster friendly plastic ramp (no pinched toes) for easy access to the plastic top level where their food dish, water & hide away preside',
                'price' => 3999.99,
                'stock' => 20,
                'category_id' => 4,
                'user_id' => 1,
                'cover_image' => 'hamster_cage.jpg',
            ],
            [
                'name' => 'Bissap Bird Perch Stand',
                'description' => 'Parrot perches are made of natural grapevines wood prickly ash wood and apple wood, without paint or chemical odor. It is non-toxic, harmless, safer and more durable, in line with the living habits of birds.',
                'price' => 1599.99,
                'stock' => 50,
                'category_id' => 5,
                'user_id' => 1,
                'cover_image' => 'bird_perch.jpg',
            ],
            [
                'name' => 'Fluker Reptile Heat Lamp',
                'description' => 'Incandescent Spotlight Bulbs: These 75 Watt reptile bulbs are specifically designed to provide the heat light for reptiles, aiding in the reduction of chronic illness risk.',
                'price' => 499.99,
                'stock' => 25,
                'category_id' => 6,
                'user_id' => 1,
                'cover_image' => 'reptile_heat_lamp.jpg',
            ],
            [
                'name' => 'Small Animal Carrier',
                'description' => '10*12*10 inches, less than 1 pounds carrier only. Size is more like MacBook Air and big enough for hedgehog, hamster, squirrel, parrot, rabbit and guinea pig etc small animals. Just reminder, aggressive rat and hamster will bite through any materials per their characteristic.',
                'price' => 1399.99,
                'stock' => 40,
                'category_id' => 7,
                'user_id' => 1,
                'cover_image' => 'small_animal_carrier.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create(array_merge($product, [
                'slug' => Str::slug($product['name']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }
    }
}
