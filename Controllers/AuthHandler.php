<?php 
namespace IonauthView\Controllers;

/*
 * File: AuthHandler.php
 * Project: Controllers
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


use IonauthView\Config\InitConfig;
use CodeIgniter\RESTful\ResourceController;

class AuthHandler extends ResourceController {

    protected $data;
    
    protected $config;

    protected $ionAuth;

    protected $validation;

    protected $format    = 'json';

    public function __construct()
    {
        $this->data['status']   = true;
        $this->data['message']  = null;
        
        /** init plugin Config */
        $this->config = new InitConfig;

        $this->ionAuth          = new \IonAuth\Libraries\IonAuth();
        $this->validation       = \Config\Services::validation();
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
    public function doSignIn()
    {
        $this->data['new_csrf'] = csrf_hash();
        $actionStatus = false;

        /** validate form */
        $this->validation->setRule('identity', 'Username', 'required');
		$this->validation->setRule('password', 'Password', 'required');
        if (! $this->validation->withRequest($this->request)->run() ){
            $this->data['status']   = false;
            $this->data['message']  = $this->validation->listErrors('list');
        }

        /** validate Captcha here if available */


        /** validate login data */
        if ( $this->data['status'] ) {
            $remember       = (bool)$this->request->getVar('remember');
            $identity       = $this->request->getVar('identity');
            $password       = $this->request->getVar('password');

            $ionAuthLogin   = $this->ionAuth->login( $identity, $password, $remember);
            if (! $ionAuthLogin ){
                $this->data['status']   = false;
                $this->data['message']  = $this->ionAuth->errors();
            } else {
                $actionStatus = true;
            }
        } 

        if ( $actionStatus ) {
            
            $this->data['message']  = 'Login Autorized. You will redirecting...';
            $this->data['heading']  = 'Information';
            $this->data['type']     = 'success';
            $this->data['success_url']     = site_url( $this->config->redirect_after_login );;
        } else {
            $this->data['heading']  = 'Failed';
            $this->data['type']     = 'error';
        }

        return $this->respond($this->data)
        ->setStatusCode(200);
    }

} 