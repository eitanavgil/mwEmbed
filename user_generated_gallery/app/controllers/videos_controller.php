<?php
class VideosController extends AppController {

	var $name = 'Videos';

  function beforeFilter() {
    parent::beforeFilter(); 
    $this->Auth->allowedActions = array('index', 'view');
  }

	function index() {
		$this->Video->recursive = 0;
		$this->set('videos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid video', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('video', $this->Video->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Video->create();
			if ($this->Video->save($this->data)) {
				$this->Session->setFlash(__('The video has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The video could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Video->User->find('list');
		$collections = $this->Video->Collection->find('list');
		$this->set(compact('users', 'collections'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid video', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Video->save($this->data)) {
				$this->Session->setFlash(__('The video has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The video could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Video->read(null, $id);
		}
		$users = $this->Video->User->find('list');
		$collections = $this->Video->Collection->find('list');
		$this->set(compact('users', 'collections'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for video', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Video->delete($id)) {
			$this->Session->setFlash(__('Video deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Video was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
