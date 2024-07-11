<?php

class  adminback
{
    private $connection;
    
    function __construct()
    {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "alegra_heights_db";

        $this->connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        if (!$this->connection) {
            die("Database connection error!");
        }
    }

    function admin_login($data)
    {
        $username = $data["username"];
        $password = $data['password'];

        $query = "SELECT * FROM `users` WHERE username = '$username' AND password = '$password'";

        if (mysqli_query($this->connection, $query)) {
            $result = mysqli_query($this->connection, $query);
            $admin_info = mysqli_fetch_assoc($result);
            if ($admin_info) {
                session_start();
                session_regenerate_id();
			    $name = $admin_info['first_name'] . ' ' . $admin_info['last_name'];

                $_SESSION['id'] = $admin_info['id'];
                $_SESSION['name'] = $name;
                $_SESSION['profile'] = $admin_info['profile'];
            } else {
                $log_msg = "You have entered a wrong username or password. Please try again.";
                return $log_msg;
            }
        }
    }



    function admin_logout()
    {
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_email']);
        unset($_SESSION['role']);
        header("location:login.php");
        session_destroy();
    }

    function admin_password_recover($recover_email)
    {
        $query = "SELECT * FROM `admin_info` WHERE `admin_email`='$recover_email'";
        if (mysqli_query($this->connection, $query)) {
            $row =  mysqli_query($this->connection, $query);
            return $row;
        }
    }

    function update_admin_password($data)
    {
        $u_admin_id = $data['ad_id'];
        $u_admin_pass = $data['renewpassword'];

        $query = "UPDATE `admin_info` SET `admin_pass`='$u_admin_pass' WHERE `admin_id`= $u_admin_id";

        if (mysqli_query($this->connection, $query)) {
            $msg = "Updated successfully updated.";
            echo "<script type='text/javascript'>
            alert('$msg');
            document.location.href='users-profile.php';
            </script>";
        } else {
            return "Failed";
        }
    }

    function add_admin_user($data){
        $user_email = $data['user_name'];
        $user_pass = $data['user_password'];
        $user_role = $data['user_role'];

        $query = "INSERT INTO `admin_info`( `admin_email`, `admin_pass`, `role`) VALUES ('$user_email','$user_pass',$user_role)";

        if(mysqli_query($this->connection, $query)){
            $msg="{$user_email} add as a user successfully";
            return $msg;
        }
    }

    function show_admin_user(){
        $query = "SELECT * FROM `admin_info`";
        if(mysqli_query($this->connection, $query)){
            $result = mysqli_query($this->connection, $query);
            return $result;
        }
    }

    function show_admin_user_by_id($user_id){
        $query = "SELECT * FROM `admin_info` WHERE `admin_id`=$user_id";
        if(mysqli_query($this->connection, $query)){
            $result = mysqli_query($this->connection, $query);
            return $result;
        }
    }

    function update_admin($data){
        $u_id = $data['user_id'];
        $u_email = $data['u-user-email'];
        $u_role = $data['u_user_role'];
        $query = "UPDATE `admin_info` SET `admin_email`='$u_email',`role`= $u_role WHERE `admin_id`= $u_id ";
        if(mysqli_query($this->connection, $query)){
            $up_msg = "Udated successfully";
            return $up_msg;
        }
        
    }

    function delete_admin($admin_id){
        $query = "DELETE FROM `admin_info` WHERE `admin_id`=$admin_id";
        if(mysqli_query($this->connection, $query)){
            $del_msg = "User Deleted Successfully";
            return $del_msg;
        }
    }

    //MEMBER FUNCTION

    function delete_member($id)
    {

        $query = "DELETE FROM `members` WHERE  id= $id";
        if (mysqli_query($this->connection, $query)) {
        echo "<script>
        alert('Successfully Removed from Member')
        var delay = 1000;
		setTimeout(function(){ window.location = 'masterlist.php'  }, delay);
        </script>";
        }
    }

    function update_mem_stat($id){

        $query = "UPDATE `members` SET
        `status`=0
        WHERE `id`= $id";

        if(mysqli_query($this->connection, $query)){
            $msg = "Member moved to inactive list";
            echo "<script type='text/javascript'>
            alert('$msg');
            </script>";
               if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
        }

    }

    function update_mem_stat_a($id){

        $query = "UPDATE `members` SET
        `status`=1
        WHERE `id`= $id";

        if(mysqli_query($this->connection, $query)){
            $msg = "Member moved to inactive list";
            echo "<script type='text/javascript'>
            alert('$msg');
            </script>";
               if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
        }

    }

    function display_member()
    {
        $query = "SELECT * FROM `members` ORDER BY `lot_number` ASC";

        if (mysqli_query($this->connection, $query)) {
            $mem_info = mysqli_query($this->connection, $query);
            return $mem_info;
        }
    }

    function display_mem_id($id)
    {
        $query = "SELECT * FROM `members` WHERE `id`=$id";

        if (mysqli_query($this->connection, $query)) {
            $mem_info = mysqli_query($this->connection, $query);
            $mem_fetch = mysqli_fetch_assoc($mem_info);
            return $mem_fetch;
        }
    }

    function display_memberin()
    {
        $query = "SELECT * FROM `members` WHERE `status` = 1 ORDER BY `lot_number` ASC";

        if (mysqli_query($this->connection, $query)) {
            $mem_info = mysqli_query($this->connection, $query);
            return $mem_info;
        }
    }


    function display_memberone()
    {
        $query = "SELECT * FROM `members` WHERE `block_number` = 1 ORDER BY `lot_number` ASC";

        if (mysqli_query($this->connection, $query)) {
            $mem_info = mysqli_query($this->connection, $query);
            return $mem_info;
        }
    }


    function display_membertwo()
    {
        $query = "SELECT * FROM `members` WHERE `block_number` = 2 ORDER BY `lot_number` ASC";

        if (mysqli_query($this->connection, $query)) {
            $mem_info = mysqli_query($this->connection, $query);
            return $mem_info;
        }
    }


    function display_memberthree()
    {
        $query = "SELECT * FROM `members` WHERE `block_number` = 3 ORDER BY `lot_number` ASC";

        if (mysqli_query($this->connection, $query)) {
            $mem_info = mysqli_query($this->connection, $query);
            return $mem_info;
        }
    }


    function display_memberfour()
    {
        $query = "SELECT * FROM `members` WHERE `block_number` = 4 ORDER BY `lot_number` ASC";

        if (mysqli_query($this->connection, $query)) {
            $mem_info = mysqli_query($this->connection, $query);
            return $mem_info;
        }
    }


    function display_memberfive()
    {
        $query = "SELECT * FROM `members` WHERE `block_number` = 5 ORDER BY `lot_number` ASC";

        if (mysqli_query($this->connection, $query)) {
            $mem_info = mysqli_query($this->connection, $query);
            return $mem_info;
        }
    }


    function display_membersix()
    {
        $query = "SELECT * FROM `members` WHERE `block_number` =  6 ORDER BY `lot_number` ASC";

        if (mysqli_query($this->connection, $query)) {
            $mem_info = mysqli_query($this->connection, $query);
            return $mem_info;
        }
    }


    function display_memberseven()
    {
        $query = "SELECT * FROM `members` WHERE `block_number` = 7 ORDER BY `lot_number` ASC";

        if (mysqli_query($this->connection, $query)) {
            $mem_info = mysqli_query($this->connection, $query);
            return $mem_info;
        }
    }


    function display_membereight()
    {
        $query = "SELECT * FROM `members` WHERE `block_number` = 8 ORDER BY `lot_number` ASC";

        if (mysqli_query($this->connection, $query)) {
            $mem_info = mysqli_query($this->connection, $query);
            return $mem_info;
        }
    }


    function display_membernine()
    {
        $query = "SELECT * FROM `members` WHERE `block_number` = 9 ORDER BY `lot_number` ASC";

        if (mysqli_query($this->connection, $query)) {
            $mem_info = mysqli_query($this->connection, $query);
            return $mem_info;
        }
    }


    function display_memberten()
    {
        $query = "SELECT * FROM `members` WHERE `block_number` = 10 ORDER BY `lot_number` ASC";

        if (mysqli_query($this->connection, $query)) {
            $mem_info = mysqli_query($this->connection, $query);
            return $mem_info;
        }
    }


    function display_memberout()
    {
        $query = "SELECT * FROM `members` WHERE `status` = 0 ORDER BY `lot_number` ASC";

        if (mysqli_query($this->connection, $query)) {
            $mem_info = mysqli_query($this->connection, $query);
            return $mem_info;
        }
    }



    function update_profile($data)
    {
        $mem_id = $data['mem_id'];

        $pdt_img_name2 = $_FILES['profile']['name'];
        $pdt_img_size = $_FILES['profile']['size'];
        $pdt_img_tmp2 = $_FILES['profile']['tmp_name'];
        $img_ext = pathinfo($pdt_img_name2, PATHINFO_EXTENSION);

        $query= "UPDATE `members` SET `user_image`='$pdt_img_name2' WHERE `id`='$mem_id'";
        if (mysqli_query($this->connection, $query)) {
            move_uploaded_file($pdt_img_tmp2, "user_img/".$pdt_img_name2);
        }
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    function update_mem_info($data){

        $fname = $data['firstname'];
        $mname = $data['midname'];
        $lname = $data['lastname'];
        $gender = $data['gender'];
        $contact = $data['contact'];
        $membership_plan = $data['membership_plan'];
        $blk = $data['blk'];
        $lot = $data['lot'];
        $username = $data['username'];
        $password = $data['password'];
   

        $mem_id = $data['mem_id'];

        $query = "UPDATE `members` SET
        `first_name`='$fname',
        `mid_name`='$mname',
        `last_name`='$lname',
        `gender`='$gender',
        `contact`='$contact',
        `block_number`='$blk',
        `lot_number`='$lot',
        `username`='$username',
        `password`='$password',
        `membership_plan` = '$membership_plan'
        WHERE `id`= $mem_id";
        
        if(mysqli_query($this->connection, $query)){
            $msg = "<div style='margin-left: 53%; width: 30%;' class='alert alert-success alert-dismissible fade show' role='alert'>
            <i class='bi bi-check-circle me-1'></i> Profile updated successfully.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
            return $msg;
        }
        }





    function mem_login($data)
    {
        $username = $data["username"];
        $password = $data['password'];

        $query = "SELECT * FROM `members` WHERE username = '$username' AND password = '$password'";

        if (mysqli_query($this->connection, $query)) {
            $result = mysqli_query($this->connection, $query);
            $mem_info = mysqli_fetch_assoc($result);
            if ($mem_info) {
                header("location:index.php");
                session_start();
                session_regenerate_id();
			    $name = $mem_info['first_name'] . ' ' . $mem_info['last_name'];

                $_SESSION['id'] = $mem_info['id'];
                $_SESSION['name'] = $name;
                $_SESSION['user_image'] = $mem_info['user_image'];
            } else {
                $log_msg = "You have entered a wrong username or password. Please try again.";
                return $log_msg;
            }
        }
    }

    function display_member_id($mem_id)
    {
        $query = "SELECT * FROM `members` WHERE `id`= $mem_id";
        if(mysqli_query($this->connection, $query)){
            $result = mysqli_query($this->connection, $query);
            return $result;
        }
    }

    function add_member($data)
    {

        $fname = ucwords($data['fname']);
        $mname = ucwords($data['mname']);
        $lname = ucwords($data['lname']);
        $contact = $data['contact'];
        $gender = $data['gender'];
        $blk = $data['blk'];
        $lot = $data['lot'];
        $residence_type = $data['residence_type'];
        $username = $data['username'];
        $password = $data['password'];
        $lot_type = !empty($data['lot_type']) ? $data['lot_type'] : "";
        $award_status = !empty($data['award_status']) ? $data['award_status'] : "";

        $membership_plan = $data['membership_plan'];



        

        $pdt_img_name1 = $_FILES['profile']['name'];
        $pdt_img_size = $_FILES['profile']['size'];
        $pdt_img_tmp1 = $_FILES['profile']['tmp_name'];
        $img_ext = pathinfo($pdt_img_name1, PATHINFO_EXTENSION);

        $query = "INSERT INTO `members`
        ( `block_number`,
        `lot_number`,
        `residence_type`,
        `first_name`,
        `mid_name`,
        `last_name`,
        `gender`,
        `contact`,
        `username`,
        `password`,
        `user_image`,
        `membership_plan`,
        `lot_type`,
        `award_type`)
        VALUES (
        '$blk',
        '$lot',
        '$residence_type',
        '$fname',
        '$mname',
        '$lname',
        '$gender',
        '$contact',
        '$username',
        '$password',
        '$pdt_img_name1',
        '$membership_plan',
        '$lot_type',
        '$award_status'
            )";

            if (mysqli_query($this->connection, $query)) {
                move_uploaded_file($pdt_img_tmp1, "user_img/".$pdt_img_name1);

                echo "<script>
                alert('Successfully Added Member')
                window.location.replace('masterlist.php');
                </script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($this->connection);
        }
    }

    function add_household($data){ 
        $blk = $data['blk']; 
        $lot = $data['lot'];
        $household_owner = intval($data['household_owner']);

        $query = "INSERT INTO `household` (`blk`, `lot`, `household_owner`) VALUES ($blk,$lot, $household_owner)";

        // update household id in members table 

       

        if(mysqli_query($this->connection, $query)){
            $query2 = "UPDATE members SET household_id = (SELECT id FROM household WHERE blk = $blk AND lot = $lot) WHERE id = $household_owner;";
                
            if(mysqli_query($this->connection, $query2)){
                $msg = "Household Added Successfully";
                return $msg;
            
            }
            else{
                $msg = "Failed to Add Household " . mysqli_error($this->connection);
                return $msg;
            }

            $msg = "Household Added Successfully";
            return $msg;
        }
        else{
            $msg = "Failed to Add Household " . mysqli_error($this->connection);
            return $msg;
        }



    }

    function add_household_member($data) {
        // Extracting data from the $data array
        $id = mysqli_real_escape_string($this->connection, $data['member_id']);


        $relationship_to_head = mysqli_real_escape_string($this->connection, $data['relationship_to_head']);
        $occupation = mysqli_real_escape_string($this->connection, $data['occupation']);
        $national_id = mysqli_real_escape_string($this->connection, $data['national_id']);
        $social_security_number = mysqli_real_escape_string($this->connection, $data['social_security_number']);
        $passport_number = mysqli_real_escape_string($this->connection, $data['passport_number']);
        $other_id_description = mysqli_real_escape_string($this->connection, $data['other_id_description']);
        $other_id_number = mysqli_real_escape_string($this->connection, $data['other_id_number']);
        $social_welfare_programs = mysqli_real_escape_string($this->connection, $data['social_welfare_programs']);
        $household_id = mysqli_real_escape_string($this->connection, $data['household_id']);
        // Constructing the SQL query

        $is_senior = isset($data['is_senior']) ? 1 : 0;
        $is_political_family = isset($data['is_political_family']) ? 1 : 0;
        $is_pwd = isset($data['is_pwd']) ? 1 : 0;
        $is_ethnic = isset($data['is_ethnic']) ? 1 : 0;

        // Now, sanitize these values before using them in a database query
        $is_political_family = mysqli_real_escape_string($this->connection, $is_political_family);
        $is_pwd = mysqli_real_escape_string($this->connection, $is_pwd);
        $is_ethnic = mysqli_real_escape_string($this->connection, $is_ethnic);
        $is_military = isset($data['is_military']) ? 1 : 0;
        $is_ayuda = isset($data['is_ayuda']) ? 1 : 0;
        $is_4ps = isset($data['is_4ps']) ? 1 : 0;
        $is_sss = isset($data['is_sss']) ? 1 : 0;
        $is_gsis = isset($data['is_gsis']) ? 1 : 0;
        $is_sap = isset($data['is_sap']) ? 1 : 0;
        $is_sap_qc = isset($data['is_sap_qc']) ? 1 : 0;
        // check if member already exists in household

        $query = "SELECT * FROM household_members WHERE member_id = $id AND household_id = $household_id";

        if(mysqli_query($this->connection, $query)){
            $result = mysqli_query($this->connection, $query);
            if(mysqli_num_rows($result) > 0){
                $msg = "Member already exists in household";
                return $msg;
            }
        }


        $query2 = "INSERT INTO household_members (
                    household_id, member_id, 
                    relationship_to_head, occupation, national_id, social_security_number, 
                    passport_number, other_id_description, other_id_number, social_welfare_programs, is_ethnic, is_pwd, is_political_family, is_military, is_ayuda, is_4ps, is_sss, is_gsis, is_sap, is_sap_qc, is_senior
                ) VALUES (
                    '$household_id', '$id', 
                    '$relationship_to_head', '$occupation', '$national_id', '$social_security_number', 
                    '$passport_number', '$other_id_description', '$other_id_number', '$social_welfare_programs', '$is_ethnic', '$is_pwd', '$is_political_family', '$is_military', '$is_ayuda', '$is_4ps', '$is_sss', '$is_gsis', '$is_sap', '$is_sap_qc', '$is_senior'
                )";
    
        // Executing the query
        if (mysqli_query($this->connection, $query2)) {
            header("location:household_masterlist.php");
            exit;
        } else {
            $msg = "Failed to add household member: " . mysqli_error($this->connection);
        }
    
        return $msg;
    }

    function display_households(){
        $query = "SELECT * FROM `household`";
        if(mysqli_query($this->connection, $query)){
            $result = mysqli_query($this->connection, $query);
            return $result;
        }
    }

    //Project

    function display_projectrecent()
    {
        $query = "SELECT * FROM `projects` WHERE status = 0 OR status = 1 OR status = 2 ORDER BY `date_added` DESC LIMIT 3";

        if (mysqli_query($this->connection, $query)) {
            $mem_info = mysqli_query($this->connection, $query);
            return $mem_info;
        }
    }


    function display_project()
    {
        $query = "SELECT * FROM `projects` WHERE status = 0 OR status = 1 OR status = 2 ORDER BY `deadline` DESC";

        if (mysqli_query($this->connection, $query)) {
            $mem_info = mysqli_query($this->connection, $query);
            return $mem_info;
        }
    }


    function display_projectadmin()
    {
        $query = "SELECT * FROM `projects`  WHERE status = 0 OR status = 1 ORDER BY `deadline`";

        if (mysqli_query($this->connection, $query)) {
            $mem_info = mysqli_query($this->connection, $query);
            return $mem_info;
        }
    }

    function display_projetcbyid($id)
    {
        $query = "SELECT * FROM `projects` WHERE id = $id";

        if (mysqli_query($this->connection, $query)) {
            $rsrv_info = mysqli_query($this->connection, $query);
            return mysqli_fetch_assoc($rsrv_info);
        }
    }

    function display_task()
    {
        $query = "SELECT * FROM `task_list`";

        if (mysqli_query($this->connection, $query)) {
            $tsk_info = mysqli_query($this->connection, $query);
            return $tsk_info;
        }
    }


    function display_taskmember($id)
    {
        $query = "SELECT * FROM `task_list` WHERE  project_id= $id";

        if (mysqli_query($this->connection, $query)) {
            $tsk_info = mysqli_query($this->connection, $query);
            return $tsk_info;
        }
    }

    function delete_project($id)
    {

        $query = "DELETE FROM `projects` WHERE  id= $id";
        if (mysqli_query($this->connection, $query)) {
        echo "<script>
        alert('Successfully Removed Project')
        var delay = 1000;
		setTimeout(function(){ window.location = 'manage_project.php'  }, delay);
        </script>";
        }
    }

    function update_project($data)
    {
        $title = $data['title'];
        $des = $data['des'];
        $start_date = $data['start_date'];
        $end_date = $data['end_date'];
        $project_status = $data['project_status'];
        $u_id = $data['u_id'];


        $query = "UPDATE `projects` SET
        `project`='$title',
        `description`='$des',
        `start_date`='$start_date',
        `deadline`='$end_date',
        `status`='$project_status'
        
        WHERE id= $u_id";
        if (mysqli_query($this->connection, $query)) {
            echo "<script>
            alert('Successfully Updated Project')
            var delay = 1000;
            setTimeout(function(){ window.location = 'manage_project.php'  }, delay);
            </script>";

    }
    }

    function display_project_fin(){
        $query= "SELECT * FROM projects WHERE status = 0 OR status = 1 OR status = 2 order by deadline desc";

        if (mysqli_query($this->connection, $query)) {
            $tsk_info = mysqli_query($this->connection, $query);
            return $tsk_info;
        }
    }

    function add_project($data)
    {

        $title = ucwords($data['title']);
        $des = ucwords($data['des']);
        $loc = ucwords($data['location']);
        $cost = $data['cost'];
        $start = $data['start'];
        $end = $data['end'];

        $pdt_img_name1 = $_FILES['profile']['name'];
        $pdt_img_size = $_FILES['profile']['size'];
        $pdt_img_tmp1 = $_FILES['profile']['tmp_name'];
        $img_ext = pathinfo($pdt_img_name1, PATHINFO_EXTENSION);

        $pdt_img_name2 = $_FILES['profile1']['name'];
        $pdt_img_size = $_FILES['profile1']['size'];
        $pdt_img_tmp2 = $_FILES['profile1']['tmp_name'];
        $img_ext = pathinfo($pdt_img_name2, PATHINFO_EXTENSION);

        $pdt_img_name3 = $_FILES['profile2']['name'];
        $pdt_img_size = $_FILES['profile2']['size'];
        $pdt_img_tmp3 = $_FILES['profile2']['tmp_name'];
        $img_ext = pathinfo($pdt_img_name3, PATHINFO_EXTENSION);

        $query = "INSERT INTO `projects`
        (`project`,
        `description`,
        `location`,
        `overall_cost`,
        `start_date`,
        `deadline`,
        `site_pic`,
        `site_pic1`,
        `site_pic2`,
        `date_added`,
        `status`)
        VALUES (
        '$title',
        '$des',
        '$loc',
        '$cost',
        '$start',
        '$end',
        '$pdt_img_name1',
        '$pdt_img_name2',
        '$pdt_img_name3',
        NOW(),
        '0'
            )";
            if (mysqli_query($this->connection, $query)) {
                move_uploaded_file($pdt_img_tmp1, "project_img/".$pdt_img_name1);
                move_uploaded_file($pdt_img_tmp2, "project_img/".$pdt_img_name2);
                move_uploaded_file($pdt_img_tmp3, "project_img/".$pdt_img_name3);

                echo "<script>
                alert('Successfully Added Project')
                window.location.replace('manage_project.php');
                </script>";
        } else {
        }
    }

    function add_task($data){


        $prj_id = $data['proj_id'];
        $task = $data['task'];
        $staff = $data['staff'];
        $des = $data['des'];
        $end = $data['end'];
        $start_date = $data['start_date'];
        $estimated_cost = $data['estimated_cost'];
        $actual_cost = $data['actual_cost'];


        // Verify if the actual_cost is greater than the remaining_budget 

        $sql = "SELECT overall_cost FROM projects WHERE id = $prj_id";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $overall_cost = $row['overall_cost'];

        $sql = "SELECT SUM(actual_cost) as total_cost FROM task_list WHERE project_id = $prj_id";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $total_cost = $row['total_cost'];


        if ($total_cost + $actual_cost > $overall_cost) {
            $msg = "<div style='margin-left: 62%; width: 30%;' class='alert alert-danger alert-dismissible fade show' role='alert'>
            <i class='bi bi-exclamation-triangle me-1'></i> Actual cost exceeds the overall cost / remaining budget of the project.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
            return $msg;
        }
        

        $query = "INSERT INTO `task_list`
        (`project_id`,
        `task`,
        `staff`,
        `description`,
        `status`,
        `deadline`,
        `date_created`,
        `start_date`,
        `estimated_cost`,
        `actual_cost`)
        VALUES 
        ($prj_id,
        '$task',
        '$staff',
        '$des',
        '1',
        '$end',
        NOW(),
        '$start_date',
        '$estimated_cost',
        '$actual_cost')";
        
        if(mysqli_query($this->connection, $query)){
            $msg = "<div style='margin-left: 62%; width: 30%;' class='alert alert-success alert-dismissible fade show' role='alert'>
            <i class='bi bi-check-circle me-1'></i> Task successfully added.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
            return $msg;

        }
    }


    function delete_task($id)
    {

        $query = "DELETE FROM `task_list` WHERE  id = $id";
        if (mysqli_query($this->connection, $query)) {
            if (isset($_SERVER["HTTP_REFERER"])) {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }

    }
    }

    function display_taskbyid($id)
    {
        $query = "SELECT * FROM `task_list` WHERE id = $id";

        if (mysqli_query($this->connection, $query)) {
            $tsk_info = mysqli_query($this->connection, $query);
            return mysqli_fetch_assoc($tsk_info);
        }
    }

    function update_task($data)
    {
        $u_task = $data['task'];
        $u_des = $data['des'];
        $u_dead = $data['end'];
        $u_status = $data['task_status'];
        $start_date = $data['start_date'];
        $estimated_cost = $data['estimated_cost'];
        $actual_cost = $data['actual_cost'];

        $tsk = $data['tsk_id'];

        

        $query = "UPDATE `task_list` SET 
        `task`='$u_task',
        `description`='$u_des',
        `status`='$u_status',
        `deadline`='$u_dead',
        `start_date`='$start_date',
        `estimated_cost`='$estimated_cost',
        `actual_cost`='$actual_cost'
        WHERE id= $tsk";
        if (mysqli_query($this->connection, $query)) {



            $msg = "<div style='margin-left: 62%; width: 30%;' class='alert alert-success alert-dismissible fade show' role='alert'>
            <i class='bi bi-check-circle me-1'></i> Task successfully edited.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";



            return $msg;
            
    }
    }

    //Reports & Requests

    function display_report()
    {
        $query = "SELECT * FROM `report` WHERE `status` = '0' OR `status` = '1' OR `status` = '3'";

        if (mysqli_query($this->connection, $query)) {
            $rpt_info = mysqli_query($this->connection, $query);
            return $rpt_info;
        }
    }

    function display_user_report($id)
    {
        $query = "SELECT * FROM `report` WHERE `status` = '0' AND `user_id` = $id OR `status` = '1' AND `user_id` = $id OR `status` = '3' AND `user_id` = $id";

        if (mysqli_query($this->connection, $query)) {
            $rpt_info = mysqli_query($this->connection, $query);
            return $rpt_info;
        }
    }



    function display_report_res()
    {
        $query = "SELECT * FROM `report` WHERE `status` = '2'";

        if (mysqli_query($this->connection, $query)) {
            $rpt_info = mysqli_query($this->connection, $query);
            return $rpt_info;
        }
    }

    function display_rep_id($id)
    {
        $query = "SELECT * FROM `report` WHERE `rep_id` = '$id'";

        if (mysqli_query($this->connection, $query)) {
            $rep_info = mysqli_query($this->connection, $query);
            return mysqli_fetch_assoc($rep_info);
        }
    }

    function display_reply_id($id)
    {
        $query = "SELECT * FROM `reply` WHERE `report_id` = '$id'";

        if(mysqli_query($this->connection, $query)){
            $result = mysqli_query($this->connection, $query);
            return $result;
        }
    }

    function reply($data){

        $report_id = $data['report_id'];
        $admin = $data['admin'];
        $reply = $data['des'];

        $query = "INSERT INTO `reply`
        (`report_id`,
        `reply`,
        `user`,
        `date`)
        VALUES
        ('$report_id',
        '$reply',
        '$admin',
        NOW())";

        if(mysqli_query($this->connection, $query)){
            $msg = "<div style='margin-left: 62%; width: 30%;' class='alert alert-success alert-dismissible fade show' role='alert'>
            <i class='bi bi-check-circle me-1'></i> Reply successfully sent.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
            return $msg;

        }
    }

    function reply_user($data){

        $report_id = $data['report_id'];
        $user = $data['user'];
        $u_id = $data['u_id'];
        $reply = $data['des'];

        $pdt_img_name1 = $_FILES['proof']['name'];
        $pdt_img_size = $_FILES['proof']['size'];
        $pdt_img_tmp1 = $_FILES['proof']['tmp_name'];
        $img_ext = pathinfo($pdt_img_name1, PATHINFO_EXTENSION);

        $query = "INSERT INTO `reply`
        (`report_id`,
        `reply`,
        `img`,
        `user`,
        `user_id`,
        `date`)
        VALUES
        ('$report_id',
        '$reply',
        '$pdt_img_name1',
        '$user',
        '$u_id',
        NOW())";

        if(mysqli_query($this->connection, $query)){

            move_uploaded_file($pdt_img_tmp1, "admin/report_img/".$pdt_img_name1);
            
            $msg = "<div style='margin-left: 62%; width: 30%;' class='alert alert-success alert-dismissible fade show' role='alert'>
            <i class='bi bi-check-circle me-1'></i> Reply successfully sent.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
            return $msg;

        }
    }

    function update_rep_stat($data)
    {
        $stat = $data['stat'];
        $id = $data['id'];

        $query = "UPDATE `report` SET `status`= $stat WHERE id = $id";
        if (mysqli_query($this->connection, $query)) {
            if (isset($_SERVER["HTTP_REFERER"])) {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }

    }
    }

    function update_rep_stat_id($data)
    {
        $stat = $data['stat'];
        $id = $data['report_id'];

        $query = "UPDATE `report` SET `status`= $stat WHERE `rep_id` = '$id'";
        if (mysqli_query($this->connection, $query)) {
            if (isset($_SERVER["HTTP_REFERER"])) {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }

    }

    }

    function add_report($data)
    {

        $u_id = $data['user_id'];
        $name = ucwords($data['name']);
        $type = $data['type'];
        $subj = $data['subject'];
        $mess = $data['message'];
        $rep_id = $data['rep_id'];



        $pdt_img_name1 = $_FILES['proof']['name'];
        $pdt_img_size = $_FILES['proof']['size'];
        $pdt_img_tmp1 = $_FILES['proof']['tmp_name'];
        $img_ext = pathinfo($pdt_img_name1, PATHINFO_EXTENSION);

        $query = "INSERT INTO `report`
        (`rep_id`,
        `title`,
        `user_id`,
        `user`,
        `type`,
        `description`,
        `report_img`,
        `date_added`)
        VALUES (
        '$rep_id',
        '$subj',
        '$u_id',
        '$name',
        '$type',
        '$mess',
        '$pdt_img_name1',
        NOW()
            )";
            if (mysqli_query($this->connection, $query)) {
                move_uploaded_file($pdt_img_tmp1, "admin/report_img/".$pdt_img_name1);

                $msg = "<div style='margin-left: 62%; width: 30%;' class='alert alert-success alert-dismissible fade show' role='alert'>
                <i class='bi bi-check-circle me-1'></i> Report sent successfully sent. Our administrators will review the report
                and will get back to you as soon as possible. You can view the status of the report on your profile.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>

              <script>
              var delay = 9000;
              setTimeout(function(){ window.location = 'report.php'  }, delay);
              </script>"
            ;
                return $msg;
        } else {
        }
    }



    //RESERVATION

    function add_reservation($data)
    {


        $user_id = $data['id'];
        $u_name = ucwords($data['name']);
        $u_num = $data['contact'];
        $date = $data['date'];
        $start = $data['start'];
        $end = $data['end'];
        $u_type = $data['type'];
        $facility = $data['facility'];
        $purpose = $data['message'];
        $title= $data['facility'] . " " . date("h:ia",strtotime($data['start'])) . " - " . date("h:ia",strtotime($data['end']));



        $select="SELECT * from `reserve` WHERE `start` = '$date' AND `facility` = '$facility' ";
        $check=mysqli_query($this->connection, $select);

        if(mysqli_num_rows($check) >0)
         {
            $msg = "<div style='margin-left: 62%; width: 30%;' class='alert alert-danger alert-dismissible fade show' role='alert'>
            <i class='bi bi-check-circle me-1'></i> The facility is already reserved. Please pick another day.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
            return $msg;
        }
        else{



        $query = "INSERT INTO `reserve`
        (`user_id`,
         `u_name`,
         `u_num`,
         `start`,
         `t_start`,
         `t_end`,
         `title`,
         `u_type`,
         `facility`,
         `purpose`,
         `date_res`)

        VALUES ('$user_id',
        '$u_name',
        '$u_num',
        '$date',
        '$start',
        '$end',
        '$title',
        '$u_type',
        '$facility',
        '$purpose',
        NOW())";



        if(mysqli_query($this->connection, $query)){
            $msg = "<div style='margin-left: 62%; width: 30%;' class='alert alert-success alert-dismissible fade show' role='alert'>
            <i class='bi bi-check-circle me-1'></i> Reservation Request Added Succesfuly.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>
          <script>
            var delay = 1000;
            setTimeout(function(){ }, delay);
            </script>"
          ;
            return $msg;

            }
        }
    }


    function add_adminreservation($data)
    {


        $user_id = $data['id'];
        $u_name = ucwords($data['name']);
        $u_num = $data['contact'];
        $date = $data['date'];
        $start = $data['start'];
        $end = $data['end'];
        $u_type = $data['type'];
        $facility = $data['facility'];
        $purpose = $data['message'];
        $title= $data['facility'] . " " . date("h:ia",strtotime($data['start'])) . " - " . date("h:ia",strtotime($data['end']));


        $select="SELECT * from `reserve` WHERE `start` = '$date' AND `facility` = '$facility' ";
        $check=mysqli_query($this->connection, $select);

        if(mysqli_num_rows($check) >0)
         {
            $msg = "<div style='margin-left: 62%; width: 30%;' class='alert alert-danger alert-dismissible fade show' role='alert'>
            <i class='bi bi-check-circle me-1'></i> The facility is already reserved. Please pick another day.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
            return $msg;
        }
        else{



        $query = "INSERT INTO `reserve`
        (`user_id`,
         `u_name`,
         `u_num`,
         `start`,
         `t_start`,
         `t_end`,
         `title`,
         `u_type`,
         `facility`,
         `purpose`,
         `date_res`)

        VALUES ('$user_id',
        '$u_name',
        '$u_num',
        '$date',
        '$start',
        '$end',
        '$title',
        '$u_type',
        '$facility',
        '$purpose',
        NOW())";



        if(mysqli_query($this->connection, $query)){
            $msg = "<div style='margin-left: 62%; width: 30%;' class='alert alert-success alert-dismissible fade show' role='alert'>
            <i class='bi bi-check-circle me-1'></i> Reservation Added Succesfuly.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>
          <script>
            var delay = 1000;
            setTimeout(function(){ window.location = 'manage_fac.php'  }, delay);
            </script>"
          ;
            return $msg;

            }
        }
    }

    function display_reserve()
    {
        $query = "SELECT * FROM `reserve` WHERE `status`= 1 ORDER BY `date_res` ASC";

        if (mysqli_query($this->connection, $query)) {
            $res_info = mysqli_query($this->connection, $query);
            return $res_info;
        }
    }


    function display_appreserve()
    {
        $query = "SELECT * FROM `reserve` WHERE `status`=2 ORDER BY `date_res` ASC";

        if (mysqli_query($this->connection, $query)) {
            $res_info = mysqli_query($this->connection, $query);
            return $res_info;
        }
    }


    function display_disreserve()
    {
        $query = "SELECT * FROM `reserve` WHERE `status`=3 ORDER BY `date_res` ASC";

        if (mysqli_query($this->connection, $query)) {
            $res_info = mysqli_query($this->connection, $query);
            return $res_info;
        }
    }



    function reserve_approve($id)
    {
        $query = "UPDATE `reserve` SET `status`= 2 WHERE id = $id";
        mysqli_query($this->connection, $query);
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    function reserve_disapprove($id)
    {
        $query = "UPDATE `reserve` SET `status`= 3 WHERE id = $id";
        mysqli_query($this->connection, $query);
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    function delete_res($id)
    {

        $query = "DELETE FROM `reserve` WHERE  id= $id";
        if (mysqli_query($this->connection, $query)) {
        echo "<script>
        alert('Successfully Removed Reservation')
        var delay = 1000;
		setTimeout(function(){ window.location = 'manage_fac.php'  }, delay);
        </script>";
        }
    }

    function delete_res1($id)
    {

        $query = "DELETE FROM `reserve` WHERE  id= $id";
        if (mysqli_query($this->connection, $query)) {
        echo "<script>
        alert('Successfully Removed Reservation')
        var delay = 1000;
		setTimeout(function(){ window.location = 'app_res.php'  }, delay);
        </script>";
        }
    }

    function delete_res2($id)
    {

        $query = "DELETE FROM `reserve` WHERE  id= $id";
        if (mysqli_query($this->connection, $query)) {
        echo "<script>
        alert('Successfully Removed Reservation')
        var delay = 1000;
		setTimeout(function(){ window.location = 'dis_res.php'  }, delay);
        </script>";
        }
    }

    function update_date($data)
    {
        $date = $data['date'];
        $id = $data['id'];



        $query = "UPDATE `reserve` SET `start`= '$date' WHERE id = $id";
        if (mysqli_query($this->connection, $query)) {
            if (isset($_SERVER["HTTP_REFERER"])) {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }

    }

    }

    function update_time($data)
    {
        $start = $data['start'];
        $end = $data['end'];
        $id = $data['id'];

        $title= $data['facility'] . " " . date("h:ia",strtotime($data['start'])) . " - " . date("h:ia",strtotime($data['end']));

        $query = "UPDATE `reserve` SET
        `t_start`= '$start',
        `t_end`='$end',
        `title`= '$title'
         WHERE id = $id";
        if (mysqli_query($this->connection, $query)) {
            if (isset($_SERVER["HTTP_REFERER"])) {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }

    }

    }

    //FINANCE MEMBERSHIP FEE

    function display_fin_id($id)
    {
        $query = "SELECT * FROM `finances` WHERE `user_id`=$id  ORDER BY `status` ASC, `date` DESC";

        if(mysqli_query($this->connection, $query)){
            $result = mysqli_query($this->connection, $query);
            return $result;
        }
    }

    function update_finance($data)
    {
        $stat = $data['stat'];
        $amount = $data['amount'];
        $id = $data['id'];
        $paid=1;
        $part=2;
        $futureDate=date('Y-m-d', strtotime('+1 year'));
        $type="Membership Fee";
        $u_id = $data['user_id'];


        $query = "UPDATE `finances` SET `date` = NOW() WHERE `id` = $id";
        $query2 = "UPDATE `finances` SET `status` =  $stat WHERE `id` = $id";
        $query3 = "UPDATE `finances` SET `deadline` =  '$futureDate'  WHERE `id` = $id";

        $log="INSERT INTO `payment_log`
        (`type`,
        `amount`,
        `date_paid`,
        `user_id`,
        `status`)
        VALUES (
            '$type',
            '$amount',NOW(),'$u_id', 'Paid')";

        if($stat == $paid){

            if (mysqli_query($this->connection, $query)) {
                if (mysqli_query($this->connection, $query2)) {
                        if (mysqli_query($this->connection, $query3)) {
                            if (mysqli_query($this->connection, $log)) {
                            if (isset($_SERVER["HTTP_REFERER"])) {
                                header("Location: " . $_SERVER["HTTP_REFERER"]);
                                }
                            }
                        }
                    }
                }
        }

    elseif($stat == $part){
        if (mysqli_query($this->connection, $query)) {
            if (mysqli_query($this->connection, $query2)) {
                if (mysqli_query($this->connection, $log)) {
                    if (isset($_SERVER["HTTP_REFERER"])) {
                        header("Location: " . $_SERVER["HTTP_REFERER"]);
                        }
                    }
                }
            }
    }
    else{
        if (mysqli_query($this->connection, $query2)) {
            if (isset($_SERVER["HTTP_REFERER"])) {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }
        }
    }
}

    //FINANCE PROJECT

    function display_prjc_id($id)

    {
        $query = "SELECT proj_con.*, projects.project FROM `proj_con` LEFT JOIN projects ON proj_con.proj_id = projects.id WHERE `user_id`=$id";

        if(mysqli_query($this->connection, $query)){
            $result = mysqli_query($this->connection, $query);
            return $result;
        }
    }

    function add_contribution($data){

        $project = $data['project'];
        $amount = $data['amount'];
        $date = $data['date'];
        $user_id = $data['user_id'];


        $query = "INSERT INTO `proj_con`
        (`proj_id`,
        `amount`,
        `balance`,
        `user_id`,
        `deadline`)

        VALUES
        ($project,
        '$amount',
        '$amount',
        '$user_id',
        '$date')";

        if(mysqli_query($this->connection, $query)){
            $msg = "<div style='margin-left: 62%; width: 30%;' class='alert alert-success alert-dismissible fade show' role='alert'>
            <i class='bi bi-check-circle me-1'></i> Successfuly Added.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";

          if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
            return $msg;
        }
    }

    function update_prjc($data)
    {
        $stat = $data['stat'];
        $amount = $data['amount'];
        $id = $data['id'];
        $paid=1;
        $part=2;
        $type="Project Contribution";
        $prj_name=$data['proj_name'];
        $u_id = $data['user_id'];


        $query = "UPDATE `proj_con` SET `balance` = `balance` - $amount WHERE `id` = $id";
        $query2 = "UPDATE `proj_con` SET `status` =  $stat WHERE `id` = $id";
        $query3 = "UPDATE `proj_con` SET `date_paid` =  NOW()  WHERE `id` = $id";

        $log="INSERT INTO `payment_log`
        (`type`,
        `project_name`,
        `amount`,
        `date_paid`,
        `user_id`)
        VALUES (
        '$type',
        '$prj_name',
        '$amount',
        NOW(),
        '$u_id')";

        if($stat == $paid){

            if (mysqli_query($this->connection, $query)) {
                if (mysqli_query($this->connection, $query2)) {
                        if (mysqli_query($this->connection, $query3)) {
                            if (mysqli_query($this->connection, $log)) {
                            if (isset($_SERVER["HTTP_REFERER"])) {
                                header("Location: " . $_SERVER["HTTP_REFERER"]);
                            }
                        }
                    }
                    }
                }
        }
    elseif($stat == $part){
        if (mysqli_query($this->connection, $query)) {
            if (mysqli_query($this->connection, $query2)) {
                if (mysqli_query($this->connection, $log)) {
                    if (isset($_SERVER["HTTP_REFERER"])) {
                        header("Location: " . $_SERVER["HTTP_REFERER"]);
                    }
                }
                }
            }
    }
    else{
        if (mysqli_query($this->connection, $query2)) {
            if (isset($_SERVER["HTTP_REFERER"])) {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }
        }
    }
}

function display_project_con($id)

{

    $type="Project Contribution";
    $query = "SELECT * FROM `payment_log` WHERE `type`='$type' AND `user_id`=$id";

    if(mysqli_query($this->connection, $query)){
        $result = mysqli_query($this->connection, $query);
        return $result;
    }
}

function display_mem_con($id)

{

    $type="Membership Fee";
    $query = "SELECT * FROM `payment_log` WHERE `type`='$type' AND `user_id`=$id";

    if(mysqli_query($this->connection, $query)){
        $result = mysqli_query($this->connection, $query);
        return $result;
    }
}


function add_mem_fee($data){


    $amount = $data['membershipFeeAmount'];
    $amount = floatval($amount);
    $user_id = $data['mem_id'];


    $member = "SELECT membership_plan FROM members WHERE id = $user_id";

    $result = mysqli_query($this->connection, $member);
    $row = mysqli_fetch_assoc($result);
    $plan = $row['membership_plan'];

    if ($plan == "Montly") {
        $amount *= 1;
    } elseif ($plan == "Quarterly") {
        $amount *= 4;
    } elseif ($plan == "Semi-Annually") {
        $amount *= 6;
    } elseif ($plan == "Annually") {
        $amount *= 12;
    }


    $query = "INSERT INTO `finances`
    (`user_id`,
    `amount`,
    `date`,
    `deadline`)

    VALUES
    ($user_id,
    $amount,
    NOW(),
    NOW())";

    if(mysqli_query($this->connection, $query)){
        $msg = "<div style='margin-left: 62%; width: 30%;' class='alert alert-success alert-dismissible fade show' role='alert'>
        <i class='bi bi-check-circle me-1'></i> Successfuly Added.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";

      if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
        return $msg;
    }
    else{
        echo "Error: " . $query . "<br>" . mysqli_error($this->connection);
    
    }
}

function display_mem_fee()

{

    $type="Membership Fee";
    $query = "SELECT payment_log.*, members.first_name, members.last_name,members.id FROM `payment_log` JOIN members ON payment_log.user_id = members.id AND payment_log.status = 'Paid'
    WHERE payment_log.type='$type' ORDER BY `date_paid` DESC";

    if(mysqli_query($this->connection, $query)){
        $result = mysqli_query($this->connection, $query);
        return $result;
    }
}

function display_prj_fee()

{

    $type="Project Contribution";
    $query = "SELECT payment_log.*, members.first_name, members.last_name,members.id FROM `payment_log` LEFT JOIN members ON payment_log.user_id = members.id
    WHERE payment_log.type='$type' ORDER BY `date_paid` DESC";

    if(mysqli_query($this->connection, $query)){
        $result = mysqli_query($this->connection, $query);
        return $result;
    }
}

function display_prjpgrs_con($id)

{

    $query = "SELECT proj_con.*, members.first_name, members.last_name, members.id, projects.project,projects.id  FROM `proj_con`
    LEFT JOIN members ON proj_con.user_id = members.id
    LEFT JOIN projects ON proj_con.proj_id = projects.id
    WHERE projects.id=$id
    ORDER BY `date_paid` DESC";

    if(mysqli_query($this->connection, $query)){
        $result = mysqli_query($this->connection, $query);
        return $result;
    }
}


function deletecon($id)
{

    $query = "DELETE FROM `proj_con` WHERE  id= $id";
    if (mysqli_query($this->connection, $query)) {
    echo "<script>
    alert('Successfully Removed From Project Contribution')
    var delay = 1000;
    </script>";

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
    }
}





    //MEMBER FINACNE


    function display_fin_memid($id)
    {
        $query = "SELECT * FROM `finances` WHERE `user_id`=$id AND status = 0 ORDER BY `date`  DESC";
        if(mysqli_query($this->connection, $query)){
            $result = mysqli_query($this->connection, $query);
            return $result;
        }
    }




}

