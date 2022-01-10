<header id="header">
    <div id="headerWrap">
        <h1><img src="images/youma_logo.png" width="142" height="80" alt="logo"></h1>
        <nav id="mainnav">
            <p id="menuWrap"><a id="menu"><span id="menuBtn"></span></a></p>
            <div class="panel">
                <ul>
                <?php             
                if (isset($_SESSION["user_name"])) {
                ?>                  
                    <li><a href="index.php">TOP</a></li>
                    <li><a href="manual_view.php">MANUAL</a></li>
                    <li><a href="manual_create_new.php">NEW</a></li>
                    <li><a href="logout.php">LOGOUT「<?php echo $_SESSION["user_name"] ?>」</a></li>
                <?php
                }else{
                ?>    
                    <li><a href="index.php">TOP</a></li> 
                    <li><a href="login_page.php">SIGN IN</a></li>
                    <li><a href="signup_page.php">SIGN UP</a></li>
                <?php
                }
                
                ?>
                </ul>
            </div>
        </nav>
    </div>
</header>