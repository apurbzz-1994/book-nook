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
            <?php if(empty($this->Identity->get('id'))){ ?>
                <?= $this->Html->link(__('Login'), ['action' => 'login'], ['class' => 'btn btn-outline-light']) ?>
            <?php } else{ ?>
                <h3 class="h6">Hello, <?= $this->Identity->get('name') ?>!</h3>
                <?= $this->Html->link(__('Logout'), ['action' => 'logout'], ['class' => 'btn btn-outline-light']) ?>
            <?php } ?>
        </div>
        <ul class="list-unstyled components mb-5">
            <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="#">Home 1</a>
                    </li>
                    <li>
                        <a href="#">Home 2</a>
                    </li>
                    <li>
                        <a href="#">Home 3</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">About</a>
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