<?php
// Processador de Cadastro de Eventos - EventCop
require_once "../Paginas Vitoria/config.php";
require_once "../Paginas Vitoria/auth.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verificar se o organizador está autenticado
    if (!estaLogado() || !ehOrganizador()) {
        // Redireciona com aviso para fazer login de organizador
        header("Location: login_organizadores.php?aviso=faca_login");
        exit;
    }

    $id_orga = $_SESSION["user_id"];
    $nome_evento = trim($_POST["nome_evento"] ?? "");
    $descricao = trim($_POST["descricao"] ?? "");
    $categoria = $_POST["categoria"] ?? "1";
    $formato = $_POST["formato"] ?? "presencial";
    $cidade = trim($_POST["cidade"] ?? "São José dos Campos");
    $estado = strtoupper(trim($_POST["estado"] ?? "SP"));
    $tipo = $_POST["tipo"] ?? "1";

    // Tratar data e hora
    $data_inicio_raw = $_POST["data_inicio"] ?? "";
    if (!empty($data_inicio_raw)) {
        $timestamp = strtotime($data_inicio_raw);
        $data_event = date("Y-m-d", $timestamp);
        $hora_event = date("H:i:s", $timestamp);
    } else {
        $data_event = date("Y-m-d", strtotime("+7 days"));
        $hora_event = "14:00:00";
    }

    // Garantir formato dentro do ENUM ('presencial','online','hibrido')
    if (!in_array($formato, ['presencial', 'online', 'hibrido'])) {
        $formato = 'presencial';
    }

    // Garantir categoria dentro do ENUM ('1','2','3','4')
    if (!in_array($categoria, ['1', '2', '3', '4'])) {
        $categoria = '1';
    }

    // Garantir tipo dentro do ENUM ('1','2')
    if (!in_array($tipo, ['1', '2'])) {
        $tipo = '1';
    }

    if (!empty($nome_evento) && !empty($descricao)) {
        try {
            $sql = "INSERT INTO eventos (nome_event, descricao, cidade, estado, tipo, categoria, formato, id_orga, data_event, hora_event)
                    VALUES (:nome, :descricao, :cidade, :estado, :tipo, :categoria, :formato, :id_orga, :data_event, :hora_event)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome_evento, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
            $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
            $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            $stmt->bindParam(':formato', $formato, PDO::PARAM_STR);
            $stmt->bindParam(':id_orga', $id_orga, PDO::PARAM_INT);
            $stmt->bindParam(':data_event', $data_event, PDO::PARAM_STR);
            $stmt->bindParam(':hora_event', $hora_event, PDO::PARAM_STR);
            $stmt->execute();

            header("Location: criar_evento.php?criado=sucesso");
            exit;
        } catch (PDOException $e) {
            error_log("Erro ao salvar evento: " . $e->getMessage());
            header("Location: criar_evento.php?erro=falha_ao_salvar");
            exit;
        }
    } else {
        header("Location: criar_evento.php?erro=campos_obrigatorios");
        exit;
    }
} else {
    header("Location: criar_evento.php");
    exit;
}
