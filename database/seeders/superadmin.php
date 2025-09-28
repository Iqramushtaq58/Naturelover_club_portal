
<?php\App\Models\Admin::create([
    'name' => 'Super Admin',
    'email' => 'admin@admin.com',
    'password' => Hash::make('Admin@123'),
    'role' => 'super_admin'
]);
