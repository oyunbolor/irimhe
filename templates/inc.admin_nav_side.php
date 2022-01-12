<?php
  $my_url = "admin.php";
  if (isset($_GET["menuitem"]))
  {
    $menuitem = (int)$_GET["menuitem"];
  }else
  {
    $menuitem = 1;
  }
?>
<!-- Navigation-->

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.php">
    <div class="sidebar-brand-icon">
      <i class="fas fa-file-invoice-dollar"></i>
    </div>
    <div class="sidebar-brand-text mx-3"><?php echo _p("DashboardTitle"); ?></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  
  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="<?php echo $my_url."?menuitem=11"; ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span><?php echo _p("Dashboard"); ?></span></a>
  </li>
  <hr class="sidebar-divider">
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse0" aria-expanded="true"
      aria-controls="collapse0">
      <i class="fas fa-fw fa-users"></i>
      <span><?php echo _p("User"); ?></span>
    </a>
    <div id="collapse0" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header"><?php echo _p("UserCollapse")?></h6>
        <a class="collapse-item" href="<?php echo $my_url."?menuitem=3"; ?>"><?php echo _p("UsersTitle"); ?></a>
        <?php if($sess_profile==1) { ?>
        <a class="collapse-item" href="<?php echo $my_url."?menuitem=2"; ?>"><?php echo _p("GroupsTitle"); ?></a>
        <a class="collapse-item" href="<?php echo $my_url."?menuitem=5"; ?>"><?php echo _p("GroupRolesTitle"); ?></a>
        <a class="collapse-item" href="<?php echo $my_url."?menuitem=4"; ?>"><?php echo _p("UserGroupsTitle"); ?></a>
      <?php } ?>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true"
      aria-controls="collapse0">
      <i class="fas fa-fw fa-bars"></i>
      <span><?php echo _p("ItemType1"); ?></span>
    </a>
    <div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header"><?php echo _p("UserCollapse")?></h6>
        <a class="collapse-item" href="<?php echo $my_url."?menuitem=6"; ?>"><?php echo _p("ItemType2"); ?></a>
        <?php if($sess_profile==1) { ?>
        <a class="collapse-item" href="<?php echo $my_url."?menuitem=7"; ?>"><?php echo _p("ItemType3"); ?></a>
        <a class="collapse-item" href="<?php echo $my_url."?menuitem=8"; ?>"><?php echo _p("ItemType4"); ?></a>
      <?php } ?>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo $my_url."?menuitem=10"; ?>">
      <i class="fas fa-fw fa-newspaper"></i>
      <span><?php echo _p("NewsTitle"); ?></span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo $my_url."?menuitem=11"; ?>">
      <i class="fas fa-fw fa-images"></i>
      <span><?php echo _p("HomeImage"); ?></span>
    </a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="<?php echo $my_url."?menuitem=9"; ?>">
      <i class="fas fa-fw fa-digital-tachograph"></i>
      <span><?php echo _p("MetadataTitle"); ?></span>
    </a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->