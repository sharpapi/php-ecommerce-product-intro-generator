<?php

declare(strict_types=1);

namespace SharpAPI\EcommerceProductIntro;

use GuzzleHttp\Exception\GuzzleException;
use SharpAPI\Core\Client\SharpApiClient;

/**
 * Generate product introductions using AI - creates marketing descriptions
 *
 * @package SharpAPI\EcommerceProductIntro
 * @api
 */
class ProductIntroGeneratorClient extends SharpApiClient
{
    public function __construct(
        string $apiKey,
        ?string $apiBaseUrl = 'https://sharpapi.com/api/v1',
        ?string $userAgent = 'SharpAPIPHPEcommerceProductIntro/1.0.0'
    ) {
        parent::__construct($apiKey, $apiBaseUrl, $userAgent);
    }

    /**
     * Generate product introductions using AI - creates marketing descriptions
     *
     * @param string $content The product content to process
     * @param string $language Output language (default: English)
     * @param int|null $maxQuantity Optional maximum quantity of results
     * @param int|null $maxLength Optional maximum length of generated content
     * @param string|null $voiceTone Optional tone of voice
     * @param string|null $context Optional additional context
     * @return string Status URL for polling the job result
     * @throws GuzzleException
     * @api
     */
    public function generateProductIntro(
        string $content,
        string $language = 'English',
        ?int $maxQuantity = null,
        ?int $maxLength = null,
        ?string $voiceTone = null,
        ?string $context = null
    ): string {
        $response = $this->makeRequest('POST', '/ecommerce/product_intro', array_filter([
            'content' => $content,
            'language' => $language,
            'max_quantity' => $maxQuantity,
            'max_length' => $maxLength,
            'voice_tone' => $voiceTone,
            'context' => $context,
        ], fn($v) => $v !== null));

        return $this->parseStatusUrl($response);
    }
}
