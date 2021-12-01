<?php 
namespace IonauthView\Controllers;

/*
 * File: ForgotPassHandler.php
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


use CodeIgniter\RESTful\ResourceController;

class ForgotPassHandler extends ResourceController {

    protected $data;

    protected $validation;

    public function __construct()
    {
        $this->data['status']   = true;
        $this->data['message']  = null;
        $this->data['new_csrf'] = csrf_hash();

        $this->validation       = \Config\Services::validation();

        /** debugging */
    }

    /**
     * createForgotPassword
     *
     * Fungsi ini untuk membuat kode lupa password yang akan disimpan ke dalam database user yang 
     * ditujukan kemudian dikirim email berdasarkan email terdaftar di dalam tabel
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function createForgotPassword()
    {       

        /** validate form */
        $this->validation->setRule('identity', 'Username', 'required');
        $this->validation->setRule('email', 'Email Address', 'required|valid_email');
        if (! $this->validation->withRequest($this->request)->run() ){
            $this->data['status']   = false;
            $this->data['message']  = $this->validation->listErrors('list');
        }

        /** validate userdata with username and email */
        $username   = $this->request->getPost('identity');
        $email      = $this->request->getPost('email');
        $user       = new \IonauthView\Models\User;
        $user->where('username', $username);
        $user->where('email', $email);
        $result     =  $user->first();
        if ( ! $result ) {
            $this->data['status']   = false;
            $this->data['message']  = 'Username or Email not match in our record !';
        }

        if ( $this->data['status'] ) {
            
            $generateForgottenPasswordCode = hash('sha256', rand().time());
            $expiredIn  = strtotime('+2 days', time());

            $update = [
                'forgotten_password_code'    => $generateForgottenPasswordCode,
                'forgotten_password_time'    => $expiredIn,
            ];
            $user->update( $result->id, $update);
            
            /** send email forgotten password code */

            
            $this->data['message']  = 'Forgotten password code was sent to your email....';
            $this->data['heading']  = 'Information';
            $this->data['type']     = 'success';
            $this->data['success_url']     = '/auth/login';
        } else {
            $this->data['heading']  = 'Failed';
            $this->data['type']     = 'error';
        }

        return $this->respond($this->data)
        ->setStatusCode(200);

        // $code = $this->ionAuthModel->forgottenPassword($identity);
        // $forgotten = $this->ionAuth->forgottenPassword( $username );


    }

    /**
     * resetPassword
     *
     * Fungsi ini untuk membuat password baru dengan validasi kode yang sudah dibuat sebelumnya 
     * dan dikirim email apabila kode tersebut benar maka menampilkan form masukkan password baru
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function createResetPassword()
    {
        
        $password   = $this->request->getPost('new_password');
        $forgotten_password_code  = $this->request->getPost('forgotten_password_code');

        /** validate form */
        $this->validation->setRule('new_password', 'new password', 'required|alpha_numeric_space|min_length[6]');
        $this->validation->setRule('confirm_password', 'confirm password', 'required_with[new_password]|matches[new_password]');
        if (! $this->validation->withRequest($this->request)->run() ){
            $this->data['status']   = false;
            $this->data['message']  = $this->validation->listErrors('list');
        }

        /** validate userdata with forgotten password code */
        $user       = new \IonauthView\Models\User;
        $user->where('forgotten_password_code', $forgotten_password_code);
        $result     =  $user->first();
        if ( ! $result ) {
            $this->data['status']   = false;
            $this->data['message']  = 'Invalid or Expired Forgotten Password Code !';
        }

        if ( $this->data['status'] ) {
            
            /** updating userdata */
            $update = [
                'password'    => $password,
                'forgotten_password_code' => null,
                'forgotten_password_time' => null,
            ];
            $user->update( $result->id, $update);
            

            /** send email notifications */

            
            $this->data['message']  = 'New Password has changed. You can login with new password now !';
            $this->data['heading']  = 'Information';
            $this->data['type']     = 'success';
            $this->data['success_url']     = '/auth/login';
        } else {
            $this->data['heading']  = 'Failed';
            $this->data['type']     = 'error';
        }

        return $this->respond($this->data)
        ->setStatusCode(200);
    }

}