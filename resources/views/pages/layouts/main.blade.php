
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>STUDY TRACER - @yield("title") </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />

        @include("pages.layouts.partials.css.style")

        @yield("css")

    </head>

    <body data-topbar="dark">

        <div id="layout-wrapper">

            @include("pages.layouts.partials.header.header")

            @include("pages.layouts.partials.sidebar.sidebar")

            <div class="main-content">
                <div class="page-content">
                    @yield("content")
                </div>
                @include("pages.layouts.partials.footer.footer")
            </div>
        </div>


        @include("pages.layouts.partials.javascript.style")

        @yield("javascript")

    </body>
</html>
