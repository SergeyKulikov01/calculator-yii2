<?php

namespace app\models;

use yii\db\ActiveRecord;

class SignupForm extends ActiveRecord
{
    public $password;
    public $password_repeat;
    public $name;
    public $username;

    public function rules()
    {
        return [
            ['username','email','message' => 'Email должен быть валидным.'],
            ['name', 'match', 'pattern' => '/^[a-zA-Zа-яА-Я]+$/','message' => 'Допустимы только буквы.'],
            [['password','password_repeat'], 'match', 'pattern' => '/^[a-zA-Z]+[0-9]+$/','message' => 'В пароле допустимы буквы a-Z и минимум одна цифра.'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password','message' => 'Поля должны совпадать.'],
            ['username', 'unique','message' => 'Этот адрес Email уже занят.'],
        ];
    }
    public static function tableName(): string
    {
        return '{{%user}}';
    }

}