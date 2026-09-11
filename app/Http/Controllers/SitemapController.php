<?php

namespace App\Http\Controllers;

use App\Models\Admin\Menu;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [];

        // Homepage
        $this->addUrl(
            $urls,
            url('/'),
            now()->toAtomString(),
            'daily',
            '1.0'
        );

        // Menu URLs
        $this->getMenuUrls($urls);

        // Blog URLs
        // $this->getBlogUrls($urls);

        // Remove duplicate URLs
        $urls = $this->removeDuplicateUrls($urls);

        // Generate XML
        $xml = $this->buildXml($urls);

        // Save sitemap in Laravel project main/root directory
        $path = base_path('sitemap.xml');

        file_put_contents($path, $xml);

        return response()->json([
            'status'  => true,
            'message' => 'Sitemap generated successfully.',
            'file'    => url('/sitemap.xml'),
            'total'   => count($urls),
        ]);
    }


    /**
     * Add URL
     */
    private function addUrl(
        array &$urls,
        string $url,
        ?string $lastmod = null,
        string $changefreq = 'weekly',
        string $priority = '0.5'
    ) {
        $urls[] = [
            'loc'        => $url,
            'lastmod'    => $lastmod,
            'changefreq' => $changefreq,
            'priority'   => $priority,
        ];
    }


    /**
     * Get Menu URLs
     */
    private function getMenuUrls(array &$urls)
    {
        $menus = Menu::all();

        foreach ($menus as $menu) {

            if (empty($menu->menuslug)) {
                continue;
            }

            // Skip external URLs
            if (
                str_starts_with($menu->menuslug, 'http://') ||
                str_starts_with($menu->menuslug, 'https://')
            ) {
                continue;
            }

            $this->addUrl(
                $urls,
                url($menu->menuslug),
                $menu->updated_at
                    ? $menu->updated_at->toAtomString()
                    : null,
                'daily',
                '0.8'
            );
        }
    }


    /**
     * Get Blog URLs
     */
    // private function getBlogUrls(array &$urls)
    // {
    //     $blogs = Blog::all();

    //     foreach ($blogs as $blog) {

    //         if (empty($blog->slug)) {
    //             continue;
    //         }

    //         $this->addUrl(
    //             $urls,
    //             url('/blog/' . $blog->slug),
    //             $blog->updated_at
    //                 ? $blog->updated_at->toAtomString()
    //                 : null,
    //             'weekly',
    //             '0.7'
    //         );
    //     }
    // }


    /**
     * Remove duplicate URLs
     */
    private function removeDuplicateUrls(array $urls): array
    {
        $unique = [];

        foreach ($urls as $item) {
            $unique[$item['loc']] = $item;
        }

        return array_values($unique);
    }


    /**
     * Build XML
     */
    private function buildXml(array $urls): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;

        // IMPORTANT:
        // This loads the visual sitemap design
        $xml .= '<?xml-stylesheet type="text/xsl" href="sitemap.xsl"?>' . PHP_EOL;

        // Sitemap XML
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" '
            . 'xmlns:xhtml="http://www.w3.org/1999/xhtml">'
            . PHP_EOL;

        foreach ($urls as $item) {

            $xml .= '    <url>' . PHP_EOL;

            // URL
            $xml .= '        <loc>'
                . htmlspecialchars(
                    $item['loc'],
                    ENT_XML1,
                    'UTF-8'
                )
                . '</loc>' . PHP_EOL;

            // Last Modified
            if (!empty($item['lastmod'])) {

                $xml .= '        <lastmod>'
                    . htmlspecialchars(
                        $item['lastmod'],
                        ENT_XML1,
                        'UTF-8'
                    )
                    . '</lastmod>' . PHP_EOL;
            }

            // Change Frequency
            if (!empty($item['changefreq'])) {

                $xml .= '        <changefreq>'
                    . htmlspecialchars(
                        $item['changefreq'],
                        ENT_XML1,
                        'UTF-8'
                    )
                    . '</changefreq>' . PHP_EOL;
            }

            // Priority
            if (!empty($item['priority'])) {

                $xml .= '        <priority>'
                    . htmlspecialchars(
                        $item['priority'],
                        ENT_XML1,
                        'UTF-8'
                    )
                    . '</priority>' . PHP_EOL;
            }

            $xml .= '    </url>' . PHP_EOL;
        }

        $xml .= '</urlset>';

        return $xml;
    }
}