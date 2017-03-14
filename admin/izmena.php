<?php
session_start();
require_once("class_Logs.php");
if(!isset($_SESSION['ime']) or !isset($_SESSION['status']))
{
    /*$obj=new Logs("Neuspesan pristup stranici pocetna.php sa ip adrese ".$_SERVER['REMOTE_ADDR']."\r\n");
$obj->dodajDolazak();*/
    header("Location: index.php");
    exit();
}
require_once("../funkcije.php");

/*$obj=new Logs("Korisnik ".$_SESSION['korime']." je dosao na stranicu pocetna.php sa ip adrese ".$_SERVER['REMOTE_ADDR']."\r\n");
$obj->dodajDolazak();*/
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
    <?php include("temp_meni.html");?>
    <!--<ul>
        <li><a href="index.html">home page</a></li>
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
        <li><a href="gallery.html">gallery</a></li>
    </ul>-->
    
    
        <div id="social">

            <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>

        </div>
    
    
    </div><!-- end #nav -->

    <div id="main">
    <form id="izborVesti" name="izborVesti" action="#" method="post">
        <select id="vest" name="vest">
        <?php
        $db=konekcija();
        $sql="SELECT id, naslov FROM vesti WHERE obrisan=0 ORDER BY id desc";
        $result=mysqli_query($db, $sql);
        while($red=mysqli_fetch_object($result))
            echo "<option value='$red->id'>$red->naslov</option>";
        ?>
        </select><br><br>
        <input type="submit">
    </form>
    <hr>
    <br>
    <?php
    $id="";
    $naslov="";
    $kategorija="";
    $sadrzaj="";
    $komentar="";
    if(isset($_POST['vest']))
    {
        //echo $_POST['vest'];
        $sql="SELECT * FROM vesti WHERE id=".$_POST['vest'];
        $result=mysqli_query($db, $sql);
        $red=mysqli_fetch_object($result);
        $id=$red->id;
        $naslov=$red->naslov;
        $kategorija=$red->kategorija;
        $sadrzaj=$red->sadrzaj;
        $komentar=$red->komentar;
    }
    ?>
    <form action="#" method="post" enctype="multipart/form-data">
    <input type="text" id="idVesti" name="idVesti" value="<?=$id?>" /><br><br>
<input type="text" id="naslov" name="naslov" value="<?=$naslov?>"/><br><br>
<textarea id="sadrzaj" name="sadrzaj" ><?=$sadrzaj?></textarea><br><br>
<select id="kategorija" name="kategorija">
    <option value="<?=$kategorija?>"><?=$kategorija?></option>
    <option value="Sport">Sport</option>
    <option value="Hronika">Hronika</option>
    <option value="Politika">Politika</option>
    <option value="Zabava">Zabava</option>
</select><br><br>
<input type="text" id="komentar" name="komentar" value="<?=$komentar?>"/><br><br>
<input type="file" id="slika" name="slika"><br><br>
<input type="submit">
</form>
    </form>
    <?php
    if(isset($_POST['naslov']) and isset($_POST['sadrzaj']))
    {
        $id=$_POST['idVesti'];
        $naslov=$_POST['naslov'];
        $sadrzaj=$_POST['sadrzaj'];
        $kategorija=$_POST['kategorija'];
        $komentar=$_POST['komentar'];
        if($_FILES['slika']['name']!="")
        {
            $slika=time().".".pathinfo($_FILES['slika']['name'],PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['slika']['tmp_name'], "../images/".$slika);
            $sql="UPDATE vesti SET slika='$slika' WHERE id=".$id;
            mysqli_query($db, $sql);
        }
            
        //else $slika="";
        $sql="UPDATE vesti SET  naslov='$naslov', sadrzaj='$sadrzaj', kategorija='$kategorija', komentar='$komentar', autor='".$_SESSION['korime']."'  WHERE id=".$id;
        //echo $sql;
        //$sql="INSERT INTO vesti ( naslov,sadrzaj, kategorija, slika, autor, komentar) VALUES ('$naslov', '$sadrzaj', '$kategorija', '$slika', '".$_SESSION['korime']."', '$komentar')";
        
        mysqli_query($db, $sql);
        $obj=new Logs("Izmenjena vest sa id=".$id." od strane ".$_SESSION['korime']."\r\n");
        $obj->dodajVestLog();
        header("Location:izmena.php");
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








