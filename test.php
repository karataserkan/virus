<?php
//We loads autoloads
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/Psr4AutoloaderClass.php';

(new app\Psr4AutoloaderClass())->register();
