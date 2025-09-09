<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạo 1 user mẫu để đăng nhập thử
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('123456'), // Mật khẩu mặc định
        ]);

        // Gọi ProductSeeder để thêm dữ liệu sản phẩm
        $this->call(ProductSeeder::class);
    }
}



