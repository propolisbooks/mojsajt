<?php
require_once("funkcije.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Lineweb</title>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&amp;subset=latin-ext" rel="stylesheet">

<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link href="css/style.css" rel="stylesheet" type="text/css">

</head>

<body>

<div id="wrapper">

    <div id="header">
        <?php include("temp_header.html");?>
                
    </div><!-- end #header -->

    <div id="nav">
    
    <ul>
        <li><a href="index.php">Početna</a></li>
        <?php
        $db=konekcija();
        if(!$db)
        {
            echo "Baza nije dostupna. Pokusajte kasnije!!!";
            exit();
        }
        $sql="SELECT DISTINCT kategorija FROM vesti ORDER by kategorija ASC";
        $result=mysqli_query($db, $sql);
        while($red=mysqli_fetch_object($result))
            echo "<li><a href='index.php?kategorija=$red->kategorija'>$red->kategorija</a></li>";
        /*for($i=0;$i<mysqli_num_rows($result);$i++)
        {
            $red=mysqli_fetch_object($result);
            echo "<li><a href='index.php?kategorija=$red->kategorija'>$red->kategorija</a></li>";
        }*/
        mysqli_close($db);  
        ?>
        <li><a href="#">Galerije</a>
                    <ul>
                    <?php
                    $db=konekcija();
                    $sql="SELECT * FROM galerije ORDER BY id DESC";
                    $result=mysqli_query($db, $sql);
                    while($red=mysqli_fetch_object($result))
                        echo "<li><a href='galerije.php?idGalerije=$red->id'>$red->nazivGalerije</a></li>";
                    ?>
                        <!--<li><a href="pocetna.php">Dodavanje</a></li>
                        <li><a href="izmena.php">Izmena</a></li>-->
                        
                    </ul>
                </li>
        <li><a href="admin/index.php">Prijava na sistem</a></li>
    </ul>
    
    
        <div id="social">

            <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>

        </div>
    
    
    </div><!-- end #nav -->

    <div id="main">
    <?php
    //echo "Ovde ide dinamika";
    $db=konekcija();
    if(!$db)
    {
        echo "Baza nije dostupna. Pokusajte kasnije!!!";
        exit();
    }
    $sql="SELECT * FROM vesti WHERE obrisan=0 ORDER BY id DESC";
    if(isset($_GET['kategorija'])) $sql="SELECT * FROM vesti WHERE obrisan=0 AND kategorija='".$_GET['kategorija']."' ORDER BY id DESC";
    $result=mysqli_query($db, $sql);
    while($red=mysqli_fetch_object($result))
    {
        echo "<h2><a href='vest.php?id=$red->id'>$red->naslov</a></h2>";
        //<img src="images/hero.jpg" alt="Lineweb">
        if($red->slika!="") echo "<img src='images/$red->slika' alt='Lineweb' height='100px'>";
        echo "<p>".substr($red->sadrzaj,0,200)."</p>";
        echo $red->autor." <i>".$red->datum."</i>";
        echo "<hr>";
    }
        
    ?>
        <!--<h1> Lorem ipsum dolor sit amet.</h1>
        <p><a href="#">Lorem ipsum dolor sit amet</a>, consectetur adipisicing elit. Ad magni nisi, eos expedita labore sequi quasi ducimus error quae iure, eveniet nam aut dolor optio, dolores quod sapiente hic nemo.</p>
        <h2>Neki novi naslov</h2>
        <img src="images/hero.jpg" alt="Lineweb">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam iste quasi alias voluptatibus similique! Eos, dolore? Mollitia, dicta aspernatur sequi.</p>-->
    </div><!-- end #main -->

    <div id="sidebar">
    
        <div class="block">
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
        </div>
        
    </div><!-- end #sidebar -->
    
    <div id="footer">
        <?php include("temp_footer.html");?>
    </div>
    
</div><!-- end #wrapper -->


</body>
</html>








