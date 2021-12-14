<?php

namespace App\Controller;

class ArticlesController extends AppController
{
    public function index()
    {
        $this->loadComponent('Paginator');

        $articles = $this->Paginator->paginate($this->Articles->find());

        $this->set(compact('articles'));
    }

    public function view($slug = null)
    {
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        $this->set(compact('article'));
    }

    public function add()
    {
        $article = $this->Articles->newEmptyEntity();

        if($this->request->is('post'))
        {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $article->user_id =$this->request->getAttribute('identity')->getIdentifier();
            if($this->Articles->save($article))
            {
                $this->Flash->success('Your article has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Unable to add your article');
        }

        $this->set(compact('article'));
    }

    public function edit($slug)
    {
        $article = $this->Articles->findBySlug($slug)->firstOrFail();

        if($this->request->is(['post', 'put']))
        {
            $article = $this->Articles->patchEntity($article, $this->request->getData(), [
                'accessibleFields' => ['user_id' => false]
            ]);
            
            if($this->Articles->save($article))
            {
                $this->Flash->success('Your article has been updated.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Unable to update your article');
        }

        $this->set(compact('article'));
    }

    public function delete($slug)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        if($this->Articles->delete($article))
        {
            $this->Flash->success(__('Your "{0}" article has been deleted.', $article->title));
            return $this->redirect(['action' => 'index']);
        }
    }
}