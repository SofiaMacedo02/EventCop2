<?php
/**
 * "Banco" FAKE do módulo do Organizador (Sprint 2).
 * Fornece métricas do dashboard, relatórios por evento, dados financeiros,
 * pagamentos recentes e pendências da organizadora Marina Oliveira.
 */

/**
 * Retorna os eventos criados na sessão (via criar-evento.php).
 * @return array<int,array<string,mixed>>
 */
function organizador_eventos_sessao(): array
{
    return $_SESSION['eventos_criados'] ?? [];
}

/**
 * KPIs do Dashboard principal (dashboard.png).
 */
function organizador_dashboard_kpis(): array
{
    $extras = count(organizador_eventos_sessao());
    return [
        [
            'id'        => 'criados',
            'valor'     => 3 + $extras,
            'pad'       => 2,
            'badge'     => sprintf('%02d Eventos criados', 3 + $extras),
            'descricao' => 'Desde que você entrou no EventCop',
            'cor'       => 'vinho',
            'icone'     => 'calendar',
        ],
        [
            'id'        => 'andamento',
            'valor'     => 2 + $extras,
            'pad'       => 2,
            'badge'     => sprintf('%02d Em andamento', 2 + $extras),
            'descricao' => 'Eventos ativos no momento',
            'cor'       => 'verde',
            'icone'     => 'play',
        ],
        [
            'id'        => 'finalizados',
            'valor'     => 1,
            'pad'       => 2,
            'badge'     => '01 Finalizados',
            'descricao' => 'Eventos concluídos com sucesso',
            'cor'       => 'roxo',
            'icone'     => 'check',
        ],
        [
            'id'        => 'participantes',
            'valor'     => 770,
            'pad'       => 0,
            'badge'     => '770 Participantes',
            'descricao' => 'Total de participantes em todos os eventos',
            'cor'       => 'laranja',
            'icone'     => 'users',
        ],
    ];
}

/**
 * Barras verticais do card "Resumo dos resultados - Participantes por evento" no Dashboard.
 */
function organizador_dashboard_resultados(): array
{
    $base = [
        [
            'slug'          => 'workshop-tecnologia-2026',
            'titulo'        => 'Workshop de Tecnologia 2026',
            'linhas_rotulo' => ['Workshop de', 'Tecnologia 2026'],
            'participantes' => 320,
            'cor'           => 'vinho',
            'altura_pct'    => 100,
        ],
        [
            'slug'          => 'congresso-inovacao-2026',
            'titulo'        => 'Congresso de Inovação 2026',
            'linhas_rotulo' => ['Congresso de', 'Inovação 2026'],
            'participantes' => 160,
            'cor'           => 'laranja',
            'altura_pct'    => 52,
        ],
        [
            'slug'          => 'palestra-marketing',
            'titulo'        => 'Palestra de Marketing',
            'linhas_rotulo' => ['Palestra de', 'Marketing'],
            'participantes' => 0,
            'cor'           => 'vazio',
            'altura_pct'    => 4,
        ],
    ];

    foreach (organizador_eventos_sessao() as $ev) {
        $base[] = [
            'slug'          => 'evento-' . ($ev['id'] ?? uniqid()),
            'titulo'        => (string) ($ev['titulo'] ?? 'Novo Evento'),
            'linhas_rotulo' => [mb_strimwidth((string) ($ev['titulo'] ?? 'Novo Evento'), 0, 18, '…'), 'Recém-criado'],
            'participantes' => (int) ($ev['confirmados'] ?? 0),
            'cor'           => 'laranja',
            'altura_pct'    => max(8, min(100, (int) round(((int) ($ev['confirmados'] ?? 0) / 320) * 100))),
        ];
    }

    return $base;
}

/**
 * Atalhos do card "Acesso rápido" no Dashboard.
 */
function organizador_atalhos_rapidos(): array
{
    return [
        [
            'titulo'    => 'Relatórios e métricas',
            'subtitulo' => 'Acompanhe os resultados dos seus eventos.',
            'rota'      => 'relatorios',
            'icone'     => 'chart',
        ],
        [
            'titulo'    => 'Pagamentos e pendências',
            'subtitulo' => 'Gerencie faturas e valores recebidos.',
            'rota'      => 'pagamentos',
            'icone'     => 'wallet',
        ],
        [
            'titulo'    => 'Criar novo evento',
            'subtitulo' => 'Configure e publique um novo evento na plataforma.',
            'rota'      => 'criar_evento',
            'icone'     => 'plus',
        ],
        [
            'titulo'    => 'Emitir certificados',
            'subtitulo' => 'Personalize e gere certificados para participantes.',
            'rota'      => 'certificados',
            'icone'     => 'award',
        ],
    ];
}

/**
 * Dados completos de Relatórios e Métricas por evento (relatorios e metricas.png).
 */
function organizador_relatorios_por_evento(): array
{
    return [
        'workshop-tecnologia-2026' => [
            'slug'   => 'workshop-tecnologia-2026',
            'titulo' => 'Workshop de Tecnologia 2026',
            'kpis'   => [
                'inscritos'     => 320,
                'participantes' => 248,
                'taxa_presenca' => 77.5,
                'avaliacao'     => 4.7,
            ],
            'evolucao' => [
                ['data' => '01/09', 'valor' => 60],
                ['data' => '05/09', 'valor' => 110],
                ['data' => '10/09', 'valor' => 160],
                ['data' => '15/09', 'valor' => 210],
                ['data' => '20/09', 'valor' => 270],
                ['data' => '25/09', 'valor' => 320],
            ],
            'comparativo' => [
                ['rotulo' => 'Inscritos',   'valor' => 320, 'max' => 350, 'cor' => 'vinho'],
                ['rotulo' => 'Confirmados', 'valor' => 280, 'max' => 350, 'cor' => 'laranja'],
                ['rotulo' => 'Presentes',   'valor' => 248, 'max' => 350, 'cor' => 'laranja-escuro'],
                ['rotulo' => 'Ausentes',    'valor' => 32,  'max' => 350, 'cor' => 'cinza'],
            ],
            'avaliacao' => [
                'media'        => '4,7',
                'respondentes' => 210,
                'estrelas'     => [
                    5 => 62,
                    4 => 27,
                    3 => 8,
                    2 => 2,
                    1 => 1,
                ],
            ],
            'interacoes' => [
                'comentarios' => 184,
                'reacoes'     => 326,
                'perguntas'   => 47,
                'pesquisas'   => 210,
            ],
            'insights' => [
                [
                    'icone'  => 'chart',
                    'cor'    => 'laranja',
                    'titulo' => 'Alta participação',
                    'texto'  => 'A taxa de presença foi de 77,5%, indicando um bom nível de participação.',
                ],
                [
                    'icone'  => 'star',
                    'cor'    => 'vinho',
                    'titulo' => 'Boa avaliação',
                    'texto'  => 'O evento recebeu uma avaliação média de 4,7/5 entre os participantes.',
                ],
                [
                    'icone'  => 'chat',
                    'cor'    => 'vinho',
                    'titulo' => 'Participação ativa',
                    'texto'  => 'Mais de 500 interações foram registradas durante o evento.',
                ],
            ],
        ],
        'congresso-inovacao-2026' => [
            'slug'   => 'congresso-inovacao-2026',
            'titulo' => 'Congresso de Inovação 2026',
            'kpis'   => [
                'inscritos'     => 160,
                'participantes' => 136,
                'taxa_presenca' => 85.0,
                'avaliacao'     => 4.9,
            ],
            'evolucao' => [
                ['data' => '01/09', 'valor' => 25],
                ['data' => '05/09', 'valor' => 52],
                ['data' => '10/09', 'valor' => 84],
                ['data' => '15/09', 'valor' => 112],
                ['data' => '20/09', 'valor' => 138],
                ['data' => '25/09', 'valor' => 160],
            ],
            'comparativo' => [
                ['rotulo' => 'Inscritos',   'valor' => 160, 'max' => 200, 'cor' => 'vinho'],
                ['rotulo' => 'Confirmados', 'valor' => 148, 'max' => 200, 'cor' => 'laranja'],
                ['rotulo' => 'Presentes',   'valor' => 136, 'max' => 200, 'cor' => 'laranja-escuro'],
                ['rotulo' => 'Ausentes',    'valor' => 12,  'max' => 200, 'cor' => 'cinza'],
            ],
            'avaliacao' => [
                'media'        => '4,9',
                'respondentes' => 120,
                'estrelas'     => [
                    5 => 78,
                    4 => 16,
                    3 => 4,
                    2 => 1,
                    1 => 1,
                ],
            ],
            'interacoes' => [
                'comentarios' => 142,
                'reacoes'     => 280,
                'perguntas'   => 39,
                'pesquisas'   => 120,
            ],
            'insights' => [
                [
                    'icone'  => 'chart',
                    'cor'    => 'laranja',
                    'titulo' => 'Alta participação',
                    'texto'  => 'A taxa de presença foi de 85,0%, superando a meta estipulada para o congresso.',
                ],
                [
                    'icone'  => 'star',
                    'cor'    => 'vinho',
                    'titulo' => 'Boa avaliação',
                    'texto'  => 'O evento recebeu uma avaliação média de 4,9/5 entre os participantes.',
                ],
                [
                    'icone'  => 'chat',
                    'cor'    => 'vinho',
                    'titulo' => 'Participação ativa',
                    'texto'  => 'Mais de 460 interações foram registradas durante os painéis de inovação.',
                ],
            ],
        ],
        'palestra-marketing' => [
            'slug'   => 'palestra-marketing',
            'titulo' => 'Palestra de Marketing',
            'kpis'   => [
                'inscritos'     => 90,
                'participantes' => 72,
                'taxa_presenca' => 80.0,
                'avaliacao'     => 4.6,
            ],
            'evolucao' => [
                ['data' => '01/09', 'valor' => 12],
                ['data' => '05/09', 'valor' => 26],
                ['data' => '10/09', 'valor' => 44],
                ['data' => '15/09', 'valor' => 60],
                ['data' => '20/09', 'valor' => 76],
                ['data' => '25/09', 'valor' => 90],
            ],
            'comparativo' => [
                ['rotulo' => 'Inscritos',   'valor' => 90, 'max' => 120, 'cor' => 'vinho'],
                ['rotulo' => 'Confirmados', 'valor' => 82, 'max' => 120, 'cor' => 'laranja'],
                ['rotulo' => 'Presentes',   'valor' => 72, 'max' => 120, 'cor' => 'laranja-escuro'],
                ['rotulo' => 'Ausentes',    'valor' => 10, 'max' => 120, 'cor' => 'cinza'],
            ],
            'avaliacao' => [
                'media'        => '4,6',
                'respondentes' => 64,
                'estrelas'     => [
                    5 => 58,
                    4 => 28,
                    3 => 10,
                    2 => 3,
                    1 => 1,
                ],
            ],
            'interacoes' => [
                'comentarios' => 65,
                'reacoes'     => 140,
                'perguntas'   => 22,
                'pesquisas'   => 64,
            ],
            'insights' => [
                [
                    'icone'  => 'chart',
                    'cor'    => 'laranja',
                    'titulo' => 'Alta participação',
                    'texto'  => 'A taxa de presença foi de 80,0%, excelente índice para eventos noturnos.',
                ],
                [
                    'icone'  => 'star',
                    'cor'    => 'vinho',
                    'titulo' => 'Boa avaliação',
                    'texto'  => 'O evento recebeu uma avaliação média de 4,6/5 entre os participantes.',
                ],
                [
                    'icone'  => 'chat',
                    'cor'    => 'vinho',
                    'titulo' => 'Participação ativa',
                    'texto'  => 'Mais de 220 interações foram registradas durante a palestra.',
                ],
            ],
        ],
    ];
}

/**
 * KPIs financeiros do topo da página Pagamentos e pendências (pagamentos e pendencias.png).
 */
function organizador_pagamentos_kpis(): array
{
    return [
        [
            'id'        => 'receita_total',
            'rotulo'    => 'Receita total',
            'valor'     => 287450.00,
            'tendencia' => '↑ 18% em relação ao mês anterior',
            'cor'       => 'vinho',
            'icone'     => 'wallet',
        ],
        [
            'id'        => 'recebido',
            'rotulo'    => 'Recebido',
            'valor'     => 263780.00,
            'tendencia' => '↑ 16% em relação ao mês anterior',
            'cor'       => 'verde',
            'icone'     => 'check',
        ],
        [
            'id'        => 'pendente',
            'rotulo'    => 'Pendente',
            'valor'     => 21350.00,
            'tendencia' => '↓ 8% em relação ao mês anterior',
            'cor'       => 'laranja',
            'icone'     => 'clock',
        ],
        [
            'id'        => 'estornado',
            'rotulo'    => 'Estornado',
            'valor'     => 2320.00,
            'tendencia' => '↓ 12% em relação ao mês anterior',
            'cor'       => 'vermelho',
            'icone'     => 'refund',
        ],
    ];
}

/**
 * Receitas mensais (em milhares de R$) para o gráfico de barras empilhadas Jan–Dez.
 */
function organizador_receitas_mensais(): array
{
    return [
        '2026' => [
            ['mes' => 'Jan', 'recebido' => 14, 'pendente' => 3, 'estornado' => 1],
            ['mes' => 'Fev', 'recebido' => 20, 'pendente' => 3, 'estornado' => 1],
            ['mes' => 'Mar', 'recebido' => 26, 'pendente' => 4, 'estornado' => 1],
            ['mes' => 'Abr', 'recebido' => 22, 'pendente' => 3, 'estornado' => 1],
            ['mes' => 'Mai', 'recebido' => 34, 'pendente' => 5, 'estornado' => 2],
            ['mes' => 'Jun', 'recebido' => 30, 'pendente' => 4, 'estornado' => 1],
            ['mes' => 'Jul', 'recebido' => 42, 'pendente' => 6, 'estornado' => 2],
            ['mes' => 'Ago', 'recebido' => 36, 'pendente' => 5, 'estornado' => 2],
            ['mes' => 'Set', 'recebido' => 46, 'pendente' => 7, 'estornado' => 2],
            ['mes' => 'Out', 'recebido' => 52, 'pendente' => 8, 'estornado' => 2],
            ['mes' => 'Nov', 'recebido' => 58, 'pendente' => 8, 'estornado' => 3],
            ['mes' => 'Dez', 'recebido' => 66, 'pendente' => 9, 'estornado' => 3],
        ],
        '2025' => [
            ['mes' => 'Jan', 'recebido' => 11, 'pendente' => 2, 'estornado' => 1],
            ['mes' => 'Fev', 'recebido' => 15, 'pendente' => 2, 'estornado' => 1],
            ['mes' => 'Mar', 'recebido' => 19, 'pendente' => 3, 'estornado' => 1],
            ['mes' => 'Abr', 'recebido' => 18, 'pendente' => 2, 'estornado' => 1],
            ['mes' => 'Mai', 'recebido' => 25, 'pendente' => 4, 'estornado' => 1],
            ['mes' => 'Jun', 'recebido' => 24, 'pendente' => 3, 'estornado' => 1],
            ['mes' => 'Jul', 'recebido' => 31, 'pendente' => 4, 'estornado' => 2],
            ['mes' => 'Ago', 'recebido' => 29, 'pendente' => 4, 'estornado' => 1],
            ['mes' => 'Set', 'recebido' => 35, 'pendente' => 5, 'estornado' => 2],
            ['mes' => 'Out', 'recebido' => 39, 'pendente' => 6, 'estornado' => 2],
            ['mes' => 'Nov', 'recebido' => 45, 'pendente' => 6, 'estornado' => 2],
            ['mes' => 'Dez', 'recebido' => 51, 'pendente' => 7, 'estornado' => 2],
        ],
    ];
}

/**
 * Métodos de pagamento (gráfico donut).
 */
function organizador_metodos_pagamento(): array
{
    return [
        ['metodo' => 'Pix',               'percentual' => 42, 'cor' => '#5a0505'],
        ['metodo' => 'Cartão de crédito', 'percentual' => 34, 'cor' => '#8c3b2b'],
        ['metodo' => 'Boleto',            'percentual' => 18, 'cor' => '#ee8f66'],
        ['metodo' => 'Transferência',     'percentual' => 4,  'cor' => '#f5b895'],
        ['metodo' => 'Outros',            'percentual' => 2,  'cor' => '#dfd3c8'],
    ];
}

/**
 * Lista de pagamentos para a tabela "Últimos pagamentos".
 */
function organizador_ultimos_pagamentos(): array
{
    return [
        [
            'id'           => 101,
            'data'         => '18/09/2026',
            'participante' => 'TechCorp Soluções',
            'evento'       => 'Congresso de Inovação 2026',
            'evento_slug'  => 'congresso-inovacao-2026',
            'metodo'       => 'Pix',
            'valor'        => 1200.00,
            'status'       => 'pago',
            'status_label' => 'Pago',
        ],
        [
            'id'           => 102,
            'data'         => '17/09/2026',
            'participante' => 'Ana Clara Souza',
            'evento'       => 'Workshop de Liderança 2026',
            'evento_slug'  => 'workshop-lideranca-2026',
            'metodo'       => 'Cartão',
            'valor'        => 850.00,
            'status'       => 'pago',
            'status_label' => 'Pago',
        ],
        [
            'id'           => 103,
            'data'         => '16/09/2026',
            'participante' => 'Grupo Alvorada',
            'evento'       => 'Seminário de Gestão 2026',
            'evento_slug'  => 'seminario-gestao-2026',
            'metodo'       => 'Boleto',
            'valor'        => 2400.00,
            'status'       => 'pendente',
            'status_label' => 'Pendente',
        ],
        [
            'id'           => 104,
            'data'         => '16/09/2026',
            'participante' => 'João Pedro Lima',
            'evento'       => 'Workshop de Tecnologia 2026',
            'evento_slug'  => 'workshop-tecnologia-2026',
            'metodo'       => 'Pix',
            'valor'        => 950.00,
            'status'       => 'pago',
            'status_label' => 'Pago',
        ],
        [
            'id'           => 105,
            'data'         => '15/09/2026',
            'participante' => 'Beatriz Oliveira',
            'evento'       => 'Palestra: Inovação na Prática',
            'evento_slug'  => 'palestra-inovacao-pratica',
            'metodo'       => 'Pix',
            'valor'        => 780.00,
            'status'       => 'estornado',
            'status_label' => 'Estornado',
        ],
        [
            'id'           => 106,
            'data'         => '14/09/2026',
            'participante' => 'InovaTech Brasil',
            'evento'       => 'Workshop de Tecnologia 2026',
            'evento_slug'  => 'workshop-tecnologia-2026',
            'metodo'       => 'Cartão',
            'valor'        => 1500.00,
            'status'       => 'pago',
            'status_label' => 'Pago',
            'extra'        => true,
        ],
        [
            'id'           => 107,
            'data'         => '12/09/2026',
            'participante' => 'Marcos Vinícius Prado',
            'evento'       => 'Congresso de Inovação 2026',
            'evento_slug'  => 'congresso-inovacao-2026',
            'metodo'       => 'Boleto',
            'valor'        => 560.00,
            'status'       => 'pendente',
            'status_label' => 'Pendente',
            'extra'        => true,
        ],
    ];
}

/**
 * Lista de pendências financeiras do card inferior esquerdo.
 */
function organizador_pendencias(): array
{
    return [
        [
            'icone'     => 'clock',
            'titulo'    => '18 pagamentos pendentes',
            'subtitulo' => 'Total de R$ 21.350,00',
            'toast'     => 'Exibindo os 18 pagamentos pendentes para acompanhamento.',
        ],
        [
            'icone'     => 'calendar',
            'titulo'    => '3 boletos vencidos',
            'subtitulo' => 'Total de R$ 4.800,00',
            'toast'     => '2ª via dos 3 boletos vencidos pronta para reenvio.',
        ],
        [
            'icone'     => 'doc',
            'titulo'    => '5 estornos em análise',
            'subtitulo' => 'Solicitação em revisão',
            'toast'     => '5 solicitações de estorno estão em análise pela operadora.',
        ],
        [
            'icone'     => 'transfer',
            'titulo'    => '2 transferências aguardando confirmação',
            'subtitulo' => 'Total de R$ 3.600,00',
            'toast'     => 'Verificando conciliação bancária das 2 transferências.',
        ],
    ];
}
