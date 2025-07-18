<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PDO;

class DatabaseCreateCommand extends Command
{
    /**
     * Tên và cú pháp của lệnh console.
     * Đây là tên bạn sẽ gõ: php artisan db:create
     *
     * @var string
     */
    protected $signature = 'db:create {--charset=utf8mb4} {--collation=utf8mb4_unicode_ci}';

    /**
     * Mô tả của lệnh console.
     *
     * @var string
     */
    protected $description = 'Create a new MySQL database based on the database name in .env file';

    /**
     * Thực thi lệnh console.
     */
    public function handle()
    {
        // Lấy tên database từ file config, file config này lại đọc từ file .env
        $databaseName = config('database.connections.mysql.database');
        
        // Nếu không có tên database thì báo lỗi
        if (! $databaseName) {
            $this->error('Database name not specified in .env file.');
            return 1;
        }

        try {
            // Lấy các thông tin kết nối khác
            $host = config('database.connections.mysql.host');
            $port = config('database.connections.mysql.port');
            $username = config('database.connections.mysql.username');
            $password = config('database.connections.mysql.password');
            $charset = $this->option('charset');
            $collation = $this->option('collation');

            // Tạo một kết nối PDO tới MySQL server mà KHÔNG cần chỉ định database
            $pdo = new PDO("mysql:host=$host;port=$port", $username, $password);

            // Chạy câu lệnh SQL để tạo database
            // Dùng `IF NOT EXISTS` để lệnh này an toàn khi chạy lại nhiều lần
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$databaseName` CHARACTER SET $charset COLLATE $collation;");
            
            $this->info("Database '$databaseName' created successfully!");
            
            return 0;

        } catch (\Exception $e) {
            $this->error("Failed to create database: " . $e->getMessage());
            return 1;
        }
    }
}