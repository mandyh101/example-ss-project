<% include Banner %>
<!-- BEGIN CONTENT WRAPPER -->
<div class="content">
	<div class="container">
		<div class="row">

            <h1 class="blog-title">$Title</h1>

            <div class="blog-main-image">
                <!-- option1 - use SS syntax to create an image element in the html  -->
                <!-- $Photo.ScaleWidth(750) -->
                 <!-- option2 - use with logic to scope the image element to the Photo obct, access properties and customise classes on the class attribute -->
                <% with $Photo.ScaleWidth(750) %>
                    <img class="my-custom-class" src="$URL" alt="" width="$Width" height="$Height" />
                <% end_with %>
                <div class="tag"><i class="fa fa-file-text"></i></div>
            </div>

            <div class="blog-bottom-info">
                <ul>
                    <li><i class="fa fa-calendar"></i>$Date</li>
                    <li><i class="fa fa-comments-o"></i> 3 Comments</li>
                    <li>
                        <i class="fa fa-tags"></i>
                        $CategoriesList
                    </li>
                </ul>
<!-- TODO fix author... -->
                <div id="post-author"><i class="fa fa-pencil"></i>By $Author</div>

            </div>

			<!-- BEGIN MAIN CONTENT -->
			<div class="post-content">

				$Content

                <div class="share-wrapper col-sm-12 clearfix">
                    <h5>Share this Post:</h5>
                    <ul class="social-networks">
                        <li><a target="_blank" href="http://www.facebook.com/sharer.php?s=100&amp;p%5Burl%5D=http%3A%2F%2Fwww.wiselythemes.com%2Fhtml%2Fcozy%2Fblog-detail.html%3Ffb%3Dtrue&amp;p%5Bimages%5D%5B0%5D=http%3A%2F%2Fwww.wiselythemes.com%2Fhtml%2Fcozy%2Fimages%2Fnews-img1.jpg&amp;p%5Btitle%5D=Cozy%20Blog%20Post"><i class="fa fa-facebook"></i></a></li>
                        <li><a target="_blank" href="https://twitter.com/intent/tweet?url=http://www.wiselythemes.com/html/cozy/blog-detail.html&amp;text=Cozy%20Blog%20Post"><i class="fa fa-twitter"></i></a></li>
                        <li><a target="_blank" href="https://plus.google.com/share?url=http://www.wiselythemes.com/html/cozy/blog-detail.html"><i class="fa fa-google"></i></a></li>
                        <li><a target="_blank" href="http://pinterest.com/pin/create/button/?url=http://www.wiselythemes.com/html/cozy/blog-detail.html&amp;description=Cozy%20Blog%20Post&amp;media=http%3A%2F%2Fwww.wiselythemes.com%2Fhtml%2Fcozy%2Fimages%2Fnews-img1.jpg"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="mailto:?subject=Check%20out%20this%20blog%20post%20from%20Cozy%20Real%20Estate!&amp;body=http://www.wiselythemes.com/html/cozy/blog-detail.html"><i class="fa fa-envelope"></i></a></li>
                    </ul>
                    <a class="print-button" href="javascript:window.print();">
                        <i class="fa fa-print"></i>
                    </a>
                </div>
                <% if $Brochure %>
                <div class="row">
                    <% with $Brochure %>
                    <div class="col-sm-12"><a class="btn btn-warning btn-block" href="$Brochure.URL"> Download brochure ($Extension, $Size)</a>
                    </div>
                    <% end_with %>
                </div>
                <% end_if %>

                <h1 class="section-title">Comments</h1>

                    <div class="comments">
                        <ul>
                            <li>
                                <img src="images/comment-man.jpg" alt="" />
                                <div class="comment">
                                    <a href="#" class="btn btn-default-color">Reply</a>
                                    <h3>John Doe<small>30 July, 2014</small></h3>
                                    <p>Etiam eget felis lacus. In hendrerit, urna in fringilla interdum, nunc mauris condimentum purus, vel ullamcorper dui risus sed tellus. Nullam lacinia porttitor velit fermentum accumsan. Etiam dui lorem, lobortis pellentesque malesuada nec, lacinia pulvinar libero.</p>
                                </div>
                                <ul>
                                    <li>
                                        <img src="images/comment-man.jpg" alt="" />
                                        <div class="comment">
                                            <a href="#" class="btn btn-default-color">Reply</a>
                                            <h3>John Doe<small>30 July, 2014</small></h3>
                                            <p>In hendrerit, urna in fringilla interdum, nunc mauris condimentum purus, vel ullamcorper dui risus sed tellus. Nullam lacinia porttitor velit fermentum accumsan. Etiam dui lorem, lobortis pellentesque malesuada nec, lacinia pulvinar libero.</p>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <img src="images/comment-woman.jpg" alt="" />
                                <div class="comment">
                                    <a href="#" class="btn btn-default-color">Reply</a>
                                    <h3>Mary Doe<small>31 July, 2014</small></h3>
                                    <p>Etiam eget felis lacus. In hendrerit, urna in fringilla interdum, nunc mauris condimentum purus, vel ullamcorper dui risus sed tellus. Nullam lacinia porttitor velit fermentum accumsan. Etiam dui lorem, lobortis pellentesque malesuada nec, lacinia pulvinar libero. Quisque pretium nunc sed nisl vehicula gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                </div>
                            </li>
                        </ul>

                        <div class="comments-form">
                            <div class="col-sm-12">
                                <h3>Leave a Reply</h3>
                                <p>Your email address will not be published. Required fields are marked*</p>
                                $CommentForm
                            </div>

                        </div>
                    </div>
			</div>
			<!-- END MAIN CONTENT -->


			<!-- BEGIN SIDEBAR -->
			<div class="sidebar gray col-sm-4">
<!--
                <% if Menu(2) %>
				<h2 class="section-title">Categories</h2>
				<ul class="categories">
                    <% loop Menu(2) %>
                    <li><a class="$LinkingMode" href="$Link">$MenuTitle</a></li>
                    <% end_loop %>
				</ul>
                <% end_if %> -->

				<!-- BEGIN ARCHIVES ACCORDION -->
				<h2 class="section-title">Archives</h2>
				<div id="accordion" class="panel-group blog-accordion">
					<div class="panel">
						<div class="panel-heading">
							<div class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="">
									<i class="fa fa-chevron-right"></i> 2014 (15)
								</a>
							</div>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in">
							<div class="panel-body">
								<ul>
									<li><a href="#">July (3)</a></li>
									<li><a href="#">June (4)</a></li>
									<li><a href="#">May (1)</a></li>
									<li><a href="#">April (2)</a></li>
									<li><a href="#">March (3)</a></li>
									<li><a href="#">February (1)</a></li>
									<li><a href="#">January (1)</a></li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel">
						<div class="panel-heading">
							<div class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">
									<i class="fa fa-chevron-right"></i> 2013 (6)
								</a>
							</div>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse">
							<div class="panel-body">
								<ul>
									<li><a href="#">May (1)</a></li>
									<li><a href="#">April (2)</a></li>
									<li><a href="#">March (1)</a></li>
									<li><a href="#">February (2)</a></li>
									<li><a href="#">January (1)</a></li>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel">
						<div class="panel-heading">
							<div class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">
									<i class="fa fa-chevron-right"></i> 2012 (5)
								</a>
							</div>
						</div>
						<div id="collapseThree" class="panel-collapse collapse">
							<div class="panel-body">
								<ul>
									<li><a href="#">April (1)</a></li>
									<li><a href="#">March (1)</a></li>
									<li><a href="#">February (2)</a></li>
									<li><a href="#">January (1)</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- END  ARCHIVES ACCORDION -->


				<!-- BEGIN TAGS -->
				<h2 class="section-title">Tags</h2>
				<ul class="tags col-sm-12">
					<li><a href="#">Apartments</a></li>
					<li><a href="#">Residential</a></li>
					<li><a href="#">News</a></li>
					<li><a href="#">Real estate</a></li>
					<li><a href="#">Land</a></li>
					<li><a href="#">Business</a></li>
					<li><a href="#">Villas</a></li>
					<li><a href="#">Loans</a></li>
					<li><a href="#">Commercial</a></li>
					<li><a href="#">Rent</a></li>
				</ul>
				<!-- BEGIN TAGS -->


				<!-- BEGIN LATEST NEWS -->
				<h2 class="section-title">Latest News</h2>
				<ul class="latest-news">
					<li class="col-md-12">
						<div class="image">
							<a href="blog-detail.html"></a>
							<img src="http://placehold.it/100x100" alt="" />
						</div>

						<ul class="top-info">
							<li><i class="fa fa-calendar"></i> July 30, 2014</li>
						</ul>

						<h3><a href="blog-detail.html">How to get your dream property for the best price?</a></h3>
					</li>
					<li class="col-md-12">
						<div class="image">
							<a href="blog-detail.html"></a>
							<img src="http://placehold.it/100x100" alt="" />
						</div>

						<ul class="top-info">
							<li><i class="fa fa-calendar"></i> July 24, 2014</li>
						</ul>

						<h3><a href="blog-detail.html">7 tips to get the best mortgage.</a></h3>
					</li>
					<li class="col-md-12">
						<div class="image">
							<a href="blog-detail.html"></a>
							<img src="http://placehold.it/100x100" alt="" />
						</div>

						<ul class="top-info">
							<li><i class="fa fa-calendar"></i> July 05, 2014</li>
						</ul>

						<h3><a href="blog-detail.html">House, location or price: What's the most important factor?</a></h3>
					</li>
				</ul>
				<!-- END LATEST NEWS -->

			</div>
			<!-- END SIDEBAR -->

		</div>
	</div>
</div>
