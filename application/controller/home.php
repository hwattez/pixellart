<?php

class Home
{

    public function index()
    {
        $videos = VideosManager::getAll();
        $tags = TagsManager::getAll();

        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function message($nom, $email, $website, $mess)
    {
    	$website = $website == 'null' ? null : $website;
        if(Funtions::isValidEmail($email))
            return "Il y a une erreur dans l'insertion de l'adresse email";

    	$message = new Message();
    	$message->set('nom', $nom);
    	$message->set('email', $email);
    	$message->set('website', $website);
    	$message->set('message', $mess);

    	return $message->save() ? 'Le message a bien été envoyé !' : "Une erreur est survenue lors de l'envoie du mail...";
    }

}
