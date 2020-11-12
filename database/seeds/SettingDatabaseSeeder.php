<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::setMany([
            'default_locale' => 'ar',
            'default_timezone' => 'Saudi Arabia / Jeddah',
            'reviews_enabled' => true,
            'auto_approve_reviews' => true,
            'supported_currencies' => ['SAR',"USD", 'AED'],
            'default_currency' => 'SAR',
            'store_email' => 'admin@ecommerce.test',
            'search_engine' => 'mysql',
            'local_shipping_cost' => 5,
            'outerLshipping_cost' => 15,
            'free_shipping_cost' => 0,
            'translatable'=> [
                'store_name' => 'Marwan Store',
                'free_shipping_label' => 'Free Shipping',
                'local_shipping_label' => 'Local Shipping',
                'outer_shipping_label' => 'Outer Shipping'
            ],
        ]);
    }
}
