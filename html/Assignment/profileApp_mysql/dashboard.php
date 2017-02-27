<?php
session_start();

if(!isset($_SESSION['signin'])){
    header ("Location: login.php");
}
$title = "Dashboard";
include('layout/header.php');

$dbc = include("../config.php");
$employee_id_select = "SELECT * FROM employee WHERE id = :id LIMIT 1";
$querry = $dbc->prepare($employee_id_select);
$querry->bindValue('id', $_SESSION['user_id']);
$querry->execute();
$user = $querry->fetch();
$img = $user['photo_location'];
?>
<div class="col-md-12 bg-primary">
    <form class="navbar-form navbar-right col-md-3" method="post" action="signout.php">
        <button type="submit" class="btn btn-default" name="sign_out"><span class="glyphicon glyphicon-log-out"></span>  Sign out</button>
    </form>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"><img src="
                <?php echo isset($img) ? 'image/'.$img : 'http://eadb.org/wp-content/uploads/2015/08/profile-placeholder.jpg'; 
                ?>
                "
                 alt = "profile_image" class = "img-responsive"></div>
        <div class="col-md-8">
            <h1>
                <?php echo $user['first_name'] . " ". $user['middle_name'] . " " . $user['last_name']?>
            </h1>
            <h3>email id: </span>  <?php echo $user['email_id']; ?></h3>
            <h3>DOB: <?php echo $user['date_of_birth']; ?></h3>
        </div>
    </div>  
</div>
<?php
echo "<br>";
echo "<br>";
echo "<h1 class = text-center text-info bg-info>".'Employee Data' . "</h1>";
echo "<br>";
$sql =  "SELECT `E`.`id`,
        `E`.`prefix`,     
        `E`.`first_name`,
        `E`.`middle_name`,
        `E`.`last_name`,
        `E`.`email_id`,
        `date_of_birth`, 
        Concat_ws(`A1`.`address`,' ', `A1`.`zip_code`) AS 'present_add', 
        Concat_ws(`A2`.`address`,' ', `A2`.`zip_code`) AS 'permanent_add', 
        employer.name AS company, 
        employment.name AS position, 
        contact.contact_no AS contact 
        FROM `employee` `E` 
        LEFT JOIN `address` `A1` 
        ON `E`.id = `A1`.employee_id 
        AND `A1`.`type` = :present 
        LEFT JOIN `address` `A2` 
        ON `E`.id = `A2`.employee_id 
        AND `A2`.`type` = :permanent 
        LEFT JOIN employer 
        ON `E`.employer_id = employer.id 
        LEFT JOIN employment 
        ON `E`.employment_id = employment.id 
        LEFT JOIN contact 
        ON `E`.id = contact.employee_id";
$stmt = $dbc->prepare($sql);
echo "<div class='table-responsive'>";
    echo "<table class = 'table' id='emp_table'>
    		<thead>
	            <tr>
	                <th>Name</th>
	                <th>email</th>
	                <th>D.O.B</th>
	                <th>Present Address</th>
	                <th>permanent Address</th>
	                <th>Contact</th>
	                <th>Company</th>
	                <th>Position</th>
	                <th>User</th>
	             </tr>
	        </thead>
	        <tbody>"
	             ;
$stmt->bindValue('present','present');
$stmt->bindValue('permanent','permanent');
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row){
    echo '<tr id = "' . $row['id'] . '">';
    echo "<td>" . $row['prefix'].' '. $row['first_name']. ' '.  $row['middle_name'].' ' 
        . $row['last_name'] . "</td>";
    echo "<td>" .$row['email_id']. "</td>";
    echo "<td>" . $row['date_of_birth'] . "</td>";
    echo "<td>" . $row['present_add'] ."</td>";
    echo "<td>" . $row['permanent_add']. "</td>";
    echo "<td>" . $row['contact']. "</td>";
    echo "<td>" . $row['company']. "</td>";
    echo "<td>" . $row['position']. "</td>";
    echo '<td>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                        Actions
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#myModal" type = "a" class="view_posts" value="wordpress" 
                        data-toggle = "modal" data-id = "' .  $row['id'] . '">'.'Posts</a></li>
                        <li><a href="#modal_form" type = "a" class="edit_user" value = "edit" data-toggle = "modal" data-id = "' .  $row['id'] . '">'.'Edit</a></li>
                        <li><a href="#" type = "a" class="delete_user" value = "Delete"
                        data-id = "' .  $row["id"] . '">'.'Delete</a></li>
                        <li><a href="#myModal" type = "a" class="view_user" value = "View" data-toggle = "modal" data-id = "' .  $row["id"] . '">'.'View</a></li>
                    </ul>
                </div>
            </td>';
}
echo "</tbody>";
echo "</table>";
echo "</div>"; 
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body" id="modalid">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Form -->
<div class="modal fade" id = "modal_form" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
<form class="form-horizontal well" method="post" id="update_form" enctype="multipart/form-data">
    <fieldset>
        <legend class="text-center text-info bg-info">Update Employee Data</legend>
        <input id="employee_id" name="employee_id" type="hidden">
        <div class="form-group">
            <label class="col-md-4 control-label" for="prefix">Prefix</label>
            <div class="col-md-4">
                <select id="prefix" name="prefix" class="form-control input-md">
                    <option>Mr.</option>
                    <option>Mrs.</option>
                    <option>Miss</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="first_name">First name</label>  
            <div class="col-md-4">
                <input id="first_name" name="first_name" type="text" placeholder="First Name"
                    class="form-control input-md " >
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="middle_name">Middle Name</label>  
            <div class="col-md-4">
                <input id="middle_name" name="middle_name" type="text" placeholder="middle name" 
                    class="form-control input-md">
                <p id="mn_error"></p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="last_name">Last name</label>  
            <div class="col-md-4">
                <input id="last_name" name="last_name" type="text" 
                    placeholder="last name" 
                    value="<?php echo isset($_SESSION['last_name']) ? $_SESSION['last_name'] : ''; ?>" 
                    class="form-control input-md" onblur="return isValidName('first_name','ln_error')"
                    onfocus = "return isValidName('last_name','ln_error')">
                <p id ="ln_error"></p>
                <span class="text-danger"> <?php echo isset($_SESSION['last_name_error']) ? $_SESSION['last_name_error'] : ''; ?> 
                </span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="gender">Gender</label>
            <div class="col-md-4"> 
                <label class="radio-inline" for="gender">
                    <input type="radio" name="gender" id="gender" value="male" checked="checked">
                    male
                    </label> 
                    <label class="radio-inline" for="gender">
                    <input type="radio" name="gender" id="gender" value="female">
                    female
                    </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="date_of_birth">Date of Birth</label>  
            <div class="col-md-4">
                <input id="date_of_birth" name="date_of_birth" type="Date" placeholder="date of birth" 
                    class="form-control input-md">  
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="cmpny">Company</label>  
            <div class="col-md-4">
                <input id="company" name="company" type="text" placeholder="company"
                    value="<?php echo isset($_SESSION['company']) ? $_SESSION['company'] : ''; ?>"
                    class="form-control input-md" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="position">Position</label>  
            <div class="col-md-4">
                <input id="position" name="position" type="text" placeholder="position"  
                    class="form-control input-md">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="email">Email</label>  
            <div class="col-md-4">
                <input id="email" name="email" type="text" placeholder="email"
                    class="form-control input-md">
                <p id = "err" class="text-danger"></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="permanent_address">Permanent Address</label>  
            <div class="col-md-4">
                <textarea id="permanent_address" name="permanent_address" type="text" 
                    placeholder="address" 
                    class="form-control input-md" ></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="permanent_zip">Zip Code</label>  
            <div class="col-md-4">
                <input id="zip" name="permanent_zip" type="text" placeholder="Zip Code"  
                    class="form-control input-md">
                <p id = "zip_error"></p>     
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="permanent_city">City</label>  
            <div class="col-md-4">
                <input id="permanent_city" name="permanent_city" type="text" placeholder="city" 
                    class="form-control input-md">
            </div> 
        </div>   

        <div class="form-group">
            <label class="col-md-4 control-label" for="permanent_state">State</label>  
            <div class="col-md-4">
                <input id="permanent_state" name="permanent_state" type="text" placeholder="state" 
                    class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="present_adddress">Present Address</label>  
            <div class="col-md-4">
                <textarea id="present_address" name="present_address" type="text" 
                    placeholder="address" class="form-control input-md" >
                </textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="present_zip">Zip Code</label>  
            <div class="col-md-4">
                <input id="zip" name="present_zip" type="text" placeholder="Zip Code" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="present_city">City</label>  
            <div class="col-md-4">
                <input id="present_city" name="present_city" type="text" placeholder="city" class="form-control input-md">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="present_state">State</label>  
            <div class="col-md-4">
                <input id="present_state" name="present_state" type="text" placeholder="state" class="form-control input-md">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="phone">Text InputPhone</label>  
            <div class="col-md-4">
                <input id="phone_no" name="phone_no" type="text" placeholder="Phone#"
                    class="form-control input-md">
                </span> 
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="prefered_communication">Prefered Communication</label>
            <div class="col-md-4">
                <select id="prefered_communication" name="prefered_communication" class="form-control input-md" >
                    <option>email</option>
                    <option>fax</option>
                    <option>phone</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="image">File upload</label>  
            <div class="col-md-4">
                <input id="profile_image" name="profile_image" type="file" 
                    class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-4">
                <button id="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </fieldset>
</form>
	    </div>
	        <div class="modal-footer">
	    </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php 

include ('layout/footer.php');
?>