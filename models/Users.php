<?php

namespace app\models;

use yii\db\ActiveRecord;

class Users extends ActiveRecord
{

    public function AddUser($name,$email,$hash){
        $user = new Users();
        $user->name = $name;
        $user->username = $email;
        $user->password = $hash;
        $user->save();
    }
    public static function tableName(): string
    {
        return '{{%user}}';
    }
}