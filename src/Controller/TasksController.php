<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\MailService;
use Cake\Http\CallbackStream;
use Cake\Http\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Psr\Http\Message\MessageInterface;

/**
 * Tasks Controller
 *
 * @property \App\Model\Table\TasksTable $Tasks
 */
class TasksController extends AppController
{
    use MailService;

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Tasks->find();

        /** usuario logado */
        $user = $this->Authentication->getIdentity();

        if ($this->request->getQuery('title')) {
            $title = $this->request->getQuery('title');
            $query->where(['title LIKE "%' . $title . '%"', 'content LIKE "%' . $title . '%"']);
        }

        if ($this->request->getQuery('status')) {
            $status = $this->request->getQuery('status');
            $query->where(['status' => $status]);
        }

        if ($this->request->getQuery('date')) {
            $date = $this->request->getQuery('date');
            $query->where(['deadline' => $date]);
        }

        $tasks = $this->paginate($query->where(['user_id' => $user->id]), [
            'limit' => 7,
            'order' => ['id' => 'desc'],
        ]);

        $this->set(compact('tasks', 'user'));

        return $this->render('/Home/index', 'master');
    }

    /**
     * @return \Cake\Http\Response
     */
    public function create(): Response
    {
        /** usuario logado */
        $user = $this->Authentication->getIdentity();

        $task = $this->Tasks->newEmptyEntity();

        /** Se for uma requisicao post */
        if ($this->request->is('post')) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
            $task->user_id = $user->id;
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('Task Salva com sucesso'));
                $this->send($user->email, 'Nova Tarefa', 'Você criou uma tarefa nova');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }

        $this->set(compact('user', 'task'));

        return $this->render('/Home/create', 'master');
    }

    /**
     * @return \Cake\Http\Response|\Psr\Http\Message\MessageInterface
     */
    public function export(): MessageInterface|Response
    {
        $this->autoRender = false;

        $tasks = $this->Tasks->find('all');

        // Criar planilha
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Preenchendo os dados
        $sheet->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'Título')
            ->setCellValue('C1', 'Descrição')
            ->setCellValue('D1', 'Status')
            ->setCellValue('E1', 'Prazo');

        $row = 2;
        foreach ($tasks as $task) {
            $sheet->setCellValue('A' . $row, $task->id)
                ->setCellValue('B' . $row, $task->title)
                ->setCellValue('C' . $row, $task->content)
                ->setCellValue('D' . $row, $task->status)
                ->setCellValue('E' . $row, $task->deadline->i18nFormat('dd/MM/yyyy'));
            $row++;
        }

        // Criar escritor Excel
        $writer = new Xlsx($spreadsheet);

        // Save the file in a stream
        $stream = new CallbackStream(function () use ($writer) {
            $writer->save('php://output');
        });

        $filename = 'tasks';
        $response = $this->response;

        return $response->withType('xlsx')
            ->withHeader('Content-Disposition', "attachment;filename=\"{$filename}.xlsx\"")
            ->withBody($stream);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $task = $this->Tasks->newEmptyEntity();

        /** Se for uma requisicao post */
        if ($this->request->is('post')) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }

        /** Se for uma requisicao GET */
        $users = $this->Tasks->Users->find('list', limit: 200)->all();
        $this->set(compact('task', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \App\Controller\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $user = $this->Authentication->getIdentity();
        $task = $this->Tasks->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }

        $this->set(compact('task', 'user'));

        return $this->render('/Home/edit', 'master');
    }

    /**
     * Delete method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \App\Controller\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null): ?Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $task = $this->Tasks->get($id);
        if ($this->Tasks->delete($task)) {
            $this->Flash->success(__('The task has been deleted.'));
        } else {
            $this->Flash->error(__('The task could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
