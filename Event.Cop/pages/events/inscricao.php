<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
require_once ROOT_PATH . '/data/eventos.php';

$erro      = '';
$id_evento = isset($_GET['id_evento']) ? (int) $_GET['id_evento'] : (isset($_GET['id']) ? (int) $_GET['id'] : 4);
$evento    = evento_por_id($id_evento) ?? evento_por_id(4) ?? eventos_todos()[0];
$id_evento = (int) $evento['id'];

$valorFormatado = $evento['preco'] > 0 ? moeda((float) $evento['preco']) : 'R$ 120,00';

$usuarioLogado = usuario_logado();
$nomePre       = $usuarioLogado['nome']  ?? '';
$emailPre      = $usuarioLogado['email'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome            = trim((string) ($_POST['nome'] ?? ''));
    $email           = trim((string) ($_POST['email'] ?? ''));
    $telefone        = trim((string) ($_POST['telefone'] ?? ''));
    $forma_pagamento = trim((string) ($_POST['forma_pagamento'] ?? 'pix'));
    $id_evento_post  = (int) ($_POST['id_evento'] ?? $id_evento);

    if ($nome !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) && $telefone !== '') {
        if (!esta_logado()) {
            cadastrar_mock('participante', [
                'nome'     => $nome,
                'email'    => $email,
                'telefone' => $telefone,
            ]);
        }

        $_SESSION['ultima_inscricao'] = [
            'id_evento'       => $id_evento_post,
            'nome'            => $nome,
            'email'           => $email,
            'telefone'        => $telefone,
            'forma_pagamento' => $forma_pagamento,
            'codigo'          => '#EC-2026-' . random_int(1000, 9999),
        ];

        flash('ok', 'Inscrição confirmada com sucesso!');
        redirect_to('confirmacao', ['id_evento' => $id_evento_post]);
    } else {
        $erro = 'Por favor, preencha todos os campos obrigatórios com um e-mail válido.';
    }
}

$pageTitle = 'Inscrição - ' . $evento['titulo'] . ' | EventCop';
$pageCss   = ['pages/flow.css'];
$pageJs    = ['pages/flow.js'];
$menuAtivo = 'home';

require ROOT_PATH . '/includes/layout/head.php';
require ROOT_PATH . '/includes/layout/header.php';
?>
<main>
    <section class="banner">
        <div class="banner-texto">
            <h1><?= e($evento['titulo']) ?></h1>
            <p>
                📅 <?= e(data_extenso($evento['data'])) ?> • <?= e($evento['hora_inicio']) ?> às <?= e($evento['hora_fim']) ?><br>
                📍 <?= e(evento_local($evento)) ?><br><br>
                Inscreva-se e receba seu kit de boas-vindas com certificado digital de participação exclusivo!
            </p>
        </div>
    </section>

    <div class="form-wizard">
        <form class="formulario_inscricao_completo" action="<?= route('inscricao', ['id_evento' => $id_evento]) ?>" method="POST">
            <input type="hidden" name="id_evento" value="<?= e((string) $id_evento) ?>">
            <input type="hidden" id="forma_pagamento_selecionada" name="forma_pagamento" value="pix">

            <section class="junta_incriao">
                <section class="cadastro_organizador active">
                    <h1>Inscreva-se Já!</h1>
                    <p>Preencha os dados do participante abaixo para o evento <strong><?= e($evento['titulo']) ?></strong>:</p>

                    <?php if ($erro !== ''): ?>
                        <div class="alert alert-erro"><?= e($erro) ?></div>
                    <?php endif; ?>

                    <div>
                        <label for="nome">Seu Nome Completo:</label>
                        <input type="text" id="nome" name="nome" value="<?= e($_POST['nome'] ?? $nomePre) ?>" placeholder="Digite seu nome completo" required>

                        <label for="email">Seu E-mail:</label>
                        <input type="email" id="email" name="email" value="<?= e($_POST['email'] ?? $emailPre) ?>" placeholder="seuemail@exemplo.com" required>

                        <label for="telefone">Telefone celular / WhatsApp:</label>
                        <input type="tel" id="telefone" name="telefone" placeholder="(11) 99999-9999" value="<?= e($_POST['telefone'] ?? '') ?>" required>
                    </div>
                </section>

                <section class="pagamentos">
                    <h1>Forma de Pagamento</h1>
                    <p>Escolha como deseja confirmar sua inscrição:</p>
                    <div class="formas_pagamento">
                        <div id="pix">
                            <button type="button" class="btn-metodo"><span>Pix</span></button>
                        </div>
                        <div id="cartao">
                            <button type="button" class="btn-metodo"><span>Cartão de Crédito</span></button>
                        </div>
                        <div id="boleto">
                            <button type="button" class="btn-metodo"><span>Boleto</span></button>
                        </div>
                    </div>
                </section>

                <!-- SEÇÃO PIX -->
                <section class="pagamento" id="sec-pix">
                    <div class="pagamento-corpo">
                        <div class="pagamento-formulario">
                            <div class="pagamento-titulo">
                                <h2>Pague com PIX</h2>
                                <p>Escaneie o QR Code ou copie o código Pix abaixo para pagamento imediato.</p>
                            </div>
                            <div class="pix-grupo">
                                <label for="pix-input">Código Pix Copia e Cola:</label>
                                <div class="pix-input-container">
                                    <input type="text" id="pix-input" value="00020126580014br.gov.bcb.pix0136eventcop@eventos.com.br" readonly>
                                    <button type="button" class="btn-copiar" id="copiar-pix">
                                        Copiar código Pix
                                    </button>
                                </div>
                            </div>
                            <div class="alerta-seguranca">
                                <div>
                                    <strong>Pagamento 100% seguro.</strong>
                                    <p>Seus dados estão protegidos pela EventCop.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pagamento-rodape">
                        <div class="rodape-seguranca">
                            <div>
                                <strong>Confirmação Imediata</strong>
                                <p>Liberação automática da credencial.</p>
                            </div>
                        </div>
                        <div class="rodape-total">
                            <span class="label-total">Total da Inscrição:</span>
                            <span class="valor-total"><?= e($valorFormatado) ?></span>
                        </div>
                        <button type="submit" class="btn-finalizar">
                            Finalizar Inscrição via Pix <span>→</span>
                        </button>
                    </div>
                </section>

                <!-- SEÇÃO CARTÃO -->
                <section class="pagamento" id="sec-cartao" hidden>
                    <div class="pagamento-corpo">
                        <div class="pagamento-formulario">
                            <div class="pagamento-titulo">
                                <h2>Pague com Cartão de Crédito</h2>
                                <p>Preencha os dados do seu cartão e finalize sua inscrição com segurança.</p>
                            </div>
                            <div class="campo-grupo">
                                <label for="cartao_numero">Número do Cartão:</label>
                                <input type="text" id="cartao_numero" name="cartao_numero" placeholder="0000 0000 0000 0000" maxlength="19">
                            </div>
                            <div class="div_cep">
                                <div>
                                    <label for="cartao_nome">Nome impresso no cartão:</label>
                                    <input type="text" id="cartao_nome" name="cartao_nome" placeholder="Como está no cartão">
                                </div>
                                <div>
                                    <label for="cartao_validade">Validade e CVV:</label>
                                    <div class="div_cep">
                                        <input type="text" id="cartao_validade" name="cartao_validade" placeholder="MM/AA" maxlength="5">
                                        <input type="text" id="cartao_cvv" name="cartao_cvv" placeholder="CVV" maxlength="4">
                                    </div>
                                </div>
                            </div>
                            <div class="alerta-seguranca">
                                <div>
                                    <strong>Ambiente Criptografado</strong>
                                    <p>Dados protegidos com certificado SSL.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pagamento-rodape">
                        <div class="rodape-total">
                            <span class="label-total">Total da Inscrição:</span>
                            <span class="valor-total"><?= e($valorFormatado) ?></span>
                        </div>
                        <button type="submit" class="btn-finalizar">
                            Finalizar Inscrição no Cartão <span>→</span>
                        </button>
                    </div>
                </section>

                <!-- SEÇÃO BOLETO -->
                <section class="pagamento" id="sec-boleto" hidden>
                    <div class="pagamento-corpo">
                        <div class="pagamento-formulario">
                            <div class="pagamento-titulo">
                                <h2>Pague com Boleto Bancário</h2>
                                <p>Copie a linha digitável para pagar pelo internet banking ou em qualquer lotérica.</p>
                            </div>
                            <div class="pix-grupo">
                                <label for="copia-input">Linha digitável:</label>
                                <div class="pix-input-container">
                                    <input type="text" id="copia-input" value="34191.79000 01043.510047 91020.150008 7 9417000004000" readonly>
                                    <button type="button" class="btn-copiar" id="copiar-boleto">
                                        Copiar linha digitável
                                    </button>
                                </div>
                            </div>
                            <div class="boleto-detalhes">
                                <div class="detalhe-item">
                                    <small>Vencimento:</small>
                                    <strong><?= e(date('d/m/Y', strtotime('+3 days'))) ?></strong>
                                </div>
                                <div class="detalhe-item">
                                    <small>Valor:</small>
                                    <strong><?= e($valorFormatado) ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pagamento-rodape">
                        <div class="rodape-total">
                            <span class="label-total">Total da Inscrição:</span>
                            <span class="valor-total"><?= e($valorFormatado) ?></span>
                        </div>
                        <button type="submit" class="btn-finalizar">
                            Gerar Boleto e Finalizar <span>→</span>
                        </button>
                    </div>
                </section>
            </section>
        </form>
    </div>
</main>
<?php require ROOT_PATH . '/includes/layout/footer.php'; ?>
