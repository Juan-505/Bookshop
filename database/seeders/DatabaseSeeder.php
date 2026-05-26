<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = [
            ['id_loai' => 1, 'ten_loai' => 'Đồ Chơi ', 'id_cha' => null],
            ['id_loai' => 2, 'ten_loai' => 'Kinh Tế', 'id_cha' => null],
            ['id_loai' => 3, 'ten_loai' => 'Truyện Tranh ', 'id_cha' => null],
            ['id_loai' => 4, 'ten_loai' => 'Ngoại Ngữ', 'id_cha' => null],
            ['id_loai' => 5, 'ten_loai' => 'Sách Giáo Khoa', 'id_cha' => null],
            ['id_loai' => 6, 'ten_loai' => 'Thiếu Nhi', 'id_cha' => null],
            ['id_loai' => 7, 'ten_loai' => 'Văn Phòng Phẩm', 'id_cha' => null],
            ['id_loai' => 8, 'ten_loai' => 'Tiểu Thuyết', 'id_cha' => null],
            ['id_loai' => 16, 'ten_loai' => 'Mô Hình', 'id_cha' => 1],
            ['id_loai' => 17, 'ten_loai' => 'Gấu Bông', 'id_cha' => 1],
            ['id_loai' => 18, 'ten_loai' => 'Bút Màu', 'id_cha' => 7],
            ['id_loai' => 19, 'ten_loai' => 'Vở', 'id_cha' => 7],
            ['id_loai' => 20, 'ten_loai' => 'Tẩy', 'id_cha' => 7],
            ['id_loai' => 21, 'ten_loai' => 'Lớp 1', 'id_cha' => 5],
            ['id_loai' => 22, 'ten_loai' => 'Lớp 11', 'id_cha' => 5],
            ['id_loai' => 23, 'ten_loai' => 'Tiếng Anh', 'id_cha' => 4],
            ['id_loai' => 24, 'ten_loai' => 'Tiếng Đức', 'id_cha' => 4],
            ['id_loai' => 25, 'ten_loai' => 'Sách Đa Ngữ (Polyglot)', 'id_cha' => 4],
        ];

        $books = [
            ['idbook' => 1, 'tensach' => 'Móc Khóa Bông Trang Trí Kèm Card Holder Spy X Family - Big Head - ToTy NX05 - Anya', 'hinh' => 'Móc Khóa Bông Trang Trí Kèm Card Holder Spy X Family - Big Head - ToTy NX05 - Anya.png', 'id_loai' => 17, 'dongia' => 136000, 'hangton' => 41, 'daban' => 70, 'ngaynhap' => '2026-04-22', 'giamgia' => 16],
            ['idbook' => 9, 'tensach' => 'bi mat tu duy trieu phu', 'hinh' => 'kt-bimattuduytrieuphu.png', 'id_loai' => 2, 'dongia' => 120000, 'hangton' => 98, 'daban' => 76, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 10, 'tensach' => 'kinh te via he', 'hinh' => 'kt-kinhteviahe.png', 'id_loai' => 2, 'dongia' => 140000, 'hangton' => 50, 'daban' => 54, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 11, 'tensach' => 'mba bang hinh', 'hinh' => 'kt-mbabanghinh.png', 'id_loai' => 2, 'dongia' => 230000, 'hangton' => 34, 'daban' => 14, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 12, 'tensach' => 'mot doi quan tri', 'hinh' => 'kt-motdoiquantri.png', 'id_loai' => 2, 'dongia' => 350000, 'hangton' => 25, 'daban' => 14, 'ngaynhap' => '2024-01-01', 'giamgia' => 13],
            ['idbook' => 13, 'tensach' => 'bien moi thu thanh tien2', 'hinh' => 'ky-bienmoithuthanhtien2.png', 'id_loai' => 2, 'dongia' => 50000, 'hangton' => 50, 'daban' => 14, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 14, 'tensach' => 'attack on titan 13', 'hinh' => 'mg-aot13.png', 'id_loai' => 3, 'dongia' => 100000, 'hangton' => 50, 'daban' => 32, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 15, 'tensach' => 'attack on titan 34', 'hinh' => 'mg-aot34.png', 'id_loai' => 3, 'dongia' => 136000, 'hangton' => 75, 'daban' => 4, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 16, 'tensach' => 'attack on titan 4', 'hinh' => 'mg-aot4.png', 'id_loai' => 3, 'dongia' => 121000, 'hangton' => 50, 'daban' => 44, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 17, 'tensach' => 'attack on titan 9', 'hinh' => 'mg-aot9.png', 'id_loai' => 3, 'dongia' => 32500, 'hangton' => 32, 'daban' => 11, 'ngaynhap' => '2024-01-01', 'giamgia' => 2],
            ['idbook' => 18, 'tensach' => 'doraemon 1', 'hinh' => 'mg-drm1.png', 'id_loai' => 3, 'dongia' => 321000, 'hangton' => 50, 'daban' => 23, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 19, 'tensach' => 'doraemon 2', 'hinh' => 'mg-drm2.png', 'id_loai' => 3, 'dongia' => 120000, 'hangton' => 5, 'daban' => 3, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 20, 'tensach' => 'doraemon 3', 'hinh' => 'mg-drm3.png', 'id_loai' => 3, 'dongia' => 147000, 'hangton' => 50, 'daban' => 53, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 21, 'tensach' => 'doraemon 5', 'hinh' => 'mg-drm5.png', 'id_loai' => 3, 'dongia' => 170000, 'hangton' => 34, 'daban' => 43, 'ngaynhap' => '2024-01-01', 'giamgia' => 7],
            ['idbook' => 22, 'tensach' => 'doraemon 6', 'hinh' => 'mg-drm6.png', 'id_loai' => 3, 'dongia' => 260800, 'hangton' => 23, 'daban' => 9, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 23, 'tensach' => 'overlord', 'hinh' => 'mg-ovl.png', 'id_loai' => 3, 'dongia' => 119999, 'hangton' => 23, 'daban' => 40, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 24, 'tensach' => 'van hao luu lac', 'hinh' => 'mg-vhll.png', 'id_loai' => 3, 'dongia' => 120000, 'hangton' => 53, 'daban' => 9, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 25, 'tensach' => 'ngu phap tieng anh', 'hinh' => 'nn-npta.png', 'id_loai' => 23, 'dongia' => 120000, 'hangton' => 76, 'daban' => 23, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 26, 'tensach' => 'ngu phap tieng duc', 'hinh' => 'nn-npttd.png', 'id_loai' => 24, 'dongia' => 675640, 'hangton' => 24, 'daban' => 33, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 27, 'tensach' => 'tu hoc duoc', 'hinh' => 'nn-thd.png', 'id_loai' => 25, 'dongia' => 431000, 'hangton' => 45, 'daban' => 87, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 28, 'tensach' => 'ngu van 11 -1- canhdieu', 'hinh' => 'sgk-nguvan11-1-canhdieu.png', 'id_loai' => 22, 'dongia' => 34500, 'hangton' => 43, 'daban' => 63, 'ngaynhap' => '2024-01-01', 'giamgia' => 5],
            ['idbook' => 30, 'tensach' => 'toan 11 -1- chan troi sang tao', 'hinh' => 'sgk-toan11-1-ctst.png', 'id_loai' => 22, 'dongia' => 334898, 'hangton' => 50, 'daban' => 34, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 31, 'tensach' => 'toan 11 -1- ket noi tri thuc', 'hinh' => 'sgk-toan11-1-kn.png', 'id_loai' => 22, 'dongia' => 543000, 'hangton' => 48, 'daban' => 2, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 33, 'tensach' => 'toan 11 -2- ket noi tri thuc', 'hinh' => 'sgk-toan11-2-kn.png', 'id_loai' => 22, 'dongia' => 212000, 'hangton' => 45, 'daban' => 36, 'ngaynhap' => '2024-01-01', 'giamgia' => 6],
            ['idbook' => 34, 'tensach' => 'cau chuyen rung xanh', 'hinh' => 'tn-cauchuyenrungxanh.png', 'id_loai' => 6, 'dongia' => 120000, 'hangton' => 99, 'daban' => 24, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 35, 'tensach' => 'co tich cua ba', 'hinh' => 'tn-cotichcuaba.png', 'id_loai' => 6, 'dongia' => 645000, 'hangton' => 84, 'daban' => 22, 'ngaynhap' => '2024-01-01', 'giamgia' => 8],
            ['idbook' => 36, 'tensach' => 'le ta on', 'hinh' => 'tn-letaon.png', 'id_loai' => 6, 'dongia' => 123000, 'hangton' => 43, 'daban' => 43, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 37, 'tensach' => 'phong thu', 'hinh' => 'tn-phongthu.png', 'id_loai' => 6, 'dongia' => 445500, 'hangton' => 75, 'daban' => 21, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 38, 'tensach' => 'truyen co tich cua vuon', 'hinh' => 'tn-truyencotichcuavuon.png', 'id_loai' => 6, 'dongia' => 272000, 'hangton' => 52, 'daban' => 44, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 39, 'tensach' => 'vo luyen tap tieng viet 1', 'hinh' => 'tn-volttiengviet1.png', 'id_loai' => 21, 'dongia' => 572000, 'hangton' => 32, 'daban' => 19, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 40, 'tensach' => 'vo luyen tap tieng viet 2', 'hinh' => 'tn-volttiengviet2.png', 'id_loai' => 21, 'dongia' => 157200, 'hangton' => 13, 'daban' => 21, 'ngaynhap' => '2024-01-01', 'giamgia' => 0],
            ['idbook' => 42, 'tensach' => 'Đồ Chơi Lắp Ráp Go Battle! Pokémon Vol 2 - Eevee - Keepplay 32666', 'hinh' => 'Đồ Chơi Lắp Ráp Go Battle! Pokémon Vol 2 - Eevee - Keepplay 32666.png', 'id_loai' => 16, 'dongia' => 104000, 'hangton' => 51, 'daban' => 32, 'ngaynhap' => '2026-04-22', 'giamgia' => 0],
            ['idbook' => 43, 'tensach' => 'Đồ Chơi Lắp Ráp Go Adventure Pokémon - Charmander & Charizard - Keepplay K20252', 'hinh' => 'Đồ Chơi Lắp Ráp Go Adventure Pokémon - Charmander & Charizard - Keepplay K20252.png', 'id_loai' => 16, 'dongia' => 72000, 'hangton' => 84, 'daban' => 72, 'ngaynhap' => '2026-04-22', 'giamgia' => 0],
            ['idbook' => 44, 'tensach' => 'Thú Bông Doraemon Cầm Dorayaki', 'hinh' => 'Thú Bông Doraemon Cầm Dorayaki.png', 'id_loai' => 17, 'dongia' => 164000, 'hangton' => 85, 'daban' => 50, 'ngaynhap' => '2026-04-22', 'giamgia' => 0],
            ['idbook' => 45, 'tensach' => 'Kính Vạn Hoa - Tập 18 - Tóc Ngắn Tóc Dài - Má Lúm Đồng Tiền - Cà Phê Áo Tím (Tái Bản 2022)', 'hinh' => 'Kính Vạn Hoa - Tập 18 - Tóc Ngắn Tóc Dài - Má Lúm Đồng Tiền - Cà Phê Áo Tím (Tái Bản 2022).png', 'id_loai' => 6, 'dongia' => 142000, 'hangton' => 77, 'daban' => 56, 'ngaynhap' => '2026-04-22', 'giamgia' => 0],
            ['idbook' => 46, 'tensach' => 'Kính Vạn Hoa - Tập 15 - Khách Sạn Hoa Hồng - Quà Tặng Ba Lần - Kính Vạn Hoa (Tái Bản 2022)', 'hinh' => 'Kính Vạn Hoa - Tập 15 - Khách Sạn Hoa Hồng - Quà Tặng Ba Lần - Kính Vạn Hoa (Tái Bản 2022).png', 'id_loai' => 6, 'dongia' => 79000, 'hangton' => 90, 'daban' => 25, 'ngaynhap' => '2026-04-22', 'giamgia' => 0],
            ['idbook' => 47, 'tensach' => 'Hộp 24 Bút Lông Màu Acrylic Markers 2 Đầu - Colokit ACM-C002', 'hinh' => 'Hộp 24 Bút Lông Màu Acrylic Markers 2 Đầu - Colokit ACM-C002.png', 'id_loai' => 18, 'dongia' => 91000, 'hangton' => 23, 'daban' => 43, 'ngaynhap' => '2026-04-22', 'giamgia' => 0],
            ['idbook' => 48, 'tensach' => 'Hộp 12 Bút Marker Acrylic - Deli EC189-12', 'hinh' => 'Hộp 12 Bút Marker Acrylic - Deli EC189-12.png', 'id_loai' => 18, 'dongia' => 104000, 'hangton' => 56, 'daban' => 14, 'ngaynhap' => '2026-04-22', 'giamgia' => 17],
            ['idbook' => 49, 'tensach' => 'Hộp 12 Bút Màu Acrylic Marker - Deli HM166-12', 'hinh' => 'Hộp 12 Bút Màu Acrylic Marker - Deli HM166-12.png', 'id_loai' => 18, 'dongia' => 82000, 'hangton' => 32, 'daban' => 28, 'ngaynhap' => '2026-04-22', 'giamgia' => 9],
            ['idbook' => 50, 'tensach' => 'Hộp 12 Bút Lông Màu Acrylic Markers 2 Đầu - Colokit ACM-C001', 'hinh' => 'Hộp 12 Bút Lông Màu Acrylic Markers 2 Đầu - Colokit ACM-C001.png', 'id_loai' => 18, 'dongia' => 67000, 'hangton' => 57, 'daban' => 32, 'ngaynhap' => '2026-04-22', 'giamgia' => 20],
            ['idbook' => 51, 'tensach' => 'Hộp 14 Bút Màu Acrylic Đầu Brush - Colokit ACM-C020', 'hinh' => 'Hộp 14 Bút Màu Acrylic Đầu Brush - Colokit ACM-C020.png', 'id_loai' => 18, 'dongia' => 183000, 'hangton' => 25, 'daban' => 22, 'ngaynhap' => '2026-04-22', 'giamgia' => 0],
            ['idbook' => 52, 'tensach' => 'Hộp 24 Bút Màu Acrylic Marker - Deli HM166-24', 'hinh' => 'Hộp 24 Bút Màu Acrylic Marker - Deli HM166-24.png', 'id_loai' => 18, 'dongia' => 58000, 'hangton' => 52, 'daban' => 49, 'ngaynhap' => '2026-04-22', 'giamgia' => 0],
            ['idbook' => 53, 'tensach' => 'Tư Duy Logic (Tái Bản 2021)', 'hinh' => 'Tư Duy Logic (Tái Bản 2021).png', 'id_loai' => 2, 'dongia' => 170000, 'hangton' => 65, 'daban' => 68, 'ngaynhap' => '2026-04-22', 'giamgia' => 9],
            ['idbook' => 54, 'tensach' => 'Việt Nam Danh Tác - Tiêu Sơn Tráng Sĩ', 'hinh' => 'Việt Nam Danh Tác - Tiêu Sơn Tráng Sĩ.png', 'id_loai' => 8, 'dongia' => 161000, 'hangton' => 35, 'daban' => 54, 'ngaynhap' => '2026-04-22', 'giamgia' => 6],
            ['idbook' => 55, 'tensach' => 'Búp Sen Xanh (Tái Bản 2020)', 'hinh' => 'Búp Sen Xanh (Tái Bản 2020).png', 'id_loai' => 6, 'dongia' => 51000, 'hangton' => 52, 'daban' => 64, 'ngaynhap' => '2026-04-22', 'giamgia' => 0],
            ['idbook' => 70, 'tensach' => 'Tập Học Sinh Good Mood - Kẻ Ngang - 80 Trang', 'hinh' => 'Tập Học Sinh Good Mood - Kẻ Ngang - 80 Trang 70gsm - Hải Tiến 9479 (Mẫu Bìa Giao Ngẫu Nhiên).png', 'id_loai' => 19, 'dongia' => 5000, 'hangton' => 87, 'daban' => 95, 'ngaynhap' => '2026-04-23', 'giamgia' => 0],
            ['idbook' => 71, 'tensach' => 'Gôm Tẩy - Deli EH328 - Dudu', 'hinh' => 'Gôm Tẩy - Deli EH328 - Dudu.png', 'id_loai' => 20, 'dongia' => 3000, 'hangton' => 65, 'daban' => 98, 'ngaynhap' => '2026-04-23', 'giamgia' => 0],
        ];

        Category::query()->upsert($categories, ['id_loai'], ['ten_loai', 'id_cha']);
        Book::query()->upsert($books, ['idbook'], ['tensach', 'hinh', 'id_loai', 'dongia', 'hangton', 'daban', 'ngaynhap', 'giamgia']);

        User::updateOrCreate(
            ['email' => 'admin@bookshop.test'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@bookshop.test'],
            [
                'name' => 'User',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );
    }
}
