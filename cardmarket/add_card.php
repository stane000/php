
<?php
if ($_POST['_action_'] == FALSE) {
	print '
	<div id="add_card" >
        <div class="container" style="padding: 1em;">
            <div class="row" style="border: 2px solid black; padding: 3em; margin-left: 20px; margin-right: 20px;">
                    <form action="" id="add_card" name="add_card" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="_action_" name="_action_" value="TRUE">
                        <label for="fname">Card Name</label>
                        <input type="text" id="fname" name="fname" placeholder="Card name.." required>

                        <div class="row">                
                            <div class="col">
                                <label for="type" class="form-label">Card Type</label>
                                <select class="form-select" id="type" name="type" aria-label="Default select example">
                                    <option value="1">Monster</option>
                                    <option value="2">Spell</option>
                                    <option value="3">Trap</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="Language" class="form-label">Language</label>
                                <select class="form-select" id="language" name="language" aria-label="Default select example">
                                    <option value="1">Eng</option>
                                    <option value="2">Ger</option>
                                    <option value="3">Span</option>
                                    <option value="4">Fran</option>
                                    <option value="5">Ita</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="Rarity" class="form-label">Rarity</label>
                                <select class="form-select" id="rarity" name="rarity" aria-label="Default select example">
                                    <option value="1">Rare</option>
                                    <option value="2">SuperRare</option>
                                    <option value="3">GhostRare</option>
                                    <option value="4">Common</option>
                                    <option value="5">Mint</option>
                                </select>
                            </div>
                            <div class="row"> 
                                <div class="col-8">  
                                    <label for="fname">Card Name</label>
                                    <input type="number" id="price" name="price" placeholder="Card Price.." required> $
                                </div>
                            </div>

                            <div class="row" style="margin-top: 50px"> 
                                <input type="file" name="fileToUpload" id="fileToUpload">
                            </div>

        
                        <div class="row" style="margin-top: 50px">
                            <div class="col-10">
                                <input class="btn btn-secondary" type="submit" value="Submit" style="width: 300px; margin-left: 20px">
                            </div>
                            <div class="col-2">
                                <button class="btn btn-light" onclick="goBack()">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <br>
        </div>
    <script>
    function goBack() {
    window.history.back();
    }
    </script>';

}
    // Check if image file is a actual image or fake image
else  if($_POST['_action_'] == TRUE) {
        $target_dir = "cards/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        if($uploadOk) {

            $name = $_POST['fname'];
            $type = $_POST['type'];
            $language = $_POST['language'];
            $rarity = $_POST['rarity'];
            $price = $_POST['price'];
            $user = $_SESSION['user']['id'];
            $query  = "INSERT INTO `cards`(`Name`, `Type`, `Language`, `Price`, `Rarity`, `Picture`, `user`)";
            $query .= " VALUES ('" . $name. "', '" . $type . "', '" . $language .  "', '" . $price . "', '" . $rarity . "', '" . $target_file . "', '" . $user . "')";
            $result = @mysqli_query($MySQL, $query);
        }

        print'<p>You added card successfully</p>
        <a href="index.php?menu=9">Go to profile</a>';
    }
print '
</div>';
    ?>