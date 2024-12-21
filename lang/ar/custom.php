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
        'AcademicYears'             => 'السنوات الدراسيه',
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
        'Exams'                     => 'الامتحانات',
        'Certificate'               => 'النتيجه',
        'Tasks'                     => 'الواجبات',
        'Contact'                   => 'التواصل'
    ],
    'profile'                       => [
        'Overview'                  => 'نظرة عامة',
        'Edit_Profile'              => 'تعديل بياناتك الشخصيه',
        'Change_Password'           => 'تغيير كلمة السر',
        'Details'                   => 'بياناتك الشخصيه',
        'FullName'                  => 'الاسم بالكامل',
        'School'                    => 'المدرسه',
        'Job'                       => 'الوظيفه',
        'Phone'                     => 'الموبايل',
        'Email'                     => 'البريد الالكتروني',
        'Image'                     => 'الصورة الشخصيه',
        'FirstName'                 => 'الاسم الاول',
        'LastName'                  => 'اسم العائله',
        'CurrentPassword'           => 'كلمة السر الحاليه',
        'NewPassword'               => 'كلمة السر الجديده',
        'ConfirmPassword'           => 'تأكيد كلمة السر الجديده',
    ],
    'pages'                         => [
        'Home'                      => 'الصفحه الرئيسيه',
        'Profile'                   => 'الصفحه الشخصيه',
    ],
    'Home'                          => [
        'TotalAmount'               => 'اجمالي المصروفات',
        'TotalPaied'                => 'اجمالي المدفوعات',
        'GPA'                       => 'المعدل التراكمي',
        'TotalUsers'                => 'عدد المستخدمين',
        'StudentsWhoPaied'          => 'عدد من سدد المصاريف',
        'StudentDoesntPaied'        => 'من لم يسددو المصاريف',
        'UsersTraffic'              => 'احصائيات المستخدمين',
    ],
    'nav'                           => [
        'MyProfile'                 => 'الملف الشخصي',
        'LogOut'                    => 'تسجيل الخروج'
    ],
    'table'                         => [
        'Image'                     => 'الصوره',
        'Name'                      => 'الاسم',
        'Level'                     => 'المستوي',
        'ClassRoom'                 => 'الفصل',
        'Actions'                   => 'الاجراءات',
        'Possition'                 => 'الوظيفه',
        'Email'                     => 'البريد',
        'Phone'                     => 'الموبابل',
        'Salary'                    => 'المرتب',
        'Gender'                    => 'الجنس',
        'Subject'                   => 'الماده',
        'Role'                      => 'الصلاحيه',
        'For'                       => 'ل',
        'StudentName'               => 'اسم الطالب',
        'GuardianName'              => 'اسم ولي الامر',
        'Relation'                  => 'الصله',
        'Date'                      => 'الموعد',
        'AcademicYear'              => 'السنه الدراسيه',
        'Semester'                  => 'الترم',
        'CreatedAt'                 => 'اتضاف في',
        'UpdatedAt'                 => 'اتعدل في',
        'StartDate'                 => 'يبدا عند',
        'EndDate'                   => 'ينتهي عند',
        'Status'                    => 'الحاله',
        'Amount'                    => 'السعر',
        'Day'                       => 'اليوم',
        'LectureNumber'             => 'رقم الحصه',
        'Create'                    => 'اضافة',

    ],
    'actions'                       => [
        'Edit'                      => 'تعديل',
        'Delete'                    => 'حذف',
        'View'                      => 'عرض',
        'SendMail'                  => 'ارسال ميل',
        'AddAmount'                 => 'خصم/علاوة',

    ],


];