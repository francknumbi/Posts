<?php


namespace App\Repository;


use App\Entity\Dependency;

class DependencyRepository
{
    public  function __construct(private string $rootPath){

    }
    private function getDependencies():array{

        $path = $this->rootPath . '/composer.json';
        $json =json_decode(file_get_contents($path),true);
        return $json['require'];
    }

    public function findAll(){

        $items=[];
        foreach ($this->getDependencies() as $name=> $version)
        {
            $items[]= new Dependency($name,$version);
        }
        return $items;
    }
    public function find(string $uuid):?Dependency
    {
        $dependencies = $this->findAll();
        foreach ($dependencies as $dependency){
            if($dependency->getUuid() == $uuid)
            {
                return $dependency;
            }
        }
        return null;
    }
    public function persist(Dependency $dependency){
        $path = $this->rootPath . '/composer.json';
        $json = json_decode(file_get_contents($path),true);
        $json['require'][$dependency->getName()]=$dependency->getVersion();
        file_put_contents($path,json_encode($json));
    }
}
