<?php

define('REQUEST_ID', uniqid('', true));

\Yii::setAlias('@app', __DIR__);
\Yii::setAlias('@runtime', __DIR__ . '/../runtime');
\Yii::setAlias('@app/web', __DIR__ . '/../web');
\Yii::setAlias('@modules', __DIR__ . '/../modules');
