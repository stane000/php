
<?php 
if ($_POST['_action_'] == FALSE) {
	print '
	<div class="container rounded bg-white mt-5 mb-5" style="background-color: blue">
        <form action="" id="add_card" name="add_card" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="_action_" name="_action_" value="TRUE">
                <div class="row" style=" border: 2px solid blue;">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <img class="rounded-circle mt-6" src="img/edit.jpg">
                            <span class="font-weight-bold">Amelly</span><span class="text-black-50">amelly12@bbb.com</span><span> </span>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                        </div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile Information</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12"><label class="labels">Full Name</label><input type="text" id="fullname" name="fullname" class="form-control" placeholder="Full Name" value=""></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Email</label><input type="email" id="email" name="email" class="form-control" placeholder="enter phone email" value=""></div>
                                <div class="col-md-12"><label class="labels">UserName</label><input type="text" pattern=".{5,10}" class="form-control" id="username" name="username" placeholder="enter UserName" value=""></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Country</label>
                                    <select name="country" id="country">
                                        <option value="">molimo odaberite</option>';
                                        #Select all countries from database webprog, table countries
                                        $query  = "SELECT * FROM countries";
                                        $result = @mysqli_query($MySQL, $query);
                                        while($row = @mysqli_fetch_array($result)) {
                                            print '<option value="' . $row['country_code'] . '">' . $row['country_name'] . '</option>';
                                        }
                                        print '
                                        </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                            <div class="col-md-7">
                            <input class="btn btn-secondary" type="submit" value="Submit" style="width: 300px; margin-left: 20px">
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
</div>
</div>
            <br>
            <br>
    <script>
    function goBack() {
    window.history.back();
    }
    </script>';
}

    // Check if image file is a actual image or fake image
else  if($_POST['_action_'] == TRUE) {
        $uploadOk = 0;
        if($_FILES["fileToUpload"]["name"]){
            $target_dir = "cards/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

            if($check !== false) {
                $uploadOk = 1;
            } 
        }
        if($uploadOk == 1){
            $string_file = " picture = '" .$target_file. "' ";
            $_SESSION['user']['picture'] = $target_file;  
        }
        else{
            $string_file = " picture = '" .$_SESSION['user']['picture']. "' ";
        }
        
        if($_POST["fullname"]){
            $firstname = explode(" ",$_POST["fullname"])[0];
            $lastname = explode(" ",$_POST["fullname"])[1];
            $_SESSION['user']['firstname'] =  $firstname;
            $_SESSION['user']['lastname'] = $lastname;
            $string_name = " firstname = '" . $firstname. "', lastname = '" .$lastname. "' ";
        }
        else{
            $string_name =  " firstname = '" . $_SESSION['user']['firstname']. "', lastname = '" .$_SESSION['user']['lastname']. "' ";
        }
        if($_POST["username"]){
            $string_username = " username = '" .$_POST['username'] ."' ";
            $_SESSION['user']['username'] = $_POST['username'];
        }
        else{
            $string_username = " username = '" .$_SESSION['user']['username']."' ";
        }

        if($_POST["email"]){
            $string_email = " email = '" .$_POST['email'] ."' ";
            $_SESSION['user']['email'] = $_POST['email'];
        }
        else{
            $string_email = " email = '" .$_SESSION['user']['email']."' ";
        }

        $query  = "update users";
        $query .= " set " .$string_username. ", " .$string_name. ", " .$string_email.  " , " .$string_file. " where  id  = " .$_SESSION['user']['id'];
        $result = @mysqli_query($MySQL, $query);
        print'<h1>You update your profile</h1>
        <a style="text: bold" href="index.php?menu=9">Go to profile</a>';
    }
print '
</div>';
    ?>