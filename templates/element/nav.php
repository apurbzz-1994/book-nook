<?php 
    // checking to see if the user is visiting their own profile
    // if not, then certain controls need to be disabled. 
    $userAuthenticated = false;
    $userId = null;
    if(!empty($this->Identity->get('id'))){
        $userAuthenticated = true;
        $userId = $this->Identity->get('id');
    }
?>


<nav id="sidebar">
    <div class="custom-menu">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
        </button>
    </div>
    <div class="p-4 pt-5">
        <h1><a href="index.html" class="logo"><i class="fas fa-book"></i> Book Nook</a></h1>
        <div class="mb-5">
            <!--fetching user's name for display-->
            <!--Also login/logout dynamic feature-->
            <?php if(!$userAuthenticated){ ?>
                <?= $this->Html->link(__('Login'), ['controller'=>'Users', 'action' => 'login'], ['class' => 'btn btn-outline-light']) ?>
            <?php } else{ ?>
                <h3 class="h6">Hello, <?= $this->Identity->get('name') ?>!</h3>
                <?= $this->Html->link(__('Logout'), ['controller'=>'Users', 'action' => 'logout'], ['class' => 'btn btn-outline-light']) ?>
            <?php } ?>
        </div>
        <ul class="list-unstyled components mb-5">
            <!--Profile information, should not be visible when user is logged out-->
            <?php if($userAuthenticated){ ?>
            <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Profile</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                    <?= $this->Html->link(__('View'), ['controller'=>'Users', 'action' => 'view', $userId]) ?>
                    </li>
                    <li>
                    <?= $this->Html->link(__('Account Settings'), ['controller'=>'Users','action' => 'edit', $userId]) ?>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <li>
            <?= $this->Html->link(__('Books'), ['controller'=> 'Books', 'action' => 'index']) ?>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="#">Page 1</a>
                    </li>
                    <li>
                        <a href="#">Page 2</a>
                    </li>
                    <li>
                        <a href="#">Page 3</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Portfolio</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>

        <div class="footer">
            <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>
                    document.write(new Date().getFullYear());
                </script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
        </div>

    </div>
</nav>