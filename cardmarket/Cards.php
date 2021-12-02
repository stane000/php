
<?php

print '
<div id="cards" style="border: 1px solid blue">
     <form action="" name="myForm" id="myForm" method="POST" style="margin: 50px">
        <div class="container" style=" border: 1px solid blue">

            <input type="hidden" id="_action_" name="_action_" value="TRUE">
            <div class="row">
                    <div class="col-4">
                        <label for="cardName" class="form-label">Card name</label>
                        <input type="text" id="card_name" name="card_name" value="" style="width: 380px">
                    </div>
                    <div class="col">
                        <label for="type" class="form-label">Card Type</label>
                        <select class="form-select" id="type" name="type" aria-label="Default select example">
                            <option selected>All</option>
                            <option value="1">Monster</option>
                            <option value="2">Spell</option>
                            <option value="3">Trap</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="Language" class="form-label">Language</label>
                        <select class="form-select" id="language" name="language" aria-label="Default select example">
                            <option selected>All</option>
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
                            <option selected>All</option>
                            <option value="1">Rare</option>
                            <option value="2">SuperRare</option>
                            <option value="3">GhostRare</option>
                            <option value="4">Common</option>
                            <option value="5">Mint</option>
                        </select>
                    </div>
            </div>    
            <div class="row">   
                    <div class="col-2">
                            <label for="minPrice-min">Price from:</label>
                            <input id="minPrice" id="min" name="min" type="number" value="0">
                    </div>
                    <div class="col-8">
                        <label for="maxPrice">Max Price:</label>
                        <input id="maxPrice" id="max" name="max" type="number" value="1000">
                    </div>
                      

                    <div class="col-2">
                     <button class="btn btn-primary" type="Submit" value="Submit">Search</button>
                    </div>
            </div>
          
        </div>
    </form>';

    $query  = "SELECT * FROM users";
    $users = @mysqli_query($MySQL, $query);

                            
    if($_POST['_action_'] == TRUE){ 
        
        if($_POST['type'] == 0){
                $type_string = " ";
        }
        else{
            $type_string = " and Type =" .$_POST['type'];
        }
        if($_POST['language'] == 0){
            $language_string = " ";
        }
        else{
            $language_string = " and Language =" .$_POST['language'];
        }
        if($_POST['rarity'] == 0){
                $rarity_string = " ";
        }
        else{
            $rarity_string = " and Rarity =" .$_POST['rarity'];
        }
        $price_string = " and Price between " .$_POST["min"]. " and " .$_POST["max"];
        

        echo "<table border='1' class='container'>
        <tr>
        <th>Card Name</th>
        <th>Type</th>
        <th>Language</th>
        <th>Rarity</th>
        <th>Price in dollars</th>
        <th>User</th>
        <th style='padding-left: 100px'>picture</th>
        <th>
        </tr>";

        // $query  = "SELECT * FROM cards";
        // $query .= " WHERE Name ='" .  $_POST['name'];
        $query  = "SELECT * FROM cards where Name like '%" .$_POST['card_name']. "%' " .$type_string .$language_string .$rarity_string . $price_string;
        $result = @mysqli_query($MySQL, $query);

        if(mysqli_num_rows($result)==0){
            print "<h1 style='margin: auto'>No results<h1>";
        }
        else{
            while($row = mysqli_fetch_array($result))
            {
                echo "<tr>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "<td>" . $row['Type'] . "</td>";
                echo "<td>" . $row['Language'] . "</td>";
                echo "<td>" . $row['Rarity'] . "</td>";
                echo "<td style=' text-align: center; margin-right: 2px'>" . $row['Price'] . " $  </td>";
                echo "<td>" . get_user_name($row["user"], $users) . "</td>";
                echo "<td><img src='" .$row['Picture']. "' alt='' style='width: 150px; hight: 280px; padding-left: 40px'></td>";
                if ($_SESSION['user']['valid'] == 'true' and $_SESSION['user']['roles'] == 'user'){
                    $card_id = "'".$row['id']."'";
                    $_SESSION[$card_id]['price'] = $row['Price'];
                    $_SESSION['card']['picture'] = $row['Picture'];
                    $money = 4;
                    if ($row['Price'] > $_SESSION['user']['money']){
                         echo "<td style='padding-left: 50px'><button onclick='myFunction(".$row['Price']. "," .$_SESSION['user']['money'].")' style='width: 100px' type='button' class='btn btn-success'>Buy</button></td>";
                    }
                    else{
                        
                        print'<td style="padding-left: 50px">
                        <form action="" id="buy_card" name="buy_card" method="GET" enctype="multipart/form-data">
                            <input type="hidden" id="_action" name="_action" value="TRUE">
                            <button type="submit" onclick="myFunction('.$_SESSION[$card_id]['price']. ',' .$_SESSION['user']['money'].')" style="width: 100px" type="button" class="btn btn-success">Buy</button>
                        </form></td>';
    
                    }
                }
                echo "</tr>";
                }
                echo "</table>";
                }
        }
    else{
            echo "<table border='1' class='container'>
            <tr>
            <th>Card Name</th>
            <th>Type</th>
            <th>Language</th>
            <th>Rarity</th>
            <th>Price in dollars</th>
            <th>User</th>
            <th style='padding-left: 100px'></th>
            <th>
            </tr>";
            // $query  = "SELECT * FROM cards WHERE Name like '% .  $_POST['name'] . %'";
            $query  = "SELECT * FROM cards";
            $result = @mysqli_query($MySQL, $query);  
            
            $_SESSION['card']['results'] = $result;

            while($row = mysqli_fetch_array($result))
            {
            echo "<tr>";
            echo "<td>" . $row['Name'] . "</td>";
            echo "<td>" . $row['Type'] . "</td>";
            echo "<td>" . $row['Language'] . "</td>";
            echo "<td>" . $row['Rarity'] . "</td>";
            echo "<td style=' text-align: center; margin-right: 2px'>" . $row['Price'] . " $  </td>";
            echo "<td>" . get_user_name($row["user"], $users) . "</td>";
            echo "<td><img src='" .$row['Picture']. "' alt='' style='width: 150px; hight: 280px; padding-left: 40px'></td>";
            if ($_SESSION['user']['valid'] == 'true' and $_SESSION['user']['roles'] == 'user'){
                $card_id = "'".$row['id']."'";
                $_SESSION[$card_id]['price'] = $row['Price'];
                $_SESSION['card']['picture'] = $row['Picture'];
                $money = 4;
                if ($row['Price'] > $_SESSION['user']['money']){
                     echo "<td style='padding-left: 50px'><button onclick='myFunction(".$row['Price']. "," .$_SESSION['user']['money'].")' style='width: 100px' type='button' class='btn btn-success'>Buy</button></td>";
                }
                else{
                    
                    print'<td style="padding-left: 50px">
                    <form action="" id="buy_card" name="buy_card" method="GET" enctype="multipart/form-data">
                        <input type="hidden" id="_action" name="_action" value="TRUE">
                        <button type="submit" onclick="myFunction('.$_SESSION[$card_id]['price']. ',' .$_SESSION['user']['money'].')" style="width: 100px" type="button" class="btn btn-success">Buy</button>
                    </form></td>';

                }
            }
            echo "</tr>";
            }
            echo "</table>";
        }
print '
<script>
function myFunction(cardPrice, userMoney) {
  if(parseInt(cardPrice) > parseInt(userMoney)){
    alert("You don t have enough money to buy: Card price "+cardPrice+"$,   you got "+userMoney+"$  ");
  }
  else{
      alert("Successful purchase");
    }
}
</script>

</div>';
?>
        