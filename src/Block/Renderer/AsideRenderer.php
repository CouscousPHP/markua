<?php

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Davey Shafik <me@daveyshafik.com>
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on the CommonMark JS reference parser (http://bitly.com/commonmarkjs)
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Markua\Block\Renderer;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\HtmlElement;
use League\CommonMark\HtmlRendererInterface;
use League\Markua\Block\Element\Aside;

class AsideRenderer implements BlockRendererInterface
{
    /**
     * @param Aside                 $block
     * @param HtmlRendererInterface $htmlRenderer
     * @param bool                  $inTightList
     *
     * @return HtmlElement
     */
    public function render(AbstractBlock $block, HtmlRendererInterface $htmlRenderer, $inTightList = false)
    {
        if (!($block instanceof Aside)) {
            throw new \InvalidArgumentException('Incompatible block type: ' . get_class($block));
        }

        $filling = $htmlRenderer->renderBlocks($block->getChildren());
        if ($filling === '') {
            return new HtmlElement('aside', array(), $htmlRenderer->getOption('inner_separator'));
        }

        return new HtmlElement(
            'aside',
            array(),
            $htmlRenderer->getOption('inner_separator', "\n") . $filling . $htmlRenderer->getOption('inner_separator', "\n")
        );
    }
}
