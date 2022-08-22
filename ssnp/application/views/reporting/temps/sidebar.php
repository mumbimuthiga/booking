<?php
/*created by Job Kimeli (Email: jobkimeli2016@gmail.com)
 * on 13/11/2021
 * Enrollment Module.
 * */

@$page = $page;

$user=get_current_user_logged_in();
$role = get_role($user);
?>

<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                <!--<li class="nav-small-cap">--- DASHBOARD ---</li>-->
                <li class="<?php echo($page == 'dashboard' ? 'active' : '') ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url('bookings/dashboard') ?>"
                       aria-expanded="false"><i class="icon-Home"></i>
                        <span class="hide-menu">
                           Dashboard
                        </span>
                    </a>
                </li>

                <?php
                    if($role==6){
                        do_parent_menu("1", $page);
                    }else if($role==2){
                        do_parent_menu("2", $page);
                    }

                ?>
            </ul>
        </nav>
    </div>

</aside>


<div class="page-wrapper">