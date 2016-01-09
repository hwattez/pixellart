<?php

class Administration
{
    public function __construct()
    {
        if(!LOGGED && $_SERVER['REQUEST_URI'] != '/administration/login/'){
            header('location: ' . URL . 'administration/login/');
            exit;
        }
    }

    public function index()
    {
        $videos = VideosManager::getAll();
        $lastTimeVideo = empty($videos) ? 0 : (strtotime(date('Y-m-d')) - strtotime(end($videos)->get('date')));
        $nb_videos = count($videos);

        $nb_tags = TagsManager::count();

        $messages = MessagesManager::getAll();
        $lastTimeMessage = empty($messages) ? 0 : (strtotime(date('Y-m-d')) - strtotime(end($messages)->get('date')));
        $nb_messages = count($messages);

        $tasks = TasksManager::getAll();
        $lastTimeTask = empty($tasks) ? 0 : (strtotime(date('Y-m-d')) - strtotime(end($tasks)->get('date')));
        $nb_tasks = count($tasks);

        $notifications = array($lastTimeVideo => array('fa' => 'fa-video-camera', 'text' => 'Dernière vidéo'),
                               $lastTimeTask => array('fa' => 'fa-tasks', 'text' => 'Dernière tâche'),
                               $lastTimeMessage => array('fa' => 'fa-envelope', 'text' => 'Dernier message'));
        ksort($notifications);

        require APP . 'view/_templates/admin/header.php';
        require APP . 'view/administration/index.php';
        require APP . 'view/_templates/admin/footer.php';
    }

    public function login()
    {
        if(isset($_POST['login']) && isset($_POST['password']) && $_POST['login'] === 'admin' && md5($_POST['password']) === 'a826e9303d8dc8f1f5e5e7fff1b01c15'){
            setcookie('login', $_POST['login'], time() + 3600, '/');
            setcookie('password', $_POST['password'], time() + 3600, '/');
            header('location: ' . URL . 'administration/index/');
            exit;
        }

        require APP . 'view/_templates/admin/header.php';
        require APP . 'view/administration/login.php';
        require APP . 'view/_templates/admin/footer.php';
    }

    public function logout()
    {
        setcookie('login', '', time() - 3600, '/');
        setcookie('password', '', time() - 3600, '/');
        unset($_COOKIE['login'],$_COOKIE['password']);

        header('location: ' . URL . 'administration/login/');
    }

    public function videos()
    {
        $videos = VideosManager::getAll();
        
        require APP . 'view/_templates/admin/header.php';
        require APP . 'view/administration/videos.php';
        require APP . 'view/_templates/admin/footer.php';
    }

    public function video($action, $id=null)
    {

        if(is_null($id))
            $video = new Video();
        else
            $video = VideosManager::getById($id);

        switch(true)
        {
            case ($action == "new" OR $action == "edit"):
                $forms = $video->getTableColumnsType();
                if(!empty($_POST) OR !empty($_FILES)){
                    $video->setFromForms();
                    if($error = $video->save()){
                        header('location: ' . URL . 'administration/videos/');
                        exit;
                    }
                }
                require APP . 'view/_templates/admin/header.php';
                require APP . 'view/administration/video/new.php';
                require APP . 'view/_templates/admin/footer.php';
                break;

            case $action == "delete":
                $video->delete();
                header('location: ' . URL . 'administration/videos/');
                break;
                
            default:
                header('location: ' . URL . 'error/');
        }

    }

    public function tags()
    {
        $tags = TagsManager::getAll(array('count' => true));
        
        require APP . 'view/_templates/admin/header.php';
        require APP . 'view/administration/tags.php';
        require APP . 'view/_templates/admin/footer.php';
    }

    public function tag($action, $id)
    {
        $tag = TagsManager::getById($id);

        switch(true)
        {
            case $action == "delete":
                $tag->delete();
                header('location: ' . URL . 'administration/tags/');
                break;

            default:
                header('location: ' . URL . 'error/');
        }
    }

    public function messages()
    {
        $messages = MessagesManager::getAll(array('count'=> true, 'order' => 'id DESC'));
        
        require APP . 'view/_templates/admin/header.php';
        require APP . 'view/administration/messages.php';
        require APP . 'view/_templates/admin/footer.php';
    }

    public function tasks()
    {
        $tasks = TasksManager::getAll(array('order' => 'completed, id'));
        
        require APP . 'view/_templates/admin/header.php';
        require APP . 'view/administration/tasks.php';
        require APP . 'view/_templates/admin/footer.php';
    }

    public function task($action, $id=null)
    {

        if(is_null($id))
            $task = new Task();
        else
            $task = TasksManager::getById($id);

        switch(true)
        {
            case ($action == "new" OR $action == "edit"):
                $forms = $task->getTableColumnsType();
                if(!empty($_POST) OR !empty($_FILES)){
                    $task->setFromForms();
                    if($error = $task->save()){
                        header('location: ' . URL . 'administration/tasks/');
                        exit;
                    }
                }
                require APP . 'view/_templates/admin/header.php';
                require APP . 'view/administration/task/new.php';
                require APP . 'view/_templates/admin/footer.php';
                break;

            case $action == "delete":
                $task->delete();
                header('location: ' . URL . 'administration/tasks/');
                exit;
                break;
                
            default:
                header('location: ' . URL . 'error/');
                exit;
        }

    }

}
