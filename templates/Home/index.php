<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4">Tarefas</h1>

        <div style="display: flex; justify-content: space-between; margin-bottom: 1rem">
            <div>
                <a href="<?= $this->Url->build(['controller' => 'Tasks', 'action' => 'export']) ?>"
                   class="btn btn-warning">Exportar Excel</a>
            </div>

            <div>
                <a href="<?= $this->Url->build(['controller' => 'Tasks', 'action' => 'create']) ?>" class="btn btn-primary" style="justify-content: flex-end;">Cadastrar tarefa</a>
            </div>
        </div>

        <!-- Filtros -->
        <form class="row mb-3" method="GET" action="">
            <div class="col-md-4">
                <input type="text" name="title" value="<?= $this->request->getQuery('title') ?: '' ?>"
                       class="form-control" placeholder="Buscar por título">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Todas</option>
                    <?php $status = $this->request->getQuery('status'); ?>
                    <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Concluída</option>
                    <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Pendente</option>
                    <option value="in_progress" <?= $status === 'in_progress' ? 'selected' : '' ?>>Em andamento</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" value="<?= $this->request->getQuery('date') ?: '' ?>" name="date"
                       class="form-control">
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </form>

        <div class="mb-3">
    <span class="sort">
        <?php echo $this->Paginator->sort('title', 'Título', ['class' => 'btn btn-link']); ?>
    </span>
            <span class="sort">
        <?php echo $this->Paginator->sort('status', 'Status', ['class' => 'btn btn-link']); ?>
    </span>
            <span class="sort">
        <?php echo $this->Paginator->sort('deadline', 'Prazo', ['class' => 'btn btn-link']); ?>
    </span>
        </div>

        <!-- Tabela de Tarefas -->
        <table class="table table-bordered">
            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Prazo</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <!-- Tarefas -->
            <?php foreach ($tasks as $task) : ?>
                <tr>
                    <td><?= $task->id ?></td>
                    <td><?= $task->title ?></td>
                    <td><?= $task->content ?></td>
                    <td>
                        <span class="badge
                                    <?= $task->status === 'pending' ? 'bg-warning' : ($task->status === 'in_progress' ? 'bg-primary' : 'bg-success') ?>">
                                    <?= $task->status ?>
                        </span>
                    </td>
                    <td>
                        <?= $task->deadline->i18nFormat('dd/MM/yyyy') ?>
                    </td>
                    <td>
                        <a href="/tasks/edit/<?= $task->id ?>" class="btn btn-warning btn-sm">Editar</a>

                        <?= $this->Form->postLink(
                            'Excluir',
                            ['action' => 'delete', $task->id],
                            ['class' => 'btn btn-danger btn-sm', 'confirm' => 'Tem certeza de que deseja excluir esta tarefa?']
                        ) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>

<?php echo $this->element('paginator/index') ?>
