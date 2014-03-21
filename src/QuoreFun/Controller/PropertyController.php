<?php

namespace QuoreFun\Controller;

use QuoreFun\Entity\Property;

class PropertyController extends QuoreController
{
    public function query($request, $response)
    {
        $properties = $this->getPropertyRepository()->findByRegionToArray($request->params['regionId']);

        $this->returnJsonResponse($properties, $response);
    }

    public function get($request, $response)
    {
        $property = $this->getProperty($request->params['propertyId']);

        $this->returnJsonResponse($property->toArray(), $response);
    }

    public function update($request, $response)
    {
        $property = $this->getProperty($request->params['propertyId']);

        $formData = $this->decodeJsonData($request);

        $property->hydrateFromArray($formData);

        $this->getEntityManager()->flush();
    }

    public function create($request, $response)
    {
        $region = $this->getRegion($request->params['regionId']);

        $formData = $this->decodeJsonData($request);

        $property = new Property();
        $property->setRegion($region);
        $property->hydrateFromArray($formData);

        $em = $this->getEntityManager();
        $em->persist($property);
        $em->flush();
    }

    public function delete($request, $response)
    {
        $property = $this->getProperty($request->params['propertyId']);

        $em = $this->getEntityManager();
        $em->remove($property);
        $em->flush();
    }

    private function getRegion($regionId)
    {
        return $this->getRegionRepository()->find($regionId);
    }

    private function getProperty($propertyId)
    {
        return $this->getPropertyRepository()->find($propertyId);
    }

    private function getPropertyRepository()
    {
        return $this->getEntityManager()->getRepository('QuoreFun\Entity\Property');
    }

    private function getRegionRepository()
    {
        return $this->getEntityManager()->getRepository('QuoreFun\Entity\Region');
    }
}
