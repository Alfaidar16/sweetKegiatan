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
                <a href="#">Profile</a>
                <a href="#">Settings</a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-logout"
                class="border-0 px-4 bg-white">Sign Out</button>
             
            </div>
        </div>
    </div>
</div>