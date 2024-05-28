<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h1 {
            font-size: 1.5em;
            margin-bottom: 20px;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="submit"][name="kirim"] {
            background-color: #28a745;
            color: #fff;
        }
        button[type="submit"][name="reset"] {
            background-color: #dc3545;
            color: #fff;
        }
        .hapus {
            color: #dc3545;
            text-decoration: none;
            font-weight: bold;
        }
        .hapus:hover {
            text-decoration: underline;
        }
        p {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>Data Siswa</h1>
        <form method="post" action="">
            <label for="siswa">Nama Siswa</label>
            <input type="text" name="siswa" id="siswa" placeholder="Input Nama">
            <label for="nis">NIS</label>
            <input type="number" name="nis" id="nis" placeholder="Input NIS">
            <label for="rayon">Rayon</label>
            <input type="text" name="rayon" id="rayon" placeholder="Input Rayon">
            <button type="submit" name="kirim">Kirim</button>
            <button type="submit" name="reset" style="margin-top:10px;">Reset</button>
        </form>

        <?php
        session_start();
        if(isset($_POST['reset'])){
            session_unset();
            header('Location: '. $_SERVER['PHP_SELF']);
            exit;
        }
        if(isset($_GET['hapus'])){
            $index = $_GET['hapus'];
            unset($_SESSION['dataSiswa'][$index]);
        }
        if(!isset($_SESSION['dataSiswa'])){
            $_SESSION['dataSiswa'] = array();
        }
        if(isset($_POST['kirim'])){
            if(@$_POST['siswa'] && @$_POST['nis'] && @$_POST['rayon']){
                $data = [
                    'siswa' => $_POST['siswa'],
                    'nis' => $_POST['nis'],
                    'rayon' => $_POST['rayon']
                ];
                array_push($_SESSION['dataSiswa'], $data);
                header('Location: '. $_SERVER['PHP_SELF']);
                exit;
            } else {
                echo "<p>Lengkapi Data</p>";
            }
        }
        if(!empty($_SESSION['dataSiswa'])){
            foreach($_SESSION['dataSiswa'] as $index=> $value){
                echo "<p>Nama Siswa : ". $value['siswa'] . "</p>";
                echo "<p>NIS : " . $value['nis'] . "</p>";
                echo "<p>Rayon : " . $value['rayon'] . "</p>";
                echo '<a href="?hapus=' . $index . '" class="hapus">HAPUS</a><br>';
            }
        }
        ?>
    </div>
</body>
</html>
