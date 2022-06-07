<?php
session_start(); 
$user_id = $_GET["id_receiv"];
$other_id = $_GET["id_send"];
if ($user_id == "") {
    header("Location:login.php");
}
else
{
?>
<!DOCTYPE html>
<html lang="en">
<!-- head start -->
<?php include("views/head.php") ?>
<!--Head ends-->
<body>
<!-- header start -->
<?php include("views/navbar.php") ?>
<!--Header ends-->
<div class="container8">
<?php
$condition = "id=".$other_id;
?>
<h3 class=" text-center">Messaging <strong><?php echo $db->get_elmr_by_id("fname",$condition,"users",$con)?></strong></h3>
<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Recent</h4>
            </div>
            <div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar"  placeholder="Search" >
                <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
            </div>
          </div>
          <div class="inbox_chat">

            <?php

            $id_receiver  = 0;

                $sql_get_chat = "SELECT * FROM chat WHERE id_receiver = '$user_id' AND id_sender='$other_id' OR id_receiver = '$other_id' AND id_sender='$user_id' OR id_receiver='$user_id'";
                $q_get_chat = $con->query($sql_get_chat);
                $q_get_chat->setFetchMode(PDO::FETCH_ASSOC);

                while($row_get_chat = $q_get_chat->fetch())
                {
                    $id_receiver = $row_get_chat["id_receiver"];
                    $id_chat = $row_get_chat["id"];
                    $mstatus = "unread";
                    $count_ms = 0;
                    $profile = "";
                    $sfname = "";
                    $slname = "";
                    $last_message = "";
                    $date_last = "";
                    $qual = "";

                    if ($user_id == $id_receiver) {
                      $id_receiver = $row_get_chat["id_sender"];
                    }



                    $sql_get_sender = "SELECT * FROM users WHERE id = '$id_receiver'";
                    $q_get_sender = $con->query($sql_get_sender);
                    $q_get_sender->setFetchMode(PDO::FETCH_ASSOC);
                    while($row_get_sender = $q_get_sender->fetch())
                    {
                        $sfname = $row_get_sender["fname"];
                        $slname = $row_get_sender["lname"];
                        $profile = $row_get_sender["profile"];
                        $qual = $row_get_sender["qualification"];
                    }

                    $sql_get_last_messages = "SELECT * FROM messages WHERE chat_id = '$id_chat'";
                    $q_get_last_messages = $con->query($sql_get_last_messages);
                    $q_get_last_messages->setFetchMode(PDO::FETCH_ASSOC);

                    while($row_get_last_messages_chat = $q_get_last_messages->fetch())
                    {
                        $last_message = $row_get_last_messages_chat["content"];
                        $date_last = $row_get_last_messages_chat["date_sent"];

                    }


            if ($id_receiver == $other_id) {
            ?>
            <a href="chat.php?id_send=<?php echo $id_receiver?>&id_receiv=<?php echo $user_id?>">
            <div class="chat_list active_chat">
              <div class="chat_people">
                <?php
                    if ($profile == "") {
                ?>
                    <div class="chat_img">
                        <img src="assets/img/users/default.png" alt="sunil"> 
                    </div>
                <?php
                    }
                    else if($profile != "" && $qual=="lawyer")
                    {
                ?>
                    <div class="chat_img">
                        <img src="assets/img/lawyers/<?php echo $profile?>" alt="<?php echo $profile?>"> 
                    </div>
                <?php
                    }else if ($profile != "" && $qual=="visitor") {
                      ?>
                    <div class="chat_img">
                        <img src="assets/img/users/<?php echo $profile?>" alt="<?php echo $profile?>"> 
                    </div>
                <?php
                    }else if ($profile != "" && $qual=="admin") {
                         ?>
                    <div class="chat_img">
                        <img src="assets/img/users/<?php echo $profile?>" alt="<?php echo $profile?>"> 
                    </div>
                <?php
                    }
                ?>
                <div class="chat_ib">
                  <h5><?php echo $sfname." ".$slname?> <span class="chat_date"><?php echo $date_last?></span></h5>
                  <p><?php echo $last_message?></p>
                </div>
              </div>
            </div>
            </a>

            <?php
            }else
               {
                     ?>
            <a href="chat.php?id_send=<?php echo $id_receiver?>&id_receiv=<?php echo $user_id?>">
            <div class="chat_list">
              <div class="chat_people">
                <?php
                    if ($profile == "") {
                ?>
                    <div class="chat_img">
                        <img src="assets/img/users/default.png" alt="sunil"> 
                    </div>
                 <?php
                    }
                    else if($profile != "" && $qual=="lawyer")
                    {
                ?>
                    <div class="chat_img">
                        <img src="assets/img/lawyers/<?php echo $profile?>" alt="<?php echo $profile?>"> 
                    </div>
                <?php
                    }else if ($profile != "" && $qual=="visitor") {
                      ?>
                    <div class="chat_img">
                        <img src="assets/img/users/<?php echo $profile?>" alt="<?php echo $profile?>"> 
                    </div>
                <?php
                    }else if ($profile != "" && $qual=="admin") {
                         ?>
                    <div class="chat_img">
                        <img src="assets/img/users/<?php echo $profile?>" alt="<?php echo $profile?>"> 
                    </div>
                <?php
                    }
                ?>
                <div class="chat_ib">
                  <h5><?php echo $sfname." ".$slname?><span class="chat_date"><?php echo $date_last?></span></h5>
                  <p><?php echo $last_message?></p>
                </div>
              </div>
            </div>
            </a>
            <?php
                }
            }
            ?>
          </div>
        </div>
        <div class="mesgs">
          <div class="msg_history">

            <?php
            $sql_get_messages_chat = "SELECT * FROM messages WHERE id_receiver = '$user_id' AND id_sender = '$other_id' OR id_receiver='$other_id' AND id_sender='$user_id' ORDER BY date_sent ASC";
            $q_get_messages_chat = $con->query($sql_get_messages_chat);
            $q_get_messages_chat->setFetchMode(PDO::FETCH_ASSOC);

            while($row_get_messages_chat = $q_get_messages_chat->fetch())
            {
                $id_receiver = $row_get_messages_chat["id_receiver"];

                $date_array = explode(" ", $row_get_messages_chat["date_sent"]);
                $day = $date_array[0];
                $hour = $date_array[1];

                if ($id_receiver == $user_id) {
            ?>
            <div class="incoming_msg">
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p><?php echo $row_get_messages_chat["content"]?></p>
                  <span class="time_date"> <?php echo $hour?>    |    <?php echo $day?></span></div>
              </div>
            </div>
            <?php
            }else if($id_receiver == $other_id)
            {
            ?>
            <div class="outgoing_msg">
              <div class="sent_msg">
                <p><?php echo $row_get_messages_chat["content"]?></p>
                <span class="time_date"> <?php echo $hour?>    |    <?php echo $day?></span> </div>
            </div>

            <?php
            }
            }
            ?>


          </div>
          <div class="type_msg">
            <div class="input_msg_write">
              <input type="text" class="write_msg" id="message_content" placeholder="Type a message" />
              <input type="hidden" value="<?php echo $other_id?>" id="sender_id">
              <input type="hidden" value="<?php echo $user_id?>" id="to_id">
              <button class="msg_send_btn" type="button" onclick="sendMessage()"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            </div>
          </div>
        </div>
      </div>      
    </div>
</div>


    <?php include("views/footer.php") ?>

</body>
<script type="text/javascript">
    function sendMessage()
    {
        var message_content = document.getElementById("message_content").value;
        var sender_id = document.getElementById("sender_id").value;
        var to_id = document.getElementById("to_id").value;


        /*to initialize the http request*/
      var xhttp = new XMLHttpRequest();
      /* to check the status  and the sate of the request  after executing the request for displaying a execution msg*/
      xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {

          var msg = this.responseText;
          var ms = msg.trim();
          if (ms=="success") 
          {
              window.location.reload();
          }
          else
          {
            // alert("Something went wrong! Please try again!");
            //   window.location.reload();
            alert(ms);
          }       
        }
      };
          
          /*open the http request with the Method and the sever page*/
          xhttp.open("POST", "class/sendMessage.php", true);
          /*to define the Request header*/
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //
          /*to define the parameters to be held in the request*/
          xhttp.send("message_content=" + message_content +"&sender_id="+sender_id+"&to_id="+to_id);

    }
</script>

</html>
<?php
}
?>