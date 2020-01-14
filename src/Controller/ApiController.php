<?php
namespace src\Controller;
use src\Model\Article;
use src\Model\Bdd;

class ApiController {
    public function Article(){
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $article = new Article();
            $listArticle = $article->SqlGetAll(Bdd::GetInstance());
            return json_encode($listArticle);
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $article = new Article();
            $article->setTitre($_POST['Titre'])
                ->setDescription($_POST['Description'])
                ->setAuteur($_POST['Auteur'])
                ->setDateAjout($_POST['DateAjout'])
            ;
            $result = $article->SqlAdd(Bdd::getInstance());
            return json_encode($result);
        } elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            if (!empty($_GET['Id'])) {
                $articleSQL = new Article();
                $articleID = $_GET['Id'];
                $article = $articleSQL->SqlGet(BDD::getInstance(),$articleID);

                $article->setTitre($_POST['Titre'])
                    ->setDescription($_POST['Description'])
                    ->setAuteur($_POST['Auteur'])
                    ->setDateAjout($_POST['DateAjout'])
                ;

                $result = $article->SqlUpdate(BDD::getInstance());
                return json_encode($result);

            } else {
                return json_encode('ta oublié l\'id mon ami');
            }
        }
    }
}