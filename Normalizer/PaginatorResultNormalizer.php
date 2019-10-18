<?php

declare(strict_types=1);

namespace App\Services\Paginator\Normalizer;

use App\Services\Paginator\PaginatorResult;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;

class PaginatorResultNormalizer implements NormalizerAwareInterface, ContextAwareNormalizerInterface
{
    use NormalizerAwareTrait;

    public function supportsNormalization($data, $format = null, array $context = [])
    {
        return $data instanceof PaginatorResult;
    }

    /**
     * @param PaginatorResult $object
     * @param null            $format
     * @param array           $context
     *
     * @return array|bool|float|int|string
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return [
            'totalItems' => $object->getTotalItems(),
            'totalPages' => $object->getTotalPages(),
            'currentData' => $this->normalizer->normalize($object->getCurrentData(), $format, $context),
            'currentPage' => $object->getCurrentPage(),
        ];
    }
}
