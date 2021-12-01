<?php 
namespace IonauthView\Controllers;

/*
 * File: Auth.php
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


use CodeIgniter\Controller;
use IonAuth\Libraries\IonAuth;
use IonauthView\Config\InitAssets;
use IonauthView\Config\InitConfig;
use IonauthView\Models\User;

class Auth extends Controller {

    protected $data;

    protected $config;

    protected $ionAuth;

    public function __construct()
    {
        helper(['html', 'form']);

        /** init plugin Config */
        $this->config = new InitConfig;
        
        /** initializing IonAuth Class */
        $this->ionAuth  = new IonAuth();

        /** create init Asset CSS and JS */
        $this->createInitAssets();

        $this->data['title']    = $this->config->createTitle(null);
    }

    /**
     * Membuat controller untuk halaman login
     **/
    public function signin()
    {   
        $this->data['title']        = $this->config->createTitle('Authentication');
        $this->data['container']    = view('IonauthView\Partials\login-form', $this->data);
        return view('IonauthView\Layouts', $this->data);
    }

    /**
     * Membuat controller untuk halaman register
     **/
    public function signup()
    {
        $this->data['title']        = $this->config->createTitle('Create New Account');
        $this->data['signup_field'] = $this->config->registerField();
        $this->data['container'] = view('IonauthView\Partials\signup-form', $this->data);
        return view('IonauthView\Layouts', $this->data);
    }

    /**
     * Membuat controller untuk halaman lupa password
     **/
    public function forgotPassword()
    {
        $this->data['title']        = $this->config->createTitle('Forgot a Password');
        $this->data['container'] = view('IonauthView\Partials\forgot-password-form', $this->data);
        return view('IonauthView\Layouts', $this->data);
    }

    /**
     * Controller untuk validasi kode lupa password apabila kode tersebut benar maka menampilkan password baru untuk di update
     **/
    public function resetPassword($forgotten_password_code = 'null')
    {

        /** 
         * Validasi untuk lupa password kode.
         * jika kode tersebut tidak benar maka menampilkan halaman 404
         **/
        $userdata   = new User();
        $userdata->where('forgotten_password_code', $forgotten_password_code);
        $userdata->where('forgotten_password_time >=', time() );
        $result     = $userdata->first();
        if ( ! $result ) {
            // throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            throw new \RuntimeException('Invalid Forgotten Password Code or is was expired time', 404);
        }

        $this->data['title']        = $this->config->createTitle('Create a New Password');
        $this->data['forgotten_password_code']  = $result->forgotten_password_code;
        $this->data['container'] = view('IonauthView\Partials\reset-password-form', $this->data);
        return view('IonauthView\Layouts', $this->data);
    }

    /**
     * Kontrol untuk keluar sesi atau logout
     **/
    public function signout()
    {
        // log the user out
		$this->ionAuth->logout();

		// redirect them to the login page
		return redirect()->to('/auth/login')->withCookies();
    }

    /**
     * Fungsi untuk menyediakan Asep CSS dan javascript kemudian dikirim ke view
     **/
    private function createInitAssets(){
        $data = new InitAssets();

        $outputJs     = '';
        foreach ($data->Js() as $js) {
            $outputJs .= script_tag($js) . "\n\t";
        }
        $this->data['js'] = $outputJs;

        $outputCss     = '';
        foreach ($data->Css() as $css) {
            $outputCss .= link_tag($css) . "\n\t";
        }
        $this->data['css'] = $outputCss;

        return $this->data;
    }

}