<?php
/**
 * Created by PhpStorm.
 * User: mgoldenbaum
 * Date: 12.09.14
 * Time: 08:49
 */
?>
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.html">Ausbildungsnachweisgenerator</a>

</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
            </li>
            <li><a href="index.php?c=user&m=settings"><i class="fa fa-gear fa-fw"></i> Einstellungen</a>
            </li>
            <li class="divider"></li>
            <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <!--class="active"-->
                <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="index.php?c=user&m=editTimes"><i class="fa fa-edit fa-fw"></i> Einträge bearbeiten</a>
            </li>
            <li>
                <a href="index.php?c=extension&m=view"><i class="fa fa-wrench fa-fw"></i> Erweitern</a>
            </li>
            <li>
                <a href="index.php?c=set&m=create"><i class="fa fa-sitemap fa-fw"></i> Einträge bündeln</a>
            </li>
            <li>
                <a href="index.php?c=report&m=view"><i class="fa fa-files-o fa-fw"></i> Berichte einsehen</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>