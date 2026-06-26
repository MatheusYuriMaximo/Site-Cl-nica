<?php
/**
 * Front page template for the NeuroAprender landing page.
 *
 * @package NeuroAprender
 */

get_header();
$na_whatsapp_url       = neuroaprender_whatsapp_url();
$na_whatsapp_number    = (string) neuroaprender_field( 'na_whatsapp_number', '+55 96 9169-0204' );
$na_instagram_label    = (string) neuroaprender_field( 'na_instagram_label', '@clinicaescolaneuroaprender' );
$na_instagram_url      = (string) neuroaprender_field( 'na_instagram_url', 'https://www.instagram.com/clinicaescolaneuroaprender' );
$na_address            = (string) neuroaprender_field( 'na_address', 'Av. Quinze de Julho, 1039 - Buritizal, Macapá - AP, 68904-720, Brasil' );
$na_hours              = (string) neuroaprender_field( 'na_hours', '08:00 às 12:00 e 14:00 às 18:00' );
$na_maps_url           = neuroaprender_maps_url();
$na_mascot_url         = neuroaprender_image_uri( 'na_mascot_image', 'assets/mascote-neuroaprender-novo-transparente.webp' );
?>
<header class="site-header" id="inicio">
      <a class="brand" href="#inicio" aria-label="Clínica Escola NeuroAprender">
        <span class="brand-mark" aria-hidden="true">N</span>
        <span>
          <strong>NeuroAprender</strong>
          <small>Clínica Escola</small>
        </span>
      </a>

      <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-nav">
        <span class="sr-only">Abrir menu</span>
        <span></span>
        <span></span>
        <span></span>
      </button>

      <nav class="site-nav" id="site-nav" aria-label="Navegação principal">
        <a href="#inicio">Início</a>
        <a href="#sobre">Sobre nós</a>
        <a href="#espaco">Espaço</a>
        <a href="#servicos">Serviços</a>
        <a href="#pacotes">Pacotes</a>
        <a href="#avaliacoes">Avaliações</a>
        <a href="#profissionais">Profissionais</a>
        <a href="#contato">Contato</a>
      </nav>

      <a class="header-cta" href="<?php echo esc_url( $na_whatsapp_url ); ?>" target="_blank" rel="noopener">
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"></path>
          <path d="M8 9h8"></path>
          <path d="M8 13h5"></path>
        </svg>
        Agendar pelo WhatsApp
      </a>
    </header>

    <main>
      <section class="hero section-band" aria-labelledby="hero-title">
        <div class="hero-copy">
          <p class="eyebrow"><?php neuroaprender_text( 'na_hero_eyebrow', 'Desenvolvimento infantil, saúde e aprendizagem' ); ?></p>
          <h1 id="hero-title"><?php neuroaprender_text( 'na_hero_title_prefix', 'Clínica Escola' ); ?> <span class="keep-together"><?php neuroaprender_text( 'na_hero_title_highlight', 'NeuroAprender' ); ?></span></h1>
          <p class="hero-line"><?php neuroaprender_text( 'na_hero_line', 'Todo cérebro aprende.' ); ?></p>
          <p class="hero-subtitle">
            <?php neuroaprender_text( 'na_hero_subtitle', 'Cada criança tem seu tempo, e nós caminhamos junto com ela.' ); ?>
          </p>
          <p class="hero-text">
            <?php neuroaprender_rich_text( 'na_hero_text', 'Unimos acolhimento, ciência e cuidado para apoiar o desenvolvimento infantil, a aprendizagem e o bem-estar das famílias.' ); ?>
          </p>
          <div class="hero-actions" aria-label="Ações principais">
            <a class="button button-primary" href="<?php echo esc_url( $na_whatsapp_url ); ?>" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.32 1.77.6 2.61a2 2 0 0 1-.45 2.11L8 9.7a16 16 0 0 0 6.3 6.3l1.26-1.26a2 2 0 0 1 2.11-.45c.84.28 1.71.48 2.61.6A2 2 0 0 1 22 16.92z"></path>
              </svg>
              Agendar avaliação
            </a>
            <a class="button button-secondary" href="#servicos">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M5 12h14"></path>
                <path d="m12 5 7 7-7 7"></path>
              </svg>
              Conhecer serviços
            </a>
          </div>
        </div>

        <div class="hero-visual" aria-label="Mascote da Clínica Escola NeuroAprender">
          <img src="<?php echo esc_url( $na_mascot_url ); ?>" alt="Mascote infantil acolhedor da Clínica Escola NeuroAprender" loading="eager" decoding="async" fetchpriority="high">
          <div class="hero-note">
            <strong><?php neuroaprender_text( 'na_hero_note_title', 'Atendimento interdisciplinar' ); ?></strong>
            <span><?php neuroaprender_text( 'na_hero_note_text', 'Saúde, educação e família caminhando juntas.' ); ?></span>
          </div>
        </div>
      </section>

      <section class="intro-strip" aria-label="Diferenciais rápidos">
        <div>
          <strong>Equipe interdisciplinar</strong>
          <span>Olhar amplo para cada necessidade.</span>
        </div>
        <div>
          <strong>Cuidado individualizado</strong>
          <span>Objetivos claros para cada criança.</span>
        </div>
        <div>
          <strong>Orientação familiar</strong>
          <span>Acolhimento também para quem cuida.</span>
        </div>
      </section>

      <section class="section" id="sobre" aria-labelledby="sobre-title">
        <div class="section-heading">
          <p class="eyebrow">Sobre a clínica</p>
          <h2 id="sobre-title"><?php neuroaprender_text( 'na_about_title', 'Cuidado que acolhe, orientação que transforma' ); ?></h2>
        </div>
        <div class="split-content">
          <p>
            <?php neuroaprender_rich_text( 'na_about_text_1', 'A Clínica Escola NeuroAprender nasceu com o propósito de oferecer atendimentos especializados para crianças, adolescentes e famílias, com um olhar humano, interdisciplinar e individualizado.' ); ?>
          </p>
          <p>
            <?php neuroaprender_rich_text( 'na_about_text_2', 'Trabalhamos com profissionais de diferentes áreas para compreender cada necessidade de forma ampla, respeitando o ritmo de desenvolvimento, aprendizagem e evolução de cada paciente.' ); ?>
          </p>
        </div>
        <div class="section-actions">
          <a class="button button-primary button-large" href="<?php echo esc_url( $na_whatsapp_url ); ?>" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.32 1.77.6 2.61a2 2 0 0 1-.45 2.11L8 9.7a16 16 0 0 0 6.3 6.3l1.26-1.26a2 2 0 0 1 2.11-.45c.84.28 1.71.48 2.61.6A2 2 0 0 1 22 16.92z"></path>
            </svg>
            Agendar avaliação
          </a>
        </div>
      </section>

      <section class="section section-tint" id="espaco" aria-labelledby="espaco-title">
        <div class="section-heading wide">
          <p class="eyebrow">Nosso espaço</p>
          <h2 id="espaco-title"><?php neuroaprender_text( 'na_space_title', 'Ambientes preparados para acolher crianças, adolescentes e famílias' ); ?></h2>
          <p>
            <?php neuroaprender_rich_text( 'na_space_text', 'A clínica conta com recepção, consultórios e salas de atendimento organizadas para oferecer conforto, privacidade e cuidado em cada etapa do acompanhamento.' ); ?>
          </p>
        </div>
        <div class="gallery-shell">
          <button class="gallery-control gallery-prev" type="button" aria-label="Ver fotos anteriores">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m15 18-6-6 6-6"></path></svg>
          </button>
        <div class="clinic-gallery gallery-track" aria-label="Fotos da Clínica Escola NeuroAprender">
          <figure class="clinic-photo clinic-photo-featured">
            <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/clinica/entrada.webp' ) ); ?>" alt="Entrada da Clínica Escola NeuroAprender">
            <figcaption>Entrada da clínica</figcaption>
          </figure>
          <figure class="clinic-photo">
            <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/clinica/frente.webp' ) ); ?>" alt="Frente da Clínica Escola NeuroAprender">
            <figcaption>Fachada</figcaption>
          </figure>
          <figure class="clinic-photo">
            <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/clinica/recepcao-2.webp' ) ); ?>" alt="Recepção da Clínica Escola NeuroAprender">
            <figcaption>Recepção</figcaption>
          </figure>
          <figure class="clinic-photo">
            <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-11.webp' ) ); ?>" alt="Recepção da Clínica Escola NeuroAprender">
            <figcaption>Recepção</figcaption>
          </figure>
          <figure class="clinic-photo">
            <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/clinica/atendimento-clinico.webp' ) ); ?>" alt="Sala de atendimento clínico">
            <figcaption>Atendimento clínico</figcaption>
          </figure>
          <figure class="clinic-photo">
            <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/clinica/fono.webp' ) ); ?>" alt="Sala de fonoaudiologia">
            <figcaption>Fonoaudiologia</figcaption>
          </figure>
          <figure class="clinic-photo">
            <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/clinica/ocupacional.webp' ) ); ?>" alt="Sala de terapia ocupacional">
            <figcaption>Terapia ocupacional</figcaption>
          </figure>
          <figure class="clinic-photo">
            <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/clinica/psicomotricista.webp' ) ); ?>" alt="Sala de psicomotricidade">
            <figcaption>Psicomotricidade</figcaption>
          </figure>
          <figure class="clinic-photo">
            <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/clinica/administracao.webp' ) ); ?>" alt="Área administrativa da clínica">
            <figcaption>Administração</figcaption>
          </figure>
          <figure class="clinic-photo">
            <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/clinica/cozinha.webp' ) ); ?>" alt="Cozinha Terapêutica da clínica">
            <figcaption>Cozinha Terapêutica</figcaption>
          </figure>
        </div>
          <button class="gallery-control gallery-next" type="button" aria-label="Ver próximas fotos">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m9 18 6-6-6-6"></path></svg>
          </button>
        </div>
        <div class="section-actions">
          <a class="button button-primary button-large" href="<?php echo esc_url( $na_whatsapp_url ); ?>" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"></path>
              <path d="M8 9h8"></path>
              <path d="M8 13h5"></path>
            </svg>
            Agendar avaliação
          </a>
        </div>
      </section>

      <section class="section" id="servicos" aria-labelledby="servicos-title">
        <div class="section-heading wide">
          <p class="eyebrow">Nossos serviços</p>
          <h2 id="servicos-title"><?php neuroaprender_text( 'na_services_title', 'Serviços especializados para desenvolvimento, saúde e aprendizagem' ); ?></h2>
        </div>

        <div class="service-groups">
          <article class="service-group">
            <div class="group-label">Avaliações</div>
            <div class="service-grid">
              <div class="service-card">
                <h3>Avaliação Neuropsicológica</h3>
                <p>Investigação das funções cognitivas, emocionais e comportamentais.</p>
              </div>
              <div class="service-card">
                <h3>Avaliação Neuropsicopedagógica</h3>
                <p>Compreensão das dificuldades de aprendizagem e desenvolvimento escolar.</p>
              </div>
              <div class="service-card">
                <h3>PIPE</h3>
                <p>Programa de Intervenção Precoce Educacional para crianças pequenas.</p>
              </div>
            </div>
          </article>

          <article class="service-group">
            <div class="group-label">Atendimentos clínicos</div>
            <div class="service-grid">
              <div class="service-card">
                <h3>Psicologia</h3>
                <p>Acolhimento emocional, comportamento, orientação familiar e desenvolvimento.</p>
              </div>
              <div class="service-card">
                <h3>Neuropsicologia</h3>
                <p>Avaliação e acompanhamento das funções cognitivas e comportamentais.</p>
              </div>
              <div class="service-card">
                <h3>Fisioterapia</h3>
                <p>Acompanhamento motor, postural e funcional.</p>
              </div>
              <div class="service-card">
                <h3>Nutrição</h3>
                <p>Orientação alimentar individualizada para saúde, desenvolvimento e rotina familiar.</p>
              </div>
              <div class="service-card">
                <h3>Psicomotricidade</h3>
                <p>Estímulo das habilidades motoras, corporais, emocionais e sociais.</p>
              </div>
              <div class="service-card">
                <h3>Psicopedagogia</h3>
                <p>Apoio no processo de aprendizagem e desenvolvimento escolar.</p>
              </div>
              <div class="service-card">
                <h3>Pedagogia</h3>
                <p>Intervenções educacionais individualizadas.</p>
              </div>
              <div class="service-card">
                <h3>Clínico Geral</h3>
                <p>Atendimento médico para acompanhamento da saúde.</p>
              </div>
            </div>
          </article>
        </div>
        <div class="section-actions">
          <a class="button button-primary button-large" href="<?php echo esc_url( $na_whatsapp_url ); ?>" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"></path>
              <path d="M8 9h8"></path>
              <path d="M8 13h5"></path>
            </svg>
            Agendar avaliação
          </a>
        </div>
      </section>

      <section class="section" id="pacotes" aria-labelledby="pacotes-title">
        <div class="section-heading">
          <p class="eyebrow">Pacotes Educacionais NeuroAprender</p>
          <h2 id="pacotes-title"><?php neuroaprender_text( 'na_packages_title', 'Programas para fortalecer habilidades escolares' ); ?></h2>
        </div>
        <div class="package-grid">
          <article class="package-card accent-blue">
            <h3>NeuroLetras</h3>
            <p>Apoio ao desenvolvimento da leitura e escrita.</p>
          </article>
          <article class="package-card accent-green">
            <h3>NeuroAdvance</h3>
            <p>Estímulo global para aprendizagem e desenvolvimento.</p>
          </article>
          <article class="package-card accent-purple">
            <h3>NeuroFoco Plus</h3>
            <p>Organização, atenção e fortalecimento das habilidades escolares.</p>
          </article>
          <article class="package-card accent-gold">
            <h3>NeuroFoco Impulso</h3>
            <p>Intervenções para foco, rotina e autonomia.</p>
          </article>
          <article class="package-card accent-yellow">
            <h3>NeuroFoco Essencial</h3>
            <p>Base de apoio para crianças em processo de aprendizagem.</p>
          </article>
        </div>
        <div class="section-actions">
          <a class="button button-primary button-large" href="<?php echo esc_url( $na_whatsapp_url ); ?>" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.32 1.77.6 2.61a2 2 0 0 1-.45 2.11L8 9.7a16 16 0 0 0 6.3 6.3l1.26-1.26a2 2 0 0 1 2.11-.45c.84.28 1.71.48 2.61.6A2 2 0 0 1 22 16.92z"></path>
            </svg>
            Agendar avaliação
          </a>
        </div>
      </section>

      <section class="section section-tint" id="avaliacoes" aria-labelledby="avaliacoes-title">
        <div class="section-heading wide">
          <p class="eyebrow">Avaliações e condições especiais</p>
          <h2 id="avaliacoes-title"><?php neuroaprender_text( 'na_reviews_title', 'Pacotes de avaliação para compreender e orientar cada necessidade' ); ?></h2>
          <p>
            <?php neuroaprender_rich_text( 'na_reviews_text', 'Confira os materiais informativos da clínica e fale com a equipe para confirmar disponibilidade, valores e melhor indicação para cada caso.' ); ?>
          </p>
        </div>
        <div class="gallery-shell">
          <button class="gallery-control gallery-prev" type="button" aria-label="Ver materiais anteriores">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m15 18-6-6 6-6"></path></svg>
          </button>
        <div class="promo-strip gallery-track" aria-label="Materiais de avaliação e promoções">
          <figure class="promo-card"><img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-01.webp' ) ); ?>" alt="Material informativo sobre avaliação neuropsicológica"></figure>
          <figure class="promo-card"><img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-03.webp' ) ); ?>" alt="Condição especial de avaliação NeuroAprender"></figure>
          <figure class="promo-card"><img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-04.webp' ) ); ?>" alt="Pacote de avaliação da Clínica Escola NeuroAprender"></figure>
          <figure class="promo-card"><img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-05.webp' ) ); ?>" alt="Material de promoção NeuroAprender"></figure>
          <figure class="promo-card"><img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-06.webp' ) ); ?>" alt="Avaliação e atendimento multidisciplinar NeuroAprender"></figure>
          <figure class="promo-card"><img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-07.webp' ) ); ?>" alt="Material informativo de avaliação infantil"></figure>
          <figure class="promo-card"><img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-08.webp' ) ); ?>" alt="Pacote de avaliação infantil NeuroAprender"></figure>
          <figure class="promo-card"><img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-09.webp' ) ); ?>" alt="Promoção de atendimento NeuroAprender"></figure>
          <figure class="promo-card"><img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-10.webp' ) ); ?>" alt="Material informativo de pacote NeuroAprender"></figure>
        </div>
          <button class="gallery-control gallery-next" type="button" aria-label="Ver próximos materiais">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m9 18 6-6-6-6"></path></svg>
          </button>
        </div>
        <div class="section-actions">
          <a class="button button-primary button-large" href="<?php echo esc_url( $na_whatsapp_url ); ?>" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"></path>
              <path d="M8 9h8"></path>
              <path d="M8 13h5"></path>
            </svg>
            Agendar avaliação
          </a>
        </div>
      </section>

      <section class="section" aria-labelledby="diferenciais-title">
        <div class="section-heading">
          <p class="eyebrow">Diferenciais</p>
          <h2 id="diferenciais-title">Por que escolher a NeuroAprender?</h2>
        </div>
        <div class="benefit-grid">
          <div class="benefit-item">Atendimento humanizado e acolhedor</div>
          <div class="benefit-item">Equipe interdisciplinar</div>
          <div class="benefit-item">Olhar individualizado para cada criança</div>
          <div class="benefit-item">Orientação para famílias</div>
          <div class="benefit-item">Integração entre saúde, educação e desenvolvimento</div>
          <div class="benefit-item">Espaço pensado para o público infantil</div>
          <div class="benefit-item">Acompanhamento com objetivos claros</div>
        </div>
      </section>

      <section class="cta-band" aria-labelledby="cta-title">
        <div>
          <p class="eyebrow"><?php neuroaprender_text( 'na_cta_eyebrow', 'Orientação no momento certo' ); ?></p>
          <h2 id="cta-title"><?php neuroaprender_text( 'na_cta_title', 'Percebeu alguma dificuldade no desenvolvimento ou aprendizagem da criança?' ); ?></h2>
          <p>
            <?php neuroaprender_rich_text( 'na_cta_text', 'Quanto antes a família busca orientação, mais possibilidades existem para compreender, intervir e acompanhar de forma adequada.' ); ?>
          </p>
        </div>
        <a class="button button-primary" href="<?php echo esc_url( $na_whatsapp_url ); ?>" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"></path>
            <path d="M8 9h8"></path>
            <path d="M8 13h5"></path>
          </svg>
          <?php neuroaprender_text( 'na_cta_button', 'Falar com a NeuroAprender' ); ?>
        </a>
      </section>

      <section class="section" id="profissionais" aria-labelledby="profissionais-title">
        <div class="section-heading wide">
          <p class="eyebrow">Nossa equipe</p>
          <h2 id="profissionais-title"><?php neuroaprender_text( 'na_team_title', 'Profissionais preparados para acolher, avaliar e acompanhar' ); ?></h2>
          <p>
            <?php neuroaprender_rich_text( 'na_team_text', 'Nossa equipe atua com responsabilidade, ética e cuidado em cada etapa do atendimento.' ); ?>
          </p>
        </div>
        <div class="gallery-shell">
          <button class="gallery-control gallery-prev" type="button" aria-label="Ver profissionais anteriores">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m15 18-6-6 6-6"></path></svg>
          </button>
        <div class="team-photo-grid gallery-track" aria-label="Materiais da equipe NeuroAprender">
          <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-23.webp' ) ); ?>" alt="Material da equipe NeuroAprender">
          <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-22.webp' ) ); ?>" alt="Material da equipe NeuroAprender">
          <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-21.webp' ) ); ?>" alt="Material da equipe NeuroAprender">
          <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-20.webp' ) ); ?>" alt="Material da equipe NeuroAprender">
          <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-19.webp' ) ); ?>" alt="Material da equipe NeuroAprender">
          <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-18.webp' ) ); ?>" alt="Material da equipe NeuroAprender">
          <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-17.webp' ) ); ?>" alt="Material da equipe NeuroAprender">
          <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-16.webp' ) ); ?>" alt="Material da equipe NeuroAprender">
          <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-15.webp' ) ); ?>" alt="Material da equipe NeuroAprender">
          <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-14.webp' ) ); ?>" alt="Material da equipe NeuroAprender">
          <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-13.webp' ) ); ?>" alt="Material da equipe NeuroAprender">
          <img loading="lazy" decoding="async" src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/promocoes/promo-02.webp' ) ); ?>" alt="Material da equipe NeuroAprender">
        </div>
          <button class="gallery-control gallery-next" type="button" aria-label="Ver próximos profissionais">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m9 18 6-6-6-6"></path></svg>
          </button>
        </div>
        <div class="section-actions">
          <a class="button button-primary button-large" href="<?php echo esc_url( $na_whatsapp_url ); ?>" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.32 1.77.6 2.61a2 2 0 0 1-.45 2.11L8 9.7a16 16 0 0 0 6.3 6.3l1.26-1.26a2 2 0 0 1 2.11-.45c.84.28 1.71.48 2.61.6A2 2 0 0 1 22 16.92z"></path>
            </svg>
            Agendar avaliação
          </a>
        </div>
      </section>

      <section class="contact-section section-tint" id="contato" aria-labelledby="contato-title">
        <div class="section-heading">
          <p class="eyebrow">Contato</p>
          <h2 id="contato-title">Entre em contato</h2>
        </div>
        <div class="contact-grid">
          <div class="contact-info">
            <a href="<?php echo esc_url( $na_whatsapp_url ); ?>" target="_blank" rel="noopener">
              <span>WhatsApp</span>
              <?php echo esc_html( $na_whatsapp_number ); ?>
            </a>
            <a href="<?php echo esc_url( $na_instagram_url ); ?>" target="_blank" rel="noopener">
              <span>Instagram</span>
              <?php echo esc_html( $na_instagram_label ); ?>
            </a>
            <div>
              <span>Endereço</span>
              <?php echo esc_html( $na_address ); ?>
            </div>
            <div>
              <span>Horário de atendimento</span>
              <?php echo esc_html( $na_hours ); ?>
            </div>
            <a class="contact-cta" href="<?php echo esc_url( $na_whatsapp_url ); ?>" target="_blank" rel="noopener">
              <span>Agendamento</span>
              Agendar avaliação pelo WhatsApp
            </a>
          </div>
          <iframe
            class="map-frame"
            title="Mapa da Clínica Escola NeuroAprender"
           
            referrerpolicy="no-referrer-when-downgrade"
            src="<?php echo esc_url( $na_maps_url ); ?>">
          </iframe>
        </div>
      </section>
    </main>

    <a class="floating-whatsapp" href="<?php echo esc_url( $na_whatsapp_url ); ?>" target="_blank" rel="noopener" aria-label="Agendar pelo WhatsApp">
      <svg viewBox="0 0 24 24" aria-hidden="true">
        <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"></path>
        <path d="M8 9h8"></path>
        <path d="M8 13h5"></path>
      </svg>
      WhatsApp
    </a>

    <?php if ( neuroaprender_ai_enabled() ) : ?>
      <section class="ai-chat" aria-label="Assistente virtual da NeuroAprender">
        <button class="ai-chat-toggle" type="button" aria-expanded="false" aria-controls="ai-chat-panel">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"></path>
            <path d="M8 9h8"></path>
            <path d="M8 13h5"></path>
          </svg>
          <?php neuroaprender_text( 'na_ai_button_label', 'Tirar dúvidas com IA' ); ?>
        </button>
        <div class="ai-chat-panel" id="ai-chat-panel" hidden>
          <div class="ai-chat-header">
            <div>
              <strong><?php neuroaprender_text( 'na_ai_title', 'Assistente NeuroAprender' ); ?></strong>
              <span>Resposta automática</span>
            </div>
            <button class="ai-chat-close" type="button" aria-label="Fechar assistente">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
              </svg>
            </button>
          </div>
          <div class="ai-chat-messages" aria-live="polite">
            <div class="ai-message ai-message-bot">
              <?php neuroaprender_rich_text( 'na_ai_intro', 'Olá! Posso tirar dúvidas sobre serviços, horários, localização e agendamento. Para avaliação clínica, nossa equipe continua sendo o melhor caminho.' ); ?>
            </div>
          </div>
          <form class="ai-chat-form">
            <label class="sr-only" for="ai-chat-input">Mensagem para o assistente</label>
            <textarea id="ai-chat-input" name="message" rows="2" maxlength="1200" placeholder="<?php echo esc_attr( (string) neuroaprender_field( 'na_ai_placeholder', 'Digite sua dúvida...' ) ); ?>"></textarea>
            <button type="submit" aria-label="Enviar pergunta">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M22 2 11 13"></path>
                <path d="m22 2-7 20-4-9-9-4 20-7z"></path>
              </svg>
            </button>
          </form>
          <p class="ai-chat-disclaimer"><?php neuroaprender_text( 'na_ai_disclaimer', 'Este assistente não realiza diagnóstico e não substitui atendimento profissional.' ); ?></p>
          <a class="ai-chat-whatsapp" href="<?php echo esc_url( $na_whatsapp_url ); ?>" target="_blank" rel="noopener">Agendar pelo WhatsApp</a>
        </div>
      </section>
    <?php endif; ?>

    <div class="lightbox" id="photo-lightbox" hidden aria-modal="true" role="dialog" aria-label="Visualização da foto">
      <button class="lightbox-close" type="button" aria-label="Fechar foto">
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M18 6 6 18"></path>
          <path d="m6 6 12 12"></path>
        </svg>
      </button>
      <button class="lightbox-nav lightbox-prev" type="button" aria-label="Foto anterior">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m15 18-6-6 6-6"></path></svg>
      </button>
      <img src="" alt="">
      <button class="lightbox-nav lightbox-next" type="button" aria-label="Próxima foto">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m9 18 6-6-6-6"></path></svg>
      </button>
    </div>

    <footer class="site-footer">
      <div>
        <strong>Clínica Escola NeuroAprender</strong>
        <span>Todo cérebro aprende</span>
      </div>
      <nav aria-label="Links do rodapé">
        <a href="#inicio">Início</a>
        <a href="#espaco">Espaço</a>
        <a href="#servicos">Serviços</a>
        <a href="#pacotes">Pacotes</a>
        <a href="#avaliacoes">Avaliações</a>
        <a href="#profissionais">Profissionais</a>
        <a href="#contato">Contato</a>
      </nav>
    </footer>
<?php
get_footer();
