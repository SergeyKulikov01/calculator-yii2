<?php
namespace app\commands;

use app\models\User;
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


        $admin = new User();
        $admin->name = 'Иванов И.И.';
        $admin->username = 'admin@admin.ru';
        $admin->role = 'Администратор';
        $admin->password = Yii::$app->getSecurity()->generatePasswordHash('q1');
        $admin->save();

        $auth = Yii::$app->authManager;
        $userRole = $auth->getRole('administrator');
        $auth->assign($userRole,1);

    }
}