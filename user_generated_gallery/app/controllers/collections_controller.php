<?php
class CollectionsController extends AppController {

	var $name = 'Collections';

  function beforeFilter() {
    parent::beforeFilter(); 
    $this->Auth->allowedActions = array('index', 'view');
  }
	
  function index() {
		$this->Collection->recursive = 0;
		$this->set('collections', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid collection', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('collection', $this->Collection->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Collection->create();
			if ($this->Collection->save($this->data)) {
				$this->Session->setFlash(__('The collection has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The collection could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Collection->User->find('list');
		$users = $this->Collection->User->find('list');
		$videos = $this->Collection->Video->find('list');
		$this->set(compact('users', 'users', 'videos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid collection', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Collection->save($this->data)) {
				$this->Session->setFlash(__('The collection has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The collection could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Collection->read(null, $id);
		}
		$users = $this->Collection->User->find('list');
		$users = $this->Collection->User->find('list');
		$videos = $this->Collection->Video->find('list');
		$this->set(compact('users', 'users', 'videos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for collection', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Collection->delete($id)) {
			$this->Session->setFlash(__('Collection deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Collection was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
