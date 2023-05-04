<?php
  $userId = isLogin()['user_id'];
  $userFullname = firstRow("SELECT fullname FROM users WHERE id=$userId");
  if(!empty($userFullname)){
      $userFullname = $userFullname['fullname'];
      
  } 
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo _WEB_HOST_ROOT_ADMIN; ?>" class="brand-link">
      <span class="brand-text font-weight-light font-weight-bold">Radix</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo _WEB_HOST_ROOT_ADMIN_TEMPLATES;?>/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?php echo getLinkAdmin('users','profile'); ?>" class="d-block"><?php echo $userFullname; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!-- trang tổng quan -  begin -->
          <li class="nav-item">
            <a href="<?php echo _WEB_HOST_ROOT_ADMIN; ?>" class="nav-link <?php echo (activeMenuSidebar('dashboard') || !isset(getBody()['module']))?'active':false;?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tổng quan
              </p>
            </a>
          </li>
          
          <!-- trang tổng quan -  end -->
          <!-- quản lý dịch vụ begin -->
          <li class="nav-item has-treeview <?php echo (activeMenuSidebar('services'))?'menu-open':false;?> ">
            <a href="#" class="nav-link <?php echo (activeMenuSidebar('services'))?'active':false;?>">
            <i class="nav-icon fab fa-servicestack"></i>
              <p>
                Quản lý dịch vụ
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=services'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=services&action=add'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
              
              
            </ul>
          </li>
          
          <!-- quản lý dịch vụ end -->
         <!-- nhóm người dùng - begin-->
          <li class="nav-item has-treeview <?php echo (activeMenuSidebar('groups'))?'menu-open':false;?> ">
            <a href="#" class="nav-link <?php echo (activeMenuSidebar('groups'))?'active':false;?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Nhóm người dùng
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=groups'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=groups&action=add'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
              
            </ul>
          </li>
          <!-- nhóm người dùng - end-->

          <!-- Quản lý người dùng - begin -->
          <li class="nav-item has-treeview <?php echo (activeMenuSidebar('users'))?'menu-open':false;?> ">
            <a href="#" class="nav-link <?php echo (activeMenuSidebar('users'))?'active':false;?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Quản lý người dùng
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=users'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=users&action=add'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
              
            </ul>
          </li>
          <!-- Quản lý người dùng - end -->

          <!-- Quản lý liên hệ - begin -->
          <li class="nav-item has-treeview <?php echo (activeMenuSidebar('contacts') || activeMenuSidebar('contact_type'))?'menu-open':false;?> ">
            <a href="#" class="nav-link <?php echo (activeMenuSidebar('contacts') || activeMenuSidebar('contact_type'))?'active':false;?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Quản lý liên hệ <span class="badge badge-danger"><?php echo getCountContacts(); ?></span>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=contacts'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách <span class="badge badge-danger"><?php echo getCountContacts(); ?></span></p>
                  
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=contact_type'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quản lý phòng ban</p>
                </a>
              </li>
              
            </ul>
          </li>
          <!-- QQuản lý liên hệ - end -->

          <!-- Quản lý pages - begin -->
          <li class="nav-item has-treeview <?php echo (activeMenuSidebar('pages'))?'menu-open':false;?> ">
            <a href="#" class="nav-link <?php echo (activeMenuSidebar('pages'))?'active':false;?>">
            <i class="nav-icon fas fa-file"></i>
              <p>
                Quản lý trang
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=pages'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=pages&action=add'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
              
            </ul>
          </li>
          <!-- Quản lý pages - end -->

          <!-- Quản lý portfolios - begin -->
          <li class="nav-item has-treeview <?php echo (activeMenuSidebar('portfolios') || activeMenuSidebar('portfolio_categories'))?'menu-open':false;?> ">
            <a href="#" class="nav-link <?php echo (activeMenuSidebar('portfolios') || activeMenuSidebar('portfolio_categories'))?'active':false;?>">
            <i class="nav-icon fas fa-project-diagram"></i>
              <p>
                Quản lý dự án
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=portfolios'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách dự án</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=portfolios&action=add'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm dự án mới</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=portfolio_categories'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh mục dự án</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Quản lý portfolios - end -->

          <!-- Quản lý blog-categories - begin -->
          <li class="nav-item has-treeview <?php echo (activeMenuSidebar('blog') || activeMenuSidebar('blog_categories'))?'menu-open':false;?> ">
            <a href="#" class="nav-link <?php echo (activeMenuSidebar('blog') || activeMenuSidebar('blog_categories'))?'active':false;?>">
            <i class="nav-icon fas fa-project-diagram"></i>
              <p>
                Quản lý blog
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=blog'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách blog</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=blog&action=add'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm blog mới</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=blog_categories'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh mục blog</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Quản lý bloc-categories - end -->
          
          <!-- cấu hình website - begin -->
          <li class="nav-item has-treeview <?php echo (activeMenuSidebar('options'))?'menu-open':false;?> ">
            <a href="#" class="nav-link <?php echo (activeMenuSidebar('options'))?'active':false;?>">
            <i class="nav-icon fas fa-cog"></i>
              <p>
                Thiết lập
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=general'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập chung</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=header'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập header</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=footer'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập footer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=home'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập trang chủ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=about'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập giới thiệu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=team'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập Team</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=service'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập dịch vụ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=portfolio'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập dự án</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=blog'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập blog</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- cấu hình website - end -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">