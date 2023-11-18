<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Users extends ActiveRecord
{

    public function AddUser($name,$email,$hash){
        $user = new Users();
        $user->name = $name;
        $user->username = $email;
        $user->password = $hash;
        $user->save();

        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('user');
        $auth->assign($authorRole, User::getId());
    }
    public static function tableName(): string
    {
        return '{{%user}}';
    }
}