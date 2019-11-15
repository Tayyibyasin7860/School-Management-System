@can('view admin panel')
<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
@can('create school admin')
<li><a href='{{ backpack_url('school-admin') }}'><i class='fa fa-user'></i> <span>School Admins</span></a></li>
@endcan
<li><a href='{{ backpack_url('student') }}'><i class='fa fa-tag'></i> <span>Students</span></a></li>
<li class="treeview">
    <a href="#"><i class="fa fa-newspaper-o"></i> <span>Classes and Subjects</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href='{{ backpack_url('class') }}'><i class='fa fa-home'></i> <span>Classes</span></a></li>
        <li><a href='{{ backpack_url('subject') }}'><i class='fa fa-book'></i> <span>Subjects</span></a></li>
    </ul>
</li>


<li class="treeview">
    <a href="#"><i class="fa fa-newspaper-o"></i> <span>Exam Management</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href='{{ backpack_url('exam-session') }}'><i class='fa fa-tag'></i> <span>Exam Sessions</span></a></li>
        <li><a href='{{ backpack_url('exam') }}'><i class='fa fa-user'></i> <span>Exams</span></a></li>
    </ul>
</li>
<li><a href='{{ backpack_url('result') }}'><i class='fa fa-graduation-cap'></i> <span>Results</span></a></li>
<li class="treeview">
    <a href="#"><i class="fa fa-newspaper-o"></i> <span>Fee Management</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href='{{ backpack_url('fee-receipt') }}'><i class='fa fa-tag'></i> <span>Fee Receipts</span></a></li>
        <li><a href='{{ backpack_url('class-fee') }}'><i class='fa fa-tag'></i> <span>Classes Fees</span></a></li>
        <li><a href='{{ backpack_url('fee-type') }}'><i class='fa fa-tag'></i> <span>Fee Types</span></a></li>
        <li><a href='{{ backpack_url('fee-receipt/generate') }}'><i class='fa fa-dollar'></i> <span>Generate Receipts</span></a></li>
    </ul>
</li>
<li class="treeview">
    <a href="#"><i class="fa fa-newspaper-o"></i> <span>Notice Board</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href='{{ backpack_url('article') }}'><i class='fa fa-newspaper-o'></i> <span>Announcements/News</span></a></li>
        <li><a href='{{ backpack_url('category') }}'><i class='fa fa-list'></i> <span>Categories</span></a></li>
    </ul>
</li>
<li><a href='{{ backpack_url('mailbox') }}'><i class='fa fa-user'></i> <span>Mailbox</span></a></li>
<li><a href='{{ backpack_url('feedback') }}'><i class='fa fa-user'></i> <span>Student Feedback</span></a></li>
@endcan
    @can('view roles and permissions')
    <li class="treeview">
        <a href="#"><i class="fa fa-users"></i> <span>Roles & Permissions</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">


                <li><a href="{{ backpack_url('role') }}"><i class="fa fa-id-card"></i> <span>Roles</span></a></li>



                <li><a href="{{ backpack_url('permission') }}"><i class="fa fa-cogs"></i> <span>Permissions</span></a></li>
        </ul>
    </li>
    @endcan

