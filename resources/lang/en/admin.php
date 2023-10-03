<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            
        ],
    ],

    'call-log' => [
        'title' => 'Call Logs',

        'actions' => [
            'index' => 'Call Logs',
            'create' => 'New Call Log',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'caller_phonenumber' => 'Caller phonenumber',
            'callee_phonenumber' => 'Callee phonenumber',
            '$call_id' => '$call',
            'user_id' => 'User',
            
        ],
    ],

    'call-log' => [
        'title' => 'Call Logs',

        'actions' => [
            'index' => 'Call Logs',
            'create' => 'New Call Log',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'call-log' => [
        'title' => 'Call Logs',

        'actions' => [
            'index' => 'Call Logs',
            'create' => 'New Call Log',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'caller_phonenumber' => 'Caller phonenumber',
            'callee_phonenumber' => 'Callee phonenumber',
            'call_id' => 'Call',
            'user_id' => 'User',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];