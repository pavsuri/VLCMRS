<div class="left-section">
    <div class="cms-profile-data">
        <a href="javascript:void(0)" class="cms-profile-pic"><img src="{{{url()}}}/images/user.png" alt="user-pic"/>
            <p><span>Welcome</span><br><span class="cms-profile-name">{{{Session::get('userName')}}}</span></p>
        </a>
    </div>
    <div class="drop-down-menu">
        <ul class="drop-down-menu-links">
            <li>
                <a href="/user/dashboard"  class="active-link">
                    <span class="menu-icon dashboard">
                        <span class="menu-text">Dashboard</span>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- END of .left-section -->