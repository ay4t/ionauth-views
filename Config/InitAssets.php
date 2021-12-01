<?php
namespace IonauthView\Config;

/*
 * File: InitAssets.php
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


Class InitAssets {

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function Js()
    {
        return [
            'auth-assets/js/jquery-3.5.0.min.js',
            'auth-assets/js/popper.min.js',
            'auth-assets/js/bootstrap.min.js',
            'auth-assets/js/imagesloaded.pkgd.min.js',
            'auth-assets/js/validator.min.js',
            'auth-assets/node_modules/jquery-toast-plugin/dist/jquery.toast.min.js',
            'auth-assets/node_modules/jquery.buttonloadingindicator/dist/jquery.buttonloadingindicator.js',
            'auth-assets/js/main.js',
        ];
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function Css()
    {
        return [
            'auth-assets/css/bootstrap.min.css',
            'auth-assets/css/fontawesome-all.min.css',
            'auth-assets/font/flaticon.css',
            'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap',
            'auth-assets/node_modules/jquery-toast-plugin/dist/jquery.toast.min.css',
            'auth-assets/style.css',
        ];
    }

}