<?php

namespace Database\Factories;
use App\Models\RolPermission;
use App\Models\Permission;
use App\Models\Rol;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RolPermission>
 */
class RolPermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_rol' => Rol::all()->random()->id,
            'id_permission' => Permission::all()->random()->id,
            //
        ];
    }
}
