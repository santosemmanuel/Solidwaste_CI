<!-- Begin Page Content -->
<!--<div class="container-fluid">-->
<!---->
<!--	Page Heading -->
<!--	<div class="d-sm-flex align-items-center justify-content-between mb-4">-->
<!--		<h1 class="h3 mb-0 text-gray-800">Concern</h1>-->
<!--	</div>-->
<!---->
<!--	Content Row -->
<!--	<div class="row">-->
<!--		<div class="col-12">-->
<!--			<div class="card">-->
<!--				<div class="card-body">-->
<!--					<table class="table table-striped table-sm">-->
<!--						<thead>-->
<!--						<tr>-->
<!--							<th scope="col" colspan="2">Message</th>-->
<!--						</tr>-->
<!--						</thead>-->
<!--						<tbody>-->
<!--						--><?php //foreach($list_concern as $concern){ ?>
<!--							<tr>-->
<!--								<td width="85%">-->
<!--									<p>-->
<!--										--><?php //if($concern->sender == 1){ ?>
<!--											<strong>Admin</strong>-->
<!--										--><?php //} else {?>
<!--											<strong>You</strong>-->
<!--										--><?php //} ?>
<!--										<br>--><?php //echo $concern->message; ?>
<!--									</p>-->
<!--								</td>-->
<!--								<td>-->
<!--									<div class="float-right">-->
<!--										<button type="button" class="btn btn-link btn-sm"><i class="fa fa-trash" aria-hidden="true"></i>-->
<!--										</button>-->
<!--									</div>-->
<!--									<small>--><?php //echo $concern->message_date; ?><!--</small>-->
<!--								</td>-->
<!--							</tr>-->
<!--						--><?php //}?>
<!--						</tbody>-->
<!--					</table>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!-- /.container-fluid -->
<!--</div>-->

<div class="container bootstrap snippets bootdey">
	<div class="row">
		<div class="col-sm-3 col-md-2">
			<div class="btn-group">
				<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
					Mail <span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a href="#">Mail</a></li>
					<li><a href="#">Contacts</a></li>
					<li><a href="#">Tasks</a></li>
				</ul>
			</div>
		</div>
		<div class="col-sm-9 col-md-10">
			<!-- Split button -->
			<div class="btn-group">
				<button type="button" class="btn btn-default">
					<div class="checkbox" style="margin: 0;">
						<label>
							<input type="checkbox">
						</label>
					</div>
				</button>
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a href="#">All</a></li>
					<li><a href="#">None</a></li>
					<li><a href="#">Read</a></li>
					<li><a href="#">Unread</a></li>
					<li><a href="#">Starred</a></li>
					<li><a href="#">Unstarred</a></li>
				</ul>
			</div>
			<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh">
				&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;&nbsp;</button>
			<!-- Single button -->
			<div class="btn-group">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					More <span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a href="#">Mark all as read</a></li>
					<li class="divider"></li>
					<li class="text-center"><small class="text-muted">Select messages to see more actions</small></li>
				</ul>
			</div>
			<div class="pull-right">
				<span class="text-muted"><b>1</b>–<b>50</b> of <b>160</b></span>
				<div class="btn-group btn-group-sm">
					<button type="button" class="btn btn-default">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</button>
					<button type="button" class="btn btn-default">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</button>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-sm-3 col-md-2">
			<a href="#" class="btn btn-success btn-sm btn-block" role="button"><i class="glyphicon glyphicon-edit"></i> Compose</a>
			<hr>
			<ul class="nav nav-pills nav-stacked">
				<li class="active"><a href="#"><span class="badge pull-right">32</span> Inbox </a>
				</li>
				<li><a href="#">Starred</a></li>
				<li><a href="#">Important</a></li>
				<li><a href="#">Sent Mail</a></li>
				<li><a href="#"><span class="badge pull-right">3</span>Drafts</a></li>
			</ul>
		</div>
		<div class="col-sm-9 col-md-10">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs">
				<li class="active"><a href="#home" data-toggle="tab"><span class="glyphicon glyphicon-inbox">
                </span>Primary</a></li>
				<li><a href="#profile" data-toggle="tab"><span class="glyphicon glyphicon-user"></span>
						Social</a></li>
				<li><a href="#messages" data-toggle="tab"><span class="glyphicon glyphicon-tags"></span>
						Promotions</a></li>
				<li><a href="#settings" data-toggle="tab"><span class="glyphicon glyphicon-plus no-margin">
                </span></a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane fade in active" id="home">
					<div class="list-group">
						<a href="#" class="list-group-item">
							<div class="checkbox">
								<label>
									<input type="checkbox">
								</label>
							</div>
							<span class="glyphicon glyphicon-star-empty"></span><span class="name label label-info" style="min-width: 120px;
                                display: inline-block;">Andres posada</span> <span class="">Nice work on the lastest version</span>
							<span class="text-muted" style="font-size: 11px;">- More content here</span> <span class="badge">12:10 AM</span> <span class="pull-right"><span class="glyphicon glyphicon-paperclip">
                            </span></span></a><a href="#" class="list-group-item">
							<div class="checkbox">
								<label>
									<input type="checkbox">
								</label>
							</div>
							<span class="glyphicon glyphicon-star-empty"></span><span class="name  label label-success" style="min-width: 120px;
                                    display: inline-block;">Juan acosta</span> <span class="">This is big title</span>
							<span class="text-muted" style="font-size: 11px;">- I saw that you had..</span> <span class="badge">12:09 AM</span> <span class="pull-right"><span class="glyphicon glyphicon-paperclip">
                                    </span></span></a><a href="#" class="list-group-item read">
							<div class="checkbox">
								<label>
									<input type="checkbox">
								</label>
							</div>
							<span class="glyphicon glyphicon-star"></span><span class="name  label label-warning" style="min-width: 120px;
                                            display: inline-block;">Mariana jaramillo</span> <span class="">This is big title</span>
							<span class="text-muted" style="font-size: 11px;">- Hi hello how r u ?</span> <span class="badge">11:30 PM</span> <span class="pull-right"><span class="glyphicon glyphicon-paperclip">
                                    </span>
                                </span>
						</a>
					</div>
				</div>
				<div class="tab-pane fade in" id="profile">
					<div class="list-group">
						<div class="list-group-item">
							<span class="text-center">This tab is empty.</span>
						</div>
					</div>
				</div>
				<div class="tab-pane fade in" id="messages">
					...</div>
				<div class="tab-pane fade in" id="settings">
					This tab is empty.</div>
			</div>
		</div>
	</div>
</div>
