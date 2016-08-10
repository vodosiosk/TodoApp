$(document).ready(function(){
	$('#loader-image').show();
	showPage('login_form.php'); //mozda tu odlucit na koje ses stranice ide ovisno of #page-title

    //login form button - go to registration form
    $(document).on('click', '#registration-form-btn', function(){

        changePageTitle('Registration');

        $('#loader-image').show();

        $('#page-content').fadeOut('slow', function(){
            changePageTitle('Registration');
            showPage('registration_form.php');
        });
    });  

    //registration form submit
    $(document).on('submit', '#registration-form', function(){
        
        $('#loader-image').show();

        $.post("registration.php", $(this).serialize())
            .done(function(data){
                if(parseInt(data) == 0){
                    alert('New user created!');                    
                    showPage('login_form.php');
                    changePageTitle('Log In');
                }else{
                    alert('Unable to register user');
                    $('#loader-image').hide();         
          
                }
            });
            return false;
    });

    //login form submit
    $(document).on('submit', '#login-form', function(){
        
        $('#loader-image').show();

        $.post("login.php", $(this).serialize())
            .done(function(data){
                if(parseInt(data) != 0){
                    alert('Welcome!');
                    changePageTitle('Dashboard');
                    showPage('dashboard.php');
                }else{
                    alert('Unable to log in. Incorrect user information!');
                    $('#loader-image').hide();         
                }
            });
            return false;
    });

    //dashboard button - delete todo list
    $(document).on('click', '.delete-btn', function(){
        if(confirm('Are you sure?')){
            var listId = $(this).closest('td').find('.list-id').text();
            
            $.post("delete.php", {id: listId})
                .done(function(data){
                    console.log(data);
                    $('#loader-image').show();                    
                    showPage('dashboard.php');
                });
        }
    });

    //dashbourd button - go to todo list
    $(document).on('click', '.edit-btn', function(){
        
        var listId = $(this).closest('td').find('.list-id').text();

        $('#loader-image').show();

        $('#page-content').fadeOut('slow', function(){
            changePageTitle('Task List')
            showPage('tasks.php?id=' + listId);
        });
    });

    //dashboard table header - sort list by name
    $(document).on('click', '#todo-name-col', function(){

        $('#loader-image').show();

        $('#page-content').fadeOut('slow', function(){
            showPage('dashboard.php?param=name');
        });
    });

    //dashboard table header - sort list by date created
    $(document).on('click', '#todo-created-col', function(){

        $('#loader-image').show();

        $('#page-content').fadeOut('slow', function(){
            showPage('dashboard.php?param=created');
        });
    });

    //dashboard button - go to create todo list form 
    $(document).on('click', '#new-btn', function(){        

        $('#loader-image').show();

        $('#page-content').fadeOut('slow', function(){
            changePageTitle('Create Todo List');
            showPage('todo_form.php');
        });
    });

    //create todo list form submit 
    $(document).on('submit', '#todo-form', function(){

        $('#loader-image').show();

        $.post("create.php", $(this).serialize())
            .done(function(data){
                changePageTitle('Task list');
                showPage('tasks.php');
            });
            return false;
    });

    //task list button - go to dashboard
    $(document).on('click', '.dashboard-btn', function(){        
        $('#loader-image').show();
        $('#page-content').fadeOut('slow', function(){
            changePageTitle('Dashboard');
            showPage('dashboard.php');
        });
    });

    //task list button - delete task
    $(document).on('click', '.task-delete-btn', function(){
        $('#loader-image').show();
        if(confirm('Are you sure?')){
            var taskId = $(this).closest('td').find('.task-id').text();
            var listId = $('#list-id').text();

            $.post("deleteTask.php", {id: taskId})
                .done(function(data){
                    console.log(data);
                    $('#loader-image').show();                    
                    showPage('tasks.php?id=' + listId);
                });
        }
    });   

    //task list button - go to task update form
    $(document).on('click', '.task-edit-btn', function(){
        $('#loader-image').show();       
        var taskId = $(this).closest('td').find('.task-id').text();
        var listId = $('#list-id').text();

        $('#loader-image').show();
        
        $('#page-content').fadeOut('slow', function(){
            changePageTitle('Edit Task');
            showPage('taskUpdate_form.php?taskId=' + taskId + '&listId=' + listId);
        });
    });

    //task update form submit
    $(document).on('submit', '#task-update-form', function(){
        var listId = $('#list-id').text();

        $('#loader-image').show();
        
        $.post("updateTask.php", $(this).serialize())
            .done(function(data){
                console.log(data);
                changePageTitle('Task List');
                showPage('tasks.php?id=' + listId);
            });
            return false;
    });

    //task list table header - sort list by name
    $(document).on('click', '#task-name-col', function(){
        var listId = $('#list-id').text();

        $('#loader-image').show();

        $('#page-content').fadeOut('slow', function(){
            showPage('tasks.php?param=name&id=' + listId);
        });
    });

    //task list table header - sort list by priority
    $(document).on('click', '#task-priority-col', function(){
        var listId = $('#list-id').text();

        $('#loader-image').show();

        $('#page-content').fadeOut('slow', function(){
            showPage('tasks.php?param=priority&id=' + listId);
        });
    });

    //task list table header - sort list by deadline
    $(document).on('click', '#task-deadline-col', function(){
        var listId = $('#list-id').text();

        $('#loader-image').show();

        $('#page-content').fadeOut('slow', function(){
            showPage('tasks.php?param=deadline&id=' + listId);
        });
    });

    //task list table header - sort list by status
    $(document).on('click', '#task-status-col', function(){
        var listId = $('#list-id').text();

        $('#loader-image').show();

        $('#page-content').fadeOut('slow', function(){
            showPage('tasks.php?param=status&id=' + listId);
        });
    });

    //task list button - go to create task form
    $(document).on('click', '#task-new-btn', function(){        
        var listId = $('#list-id').text();

        $('#loader-image').show();
        
        $('#page-content').fadeOut('slow', function(){
            changePageTitle('Create Task');
            showPage('task_form.php?id=' + listId);
        });
    });    

    //create task form submit
    $(document).on('submit', '#task-form', function(){
        var listId = $('#list-id').text();

        $('#loader-image').show();
        
        $.post("createTask.php", $(this).serialize())
            .done(function(data){
                changePageTitle('Task List');
                showPage('tasks.php?id=' + listId);
            });
            return false;
    });

    //logout button
    $(document).on('click', '#logout-btn', function(){        

        $('#loader-image').show();

        $('#page-content').fadeOut('slow', function(){
            changePageTitle('Log In');
            showPage('logout.php');
        });
    });

    //zadaci button
    $(document).on('click', '#zadaci-btn', function(){        

        $('#loader-image').show();

        $('#page-content').fadeOut('slow', function(){
            changePageTitle('Zadaci');
            showPage('zadaci.php');
        });
    });

    //todo app button
    $(document).on('click', '#todo-app-btn', function(){        

        $('#loader-image').show();

        $('#page-content').fadeOut('slow', function(){
            changePageTitle('Todo app');
            showPage('login_form.php'); 
        });
    });
});

function showPage(fileName){
    $('#page-content').fadeOut('slow', function(){
        $('#page-content').load(fileName, function(){
             $('#loader-image').hide();
             $('#page-content').fadeIn('slow');
        });
    });  
}

function changePageTitle(pageTitle){
    $('#page-title').text(pageTitle);
    document.title=pageTitle;
}