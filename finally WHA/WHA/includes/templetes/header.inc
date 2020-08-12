<header class="header d-flex flex-row">
  <div class="header_content d-flex flex-row align-items-center">
    <!-- Logo -->
    <div class="logo_container">
      <div class="logo">
        <img src="<?php echo $images?>logo.png" alt="">
        <span><?php echo lang('WHITE HOUSE');?></span>
      </div>
    </div>

    <!-- Main Navigation -->
    <nav class="main_nav_container">
      <div class="main_nav">
        <ul class="main_nav_list">
          <li class="main_nav_item"><a href="index.php"><?php echo lang('HOME');?></a></li>
          
          <li class="main_nav_item"><a href="course.php"><?php echo lang('COURSES');?></a></li>
          <li class="main_nav_item"><a href="instructor.php"><?php echo lang('INSTRUCTOR');?></a></li>
          <li class="main_nav_item"><a href="news.php"><?php echo lang('NEWS');?></a></li>
          <li class="main_nav_item"><a href="contact.php"><?php echo lang('CONTACT');?></a></li>


          
          <?php if(isset($_SESSION['LANG']) && $_SESSION['LANG']=='arabic'){ ?>
          <li class="main_nav_item"><a href="?lang=english">اللغة الانجلزية</a></li>
          <?php }else{ ?>
          <li class="main_nav_item"><a href="?lang=arabic">ARABIC</a></li>
         <?php } ?>
         

        </ul>
      </div>
    </nav>
  </div>
  <div class="header_side d-flex flex-row justify-content-center align-items-center">
    <img src="<?php echo $images?>phone-call.svg" alt="">
    <span>+2 040 3295608 </span>
  </div>

  <!-- Hamburger -->
 
</header> 