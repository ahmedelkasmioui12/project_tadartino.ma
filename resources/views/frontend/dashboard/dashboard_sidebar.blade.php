<div class="widget-content">
    <ul class="category-list ">

        <li class="current"> <a><i class="fab fa fa-envelope "></i> Dashboard </a></li>
        <li><a href="{{ route('user.profile') }}"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
        <li><a href="{{ route('user.schedule.request') }}"><i class="fa fa-credit-card" aria-hidden="true"></i>Schedule
                Request <span class="badge badge-info">( )</span></a></li>
        <li><a href="{{ route('user.properties.create') }}"><i class="fa fa-list-alt" aria-hidden="true"></i></i> add Properties </a></li>
        <li><a href="{{ route('user.change.password') }}"><i class="fa fa-key" aria-hidden="true"></i> Security </a>
        </li>
        <li><a href="{{ route('user.logout') }}"><i class="fa fa-chevron-circle-up" aria-hidden="true"></i> Logout </a>
        </li>
    </ul>
</div>
