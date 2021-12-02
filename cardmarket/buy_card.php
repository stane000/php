

<?php


print '
    <div id="buy_card" >';
        print $_SESSION['user']['username'];
        $query  = "SELECT * FROM users";
        $query .= " WHERE id=" .  $_SESSION['user']['id'];
        $result = @mysqli_query($MySQL, $query);
        $row = mysqli_fetch_array($result);
        $money = $row['money'];
        $money = $money - $_SESSION[$card_id]['price'];
        $_SESSION['user']['money'] = $money;
        $query  = "update users";
        $query .= " set money = " . $money. " where  id  = " .$_SESSION['user']['id'];
        $result = @mysqli_query($MySQL, $query);
    

    print '
    </div>';
    ?>