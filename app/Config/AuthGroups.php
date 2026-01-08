<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Shield\Config\AuthGroups as ShieldAuthGroups;

class AuthGroups extends ShieldAuthGroups
{
    /**
     * Default Group
     */
    public string $defaultGroup = 'user';

    /**
     * Groups in the system
     */
    public array $groups = [
        'superadmin' => [
            'title'       => 'Super Admin',
            'description' => 'Complete control of the site.',
        ],
        'admin' => [
            'title'       => 'Admin',
            'description' => 'Day to day administrators of the site.',
        ],
        'developer' => [
            'title'       => 'Developer',
            'description' => 'Site programmers.',
        ],
        'staff' => [
            'title'       => 'Staff',
            'description' => 'Limited management permissions.',
        ],
        'user' => [
            'title'       => 'User',
            'description' => 'General users of the site.',
        ],
        'beta' => [
            'title'       => 'Beta User',
            'description' => 'Has access to beta-level features.',
        ],
    ];

    /**
     * Available permissions
     */
    public array $permissions = [
        'admin.access'        => 'Can access the admin area',
        'admin.settings'      => 'Can access site settings',
        'users.create'        => 'Can create new users',
        'users.edit'          => 'Can edit existing users',
        'users.delete'        => 'Can delete users',
        'staff.add'           => 'Can add staff members',
        'staff.delete'        => 'Can delete staff members',
        'discount.add'        => 'Can add discounts',
        'discount.delete'     => 'Can delete discounts',
        'beta.access'         => 'Can access beta features',
    ];

    /**
     * Permissions matrix (group-level permissions)
     */
    public array $matrix = [
        'superadmin' => [
            'admin.*',
            'users.*',
            'staff.*',
            'discount.*',
            'beta.*',
        ],
        'admin' => [
            'admin.access',
            'users.create',
            'users.edit',
            'users.delete',
            'staff.add',
            'staff.delete',
            'discount.add',
            'discount.delete',
            'beta.access',
        ],
        'developer' => [
            'admin.access',
            'admin.settings',
            'users.create',
            'users.edit',
            'staff.add',
            'discount.add',
            'beta.access',
        ],
        'staff' => [
            'users.create',
            'discount.add',

        ],
        'user' => [

        ],
        'beta' => [
            'beta.access',
        ],
    ];
}
