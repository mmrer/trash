<?
private function setProperties(array $shipment, Order $order)
    {
        $properties = array ();
        $propertyCollection = $order->getPropertyCollection();
        
        $properties[$this->systemOrderProps[self::marketplaceOrderId]['ID']] = $shipment['shipmentId'];
        $properties[$this->systemOrderProps[self::marketplaceDeliveryId]['ID']] = $shipment['label']['deliveryId'];
        $properties[$this->systemOrderProps[self::marketplaceShipmentDate]['ID']] = date("d.m.Y", strtotime($shipment['label']['shippingDate']));
        
        if (!empty($this->options['propsName']) && empty($this->options['propsSurname']))
        {
            if ($this->options['model'] == 'dsm') {
                $properties[$this->options['propsName']] = $shipment['customer']['customerFullName'];
            } else 
            {
                $properties[$this->options['propsName']] = $shipment['label']['fullName'];
            }
        }
        elseif (!empty($this->options['propsName']) && !empty($this->options['propsSurname']))
        {
            if ($this->options['model'] == 'dsm') {
                $properties[$this->options['propsName']] = trim(mb_substr($shipment['customer']['customerFullName'], 0, mb_strpos($shipment['customer']['customerFullName'], " ")));
                $properties[$this->options['propsSurname']] = trim(mb_substr($shipment['customer']['customerFullName'], mb_strpos($shipment['customer']['customerFullName'], " ")));
            } else 
            {
                $properties[$this->options['propsName']] = trim(mb_substr($shipment['label']['fullName'], 0, mb_strpos($shipment['label']['fullName'], " ")));
                $properties[$this->options['propsSurname']] = trim(mb_substr($shipment['label']['fullName'], mb_strpos($shipment['label']['fullName'], " ")));
            }
        }
        
        if (!empty($this->options['propsLocation']))
        {
            
        }
        
        if (!empty($this->options['propsLocationText']))
        {
            if ($this->options['model'] == 'dsm') {
                $properties[$this->options['propsLocationText']] = implode(", ", array(
                    $shipment['address']['region'],
                    $shipment['address']['city']
                ));
            } else 
            {
                $properties[$this->options['propsLocationText']] = implode(", ", array(
                    $shipment['customer']['address']['regionWithType'],
                    $shipment['customer']['address']['cityWithType']
                ));
            }
        }

        if (!empty($this->options['propsAddress']))
        {
            if ($this->options['model'] == 'dsm') {
                $properties[$this->options['propsAddress']] = $shipment['customer']['address']['source'];
            } else 
            {
                $properties[$this->options['propsAddress']] = $shipment['label']['address'];
            }
        }
        
        if ($this->options['model'] == 'dsm') {
            $modifDate = date('Y-m-d h:i:s', strtotime($shipment['handover']));
            $properties[$this->options['systemPropShipmentDate']] = $modifDate;
        }

        $result = $propertyCollection->setValuesFromPost(array(
            'PROPERTIES' => $properties
        ), array ());

        if ($this->options['model'] == 'dsm') {
            $propertyCollection->getPhone()->setValue($shipment['customer']['phone']);
            $propertyCollection->getUserEmail()->setValue($shipment['customer']['email']);
        } else 
        {
            $propertyCollection->getPhone()->setValue(self::defaultPhone);
            $propertyCollection->getUserEmail()->setValue(self::defaultEmail);
        }
        if (!$result->isSuccess())
        {
            $this->errors[] = $result->getErrorMessages();
        }

        return true;
    }
