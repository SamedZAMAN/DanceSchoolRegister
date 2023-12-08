<?php
    

  $mysqli = require __DIR__ . "/db.php";
  //Read all row from database
  $sql ="SELECT * FROM bilgiler";
  $result = $mysqli ->query($sql);
    
  if(!$result){
    die("Invalid query!: ".$mysqli->error);
  }

  $tsql = "SELECT * FROM sınıflar";
    $tresult = $mysqli ->query($tsql);
    if(!$tresult){
      die("Invalid query!: ".$mysqli->error);
    }
        
    $tname_array = array(); // initialize an empty array to store the tname values
    $danslar = array(); //dans türlerinin arrayi
    while ($row = $tresult->fetch_assoc()) {
        $tname_array[] = $row['tname']; // append each tname value to the array
        $name = $row["dans"];
        if (!in_array($name, array_column($danslar, "dans"))) {
            $danslar[] = $row['dans'];
        }
    }

    // HANGİ SINIF OLDUĞUNU BULMAK İÇİN
    if(isset($_GET['id'])) {
        $class_id = $_GET['id'];
        // veritabanından öğrencileri sorgulamak için kullanabilirsiniz
        $dandsql = "SELECT * FROM sınıflar WHERE id = $class_id";
        // $dandsql sorgusunu çalıştırarak sonucu $sınıf_degiskenine atayın
        $sınıf_degiskeni = mysqli_query($mysqli, $dandsql);
    
        // "dans" sınıfının değerini elde edin
        $sınıf_sonucu = mysqli_fetch_assoc($sınıf_degiskeni);
        $dans_degiskeni = $sınıf_sonucu['dans'];
        $baslik_degiskeni = $sınıf_sonucu['tname'];
        $teacher_degiskeni = $sınıf_sonucu['teacher'];
        $dans_degiskeni = $sınıf_sonucu['dans'];
        $day_degiskeni = $sınıf_sonucu['day'];
        $time_degiskeni = $sınıf_sonucu['time'];
        $percent_degiskeni = $sınıf_sonucu['percent'];
        $money_degiskeni = $sınıf_sonucu['money'];
        $sınıf_tarihi = $sınıf_sonucu['lpay'];
    }
    

    $tname_json = json_encode($tname_array);
    $tdans_json = json_encode($danslar);

    $psql = "SELECT * FROM paracopy";
    $presult = $mysqli -> query($psql);
    if(!$presult){
        die("Invalid query!: ".$mysqli->error);
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/tablo.css">

    <title>SB Admin 2 - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Ana Sayfa</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tablo</span></a>
            </li>

            <!-- Nav Item - Add User -->
            <li class="nav-item">
                <a class="nav-link" href="addUser.php">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Add User</span></a>
            </li>

            <!-- Nav Item - Ödemeyenler -->
            <li class="nav-item">
                <a class="nav-link" href="later.php">
                    <i class="fas fa-fw fa-user-times"></i>
                    <span>Ödenecekler</span></a>
            </li>

            <!-- Nav Item - Sınıflar -->
            <li class="nav-item">
                <a class="nav-link" href="sınıflar.php">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Sınıflar</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->




                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="bilgiler">
                        <h1 class="h2 mb-2 text-primary"><?php echo $baslik_degiskeni; ?> Kayıtlı Tablosu</h1>
                        <p class="h4 mb-2 text-dark"><?php echo $teacher_degiskeni; ?></p>
                        <p class = "h5 mb-2 text-dark"><?php echo $day_degiskeni ; ?> <?php echo $time_degiskeni; ?></p>
                        <!-- ÖDEMEYİ SIFIRLA -->
                        <form action="class-process.php?id=<?php echo $class_id; ?>" method= 'post'>
                            <input type="hidden" value= "<?php echo $baslik_degiskeni; ?>" name="class">
                            <input type="hidden" value= "<?php echo $money_degiskeni * $percent_degiskeni / 100 ; ?>" name="payment">
                            <p class = "h5 mb-2 text-dark">Ödenecek : <span class= "text-success">$<?php echo $money_degiskeni * $percent_degiskeni / 100 ; ?></span>
                            <button class="btn btn-success mt-2 ml-2 mb-2" name="resetPayment" value= "<?php echo $class_id; ?>">Ödeme Yap</button></p>
                        </form>
                    </div>

                    <!-- TABLOYU GÜNCELLEME -->
                    <form action="class-process.php?id=<?php echo $class_id; ?>" class = "tlist d-none"; method= 'post'>
                        <div class ="card-container" style="margin: 5vh 5vh;">
                            <div class="card text-white mb-3" style="max-width: 18rem;">
                            <div class="card-header">
                            <div id="new-card">
                                    <input type="text" name="tname" class="mb-2" value="<?php echo $baslik_degiskeni; ?>">
                                    <input type="text" name="teacher" class="mb-2" value="<?php echo $teacher_degiskeni; ?>">
                                    <select name="day" class="form-select mb-2" aria-label="Default select example" required style="width:100%; border: 1px solid rgba(26, 26, 192, 0.6);" >
                                        <option value="<?php echo $day_degiskeni; ?>"><?php echo $day_degiskeni; ?></option>
                                        <option value="Pazartesi">Pazartesi</option>
                                        <option value="Salı">Salı</option>
                                        <option value="Çarşamba">Çarşamba</option>
                                        <option value="Perşembe">Perşembe</option>
                                        <option value="Cume">Cuma</option>
                                        <option value="Cumartesi">Cumartesi</option>
                                        <option value="Pazar">Pazar</option>
                                    </select>
                                    <input type="text" name="time" class="mb-2" value="<?php echo $time_degiskeni; ?>">
                                    <input type="text" name="percent" maxlenght ="3" value="<?php echo $percent_degiskeni; ?>">
                                    <button type="submit" name="classSave" value= "<?php echo $class_id; ?>" class="btn btn-success mt-2">Kaydet</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </form>


                    
                    <!-- navbar -->
                    <div class="search btn-sm mt-1">
                        <div class="box" style="display: inline-flex; align-items: center;">
                            <button type="button" class = "btn btn-warning p-3 mr-2" onclick="güncelle(this)"; >GÜNCELLE</button><a href="addUser.php" class="btn btn-primary" id="userAdd">Yeni Kullanıcı<i class='bx bxs-user-plus'></i></a><button id="filt" type="button" class="btn btn-warning d-none"> Filtreler <i class='bx bx-menu'></i></button> 
                        </div>
                        <div class="box">
                        <input type="text" class ="searchh"> <i class='bx bx-search-alt-2'></i>
                        </div>
                    </div>
                        
                    <h2 class="mt-5 text-primary">Kayıtlı Kişiler</h2>
                    <!-- Tablo -->
                    <form action="class-process.php?id=<?php echo $class_id; ?>" method='post' class="mt-1">
                        <table class="table caption-top">
                        <caption>
                            <div class="konum">
                            </div>
                        </caption>
                            <thead>
                            <tr>
                                <th scope="col" class="<?php echo $baslik_degiskeni ?>">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Surname</th>
                                <th scope="col">TC</th>
                                <th scope="col" class="hidden">Email</th>
                                <th scope="col" class="hidden">Number</th>
                                <th scope="col" class="hidden">Başlangıç Tarihi</th>
                                <th scope="col" class="hidden">Bitiş Tarihi</th>
                                <th scope="col" class="">Tür</th>
                                <th scope="col" class="">Sınıf</th>
                                <th scope="col"><button onclick="belgeGöster(this)" type="button">Belge <i class="fas-fa fa-arrow"></i></button></th>
                                <th scope="col" >Değiştir & Sil</th>
                            </tr>
                            </thead>

                            <tbody>
                            <!-- php format -->
                            <?php
                                $i = 1;
                                
                                while($row = $result->fetch_assoc()){
                                    // Check if date is greater than last date, and set row color accordingly
                                    $row_class = ($row['date'] > $row['ldate']) ? 'bg-warning' : '';
                                    if($row['sınıf'] == $baslik_degiskeni){
                                    echo "
                                        <tr class='$row_class $row[cinsiyet]'>
                                            <th scope='row' class='$row[id]' id='id_id$row[id]'><span id='id_$row[id]'>$i</span></th>
                                            <td class='$row[name]' id='name_id$row[id]'><span id='name_$row[id]'>$row[name]</span></td>
                                            <td class='$row[surname]' id='surname_id$row[id]'><span id='surname_$row[id]'>$row[surname]</span></td>
                                            <td class='$row[tc] hidden' id='tc_id$row[id]''><span id='tc_$row[id]'>$row[tc]</span></td>
                                            <td class='$row[email] hidden' id='email_id$row[id]'><span id='email_$row[id]'>$row[email]</span></td>
                                            <td class='$row[number]' id='number_id$row[id]'><span id='number_$row[id]'>$row[number]</span></td>
                                            <td class='$row[date] hidden' id='date_id$row[id]'><span id='date_$row[id]'>$row[date]</span></td>
                                            <td class='$row[ldate] hidden' id='ldate_id$row[id]'><span id='ldate_$row[id]'>$row[ldate]</span></td>
                                            <td class='$row[tür] tür' id='tür_id$row[id]'><span id='tür_$row[id]'>$row[tür]</span></td>
                                            <td class='$row[sınıf] sınıf --- $baslik_degiskeni' id='sınıf_id$row[id]'><span id='sınıf_$row[id]' >$row[sınıf]</span></td>
                                            <td class='belge'>
                                                <form action='class-process.php' method='POST' enctype='multipart/form-data'>
                                                    <input type='file' name='belge' id='belge'/>
                                                    <button class='btn btn-dark btn-sm' id='yükle-$row[id]' value='$row[id]' name ='belgeAktar' type='submit'>Yükle</button>
                                                </form>
                                            </td>
                                            <td id='edit_id$row[id]' class='edit_buttons'>
                                                <a class='btn btn-primary btn-sm edit-btn' id='edit-$row[id]' onClick='tikla($row[id],$tname_json)'>Edit</a>
                                                <button class='btn btn-danger btn-sm delete-btn' id='delete-$row[id]' value='$row[id]' name ='deleteUser' type='button' onclick='checkDelete(this)'>Delete</button>
                                                <button class='btn btn-warning btn-sm add-btn' id='delete-$row[id]' value='$row[id]'  type='button' onclick='checkDelete(this)'>+</button>
                                            </td>
                                            <td id='edit_id$row[id]' class='hidden_buttons d-none'>
                                                <button class='btn btn-success btn-sm delete-btn' id='delete-$row[id]' value='$row[id]' type ='button' onclick='cancelDelete(this)' >İptal</button>
                                                <button class='btn btn-danger btn-sm delete-btn' id='delete-$row[id]' value='$row[id]' name ='deleteUser' type='submit'>Delete</button>
                                            </td>
                                            
                                        </tr>
                                    ";
                                    $i +=1;
                                    }
                                }
                            ?>
                            <style>
                                .hidden{
                                    display:none;
                                }
                            </style>
                            </tbody>
                        </table>
                    </form>


                    <!-- Ödeme Tablosu -->
                    <h2 class="mt-5 text-primary">Bu Ay Ödemeleri</h2>
                    <form action="class-process.php?id=<?php echo $class_id; ?>" method='post'>
                        <table class="table caption-top">
                        <caption>
                            <div class="konum">
                            </div>
                        </caption>
                            <thead>
                            <tr>
                                <th scope="col" class="<?php echo $baslik_degiskeni ?>">#</th>
                                <th scope="col">İsim</th>
                                <th scope="col">Soy İsim</th>
                                <th scope="col">Ödeme Tarihi</th>
                                <th scope="col">Miktar</th>
                            </tr>
                            </thead>

                            <tbody>
                            <!-- php format -->
                            <?php
                                $i = 1;
                                
                                while($prow = $presult->fetch_assoc()){
                                    // Check if date is greater than last date, and set row color accordingly
                                    
                                    $ptable = "SELECT * FROM bilgilercopy where id = $prow[user_id]";
                                    $table_degiskeni = mysqli_query($mysqli, $ptable);

                                    $ptrow = mysqli_fetch_assoc($table_degiskeni);

                                    if ($ptrow) {
                                        $name_sonucu = $ptrow['name'];
                                        $surname_sonucu = $ptrow['surname'];

                                        // Diğer işlemler
                                    } else {
                                        // $ptrow dizisi null veya boş olduğunda yapılacak işlemler
                                        // Örneğin, varsayılan değerleri atayabilirsiniz
                                        $name_sonucu = "İsim Bulunamadı";
                                        $surname_sonucu = "Soyisim Bulunamadı";
                                    }

                                    // ÖDEME TABLOSU GÖRÜNTÜSÜ 
                                    if($prow['kime'] == $baslik_degiskeni && $sınıf_tarihi <= $prow['tarih'] ){
                                    echo "
                                        <tr>
                                            <th scope='row' class='$prow[id]' id='id_id$prow[id]'><span id='id_$prow[id]'>$i</span></th>
                                            <td ><span>$name_sonucu</span></td>
                                            <td ><span>$surname_sonucu</span></td>
                                            <td ><span>$prow[tarih]</span></td>
                                            <td ><span>$prow[miktar]</span></td>
                                        </tr>
                                    ";
                                    $i +=1;
                                    }
                                }
                            ?>
                            <style>
                                .hidden{
                                    display:none;
                                }
                            </style>
                            </tbody>
                        </table>
                    </form>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span> &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/edit.js"></script>
    <script>
                
        function güncelle(button){
            var formcard = document.querySelector(".tlist");
            var bilgiler = document.querySelector(".bilgiler");
            console.log(formcard);
            formcard.classList.toggle("d-block");
            bilgiler.classList.toggle("d-none");
            if(button.innerHTML == "GÜNCELLE"){
                button.innerHTML = "IPTAL";
            }else if(button.innerHTML == "IPTAL"){
                button.innerHTML = "GÜNCELLE";
            }
        }

        function checkDelete(button){
            var cardHeader = button.parentElement.parentElement;
            var classButtons = cardHeader.querySelector(".edit_buttons");
            var classHidden = cardHeader.querySelector(".hidden_buttons");
            classButtons.classList.add("d-none");
            classHidden.classList.remove("d-none");
            classHidden.classList.add("d-block");
            }

            function cancelDelete(button){
            var cardHeader = button.parentElement.parentElement;
            var classButtons = cardHeader.querySelector(".edit_buttons");
            var classHidden = cardHeader.querySelector(".hidden_buttons");

            classHidden.classList.add("d-none");
            classHidden.classList.remove("d-block");
            classButtons.classList.remove("d-none");
            }
    </script>

</body>

</html>