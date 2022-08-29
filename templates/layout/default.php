<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'BookNook';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!--declaring font-awesome assets and font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Font-awesome declaration for all templates-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    
    <!--fetching CSS from the webroot's CSS folder. Used for ALL templates, global-->
    <?= $this->Html->css(['bootstrap.min.css', 'style.css']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
    <div class="wrapper d-flex align-items-stretch">
        <!--Loading the sidebar as an element here. Check out layout>elements>nav.php-->
        <?= $this->element('nav')  ?>

        <!--page content-->
        <div id="content" class="p-4 p-md-5 pt-5">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </div>
    
    <!--loading scripts-->
    <?=$this->Html->script('jquery.min.js'); ?>
    <?=$this->Html->script('popper.js'); ?>
    <?=$this->Html->script('bootstrap.min.js'); ?>
    <?=$this->Html->script('main.js'); ?>
    
   
    <!--note that I'm moving this to the bottom so that template scripts with ['block'=>'true'] will appear here-->
    <?= $this->fetch('script') ?>
</body>
</html>
