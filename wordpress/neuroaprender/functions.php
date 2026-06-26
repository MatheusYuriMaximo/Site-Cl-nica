<?php
/**
 * Theme functions for NeuroAprender.
 *
 * @package NeuroAprender
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function neuroaprender_asset_uri( string $path ): string {
	$path = ltrim( $path, '/' );

	if ( file_exists( neuroaprender_asset_path( $path ) ) ) {
		return get_stylesheet_directory_uri() . '/' . $path;
	}

	return 'https://matheusyurimaximo.github.io/Site-Cl-nica/' . $path;
}

function neuroaprender_asset_path( string $path ): string {
	return get_template_directory() . '/' . ltrim( $path, '/' );
}

function neuroaprender_setup(): void {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'caption',
			'comment-form',
			'comment-list',
			'gallery',
			'script',
			'search-form',
			'style',
		)
	);
}
add_action( 'after_setup_theme', 'neuroaprender_setup' );

function neuroaprender_enqueue_assets(): void {
	$css_path = get_stylesheet_directory() . '/style.css';

	wp_enqueue_style(
		'neuroaprender-fonts',
		'https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Source+Sans+3:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'neuroaprender-main',
		get_stylesheet_uri(),
		array( 'neuroaprender-fonts' ),
		file_exists( $css_path ) ? (string) filemtime( $css_path ) : '1.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'neuroaprender_enqueue_assets' );

function neuroaprender_site_icon_tags(): void {
	$icon_uri = neuroaprender_asset_uri( 'assets/site-icon-neuroaprender.png' );
	?>
	<link rel="icon" href="<?php echo esc_url( $icon_uri ); ?>" sizes="512x512" type="image/png">
	<link rel="apple-touch-icon" href="<?php echo esc_url( $icon_uri ); ?>">
	<?php
}
add_action( 'wp_head', 'neuroaprender_site_icon_tags', 1 );
add_action( 'admin_head', 'neuroaprender_site_icon_tags', 1 );
add_action( 'login_head', 'neuroaprender_site_icon_tags', 1 );

function neuroaprender_content_post_id(): int {
	$front_page_id = (int) get_option( 'page_on_front' );

	if ( $front_page_id > 0 ) {
		return $front_page_id;
	}

	return (int) get_queried_object_id();
}

function neuroaprender_page_has_visual_content( int $post_id ): bool {
	$post = get_post( $post_id );

	if ( ! $post instanceof WP_Post ) {
		return false;
	}

	if ( '' !== trim( (string) $post->post_content ) ) {
		return true;
	}

	$elementor_data = get_post_meta( $post_id, '_elementor_data', true );
	$elementor_mode = get_post_meta( $post_id, '_elementor_edit_mode', true );

	return '' !== (string) $elementor_data || 'builder' === $elementor_mode;
}

function neuroaprender_is_visual_builder_request(): bool {
	if ( isset( $_GET['elementor-preview'] ) || isset( $_GET['elementor_library'] ) ) {
		return true;
	}

	if ( did_action( 'elementor/loaded' ) && class_exists( '\Elementor\Plugin' ) ) {
		$elementor = \Elementor\Plugin::$instance;

		if ( isset( $elementor->editor ) && method_exists( $elementor->editor, 'is_edit_mode' ) && $elementor->editor->is_edit_mode() ) {
			return true;
		}

		if ( isset( $elementor->preview ) && method_exists( $elementor->preview, 'is_preview_mode' ) && $elementor->preview->is_preview_mode() ) {
			return true;
		}
	}

	return false;
}

function neuroaprender_field( string $name, $default = '' ) {
	if ( function_exists( 'get_field' ) ) {
		$value = get_field( $name, neuroaprender_content_post_id() );

		if ( null !== $value && false !== $value && '' !== $value ) {
			return $value;
		}
	}

	return $default;
}

function neuroaprender_text( string $name, string $default = '' ): void {
	echo esc_html( (string) neuroaprender_field( $name, $default ) );
}

function neuroaprender_rich_text( string $name, string $default = '' ): void {
	$value = (string) neuroaprender_field( $name, $default );
	echo wp_kses_post( nl2br( esc_html( $value ) ) );
}

function neuroaprender_image_uri( string $field_name, string $fallback_asset ): string {
	$image = neuroaprender_field( $field_name, '' );

	if ( is_array( $image ) && ! empty( $image['url'] ) ) {
		return (string) $image['url'];
	}

	if ( is_numeric( $image ) ) {
		$url = wp_get_attachment_image_url( (int) $image, 'full' );
		if ( $url ) {
			return $url;
		}
	}

	if ( is_string( $image ) && '' !== $image ) {
		return $image;
	}

	return neuroaprender_asset_uri( $fallback_asset );
}

function neuroaprender_whatsapp_url(): string {
	$link = (string) neuroaprender_field( 'na_whatsapp_link', '' );

	if ( '' !== $link ) {
		return $link;
	}

	$phone = preg_replace( '/\D+/', '', (string) neuroaprender_field( 'na_whatsapp_number', '+55 96 9169-0204' ) );

	return 'https://wa.me/' . $phone;
}

function neuroaprender_maps_url(): string {
	$map = (string) neuroaprender_field( 'na_maps_embed_url', '' );

	if ( '' !== $map ) {
		return $map;
	}

	$address = (string) neuroaprender_field( 'na_address', 'Av. Quinze de Julho, 1039 - Buritizal, Macapá - AP, 68904-720, Brasil' );

	return 'https://www.google.com/maps?q=' . rawurlencode( $address ) . '&output=embed';
}

function neuroaprender_ai_enabled(): bool {
	return '0' !== (string) neuroaprender_field( 'na_ai_enabled', '1' );
}

function neuroaprender_openai_api_key(): string {
	if ( defined( 'NEUROAPRENDER_OPENAI_API_KEY' ) && NEUROAPRENDER_OPENAI_API_KEY ) {
		return (string) NEUROAPRENDER_OPENAI_API_KEY;
	}

	$key = getenv( 'OPENAI_API_KEY' );

	return $key ? (string) $key : '';
}

function neuroaprender_ai_model(): string {
	$model = (string) neuroaprender_field( 'na_ai_model', '' );

	return '' !== $model ? $model : 'gpt-4o-mini';
}

function neuroaprender_ai_core_instructions(): string {
	return <<<'TEXT'
Você é o assistente virtual da Clínica Escola NeuroAprender, uma clínica voltada ao cuidado, desenvolvimento, aprendizagem e bem-estar de crianças, adolescentes e famílias, incluindo crianças neuroatípicas.

Missão:
- Responder em português do Brasil, com tom acolhedor, claro, responsável e objetivo.
- Ajudar com dúvidas sobre serviços, avaliações, terapias, pacotes, horários, endereço, WhatsApp, Instagram, agendamento e valores.
- Usar somente as informações autorizadas no contexto do site e na base de conhecimento fornecida.
- Quando informar preços, deixar claro se o valor é por sessão, mensal, avaliação ou pacote educacional.
- Informar valor com desconto de 20% apenas quando o cliente perguntar por desconto, promoção, condição especial, valor promocional ou negociação.
- Se o cliente não pedir desconto, informar o valor cheio.
- Sempre que fizer sentido, convidar a pessoa a agendar pelo WhatsApp.

Limites obrigatórios:
- Não realizar diagnóstico.
- Não interpretar sintomas como diagnóstico.
- Não prescrever tratamento.
- Não indicar conduta clínica individualizada.
- Não prometer resultados.
- Não substituir avaliação profissional.
- Não sair do escopo da clínica.
- Em caso de urgência médica, orientar procurar serviço de emergência.
- Em dúvidas sobre desenvolvimento, comportamento, saúde, aprendizagem ou sinais clínicos, orientar agendamento de avaliação ou atendimento profissional.
TEXT;
}

function neuroaprender_ai_default_price_context(): string {
	return <<<'TEXT'
Tabela de preços autorizada da Clínica Escola NeuroAprender.

Regra comercial:
- Use valor cheio por padrão.
- Use valor com 20% de desconto somente se o cliente pedir desconto, promoção, condição especial, valor promocional ou negociação.
- Não invente descontos adicionais.
- Se houver dúvida sobre disponibilidade, agenda ou indicação clínica, encaminhe para WhatsApp.

Sessões avulsas:
- Psicologia: R$ 150,00 por sessão de 50 min. Com 20%: R$ 120,00.
- Neuropsicologia: R$ 200,00 por sessão de 50 min. Com 20%: R$ 160,00.
- Psicopedagogia: R$ 100,00 por sessão de 50 min. Com 20%: R$ 80,00.
- Neuropsicopedagogia: R$ 130,00 por sessão de 50 min. Com 20%: R$ 104,00.
- Fonoaudiologia: R$ 200,00 por sessão de 50 min. Com 20%: R$ 160,00.
- Terapia Ocupacional: R$ 200,00 por sessão de 50 min. Com 20%: R$ 160,00.
- Terapia ABA: R$ 200,00 por sessão de 50 min. Com 20%: R$ 160,00.
- Psicomotricidade: R$ 120,00 por sessão de 50 min. Com 20%: R$ 96,00.
- Fisioterapia Infantil: R$ 120,00 por sessão de 50 min. Com 20%: R$ 96,00.
- Fisioterapia: R$ 150,00 por sessão de 50 min. Com 20%: R$ 120,00.
- Consulta Médica: R$ 250,00 por sessão de 50 min. Com 20%: R$ 200,00.
- Nutricionista: R$ 130,00 por sessão de 50 min. Com 20%: R$ 104,00.
- Avaliação Neuropsicológica: 10 sessões de 50 min, R$ 2.000,00. Com 20%: R$ 1.600,00.
- Avaliação Neuropsicopedagógica: 10 sessões de 50 min, R$ 1.500,00. Com 20%: R$ 1.200,00.
- PIPE: mensal, R$ 2.000,00, duração 2h. Com 20%: R$ 1.600,00.

Pacotes mensais:
- Psicologia: R$ 600,00. Com 20%: R$ 480,00.
- Neuropsicologia: R$ 800,00. Com 20%: R$ 640,00.
- Psicopedagogia: R$ 400,00. Com 20%: R$ 320,00.
- Neuropsicopedagogia: R$ 520,00. Com 20%: R$ 416,00.
- Fonoaudiologia: R$ 800,00. Com 20%: R$ 640,00.
- Terapia Ocupacional: R$ 800,00. Com 20%: R$ 640,00.
- Terapia ABA: R$ 800,00. Com 20%: R$ 640,00.
- Psicomotricidade: R$ 480,00. Com 20%: R$ 384,00.
- Fisioterapia Infantil: R$ 480,00. Com 20%: R$ 384,00.
- Fisioterapia: R$ 600,00. Com 20%: R$ 480,00.
- Consulta Médica: R$ 1.000,00. Com 20%: R$ 800,00.
- Nutricionista: R$ 520,00. Com 20%: R$ 416,00.
- Avaliação Neuropsicológica: 10 sessões de 50 min, R$ 2.000,00. Com 20%: R$ 1.600,00.
- Avaliação Neuropsicopedagógica: 10 sessões de 50 min, R$ 1.500,00. Com 20%: R$ 1.200,00.
- PIPE: mensal, R$ 2.000,00, duração 2h. Com 20%: R$ 1.600,00.

Pacotes educacionais:
- NeuroAdvance: R$ 500,00. Com 20%: R$ 400,00.
- NeuroLetras: R$ 300,00. Com 20%: R$ 240,00.
- NeuroFoco Plus, até 5º ano do fundamental 1: R$ 500,00. Com 20%: R$ 400,00.
- NeuroFoco Impulso: R$ 400,00. Com 20%: R$ 320,00.
- NeuroFoco Essencial, até 5º ano do fundamental 1: R$ 300,00. Com 20%: R$ 240,00.
TEXT;
}

function neuroaprender_ai_system_prompt(): string {
	$default_prompt = neuroaprender_ai_core_instructions();
	$prompt         = (string) neuroaprender_field( 'na_ai_system_prompt', $default_prompt );
	$knowledge      = (string) neuroaprender_field( 'na_ai_knowledge', '' );
	$price_context  = (string) neuroaprender_field( 'na_ai_price_context', neuroaprender_ai_default_price_context() );
	$contact        = sprintf(
		"Dados atuais da clínica:\nWhatsApp: %s\nInstagram: %s\nEndereço: %s\nHorário: %s\nLink de agendamento: %s",
		(string) neuroaprender_field( 'na_whatsapp_number', '+55 96 9169-0204' ),
		(string) neuroaprender_field( 'na_instagram_label', '@clinicaescolaneuroaprender' ),
		(string) neuroaprender_field( 'na_address', 'Av. Quinze de Julho, 1039 - Buritizal, Macapá - AP, 68904-720, Brasil' ),
		(string) neuroaprender_field( 'na_hours', '08:00 às 12:00 e 14:00 às 18:00' ),
		neuroaprender_whatsapp_url()
	);

	return trim(
		neuroaprender_ai_core_instructions()
		. "\n\nInstruções editáveis da clínica:\n" . $prompt
		. "\n\n" . $contact
		. ( '' !== $price_context ? "\n\nTabela de preços e regras comerciais:\n" . $price_context : '' )
		. ( '' !== $knowledge ? "\n\nBase de conhecimento autorizada:\n" . $knowledge : '' )
	);
}

function neuroaprender_extract_response_text( array $body ): string {
	if ( ! empty( $body['output_text'] ) && is_string( $body['output_text'] ) ) {
		return $body['output_text'];
	}

	if ( empty( $body['output'] ) || ! is_array( $body['output'] ) ) {
		return '';
	}

	$text = '';

	foreach ( $body['output'] as $item ) {
		if ( empty( $item['content'] ) || ! is_array( $item['content'] ) ) {
			continue;
		}

		foreach ( $item['content'] as $content ) {
			if ( ! empty( $content['text'] ) && is_string( $content['text'] ) ) {
				$text .= ( '' === $text ? '' : "\n" ) . $content['text'];
			}
		}
	}

	return $text;
}

function neuroaprender_limit_text( string $text, int $limit ): string {
	if ( function_exists( 'mb_substr' ) ) {
		return mb_substr( $text, 0, $limit );
	}

	return substr( $text, 0, $limit );
}

function neuroaprender_chat_rate_limited(): bool {
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown';
	$key = 'na_ai_chat_' . md5( $ip );
	$hits = (int) get_transient( $key );

	if ( $hits >= 20 ) {
		return true;
	}

	set_transient( $key, $hits + 1, MINUTE_IN_SECONDS );

	return false;
}

function neuroaprender_ai_log_error( string $message, array $context = array() ): void {
	$safe_context = array();

	foreach ( $context as $key => $value ) {
		if ( is_scalar( $value ) || null === $value ) {
			$safe_context[ $key ] = neuroaprender_limit_text( (string) $value, 700 );
		}
	}

	error_log( '[NeuroAprender AI] ' . $message . ( $safe_context ? ' ' . wp_json_encode( $safe_context ) : '' ) );
}

function neuroaprender_ai_public_error_message(): string {
	$message = json_decode( '"N\u00e3o consegui responder agora. Voc\u00ea pode chamar a equipe pelo WhatsApp para receber atendimento."' );

	return is_string( $message ) ? $message : 'Nao consegui responder agora. Voce pode chamar a equipe pelo WhatsApp para receber atendimento.';
}

function neuroaprender_rest_chat( WP_REST_Request $request ): WP_REST_Response {
	if ( ! neuroaprender_ai_enabled() ) {
		return new WP_REST_Response( array( 'message' => 'O assistente virtual está temporariamente desativado.' ), 403 );
	}

	if ( neuroaprender_chat_rate_limited() ) {
		return new WP_REST_Response( array( 'message' => 'Muitas mensagens em pouco tempo. Tente novamente em instantes.' ), 429 );
	}

	$api_key = neuroaprender_openai_api_key();

	if ( '' === $api_key ) {
		neuroaprender_ai_log_error( 'Chave da OpenAI nao configurada.' );

		return new WP_REST_Response( array( 'message' => neuroaprender_ai_public_error_message() ), 503 );
	}

	$message = sanitize_textarea_field( (string) $request->get_param( 'message' ) );
	$message = trim( neuroaprender_limit_text( $message, 1200 ) );

	if ( '' === $message ) {
		return new WP_REST_Response( array( 'message' => 'Digite uma pergunta para o assistente.' ), 400 );
	}

	$history      = $request->get_param( 'history' );
	$conversation = '';

	if ( is_array( $history ) ) {
		$history = array_slice( $history, -6 );

		foreach ( $history as $entry ) {
			if ( ! is_array( $entry ) || empty( $entry['role'] ) || empty( $entry['content'] ) ) {
				continue;
			}

			$role          = 'assistant' === $entry['role'] ? 'assistant' : 'user';
			$label         = 'assistant' === $role ? 'Assistente' : 'Visitante';
			$conversation .= $label . ': ' . neuroaprender_limit_text( sanitize_textarea_field( (string) $entry['content'] ), 900 ) . "\n";
		}
	}

	$conversation .= 'Visitante: ' . $message;

	$response = wp_remote_post(
		'https://api.openai.com/v1/responses',
		array(
			'timeout' => 30,
			'headers' => array(
				'Authorization' => 'Bearer ' . $api_key,
				'Content-Type'  => 'application/json',
			),
			'body'    => wp_json_encode(
				array(
					'model'             => neuroaprender_ai_model(),
					'instructions'      => neuroaprender_ai_system_prompt(),
					'input'             => $conversation,
					'max_output_tokens' => 450,
				)
			),
		)
	);

	if ( is_wp_error( $response ) ) {
		neuroaprender_ai_log_error(
			'Falha ao conectar com a OpenAI.',
			array(
				'error' => $response->get_error_message(),
			)
		);

		return new WP_REST_Response( array( 'message' => neuroaprender_ai_public_error_message() ), 502 );
	}

	$status   = (int) wp_remote_retrieve_response_code( $response );
	$raw_body = (string) wp_remote_retrieve_body( $response );
	$body     = json_decode( $raw_body, true );

	if ( $status < 200 || $status >= 300 || ! is_array( $body ) ) {
		$error_message = is_array( $body ) && isset( $body['error']['message'] ) ? (string) $body['error']['message'] : $raw_body;

		neuroaprender_ai_log_error(
			'Resposta de erro da OpenAI.',
			array(
				'status' => $status,
				'model'  => neuroaprender_ai_model(),
				'error'  => $error_message,
			)
		);

		return new WP_REST_Response( array( 'message' => neuroaprender_ai_public_error_message() ), 502 );
	}

	$text = trim( neuroaprender_extract_response_text( $body ) );

	if ( '' === $text ) {
		$text = 'Não consegui montar uma resposta agora. Você pode falar com a equipe pelo WhatsApp para receber orientação.';
	}

	return new WP_REST_Response(
		array(
			'message' => wp_kses_post( $text ),
		),
		200
	);
}

function neuroaprender_register_rest_routes(): void {
	register_rest_route(
		'neuroaprender/v1',
		'/chat',
		array(
			'methods'             => 'POST',
			'callback'            => 'neuroaprender_rest_chat',
			'permission_callback' => '__return_true',
		)
	);
}
add_action( 'rest_api_init', 'neuroaprender_register_rest_routes' );

function neuroaprender_landing_page_id(): int {
	return (int) get_option( 'page_on_front' );
}

function neuroaprender_landing_edit_url(): string {
	$page_id = neuroaprender_landing_page_id();

	if ( $page_id > 0 ) {
		return get_edit_post_link( $page_id, 'raw' );
	}

	return admin_url( 'options-reading.php' );
}

function neuroaprender_admin_menu(): void {
	add_menu_page(
		'NeuroAprender',
		'NeuroAprender',
		'edit_pages',
		'neuroaprender-landing',
		'neuroaprender_render_landing_admin_page',
		'dashicons-welcome-learn-more',
		25
	);
}
add_action( 'admin_menu', 'neuroaprender_admin_menu' );

function neuroaprender_render_landing_admin_page(): void {
	$page_id = neuroaprender_landing_page_id();
	?>
	<div class="wrap">
		<h1>Landing Page NeuroAprender</h1>
		<p>Use esta tela como atalho para editar a pagina inicial publicada da clinica. Para edicao visual completa, use Elementor na pagina inicial ativa.</p>

		<?php if ( $page_id > 0 ) : ?>
			<div class="notice notice-success inline">
				<p><strong>Pagina inicial ativa:</strong> <?php echo esc_html( get_the_title( $page_id ) ); ?></p>
			</div>
			<p>
				<a class="button button-primary button-hero" href="<?php echo esc_url( get_edit_post_link( $page_id, 'raw' ) ); ?>">Abrir pagina para editar</a>
				<a class="button button-hero" href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank" rel="noopener">Ver site publicado</a>
			</p>
			<p>Se a pagina tiver conteudo criado no Elementor ou no editor de blocos, esse conteudo visual sera exibido no site. Se ela estiver vazia, o tema mostra a landing fixa atual como fallback.</p>
			<p>Os campos <strong>NeuroAprender - Conteudo da Landing Page</strong> continuam disponiveis como edicao simples do fallback.</p>
		<?php else : ?>
			<div class="notice notice-warning inline">
				<p><strong>A pagina inicial estatica ainda nao foi definida.</strong></p>
			</div>
			<p>Para editar a landing por GUI nesta pagina especifica, crie ou escolha uma pagina do WordPress e defina em <strong>Configuracoes &gt; Leitura &gt; Uma pagina estatica</strong>.</p>
			<p>
				<a class="button button-primary" href="<?php echo esc_url( admin_url( 'options-reading.php' ) ); ?>">Configurar pagina inicial</a>
				<a class="button" href="<?php echo esc_url( admin_url( 'post-new.php?post_type=page' ) ); ?>">Criar pagina</a>
			</p>
		<?php endif; ?>
	</div>
	<?php
}

function neuroaprender_front_page_editor_notice( WP_Post $post ): void {
	if ( 'page' !== $post->post_type || (int) $post->ID !== neuroaprender_landing_page_id() ) {
		return;
	}

	echo '<div class="notice notice-info inline"><p><strong>Esta e a landing page publicada da NeuroAprender.</strong> Para edicao visual completa, clique em <strong>Editar com Elementor</strong> e crie o conteudo nesta pagina. Quando houver conteudo visual aqui, ele substitui o template fixo atual. Os campos abaixo continuam editando apenas o fallback.</p></div>';
}
add_action( 'edit_form_after_title', 'neuroaprender_front_page_editor_notice' );

function neuroaprender_page_states( array $post_states, WP_Post $post ): array {
	if ( 'page' === $post->post_type && (int) $post->ID === neuroaprender_landing_page_id() ) {
		$post_states['neuroaprender_landing'] = 'Landing NeuroAprender';
	}

	return $post_states;
}
add_filter( 'display_post_states', 'neuroaprender_page_states', 10, 2 );

function neuroaprender_admin_notice_acf(): void {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		if ( 0 === (int) get_option( 'page_on_front' ) ) {
			echo '<div class="notice notice-info"><p><strong>NeuroAprender:</strong> para editar a landing por GUI nesta pagina especifica, abra o menu <strong>NeuroAprender</strong> e defina uma pagina inicial estatica.</p></div>';
		}

		return;
	}

	echo '<div class="notice notice-warning"><p><strong>NeuroAprender:</strong> instale e ative o plugin Advanced Custom Fields para editar a landing page por campos no painel. O site continua funcionando com os textos padrão até lá.</p></div>';
}
add_action( 'admin_notices', 'neuroaprender_admin_notice_acf' );

function neuroaprender_register_acf_fields(): void {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'      => 'group_neuroaprender_landing',
			'title'    => 'NeuroAprender - Conteúdo da Landing Page',
			'fields'   => array(
				array(
					'key'       => 'field_na_tab_contato',
					'label'     => 'Contato',
					'name'      => '',
					'type'      => 'tab',
					'placement' => 'top',
				),
				array(
					'key'           => 'field_na_whatsapp_number',
					'label'         => 'WhatsApp visível',
					'name'          => 'na_whatsapp_number',
					'type'          => 'text',
					'default_value' => '+55 96 9169-0204',
				),
				array(
					'key'           => 'field_na_whatsapp_link',
					'label'         => 'Link do WhatsApp',
					'name'          => 'na_whatsapp_link',
					'type'          => 'url',
					'default_value' => 'https://wa.me/559691690204',
				),
				array(
					'key'           => 'field_na_instagram_label',
					'label'         => 'Instagram visível',
					'name'          => 'na_instagram_label',
					'type'          => 'text',
					'default_value' => '@clinicaescolaneuroaprender',
				),
				array(
					'key'           => 'field_na_instagram_url',
					'label'         => 'Link do Instagram',
					'name'          => 'na_instagram_url',
					'type'          => 'url',
					'default_value' => 'https://www.instagram.com/clinicaescolaneuroaprender',
				),
				array(
					'key'           => 'field_na_address',
					'label'         => 'Endereço',
					'name'          => 'na_address',
					'type'          => 'textarea',
					'rows'          => 2,
					'default_value' => 'Av. Quinze de Julho, 1039 - Buritizal, Macapá - AP, 68904-720, Brasil',
				),
				array(
					'key'           => 'field_na_hours',
					'label'         => 'Horário de atendimento',
					'name'          => 'na_hours',
					'type'          => 'text',
					'default_value' => '08:00 às 12:00 e 14:00 às 18:00',
				),
				array(
					'key'           => 'field_na_maps_embed_url',
					'label'         => 'URL do mapa incorporado',
					'name'          => 'na_maps_embed_url',
					'type'          => 'url',
					'instructions'  => 'Opcional. Se ficar vazio, o tema gera o mapa a partir do endereço.',
					'default_value' => '',
				),
				array(
					'key'       => 'field_na_tab_hero',
					'label'     => 'Hero',
					'name'      => '',
					'type'      => 'tab',
					'placement' => 'top',
				),
				array(
					'key'           => 'field_na_hero_eyebrow',
					'label'         => 'Texto superior',
					'name'          => 'na_hero_eyebrow',
					'type'          => 'text',
					'default_value' => 'Desenvolvimento infantil, saúde e aprendizagem',
				),
				array(
					'key'           => 'field_na_hero_title_prefix',
					'label'         => 'Título - início',
					'name'          => 'na_hero_title_prefix',
					'type'          => 'text',
					'default_value' => 'Clínica Escola',
				),
				array(
					'key'           => 'field_na_hero_title_highlight',
					'label'         => 'Título - destaque',
					'name'          => 'na_hero_title_highlight',
					'type'          => 'text',
					'default_value' => 'NeuroAprender',
				),
				array(
					'key'           => 'field_na_hero_line',
					'label'         => 'Frase principal',
					'name'          => 'na_hero_line',
					'type'          => 'text',
					'default_value' => 'Todo cérebro aprende.',
				),
				array(
					'key'           => 'field_na_hero_subtitle',
					'label'         => 'Subtítulo',
					'name'          => 'na_hero_subtitle',
					'type'          => 'text',
					'default_value' => 'Cada criança tem seu tempo, e nós caminhamos junto com ela.',
				),
				array(
					'key'           => 'field_na_hero_text',
					'label'         => 'Texto de apoio',
					'name'          => 'na_hero_text',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => 'Unimos acolhimento, ciência e cuidado para apoiar o desenvolvimento infantil, a aprendizagem e o bem-estar das famílias.',
				),
				array(
					'key'           => 'field_na_mascot_image',
					'label'         => 'Mascote',
					'name'          => 'na_mascot_image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'           => 'field_na_hero_note_title',
					'label'         => 'Balão - título',
					'name'          => 'na_hero_note_title',
					'type'          => 'text',
					'default_value' => 'Atendimento interdisciplinar',
				),
				array(
					'key'           => 'field_na_hero_note_text',
					'label'         => 'Balão - texto',
					'name'          => 'na_hero_note_text',
					'type'          => 'text',
					'default_value' => 'Saúde, educação e família caminhando juntas.',
				),
				array(
					'key'       => 'field_na_tab_textos',
					'label'     => 'Textos',
					'name'      => '',
					'type'      => 'tab',
					'placement' => 'top',
				),
				array(
					'key'           => 'field_na_about_title',
					'label'         => 'Sobre - título',
					'name'          => 'na_about_title',
					'type'          => 'text',
					'default_value' => 'Cuidado que acolhe, orientação que transforma',
				),
				array(
					'key'           => 'field_na_about_text_1',
					'label'         => 'Sobre - texto 1',
					'name'          => 'na_about_text_1',
					'type'          => 'textarea',
					'rows'          => 4,
					'default_value' => 'A Clínica Escola NeuroAprender nasceu com o propósito de oferecer atendimentos especializados para crianças, adolescentes e famílias, com um olhar humano, interdisciplinar e individualizado.',
				),
				array(
					'key'           => 'field_na_about_text_2',
					'label'         => 'Sobre - texto 2',
					'name'          => 'na_about_text_2',
					'type'          => 'textarea',
					'rows'          => 4,
					'default_value' => 'Trabalhamos com profissionais de diferentes áreas para compreender cada necessidade de forma ampla, respeitando o ritmo de desenvolvimento, aprendizagem e evolução de cada paciente.',
				),
				array(
					'key'           => 'field_na_space_title',
					'label'         => 'Nosso espaço - título',
					'name'          => 'na_space_title',
					'type'          => 'text',
					'default_value' => 'Ambientes preparados para acolher crianças, adolescentes e famílias',
				),
				array(
					'key'           => 'field_na_space_text',
					'label'         => 'Nosso espaço - texto',
					'name'          => 'na_space_text',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => 'A clínica conta com recepção, consultórios e salas de atendimento organizadas para oferecer conforto, privacidade e cuidado em cada etapa do acompanhamento.',
				),
				array(
					'key'           => 'field_na_services_title',
					'label'         => 'Serviços - título',
					'name'          => 'na_services_title',
					'type'          => 'text',
					'default_value' => 'Serviços especializados para desenvolvimento, saúde e aprendizagem',
				),
				array(
					'key'           => 'field_na_packages_title',
					'label'         => 'Pacotes - título',
					'name'          => 'na_packages_title',
					'type'          => 'text',
					'default_value' => 'Programas para fortalecer habilidades escolares',
				),
				array(
					'key'           => 'field_na_reviews_title',
					'label'         => 'Avaliações - título',
					'name'          => 'na_reviews_title',
					'type'          => 'text',
					'default_value' => 'Pacotes de avaliação para compreender e orientar cada necessidade',
				),
				array(
					'key'           => 'field_na_reviews_text',
					'label'         => 'Avaliações - texto',
					'name'          => 'na_reviews_text',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => 'Confira os materiais informativos da clínica e fale com a equipe para confirmar disponibilidade, valores e melhor indicação para cada caso.',
				),
				array(
					'key'           => 'field_na_team_title',
					'label'         => 'Equipe - título',
					'name'          => 'na_team_title',
					'type'          => 'text',
					'default_value' => 'Profissionais preparados para acolher, avaliar e acompanhar',
				),
				array(
					'key'           => 'field_na_team_text',
					'label'         => 'Equipe - texto',
					'name'          => 'na_team_text',
					'type'          => 'textarea',
					'rows'          => 2,
					'default_value' => 'Nossa equipe atua com responsabilidade, ética e cuidado em cada etapa do atendimento.',
				),
				array(
					'key'       => 'field_na_tab_cta',
					'label'     => 'Chamada final',
					'name'      => '',
					'type'      => 'tab',
					'placement' => 'top',
				),
				array(
					'key'           => 'field_na_cta_eyebrow',
					'label'         => 'Texto superior',
					'name'          => 'na_cta_eyebrow',
					'type'          => 'text',
					'default_value' => 'Orientação no momento certo',
				),
				array(
					'key'           => 'field_na_cta_title',
					'label'         => 'Título',
					'name'          => 'na_cta_title',
					'type'          => 'text',
					'default_value' => 'Percebeu alguma dificuldade no desenvolvimento ou aprendizagem da criança?',
				),
				array(
					'key'           => 'field_na_cta_text',
					'label'         => 'Texto',
					'name'          => 'na_cta_text',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => 'Quanto antes a família busca orientação, mais possibilidades existem para compreender, intervir e acompanhar de forma adequada.',
				),
				array(
					'key'           => 'field_na_cta_button',
					'label'         => 'Texto do botão',
					'name'          => 'na_cta_button',
					'type'          => 'text',
					'default_value' => 'Falar com a NeuroAprender',
				),
				array(
					'key'       => 'field_na_tab_ai',
					'label'     => 'Bot IA',
					'name'      => '',
					'type'      => 'tab',
					'placement' => 'top',
				),
				array(
					'key'           => 'field_na_ai_enabled',
					'label'         => 'Ativar assistente virtual',
					'name'          => 'na_ai_enabled',
					'type'          => 'true_false',
					'default_value' => 1,
					'ui'            => 1,
				),
				array(
					'key'           => 'field_na_ai_title',
					'label'         => 'Título do chat',
					'name'          => 'na_ai_title',
					'type'          => 'text',
					'default_value' => 'Assistente NeuroAprender',
				),
				array(
					'key'           => 'field_na_ai_intro',
					'label'         => 'Mensagem inicial',
					'name'          => 'na_ai_intro',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => 'Olá! Posso tirar dúvidas sobre serviços, horários, localização e agendamento. Para avaliação clínica, nossa equipe continua sendo o melhor caminho.',
				),
				array(
					'key'           => 'field_na_ai_placeholder',
					'label'         => 'Texto do campo de mensagem',
					'name'          => 'na_ai_placeholder',
					'type'          => 'text',
					'default_value' => 'Digite sua dúvida...',
				),
				array(
					'key'           => 'field_na_ai_button_label',
					'label'         => 'Texto do botão flutuante',
					'name'          => 'na_ai_button_label',
					'type'          => 'text',
					'default_value' => 'Tirar dúvidas com IA',
				),
				array(
					'key'           => 'field_na_ai_disclaimer',
					'label'         => 'Aviso do chat',
					'name'          => 'na_ai_disclaimer',
					'type'          => 'textarea',
					'rows'          => 2,
					'default_value' => 'Este assistente não realiza diagnóstico e não substitui atendimento profissional.',
				),
				array(
					'key'           => 'field_na_ai_model',
					'label'         => 'Modelo OpenAI',
					'name'          => 'na_ai_model',
					'type'          => 'text',
					'default_value' => 'gpt-4o-mini',
					'instructions'  => 'Altere apenas se souber qual modelo está disponível na conta OpenAI.',
				),
				array(
					'key'           => 'field_na_ai_system_prompt',
					'label'         => 'Instruções do assistente',
					'name'          => 'na_ai_system_prompt',
					'type'          => 'textarea',
					'rows'          => 10,
					'default_value' => neuroaprender_ai_core_instructions(),
				),
				array(
					'key'           => 'field_na_ai_price_context',
					'label'         => 'Tabela de preços e regras comerciais',
					'name'          => 'na_ai_price_context',
					'type'          => 'textarea',
					'rows'          => 20,
					'instructions'  => 'Edite aqui valores, pacotes, durações e regras de desconto. O bot usa valor cheio por padrão e só informa desconto quando o cliente pergunta.',
					'default_value' => neuroaprender_ai_default_price_context(),
				),
				array(
					'key'           => 'field_na_ai_knowledge',
					'label'         => 'Base de conhecimento adicional',
					'name'          => 'na_ai_knowledge',
					'type'          => 'textarea',
					'rows'          => 8,
					'instructions'  => 'Use este campo para perguntas frequentes, regras de atendimento, informações sobre pacotes e respostas autorizadas pela clínica.',
					'default_value' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'position' => 'acf_after_title',
			'style'    => 'seamless',
		)
	);
}
add_action( 'acf/init', 'neuroaprender_register_acf_fields' );
