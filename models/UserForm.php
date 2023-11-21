<?php

namespace app\models;

use yii\base\Model;

class UserForm extends Model
{
    public $id;
    public $username;
    public $name;

    public function rules()
    {
        return [];
    }
}