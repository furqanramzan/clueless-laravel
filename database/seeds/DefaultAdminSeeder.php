<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Contracts\Hashing\Hasher as Hash;

class DefaultAdminSeeder extends Seeder
{
    private $model;
    private $hash;

    public function __construct(Admin $model, Hash $hash)
    {
        $this->model = $model;
        $this->hash = $hash;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->model->create([
            'name' => 'Clueless',
            'email' => 'weareclueless@gmail.com',
            'password' => $this->hash->make('weareclueless123098')
        ]);
    }
}
