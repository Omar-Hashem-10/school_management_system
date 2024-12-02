<?php

return [

    'validation'                    => [
        'password'                  => [
            'required'              => 'كلمة السر مطلوبه',
            'confirmed'             => 'كلمتا السر ليست متطابقه',
        ],
        'currentPassword'           => [
            'required'              => 'كلمة السر الحاليه مطلوبه',
            'notCorrect'            => 'كلمة السر الحاليه ليست صحيحة',
        ],
        'password_confirmation'     => [
            'required'              => 'يجب تأكيد كلمة السر',
        ]
    ],
    'aside'                         => [
        'Users'                     => 'المستخدمين',
        'Dashboard'                 => 'لوحة التحكم',
        'Attendance'                => [
            'Attendance'            => 'الحضور',
            'Employees'             => 'حضور الموظفين',
            'Students'              => 'حضور الطلاب',
        ],
        'Managements'               => 'الاداره',
        'Teachers'                  => 'المدرسين',
        'Students'                  => 'الطلاب',
        'Guardians'                 => 'اولياء الامور',
        'Roles'                     => 'صلاحيات المستخدمين',
        'Salaries'                  => 'المرتبات',
        'Employees'                 => 'الموظفين',
        'Levels'                    => 'المستويات',
        'Admins'                    => 'المشرفين',
        'Subjects'                  => 'المواد',
        'Schedule'                  => 'الجداول',
        'Time_Slots'                => 'الفترات الزمنيه',
        'Course_Codes'              => 'اكواد المواد',
        'Level_Subjects'            => 'المقررات حسب المستوي',
        'Classrooms'                => 'الفصول',
        'Days'                      => 'الايام',
    ],
    'profile'                       => [
        'Overview'                  =>'نظرة عامة',
        'Edit_Profile'              =>'تعديل بياناتك الشخصيه',
        'Change_Password'           =>'تغيير كلمة السر',
        'Details'                   =>'بياناتك الشخصيه',
        'FullName'                  =>'الاسم بالكامل',
        'School'                    =>'المدرسه',
        'Job'                       =>'الوظيفه',
        'Phone'                     =>'الموبايل',
        'Email'                     =>'البريد الالكتروني',
        'Image'                     =>'الصورة الشخصيه',
        'FirstName'                 =>'الاسم الاول',
        'LastName'                  =>'اسم العائله',
        'CurrentPassword'           =>'كلمة السر الحاليه',
        'NewPassword'               =>'كلمة السر الجديده',
        'ConfirmPassword'           =>'تأكيد كلمة السر الجديده',      
    ],
    'pages'                         =>[
        'Home'                      =>'الصفحه الرئيسيه',
        'Profile'                   =>'الصفحه الشخصيه',
    ],



];