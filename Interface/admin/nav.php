<nav>
    <ul>
        <li>
            <a id='logo' href='index.php'><img src="../images/logo.png" class='navLogo' alt='logo'></a>
        </li>
        <li>
            <a class="<?php
                        if (PATH_PARTS['filename'] == "index") {
                            print 'activePage';
                        }
                        ?>" href="../templates/index.php">Home</a>
        </li>
        <li>
            <a class="<?php
                        if (PATH_PARTS['filename'] == "updateMain") {
                            print 'activePage';
                        }
                        ?>" href="../templates/updateMain.php">Edit</a>
        </li>
        <?php
        if (isset($_SESSION["id"])) {
            print '<li><a class="';
            if (PATH_PARTS['filename'] == "profile") {
                print 'activePage';
            }
            print '" href="../templates/profile.php">My Lists</a></li>';
        }
        ?>
        </li>

        <div class="dropdown">
            <button class="droptbtn">Admin
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="userReport.php">User Report</a>
            </div>
            <div class="dropdown-content">
                <a href="listReport.php">List Report</a>
            </div>
        </div>

        <li style='float:right'>
            <?php
            if (isset($_SESSION["id"])) {
                print '<a href="../templates/logout.php">Log Out</a>';
            } else {
                print '<a href="../templates/login.php"> Log In</a>';
            }
            ?>
        </li>
    </ul>
</nav>