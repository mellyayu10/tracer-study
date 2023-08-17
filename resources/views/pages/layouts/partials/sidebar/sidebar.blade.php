<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">

                @can("admin")
                    @include("pages.layouts.partials.sidebar.sidebar_admin")
                @endcan

                @can("alumni")
                    @include("pages.layouts.partials.sidebar.sidebar_alumni")
                @endcan

            </ul>
        </div>
    </div>
</div>
