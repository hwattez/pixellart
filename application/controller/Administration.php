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
        $nb_videos = count($videos);
        $nb_tags = TagsManager::count();
        $nb_messages = MessagesManager::count();

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
        $tags = TagsManager::getAll('count');
        
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
        $messages = MessagesManager::getAll('id DESC');
        
        require APP . 'view/_templates/admin/header.php';
        require APP . 'view/administration/messages.php';
        require APP . 'view/_templates/admin/footer.php';
    }

}
