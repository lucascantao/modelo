<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Assunto;

class AssuntoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Assunto::create([
            'nome' => 'ALTERAÇÃO DE PERÍODO',
            'descricao' => 'Alteração do período de alguma atividade, evento ou compromisso.'
        ]);
        
        Assunto::create([
            'nome' => 'AUTORIZAÇÃO DE VIAGEM',
            'descricao' => 'Permissão concedida para realizar uma viagem oficial ou de trabalho.'
        ]);
        
        Assunto::create([
            'nome' => 'CESSÃO',
            'descricao' => 'Transferência temporária ou definitiva de direitos ou bens para outra pessoa ou entidade.'
        ]);
        
        Assunto::create([
            'nome' => 'COMISSÃO DE LICITAÇÃO',
            'descricao' => 'Grupo responsável por conduzir processos licitatórios, avaliar propostas e selecionar fornecedores.'
        ]);
        
        Assunto::create([
            'nome' => 'COMPLEMENTAÇÃO DE DIÁRIAS',
            'descricao' => 'Acréscimo de diárias para cobrir despesas adicionais durante viagens ou atividades fora da sede.'
        ]);
        
        Assunto::create([
            'nome' => 'DESIGNAÇÃO',
            'descricao' => 'Ato de indicar ou nomear uma pessoa para desempenhar uma função ou ocupar um cargo específico.'
        ]);
        
        Assunto::create([
            'nome' => 'DESIGNAÇÃO DE FISCAL DE CONTRATO',
            'descricao' => 'Nomeação de um responsável para fiscalizar a execução de um contrato entre partes.'
        ]);
        
        Assunto::create([
            'nome' => 'DIÁRIAS',
            'descricao' => 'Valor pago diariamente para cobrir despesas de alimentação, hospedagem e transporte durante viagens a serviço.'
        ]);
        
        Assunto::create([
            'nome' => 'ERRATA',
            'descricao' => 'Documento utilizado para corrigir erros em documentos oficiais, como editais, atas ou contratos.'
        ]);
        
        Assunto::create([
            'nome' => 'EXCLUSÃO DE SERVIDOR',
            'descricao' => 'Remoção ou desligamento de um servidor do quadro de funcionários ou de uma lista de participantes.'
        ]);
        
        Assunto::create([
            'nome' => 'FÉRIAS',
            'descricao' => 'Período de descanso remunerado concedido ao trabalhador após um período de trabalho contínuo.'
        ]);
        
        Assunto::create([
            'nome' => 'INCLUSÃO DE SERVIDOR',
            'descricao' => 'Admissão ou inserção de um servidor no quadro de funcionários de uma instituição ou órgão público.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA APRIMORAMENTO',
            'descricao' => 'Licença concedida ao servidor para participar de programas de aprimoramento profissional.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA GALA',
            'descricao' => 'Licença concedida ao servidor para eventos sociais, como casamentos ou celebrações familiares.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA MATERNIDADE',
            'descricao' => 'Licença concedida à mãe trabalhadora após o nascimento do filho para cuidados e amamentação.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA NOJO',
            'descricao' => 'Licença concedida ao servidor em decorrência de falecimento de familiar próximo.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA PARA ACOMPANHAR CÔNJUGUE OU COMPANHEIRO',
            'descricao' => 'Licença concedida ao servidor para acompanhar cônjuge ou companheiro em deslocamento.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA PARA ADOÇÃO',
            'descricao' => 'Licença concedida ao servidor que adota uma criança para cuidados e adaptação familiar.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA PARA ATIVIDADE POLÍTICA',
            'descricao' => 'Licença concedida ao servidor para participar de atividades político-partidárias.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA PARA DOAÇÃO DE SANGUE',
            'descricao' => 'Licença concedida ao servidor para realizar doação de sangue, com fins humanitários.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA PARA ESTUDOS DE INTERESSE PÚBLICO',
            'descricao' => 'Licença concedida ao servidor para realizar estudos relacionados aos interesses públicos.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA PARA EXERCER CARGO POLÍTICO',
            'descricao' => 'Licença concedida ao servidor para exercer cargo eletivo ou de nomeação política.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA PARA INTEGRAR JÚRI POPULAR',
            'descricao' => 'Licença concedida ao servidor para atuar como jurado em processos judiciais.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA PARA MISSÃO OFICIAL DE QUALQUER NATUREZA',
            'descricao' => 'Licença concedida ao servidor para participar de missões oficiais, como representante.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA PARA O EXERCÍCIO DE MANDATO ELETIVO',
            'descricao' => 'Licença concedida ao servidor que se candidata a cargo eletivo para participar de campanhas.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA PARA OBRIGAÇÕES ELEITORAIS',
            'descricao' => 'Licença concedida ao servidor para cumprir obrigações eleitorais, como votação ou trabalho em eleições.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA PARA OBRIGAÇÕES MILITARES',
            'descricao' => 'Licença concedida ao servidor para cumprir obrigações militares, como serviço obrigatório.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA PARA TRATAR DE INTERESSE PARTICULAR',
            'descricao' => 'Licença concedida ao servidor para tratar de assuntos particulares por tempo determinado.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA PATERNIDADE',
            'descricao' => 'Licença concedida ao pai trabalhador após o nascimento do filho para cuidados e adaptação familiar.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA POR MOTIVO DE DOENÇA EM PESSOA DA FAMÍLIA',
            'descricao' => 'Licença concedida ao servidor para cuidar de familiar que esteja doente ou necessite de assistência.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA PRÊMIO',
            'descricao' => 'Licença concedida ao servidor como reconhecimento por tempo de serviço prestado.'
        ]);
        
        Assunto::create([
            'nome' => 'LICENÇA SAÚDE',
            'descricao' => 'Licença concedida ao servidor em caso de doença ou condição de saúde que impeça o trabalho.'
        ]);
        
        Assunto::create([
            'nome' => 'OUTROS',
            'descricao' => 'Assuntos que não se enquadram nas categorias anteriores.'
        ]);
        
        Assunto::create([
            'nome' => 'QUALIFICA SERVIDOR',
            'descricao' => 'Processo ou ação para melhorar as habilidades e competências de um servidor público.'
        ]);
        
        Assunto::create([
            'nome' => 'REMOÇÃO',
            'descricao' => 'Transferência de um servidor de um local de trabalho para outro, dentro da mesma instituição.'
        ]);
        
        Assunto::create([
            'nome' => 'SUBSTITUIÇÃO DE SERVIDOR',
            'descricao' => 'Ato de substituir um servidor por outro para desempenhar as mesmas funções ou atribuições.'
        ]);
        
        Assunto::create([
            'nome' => 'SUPRIMENTO DE FUNDOS',
            'descricao' => 'Liberação de recursos financeiros adiantados para custear despesas urgentes e indispensáveis.'
        ]);
        
        Assunto::create([
            'nome' => 'TORNAR SEM EFEITO',
            'descricao' => 'Ato de anular, cancelar ou revogar uma decisão, ordem ou documento anteriormente emitido.'
        ]);
        
        
        
    }
}
