<?php 
//URL PARAMETERS CONFIGARATION START
    $page="";
    if(isset($offset)&& $offset!="")
    {
        $page="&amp;p=".$offset;
    }
    else{$page="";}

    if(!isset($role)&& $role=="")
    {
        $role="all";
    }
    $search_uri="";
    if(isset($search)&& $search!="")
    {
        $search_uri="&amp;search=".$search;
    }
    else{$search_uri="";}
    if(!isset($status)&& $status=="")
    {
        $status="all";
    }
    $status_uri=isset($status)&& $status!=""?"&amp;status=".$status:"";
    //URL PARAMETERS CONFIGARATION END
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
    <?php echo $form->open(); ?>
	<?php echo $form->messages(); ?>
        <div class="box box-primary">
            <div class="col-md-12 p-3 custom-btn-container">
                <a href="people/add" class="btn btn-success btn-lg pull-right btn-add"><i class="fa fa-plus"></i> Add</a>
            </div>
            <div class="row p-3">

            <div class="col-md-8">
                <div class="btn-group">
                    <button type="button" class="btn btn-md btn-default dropdown-toggle" data-toggle="dropdown">
                        <?= $per_page ?>&nbsp;<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/people?count=10<?= $page ?>&amp;role=<?= $role.$status_uri ?><?= $search_uri ?>">10</a></li>
                        <li><a href="/admin/people?count=25<?= $page ?>&amp;role=<?= $role.$status_uri ?><?= $search_uri ?>">25</a></li>
                        <li><a href="/admin/people?count=50<?= $page ?>&amp;role=<?= $role.$status_uri ?><?= $search_uri ?>">50</a></li>
                    </ul>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-md btn-default dropdown-toggle text-capitalize" data-toggle="dropdown">
                        <i class="fa fa-filter"></i>&nbsp;Role: <?=$role?>&nbsp;<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu text-capitalize">
                        <li><a href="/admin/people?role=all&amp;count=<?= $per_page ?><?= $search_uri.$status_uri ?>">all</a></li>
                        <li><a href="/admin/people?role=member&amp;count=<?= $per_page ?><?= $search_uri.$status_uri ?>">member</a></li>
                        <li><a href="/admin/people?role=admin&amp;count=<?= $per_page ?><?= $search_uri.$status_uri ?>">admin</a></li>
                    </ul>
                </div>
                
                   <div class="btn-group">
                    <button type="button" class="btn btn-md btn-default dropdown-toggle text-capitalize" data-toggle="dropdown">
                        <i class="fa fa-filter"></i>&nbsp;Status: <span id="draw"></span>&nbsp;<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu text-capitalize">
                        <li><a class="draw" href="/admin/people?status=all&amp;role=<?= $role ?>&amp;count=<?= $per_page ?><?= $search_uri ?>">all</a></li>
                        <li><a class="draw" href="/admin/people?status=1&amp;role=<?= $role ?>&amp;count=<?= $per_page ?><?= $search_uri ?>">Active</a></li>
                        <li><a class="draw" href="/admin/people?status=0&amp;role=<?= $role ?>&amp;count=<?= $per_page ?><?= $search_uri ?>">Inactive</a></li>
                    </ul>
                </div>

            </div>
            <div class="col-md-4">              
                        <input type="hidden" name="role" value="<?= $role ?>">
                        <input type="hidden" name="count" value="<?= $per_page ?>">
                                        <div class="input-group">
                        <input type="text" class="form-control" name="search" value="<?= $search ?>" placeholder="Search Term">
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="submit"><i class="fa fa-search"></i> Search</button>
                        </span>
                    </div>               
            </div>
        </div>
            <div class="col-md-12 p-3">
                <div class="custom-table-wrapper">
                    <table class="table table-bordered table-striped bycolor-table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>CONTACT INFO</th>
                                <th>Home Phone</th>
                                <th>Cell Phone</th>
                                <th>BADGE #	</th>
                                <th>ROLE</th>
                                <th>Test Status</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user['first_name']; ?> <?= $user['last_name']; ?><?=$user['state']==1?'':'<span class="label label-danger ml-2">Inactive</span>'?></td>
                                <td><a href="mailto: <?= $user['email']; ?>"><?= $user['email']; ?></a><br></td>
                                <td><?php if(isset($user['phone'])&&$user['phone']!="") echo $user['phone']."" ; ?></td>
                                <td><?=$user['cell_phone']?></td>
                                <td><?= $user['badge']; ?></td>
                                <td>
                                <?php $roles=array(); $roles = $controller->user_roles($user['user_id']);                        
                                    foreach ($roles as $role)
                                    {
                                        if ($role['role_name']=="admin")
                                        {
                                            echo '<span class="label label-danger m-2">'.$role['role_name'].'</span>';
                                        }
                                        else
                                        {
                                            echo '<span class="label label-success m-2">'.$role['role_name'].'</span>';
                                        }
                                    }                            
                                ?>
                                </td>
                                <td>
                                <?php if($user['examp_status']=='0') { ?><span class="pending">Pending</span> <?php } ?>
                                 <?php if($user['examp_status']=='1') { ?><span class="fail">Fail</span> <?php } ?>
                                 <?php if($user['examp_status']=='2') { ?><span class="pass">pass</span> <?php } ?>
                                </td>
                                <td class="text-left table-action-col">
                                    <a href="user-guests/lists/<?=$user['user_id']?>" data-toggle="tooltip" title="Manage Guests" class="cust_user_button"><span class="edit-icon"></span></a>
                                    <a href="people/edit/<?=$user['user_id']?>" data-toggle="tooltip" title="Edit User" class="cust_edit_button"><span class="edit-icon"></span></a>
                                    <a href="people/remove/<?=$user['user_id']?>" data-toggle="tooltip" title="Remove User" class="cust_delete_button"><span class="delete-icon"></span></a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <div class="pull-left">
                    <?php if(!empty($users)){ 
                    $count_to=$per_page + $count_from;
                    if($count_to >= $total_row)
                    {
                        $count_to = $total_row; 
                    }
                    ?>
                         Showing <?php echo $count_from+1 ?> to <?php echo  $count_to ?> of <?php echo $total_row ?> entries
                    <?php } else {?>
                         No data found! Showing 0 entries...
                    <?php } ?>
                </div>
                <div class="pull-right">
                    <?php  echo $this->pagination->create_links();   ?> 
                </div>
            </div>
        </div>
        <?php echo $form->close(); ?>   
    </div>
    <script type="text/javascript">
    $('.draw').click(function(){
     var value= $(this).text();     
     Cookies.set('draw', ''+value+'')//set the cookie value  
    });
    var drawValue=Cookies.get('draw')//get the value from cookie  
    if (typeof drawValue !== 'undefined'){      
       $('#draw').text(drawValue);
    }
    else
    {
        $('#draw').text("All"); 
    }
    var drawAll = "<?php echo $status ?>";
    if(drawAll=="all")
    {
        $('#draw').text("All"); 
    }   
    </script>
</div>