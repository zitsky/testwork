function _method(method,group,url,hash,params)
{
    return {
        method:method,
        url:url,
        group:group,
        hash:hash,
        params:params
    };
}

function _get(group,url,hash,params)
{
    return _method('get',group,url,hash,params);
}

function _put(group,url,hash,params)
{
    return _method('put',group,url,hash,params);
}

function _post(group,url,hash,params)
{
    return _method('post',group,url,hash,params);
}

function _delete(group,url,hash,params)
{
    return _method('delete',group,url,hash,params);
}

window.Methods=[
    //profile
    _get("Профиль пользователя","/api/profile","api-Profile-get",[]),
    _post("Профиль пользователя","/api/profile","api-Profile-update",['first_name','last_name','birthdate','email','password','avatar']),
    //statuses
    _get("Статусы","/api/statuses","api-Statuses-list"),
    _get("Статусы","/api/statuses/{id}","api-Statuses-get"),
    _post("Статусы","/api/statuses","api-Statuses-create",["name"]),
    _put("Статусы","/api/statuses/{id}","api-Statuses-update",["name"]),
    _delete("Статусы","/api/statuses/{id}","api-Statuses-remove"),
    //projects
    _get("Проекты","/api/projects/","api-Projects-list"),
    _get("Проекты","/api/projects/{id}","api-Projects-get"),
    _post("Проекты","/api/projects","api-Projects-create",["name","description","complete_time"]),
    _put("Проекты","/api/projects/{id}","api-Projects-update",["name","description","complete_time","status_id"]),
    _delete("Проекты","/api/projects/{id}","api-Projects-remove"),
    //project tasks
    _get("Задачи проектов","/api/projects/{project_id}/tasks","api-Project_Tasks-list"),
    _get("Задачи проектов","/api/projects/{project_id}/tasks/{id}","api-Project_Tasks-get"),
    _post("Задачи проектов","/api/projects/{project_id}/tasks","api-Project_Tasks-create",["name","description","end","status_id","assign_id","comment"]),
    _put("Задачи проектов","/api/projects/{project_id}/tasks/{id}","api-Project_Tasks-update",["name","description","end","status_id","assign_id","comment"]),
    _delete("Задачи проектов","/api/projects/{project_id}/tasks/{id}","api-Project_Tasks-remove"),
    //tasks
    _get("Задачи","/api/tasks","api-Tasks-list"),
    _get("Задачи","/api/tasks/{id}","api-Tasks-get"),
    _post("Задачи","/api/tasks","api-Tasks-create",["name","description","end","status_id","assign_id","comment","project_id"]),
    _put("Задачи","/api/tasks/{id}","api-Tasks-update",["name","description","end","status_id","assign_id","comment","project_id"]),
    _delete("Задачи","/api/tasks/{id}","api-Tasks-remove")

];