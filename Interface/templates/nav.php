<nav>
    <ul>
        <li>
            <a id='logo' href='index.php'><img src="../images/logo.png" class='navLogo' alt='logo'></a>
        </li>
        <li>
            <a class ="<?php
            if(PATH_PARTS['filename'] == "profile") {
                print 'activePage';
            }
            ?>" href = "profile.php">Home</a>
        </li>
        <li>
            <a class ="<?php
            if(PATH_PARTS['filename'] == "about") {
                print 'activePage';
            }
            ?>" href = "about.php">About</a>
        </li>
        <li style='float:right'>
            <?php
            if (isset($_SESSION["id"])) {
            print '<a href="logout.php">Log Out</a>';
        } else {
            print '<a href="login.php"> Log In</a>';
        }
            ?>
        </li>
    </ul>
</nav>