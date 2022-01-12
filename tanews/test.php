
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ус цаг уур, орчны судалгаа, мэдээллийн хүрээлэн</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="files/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="files/jquery-ui/jquery-ui.min.css">
  <link rel="stylesheet" href="files/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="files/datatables/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="files/buttons/css/buttons.dataTables.min.css" />
  <link rel="stylesheet" href="files/highcharts/css/highcharts.css">


  <link href="files/sb-admin-2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="files/sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/admin_style.css">
</head>
<body id="page-top">
  	<div id="wrapper">
        <!-- Navigation-->

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.php">
    <div class="sidebar-brand-icon">
      <i class="fas fa-file-invoice-dollar"></i>
    </div>
    <div class="sidebar-brand-text mx-3">БОАЖЯ</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  
  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="admin.php?menuitem=11">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Удирдах хуудас</span></a>
  </li>
  <hr class="sidebar-divider">
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse0" aria-expanded="true"
      aria-controls="collapse0">
      <i class="fas fa-fw fa-users"></i>
      <span>Системийн хэрэглэгч</span>
    </a>
    <div id="collapse0" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Хэрэглэгч болон бүлэг</h6>
        <a class="collapse-item" href="admin.php?menuitem=3">Хэрэглэгчийн мэдээлэл</a>
                <a class="collapse-item" href="admin.php?menuitem=2">Бүлгийн мэдээлэл</a>
        <a class="collapse-item" href="admin.php?menuitem=5">Бүлгийн эрх, үүрэг</a>
        <a class="collapse-item" href="admin.php?menuitem=4">Бүлгийн хэрэглэгч</a>
            </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true"
      aria-controls="collapse0">
      <i class="fas fa-fw fa-bars"></i>
      <span>Цэсний тохиргоо</span>
    </a>
    <div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Хэрэглэгч болон бүлэг</h6>
        <a class="collapse-item" href="admin.php?menuitem=6">Үндсэн цэс</a>
                <a class="collapse-item" href="admin.php?menuitem=7">Дэд цэс</a>
        <a class="collapse-item" href="admin.php?menuitem=8">Дэдийн дэд цэс</a>
            </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="admin.php?menuitem=10">
      <i class="fas fa-fw fa-newspaper"></i>
      <span>Мэдээ нэмэх</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="admin.php?menuitem=11">
      <i class="fas fa-fw fa-images"></i>
      <span>Онцлох зураг</span>
    </a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="admin.php?menuitem=9">
      <i class="fas fa-fw fa-digital-tachograph"></i>
      <span>Мэдээллийн сангийн мэдээ бүрдүүлэлт</span>
    </a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->    	<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

	    <!-- Main Content -->
	    <div id="content">
	    		<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
    </button>
    <a class="navbar-brand" href="#">Ус цаг уур, орчны судалгаа, мэдээллийн хүрээлэн</a>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - User Information -->
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                <img class="img-profile rounded-circle" src="images/user.jpg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="admin.php?menuitem=3">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Хэрэглэгчийн мэдээлэл                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="index.php?login=logout">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Системээс гарах                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- End of Topbar -->			
<div class="container-fluid">
	     	<h1 class="h3 mb-4 text-gray-800">Мэдээ нэмэх</h1>
    <div class="row">
    	<div class="col">
  <br />
<b>Warning</b>:  Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\irimhe.namem1\templates\inc.admin_nav_side.php:71) in <b>C:\xampp\htdocs\irimhe.namem1\tanews\inc.admin_export_news.php</b> on line <b>117</b><br />
<div class="card shadow mb-4">
	<!-- Card Header - Accordion -->
	<a href="#collapseSearch" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseSearch">
	  <h6 class="m-0 font-weight-bold text-primary">Хайлтын хэсэг</h6>
	</a>
	<!-- Card Content - Collapse -->
	<div class="collapse show" id="collapseSearch">
		<div class="card-body">
          <form class="form" role="form" action="admin.php?menuitem=10&count=10" method="post" name="mainform" id="mainform">
            <div class="form-row">
              <div class="form-group row col-md-6">
                <label class="col-md-4 col-form-label">Үндсэн цэс:</label>
                <div class="col-md-6">
                  <select name="search_menu_id" id="search_menu_id" class="form-control"><option value = "0" selected = "selected">-- Бүх төрөл --</option><option value = "1" >Бидний тухай </option><option value = "7" >Бүтээгдэхүүн үйлчилгээ</option><option value = "3" >Ил тод байдал</option><option value = "5" >Мэдээ мэдээлэл</option><option value = "6" >Хамтын ажиллагаа</option><option value = "2" >Шилэн данс</option></select>                </div>
              </div>
              <div class="form-group row col-md-6">
                <label class="col-md-4 col-form-label">Дэд цэс:</label>
                <div class="col-md-6">
                  <select name="search_sub_name" id="search_sub_name" class="form-control"><option value = "0" selected = "selected">-- Бүх төрөл --</option><option value = "38" >Байгаль орчны мэдээллийн сан</option><option value = "34" >Гадаргын усны мэдээ</option><option value = "36" >Зайнаас тандан судлал</option><option value = "29" >Зарлал</option><option value = "15" >Зохион байгуулалтын бүтэц</option><option value = "27" >Ном товхимол, гарын авлага</option><option value = "42" >Орчил урсгал, урт хугацааны прогнозын судалгаа</option><option value = "30" >Түүхэн замнал</option><option value = "12" >Төсөв, санхүү</option><option value = "39" >Төсөл хөтөлбөр</option><option value = "33" >Уур амьсгалын өөрчлөлт, нөөцийн судалгаа</option><option value = "35" >ХАА-н цаг уурын мэдээ</option><option value = "31" >Холбоо барих</option><option value = "25" >Хурлын илтгэл</option><option value = "16" >Хэлтэс</option><option value = "32" >Хүний нөөц</option><option value = "46" >Хүрээлэнгийн бүтэц</option><option value = "45" >Хөдөлмөрийн дотоод журам</option><option value = "37" >Цаг агаар, орчны тоон загварчлалын мэдээ</option><option value = "24" >Цаг үеийн мэдээ</option><option value = "22" >Эрдэм, шинжилгээ судалгааны ажил</option><option value = "13" >Эрхэм зорилго</option><option value = "28" >Үйл ажиллагаа</option><option value = "14" >Үйл ажиллагааны чиглэл</option></select>                </div>
              </div>
            </div>
			<div class="form-row">
              <div class="form-group row col-md-6">
                <label class="col-md-4 col-form-label">Дэдийн дэд цэс:</label>
                <div class="col-md-6">
                  <select name="search_sub_name2" id="search_sub_name2" class="form-control"><option value = "0" selected = "selected">-- Бүх төрөл --</option><option value = "52" >rrr</option><option value = "53" >rrr</option><option value = "51" >test</option><option value = "17" >Аудитын тайлан, дүгнэлт, авч хэрэгжүүлсэн арга хэмжээ</option><option value = "6" >Байгаль орчны мэдээллийн сангийн хэлтэс</option><option value = "7" >Гадаргын усны судалгааны хэлтэс</option><option value = "28" >Гадаргын усны урьдчилсан мэдээ</option><option value = "37" >Гамшгийн мэдээллийн систем</option><option value = "29" >Голын усны ажиглалтын мэдээ</option><option value = "30" >Голын усны тойм мэдээ</option><option value = "36" >Дагуулын мэдээний каталог</option><option value = "40" >Дотоодын төсөл</option><option value = "10" >Зайнаас тандан судлалын хэлтэс</option><option value = "12" >Захиргаа, санхүүгийн хэлтэс</option><option value = "34" >Монгол орны уур амьсгал</option><option value = "43" >Монгол орны уур амьсгалын ирээдүйн хандлага</option><option value = "39" >Олон улсын төсөл</option><option value = "38" >Олон улсын хөтөлбөр</option><option value = "47" >Орчил урсгал, урт хугацааны прогнозын судалгааны хэлтэс</option><option value = "41" >Сар, жилийн уур амьсгалын тойм</option><option value = "48" >Сарын прогноз</option><option value = "27" >Тоон прогнозын үр дүн</option><option value = "2" >Түүхэн замнал</option><option value = "16" >Төсвийн гүйцэтгэл</option><option value = "15" >Төсвийн тайлан</option><option value = "14" >Төсвийн төлөвлөлт</option><option value = "49" >Улирлын прогноз</option><option value = "46" >Уур амьсгалын экстермаль индексүүдийн өөрчлөлт</option><option value = "42" >Уур амьсгалын өөрчлөлт</option><option value = "5" >Уур амьсгалын өөрчлөлт, нөөцийн судалгааны хэлтэс</option><option value = "32" >ХАА-н цаг уурын тойм мэдээ</option><option value = "31" >ХАА-н цаг уурын урьдчилсан мэдээ</option><option value = "35" >Хиймэл дагуулын бүтээгдэхүүн</option><option value = "26" >Хүлэмжийн хий</option><option value = "9" >Хөдөө аж ахуйн цаг уурын судалгааны хэлтэс</option><option value = "8" >Цаг агаар, орчны тоон загварчлал, судалгааны хэлтэс</option><option value = "33" >Цаг агаарын бодит ажиглалтын мэдээ </option><option value = "11" >Цаг уурын холбоо, мэдээллийн хэлтэс</option><option value = "13" >Үйл ажиллагааны тайлан</option><option value = "4" >Үйл ажиллагааны төлөвлөгөө</option></select>                </div>
              </div>
              <div class="form-group row col-md-6">
                <label class="col-md-4 col-form-label">Гарчиг:</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="search_title" id="search_title" value=""/>
                </div>
              </div>
            </div>
			<div class="form-row">
				  <div class="form-group row col-md-6">
					<label class="col-md-4 col-form-label">Мэдээ оруулсан хэрэглэгчийн нэр:</label>
					<div class="col-md-6">
						<select name="search_user_id" id="search_user_id" class="form-control"><option value = "0" selected = "selected">-- Бүх хэрэглэгч --</option></select>					</div>
				  </div>
				              <div class="form-group row col-md-6">
                <label class="col-md-4 col-form-label">Мэдээ оруулсан бүлгийн нэр:</label>
                <div class="col-md-6">
                  <select name="search_group_id" id="search_group_id" class="form-control"><option value = "0" selected = "selected">-- Бүх бүлэг --</option><option value = "1" >Админ бүлэг</option><option value = "2" >Мэдээ оруулагч</option></select>                </div>
              </div>
			              </div>
            <div class="form-row">
              <div class="form-group row col-md-10 justify-content-end">
                  <button type="submit" class="btn btn-primary" name="searchnewsbttn"><i class="fa fa-search"></i> Хайх</button>
              </div>
            </div>
          </form>
		</div>
	</div>
</div>









<div class="alert alert-info" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Нийт 204 бичлэг байна.</strong>  </div>

<div class="table-responsive">

  <table>
    <tbody>
      <tr>
        <td>
		          <a class="btn btn-success" href="admin.php?menuitem=10&count=10&page=1&action=add"><i class="fa fa-plus"></i> Шинээр нэмэх</a>
                     <a class="btn btn-info" href="admin.php?menuitem=10&count=10&action=export"><i class="fa fa-file"></i> Файлд гаргах</a>
          		</td>
      </tr>
    </tbody>
  </table>
  		<nav aria-label="page navigation">
			<ul class="pagination justify-content-md-center">
				<li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li><li class="page-item disabled"><a class="page-link" href="#">&#8249;</a></li><li class="page-item active"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="admin.php?menuitem=10&count=10&page=2">2</a></li><li class="page-item"><a class="page-link" href="admin.php?menuitem=10&count=10&page=3">3</a></li><li class="page-item"><a class="page-link" href="admin.php?menuitem=10&count=10&page=4">4</a></li><li class="page-item"><a class="page-link" href="admin.php?menuitem=10&count=10&page=5">5</a></li><li class="page-item"><a class="page-link" href="admin.php?menuitem=10&count=10&page=6">6</a></li><li class="page-item"><a class="page-link" href="admin.php?menuitem=10&count=10&page=7">7</a></li><li class="page-item"><a class="page-link" href="admin.php?menuitem=10&count=10&page=8">8</a></li><li class="page-item"><a class="page-link" href="admin.php?menuitem=10&count=10&page=9">9</a></li><li class="page-item"><a class="page-link" href="admin.php?menuitem=10&count=10&page=10">10</a></li><li class="page-item"><a class="page-link" href="admin.php?menuitem=10&count=10&page=2">&#8250;</a></li><li class="page-item"><a class="page-link" href="admin.php?menuitem=10&count=10&page=21">&raquo;</a></li>			</ul>
		</nav>
		</div>
</div>

</div>
<script src="files/ckeditor5/ckeditor.js"></script>
<script src="files/ckfinder/ckfinder.js"></script>
<script>
	ClassicEditor
		.create( document.querySelector( '#editor' ), {
			ckfinder: {
				uploadUrl: '/irimhe.namem1/files/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
			},
			toolbar: {
				items: [
					'heading', '|',
					'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', '|',
					'link', '|',
					'outdent', 'indent', '|',
					'bulletedList', 'numberedList', 'todoList', '|',
					'code', 'codeBlock', '|',
					'insertTable', '|',
					'ckfinder', 'uploadImage', 'blockQuote', '|',
					'undo', 'redo'
				],
				shouldNotGroupWhenFull: true
			}
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );

</script>			
</div>
    	</div>



</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top"> <i class="fas fa-angle-up"></i> </a>

<!-- Bootstrap core JavaScript-->
<script type="text/javascript" src="files/jquery/jquery.min.js"></script> 
<script type="text/javascript" src="files/popper/popper.min.js"></script> 
<script type="text/javascript" src="files/bootstrap/js/bootstrap.bundle.min.js"></script> 
<script type="text/javascript" src="files/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="files/jquery-easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="files/datatables/js/jquery.dataTables.min.js"></script>


<script type="text/javascript" src="files/jszip/jszip.min.js"></script>
<script type="text/javascript" src="files/pdfmake/pdfmake.min.js"></script>
<script type="text/javascript" src="files/pdfmake/vfs_fonts.js"></script>

<script type="text/javascript" src="files/buttons/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="files/buttons/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="files/buttons/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="files/buttons/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="files/buttons/js/buttons.print.min.js"></script>
<script type="text/javascript" src="files/buttons/js/buttons.colVis.min.js"></script>

<script type="text/javascript" src="files/highcharts/highcharts.js"></script>
<script type="text/javascript" src="files/highcharts/modules/exporting.js"></script>
<script type="text/javascript" src="files/highcharts/modules/offline-exporting.js"></script>

<script type="text/javascript" src="files/sb-admin-2/js/sb-admin-2.min.js"></script>
<script type="text/javascript" src="js/datatables_admin.js"></script>
<script type="text/javascript" src="js/application.js"></script>


	</body>
</html>