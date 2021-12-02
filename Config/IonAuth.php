<?php 
namespace IonauthView\Config;

/*
 * File: IonAuth.php
 * Project: Config
 * Created Date: Fr Dec 2021
 * Author: Ayatulloh Ahad R
 * Email: ayatulloh@indiega.net
 * Phone: 085791555506
 * -----
 * Last Modified: Fri Dec 03 2021
 * Modified By: Ayatulloh Ahad R
 * -----
 * Copyright (c) 2021 Indiega Network
 * -----
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */


class IonAuth extends \IonAuth\Config\IonAuth
{
    // set your specific config to replace default IonAuth Config Property

    // public $siteTitle                = 'Example.com';       // Site Title, example.com
    // public $adminEmail               = 'admin@example.com'; // Admin Email, admin@example.com
    // public $emailTemplates           = 'App\\Views\\auth\\email\\';
    

    /** 
    * You can use any unique column in your table as identity column.
    * IMPORTANT: If you are changing it from the default (email), update the UNIQUE constraint in your DB 
    */
    public $identity                 = 'username';

    public $minPasswordLength        = 6;

    public $maximumLoginAttempts     = 5;

    

}