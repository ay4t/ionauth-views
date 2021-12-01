<?php 
namespace IonauthView\Config;

/*
 * File: InitConfig.php
 * Project: Config
 * Created Date: We Dec 2021
 * Author: Ayatulloh Ahad R
 * Email: ayatulloh@indiega.net
 * Phone: 085791555506
 * -----
 * Last Modified: Wed Dec 01 2021
 * Modified By: Ayatulloh Ahad R
 * -----
 * Copyright (c) 2021 Indiega Network
 * -----
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */


class InitConfig
{
    public $redirect_after_login     = 'dashboard';

    public $redirect_after_register  = 'auth/login';

    protected $register_field;

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function registerField() {
        return $this->register_field = [
            [
                'name'          => 'fullname',
                'placeholder'   => 'User Fullname',
                'type'          => 'text',
                'required'      => true,
            ],
            [
                'name'          => 'email',
                'placeholder'   => 'Email Address',
                'type'          => 'email',
                'required'      => true,
            ],
            
            [
                'name'          => 'identity',
                'placeholder'   => 'Username / UserID',
                'type'          => 'text',
                'required'      => true,
            ],
            [
                'name'          => 'password',
                'placeholder'   => 'Password',
                'type'          => 'password',
                'required'      => true,
            ],
            [
                'name'          => 'confirm_password',
                'placeholder'   => 'Confirm Password',
                'type'          => 'password',
                'required'      => true,
            ],
        
        ];
    }
}
