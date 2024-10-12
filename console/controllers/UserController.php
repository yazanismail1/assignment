<?php
namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;

class UserController extends Controller
{
    public function actionCreateAdmin($username, $email, $password)
    {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);
        $user->generateAuthKey();
        $user->role = User::ROLE_ADMIN; // Set role to admin

        if ($user->save()) {
            echo "Admin user created successfully.\n";
        } else {
            echo "Failed to create admin user: " . implode(", ", $user->getErrors()) . "\n";
        }
    }
}
