<% include Banner %>


<!-- BEGIN CONTENT -->
<div class="content">
    <div class="container">
        <div class="row">
            <% with Region %>
            <div class="main col-sm-8">
                <div class="blog-main-image">
                    $Photo.ScaleWidth(750)
                </div>
                <h1 class="section-title">$Title</h1>
                <p class="lead">$Description</p>
            </div>
            <% end_with %>
            <!-- <div class="main col-sm-8"> -->

            </div>
            <% if Menu(2) %>
            <div class="sidebar gray col-sm-4">
                <h3 class="section-title">In this section</h3>
                <ul class="subnav">
                    <% loop Menu(2) %>
                    <li><a class="$LinkingMode" href="$Link">$MenuTitle</a></li>
                    <% end_loop %>
                </ul>
            </div>
            <% end_if %>
        </div>
    </div>
</div>
<!-- END CONTENT -->
