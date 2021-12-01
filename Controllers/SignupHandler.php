<?php 
namespace IonauthView\Controllers;

/*
 * File: SignupHandler.php
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


use IonAuth\Libraries\IonAuth;
use IonauthView\Config\InitConfig;
use CodeIgniter\RESTful\ResourceController;

class SignupHandler extends ResourceController
{
    protected $data;

    protected $config;

    protected $ionAuth;

    protected $validation;

    protected $format    = 'json';

    public function __construct()
    {
        $this->data['status']   = true;
        $this->data['message']  = null;
        $this->data['new_csrf'] = csrf_hash();

        /** init plugin Config */
        $this->config           = new InitConfig;

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
    public function create()
    {
        $actionStatus = false;

        /** validate signup form */
        $this->validation->setRule('fullname', 'User Fullname', 'required|alpha_numeric_space|min_length[4]');
        $this->validation->setRule('email', 'Email Address', 'required|valid_email');
        $this->validation->setRule('identity', 'Username', 'required|is_unique[users.username]|alpha_numeric');
		$this->validation->setRule('password', 'Password', 'required|min_length[6]');
		$this->validation->setRule('confirm_password', 'Confirm Password', 'required_with[password]|matches[password]');
        if (! $this->validation->withRequest($this->request)->run() ){
            $this->data['status']   = false;
            $this->data['message']  = $this->validation->listErrors('list');
        }

        if ( $this->data['status'] ) {
            
            /** validate ionauth register */
            $doRegister = $this->ionAuth->register(
                $this->request->getPost('identity'),
                $this->request->getPost('password'),
                $this->request->getPost('email'), 
                [ 'members' ] 
            );

            if ( ! $doRegister ) {
                $this->data['status']   = false;
                $this->data['message']  = $this->ionAuth->errors();
            } else {
                $actionStatus       = true;
            }

        }
        
        if ( $actionStatus ) {
            
            $this->data['message']  = 'Register Successfully.';
            $this->data['heading']  = 'Information';
            $this->data['type']     = 'success';
            $this->data['success_url']     = site_url( $this->config->redirect_after_register );;
        } else {
            $this->data['heading']  = 'Failed';
            $this->data['type']     = 'error';
        }

        return $this->respond($this->data)
        ->setStatusCode(200);

    }
}