<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tai_khoan', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->string('email');
            $table->string('mat_khau');
            $table->integer('admin'); // Giá trị lưu vào là: 0 hoặc 1, trong đó: 0 là tài khoản khảo sát, 1 là tài khoản admin
        });

        Schema::create('lop', function (Blueprint $table) {
            $table->id();
            $table->integer('nganh_id'); //Liên kết với bảng ngành (khoá ngoại)
            $table->string('ma_lop');
            $table->string('ten_lop');
        });

        Schema::create('nganh', function (Blueprint $table) {
            $table->id();
            $table->string('ma_nganh');
            $table->string('ten_nganh');
        });

        Schema::create('cuu_sinh_vien', function (Blueprint $table) {
            $table->id();
            $table->integer('lop_id'); //Liên kết với bảng lớp (khoá ngoại)
            $table->string('ma_sv')->nullable();
            $table->string('ten_sv')->nullable();
            $table->string('gioi_tinh')->nullable();
            $table->string('so_dien_thoai')->nullable();
            $table->string('email')->nullable();
        });

        Schema::create('phieu_khao_sat', function (Blueprint $table) {
            $table->id();
            $table->string('tieu_de');
        });

        Schema::create('cau_hoi', function (Blueprint $table) {
            $table->id();
            $table->integer('phieu_khao_sat_id'); //Liên kết với bảng phiếu khảo sát (khoá ngoại)
            $table->string('ten'); // VD: Câu 1, Câu 2, ...
            $table->string('noi_dung');
            $table->integer('cach_chon_dap_an'); // Giá trị lưu vào là: 0 hoặc 1, trong đó: 0 là chọn 1 đáp án, 1 là chọn nhiều đáp án
        });

        Schema::create('phuong_an_tra_loi', function (Blueprint $table) {
            $table->id();
            $table->integer('cau_hoi_id'); //Liên kết với bảng câu hỏi (khoá ngoại)
            $table->string('ten'); // VD: A, B, C, D
            $table->string('noi_dung');
        });

        Schema::create('ket_qua', function (Blueprint $table) {
            $table->id();
            $table->integer('phieu_khao_sat_id'); //Liên kết với bảng phiếu khảo sát (khoá ngoại)
            $table->integer('cuu_sinh_vien_id'); //Liên kết với bảng cựu sv (khoá ngoại)
            $table->string('ket_qua'); // Giá trị lưu vào là: 0 hoặc 1, trong đó: 0 là chưa có việc làm, 1 là đang có việc làm, chưa có như cầu, đang học tiếp, đang vừa học vừa làm
            $table->date('ngay_khao_sat');
        });

        Schema::create('cau_tra_loi', function (Blueprint $table) {
            $table->id();
            $table->integer('ket_qua_id'); //Liên kết với bảng kết quả (khoá ngoại)
            $table->integer('cau_hoi_id'); //Liên kết với bảng câu hỏi (khoá ngoại)
            $table->integer('phuong_an_tra_loi_id'); //Liên kết với bảng phương án trả lời (khoá ngoại)
            $table->integer('lop_id'); //Liên kết với bảng lớp (khoá ngoại) để thống kê lớp
            $table->integer('nganh_id'); //Liên kết với bảng ngành (khoá ngoại) để thống kê ngành
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('database');
    }
}
