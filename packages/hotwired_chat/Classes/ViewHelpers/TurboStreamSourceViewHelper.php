<?php

namespace Walther\Chat\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class TurboStreamSourceViewHelper extends AbstractTagBasedViewHelper
{
    protected $tagName = 'turbo-stream-source';

    public function initializeArguments(): void
    {
        $this->registerArgument('src', 'string', 'Turbo’s <turbo-stream-source> custom element connects to a stream source through its [src] attribute. When declared with an ws:// or wss:// URL, the underlying stream source will be a WebSocket instance. Otherwise, the connection is through an EventSource.', true);
    }

    public function render(): string
    {
        $this->tag->addAttribute('src', $this->arguments['src']);

        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(true);

        return $this->tag->render();
    }
}