<?php
/**
 * "Banco" FAKE de eventos (Sprint 2). Na Sprint 3 estas funções passam a consultar o MySQL
 * mantendo EXATAMENTE as mesmas assinaturas e formato de retorno.
 *
 * Formato de um evento:
 *  id, titulo, categoria (slug de eventos_categorias), data (YYYY-MM-DD), hora_inicio, hora_fim,
 *  cidade, estado, formato ('presencial'|'online'|'hibrido'), status
 *  ('em-andamento'|'em-breve'|'vagas-limitadas'|'finalizado'), destaque (bool),
 *  imagem (caminho dentro de /assets, use asset($e['imagem'])), descricao, preco (float; 0 = gratuito),
 *  confirmados (int), vagas (int)
 */

/** slug => rótulo. */
function eventos_categorias(): array
{
    return [
        'tecnologia'       => 'Tecnologia',
        'negocios'         => 'Negócios',
        'marketing'        => 'Marketing',
        'lideranca'        => 'Liderança',
        'inovacao'         => 'Inovação',
        'desenvolvimento'  => 'Desenvolvimento',
    ];
}

/** @return array<int,array<string,mixed>> */
function eventos_todos(): array
{
    return [
        ['id' => 1, 'titulo' => 'Workshop de Tecnologia 2026', 'categoria' => 'tecnologia', 'data' => '2026-09-15',
         'hora_inicio' => '08:00', 'hora_fim' => '18:00', 'cidade' => 'São José dos Campos', 'estado' => 'SP',
         'formato' => 'presencial', 'status' => 'em-andamento', 'destaque' => true,
         'imagem' => 'img/imagem forum tecnologia.png', 'preco' => 150.00, 'confirmados' => 120, 'vagas' => 150,
         'descricao' => 'Um dia inteiro de aprendizado, troca de experiências e conexões com especialistas do mercado de tecnologia.'],
        ['id' => 2, 'titulo' => 'Congresso de Inovação 2026', 'categoria' => 'inovacao', 'data' => '2026-09-22',
         'hora_inicio' => '09:00', 'hora_fim' => '19:00', 'cidade' => 'São Paulo', 'estado' => 'SP',
         'formato' => 'presencial', 'status' => 'em-breve', 'destaque' => true,
         'imagem' => 'img/imagem conecta inovacao 2026.png', 'preco' => 280.00, 'confirmados' => 160, 'vagas' => 400,
         'descricao' => 'Três dias de painéis e demonstrações sobre as tendências que moldam a inovação nas empresas.'],
        ['id' => 3, 'titulo' => 'Palestra de Marketing', 'categoria' => 'marketing', 'data' => '2026-09-28',
         'hora_inicio' => '19:00', 'hora_fim' => '21:30', 'cidade' => 'Campinas', 'estado' => 'SP',
         'formato' => 'presencial', 'status' => 'vagas-limitadas', 'destaque' => true,
         'imagem' => 'img/imagem notebook.png', 'preco' => 90.00, 'confirmados' => 0, 'vagas' => 80,
         'descricao' => 'Estratégias práticas de marketing para fortalecer sua marca e gerar novos contatos.'],
        ['id' => 4, 'titulo' => 'Encontro de Lideranças 2026', 'categoria' => 'lideranca', 'data' => '2026-08-10',
         'hora_inicio' => '09:00', 'hora_fim' => '17:00', 'cidade' => 'São José dos Campos', 'estado' => 'SP',
         'formato' => 'presencial', 'status' => 'finalizado', 'destaque' => false,
         'imagem' => 'img/imagem worshop de lideranca.png', 'preco' => 120.00, 'confirmados' => 90, 'vagas' => 90,
         'descricao' => 'Encontro anual de líderes para trocar experiências sobre gestão de equipes.'],
        ['id' => 5, 'titulo' => 'Fórum de Negócios e Estratégias', 'categoria' => 'negocios', 'data' => '2026-10-05',
         'hora_inicio' => '09:00', 'hora_fim' => '18:00', 'cidade' => 'São Paulo', 'estado' => 'SP',
         'formato' => 'presencial', 'status' => 'em-breve', 'destaque' => false,
         'imagem' => 'img/imagem conectando pessoas e conhecimento.png', 'preco' => 200.00, 'confirmados' => 45, 'vagas' => 200,
         'descricao' => 'Debates sobre estratégia, crescimento e novos modelos de negócio.'],
        ['id' => 6, 'titulo' => 'Imersão em Dados & IA', 'categoria' => 'tecnologia', 'data' => '2026-10-18',
         'hora_inicio' => '14:00', 'hora_fim' => '18:00', 'cidade' => 'Online', 'estado' => '',
         'formato' => 'online', 'status' => 'vagas-limitadas', 'destaque' => false,
         'imagem' => 'img/imagem gerenciar eventos.png', 'preco' => 0.00, 'confirmados' => 180, 'vagas' => 200,
         'descricao' => 'Uma tarde para aprender a transformar dados em decisões com apoio de inteligência artificial.'],
        ['id' => 7, 'titulo' => 'Liderança que Inspira', 'categoria' => 'lideranca', 'data' => '2026-10-25',
         'hora_inicio' => '08:30', 'hora_fim' => '17:30', 'cidade' => 'Belo Horizonte', 'estado' => 'MG',
         'formato' => 'presencial', 'status' => 'em-breve', 'destaque' => false,
         'imagem' => 'img/imagem worshop de lideranca.png', 'preco' => 130.00, 'confirmados' => 30, 'vagas' => 120,
         'descricao' => 'Workshop sobre liderança inspiradora e desenvolvimento de equipes de alta performance.'],
        ['id' => 8, 'titulo' => 'Comunicação que Conecta', 'categoria' => 'desenvolvimento', 'data' => '2026-11-02',
         'hora_inicio' => '09:00', 'hora_fim' => '16:00', 'cidade' => 'Rio de Janeiro', 'estado' => 'RJ',
         'formato' => 'presencial', 'status' => 'em-breve', 'destaque' => false,
         'imagem' => 'img/imagem Organize seus eventos.png', 'preco' => 110.00, 'confirmados' => 12, 'vagas' => 100,
         'descricao' => 'Técnicas de comunicação para apresentações e relacionamento profissional.'],
        ['id' => 9, 'titulo' => 'Inovação Aberta 2026', 'categoria' => 'inovacao', 'data' => '2026-11-09',
         'hora_inicio' => '09:00', 'hora_fim' => '18:00', 'cidade' => 'Curitiba', 'estado' => 'PR',
         'formato' => 'presencial', 'status' => 'em-breve', 'destaque' => false,
         'imagem' => 'img/imagem portal de eventos.png', 'preco' => 240.00, 'confirmados' => 20, 'vagas' => 250,
         'descricao' => 'Conexão entre empresas, startups e universidades para projetos de inovação aberta.'],
    ];
}

function evento_por_id(int $id): ?array
{
    foreach (eventos_todos() as $evento) {
        if ($evento['id'] === $id) {
            return $evento;
        }
    }
    return null;
}

/** Texto "Cidade - UF" (ou só "Online"). */
function evento_local(array $evento): string
{
    return $evento['estado'] !== '' ? "{$evento['cidade']} - {$evento['estado']}" : $evento['cidade'];
}
