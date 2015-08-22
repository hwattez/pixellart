<?php

class Administration
{
    public function index()
    {
        $nb_videos = VideosManager::count();
        $nb_tags = TagsManager::count();

        require APP . 'view/_templates/admin/header.php';
        require APP . 'view/administration/index.php';
        require APP . 'view/_templates/admin/footer.php';
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
                    if($error = $video->save())
                        header('location: ' . URL . 'administration/videos/');
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

}
