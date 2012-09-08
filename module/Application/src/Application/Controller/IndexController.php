<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Application\Model\TweetTable;
use Application\Model\TutorielTable;
use Application\Model\DeveloperTable;
use Application\Model\FacebookTable;
use Application\Model\SlideshareTable;
use Application\Form\Form;
use ZFBook\Service\Twitter\Language as TwitterLanguage;
use Zend\Search\Lucene\Lucene;
use Zend\Search\Lucene\Index;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as Mail;
use Zend\Paginator\Paginator;
use Zend\InputFilter\InputFilter;

class IndexController extends AbstractController
{    
    public function indexAction()
    {	        
        $sm = $this->getServiceLocator();
        return array(
            'tweets' => $sm->get('TweetModel')->fetchAllLastValid(25),
            'tutofr' => $sm->get('TutorielModel')->fetchAllLastValidByLang('fr',3),
            'tutoen' => $sm->get('TutorielModel')->fetchAllLastValidByLang('en',3),
        );
    }
    
    public function tweetAction()
    {   
        $page = $this->getRequest()->getQuery()->get('page', 1);
        $numByPage = 20;
        
        $sm = $this->getServiceLocator();
        return array(
            'tweets' => $sm->get('TweetModel')->fetchAllLastValid($numByPage, $page),
        );
    }
    
    public function registertutorielAction()
    {
        
    }
    
    public function tutorielAction()
    {   
        $sm = $this->getServiceLocator();
        return new ViewModel(
                    array(
                        'tutofr' => $sm->get('TutorielModel')->fetchAllLastValidByLang('fr', 5),
                        'tutoen' => $sm->get('TutorielModel')->fetchAllLastValidByLang('en', 5),
                    )
                );
    }
    
    public function tutorielfrAction()
    {   
        $page = $this->getRequest()->getQuery()->get('page', 1);
        $numByPage = 8;
        
        $sm = $this->getServiceLocator();
        $tutos = $sm->get('TutorielModel')->fetchAllLastValidByLang('fr', $numByPage, $page); // TODO get query when paginator work
        $paginator = Paginator::factory($tutos);
        $paginator->setItemCountPerPage($numByPage);
        $paginator->setCurrentPageNumber($page);
        
        return array('tutos' => $paginator);
    }
    
    public function tutorielenAction()
    {   
        $page = $this->getRequest()->getQuery()->get('page', 1);
        $numByPage = 8;
        
        $sm = $this->getServiceLocator();
        $tutos = $sm->get('TutorielModel')->fetchAllLastValidByLang('en', $numByPage, $page); // TODO get query when paginator work
        $paginator = Paginator::factory($tutos);
        $paginator->setItemCountPerPage($numByPage);
        $paginator->setCurrentPageNumber($page);
        
        return array('tutos' => $paginator);
    }
    
    public function bookAction() {}
    
    public function socialAction()
    {
        $sm = $this->getServiceLocator();
        return array(
            'slideshare' => $this->get('SlideshareModel')->fetchAllLastValid('all',10),
            'facebook' => $sm->get("FacebookModel")->fetchAll(),
       );
    }
    
    public function developerAction()
    {
        $page = $this->getRequest()->getQuery()->get('page', 1);
        $numByPage = 10;
        
        $sm = $this->getServiceLocator();
        $devs = $sm->get('DeveloperModel')->fetchAllValid(); // TODO get query when paginator work
        $paginator = Paginator::factory($devs);
        $paginator->setItemCountPerPage($numByPage);
        $paginator->setCurrentPageNumber($page);
        
        return array('developer' => $paginator);
    }
    
    public function registerdeveloperAction()
    {
        $form = new Form\Developpeur();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $formData = $request->getPost()->toArray();
            $form->setData($formData);
            if ($form->isValid()) {
               $formData = $form->getData();
               $sm = $this->getServiceLocator();
               $sm->get('DeveloperModel')->register($formData);
               // use action helper with plugin method
               $this->plugin('flashmessenger')->addValidMessage('Merci pour l\'inscription, celle-ci est généralement prise en compte sous 48h.');
               return $this->plugin('redirect')->toRoute('register-developer');
            }
            else {
                $form->setData($formData);
                // use action helper like method
                $this->flashMessenger()->addErrorMessage('Merci de remplir tous les champs du formulaire.');
            }
        }
        
        return array('form' => $form);
    }
    
    public function searchAction()
    {
        $sm = $this->getServiceLocator();
        $search = $this->request->getQuery()->get('tag',null);
        if($search)
        {
            $result = array(
                'tutofr' => $sm->get('TutorielModel')->fetchAllFilterByTagAndLang($search,'fr',8),
                'tutoen' => $sm->get('TutorielModel')->fetchAllFilterByTagAndLang($search,'en',8),
            );
        }
        else
        {
            $search = $this->request->getQuery()->get('custom',null);
            if(!$search)
            {
                $this->plugin('redirect')->toRoute('home');
            }
            
            $tutoFR = array();
            $tutoEN = array();
            $results = $this->lucene->find($search);
            foreach($results as $result)
            {
                $document = $result->getDocument();
                $lang = $document->getField('tutoriel-language')->value;
                if($lang=='fr')
                {
                    $tutoFR[] = $document->getField('tutoriel-id')->value;
                }
                else if($lang=='en')
                {
                    $tutoEN[] = $document->getField('tutoriel-id')->value;
                }
            }
            
            $result = array(
                'tutofr' => $this->get('TutorielModel')->fetchAllFilterByIdAndLang($tutoFR, 'fr', 8),
                'tutoen' => $this->get('TutorielModel')->fetchAllFilterByIdAndLang($tutoEN, 'en', 8),
            );
        }
        
        return array_merge(
            array(
                'tweetsfr' => $this->get('TweetModel')->fetchAllFilterBySearchAndLang($search, 'fr', 3),
            ),
            $result
        );
    }
    
    public function contactAction()
    {
        $form = new Form\Contact();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $formData = $request->getPost()->toArray();
            $form->setData($formData);
            if ($form->isValid()) {
               $formData = $form->getData();
               $message = new Message();
               $message->addTo('blanchon.vincent@gmail.com');
               $message->setFrom($formData['web_identity']['email']);
               $message->setSubject($formData['simple_message']['sujet']);
               $message->setBody($formData['simple_message']['message']);
               try {
                   $email = new Mail();
                   $email->send($message);
               } catch(\RuntimeException $e) {
                    $this->plugin('flashmessenger')->addErrorMessage("Le formulaire est actuellement indisponible, merci d'utiliser l'adresse email contact@zend-framework-2.fr.");
                    return $this->plugin('redirect')->toRoute('contact');
               }
               
               $this->plugin('flashmessenger')->addValidMessage('Merci pour email, une réponse est envoyée sous généralement sous 24h.');
               return $this->plugin('redirect')->toRoute('contact');
            }
            else {
                $form->setData($formData);
                $this->plugin('flashmessenger')->addErrorMessage('Merci de remplir tous les champs du formulaire.');
            }
        }
        
        return array('form' => $form);
    }
    
    public function sitemapAction()
    {
        $this->getResponse()->getHeaders()->addHeaderLine('Content-Type: application/xml');
        
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        
        return $viewModel;
    }
}
