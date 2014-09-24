        <header class="header">
            <a href="switch_database.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <?php echo $_SESSION['Connection']; ?>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Notifications: style can be found in dropdown.less -->
                        <?php 

                        if ($_SESSION['Department']=='IT')
                            {
                                include_once('./root/dropdown/notifications.php'); 
                            }
                         ?>                        

                        <!-- User Account: style can be found in dropdown.less -->
                        <?php include_once('./root/dropdown/useraccount.php');  ?>
                    </ul>
                </div>
            </nav>
        </header>