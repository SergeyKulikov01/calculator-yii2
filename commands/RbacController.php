<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $isAdmin = $auth->createPermission('isAdmin');
        $isAdmin->description = 'Админ или нет';
        $auth->add($isAdmin);

        $roleAdministrator = $auth->createRole('administrator');
        $roleAdministrator->description = 'Администратор';
        $auth->add($roleAdministrator);
        $auth->addChild($roleAdministrator, $isAdmin);

        $roleUser = $auth->createRole('user');
        $roleUser->description = 'Пользователь';
        $auth->add($roleUser);

        $roleGuest = $auth->createRole('guest');
        $roleGuest->description = 'Гость';
        $auth->add($roleGuest);


    }
}