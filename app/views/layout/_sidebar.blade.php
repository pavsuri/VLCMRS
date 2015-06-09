<div class="left-section">
    <div class="cms-profile-data">
        <a href="javascript:void(0)" class="cms-profile-pic"><img src="/images/user.png" alt="user-pic"/>
            <p><span>Welcome</span><br><span class="cms-profile-name">{{{Session::get('userName')}}}</span></p>
        </a>
    </div>
    <div class="drop-down-menu">
        <ul class="drop-down-menu-links">
            <li>
                <a href="/dashboard" <?php if(Route::current()->getName() == 'dashboard') { echo 'class="active-link"'; } ?>>
                    <span class="menu-icon dashboard">
                        <span class="menu-text">Dashboard</span>
                    </span>
                </a>
            </li>
            <li>
                <a href="/addForm" <?php if(Route::current()->getName() == 'forms.index') { echo 'class="active-link"'; } ?> >
                    <span class="menu-icon create-form"  >
                       <span class="menu-text">Create Form</span>
                    </span>
                </a>
            </li>
            <li>
                <a href="/createFields" <?php if(Route::current()->getName() == 'createFields') { echo 'class="active-link"'; } ?>>
                    <span class="menu-icon create-field">
                        <span class="menu-text">Create Fields</span>
                    </span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" <?php if(Route::current()->getName() == 'forms.saveform') { echo 'class="active-link"'; } ?> >
                    <span class="menu-icon map-field">
                        <span class="menu-text">Map Fields</span>
                    </span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <span class="menu-icon reports">
                        <span class="menu-text">Reports</span>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- END of .left-section -->