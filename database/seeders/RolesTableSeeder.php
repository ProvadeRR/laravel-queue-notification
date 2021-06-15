<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
          [
              'name' => 'Администратор',
              'slug' => 'admin'
          ],
          [
              'name' => 'Пользователь',
              'slug' => 'user'
          ]
        );

        $user = User::whereEmail('stas.karnoza@gmail.com')->first();

        DB::table('role_user')->insert([
           'user_id' => $user->id,
           'role_id' => 1,
        ]);

    }
}
