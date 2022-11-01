<?php
//INCLUDE DATABASE FILE
include('database.php');
//SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
session_start();

//ROUTING
if (isset($_POST['save']))        saveTask();
if (isset($_POST['update']))      updateTask();
if (isset($_POST['delete']))      deleteTask();


function getTasks($status)
{
   
    $index = 1;
    require('database.php');
    $requete = "SELECT t.id,t.title,t.task_datetime ,t.description,ty.id as tyid,ty.name as types,p.id as idP, p.name as priorities,stt.id as sttid,stt.name as statuses
    FROM tasks as t,types as ty ,statuses as stt , priorities as p 
    WHERE t.type_id=ty.id AND t.priority_id=p.id AND t.status_id=stt.id;";
    $query = mysqli_query($connc, $requete);       //mysqli_query : 
    while ($row = mysqli_fetch_assoc($query)) {    //mysqli_fetch_assoc :
        // var_dump($row);
        //CODE HERE
        
        if ($row['statuses'] == $status) {
            if ($row["statuses"]== "To Do") {
                $icon = "fa-regular fa-clock ms-10px";
            };
            if ($row["statuses"] == "In Progress") {
                $icon = "spinner-border spinner-border-sm ms-10px";
            };
            if ($row["statuses"] == "Done") {
                $icon = "fa-regular fa-circle-check ms-10px";
            };
            
                $type = $row['types'] == 1 ? 'Feature' : 'Bug';
                $id = $row['id'];
                echo '<button class="d-flex w-100 border-0 border-top"  href="#modal-task" data-bs-toggle="modal" onclick="edit(' . $id . ')" data-status =' . $row["sttid"] . ' id=' . $row['id'] . '>
                    <div class="text-green fs-4 px-2">
                        <i class="' . $icon . '"></i> 
                    </div>
                    <div class="text-start ">
                        <div class="fs-3 " id="title' . $id . '" data="' . $row['title'] . '">' . $row['title'] . '</div>
                        <div class="">
                            <div class="fs-5 text-gray" id="date' . $id . '" date="' . $row['task_datetime'] . '">' . $index++ . ' created in ' . $row['task_datetime'] . '</div>
                            <div class="fs-5" id="description' . $id . '" desc="' . $row['description'] . '">' . $row['description'] . '</div>
                        </div>
                        <div class="my-10px">
                            <span class="bg-blue-500 p-5px px-10px text-white rounded-2" id="priority' . $id . '" priority="' . $row['idP'] . '">' . $row['priorities'] . '</span>
                            <span class="bg-gray-400 p-5px px-10px text-black rounded-2" id="type' . $id . '" type="' . $row['tyid'] . '">' .$row['types']. '</span>
                        </div>
                    </div>
                </button>';
            }
        
    }
    //SQL SELECT
    
}

function counthg($nb)
{
    include('database.php');
   
    $requete = "SELECT  COUNT(*) As nbrow from tasks where status_id=$nb";
            
    $query=mysqli_query($connc, $requete);
    $row=mysqli_fetch_assoc($query);
    echo $row['nbrow'];

}

function saveTask()
{
    include('database.php');
    //CODE HERE
    $title = $_POST['title'];
    $type = $_POST['tasktype'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $requete = "INSERT INTO `tasks`(`title`, `type_id`, `priority_id`, `status_id`, `task_datetime`, `description`)
            
             VALUES ('$title','$type','$priority','$status','$date','$description')";
    mysqli_query($connc, $requete);
    //SQL INSERT
    $_SESSION['message'] = "Task has been added successfully !";
    header('location: index.php');
}

function updateTask()
{
    require 'database.php';
    $id = $_POST['index'];
    $title = $_POST['title'];
    $type = $_POST['tasktype'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    //CODE HERE

    $upd = "UPDATE  `tasks` SET  `title`='$title',`type_id`='$type',`priority_id`='$priority',`status_id`='".$status."',`task_datetime`='$date',`description`='$description' WHERE id = '$id'";
    mysqli_query($connc, $upd);
    //SQL UPDATE
    $_SESSION['message'] = "Task has been updated successfully !";
    header('location: index.php');
}

function deleteTask()
{
    //CODE HERE
    require 'database.php';
    $id = $_POST['index'];
    $del = "DELETE FROM tasks where id='$id'";
    $query = mysqli_query($connc, $del);
    //SQL DELETE
    $_SESSION['message'] = "Task has been deleted successfully !";
    header('location: index.php');
}
