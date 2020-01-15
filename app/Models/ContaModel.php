<?php

namespace App\Models;
use CodeIgniter\Model;

class ContaModel extends Model {
    
    protected $table = 'conta';
    protected $primaryKey = 'id';

    protected $allowedFields = ['cep','cidade','email','fone','id','nome','sobreNome','password'];
    
    public function getContas($id = null){
        if($id === null){
            return $this->findAll();
        }
        return $this->asArray()->where(['id' => $id])->first();
    }
    public function getContaByEmail($email = null){
        return $this->asArray()->where(['email' => $email])->first();
    }
}