<?php

$date_format = 'Y-m-d'; //date formatını tanımlayarak çıkytıyı doğru şekilde alıyoruz
$mysqli = require __DIR__ . "/db.php"; 
if(isset($_POST['editUser'])){

    if(isset($_GET['id'])) {
        $class_id = $_GET['id'];
    }
     
    $id = $_POST['editUser'];
    $name = ucfirst($_POST['name']);
    $surname = strtoupper($_POST['surname']);
    $tc = $_POST['tc'];
    $sınıf = $_POST['sınıf'];


    // SECİLEN SINIFA GÖRE ÖĞRETMENİ DEĞİŞTİRME
    $dandsql = "SELECT * FROM sınıflar WHERE tname = ?";
    $stmt = $mysqli->prepare($dandsql);
    $stmt->bind_param("s", $sınıf);
    $stmt->execute();
    $sinif_degiskeni = $stmt->get_result();

    // "dans" sınıfının değerini elde edin
    $sinif_sonucu = mysqli_fetch_assoc($sinif_degiskeni);
    $tür = $sinif_sonucu['dans'];


    $sql = "UPDATE bilgiler SET name =?, surname = ?, tc =?, tür =?, sınıf=? where id =?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssssi", $name, $surname, $tc, $tür, $sınıf, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: classTable.php?id=$class_id");
        exit;
    } else {
        header("Location: classTable.php?id=$class_id");
        die($mysqli->error . " Tabloda Değişiklik yapmadınız" . $mysqli->errorno);
    }
}

//yeni sınıf

if(isset($_POST['newClass'])){
        

    $tname = filter_input(INPUT_POST, 'tname', FILTER_SANITIZE_STRING);
    $tname = strtoupper($tname);
    $teacher = filter_input(INPUT_POST, 'teacher', FILTER_SANITIZE_STRING);
    $teacher = ucfirst($teacher);
    $dans = filter_input(INPUT_POST, 'dans', FILTER_SANITIZE_STRING);
    $day = filter_input(INPUT_POST, 'day', FILTER_SANITIZE_STRING);
    $stime = filter_input(INPUT_POST, 'start-time', FILTER_SANITIZE_STRING);
    $ftime = filter_input(INPUT_POST, 'end-time', FILTER_SANITIZE_STRING);
    $percent = filter_input(INPUT_POST, 'percent', FILTER_SANITIZE_NUMBER_INT);
    $time = $stime . " - " . $ftime;
        
     // Prepare SQL statement
     $sql = "INSERT INTO sınıflar (tname, teacher, dans, day, time, percent) VALUES (?, ?, ?, ?, ?, ?)";
     $stmt = $mysqli->prepare($sql);
 
     // Bind parameters
     $stmt->bind_param("sssssi", $tname, $teacher, $dans, $day, $time, $percent);
 
     // Execute statement
     if ($stmt->execute()) {
         header("Location: sınıflar.php?success=true");
         exit;
     } else {
         $error_message = "Error: " . $mysqli->error;
         error_log($error_message, 0);
         die("An error occurred while inserting the record.");
     }
     
}

//special sınıf
if(isset($_POST['newSpecial'])){
        

    $tname = filter_input(INPUT_POST, 'tname', FILTER_SANITIZE_STRING);
    $tname = strtoupper($tname);
    $teacher = filter_input(INPUT_POST, 'teacher', FILTER_SANITIZE_STRING);
    $teacher = ucfirst($teacher);
    $dans = filter_input(INPUT_POST, 'dans', FILTER_SANITIZE_STRING);
    $day = 0;
    $stime = 0;
    $ftime = 0;
    $percent = 0;
    $time = 0;
        
     // Prepare SQL statement
     $sql = "INSERT INTO sınıflar (tname, teacher, dans, day, time, percent) VALUES (?, ?, ?, ?, ?, ?)";
     $stmt = $mysqli->prepare($sql);
 
     // Bind parameters
     $stmt->bind_param("sssssi", $tname, $teacher, $dans, $day, $time, $percent);
 
     // Execute statement
     if ($stmt->execute()) {
         header("Location: sınıflar.php?success=true");
         exit;
     } else {
         $error_message = "Error: " . $mysqli->error;
         error_log($error_message, 0);
         die("An error occurred while inserting the record.");
     }
     
}

if(isset($_POST['classSave'])){
    $id = $_POST['classSave'];
    $tname = filter_input(INPUT_POST, 'tname', FILTER_SANITIZE_STRING);
    $tname = strtoupper($tname);
    $teacher = filter_input(INPUT_POST, 'teacher', FILTER_SANITIZE_STRING);
    $teacher = ucfirst($teacher);
    $day = filter_input(INPUT_POST, 'day', FILTER_SANITIZE_STRING);
    $time = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_STRING);
    $percent = filter_input(INPUT_POST, 'percent', FILTER_SANITIZE_NUMBER_INT);


    $sql = "UPDATE sınıflar SET tname = ?, teacher = ?, day = ?, time= ?, percent = ? where id= ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssii", $tname, $teacher, $day, $time, $percent, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: classTable.php?id=$id");
        exit;
    } else {
        header("Location: classTable.php?id=$id");
        die($mysqli->error . " Tabloda Değişiklik yapmadınız" . $mysqli->errorno);
    }
}

if(isset($_POST['resetPayment'])){
    $class_id = $_POST['resetPayment'];
    $class = filter_input(INPUT_POST, 'class', FILTER_SANITIZE_STRING);
    $payment = filter_input(INPUT_POST, 'payment', FILTER_SANITIZE_NUMBER_INT);
    $payment = abs(intval($payment)) * -1;
    $day = htmlspecialchars($formatted_date ?? date('Y-m-d'));
    $null = 0;
    $user_id = 9999; //bilgiler kısmına giderler için ayrı bir bölüm açıyorsun
    $sql = "UPDATE sınıflar SET money = 0, lpay = ? where id = ?";
    $stmt = $mysqli ->prepare($sql);
    $stmt -> bind_param("si",
                        $day,
                        $class_id);
    $stmt->execute();

    $sql = "INSERT INTO para (tarih,miktar,kime,user_id,times,kalan,lpay) VALUES(?,?,?,?,?,?,?)";
    $stmt = $mysqli ->prepare($sql);
    $stmt -> bind_param("sisiiis",
                        $day,
                        $payment,
                        $class,
                        $user_id,
                        $null,
                        $null,
                        $day);


     if ($stmt->execute()) {
        header("Location: classTable.php?id=$class_id");
         exit;
     } else {
         $error_message = "Error: " . $mysqli->error;
         error_log($error_message, 0);
         die("An error occurred while inserting the record.");
     }
}


if(isset($_POST['deleteUser'])){
    if(isset($_GET['id'])) {
        $class_id = $_GET['id'];
    }
    $id = $_POST['deleteUser'];
    
    $stmt = $mysqli->prepare("DELETE FROM bilgiler WHERE id = ?");
    
    $stmt->bind_param("i", $id);
    $stmt_run = $stmt->execute();

    if($stmt_run){
        header("Location: classTable.php?id=$class_id");
        exit(0);
    }
    else{
        header("Location: classTable.php?id=$class_id");
        exit(0);
    }

    $stmt->close();
    $mysqli->close();
}

if(isset($_POST['belgeAktar']) && $_FILES['belge']['error'] === UPLOAD_ERR_OK){
    if(isset($_GET['id'])) {
        $class_id = $_GET['id'];
    }
    $id = $_POST['belgeAktar'];
    $dosyaAdi = rand(1000,1000000)."-".$_FILES['belge']['name']; // Belgenin adını alır
    $dosyaGeçiciYolu = $_FILES['belge']['tmp_name'];


// PHPMyAdmin'e bağlantıyı kurun

$hedefKlasor = "yuklemeler/"; // Yükleme dizini

// Dosya adını benzersiz bir isimle değiştirin
$benzersizAd = uniqid() . '_' . $dosyaAdi;

// Dosyayı hedef klasöre taşıyın
if (move_uploaded_file($dosyaGeçiciYolu, $hedefKlasor . $benzersizAd)) {
    // Yükleme başarılı oldu, dosya adını ve yolu veritabanına kaydedebilirsiniz

    // Veritabanına kaydetmek için gerekli kodları buraya ekleyin
} else {
    // Yükleme başarısız oldu, hata mesajı gösterebilirsiniz
}
}

if(isset($_POST['deleteSpecialUser'])){
    if(isset($_GET['id'])) {
        $class_id = $_GET['id'];
    }
    $id = $_POST['deleteSpecialUser'];
    
    $stmt = $mysqli->prepare("DELETE FROM specialclass WHERE id = ?");
    
    $stmt->bind_param("i", $id);
    $stmt_run = $stmt->execute();

    if($stmt_run){
        header("Location: specialClass.php");
        exit(0);
    }
    else{
        header("Location: specialClass.php");
        exit(0);
    }

    $stmt->close();
    $mysqli->close();
}

//sınıfı silme
if(isset($_POST['delete'])){
    // Öğrenci sayısını kontrol etmek için sorgu
    $stmt = $mysqli->prepare("SELECT COUNT(*) FROM ogrenci WHERE sinif_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($ogrenci_sayisi);
    $stmt->fetch();

    if ($ogrenci_sayisi > 0) {
        // Sınıfta öğrenci var, uyarı göster
        header("Location: sınıflar.php?error=has_students");
        exit(0);
    } else {
        // Sınıfta öğrenci yoksa silme işlemine devam et
        $stmt->close();

        // Sınıfı silme işlemi
        $stmt = $mysqli->prepare("DELETE FROM sınıflar WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt_run = $stmt->execute();

        if ($stmt_run) {
            header("Location: sınıflar.php?success=true");
            exit(0);
        } else {
            header("Location: sınıflar.php?error=delete_failed");
            exit(0);
        }

        $stmt->close();
        $mysqli->close();
    }

}

if(isset($_POST['editSpecialUser'])){
    $id = $_POST['editSpecialUser'];
    $note = $_POST['note'];
    
    $sql = "UPDATE specialclass SET note = ? where id = ?";

    $stmt = $mysqli -> prepare($sql);
    $stmt -> bind_param ("si",
                        $note,
                        $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: specialClass.php");
        exit;
    } else {
        header("Location: specialClass.php?Wrong");
        die($mysqli->error . " Tabloda Değişiklik yapmadınız" . $mysqli->errorno);
    }
}


?>