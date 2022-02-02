<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{

    protected $user;
    protected $role;
    protected $permission;
    const  PERMISSIONS = [
        "user.create" => "Create user",
        "user.search" => "Search users",
        "user.edit" => "Edit user",
        "user.changePwd" => "Change user password",
        "user.exclude" => "Delete user",
        "user.restore" => "Restore user",
    ];
    const PASSWORD = "password";

    public function __construct(
        User $user,
        Role $role,
        Permission $permission
    ) {
        $this->user = $user;
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createPermissoes();
        $this->createSuperAdmin();
    }

    protected function createPermissoes()
    {
        foreach (self::PERMISSIONS as $name => $label) {
            if (empty($this->permission->where("name", $name)->first())) {
                $this->permission->create([
                    "name" => $name,
                    "label" => $label,
                ]);
            }
        }
    }

    protected function associateRules(array $permissions, Role $role)
    {
        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }
    }

    protected function createSuperAdmin()
    {
        $user = $this->user->create([
            'name' => 'Talent Pitch',
            'email' => 'admin@admin.com',
            'password' => Hash::make(self::PASSWORD),
        ]);
        $rule = $this->role->create([
            "name" => "Super Admin",
        ]);
        $permission =
            [
                "user.create",
                "user.search",
                "user.edit",
                "user.changePwd",
                "user.exclude",
                "user.restore",
            ];
        $this->associateRules($permission, $rule);
        $user->assignRole($rule->name);
    }
}
