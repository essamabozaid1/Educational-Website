
<!-- to active log out button  -->
<?php
  

  if (isset($_GET['Logout'])) {
    logOut();
  }
?>
<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="../index.php">White House</a>
    </div>
    <ul class="nav navbar-nav" id="navbar-header">
      <li><a href="controlHomeEdit.php"><?php echo lang('HOME'); ?></a></li>
      <li><a href="category.php"><?php echo lang('CATEGORY'); ?></a></li>
      <li><a href="courses.php"><?php echo lang('PAGE1'); ?></a></li>
      <li><a href="instructors.php"><?php echo lang('PAGE2'); ?></a></li>
      <li><a href="clients.php"><?php echo lang('PAGE3'); ?></a></li>
      <li><a href="news.php"><?php echo lang('PAGE4'); ?></a></li>
      <li><a href="contact.php"><?php echo lang('PAGE5'); ?></a></li>
      <li><a href="certification.php"><?php echo lang('PAGE7'); ?></a></li>
      <li><a href="career.php"><?php echo lang('PAGE8'); ?></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="controlHomeEdit.php?flag=edit"><?php echo lang('PAGE6'); ?></a></li>

      <li><a href="?Logout=true"><?php echo lang('LOGOUT'); ?></a></li>

    </ul>
  </div>
</nav>