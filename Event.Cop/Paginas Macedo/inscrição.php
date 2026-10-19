<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Usuário - EventCop</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<header class="header">
    <a href="index.php">
        <img src="../imgs/logonv.jpeg" alt="EventCop" class="logo-header">
    </a>
    <nav class="menu">
        <ul>
            <li><a href="../Paginas Leticia/index.php">Home</a></li>
            <li><a href="../Paginas Leticia/empresas.php">EventCop Empresas</a></li>
            <li><a href="../Paginas Leticia/cases.php">Cases</a></li>
            <li><a href="../Paginas Leticia/planos_preços">Planos e Preços</a></li>
            <li><a href="">Sou um organizador</a></li>
            <li><a href="" class="btn-header">Criar Evento</a></li>
        </ul>
    </nav>
</header>
<main>
    <section class="banner">
        <div class="banner-texto">
            <p>Inscreva-se e receba seu kit Event</p>
        </div>
    </section>

    <div class="form-wizard">
        <section class="junta_incriçao">
            <section class="cadastro_organizador active">
                <h1>Inscreva-se já!</h1>
                <form class="formulario_organizador" action="cadastro_organizador.php" method="POST">
                    <label for="nome_increso">Seu nome:</label>
                    <input type="text" id="nome" name="nome" required>
                    <label for="email">Seu e-mail</label>
                    <input type="email" id="email" name="email" required> 
                    <label for="telefone">Telefone</label>
                    <input type="tel" id="telefone" name="telefone" placeholder="(_ _)_ _ _ _ _-_ _ _ _" required>
                </form>
            </section>
            <section class="pagamentos">
                <h1>Forma de Pagamento</h1>
                <p>Escolha a forma de pagamento</p>
                <div class="formas_pagamento">
                    <div id="pix">
                        <button type="button" onclick="mostrarPagamento('pix')"><span>Pix</span></button>
                    </div>
                    <div id="cartao">
                        <button type="button" onclick="mostrarPagamento('cartao')"><span>Cartão de Crédito</span></button>
                    </div>
                    <div id="boleto">
                        <button type="button" onclick="mostrarPagamento('boleto')"><span>Boleto</span></button>
                    </div>
                </div>
            </section>
            <section class="pagamento" id="sec-cartao" hidden>
                <div class="pagamento-corpo">
                    <div class="pagamento-formulario">
                        <div class="pagamento-titulo">
                            <h2>Pague com cartão de crédito</h2>
                            <p>Preencha os dados do seu cartão e finalize sua inscrição com segurança.</p>
                        </div>
                        <div class="campo-grupo">
                            <input type="text" placeholder="Número do cartão" required maxlength="19">
                        </div>  
                        <div class="grupinho">
                            <input type="text" placeholder="Nome do cartão" required maxlength="19">
                            <input type="text" placeholder="Validade" required maxlength="19">
                            <input type="text" placeholder="CVV" required maxlength="19">
                            <input type="text" placeholder="" required maxlength="19">
                        </div>
                        <div class="alerta-seguranca">
                            <div>
                                <strong>Pagamento 100% seguro.</strong>
                                <p>Seus dados estão protegidos.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pagamento-rodape">
                    <div class="rodape-seguranca">
                        <div>
                            <strong>Pagamento seguro</strong>
                            <p>Seus dados estão protegidos.</p>
                        </div>
                    </div>
                    <div class="rodape-total">
                        <span class="label-total">Total da inscrição</span>
                        <span class="valor-total">R$ 40,00</span>
                    </div>
                    <button type="submit" class="btn-finalizar"> Finalizar inscrição <span>&rarr;</span></button>
                </div>
            </section>

            <section class="pagamento" id="sec-pix" hidden>
                <div class="pagamento-corpo">
                    <div class="pagamento-formulario">
                        <div class="pagamento-titulo">
                            <h2>Pague com PIX</h2>
                            <p>Escaneie o QR Code com o app do seu banco ou copie o código abaixo e cole no seu aplicativo.</p>
                        </div>
                        <div class="pix-grupo">
                            <label>Código PIX</label>
                            <div class="pix-input-container">
                                <input type="text" value="00020126580014br.gov.bcb.pix0136eventcop@eventos.com" readonly>
                                <button type="button" class="btn-copiar" id="copiar"> <span class="icone-copiar" onclick="copiarCodigo()"></span> Copiar código</button>
                            </div>
                        </div>
                        <div class="alerta-seguranca">
                            <div>
                                <strong>Pagamento 100% seguro.</strong>
                                <p>Seus dados estão protegidos.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pagamento-rodape">
                    <div class="rodape-seguranca">
                        <div>
                            <strong>Pagamento seguro</strong>
                            <p>Seus dados estão protegidos.</p>
                        </div>
                    </div>
                    <div class="rodape-total">
                        <span class="label-total">Total da inscrição</span>
                        <span class="valor-total">R$ 40,00</span>
                    </div>
                    <button type="submit" class="btn-finalizar">
                        Finalizar inscrição <span>&rarr;</span>
                    </button>
                </div>
            </section>

            <section class="pagamento" id="sec-boleto" hidden>
                <div class="pagamento-corpo">
                    <div class="pagamento-formulario">
                        <div class="pagamento-titulo">
                            <h2>Pague com boleto</h2>
                            <p>Escaneie o código de barras no seu banco ou copie a linha digitável para pagar em qualquer banco, lotérica ou app.</p>
                        </div>
                        <div class="boleto-barras-container">
                        <div class="linhas-barras">
                            <span></span><span></span><span></span><span></span><span></span>
                        </div>
                        <div class="boleto-instrucao-scan">
                            <p>Escaneie pelo app do seu banco</p>
                        </div>
                    </div>
                    <div class="pix-grupo">
                        <label>Linha digitável</label>
                        <div class="pix-input-container">
                            <input type="text" id="copia-input" value="34191.79000 01043.510047 91020.150008 7 9417000004000" readonly>
                            <br>
                            <button type="button" class="btn-copiar" id="copiar" onclick="copiarCodigo()">
                                <span class="texto-botao">Copiar código</span>
                            </button>
                        </div>
                    </div>
                    <div class="boleto-detalhes">
                        <div class="detalhe-item">
                            <span class="icone-detalhe"></span>
                            <div>
                                <small>Vencimento</small>
                                <strong>20/09/2026</strong>
                            </div>
                        </div>
                        <div class="detalhe-item">
                            <span class="icone-detalhe"></span>
                            <div>
                                <small>Valor</small>
                                <strong>R$ 40,00</strong>
                            </div>
                        </div>
                        <div class="detalhe-item aviso-compensacao">
                            <span class="icone-detalhe"></span>
                            <p>O pagamento pode levar até 3 dias úteis para ser compensado.</p>
                        </div>
                    </div>
                </div>
            </div>
                <div class="pagamento-rodape">
                    <div class="rodape-seguranca">
                        <div>
                            <strong>Pagamento seguro</strong>
                            <p>Seus dados estão protegidos.</p>
                        </div>
                    </div>
                    <div class="rodape-total">
                        <span class="label-total">Total da inscrição</span>
                        <span class="valor-total">R$ 40,00</span>
                    </div>
                    <button type="submit" class="btn-finalizar">
                        Finalizar inscrição <span>&rarr;</span>
                    </button>
                </div>
            </section>
        </section>
    </div>
</main>

</body>
</html>