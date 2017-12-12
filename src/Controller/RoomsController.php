<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Rooms Controller
 *
 * @property \App\Model\Table\RoomsTable $Rooms
 *
 * @method \App\Model\Entity\Room[] paginate($object = null, array $settings = [])
 */
class RoomsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $rooms = $this->paginate($this->Rooms);

        $this->set(compact('rooms'));
        $this->set('_serialize', ['rooms']);
    }

    /**
     * View method
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $room = $this->Rooms->get($id, [
            'contain' => ['Showtimes']
        ]);
        
        $auj = strtotime('today');
        $aujmoinsun =strtotime('-1day today');
        $aujmoinsdeux =strtotime('-2days today');
        $aujmoinstrois =strtotime('-3days today');
        $aujplusun =strtotime('+1day today');
        $aujplusdeux =strtotime('+2days today');
        $aujplustrois =strtotime('+3days today');
        $aujplusquatre = strtotime('+4days today');
        
        $moinstrois = TableRegistry::get('Showtimes')->find()
            ->where(['room_id ='=> $id])
            ->where(['start >=' => $aujmoinstrois])
            ->where(['start <='=> $aujmoinsdeux]);
            
        $moinsdeux = TableRegistry::get('Showtimes')->find()
            ->where(['room_id ='=> $id])
            ->where(['start >=' => $aujmoinsdeux])
            ->where(['start <='=> $aujmoinsun]);
        
        $moinsun = TableRegistry::get('Showtimes')->find()
            ->where(['room_id ='=> $id])
            ->where(['start >=' => $aujmoinsun])
            ->where(['start <='=> $auj]);
            
        $today = TableRegistry::get('Showtimes')->find()
            ->where(['room_id ='=> $id])
            ->where(['start >=' => $auj])
            ->where(['start <='=> $aujplusun]);
        
        $plusun = TableRegistry::get('Showtimes')->find()
            ->where(['room_id ='=> $id])
            ->where(['start >=' => $aujplusun])
            ->where(['start <='=> $aujplusdeux]);
        
        $plusdeux = TableRegistry::get('Showtimes')->find()
            ->where(['room_id ='=> $id])
            ->where(['start >=' => $aujplusdeux])
            ->where(['start <='=> $aujplustrois]);
            
        $plustrois = TableRegistry::get('Showtimes')->find()
            ->where(['room_id ='=> $id])
            ->where(['start >=' => $aujplustrois])
            ->where(['start <='=> $aujplusquatre]);
        
        
        
        
        $query = TableRegistry::get('Showtimes')->find()
            ->where(['room_id ='=> $id])
            ->where(['start >=' => $aujmoinstrois])
            ->where(['start <='=> $aujplustrois]);
       
       
       $this->set('moinstrois',$moinstrois);
       $this->set('moinsdeux',$moinsdeux);
       $this->set('moinsun',$moinsun);
       $this->set('auj',$today);
       $this->set('plusun',$plusun);
       $this->set('plusdeux',$plusdeux);
       $this->set('plustrois',$plustrois);  
       
       
       
        $this->set('seances',$query);
        $this->set('room', $room);
        $this->set('_serialize', ['room']);
        
        
        
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $room = $this->Rooms->newEntity();
        if ($this->request->is('post')) {
            $room = $this->Rooms->patchEntity($room, $this->request->getData());
            if ($this->Rooms->save($room)) {
                $this->Flash->success(__('The room has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The room could not be saved. Please, try again.'));
        }
        $this->set(compact('room'));
        $this->set('_serialize', ['room']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $room = $this->Rooms->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $room = $this->Rooms->patchEntity($room, $this->request->getData());
            if ($this->Rooms->save($room)) {
                $this->Flash->success(__('The room has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The room could not be saved. Please, try again.'));
        }
        $this->set(compact('room'));
        $this->set('_serialize', ['room']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $room = $this->Rooms->get($id);
        if ($this->Rooms->delete($room)) {
            $this->Flash->success(__('The room has been deleted.'));
        } else {
            $this->Flash->error(__('The room could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
