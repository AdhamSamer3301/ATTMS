<?php

use App\Attendance;
use App\Department;
use \DateTime as DateTime;
use App\Role;
use App\User;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();
        DB::table('employees')->truncate();
        DB::table('departments')->truncate();
        DB::table('attendances')->truncate();
        $employeeRole = Role::where('name', 'Employee')->first();
        $adminRole =  Role::where('name', 'Admin')->first();
        $managerRole =  Role::where('name', 'Manager')->first();

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin')
        ]);

        $employee = User::create([
            'name' => 'Adham Samer',
            'email' => 'adhamsamer3301@gmail.com',
            'password' => Hash::make('123456')
        ]);

        //
        $employee->roles()->attach($employeeRole);
        // $manager->roles()->attach($managerRole);
        $dob = new DateTime('2000-03-03');
        $join = new DateTime('2021-01-01');
        $admin->roles()->attach($adminRole);
        $employee = Employee::create([
            'user_id' => $employee->id,
            'first_name' => 'Adham',
            'last_name' => 'Samer',
            'dob' => $dob->format('Y-m-d'),
            'sex' => 'Male',
            // 'role_id' => '2',
            'department_id' => '1',
            'join_date' => $join->format('Y-m-d'),
            'salary' => 10500
        ]);

        Department::create(['name' => 'Marketing']);
        Department::create(['name' => 'Sales']);
        Department::create(['name' => 'Logistics']);
        Department::create(['name' => 'Human Resources']);

    }
}
