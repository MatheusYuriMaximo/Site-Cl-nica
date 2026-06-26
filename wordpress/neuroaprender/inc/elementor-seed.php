<?php
/**
 * Elementor starter content for the NeuroAprender landing page.
 *
 * @package NeuroAprender
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function neuroaprender_elementor_id( string $seed ): string {
	return substr( md5( $seed ), 0, 7 );
}

function neuroaprender_elementor_widget( string $seed, string $type, array $settings ): array {
	return array(
		'id'         => neuroaprender_elementor_id( $seed ),
		'elType'     => 'widget',
		'widgetType' => $type,
		'settings'   => $settings,
		'elements'   => array(),
	);
}

function neuroaprender_elementor_column( string $seed, int $size, array $elements ): array {
	return array(
		'id'       => neuroaprender_elementor_id( $seed ),
		'elType'   => 'column',
		'settings' => array(
			'_column_size' => $size,
		),
		'elements' => $elements,
	);
}

function neuroaprender_elementor_section( string $seed, array $columns, array $settings = array() ): array {
	return array(
		'id'       => neuroaprender_elementor_id( $seed ),
		'elType'   => 'section',
		'settings' => array_merge(
			array(
				'layout'            => 'boxed',
				'content_width'     => array( 'size' => 1180, 'unit' => 'px' ),
				'padding'           => array(
					'unit'     => 'px',
					'top'      => '70',
					'right'    => '20',
					'bottom'   => '70',
					'left'     => '20',
					'isLinked' => false,
				),
				'background_background' => 'classic',
			),
			$settings
		),
		'elements' => $columns,
	);
}

function neuroaprender_elementor_heading( string $seed, string $title, string $size = 'h2' ): array {
	return neuroaprender_elementor_widget(
		$seed,
		'heading',
		array(
			'title'       => $title,
			'header_size' => $size,
		)
	);
}

function neuroaprender_elementor_text( string $seed, string $text ): array {
	return neuroaprender_elementor_widget(
		$seed,
		'text-editor',
		array(
			'editor' => wpautop( $text ),
		)
	);
}

function neuroaprender_elementor_button( string $seed, string $text, string $url ): array {
	return neuroaprender_elementor_widget(
		$seed,
		'button',
		array(
			'text'      => $text,
			'link'      => array(
				'url'         => $url,
				'is_external' => true,
				'nofollow'    => true,
			),
			'size'      => 'lg',
			'button_type' => 'info',
		)
	);
}

function neuroaprender_elementor_image( string $seed, string $url, string $caption = '' ): array {
	return neuroaprender_elementor_widget(
		$seed,
		'image',
		array(
			'image'   => array(
				'url' => $url,
				'id'  => '',
			),
			'caption' => $caption,
		)
	);
}

function neuroaprender_elementor_carousel( string $seed, array $images ): array {
	$slides = array();

	foreach ( $images as $image ) {
		$slides[] = array(
			'id'  => '',
			'url' => $image,
		);
	}

	return neuroaprender_elementor_widget(
		$seed,
		'image-carousel',
		array(
			'carousel'       => $slides,
			'slides_to_show' => '3',
			'navigation'     => 'both',
			'pause_on_hover' => 'yes',
			'autoplay'       => '',
			'image_stretch'  => 'yes',
		)
	);
}

function neuroaprender_elementor_assets( string $folder, array $files ): array {
	$assets = array();

	foreach ( $files as $file ) {
		$assets[] = neuroaprender_asset_uri( 'assets/' . $folder . '/' . $file );
	}

	return $assets;
}

function neuroaprender_build_elementor_landing_data(): array {
	$whatsapp = neuroaprender_whatsapp_url();
	$space_images = neuroaprender_elementor_assets(
		'clinica',
		array(
			'recepcao-5.webp',
			'administracao.webp',
			'atendimento-clinico.webp',
			'cozinha.webp',
			'fono.webp',
			'psicomotricista.webp',
			'ocupacional.webp',
			'frente.webp',
		)
	);
	$promo_images = neuroaprender_elementor_assets(
		'promocoes',
		array(
			'promo-01.webp',
			'promo-03.webp',
			'promo-04.webp',
			'promo-05.webp',
			'promo-06.webp',
			'promo-07.webp',
			'promo-08.webp',
			'promo-09.webp',
			'promo-10.webp',
		)
	);
	$team_images = neuroaprender_elementor_assets(
		'promocoes',
		array(
			'promo-23.webp',
			'promo-22.webp',
			'promo-21.webp',
			'promo-20.webp',
			'promo-19.webp',
			'promo-18.webp',
			'promo-17.webp',
			'promo-16.webp',
			'promo-15.webp',
			'promo-14.webp',
			'promo-13.webp',
			'promo-02.webp',
		)
	);

	return array(
		neuroaprender_elementor_section(
			'hero',
			array(
				neuroaprender_elementor_column(
					'hero-left',
					55,
					array(
						neuroaprender_elementor_heading( 'hero-eyebrow', 'Desenvolvimento infantil, saúde e aprendizagem', 'h6' ),
						neuroaprender_elementor_heading( 'hero-title', 'Clínica Escola NeuroAprender', 'h1' ),
						neuroaprender_elementor_heading( 'hero-line', 'Todo cérebro aprende.', 'h2' ),
						neuroaprender_elementor_text( 'hero-text', 'Cada criança tem seu tempo, e nós caminhamos junto com ela. Unimos acolhimento, ciência e cuidado para apoiar o desenvolvimento infantil, a aprendizagem e o bem-estar das famílias.' ),
						neuroaprender_elementor_button( 'hero-button', 'Agendar avaliação', $whatsapp ),
					)
				),
				neuroaprender_elementor_column(
					'hero-right',
					45,
					array(
						neuroaprender_elementor_image( 'hero-mascot', neuroaprender_asset_uri( 'assets/mascote-neuroaprender-novo-transparente.webp' ), 'Atendimento interdisciplinar' ),
					)
				),
			)
		),
		neuroaprender_elementor_section(
			'sobre',
			array(
				neuroaprender_elementor_column(
					'sobre-col',
					100,
					array(
						neuroaprender_elementor_heading( 'sobre-title', 'Cuidado que acolhe, orientação que transforma' ),
						neuroaprender_elementor_text( 'sobre-text', 'A Clínica Escola NeuroAprender oferece atendimentos especializados para crianças, adolescentes e famílias, com olhar humano, interdisciplinar e individualizado.' ),
					)
				),
			)
		),
		neuroaprender_elementor_section(
			'espaco',
			array(
				neuroaprender_elementor_column(
					'espaco-col',
					100,
					array(
						neuroaprender_elementor_heading( 'espaco-title', 'Ambientes preparados para acolher crianças, adolescentes e famílias' ),
						neuroaprender_elementor_text( 'espaco-text', 'Recepção, consultórios, cozinha terapêutica e salas de atendimento organizadas para conforto, privacidade e cuidado.' ),
						neuroaprender_elementor_carousel( 'espaco-carousel', $space_images ),
					)
				),
			)
		),
		neuroaprender_elementor_section(
			'servicos',
			array(
				neuroaprender_elementor_column(
					'servicos-col',
					100,
					array(
						neuroaprender_elementor_heading( 'servicos-title', 'Serviços especializados para desenvolvimento, saúde e aprendizagem' ),
						neuroaprender_elementor_text( 'servicos-text', 'Psicologia, Neuropsicologia, Psicopedagogia, Neuropsicopedagogia, Fonoaudiologia, Terapia Ocupacional, ABA, Psicomotricidade, Fisioterapia Infantil, Fisioterapia, Consulta Médica, Nutrição, Avaliação Neuropsicológica, Avaliação Neuropsicopedagógica e PIPE.' ),
					)
				),
			)
		),
		neuroaprender_elementor_section(
			'pacotes',
			array(
				neuroaprender_elementor_column(
					'pacotes-col',
					100,
					array(
						neuroaprender_elementor_heading( 'pacotes-title', 'Pacotes educacionais NeuroAprender' ),
						neuroaprender_elementor_text( 'pacotes-text', 'NeuroAdvance, NeuroLetras, NeuroFoco Plus, NeuroFoco Impulso e NeuroFoco Essencial. Os textos, caixas e valores podem ser editados livremente no Elementor.' ),
						neuroaprender_elementor_button( 'pacotes-button', 'Agendar avaliação', $whatsapp ),
					)
				),
			)
		),
		neuroaprender_elementor_section(
			'avaliacoes',
			array(
				neuroaprender_elementor_column(
					'avaliacoes-col',
					100,
					array(
						neuroaprender_elementor_heading( 'avaliacoes-title', 'Avaliações e condições especiais' ),
						neuroaprender_elementor_carousel( 'avaliacoes-carousel', $promo_images ),
					)
				),
			)
		),
		neuroaprender_elementor_section(
			'equipe',
			array(
				neuroaprender_elementor_column(
					'equipe-col',
					100,
					array(
						neuroaprender_elementor_heading( 'equipe-title', 'Nossa equipe' ),
						neuroaprender_elementor_text( 'equipe-text', 'Profissionais preparados para acolher, avaliar e acompanhar cada etapa do atendimento.' ),
						neuroaprender_elementor_carousel( 'equipe-carousel', $team_images ),
					)
				),
			)
		),
		neuroaprender_elementor_section(
			'contato',
			array(
				neuroaprender_elementor_column(
					'contato-col',
					100,
					array(
						neuroaprender_elementor_heading( 'contato-title', 'Entre em contato' ),
						neuroaprender_elementor_text( 'contato-text', "WhatsApp: +55 96 9169-0204\nInstagram: @clinicaescolaneuroaprender\nEndereço: Av. Quinze de Julho, 1039 - Buritizal, Macapá - AP, 68904-720\nHorário: 08:00 às 12:00 e 14:00 às 18:00" ),
						neuroaprender_elementor_button( 'contato-button', 'Chamar no WhatsApp', $whatsapp ),
					)
				),
			)
		),
	);
}

function neuroaprender_seed_elementor_landing( int $page_id ): void {
	$data = neuroaprender_build_elementor_landing_data();

	wp_update_post(
		array(
			'ID'           => $page_id,
			'post_content' => '',
		)
	);

	update_post_meta( $page_id, '_elementor_edit_mode', 'builder' );
	update_post_meta( $page_id, '_elementor_template_type', 'wp-page' );
	update_post_meta( $page_id, '_elementor_version', defined( 'ELEMENTOR_VERSION' ) ? ELEMENTOR_VERSION : '3.0.0' );
	update_post_meta( $page_id, '_elementor_data', wp_slash( wp_json_encode( $data ) ) );
	update_post_meta( $page_id, '_elementor_page_settings', array( 'hide_title' => 'yes' ) );
	update_post_meta( $page_id, '_wp_page_template', 'default' );
}

function neuroaprender_handle_seed_elementor_landing(): void {
	if ( ! current_user_can( 'edit_pages' ) ) {
		wp_die( esc_html__( 'Sem permissao para editar paginas.', 'neuroaprender' ) );
	}

	check_admin_referer( 'neuroaprender_seed_elementor_landing' );

	if ( ! did_action( 'elementor/loaded' ) && ! defined( 'ELEMENTOR_VERSION' ) ) {
		wp_safe_redirect( add_query_arg( 'na_elementor_seed', 'missing_elementor', admin_url( 'admin.php?page=neuroaprender-landing' ) ) );
		exit;
	}

	$page_id = neuroaprender_landing_page_id();

	if ( $page_id <= 0 ) {
		$page_id = wp_insert_post(
			array(
				'post_title'  => 'Início',
				'post_type'   => 'page',
				'post_status' => 'publish',
			)
		);

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $page_id );
	}

	if ( is_wp_error( $page_id ) || $page_id <= 0 ) {
		wp_safe_redirect( add_query_arg( 'na_elementor_seed', 'error', admin_url( 'admin.php?page=neuroaprender-landing' ) ) );
		exit;
	}

	neuroaprender_seed_elementor_landing( (int) $page_id );

	wp_safe_redirect( add_query_arg( 'na_elementor_seed', 'success', admin_url( 'admin.php?page=neuroaprender-landing' ) ) );
	exit;
}
add_action( 'admin_post_neuroaprender_seed_elementor_landing', 'neuroaprender_handle_seed_elementor_landing' );
