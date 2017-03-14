<?php
require_once("../funkcije.php");
require_once("class_Logs.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Lineweb</title>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&amp;subset=latin-ext" rel="stylesheet">

<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link href="../css/style.css" rel="stylesheet" type="text/css">

</head>

<body>

<div id="wrapper">

    <div id="header">
        
        <div id="logo">
            <a href="../index.php">
                <img src="../images/logo.png" alt="Lineweb">
            </a>
        </div>
        
        <div id="slogan">
            <p>Lorem ipsum dolor</p>
        </div>
        
    </div><!-- end #header -->

    <div id="nav">
    
    <ul>
       <!-- <li><a href="index.html">home page</a></li>
        <li><a href="work.html">work</a></li>
        <li><a href="info.html">info</a></li>
        <li><a href="about.html">about us</a>
            <ul>
                <li><a href="story.html">our story</a>
                    <ul>
                        <li><a href="#">prvi neki</a></li>
                        <li><a href="#">drugi neki</a></li>
                        <li><a href="#">treci neki</a></li>
                        <li><a href="#">cetvrti</a></li>
                    </ul>
                </li>
                <li><a href="contact-us.html">contact us</a></li>
            </ul>
        </li>
        <li><a href="gallery.html">gallery</a></li>-->
    </ul>
    
    
        <div id="social">

            <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>

        </div>
    
    
    </div><!-- end #nav -->

    <div id="main">
    <form action="#" method="post">
    <input type="text" id="korime" name="korime" placeholder="Unesite korisničko ime"/><br>
    <input type="text" id="lozinka" name="lozinka" placeholder="Unesite lozinku"/><br>
    <input type="submit" value="Prijavite se"/>
    </form>
    <?php
    //echo "Ovde ide dinamika";
    $db=konekcija();
    if(!$db)
    {
        echo "Baza nije dostupna. Pokusajte kasnije!!!";
        exit();
    }
    if(isset($_POST['korime']) and isset($_POST['lozinka']))
    {
        $korime=$_POST['korime'];
        $lozinka=$_POST['lozinka'];
        if($korime!="" and $lozinka!="")
        {
            $sql="SELECT * FROM korisnici WHERE korime='$korime' AND lozinka='$lozinka'";
            $result=mysqli_query($db, $sql);
            if(mysqli_num_rows($result)==1)
            {
                $red=mysqli_fetch_object($result);
                session_start();
                $_SESSION['ime']=$red->ime;
                $_SESSION['status']=$red->status;
                $_SESSION['korime']=$red->korime;
                $obj=new Logs("Korisnik ".$red->korime." se uspesno prijavio\r\n");
                $obj->dodajLog();
                header("Location: pocetna.php");
            }
            else 
            {
                echo "Nije dobro korisničko ime i lozinka";
                $obj=new Logs("Neuspeo pokusaj prijavljivanja. Nije dobro korime i lozinka\r\n");
                $obj->dodajLog();
            }
        }else echo "Niste uneli potrebne podatke";
    }
    
        
    ?>
        <!--<h1> Lorem ipsum dolor sit amet.</h1>
        <p><a href="#">Lorem ipsum dolor sit amet</a>, consectetur adipisicing elit. Ad magni nisi, eos expedita labore sequi quasi ducimus error quae iure, eveniet nam aut dolor optio, dolores quod sapiente hic nemo.</p>
        <h2>Neki novi naslov</h2>
        <img src="images/hero.jpg" alt="Lineweb">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam iste quasi alias voluptatibus similique! Eos, dolore? Mollitia, dicta aspernatur sequi.</p>-->
    </div><!-- end #main -->

    <div id="sidebar">
    
        <!--<div class="block">
            <h2>Prvi</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt debitis praesentium rem voluptate consectetur quam excepturi expedita quae.</p>
        </div>
        <div class="block">
            <h2>Drugi</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt debitis praesentium rem voluptate consectetur quam excepturi expedita quae.</p>
        </div>
        <div class="block">
            <h2>Treci</h2>
            <p><a href="contact-us.html"><img src="images/location.png" alt="mapa"></a></p>
            <p><a href="contact-us.html">pogledajte detaljnije</a></p>
        </div>-->
        
    </div><!-- end #sidebar -->
    
    <div id="footer">
        <p>Copyright &copy; Lineweb</p>
    </div>
    
</div><!-- end #wrapper -->


</body>
</html>








