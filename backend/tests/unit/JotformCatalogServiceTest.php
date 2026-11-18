<?php

namespace Tests\Unit;

use App\Libraries\JotformCatalogService;
use CodeIgniter\Test\CIUnitTestCase;
use Config\Jotform;

class JotformCatalogServiceTest extends CIUnitTestCase
{
    public function testParsesCategoriesProductsImagesPricesAndVariants(): void
    {
        $html = <<<'HTML'
        <div id="id_10">
          <span class="form-product-category-item" category="2001"><strong>Seasons Collection</strong></span>
          <span class="form-product-item" categories="2001" pid="1000">
            <img alt="Spring Product Image" src="https://example.test/spring.jpg">
            <span class="form-product-name">Spring (Stitched)</span>
            <span class="form-product-description">Fresh spring design.</span>
            <span id="input_10_1000_price">129.00</span>
          </span>
          <span class="form-product-category-item" category="2003"><strong>Imperfect Prints (Minor print differences.)</strong></span>
          <span class="form-product-item" categories="2003" pid="1010">
            <img src="https://example.test/white.jpg">
            <span class="form-product-name">White</span>
            <span id="input_10_1010_price">80</span>
            <select id="input_10_custom_1010_1"><option>Stitched</option><option>Rivet</option></select>
          </span>
        </div>
        HTML;

        $service = new JotformCatalogService(new Jotform(), new \stdClass());
        $catalog = $service->parseCatalogHtml($html);

        $this->assertCount(2, $catalog['categories']);
        $this->assertSame('Imperfect Prints', $catalog['categories'][1]['name']);
        $this->assertSame('Minor print differences.', $catalog['categories'][1]['description']);
        $this->assertCount(2, $catalog['products']);
        $this->assertSame('1000', $catalog['products'][0]['jotform_product_id']);
        $this->assertSame(129.0, $catalog['products'][0]['price']);
        $this->assertSame('https://example.test/spring.jpg', $catalog['products'][0]['image_url']);
        $this->assertSame('https://example.test/white.jpg', $catalog['products'][1]['image_url']);
        $this->assertSame(['Stitched', 'Rivet'], $catalog['products'][1]['variants']);
    }
}
