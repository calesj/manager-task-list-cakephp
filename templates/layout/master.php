<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <?= $this->Html->css('frontend/style.css') ?>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Gerenciador</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Exibir Login ou Nome do Usuário -->
                <li class="nav-item">
                        <span class="navbar-text text-white">
                            Bem-vindo, <?= $user->name ?>
                        </span>
                </li>
                <li class="nav-item">
                    <!-- Botão de Logout -->
                    <span class="navbar-text text-white">
                        <?= $this->Form->postLink('Sair', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link']) ?>
                    </span>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-3">
    <?= $this->Flash->render() ?>
</div>

<!-- Main Content -->
<main class="container mt-4">
    <?= $this->fetch('content') ?>
</main>

<!-- Footer -->
<footer class="bg-dark text-light text-center py-3 mt-5">
    <p>Gerenciador de Tarefas © 2024</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
