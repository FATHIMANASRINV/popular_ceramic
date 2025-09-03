<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;  
class TruncateTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Schema::disableForeignKeyConstraints();
     // DB::table('products')->truncate();
     // DB::table('categories')->truncate();
     // DB::table('request_product_qty')->truncate();

     // DB::table('users')->where('user_type', '!=', 'admin')->delete();
     // DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');


       $tables = DB::select('SHOW TABLES');

       $database = 'popular_ceramic';
       $key = 'Tables_in_' . $database;
       foreach ($tables as $table) {
         $tableName = $table->$key;
         if ($tableName === 'users') {
           DB::table('users')->where('user_type', '!=', 'admin')->delete();
           DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');
        } else {
           DB::table($tableName)->truncate();
        }
     }

     Schema::enableForeignKeyConstraints();
  }
}
