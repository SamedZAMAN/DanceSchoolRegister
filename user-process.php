<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

    if(isset($_POST['addUser'])){
    
        $mysqli = require __DIR__ . "/db.php"; //databas'e bağlamak iliçn

        $sql = "INSERT INTO bilgiler(name,surname,email,number,date,ldate,tür,cinsiyet,sınıf,tc,fiyat) VALUES (?,?,?,?,?,?,?,?,?,?,?)"; //değer alımlarını hazırlıyoruz
        $stmt = $mysqli->stmt_init(); //datadaki bilgileri almak için güvenli bir yol
        
        if(!$stmt->prepare($sql)){ //prepare ile bilgileri güvenli bir şekilde alıyoruz
            die("SQL error: ".$mysqli->error);
        };

        //girdilerin formatlanması
        $formatted_date = $_POST["date"]; 
        $formatted_ldate = date('Y-m-d',strtotime($formatted_date . '+'.$_POST['ldate'].' days'));
        $sınıf = filter_var(ucfirst($_POST["sınıf"]), FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_var(ucfirst($_POST["name"]), FILTER_SANITIZE_SPECIAL_CHARS);
        $surname = filter_var(strtoupper($_POST["surname"]), FILTER_SANITIZE_SPECIAL_CHARS);
        $number = filter_var($_POST["number"], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_SPECIAL_CHARS);
        $tc = filter_var($_POST["tc"], FILTER_SANITIZE_SPECIAL_CHARS);
        $fiyat = filter_var($_POST["fiyat"], FILTER_SANITIZE_NUMBER_INT);
        $blob = null;

        //Read all row from database
        $tsql = "SELECT * FROM sınıflar where tname='$sınıf'";
        $tresult = $mysqli ->query($tsql);
        if(!$tresult){
            die("Invalid query!: ".$mysqli->error);
        }
        $row = $tresult->fetch_assoc();
        
        $tür = ucfirst($row["dans"]);

        $stmt ->bind_param("sssissssssi",
                        $name,
                        $surname,
                        $email,
                        $number,
                        $formatted_date,
                        $formatted_ldate,
                        $tür,
                        $_POST['sex'],
                        $sınıf,
                        $tc,
                        $fiyat);
        if(!$stmt->execute()){
            die($mysqli->error . " " . $mysqli->errorno);
        }

        $last_id = $mysqli->insert_id; // Son eklenen kaydın ID'sini al

            // veritabanından öğrencileri sorgulamak için kullanabilirsiniz
            $dandsql = "SELECT * FROM bilgiler WHERE id = $last_id";
            // $dandsql sorgusunu çalıştırarak sonucu $sınıf_degiskenine atayın
            $sınıf_degiskeni = mysqli_query($mysqli, $dandsql);
        
            // "dans" sınıfının değerini elde edin
            $sınıf_sonucu = mysqli_fetch_assoc($sınıf_degiskeni);
            $baslik_degiskeni = $sınıf_sonucu['sınıf'];
            $times = filter_var($_POST["ldate"], FILTER_SANITIZE_NUMBER_INT);
            $times = $times / 28;
            $kalan = $fiyat;
        $psql = "INSERT INTO para(user_id,tarih,miktar,kime,times,kalan,lpay) VALUES(?,?,?,?,?,?,?)";
        $pstmt = $mysqli->stmt_init();
        if(!$pstmt->prepare($psql)){ //prepare ile bilgileri güvenli bir şekilde alıyoruz
            die("SQL error: ".$mysqli->error);
        };



        
        
        $pstmt ->bind_param("isisiis",
                            $last_id,
                            $formatted_date,
                            $fiyat,
                            $baslik_degiskeni,
                            $times,
                            $kalan,
                            $formatted_date);


        if(!$pstmt->execute()){
            die($mysqli->error . " " . $mysqli->errorno);
        }
        header("Location: addUser.php?success=true");
        exit;
    }



    if(isset($_POST['addSpecialUser'])){
    
        $mysqli = require __DIR__ . "/db.php"; //databas'e bağlamak içn

        //girdilerin formatlanması
        $date = date('Y-m-d');
        $tname = filter_var($_POST["tname"],FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_var(ucfirst($_POST["name"]), FILTER_SANITIZE_SPECIAL_CHARS);
        $surname = filter_var(strtoupper($_POST["surname"]), FILTER_SANITIZE_SPECIAL_CHARS);
        $number = filter_var($_POST["number"], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_SPECIAL_CHARS);
        $tc = filter_var($_POST["tc"], FILTER_SANITIZE_SPECIAL_CHARS);
        $fiyat = filter_var($_POST["fiyat"], FILTER_SANITIZE_NUMBER_INT);
        $note = filter_var(ucfirst($_POST["note"]), FILTER_SANITIZE_SPECIAL_CHARS);
        $sql = "INSERT INTO specialclass(tname,name,surname,email,number,date,tc,fiyat,note) VALUES (?,?,?,?,?,?,?,?,?)"; //değer alımlarını hazırlıyoruz
        $stmt = $mysqli->stmt_init(); //datadaki bilgileri almak için güvenli bir yol
        
        if(!$stmt->prepare($sql)){ //prepare ile bilgileri güvenli bir şekilde alıyoruz
            die("SQL error: ".$mysqli->error);
        };

        //Read all row from database
        $tsql = "SELECT * FROM sınıflar where tname='special'";
        $tresult = $mysqli ->query($tsql);
        if(!$tresult){
            die("Invalid query!: ".$mysqli->error);
        }
        $row = $tresult->fetch_assoc();
        

        $stmt ->bind_param("ssssisiis",
                        $tname,
                        $name,
                        $surname,
                        $email,
                        $number,
                        $date,
                        $tc,
                        $fiyat,
                        $note);
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
            $baslik_degiskeni = $tname;
            $times = 1;
            $kalan = $fiyat;
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
                            $date);


        if(!$pstmt->execute()){
            die($mysqli->error . " " . $mysqli->errorno);
        }
        header("Location: addUser.php?success=true");
        exit;
    }
    
?>