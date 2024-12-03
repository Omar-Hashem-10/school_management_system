<?php

return [

    'validation'                    => [
        'password'                  => [
            'required'              => 'Password is required',
            'confirmed'             => 'Password must be match',
        ],
        'currentPassword'           => [
            'required'              => 'Current Password is required',
            // 'confirmed'     => 'كلمتا السر ليست متطابقه',
        ],
        'password_confirmation'    => [
            'required'             => 'يجب تأكيد كلمة السر',
        ],
    ],
    'aside' => [
        'Users'                     => 'Users',
        'Dashboard'                 => 'Dashboard',
        'Attendance'                => [
            'Attendance'            => 'Attendances',
            'Employees'             => 'Employees',
            'Students'              => 'Students',
        ],
        'Managements'               => 'Managements',
        'Teachers'                  => 'Teachers',
        'Students'                  => 'Students',
        'Guardians'                 => 'Guardians',
        'Roles'                     => 'Roles',
        'Salaries'                  => 'Salaries',
        'Employees'                 => 'Employees',
        'Levels'                    => 'Levels',
        'Admins'                    => 'Admins',
        'Subjects'                  => 'Subjects',
        'Schedule'                  => 'Schedule',
        'Time_Slots'                => 'Time Slots',
        'Course_Codes'              => 'Course Codes',
        'Level_Subjects'            => 'Level Subjects',
        'Classrooms'                => 'Classrooms',
        'Days'                      => 'Days',
    ],
    'profile'                       => [
        'Overview'                  =>'Overview',
        'Edit_Profile'              =>'Edit Profile',
        'Change_Password'           =>'Change Password',
        'Details'                   =>'Profile Details',
        'FullName'                  =>'Full Name',
        'School'                    =>'School',
        'Job'                       =>'Job',
        'Phone'                     =>'Phone',
        'Email'                     =>'Email',
        'Image'                     =>'Profile Image',
        'FirstName'                 =>'First Name',
        'lastName'                  =>'last Name',
        'CurrentPassword'           =>'Current Password',
        'NewPassword'               =>'New Password',
        'ConfirmPassword'           =>'Re-enter New Password',      
    ],
    'pages'                         =>[
        'Home'                      =>'Home',
        'Profile'                   =>'Profile',
    ],
];