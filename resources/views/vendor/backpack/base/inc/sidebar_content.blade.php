<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<li><a href='{{ backpack_url('user') }}'><i class='fa fa-user'></i> <span>All Users</span></a></li>
<li><a href='{{ backpack_url('student') }}'><i class='fa fa-tag'></i> <span>Students</span></a></li>
<li><a href='{{ backpack_url('subject') }}'><i class='fa fa-book'></i> <span>Subjects</span></a></li>
<li><a href='{{ backpack_url('class') }}'><i class='fa fa-home'></i> <span>Classes</span></a></li>
<li><a href='{{ backpack_url('exam') }}'><i class='fa fa-user'></i> <span>Exams</span></a></li>
<li><a href='{{ backpack_url('result') }}'><i class='fa fa-graduation-cap'></i> <span>Results</span></a></li>
<li><a href='{{ backpack_url('fee') }}'><i class='fa fa-user'></i> <span>Fee Management</span></a></li>

<li class="treeview">
    <a href="#"><i class="fa fa-newspaper-o"></i> <span>Notice Board</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="{{ backpack_url('article') }}"><i class="fa fa-newspaper-o"></i> <span>Announcement/News</span></a></li>
        <li><a href="{{ backpack_url('category') }}"><i class="fa fa-list"></i> <span>Categories</span></a></li>
        <li><a href="{{ backpack_url('tag') }}"><i class="fa fa-tag"></i> <span>Tags</span></a></li>
    </ul>
</li>
