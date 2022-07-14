<?php include("inc_header.php")?>
<?php
$materi ="";
$matkul ="";
$isi    ="";
$error  ="";
$sukses ="";

if(isset($_GET['id'])){
  $id = $_GET['id'];
} else{
  $id = "";
}

if($id != ""){
  $sql1 = "SELECT * from halaman where id = '$id'";
  $q1 = mysqli_query($koneksi,$sql1);
  $r1 = mysqli_fetch_array($q1);
  $materi = $r1['Materi'];
  $matkul = $r1['Matkul'];
  $isi = $r1['Isi'];

  if($isi == ''){
    $error = "Data Tidak dDitemukan ";
  }
}

if(isset($_POST['simpan'])){
    $materi   = $_POST['materi'];
    $matkul   = $_POST['matkul'];
    $isi      = $_POST['isi'];

    if($materi =='' or $isi ==''){
        $error  ="Harap Masukkan Data yang Lengkap";
    }

    if(empty($error)){
      if($id != ""){
        $sql1 = "update halaman set Materi='$materi', Matkul ='$matkul', Isi ='$isi', Time=now() where id = $id";
      } else{
                $sql1  = "INSERT into halaman(materi,matkul,isi) values ('$materi','$matkul','$isi')";
      }

        $q1    = mysqli_query($koneksi,$sql1);
        if($q1){
            $sukses = "Data berhasil Diinput";
        } else{
            $error  = "Coba Lagi";
        }
    }

}

?>
<h1>INPUT PAGE</h1>
<div class="mb-3 row">
     <a href="index.php"><< Kembali</a>
</div>
<?php
if($error){
    ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error ?>
    </div>
    <?php
}
if($sukses){
    ?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses ?>
    </div>
    <?php
}
?>
<form action="" method="post">
<div class="mb-3 row">
    <label for="materi" class="col-sm-2 col-form-label">Materi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="materi" value="<?php echo $materi?>" name="materi">
    </div>
  </div>
  <div class="mb-3 row">
  <label for="matkul" class="col-sm-2 col-form-label">Matkul</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="matkul" value="<?php echo $matkul?>" name="matkul">
    </div>
  </div>
  <div class="mb-3 row">
  <label for="isi" class="col-sm-2 col-form-label">Isi</label>
    <div class="col-sm-10">
        <textarea name="isi" class="form-control"><?php echo $isi?></textarea>
    </div>
  </div>
  <div class="mb-3 row">
  <div class="col-sm-2"></div>
    <div class="col-sm-10">
      <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary"/>
    </div>
  
<?php include("inc_footer.php")?>