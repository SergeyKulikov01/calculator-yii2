<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;


class ProcessController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionQueue_results()
    {
        $counter = 0;
        $basePath = __DIR__ . '/../runtime/queue.job';
        while(true) {
            echo 'Текущая итерация: ' . $counter . PHP_EOL;

            if(file_exists($basePath) === true) {
                $data = file_get_contents($basePath);
                echo $data . PHP_EOL;
                unlink($basePath);
            }

            Sleep(2);
            $counter++;
        }


        return ExitCode::OK;
    }
}
