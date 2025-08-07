<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$roles = [

        'supadmin',
        'admin',
        'caisse',
        'facture',
        'stock',
        'user',
        'parametres',
        'log',
        ];

        foreach ($roles as $role) {
             Role::create(['name' => $role,'guard_name' => $role]);
        }


        $permissions = [

        'quotation-list',
        'invoice-list',
        'payment-list',
        'product-list',
        'client-list',
        'type-client-list',
        'fournisseur-list',
        'tresorerie',
        'entreprise-list',
        'role-list',
        'permission-list',
        'parametre-list',
        'user-list',

        'quotation-add',
        'invoice-add',
        'payment-add',
        'product-add',
        'client-add',
        'type-client-add',
        'fournisseur-add',
        'entreprise-add',
        'role-add',
        'permission-add',
        'parametre-add',
        'user-add',

        'quotation-update',
        'invoice-update',
        'payment-update',
        'product-update',
        'client-update',
        'type-client-update',
        'fournisseur-update',
        'entreprise-update',
        'role-update',
        'permission-update',
        'parametre-update',
        'user-update',
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission,'guard_name' => $permission]);
        }*/

        $user = Auth::user();
        

        $role = Role::find(1);
        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            $role->syncPermissions($permission);
            //$user->givePermissionTo($permission);
        }
        //$role->syncPermissions($permissions);
        //$user->givePermissionTo($permissions);
        //$user->assignRole($role);
    }
}
