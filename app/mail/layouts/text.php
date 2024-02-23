<?php

use yii\mail\BaseMessage;
use yii\web\View;

/** @var View $this */
/** @var BaseMessage $message */
/** @var string $content */

$this->beginPage();
$this->beginBody();
echo $content;
$this->endBody();
$this->endPage();
