<?php

namespace App\Controllers;

use App\Models\TripModel;
use App\Models\ArticleModel;

class Seo extends BaseController
{
    public function sitemap()
    {
        $today = date('Y-m-d');
        $urls = [
            ['loc' => base_url('/'), 'pri' => '1.0', 'freq' => 'daily', 'mod' => $today],
            ['loc' => base_url('trips'), 'pri' => '0.9', 'freq' => 'weekly', 'mod' => $today],
            ['loc' => base_url('gallery'), 'pri' => '0.7', 'freq' => 'weekly', 'mod' => $today],
            ['loc' => base_url('articles'), 'pri' => '0.7', 'freq' => 'weekly', 'mod' => $today],
            ['loc' => base_url('about'), 'pri' => '0.6', 'freq' => 'monthly', 'mod' => $today],
            ['loc' => base_url('contact'), 'pri' => '0.6', 'freq' => 'monthly', 'mod' => $today],
        ];

        foreach ((new TripModel())->active()->findAll() as $trip) {
            $urls[] = [
                'loc'   => base_url('trips/' . $trip['slug']),
                'pri'   => '0.8',
                'freq'  => 'weekly',
                'mod'   => date('Y-m-d', strtotime($trip['updated_at'] ?? 'now')),
                'image' => img_url($trip['cover_image']),
            ];
        }
        foreach ((new ArticleModel())->published()->findAll() as $a) {
            $urls[] = [
                'loc'   => base_url('articles/' . $a['slug']),
                'pri'   => '0.6',
                'freq'  => 'monthly',
                'mod'   => date('Y-m-d', strtotime($a['updated_at'] ?? $a['published_at'] ?? 'now')),
                'image' => img_url($a['cover_image']),
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";
        foreach ($urls as $u) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . esc($u['loc']) . "</loc>\n";
            $xml .= "    <lastmod>{$u['mod']}</lastmod>\n";
            $xml .= "    <changefreq>{$u['freq']}</changefreq>\n";
            $xml .= "    <priority>{$u['pri']}</priority>\n";
            if (! empty($u['image'])) {
                $xml .= "    <image:image><image:loc>" . esc($u['image']) . "</image:loc></image:image>\n";
            }
            $xml .= "  </url>\n";
        }
        $xml .= '</urlset>';

        return $this->response->setContentType('application/xml')->setBody($xml);
    }

    public function robots()
    {
        $body = "User-agent: *\nAllow: /\nDisallow: /admin\n\nSitemap: " . base_url('sitemap.xml') . "\n";

        return $this->response->setContentType('text/plain')->setBody($body);
    }
}
