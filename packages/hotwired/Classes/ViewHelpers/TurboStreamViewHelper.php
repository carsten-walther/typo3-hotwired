<?php

namespace Walther\Hotwired\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

/**
 * A ViewHelper for creating turbo-stream tags.
 *
 * @see: https://turbo.hotwired.dev/reference/streams
 */
final class TurboStreamViewHelper extends AbstractTagBasedViewHelper
{
    protected $tagName = 'turbo-stream';

    public function initializeArguments(): void
    {
        $this->registerArgument('action', 'string', 'A Turbo Streams message is a fragment of HTML consisting of <turbo-stream> elements. The stream message below demonstrates the seven possible stream actions: (append|prepend|replace|update|remove|before|after).', true);
        $this->registerArgument('target', 'string', 'The target refers to another <turbo-frame> element by ID to be navigated when a descendant <a> is clicked. When target="_top", navigate the window.', false);
        $this->registerArgument('targets', 'string', 'To target multiple elements with a single action, use the targets attribute with a CSS query selector instead of the target attribute.', false);
    }

    public function render(): string
    {
        $this->tag->addAttribute('action', $this->arguments['action']);

        if (isset($this->arguments['targets'])) {
            $this->tag->addAttribute('targets', $this->arguments['targets']);
        } elseif (isset($this->arguments['target'])) {
            $this->tag->addAttribute('target', $this->arguments['target']);
        } else {
            trigger_error('It must be set target attribute or targets attribute.', E_USER_ERROR);
        }

        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(true);
        return $this->tag->render();
    }
}