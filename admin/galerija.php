<?php
session_start();
require_once("class_Logs.php");
if(!isset($_SESSION['ime']) or !isset($_SESSION['status']))
{
    header("Location: index.php");
    exit();
}
require_once("../funkcije.php");

?>

    <div id="main">
    
    <form action="#" method="post">
    <input type="text" id="imeGalerije" name="imeGalerije" placeholder="Unesite ime galerije"/><br><br>
    <input type="submit" value="Snimi galeriju"><br>
    </form>
    <hr>
    <?php
        $db=konekcija();
        if(!$db)
        {
            echo "Neuspela konekcija na bazu!!!!";
            exit();
        }
        if(isset($_POST['imeGalerije']))
        {
            $sql="INSERT INTO galerije (nazivGalerije, autor) VALUES ('".$_POST['imeGalerije']."','".$_SESSION['korime']."' )";
            mysqli_query($db, $sql);
        }
    ?>
    <br>
    <form action="#" method="post" enctype="multipart/form-data">
    <select id="idGalerije" name="idGalerije">
    <?php
    $sql="SELECT * FROM galerije ORDER BY id DESC";
    $result=mysqli_query($db, $sql);
    while($red=mysqli_fetch_object($result))
        echo "<option value='$red->id'>$red->nazivGalerije</option>";
    
    ?>
    </select><br><br>
    <input type="file" id="slika1" name="slika1"/><br>
    <input type="file" id="slika2" name="slika2"/><br>
    <br>
    <input type="submit" name="Snimi slike"/><br><br>
    
    <?php
    /*$result=mysqli_query($db, $sql);
    while($red=mysqli_fetch_object($result))
        echo "<input type='radio' id='radio_idGalerije' name='radio_idGalerije' value='$red->id'> $red->nazivGalerije<br>";*/
    ?>
    </form>
    <?php
        if(isset($_POST['idGalerije']) AND isset($_FILES['slika1']['name']))
        {
            $novoime=time()."_1.".pathinfo($_FILES['slika1']['name'],PATHINFO_EXTENSION);
            $sql="INSERT INTO galerijeslike (idGalerije, slika) VALUES(".$_POST['idGalerije'].", '$novoime')";
            //echo $sql;
            mysqli_query($db, $sql);
            move_uploaded_file($_FILES['slika1']['tmp_name'], "../galerije/$novoime");
            if(isset($_FILES['slika2']['name']))
            {
                $novoime=time()."_2.".pathinfo($_FILES['slika2']['name'],PATHINFO_EXTENSION);
                $sql="INSERT INTO galerijeslike (idGalerije, slika) VALUES(".$_POST['idGalerije'].", '$novoime')";
                mysqli_query($db, $sql);
                move_uploaded_file($_FILES['slika2']['tmp_name'], "../galerije/$novoime");
            }
            
        }
    ?>
    </div><!-- end #main -->

    <div id="sidebar">
        
    </div><!-- end #sidebar -->
    
    <div id="footer">
        <p>Copyright &copy; Lineweb</p>
    </div>
    
</div><!-- end #wrapper -->


</body>
</html>








