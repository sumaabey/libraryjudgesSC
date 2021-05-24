<div class="navbar navbar-inverse set-radius-zero" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">

                    <img src="assets/img/supremeLogo.png"  style="height: 348%;"/>
                    
                </a>
                

            </div>

            <div class="right-div">
                <span>
                    <?php
                        echo "Welcome ".ucwords($_SESSION['alogin']);
                    ?>

                </span>&nbsp;&nbsp;<a href="logout" class="btn btn-danger pull-right">LOG  OUT</a>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="dashboard.php" class="menu-top-active">DASHBOARD</a></li>
                           
                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Newspaper <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="language">Language</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="title">Newspaper</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="add-news">Add Newspaper</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-news">Manage Newspaper</a></li>
                                </ul>
                            </li>
<!--                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Authors <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="add-author.php">Add Author</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-authors.php">Manage Authors</a></li>
                                </ul>
                            </li>
 <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Books <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="add-book.php">Add Book</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-books.php">Manage Books</a></li>
                                </ul>
                            </li>

                           <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Issue Books <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="issue-book.php">Issue New Book</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-issued-books.php">Manage Issued Books</a></li>
                                </ul>
                            </li>
                             <li><a href="reg-students.php">Reg Students</a></li>
                    
  <li><a href="change-password.php">Change Password</a></li>-->
                                <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> User<i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="add-user.php">Add User</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-users.php">Manage User</a></li>
                                </ul>
                            </li>



                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Legislative Act<i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                               <li role="presentation"><a role="menuitem" tabindex="-1" href="legislative.php">Add LRCA</a></li>

                               <li role="presentation"><a role="menuitem" tabindex="-1" href="add-principalact-lrca.php">Add Act</a></li>
                               <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-legislative.php">View Act</a></li>
                            </ul>
                            </li>





                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>