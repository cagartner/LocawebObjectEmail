# Descrição

Essa classe foi criada para facilitar o envio de e-mail via hospedagens da Locaweb, essas hospedagens tem umas regras para enviar o e-mail.


# Instalação

Baixe sua classe aqui do GitHub [Baixar](https://github.com/cagartner/LocawebObjectEmail/archive/master.zip).

Antes de usar atualize o $EmailHost na Classe para um email da sua hospedagem, precisa ter o mesmo nome do domínio para funcionar:

	private $EmailHost = "email@dominiodalocaweb.com.br";

# Exemplo de uso

	$Email = new Email();
	$Email->setRemetente('email@remetente.com.br'); // Aqui você pode colocar qualquer e-mail como remetente.
	$Email->setAssunto('Assunto');
	$Email->setDestinatario('email@destinatario.com.br');
	$Email->setMensagem("Mensagem");
	$Email->enviaEmail();

