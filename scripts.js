function edit(id){
    document.getElementById("task-id").value=id
    document.getElementById("task-delete-btn").style.display="block";
    document.getElementById("task-update-btn").style.display="block";
    document.getElementById("task-save-btn").style.display="none";
    document.getElementById("task-title").value=document.getElementById("title"+id).getAttribute('data');
    document.getElementById("task-priority").value=document.getElementById("priority"+id).getAttribute('priority');
    document.getElementById("task-status").value=document.getElementById(id).getAttribute("data-status");
    document.getElementById("task-date").value=document.getElementById("date"+id).getAttribute('date');
    document.getElementById("task-description").value = document.getElementById("description"+id).getAttribute('desc');
    if(document.getElementById("type"+id).getAttribute("type")==1 ){
        (document.getElementById("task-type-feature").checked = true)
    }else{
        document.getElementById("task-type-bug").checked = true
    }
    }


function addbtn(){
    document.getElementById("task-delete-btn").style.display="none";
    document.getElementById("task-update-btn").style.display="none";
    document.getElementById("task-save-btn").style.display="block";
    document.getElementById("form-task").reset();

}