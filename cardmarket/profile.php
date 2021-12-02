

<?php

print '
     
<div class="container emp-profile" style="border: 2px solid blue">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="' .$_SESSION['user']['picture']. '" alt=""/>
                    <div class="file btn btn-lg btn-primary">
                        Change Photo
                        <input type="file" name="file"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                            <h5>
                            ' .$_SESSION['user']['username']. '
                            </h5>
                            <h6>
                                Card Seller
                            </h6>
                            <p class="proile-rating">RANKINGS : <span>8/10</span></p>
                    <ul class="nav nav-tabs" id="myTab" role="tablist" style="background-color: white">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="border-right: 1px solid #dee2e6;" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Cards</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <a href="index.php?menu=11" class="btn btn-light" >Eddit Profile</a>
                <a href="index.php?menu=10" class="btn btn-light" >Add card</a>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-work" style="border-right: 1px solid #dee2e6;">
                    <p>WORK LINK</p>
                    <a href="">Website Link</a><br/>
                    <a href="">Bootsnipp Profile</a><br/>
                    <a href="">Bootply Profile</a>
                    <p>Money</p>
                    <form action="" id="add_money" name="add_money" method="POST" enctype="multipart/form-data">
                         <input type="hidden" id="_action_" name="_action_" value="TRUE">
                         <input type="number" id=money" name="money" value="0">
                         <input class="btn btn-light" type="submit" value="Add" style="width: 100px; margin-top: 10px; margin-left: 20px">
                </div>
            </div>';
            if($_POST['_action_'] == TRUE){ 
                $query  = "SELECT * FROM users";
                $query .= " WHERE id=" .  $_SESSION['user']['id'];
                $result = @mysqli_query($MySQL, $query);
                $row = mysqli_fetch_array($result);
                $money = $row['money'];
                $money = $money + $_POST['money'];
                $_SESSION['user']['money'] = $money;
                $query  = "update users";
                $query .= " set money = " . $money. " where  id  = " .$_SESSION['user']['id'];
                $result = @mysqli_query($MySQL, $query);
            }
            
                print'
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>User Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>' .$_SESSION['user']['username']. '</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>' .$_SESSION['user']['firstname']. ' ' .$_SESSION['user']['lastname']. '</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>' .$_SESSION['user']['email']. '</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Country</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>' .$_SESSION['user']['country']. '</p>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Money</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>' .$_SESSION['user']['money']. '$</p>
                                    </div>
                            </div>               
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">';

                    $query  = "SELECT * FROM cards";
		            $query .= " WHERE user= " .  $_SESSION['user']['id'];
                    $result = @mysqli_query($MySQL, $query);
            
                    if(mysqli_num_rows($result)==0){
                        print "<h1 style='margin: auto'>No cards to show! please add card. <h1>";
                    }
                    else{
                        echo "<table border='1' class='container'>
                        <tr>
                        <th>Card Name</th>
                        <th>Type</th>
                        <th>Language</th>
                        <th>Rarity</th>
                        <th>Price-$</th>
                        <th style='padding-left: 100px'></th>
                        </tr>";
    
                        while($row = mysqli_fetch_array($result))
                        {
                            echo "<tr>";
                            echo "<td>" . $row['Name'] . "</td>";
                            echo "<td>" . $row['Type'] . "</td>";
                            echo "<td>" . $row['Language'] . "</td>";
                            echo "<td>" . $row['Rarity'] . "</td>";
                            echo "<td>" . $row['Price'] . " $  </td>";
                            echo "<td><img src='" .$row['Picture']. "' alt='' style='width: 110px; hight: 220px;'></td>";
                            echo "</tr>";
                            }
                            echo "</table>";
                        }
                            
                    print '
                    </div>
                </div>
            </div>
        </div>
    </form>           
</div>
 ';

?>