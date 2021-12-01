<?php 
namespace IonauthView\Models;

/*
 * File: User.php
 * Project: Models
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


use CodeIgniter\Model;

class User extends Model {

    protected $table            = 'users';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;

    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
        'username',
        'password',
        'email',
        'activation_code',
        'forgotten_password_code',
        'forgotten_password_time',
        'remember_code',
        'active',
        'fullname',
        'phone',
        'address',
        'picture',
        'uuid',
    ];

    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (! isset($data['data']['password'])) return $data;

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        // unset($data['data']['password']);

        return $data;
    }

}