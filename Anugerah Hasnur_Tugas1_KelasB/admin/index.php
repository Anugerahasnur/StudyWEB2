<?php include("inc_header.php") ?>
<?php
$sukses = "";
$katakunci = (isset($_GET['katakunci'])) ? $_GET['katakunci'] : "";
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1 = "delete from halaman where id = $id";
    $q1  = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil Hapus Data";
    }
}
?>
<h1 style="background-color: black; margin:0px 1215px 0px 500px;" >INFORMASI</h1>
<p>
    <a href="pageinput.php">
        <input type="button" class="btn btn-primary" value="Halaman Baru" />
    </a>
</p>
<?php
if ($sukses) {
?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses ?>
    </div>
<?php
}
?>
<form class="row g-3" method="get">
    <div class="col-auto">
        <input type="text" class="form-control" placeholder="Masukkan Kata Kunci" name="katakunci" value="<?php echo $katakunci ?>" />
    </div>
    <div class="col-auto">
        <input type="submit" name="cari" value="Cari Tulisan" class="btn btn-secondary" />
    </div>
</form>
<table class="table table-success table-striped">
    <thead>
        <tr>
            <th class="col-1">#</th>
            <th>Materi</th>
            <th>Matkul</th>
            <th class="col-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sqltambahan = "";
        if ($katakunci != "") {
            $array_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($array_katakunci); $x++) {
                $sqlcari[] = "(Materi LIKE '%" . $array_katakunci[$x] . "%' or Matkul LIKE '%" . $array_katakunci[$x] . "%' Isi LIKE '%" . $array_katakunci[$x] . "%')";
            }
            $sqltambahan  = "where" . implode("or", $sqlcari);
        }
        $sql1  = "SELECT * from halaman $sqltambahan order by id desc";
        $q1  = mysqli_query($koneksi, $sql1);
        $nomor = 1;
        while ($r1 = mysqli_fetch_array($q1)) {
        ?>
            <tr>
                <td><?php echo $nomor++ ?></td>
                <td><?php echo $r1['Materi'] ?></td>
                <td><?php echo $r1['Matkul'] ?></td>
                <td>
                    <a href="pageinput.php?id=<?php echo $r1['id'] ?>">
                        <span class="badge rounded-pill bg-dark">Edit</span>
                    </a>
                    <a href="index.php?op=delete&id=<?php echo $r1['id'] ?>" onclick="return confirm('Yakin Hapus?')">
                        <span class="badge rounded-pill bg-light text-dark">Delete</span>
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php include("inc_footer.php") ?>