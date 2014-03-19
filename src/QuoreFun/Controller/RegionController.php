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

        $region->setName($formData['name']);

        // save changes to the db
        $this->getEntityManager()->flush();

        $this->returnJsonResponse($region->toArray(), $response);
    }

    public function create($request, $response)
    {
        $formData = $this->decodeJsonData($request);

        $region = new Region();
        $region->hydrateFromArray($formData);

        $em = $this->getEntityManager();
        $em->persist($region);
        $em->flush();
    }

    public function delete($request, $response)
    {
        $region = $this->getRegion($request->params['id']);

        $em = $this->getEntityManager();
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
}