<div class="header-profile d-flex align-items-center p-3 ">
    <div class="dropdown mt-3">
        <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
            <span class="user-name d-none d-md-block">{{Auth()->user()->name}}</span>
            <span class="avatar">
                <img src="{{ asset('/TemplateDashboard/design/assets/images/user-avatar-default.png')}}" alt="Admin Templates" />
                <span class="status online"></span>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userSettings">
            <div class="header-profile-actions">
                <a href="profile.html">Profile</a>
                <a href="account-settings.html">Settings</a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-logout"
                class="btn btn-danger btn-rounded btn-sm px-5">Sign Out</button>
             
            </div>
        </div>
    </div>
</div>