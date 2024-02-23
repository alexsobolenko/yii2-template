<?php

declare(strict_types=1);

namespace app\widgets;

use yii\bootstrap5\Alert as BaseAlert;
use yii\bootstrap5\Widget;

class Alert extends Widget
{
    /**
     * @var array
     */
    public $alertTypes = [
        'error' => 'alert-danger',
        'danger' => 'alert-danger',
        'success' => 'alert-success',
        'info' => 'alert-info',
        'warning' => 'alert-warning'
    ];

    /**
     * @var array
     */
    public $closeButton = [];

    /**
     * @return string|void
     * @throws \Throwable
     */
    public function run()
    {
        $session = \Yii::$app->session;
        $appendClass = isset($this->options['class']) ? ' ' . $this->options['class'] : '';

        foreach (array_keys($this->alertTypes) as $type) {
            $flash = $session->getFlash($type);
            foreach ((array) $flash as $i => $message) {
                echo BaseAlert::widget([
                    'body' => $message,
                    'closeButton' => $this->closeButton,
                    'options' => array_merge($this->options, [
                        'id' => $this->getId() . '-' . $type . '-' . $i,
                        'class' => $this->alertTypes[$type] . $appendClass,
                    ]),
                ]);
            }

            $session->removeFlash($type);
        }
    }
}
