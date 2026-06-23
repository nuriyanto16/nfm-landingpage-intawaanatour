<?php
$siteName = setting('site_name', 'Inta Waana Tour');
$title    = $meta['title'] ?? ($siteName . ' — ' . t('Speedboat Premium Labuan Bajo', 'Premium Speedboat Labuan Bajo'));
$desc     = $meta['description'] ?? setting('meta_description', '');
$image    = img_url($meta['image'] ?? 'assets/img/og-default.jpg');
// Kanonik: pakai URL halaman saat ini tanpa query string.
$canon    = $meta['canonical'] ?? rtrim(strtok(current_url(), '?'), '/');
if ($canon === rtrim(base_url(), '/')) {
    $canon = base_url('/');
}
$loc      = locale();
$ogLocale = $loc === 'en' ? 'en_US' : 'id_ID';
$altLocale = $loc === 'en' ? 'id_ID' : 'en_US';
$keywords = $meta['keywords'] ?? t(
    'speedboat labuan bajo, sewa speedboat komodo, trip komodo, paket wisata labuan bajo, private trip komodo, pulau padar',
    'labuan bajo speedboat, komodo speedboat rental, komodo trip, labuan bajo tour package, private komodo trip, padar island'
);

$jsonBlocks = [];

// 1) Organisasi (selalu ada) — entitas brand untuk Knowledge Graph.
$sameAs = array_values(array_filter([setting('instagram'), setting('facebook')]));
$org = [
    '@context' => 'https://schema.org',
    '@type'    => 'TravelAgency',
    '@id'      => base_url('/#organization'),
    'name'     => $siteName,
    'url'      => base_url('/'),
    'logo'     => img_url('assets/img/logo-mark.png'),
    'image'    => img_url('assets/img/og-default.jpg'),
    'description' => setting('meta_description'),
    'areaServed'  => 'Komodo National Park, Labuan Bajo',
    'priceRange'  => 'Rp 1.100.000 - Rp 13.500.000',
    'address'  => [
        '@type'           => 'PostalAddress',
        'streetAddress'   => setting('address'),
        'addressLocality' => 'Labuan Bajo',
        'addressRegion'   => 'Nusa Tenggara Timur',
        'addressCountry'  => 'ID',
    ],
];
if ($tel = setting('phone')) {
    $org['telephone'] = $tel;
    $org['contactPoint'] = [
        '@type'       => 'ContactPoint',
        'telephone'   => $tel,
        'contactType' => 'reservations',
        'availableLanguage' => ['id', 'en'],
    ];
}
if ($em = setting('email')) {
    $org['email'] = $em;
}
if ($sameAs) {
    $org['sameAs'] = $sameAs;
}
$jsonBlocks[] = $org;

// 2) WebSite (selalu ada).
$jsonBlocks[] = [
    '@context' => 'https://schema.org',
    '@type'    => 'WebSite',
    '@id'      => base_url('/#website'),
    'url'      => base_url('/'),
    'name'     => $siteName,
    'inLanguage' => $loc,
    'publisher'  => ['@id' => base_url('/#organization')],
];

// 3) Breadcrumb (opsional, per halaman): $meta['breadcrumb'] = [['name'=>..,'url'=>..], ...]
if (! empty($meta['breadcrumb']) && is_array($meta['breadcrumb'])) {
    $items = [];
    foreach ($meta['breadcrumb'] as $i => $b) {
        $items[] = [
            '@type'    => 'ListItem',
            'position' => $i + 1,
            'name'     => $b['name'],
            'item'     => $b['url'],
        ];
    }
    $jsonBlocks[] = [
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    ];
}
?>
<title><?= esc($title) ?></title>
<meta name="description" content="<?= esc($desc) ?>">
<meta name="keywords" content="<?= esc($keywords) ?>">
<meta name="author" content="<?= esc($siteName) ?>">
<link rel="canonical" href="<?= esc($canon) ?>">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="googlebot" content="index, follow">
<meta name="theme-color" content="#0e3a4f">
<meta name="geo.region" content="ID-NT">
<meta name="geo.placename" content="Labuan Bajo">

<!-- Open Graph -->
<meta property="og:type" content="<?= esc($meta['og_type'] ?? 'website') ?>">
<meta property="og:site_name" content="<?= esc($siteName) ?>">
<meta property="og:title" content="<?= esc($title) ?>">
<meta property="og:description" content="<?= esc($desc) ?>">
<meta property="og:image" content="<?= esc($image) ?>">
<meta property="og:image:secure_url" content="<?= esc($image) ?>">
<meta property="og:image:alt" content="<?= esc($title) ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:url" content="<?= esc($canon) ?>">
<meta property="og:locale" content="<?= $ogLocale ?>">
<meta property="og:locale:alternate" content="<?= $altLocale ?>">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= esc($title) ?>">
<meta name="twitter:description" content="<?= esc($desc) ?>">
<meta name="twitter:image" content="<?= esc($image) ?>">
<meta name="twitter:image:alt" content="<?= esc($title) ?>">

<!-- Structured data -->
<?php foreach ($jsonBlocks as $block): ?>
<script type="application/ld+json"><?= json_encode($block, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<?php endforeach; ?>
<?php if (! empty($meta['jsonld'])): ?>
<script type="application/ld+json"><?= $meta['jsonld'] ?></script>
<?php endif ?>
