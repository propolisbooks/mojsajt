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
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        $sql="SELECT * FROM vesti WHERE id=$id";
        $result=mysqli_query($db, $sql);
        if(@mysqli_num_rows($result)==1)
        {
            $red=mysqli_fetch_object($result);
            echo "<h2><a href='vest.php?id=$red->id'>$red->naslov</a></h2>";
            echo "<h4>$red->kategorija</h4>";
            //<img src="images/hero.jpg" alt="Lineweb">
            if($red->slika!="") echo "<img src='images/$red->slika' alt='Lineweb' height='100px'>";
            echo "<p>".$red->sadrzaj."</p>";
            echo $red->autor." <i>".$red->datum."</i>";
            echo "<hr>";
            
        }
        else
        {
            echo "Nesto nije dobro!!!";
        }
    }
    if(isset($_POST['autor']) and isset($_POST['tekst']))
    {
        $autor=$_POST['autor'];
        $tekst=$_POST['tekst'];
        if($autor!="" and $tekst!="")
        {
            $sql="INSERT INTO komentari (idVesti, autor, tekst) VALUES ($id, '$autor', '$tekst')";
            @mysqli_query($db, $sql);
            if(mysqli_error($db)) echo mysqli_error($db);
        }
    }
        
    ?>
    <form action="#" method="post">
    <input type="text" id="autor" name="autor" placeholder="Unesite Vase ime"><br><br>
    <textarea id="tekst" name="tekst" rows="5" columns="40" placeholder="Unesite komentar"></textarea><br><br>
    <input type="submit" value="Snimi komentar"/>
    </form>
    <h3>Komentari</h3>
    <?php
    $sql="SELECT * FROM komentari WHERE idVesti=$id ORDER BY id desc    ";
    $result=mysqli_query($db, $sql);
    if(mysqli_num_rows($result)==0)
        echo "Nijedan komentar nije dodat za ovu vest!!!!<br>Budite prvi!!!<br>";
    else
    {
        while($red=mysqli_fetch_object($result))
        {
            echo "<b>$red->autor</b> - $red->datum<br>";
            echo $red->tekst."<br>";
            echo "voli me: <b><font color='green'>$red->volime</font></b>, ne voli me: <b><font color='red'>$red->nevolime</font></b><br><br>";
        }
    }
    ?>
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








