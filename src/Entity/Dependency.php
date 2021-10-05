<?php


namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use phpDocumentor\Reflection\DocBlock\Description;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ApiResource(
    collectionOperations: ['get','post'],
    itemOperations: [
        'get',
        'put'=>[
            'denormalization_context'=>[
                'groups'=>['put:Dependency']
            ]
        ]],
    paginationEnabled: false
)]
class Dependency
{
    #[ApiProperty(
        identifier:true
    )
    ]
    private string $uuid;
    #[
        ApiProperty(
        description: 'Nom de la dependance'
        ),
        length(min:2),
        NotBlank()
    ]
    private string $name;
    #[
        ApiProperty(
            description:'version de la dependance',
            openapiContext:[
                'example'=>'5.2.*'
            ]
        ),
        length(min:2),
        NotBlank(),
        Groups(['put:Dependency'])
    ]
    private string $version;



    public function __construct( string $name, string$version)
    {
        $this->uuid= Uuid::uuid5(Uuid::NAMESPACE_URL,$name)->toString();
        $this->name=$name;
        $this->version=$version;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

}
