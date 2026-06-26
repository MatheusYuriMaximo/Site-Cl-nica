<?php
/**
 * Drag-and-drop content editor for the NeuroAprender landing.
 *
 * @package NeuroAprender
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function neuroaprender_builder_defaults(): array {
	return array(
		'space_items'    => array(
			array( 'title' => 'Entrada da clínica', 'image' => neuroaprender_asset_uri( 'assets/clinica/entrada.webp' ), 'alt' => 'Entrada da Clínica Escola NeuroAprender', 'featured' => '1' ),
			array( 'title' => 'Fachada', 'image' => neuroaprender_asset_uri( 'assets/clinica/frente.webp' ), 'alt' => 'Frente da Clínica Escola NeuroAprender', 'featured' => '' ),
			array( 'title' => 'Recepção', 'image' => neuroaprender_asset_uri( 'assets/clinica/recepcao-2.webp' ), 'alt' => 'Recepção da Clínica Escola NeuroAprender', 'featured' => '' ),
			array( 'title' => 'Recepção', 'image' => neuroaprender_asset_uri( 'assets/promocoes/promo-11.webp' ), 'alt' => 'Recepção da Clínica Escola NeuroAprender', 'featured' => '' ),
			array( 'title' => 'Atendimento clínico', 'image' => neuroaprender_asset_uri( 'assets/clinica/atendimento-clinico.webp' ), 'alt' => 'Sala de atendimento clínico', 'featured' => '' ),
			array( 'title' => 'Fonoaudiologia', 'image' => neuroaprender_asset_uri( 'assets/clinica/fono.webp' ), 'alt' => 'Sala de fonoaudiologia', 'featured' => '' ),
			array( 'title' => 'Terapia ocupacional', 'image' => neuroaprender_asset_uri( 'assets/clinica/ocupacional.webp' ), 'alt' => 'Sala de terapia ocupacional', 'featured' => '' ),
			array( 'title' => 'Psicomotricidade', 'image' => neuroaprender_asset_uri( 'assets/clinica/psicomotricista.webp' ), 'alt' => 'Sala de psicomotricidade', 'featured' => '' ),
			array( 'title' => 'Administração', 'image' => neuroaprender_asset_uri( 'assets/clinica/administracao.webp' ), 'alt' => 'Área administrativa da clínica', 'featured' => '' ),
			array( 'title' => 'Cozinha Terapêutica', 'image' => neuroaprender_asset_uri( 'assets/clinica/cozinha.webp' ), 'alt' => 'Cozinha Terapêutica da clínica', 'featured' => '' ),
		),
		'service_groups' => array(
			array(
				'title' => 'Avaliações',
				'items' => array(
					array( 'title' => 'Avaliação Neuropsicológica', 'text' => 'Investigação das funções cognitivas, emocionais e comportamentais.' ),
					array( 'title' => 'Avaliação Neuropsicopedagógica', 'text' => 'Compreensão das dificuldades de aprendizagem e desenvolvimento escolar.' ),
					array( 'title' => 'PIPE', 'text' => 'Programa de Intervenção Precoce Educacional para crianças pequenas.' ),
				),
			),
			array(
				'title' => 'Atendimentos clínicos',
				'items' => array(
					array( 'title' => 'Psicologia', 'text' => 'Acolhimento emocional, comportamento, orientação familiar e desenvolvimento.' ),
					array( 'title' => 'Neuropsicologia', 'text' => 'Avaliação e acompanhamento das funções cognitivas e comportamentais.' ),
					array( 'title' => 'Fisioterapia', 'text' => 'Acompanhamento motor, postural e funcional.' ),
					array( 'title' => 'Nutrição', 'text' => 'Orientação alimentar individualizada para saúde, desenvolvimento e rotina familiar.' ),
					array( 'title' => 'Psicomotricidade', 'text' => 'Estímulo das habilidades motoras, corporais, emocionais e sociais.' ),
					array( 'title' => 'Psicopedagogia', 'text' => 'Apoio no processo de aprendizagem e desenvolvimento escolar.' ),
					array( 'title' => 'Pedagogia', 'text' => 'Intervenções educacionais individualizadas.' ),
					array( 'title' => 'Clínico Geral', 'text' => 'Atendimento médico para acompanhamento da saúde.' ),
				),
			),
		),
		'packages'       => array(
			array( 'title' => 'NeuroLetras', 'text' => 'Apoio ao desenvolvimento da leitura e escrita.', 'accent' => 'accent-blue' ),
			array( 'title' => 'NeuroAdvance', 'text' => 'Estímulo global para aprendizagem e desenvolvimento.', 'accent' => 'accent-green' ),
			array( 'title' => 'NeuroFoco Plus', 'text' => 'Organização, atenção e fortalecimento das habilidades escolares.', 'accent' => 'accent-purple' ),
			array( 'title' => 'NeuroFoco Impulso', 'text' => 'Intervenções para foco, rotina e autonomia.', 'accent' => 'accent-gold' ),
			array( 'title' => 'NeuroFoco Essencial', 'text' => 'Base de apoio para crianças em processo de aprendizagem.', 'accent' => 'accent-yellow' ),
		),
		'promo_items'    => array_map(
			static function ( int $number ): array {
				return array(
					'image' => neuroaprender_asset_uri( sprintf( 'assets/promocoes/promo-%02d.webp', $number ) ),
					'alt'   => 'Material informativo da Clínica Escola NeuroAprender',
				);
			},
			array( 1, 3, 4, 5, 6, 7, 8, 9, 10 )
		),
		'team_items'     => array_map(
			static function ( int $number ): array {
				return array(
					'image' => neuroaprender_asset_uri( sprintf( 'assets/promocoes/promo-%02d.webp', $number ) ),
					'alt'   => 'Material da equipe NeuroAprender',
				);
			},
			array( 23, 22, 21, 20, 19, 18, 17, 16, 15, 14, 13, 2 )
		),
		'benefits'       => array(
			array( 'text' => 'Atendimento humanizado e acolhedor' ),
			array( 'text' => 'Equipe interdisciplinar' ),
			array( 'text' => 'Olhar individualizado para cada criança' ),
			array( 'text' => 'Orientação para famílias' ),
			array( 'text' => 'Integração entre saúde, educação e desenvolvimento' ),
			array( 'text' => 'Espaço pensado para o público infantil' ),
			array( 'text' => 'Acompanhamento com objetivos claros' ),
		),
	);
}

function neuroaprender_builder_data(): array {
	$defaults = neuroaprender_builder_defaults();
	$saved    = get_option( 'neuroaprender_landing_builder', array() );

	if ( ! is_array( $saved ) ) {
		return $defaults;
	}

	foreach ( $defaults as $key => $value ) {
		if ( ! array_key_exists( $key, $saved ) || ! is_array( $saved[ $key ] ) ) {
			$saved[ $key ] = $value;
		}
	}

	return $saved;
}

function neuroaprender_builder_items( string $key ): array {
	$data = neuroaprender_builder_data();

	return isset( $data[ $key ] ) && is_array( $data[ $key ] ) ? $data[ $key ] : array();
}

function neuroaprender_builder_sanitize_image_items( array $items, bool $has_title = false ): array {
	$clean = array();

	foreach ( $items as $item ) {
		if ( ! is_array( $item ) ) {
			continue;
		}

		$image = isset( $item['image'] ) ? esc_url_raw( (string) $item['image'] ) : '';
		$title = $has_title && isset( $item['title'] ) ? sanitize_text_field( (string) $item['title'] ) : '';

		if ( '' === $image && '' === $title ) {
			continue;
		}

		$row = array(
			'image' => $image,
			'alt'   => isset( $item['alt'] ) ? sanitize_text_field( (string) $item['alt'] ) : '',
		);

		if ( $has_title ) {
			$row['title']    = $title;
			$row['featured'] = ! empty( $item['featured'] ) ? '1' : '';
		}

		$clean[] = $row;
	}

	return $clean;
}

function neuroaprender_builder_sanitize_text_items( array $items, bool $with_title = false ): array {
	$clean = array();

	foreach ( $items as $item ) {
		if ( ! is_array( $item ) ) {
			continue;
		}

		$title = isset( $item['title'] ) ? sanitize_text_field( (string) $item['title'] ) : '';
		$text  = isset( $item['text'] ) ? sanitize_textarea_field( (string) $item['text'] ) : '';

		if ( '' === $title && '' === $text ) {
			continue;
		}

		$row = array( 'text' => $text );

		if ( $with_title ) {
			$row['title'] = $title;
		}

		if ( isset( $item['accent'] ) ) {
			$row['accent'] = sanitize_html_class( (string) $item['accent'] );
		}

		$clean[] = $row;
	}

	return $clean;
}

function neuroaprender_builder_sanitize_services( array $groups ): array {
	$clean = array();

	foreach ( $groups as $group ) {
		if ( ! is_array( $group ) ) {
			continue;
		}

		$title = isset( $group['title'] ) ? sanitize_text_field( (string) $group['title'] ) : '';
		$items = isset( $group['items'] ) && is_array( $group['items'] ) ? neuroaprender_builder_sanitize_text_items( $group['items'], true ) : array();

		if ( '' === $title && empty( $items ) ) {
			continue;
		}

		$clean[] = array(
			'title' => $title,
			'items' => $items,
		);
	}

	return $clean;
}

function neuroaprender_handle_save_landing_builder(): void {
	if ( ! current_user_can( 'edit_pages' ) ) {
		wp_die( esc_html__( 'Sem permissao para editar a landing.', 'neuroaprender' ) );
	}

	check_admin_referer( 'neuroaprender_save_landing_builder' );

	$raw = isset( $_POST['na_builder'] ) && is_array( $_POST['na_builder'] ) ? wp_unslash( $_POST['na_builder'] ) : array();

	$data = array(
		'space_items'    => isset( $raw['space_items'] ) && is_array( $raw['space_items'] ) ? neuroaprender_builder_sanitize_image_items( $raw['space_items'], true ) : array(),
		'service_groups' => isset( $raw['service_groups'] ) && is_array( $raw['service_groups'] ) ? neuroaprender_builder_sanitize_services( $raw['service_groups'] ) : array(),
		'packages'       => isset( $raw['packages'] ) && is_array( $raw['packages'] ) ? neuroaprender_builder_sanitize_text_items( $raw['packages'], true ) : array(),
		'promo_items'    => isset( $raw['promo_items'] ) && is_array( $raw['promo_items'] ) ? neuroaprender_builder_sanitize_image_items( $raw['promo_items'] ) : array(),
		'team_items'     => isset( $raw['team_items'] ) && is_array( $raw['team_items'] ) ? neuroaprender_builder_sanitize_image_items( $raw['team_items'] ) : array(),
		'benefits'       => isset( $raw['benefits'] ) && is_array( $raw['benefits'] ) ? neuroaprender_builder_sanitize_text_items( $raw['benefits'] ) : array(),
	);

	update_option( 'neuroaprender_landing_builder', $data, false );

	wp_safe_redirect( add_query_arg( 'na_builder_saved', '1', admin_url( 'admin.php?page=neuroaprender-builder' ) ) );
	exit;
}
add_action( 'admin_post_neuroaprender_save_landing_builder', 'neuroaprender_handle_save_landing_builder' );

function neuroaprender_landing_builder_admin_page(): void {
	$data = neuroaprender_builder_data();
	wp_enqueue_media();
	wp_enqueue_script( 'jquery-ui-sortable' );
	?>
	<div class="wrap na-builder">
		<h1>Editor visual da landing</h1>
		<p>Arraste os blocos para reordenar. Use os botoes para adicionar, remover e escolher imagens da biblioteca do WordPress.</p>
		<?php if ( isset( $_GET['na_builder_saved'] ) ) : ?>
			<div class="notice notice-success inline"><p><strong>Conteudo salvo.</strong> Atualize o site publicado para conferir.</p></div>
		<?php endif; ?>

		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php wp_nonce_field( 'neuroaprender_save_landing_builder' ); ?>
			<input type="hidden" name="action" value="neuroaprender_save_landing_builder">

			<?php neuroaprender_builder_render_image_section( 'Nosso espaço', 'space_items', $data['space_items'], true ); ?>
			<?php neuroaprender_builder_render_services_section( $data['service_groups'] ); ?>
			<?php neuroaprender_builder_render_text_section( 'Pacotes educacionais', 'packages', $data['packages'], true ); ?>
			<?php neuroaprender_builder_render_image_section( 'Carrossel de avaliações e condições especiais', 'promo_items', $data['promo_items'], false ); ?>
			<?php neuroaprender_builder_render_image_section( 'Carrossel da equipe', 'team_items', $data['team_items'], false ); ?>
			<?php neuroaprender_builder_render_text_section( 'Diferenciais', 'benefits', $data['benefits'], false ); ?>

			<p class="submit">
				<button class="button button-primary button-hero" type="submit">Salvar alterações</button>
			</p>
		</form>
	</div>
	<?php
	neuroaprender_builder_admin_assets();
}

function neuroaprender_builder_render_image_section( string $title, string $key, array $items, bool $has_title ): void {
	?>
	<section class="na-builder-section" data-section="<?php echo esc_attr( $key ); ?>" data-kind="<?php echo $has_title ? 'titled-image' : 'image'; ?>">
		<h2><?php echo esc_html( $title ); ?></h2>
		<div class="na-sortable">
			<?php foreach ( $items as $index => $item ) : ?>
				<?php neuroaprender_builder_render_image_item( $key, (string) $index, $item, $has_title ); ?>
			<?php endforeach; ?>
		</div>
		<button class="button na-add-item" type="button">Adicionar imagem</button>
	</section>
	<?php
}

function neuroaprender_builder_render_image_item( string $key, string $index, array $item, bool $has_title ): void {
	?>
	<div class="na-builder-item">
		<span class="na-drag" aria-hidden="true">↕</span>
		<?php if ( $has_title ) : ?>
			<label>Titulo <input type="text" name="na_builder[<?php echo esc_attr( $key ); ?>][<?php echo esc_attr( $index ); ?>][title]" value="<?php echo esc_attr( $item['title'] ?? '' ); ?>"></label>
		<?php endif; ?>
		<label>Imagem <input class="na-image-url" type="url" name="na_builder[<?php echo esc_attr( $key ); ?>][<?php echo esc_attr( $index ); ?>][image]" value="<?php echo esc_attr( $item['image'] ?? '' ); ?>"></label>
		<button class="button na-pick-image" type="button">Escolher imagem</button>
		<label>Texto alternativo <input type="text" name="na_builder[<?php echo esc_attr( $key ); ?>][<?php echo esc_attr( $index ); ?>][alt]" value="<?php echo esc_attr( $item['alt'] ?? '' ); ?>"></label>
		<?php if ( $has_title ) : ?>
			<label class="na-check"><input type="checkbox" name="na_builder[<?php echo esc_attr( $key ); ?>][<?php echo esc_attr( $index ); ?>][featured]" value="1" <?php checked( ! empty( $item['featured'] ) ); ?>> destaque</label>
		<?php endif; ?>
		<button class="button-link-delete na-remove-item" type="button">Remover</button>
	</div>
	<?php
}

function neuroaprender_builder_render_text_section( string $title, string $key, array $items, bool $with_title ): void {
	?>
	<section class="na-builder-section" data-section="<?php echo esc_attr( $key ); ?>" data-kind="<?php echo $with_title ? 'text-card' : 'text'; ?>">
		<h2><?php echo esc_html( $title ); ?></h2>
		<div class="na-sortable">
			<?php foreach ( $items as $index => $item ) : ?>
				<?php neuroaprender_builder_render_text_item( $key, (string) $index, $item, $with_title ); ?>
			<?php endforeach; ?>
		</div>
		<button class="button na-add-item" type="button">Adicionar item</button>
	</section>
	<?php
}

function neuroaprender_builder_render_text_item( string $key, string $index, array $item, bool $with_title ): void {
	?>
	<div class="na-builder-item">
		<span class="na-drag" aria-hidden="true">↕</span>
		<?php if ( $with_title ) : ?>
			<label>Titulo <input type="text" name="na_builder[<?php echo esc_attr( $key ); ?>][<?php echo esc_attr( $index ); ?>][title]" value="<?php echo esc_attr( $item['title'] ?? '' ); ?>"></label>
		<?php endif; ?>
		<label>Texto <textarea name="na_builder[<?php echo esc_attr( $key ); ?>][<?php echo esc_attr( $index ); ?>][text]" rows="3"><?php echo esc_textarea( $item['text'] ?? '' ); ?></textarea></label>
		<?php if ( isset( $item['accent'] ) || 'packages' === $key ) : ?>
			<label>Cor <select name="na_builder[<?php echo esc_attr( $key ); ?>][<?php echo esc_attr( $index ); ?>][accent]">
				<?php foreach ( array( 'accent-blue', 'accent-green', 'accent-purple', 'accent-gold', 'accent-yellow' ) as $accent ) : ?>
					<option value="<?php echo esc_attr( $accent ); ?>" <?php selected( $item['accent'] ?? 'accent-blue', $accent ); ?>><?php echo esc_html( $accent ); ?></option>
				<?php endforeach; ?>
			</select></label>
		<?php endif; ?>
		<button class="button-link-delete na-remove-item" type="button">Remover</button>
	</div>
	<?php
}

function neuroaprender_builder_render_services_section( array $groups ): void {
	?>
	<section class="na-builder-section na-services-builder" data-section="service_groups" data-kind="services">
		<h2>Serviços</h2>
		<div class="na-sortable na-service-groups">
			<?php foreach ( $groups as $group_index => $group ) : ?>
				<div class="na-builder-item na-service-group">
					<span class="na-drag" aria-hidden="true">↕</span>
					<label>Grupo <input type="text" name="na_builder[service_groups][<?php echo esc_attr( (string) $group_index ); ?>][title]" value="<?php echo esc_attr( $group['title'] ?? '' ); ?>"></label>
					<div class="na-sortable na-service-items">
						<?php foreach ( (array) ( $group['items'] ?? array() ) as $item_index => $item ) : ?>
							<?php neuroaprender_builder_render_service_item( (string) $group_index, (string) $item_index, $item ); ?>
						<?php endforeach; ?>
					</div>
					<button class="button na-add-service" type="button">Adicionar caixa neste grupo</button>
					<button class="button-link-delete na-remove-item" type="button">Remover grupo</button>
				</div>
			<?php endforeach; ?>
		</div>
		<button class="button na-add-service-group" type="button">Adicionar grupo de serviços</button>
	</section>
	<?php
}

function neuroaprender_builder_render_service_item( string $group_index, string $item_index, array $item ): void {
	?>
	<div class="na-builder-item na-service-card-admin">
		<span class="na-drag" aria-hidden="true">↕</span>
		<label>Titulo <input type="text" name="na_builder[service_groups][<?php echo esc_attr( $group_index ); ?>][items][<?php echo esc_attr( $item_index ); ?>][title]" value="<?php echo esc_attr( $item['title'] ?? '' ); ?>"></label>
		<label>Texto <textarea name="na_builder[service_groups][<?php echo esc_attr( $group_index ); ?>][items][<?php echo esc_attr( $item_index ); ?>][text]" rows="3"><?php echo esc_textarea( $item['text'] ?? '' ); ?></textarea></label>
		<button class="button-link-delete na-remove-item" type="button">Remover</button>
	</div>
	<?php
}

function neuroaprender_builder_admin_assets(): void {
	?>
	<style>
		.na-builder-section { margin: 24px 0; padding: 18px; background: #fff; border: 1px solid #dcdcde; border-radius: 8px; }
		.na-builder-section h2 { margin-top: 0; }
		.na-builder-item { display: grid; grid-template-columns: 28px minmax(180px, 1fr) minmax(220px, 1.3fr) auto; gap: 12px; align-items: end; margin: 10px 0; padding: 12px; background: #f6f7f7; border: 1px solid #dcdcde; border-radius: 8px; }
		.na-service-group { grid-template-columns: 28px 1fr auto; align-items: start; background: #fff; }
		.na-service-items { grid-column: 2 / -1; width: 100%; }
		.na-service-card-admin { grid-template-columns: 28px minmax(180px, 1fr) minmax(220px, 1.5fr) auto; background: #f6f7f7; }
		.na-builder-item label { display: grid; gap: 5px; font-weight: 600; }
		.na-builder-item input[type="text"], .na-builder-item input[type="url"], .na-builder-item textarea, .na-builder-item select { width: 100%; }
		.na-drag { cursor: move; align-self: center; color: #646970; font-size: 20px; }
		.na-check { align-self: center; }
		.ui-sortable-placeholder { min-height: 58px; border: 2px dashed #2271b1; background: #eef6fc; visibility: visible !important; }
		@media (max-width: 900px) { .na-builder-item, .na-service-card-admin { grid-template-columns: 28px 1fr; } .na-builder-item .button, .na-builder-item .button-link-delete { justify-self: start; } }
	</style>
	<script>
		jQuery(function($) {
			const nextKey = () => 'new_' + Date.now() + '_' + Math.floor(Math.random() * 10000);
			const sortable = () => $('.na-sortable').sortable({ handle: '.na-drag', placeholder: 'ui-sortable-placeholder' });
			sortable();

			$(document).on('click', '.na-remove-item', function() {
				$(this).closest('.na-builder-item').remove();
			});

			$(document).on('click', '.na-pick-image', function() {
				const field = $(this).siblings('label').find('.na-image-url');
				const frame = wp.media({ title: 'Escolher imagem', button: { text: 'Usar esta imagem' }, multiple: false });
				frame.on('select', function() {
					const attachment = frame.state().get('selection').first().toJSON();
					field.val(attachment.url).trigger('change');
				});
				frame.open();
			});

			$(document).on('click', '.na-add-item', function() {
				const section = $(this).closest('.na-builder-section');
				const key = section.data('section');
				const kind = section.data('kind');
				const i = nextKey();
				let html = '';

				if (kind === 'titled-image') {
					html = `<div class="na-builder-item"><span class="na-drag">↕</span><label>Titulo <input type="text" name="na_builder[${key}][${i}][title]"></label><label>Imagem <input class="na-image-url" type="url" name="na_builder[${key}][${i}][image]"></label><button class="button na-pick-image" type="button">Escolher imagem</button><label>Texto alternativo <input type="text" name="na_builder[${key}][${i}][alt]"></label><label class="na-check"><input type="checkbox" name="na_builder[${key}][${i}][featured]" value="1"> destaque</label><button class="button-link-delete na-remove-item" type="button">Remover</button></div>`;
				} else if (kind === 'image') {
					html = `<div class="na-builder-item"><span class="na-drag">↕</span><label>Imagem <input class="na-image-url" type="url" name="na_builder[${key}][${i}][image]"></label><button class="button na-pick-image" type="button">Escolher imagem</button><label>Texto alternativo <input type="text" name="na_builder[${key}][${i}][alt]"></label><button class="button-link-delete na-remove-item" type="button">Remover</button></div>`;
				} else {
					const titleField = kind === 'text-card' ? `<label>Titulo <input type="text" name="na_builder[${key}][${i}][title]"></label>` : '';
					const accentField = key === 'packages' ? `<label>Cor <select name="na_builder[${key}][${i}][accent]"><option value="accent-blue">accent-blue</option><option value="accent-green">accent-green</option><option value="accent-purple">accent-purple</option><option value="accent-gold">accent-gold</option><option value="accent-yellow">accent-yellow</option></select></label>` : '';
					html = `<div class="na-builder-item"><span class="na-drag">↕</span>${titleField}<label>Texto <textarea name="na_builder[${key}][${i}][text]" rows="3"></textarea></label>${accentField}<button class="button-link-delete na-remove-item" type="button">Remover</button></div>`;
				}

				section.find('> .na-sortable').append(html);
				sortable();
			});

			$(document).on('click', '.na-add-service-group', function() {
				const g = nextKey();
				$('.na-service-groups').append(`<div class="na-builder-item na-service-group"><span class="na-drag">↕</span><label>Grupo <input type="text" name="na_builder[service_groups][${g}][title]"></label><div class="na-sortable na-service-items"></div><button class="button na-add-service" type="button">Adicionar caixa neste grupo</button><button class="button-link-delete na-remove-item" type="button">Remover grupo</button></div>`);
				sortable();
			});

			$(document).on('click', '.na-add-service', function() {
				const group = $(this).closest('.na-service-group');
				const groupName = group.find('input[name*="[title]"]').attr('name').split('[service_groups][')[1].split(']')[0];
				const i = nextKey();
				group.find('.na-service-items').append(`<div class="na-builder-item na-service-card-admin"><span class="na-drag">↕</span><label>Titulo <input type="text" name="na_builder[service_groups][${groupName}][items][${i}][title]"></label><label>Texto <textarea name="na_builder[service_groups][${groupName}][items][${i}][text]" rows="3"></textarea></label><button class="button-link-delete na-remove-item" type="button">Remover</button></div>`);
				sortable();
			});
		});
	</script>
	<?php
}
