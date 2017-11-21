<?php
// common.php
require('conf.php');
require('lang.en.php');

require('DataLink.php');
require('MessageModel.php');
require('MessageModelFactory.php');
require('MessageFactory.php');
require('FrontControllerAbstract.php');
require('PageControllerAbstract.php');
require('ViewHelper.php');



require(DIR_CONTROLLERS . 'ErrorViewController.php');
require(DIR_CONTROLLERS . 'MessageCreateController.php');
require(DIR_CONTROLLERS . 'MessageViewController.php');
