<?php

namespace QuoreFun\Controller;

use QuoreFun\Entity\Region;

class RegionController extends QuoreController 
{
    public function query($request, $response)
    {
        $regions = $this->getRegionRepository()->findAllToArray();

        $this->returnJsonResponse($regions, $response);
    }

    public function get($request, $response)
    {
        $region = $this->getRegion($request->params['id']);

        $this->returnJsonResponse($region->toArray(), $response);
    }

    public function update($request, $response)
    {
        $formData = $this->decodeJsonData($request);

        $region = $this->getRegion($request->params['id']);
        $region->hydrateFromArray($formData);

        if (!$this->getValidator()->isValid($region)) {
            // some constraint has failed so we better not flush
            $region->setErrors($this->getValidator()->getErrors());

            $this->returnJsonResponse($region->toArray(), $response);
        }

        // save changes to the db
        $this->getEntityManager()->flush();

        $this->returnJsonResponse($region->toArray(), $response);
    }

    public function create($request, $response)
    {
        $formData = $this->decodeJsonData($request);

        $region = new Region();
        $region->hydrateFromArray($formData);

        if (!$this->getValidator()->isValid($region)) {
            // some constraint has failed so we better not flush
            $region->setErrors($this->getValidator()->getErrors());

            $this->returnJsonResponse($region->toArray(), $response);
        }

        $em = $this->getEntityManager();
        $em->persist($region);
        $em->flush();

        $this->returnJsonResponse($region->toArray(), $response);
    }

    public function delete($request, $response)
    {
        $region = $this->getRegion($request->params['id']);
        $properties = $this->getPropertyRepository()->findByRegionId($region->getId());

        $em = $this->getEntityManager();

        foreach ($properties as $property) {
            $em->remove($property);
        }

        $em->remove($region);
        $em->flush();
    }

    private function getRegion($regionId)
    {
        return $this->getRegionRepository()->find($regionId);
    }

    private function getRegionRepository()
    {
        return $this->getEntityManager()->getRepository('QuoreFun\Entity\Region');
    }

    private function getPropertyRepository()
    {
        return $this->getEntityManager()->getRepository('QuoreFun\Entity\Property');
    }
}