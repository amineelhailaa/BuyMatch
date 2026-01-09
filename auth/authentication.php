<?php

require_once __DIR__ . "/../repo/userRepository.php";
class authentication
{



    public static function login($email, $password): bool
    {
        if($user = userRepository::findByEmail($email)){
            if(password_verify($password, $user['password']) && $user['status'] ==='active'){
                $_SESSION['id'] = $user['id'];
                $_SESSION['role']= $user['role'];
                return  true;
            }
        }
            return false;

    }


    public static function signUp($data): bool
    {
        if(!userRepository::findByEmail($data['email'])){
          return  userRepository::createUser($data['nom'], $data['email'], password_hash($data['password'],PASSWORD_DEFAULT), $data['pic'], $data['phone'], $data['role']);
        }
        echo "email problem";
        return false;
    }


    public static function logout(): void{
        session_destroy();
    }
}