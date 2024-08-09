<?php
require_once "../dependencies/config.php";

// Consulta para pegar os empréstimos
$query = "SELECT aluno.nome_completo, turma.nome_identificacao, livros.titulo_livro, 
          DATEDIFF(emprestimos.data_devolucao, emprestimos.data_emprestimo) AS dias,
          DATE(emprestimos.data_devolucao) AS prazo 
          FROM emprestimos 
          JOIN aluno ON emprestimos.aluno_id = aluno.id 
          JOIN livros ON emprestimos.titulo_livro = livros.titulo_livro 
          JOIN turma ON aluno.sala_identificacao = turma.nome_identificacao 
          WHERE aluno.curso = turma.curso";

$stmt = $conn->prepare($query);
$stmt->execute();
$emprestimos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="Css/indextb.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"></head>

<body>
    <header>

        <nav>
            <aside id="menu-Oculto" class="menu-Oculto">
                <div class="imagemMenu">
                    <img src="img/logoMenu.png" alt="" class="logoMenu">
                    <button class="fechar" href="" onclick="fecharMenu()"> <i class="fa-solid fa-chevron-left"></i></i></button>
                        
                </div>
                    
                <div class="linha"></div>
                <div class="opcoes">
        
                    <a href=""><i class="fa-solid fa-file"></i> Cadastrar Livro</a>
                    <a href=""><i class="fa-solid fa-book-open-reader"></i> Cadastrar Empréstimo</a>
                    <a href=""><i class="fa-solid fa-book-bookmark"></i> Banco de Livros</a>
                    <a href=""><i class="fa-brands fa-leanpub"></i> Empréstimos</a>
                    <a href=""><i class="fa-solid fa-user-plus"></i></i> Adicionar Turma</a>
                    <a href=""><i class="fa-solid fa-address-book"></i>   Pedidos</a>
                    <a href=""><i class="fa-solid fa-file-import"></i> Relatório</a>
                    <a href="" class="sair"><i class="fa-solid fa-circle-xmark"></i>  Sair</a>
                </div>
                    
            </aside>
            <section id="principal">
                <span style="font-size:30px;cursor:pointer"onclick="abrirMenu()">&#9776;</span>
                <div class="nav-logo">
                    <img  src="img/logoEEEP.png" alt="logo" class="logo_eeep"/>
                    <div class="ret"></div>
                    <img src="img/logoNav.png" alt="logo" class="library"/>
                </div>
        
            </section>
        </nav>
        
        
    </header>
    <div class="container">
        <div class="cabecario">
            <h1 class="title">EMPRÉSTIMOS </h1>
            
            <div class="search-container">
                <div class="search-box">
                    <div class="search-inner"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</div>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-button" style="background-color:#C9C9C9;" >TURMA</button>
                <div class="dropdown-content">
                    <a href="#">1° ANO</a>
                    <a href="#">2° ANO</a>
                    <a href="#">3° ANO</a>
                </div>
            </div>
            
            <div class="dropdown">
                <button class="dropdown-button" style="background-color:#C9C9C9;">CURSO</button>
                <div class="dropdown-content">
                    <a href="#">ENFERMAGEM</a>
                    <a href="#">INFORMÁTICA</a>
                    <a href="#">COMÉRCIO</a>
                    <a href="#">ADMINISTRAÇÃO</a>
                </div>
            </div>
            <button class="print-button"><i class="fa-solid fa-print">  </i>   RELATÓRIO</button>
        </div>
        
        <table id="booksTable">
            <thead>
                <tr>
                    <th>NOME DO ALUNO</th>
                    <th>TURMA</th>
                    <th>NOME DO LIVRO</th>
                    <th>DIAS</th>
                    <th>PRAZO</th>
                    <th>MAIS INFORMAÇÕES</th>
                    <th>RENOVAR</th>
                    <th>APAGAR</th>
                </tr>
            </thead>
            <tbody>
    <?php foreach ($emprestimos as $emprestimo): ?>
        <tr>
            <td><?php echo htmlspecialchars($emprestimo['nome_completo']); ?></td>
            <td><?php echo htmlspecialchars($emprestimo['nome_identificacao']); ?></td>
            <td><?php echo htmlspecialchars($emprestimo['titulo_livro']); ?></td>
            <td class="days"><?php echo htmlspecialchars($emprestimo['dias']); ?></td>
            <td><?php echo htmlspecialchars($emprestimo['prazo']); ?></td>
            <td><button class="icon-button"><i class="fa-solid fa-file-lines"></i></button></td>
            <td><button class="icon-button"><i class="fa-regular fa-calendar"></i></button></td>
            <td><button class="icon-button"><i class="fa-solid fa-trash"></i></button></td>
        </tr>
    <?php endforeach; ?>
</tbody>  
    <script type="text/javascript"  src="scripts.js"></script>
</body>

</html>