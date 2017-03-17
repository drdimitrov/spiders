@extends('layouts.app')

@section('content')
	
	<div class="row affix-row">
		<div class="col-sm-3 col-md-2 affix-sidebar">
			<div class="sidebar-nav">
				<div class="navbar navbar-default" role="navigation">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
						<span class="visible-xs navbar-brand">Sidebar menu</span>
					</div>
					<div class="navbar-collapse collapse sidebar-navbar-collapse">
						<ul class="nav navbar-nav" id="sidenav01">
							<li class="active">
							  <a href="#" data-toggle="collapse" data-target="#toggleDemo0" data-parent="#sidenav01" class="collapsed">
							  <h4>
							  Authors
							  <small><span class="caret"></span></small>
							  </h4>
							  </a>
							  <div class="collapse" id="toggleDemo0" style="height: 0px;">
							    <ul class="nav nav-list">
							      <li><a href="{{route('admin.authors')}}">Authors list</a></li>
							      <li><a href="{{route('admin.authors.create')}}">Add author</a></li>
							      <li><a href="#">Edit author</a></li>
							      <li><a href="#">Delete author</a></li>
							    </ul>
							  </div>
							</li>

							<li>
							  <a href="#" data-toggle="collapse" data-target="#toggleDemo1" data-parent="#sidenav01" class="collapsed">
							  <h4>
							  Papers
							  <small><span class="caret"></span></small>
							  </h4>
							  </a>
							  <div class="collapse" id="toggleDemo1" style="height: 0px;">
							    <ul class="nav nav-list">
							      <li><a href="{{route('admin.papers')}}">Papers list</a></li>
							      <li><a href="{{route('admin.papers.create')}}">Add paper</a></li>
							      <li><a href="#">Edit paper</a></li>
							      <li><a href="#">Delete paper</a></li>
							    </ul>
							  </div>
							</li>

							<li>
							  <a href="#" data-toggle="collapse" data-target="#toggleDemo2" data-parent="#sidenav02" class="collapsed">
							  <h4>
							  Families
							  <small><span class="caret"></span></small>
							  </h4>
							  </a>
							  <div class="collapse" id="toggleDemo2" style="height: 0px;">
							    <ul class="nav nav-list">
							      <li><a href="#">List of families</a></li>
							      <li><a href="{{ route('admin.family.create') }}">Add family</a></li>
							      <li><a href="#">Edit family</a></li>
							      <li><a href="#">Delete family</a></li>
							    </ul>
							  </div>
							</li>

							<li>
							  <a href="#" data-toggle="collapse" data-target="#toggleDemo3" data-parent="#sidenav03" class="collapsed">
							  <h4>
							  Genera
							  <small><span class="caret"></span></small>
							  </h4>
							  </a>
							  <div class="collapse" id="toggleDemo3" style="height: 0px;">
							    <ul class="nav nav-list">
							      <li><a href="#">List of genera</a></li>
							      <li><a href="{{ route('admin.genus.create') }}">Add genus</a></li>
							      <li><a href="#">Edit genus</a></li>
							      <li><a href="#">Delete genus</a></li>
							    </ul>
							  </div>
							</li>


							<li>
							  <a href="#" data-toggle="collapse" data-target="#toggleDemo4" data-parent="#sidenav04" class="collapsed">
							  <h4>
							  Species
							  <small><span class="caret"></span></small>
							  </h4>
							  </a>
							  <div class="collapse" id="toggleDemo4" style="height: 0px;">
							    <ul class="nav nav-list">
							      <li><a href="#">List of species</a></li>
							      <li><a href="{{ route('admin.species.create') }}">Add species</a></li>
							      <li><a href="#">Edit species</a></li>
							      <li><a href="#">Delete species</a></li>
							    </ul>
							  </div>
							</li>


							<!-- <li><a href="#"><span class="glyphicon glyphicon-lock"></span> Normalmenu</a></li>
							
							<li><a href=""><span class="glyphicon glyphicon-cog"></span> PreferencesMenu</a></li> -->
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
		<div class="col-sm-9 col-md-10 affix-content">
			<div class="container">				
				<div class="page-header">
					<h3><span class="glyphicon glyphicon-th-list"></span> Control panel</h3>
				</div>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lectus orci, viverra nec neque non, tincidunt commodo leo. Nullam eleifend velit purus, id aliquam elit venenatis sit amet. Cras vel nisl eget eros tempus viverra. Phasellus in enim et nulla tempor blandit. Donec at lectus sit amet velit faucibus tincidunt quis sed est. Mauris placerat purus odio. In egestas, velit quis congue sodales, turpis lacus pellentesque neque, quis accumsan orci nibh sed mauris. Sed sit amet pulvinar felis. Aliquam consequat tellus non ligula elementum, at egestas quam vestibulum.
				Duis sed urna sit amet quam rutrum malesuada sed eu risus. Cras sit amet velit a neque tincidunt cursus sed ac nunc. Donec ac auctor purus. Proin viverra turpis sit amet dui sagittis, quis tempor elit suscipit. Curabitur rutrum lacus et diam lacinia, vel ullamcorper libero vulputate. Phasellus sem ligula, pharetra sed nisl sed, facilisis sagittis ante. Nullam egestas turpis et mauris aliquet cursus. Nullam vel eleifend neque.</p>
			</div>
		</div>
	</div>
@endsection