<?php
    $mysqli = require __DIR__ . "/db.php"; //databas'e bağlamak için
$date_format = 'Y-m-d'; //date formatını tanımlayarak çıkytıyı doğru şekilde alıyoruz

if(isset($_POST['editUser'])){
        
    $id = $_POST['editUser'];
    $name = ucfirst($_POST['name']);
    $surname = strtoupper($_POST['surname']);
    $tc = $_POST['tc'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $date = date($date_format,strtotime($_POST['date']));
    $ldate = date($date_format,strtotime($_POST['ldate']));
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


    $sql = "UPDATE bilgiler SET name =?, surname = ?, tc =?, email = ?, number = ?, date =?, ldate= ?, tür =?, sınıf=? where id =?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssssssssi", $name, $surname, $tc, $email, $number, $date, $ldate, $tür, $sınıf, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: tables.php?success=true");
        exit;
    } else {
        header("Location: tables.php?success=true");
        die($mysqli->error . " " . $mysqli->errorno);
    }
}


if(isset($_POST['delete'])){
    $id = $_POST['delete'];
    

    $mysqli = require __DIR__ . "/db.php"; // veritabanı bağlantısını sağlamak için
    $stmt = $mysqli->prepare("DELETE FROM bilgiler WHERE id = ?");
    
    $stmt->bind_param("i", $id);
    $stmt_run = $stmt->execute();

    if($stmt_run){
        header("Location: tables.php?success=true");
        exit(0);
    }
    else{
        header("Location: tables.php?success=true");
        exit(0);
    }

    $stmt->close();
    $mysqli->close();
}



//ÖNCEDEN KAYITLI OLUP ŞİMDİ KAYITLI OLMAYAN KULLANICILARI YENİDEN EKLEME
if(isset($_POST["addMounth"])){
    $copy_id = $_POST["addMounth"];
    $class = filter_var($_POST["sınıf"],FILTER_SANITIZE_SPECIAL_CHARS);
    $fdate = $_POST["date"];
    $ldate = date('Y-m-d',strtotime($fdate . '+'.$_POST["ldate"].' days'));
    $fiyat = filter_var($_POST["fiyat"], FILTER_SANITIZE_NUMBER_INT);


    //COPYBİLGİLERDEN BİLGİLERİ ALMA
    $sql = "SELECT * from bilgilercopy where id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt ->bind_param("i",$copy_id);
    $stmt ->execute();
    $copy_degiskeni = $stmt->get_result();

    //COPYBİLGİLER DEĞİŞKENLERİ
    $copy_sonucu = mysqli_fetch_assoc($copy_degiskeni);
    $ad = $copy_sonucu["name"];
    $soyad = $copy_sonucu["surname"];
    $email = $copy_sonucu["email"];
    $number = $copy_sonucu["number"];
    $tc = $copy_sonucu["tc"];
    $tür = $copy_sonucu["tür"];
    $cinsiyet = $copy_sonucu["cinsiyet"];



    $sql = "INSERT INTO bilgiler(name,surname,email,number,date,ldate,tür,cinsiyet,sınıf,tc,fiyat) VALUES (?,?,?,?,?,?,?,?,?,?,?)"; //değer alımlarını hazırlıyoruz
        $stmt = $mysqli->stmt_init(); //datadaki bilgileri almak için güvenli bir yol
        
        if(!$stmt->prepare($sql)){ //prepare ile bilgileri güvenli bir şekilde alıyoruz
            die("SQL error: ".$mysqli->error);
        };

        $stmt ->bind_param("sssissssssi",
                                    $ad,
                                    $soyad,
                                    $email,
                                    $number,
                                    $fdate,
                                    $ldate,
                                    $tür,
                                    $cinsiyet,
                                    $class,
                                    $tc,
                                    $fiyat
                                    );
    if(!$stmt->execute()){
        die($mysqli->error . " " . $mysqli->errorno);
    }

    
    $sql = "SELECT MAX(id) as max_id FROM bilgilercopy";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $lastId = $row['max_id'];

        // veritabanından öğrencileri sorgulamak için kullanabilirsiniz
        $dandsql = "SELECT * FROM bilgilercopy WHERE id = $lastId";
        // $dandsql sorgusunu çalıştırarak sonucu $sınıf_degiskenine atayın
        $sınıf_degiskeni = mysqli_query($mysqli, $dandsql);
    
        // "dans" sınıfının değerini elde edin
        $sınıf_sonucu = mysqli_fetch_assoc($sınıf_degiskeni);
        $baslik_degiskeni = $class;
        $times = $_POST["ldate"] / 28;
        $kalan = $fiyat;
        $date = date('Y-m-d'); //date formatını tanımlayarak çıkytıyı doğru şekilde alıyoruz
    $psql = "INSERT INTO para(user_id,tarih,miktar,kime,times,kalan,lpay) VALUES(?,?,?,?,?,?,?)";
    $pstmt = $mysqli->stmt_init();
    if(!$pstmt->prepare($psql)){ //prepare ile bilgileri güvenli bir şekilde alıyoruz
        die("SQL error: ".$mysqli->error);
    };

    
    $pstmt ->bind_param("isisiis",
                        $lastId,
                        $date,
                        $fiyat,
                        $baslik_degiskeni,
                        $times,
                        $kalan,
                        $fdate);


    if(!$pstmt->execute()){
        die($mysqli->error . " " . $mysqli->errorno);
    }

    $dstmt = $mysqli->prepare("DELETE FROM bilgilercopy WHERE id = ?");

    $dstmt->bind_param("i",$copy_id);
    $dstmt_run = $dstmt->execute();
    

    if($stmt_run){
        header("Location: kayitYenileme.php?success=true");
        exit(0);
    }
    else{
        header("Location: kayitYenileme.php?success=false");
        exit(0);
    }
    
    $dstmt->close();
    $mysqli->close();
}

//Kayıtlı Kişilere Ekleme Yapma
if(isset($_POST["addSecondMounth"])){
    $copy_id = $_POST["addSecondMounth"];
    $tc = filter_var($_POST["tc"],FILTER_SANITIZE_SPECIAL_CHARS);
    $class = filter_var($_POST["sınıf"],FILTER_SANITIZE_SPECIAL_CHARS);
    $fdate = $_POST["date"];
    $ldate = date('Y-m-d',strtotime($fdate . '+'.$_POST["ldate"].' days'));
    $miktar = filter_var($_POST["fiyat"], FILTER_SANITIZE_NUMBER_INT);
    $date = date("Y-m-d");
    $times = $_POST["ldate"] / 28;


    // PARA KISMINI HALLETME
    $sql = "INSERT INTO para (user_id,tarih,miktar,kime,times,kalan,lpay) VALUES(?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($sql);

    $stmt->bind_param("isisiis",
                        $copy_id,
                        $date,
                        $miktar,
                        $class,
                        $times,
                        $miktar,
                        $fdate);
    $stmt->execute();

    //BİLGİLERDE Kİ SON KAYIT TARİHİ KISMINI DÜZELTME
    $bsql = "UPDATE bilgiler SET ldate = ? where tc = ?";
    $bstmt =$mysqli->prepare($bsql);
    $bstmt->bind_param("ss",
                        $ldate,
                        $tc);

    // Execute statement
    if ($bstmt->execute()) {
        header("Location: kayitYenileme.php?success=true");
        exit;
    } else {
        $error_message = "Error: " . $mysqli->error;
        error_log($error_message, 0);
        die("An error occurred while inserting the record.");
    }
    
}


?>