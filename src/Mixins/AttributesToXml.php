<?php

namespace Paynamics\Paygate\Mixins;

use SimpleXMLElement;

trait AttributesToXml
{
    public function arrayToXml(array $array, SimpleXMLElement $xml, ?string $parentKey = null): SimpleXMLElement
    {
        foreach ($array as $key => $value)
        {
            if (is_array($value))
            {
                $childNode = $this->setChildNode($value, $xml, $key, $parentKey);
                $this->arrayToXml($value, $childNode, $key);
            }
            else
            {
                $xml->addChild($key, $value ? htmlspecialchars($value) : null);
            }
        }

        return $xml;
    }

    public function __toXmlString()
    {
        return $this->arrayToXml($this->getAttributes(), new SimpleXMLElement('<Request/>'))->asXML();
    }

    // Set the correct child node.
    protected function setChildNode(array $value, SimpleXMLElement $xml, string|int $key, ?string $parentKey = null)
    {
        if (isset($value[0]))
        {
            return $xml;
        }

        if (is_numeric($key))
        {
            return $xml->addChild($parentKey);
        }
        
        return $xml->addChild($key);
    }
}
