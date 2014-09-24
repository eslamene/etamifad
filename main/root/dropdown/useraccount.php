                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $_SESSION["First_Name"].' '.$_SESSION["Second_Name"] ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-black">
                                    <img src="<?php echo 'img/avatar/'.$_SESSION['Avatar'].'.png'; ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $_SESSION["First_Name"].' '.$_SESSION["Second_Name"]; ?>
                                        <small><?php echo $_SESSION["Department"].' - '.$_SESSION["Designation"]; ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#"></a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <b><?php echo $_SESSION["Department"]; ?></b>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#"></a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div>
                                        <a href="editprofile.php" class="btn bg-black btn-flat btn-block">Profile</a>
                                    </div>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="switch_database.php" class="btn btn-default btn-flat">Switch Database</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>