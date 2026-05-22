<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan foreign key checks untuk melakukan truncate yang bersih
        Schema::disableForeignKeyConstraints();
        Food::truncate();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        // 1. Local Heavy Meals (Makanan Berat Lokal)
        $localFood = Category::create(['name' => 'Local Heavy Meals']);
        
        $localFood->foods()->create([
            'name' => 'Nasi Goreng Spesial Bilabola',
            'description' => 'Nasi goreng bumbu rempah tradisional khas Bilabola dengan suwiran ayam, bakso sapi, telur dadar iris, acar segar, dan kerupuk renyah.',
            'price' => 32000,
            'is_available' => true,
            'image' => 'https://images.unsplash.com/photo-1541832676-9b763b0239ab?q=80&w=600&auto=format&fit=crop',
            'options' => ['local_food']
        ]);

        $localFood->foods()->create([
            'name' => 'Ayam Goreng Lengkuas',
            'description' => 'Ayam goreng kampung bumbu kuning bertabur kremesan lengkuas wangi, disajikan dengan nasi hangat, lalapan segar, dan sambal terasi pedas.',
            'price' => 38000,
            'is_available' => true,
            'image' => 'https://images.unsplash.com/photo-1562967914-608f82629710?q=80&w=600&auto=format&fit=crop',
            'options' => ['local_food']
        ]);

        $localFood->foods()->create([
            'name' => 'Mie Goreng Jawa Kecombrang',
            'description' => 'Mie kuning khas Jawa yang ditumis wangi dengan irisan bunga kecombrang segar, telur orak-arik, sayuran segar, suwiran ayam, dan bakso.',
            'price' => 28000,
            'is_available' => true,
            'image' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?q=80&w=600&auto=format&fit=crop',
            'options' => ['local_food']
        ]);

        // 2. Espresso & Coffee
        $coffee = Category::create(['name' => 'Espresso & Coffee']);
        
        $coffee->foods()->create([
            'name' => 'Signature Aren Latte',
            'description' => 'Perpaduan harmonis espresso premium dari biji kopi Arabika pilihan, susu segar creamy, dan gula aren organik khas Bilabola.',
            'price' => 28000,
            'is_available' => true,
            'image' => 'menu/signature_aren_latte.png',
            'options' => ['drink']
        ]);

        $coffee->foods()->create([
            'name' => 'Caramel Macchiato',
            'description' => 'Double shot espresso dengan steamed milk lembut, dibalut sirup vanilla premium dan saus karamel lezat di atasnya.',
            'price' => 35000,
            'is_available' => true,
            'image' => 'menu/caramel_macchiato.png',
            'options' => ['drink']
        ]);

        $coffee->foods()->create([
            'name' => 'Double Espresso / Americano',
            'description' => 'Espresso shot ganda klasik dari biji kopi single-origin Arabika pilihan dengan air murni, menghasilkan kopi bold aromatik.',
            'price' => 24000,
            'is_available' => true,
            'image' => 'menu/signature_aren_latte.png',
            'options' => ['drink']
        ]);

        $coffee->foods()->create([
            'name' => 'Avocado Coffee Float',
            'description' => 'Espresso arabika disiram ke atas jus alpukat mentega segar yang kental, disajikan dengan es krim vanilla premium di atasnya.',
            'price' => 38000,
            'is_available' => true,
            'image' => 'menu/signature_aren_latte.png',
            'options' => ['drink']
        ]);

        // 3. Non-Coffee & Tea
        $nonCoffee = Category::create(['name' => 'Non-Coffee & Tea']);

        $nonCoffee->foods()->create([
            'name' => 'Matcha Latte Premium',
            'description' => 'Bubuk matcha asli Uji, Jepang berkualitas tinggi yang dikocok sempurna dengan susu segar creamy hangat atau dingin.',
            'price' => 32000,
            'is_available' => true,
            'image' => 'menu/matcha_latte.png',
            'options' => ['drink']
        ]);

        $nonCoffee->foods()->create([
            'name' => 'Signature Dark Chocolate',
            'description' => 'Cokelat Belgian dark chocolate premium yang dilelehkan dengan susu segar creamy, rasa cokelat pekat dan mewah.',
            'price' => 30000,
            'is_available' => true,
            'image' => 'menu/matcha_latte.png',
            'options' => ['drink']
        ]);

        // 4. Ice Cream & Dessert (Es Krim & Pencuci Mulut)
        $iceCreamCat = Category::create(['name' => 'Ice Cream & Dessert']);

        $iceCreamCat->foods()->create([
            'name' => 'Matcha Soft Serve',
            'description' => 'Es krim soft-serve lembut dengan rasa teh hijau Matcha Jepang premium dari daerah Uji, rasa manis-gurih alami yang menenangkan.',
            'price' => 22000,
            'is_available' => true,
            'image' => 'https://images.unsplash.com/photo-1505394033641-40c6ad1178d7?q=80&w=600&auto=format&fit=crop',
            'options' => ['icecream']
        ]);

        $iceCreamCat->foods()->create([
            'name' => 'Bilabola Signature Waffle Sundae',
            'description' => 'Waffle Belgia panggang hangat renyah di luar lembut di dalam, disajikan dengan es krim vanilla premium, saus karamel lezat, dan potongan stroberi.',
            'price' => 35000,
            'is_available' => true,
            'image' => 'https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?q=80&w=600&auto=format&fit=crop',
            'options' => ['icecream']
        ]);

        $iceCreamCat->foods()->create([
            'name' => 'Premium Gelato Duo Cup',
            'description' => 'Es krim gelato khas Italia buatan tangan dengan pilihan rasa: Double Chocolate atau Salted Caramel, tekstur super padat dan creamy.',
            'price' => 28000,
            'is_available' => true,
            'image' => 'https://images.unsplash.com/photo-1560008511-11c63416e52d?q=80&w=600&auto=format&fit=crop',
            'options' => ['icecream']
        ]);

        // 5. Pastries & Bakery
        $bakery = Category::create(['name' => 'Pastries & Bakery']);

        $bakery->foods()->create([
            'name' => 'Butter Croissant',
            'description' => 'Croissant klasik khas Prancis dengan lapisan luar yang renyah berongga, beraroma mentega premium (butter) gurih.',
            'price' => 25000,
            'is_available' => true,
            'image' => 'menu/butter_croissant.png',
            'options' => []
        ]);

        $bakery->foods()->create([
            'name' => 'Almond Croissant',
            'description' => 'Croissant renyah dengan isian krim almond manis lembut, ditaburi irisan kacang almond panggang gurih dan gula halus.',
            'price' => 29000,
            'is_available' => true,
            'image' => 'menu/butter_croissant.png',
            'options' => []
        ]);

        // 6. Snacks & Sides
        $snacks = Category::create(['name' => 'Snacks & Sides']);

        $snacks->foods()->create([
            'name' => 'Bilabola Club Sandwich',
            'description' => 'Roti panggang triple-decker dengan isian dada ayam panggang, beef bacon renyah, telur mata sapi, keju cheddar, dan saus spesial.',
            'price' => 42000,
            'is_available' => true,
            'image' => 'menu/club_sandwich.png',
            'options' => []
        ]);

        $snacks->foods()->create([
            'name' => 'Truffle Fries',
            'description' => 'Kentang goreng renyah potongan tebal yang dibaluri minyak truffle aromatik, taburan keju parmesan, dan daun rosemary.',
            'price' => 28000,
            'is_available' => true,
            'image' => 'menu/truffle_fries.png',
            'options' => []
        ]);
    }
}