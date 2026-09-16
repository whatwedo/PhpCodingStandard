<?php

declare(strict_types=1);

/*
 * Copyright (c) 2026, whatwedo GmbH
 * All rights reserved
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 *    this list of conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
 * IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT,
 * INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT
 * NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 * PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

namespace whatwedo\PhpCodingStandard\Set;

/**
 * Paths to the shipped coding standard sets, to be referenced from a project's ecs.php.
 */
final class WhatwedoSets
{
    /**
     * @var string
     */
    public const COMMON = __DIR__ . '/../../config/whatwedo-common.php';

    /**
     * @var string
     */
    public const SYMFONY = __DIR__ . '/../../config/whatwedo-symfony.php';

    /**
     * @var string
     */
    public const WORDPRESS = __DIR__ . '/../../config/whatwedo-wordpress.php';

    /**
     * The whatwedo rules without a base set. Only useful when composing a set of your own;
     * reference COMMON, SYMFONY or WORDPRESS instead.
     *
     * @var string
     */
    public const RULES = __DIR__ . '/../../config/whatwedo-rules.php';
}
