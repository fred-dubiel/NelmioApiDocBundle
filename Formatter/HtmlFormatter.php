<?php

/*
 * This file is part of the NelmioApiDocBundle.
 *
 * (c) Nelmio <hello@nelm.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nelmio\ApiDocBundle\Formatter;

use Symfony\Component\Templating\EngineInterface;

class HtmlFormatter extends AbstractFormatter
{

    /**
     * @var string
     */
    protected $templateResources;

    /**
     * @var string
     */
    protected $templateResource;

    /**
     * @var string
     */
    protected $templateCss;

    /**
     * @var string
     */
    protected $templateJs;

    /**
     * @var string
     */
    protected $apiName;

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var string
     */
    protected $defaultRequestFormat;

    /**
     * @var EngineInterface
     */
    protected $engine;

    /**
     * @var boolean
     */
    private $enableSandbox;

    /**
     * @var array
     */
    private $requestFormats;

    /**
     * @var string
     */
    private $requestFormatMethod;

    /**
     * @var string
     */
    private $acceptType;

    /**
     * @var array
     */
    private $bodyFormats;

    /**
     * @var string
     */
    private $defaultBodyFormat;

    /**
     * @var array
     */
    private $authentication;

    /**
     * @var string
     */
    private $motdTemplate;

    /**
     * @var boolean
     */
    private $defaultSectionsOpened;

    /**
     * @return string
     */
    public function getTemplateResource()
    {
        return $this->templateResource;
    }

    /**
     * @param string $templateResource
     */
    public function setTemplateResource($templateResource)
    {
        $this->templateResource = $templateResource;
    }

    /**
     * @return string
     */
    public function getTemplateCss()
    {
        return $this->templateCss;
    }

    /**
     * @param string $templateCss
     */
    public function setTemplateCss($templateCss)
    {
        $this->templateCss = $templateCss;
    }

    /**
     * @return string
     */
    public function getTemplateJs()
    {
        return $this->templateJs;
    }

    /**
     * @param string $templateJs
     */
    public function setTemplateJs($templateJs)
    {
        $this->templateJs = $templateJs;
    }

    /**
     * @param array $authentication
     */
    public function setAuthentication(array $authentication = null)
    {
        $this->authentication = $authentication;
    }

    /**
     * @param string $apiName
     */
    public function setApiName($apiName)
    {
        $this->apiName = $apiName;
    }

    /**
     * @param string $endpoint
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @param boolean $enableSandbox
     */
    public function setEnableSandbox($enableSandbox)
    {
        $this->enableSandbox = $enableSandbox;
    }

    /**
     * @param EngineInterface $engine
     */
    public function setTemplatingEngine(EngineInterface $engine)
    {
        $this->engine = $engine;
    }

    /**
     * @param string $acceptType
     */
    public function setAcceptType($acceptType)
    {
        $this->acceptType = $acceptType;
    }

    /**
     * @param array $bodyFormats
     */
    public function setBodyFormats(array $bodyFormats)
    {
        $this->bodyFormats = $bodyFormats;
    }

    /**
     * @param string $defaultBodyFormat
     */
    public function setDefaultBodyFormat($defaultBodyFormat)
    {
        $this->defaultBodyFormat = $defaultBodyFormat;
    }

    /**
     * @param string $method
     */
    public function setRequestFormatMethod($method)
    {
        $this->requestFormatMethod = $method;
    }

    /**
     * @param array $formats
     */
    public function setRequestFormats(array $formats)
    {
        $this->requestFormats = $formats;
    }

    /**
     * @param string $format
     */
    public function setDefaultRequestFormat($format)
    {
        $this->defaultRequestFormat = $format;
    }

    /**
     * @param string $motdTemplate
     */
    public function setMotdTemplate($motdTemplate)
    {
        $this->motdTemplate = $motdTemplate;
    }

    /**
     * @return string
     */
    public function getMotdTemplate()
    {
        return $this->motdTemplate;
    }

    /**
     * @param boolean $defaultSectionsOpened
     */
    public function setDefaultSectionsOpened($defaultSectionsOpened)
    {
        $this->defaultSectionsOpened = $defaultSectionsOpened;
    }

    /**
     * @return string
     */
    public function getTemplateResources()
    {
        return $this->templateResources;
    }

    /**
     * @param string $templateResources
     */
    public function setTemplateResources($templateResources)
    {
        $this->templateResources = $templateResources;
    }

    /**
     * {@inheritdoc}
     */
    protected function renderOne(array $data)
    {
        return $this->engine->render($this->getTemplateResource(), array_merge(
            array(
                'data'           => $data,
                'displayContent' => true,
            ),
            $this->getGlobalVars()
        ));
    }

    /**
     * {@inheritdoc}
     */
    protected function render(array $collection)
    {
        return $this->engine->render($this->getTemplateResources(), array_merge(
            array(
                'resources' => $collection,
            ),
            $this->getGlobalVars()
        ));
    }

    /**
     * @return array
     */
    private function getGlobalVars()
    {

        return array(
            'apiName'               => $this->apiName,
            'authentication'        => $this->authentication,
            'endpoint'              => $this->endpoint,
            'enableSandbox'         => $this->enableSandbox,
            'requestFormatMethod'   => $this->requestFormatMethod,
            'acceptType'            => $this->acceptType,
            'bodyFormats'           => $this->bodyFormats,
            'defaultBodyFormat'     => $this->defaultBodyFormat,
            'requestFormats'        => $this->requestFormats,
            'defaultRequestFormat'  => $this->defaultRequestFormat,
            'date'                  => date(DATE_RFC822),
            'css'                   => file_get_contents($this->getTemplateCss()),
            'js'                    => file_get_contents($this->getTemplateJs()),
            'motdTemplate'          => $this->motdTemplate,
            'defaultSectionsOpened' => $this->defaultSectionsOpened,
        );
    }
}
