<h1>Editar Tarefa</h1>

<!-- Formulário para editar a tarefa -->
<?= $this->Form->create($task, ['type' => 'put']) ?>
<fieldset class="mb-3">
    <legend>Detalhes da Tarefa</legend>

    <!-- Campo de Título -->
    <?= $this->Form->control('title', [
        'label' => 'Título',
        'class' => 'form-control',
        'placeholder' => 'Digite o título da tarefa',
        'required' => true
    ]) ?>

    <!-- Campo de Descrição -->
    <?= $this->Form->control('content', [
        'label' => 'Descrição',
        'class' => 'form-control',
        'placeholder' => 'Digite uma descrição para a tarefa',
        'required' => true
    ]) ?>

    <!-- Campo de Status -->
    <?= $this->Form->control('status', [
        'label' => 'Status',
        'class' => 'form-select',
        'options' => ['pending' => 'Pendente', 'in_progress' => 'Em andamento', 'completed' => 'Concluída'],
        'required' => true
    ]) ?>

    <!-- Campo de Prazo -->
    <?= $this->Form->control('deadline', [
        'label' => 'Prazo',
        'class' => 'form-control',
        'type' => 'date',
        'required' => true
    ]) ?>
</fieldset>

<!-- Botão de Enviar -->
<div class="form-group">
    <?= $this->Form->button('Salvar', ['class' => 'btn btn-primary']) ?>
</div>

<?= $this->Form->end() ?>

<!-- Exibe mensagens de feedback -->
<?= $this->Flash->render() ?>
