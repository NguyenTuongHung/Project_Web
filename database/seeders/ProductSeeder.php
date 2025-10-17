<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Ghế Sofa Cao Cấp',
                'desc' => 'Ghế sofa da thật nhập khẩu, thiết kế hiện đại',
                'img' => '/images/ghe-sofa.jpg',
                'price' => 15000000,
                'sale_price' => 12000000,
                'is_sale' => true,
            ],
            [
                'name' => 'Bàn Trà Gỗ Tự Nhiên',
                'desc' => 'Bàn trà phòng khách gỗ sồi bền đẹp',
                'img' => '/images/ban-tra.webp',
                'price' => 3500000,
                'sale_price' => null,
                'is_sale' => false,
            ],
            [
                'name' => 'Giường Ngủ Hiện Đại',
                'desc' => 'Giường ngủ hiện đại, sang trọng, bảo hành 5 năm',
                'img' => '/images/giuongngu.avif',
                'price' => 12000000,
                'sale_price' => 9900000,
                'is_sale' => true,
            ],
            [
                'name' => 'Tủ Quần Áo Thông Minh',
                'desc' => 'Tủ gỗ công nghiệp cao cấp, chống ẩm mốc',
                'img' => '/images/tuquanao.jpg',
                'price' => 8500000,
                'sale_price' => 7500000,
                'is_sale' => true,
            ],
            [
                'name' => 'Bàn Làm Việc Đơn Giản',
                'desc' => 'Bàn gỗ công nghiệp, phong cách tối giản, tiết kiệm không gian',
                'img' => '/images/banlamviec.webp',
                'price' => 2000000,
                'sale_price' => null,
                'is_sale' => false,
            ],
            [
                'name' => 'Kệ Sách Đa Năng',
                'desc' => 'Kệ sách 5 tầng bằng gỗ cao cấp',
                'img' => '/images/kesach.webp',
                'price' => 1800000,
                'sale_price' => 1500000,
                'is_sale' => true,
            ],
            [
                'name' => 'Đèn Trang Trí',
                'desc' => 'Đèn treo trần phong cách châu Âu',
                'img' => '/images/den_trangtri.jpg',
                'price' => 2500000,
                'sale_price' => null,
                'is_sale' => false,
            ],
            [
                'name' => 'Thảm Lông Cao Cấp',
                'desc' => 'Thảm trải sàn cao cấp nhập khẩu',
                'img' => '/images/thamlong.jpg',
                'price' => 3200000,
                'sale_price' => 2500000,
                'is_sale' => true,
            ],
            [
                'name' => 'Tủ Giày Thông Minh',
                'desc' => 'Tủ giày gỗ đa năng, tiết kiệm diện tích',
                'img' => '/images/tugiay.jpg',
                'price' => 2700000,
                'sale_price' => null,
                'is_sale' => false,
            ],
            [
                'name' => 'Gương Treo Tường',
                'desc' => 'Gương nghệ thuật trang trí phòng khách',
                'img' => '/images/guongtreotuong.webp',
                'price' => 2200000,
                'sale_price' => 1900000,
                'is_sale' => true,
            ],
        ]);
    }
}

