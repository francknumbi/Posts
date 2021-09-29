<?php


namespace App\Entity;


use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Book
 * @package App\Entity
 * @ORM\Entity
 */
#[ApiRessource]
class Book
{
    /** The id of this book. */
    /**
     * @var int|null
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /** The ISBN of this book (or null if doesn't have one). */
    /**
     * @var string|null
     * @ORM\Column(nullable=true)
     *
     */
    public ?string $isbn = null;

    /** The title of this book. */
    /**
     * @var string
     * @ORM\Column
     */
    public string $title = '';

    /** The description of this book. */
    /**
     * @var string
     * @ORM\Column(type="text")
     */
    public string $description = '';

    /** The author of this book. */
    /**
     * @var string
     * @ORM\Column
     */
    public string $author = '';

    /** The publication date of this book. */
    /**
     * @var DateTimeInterface|null
     * @ORM\Column(type="date_immutable")
     */
    public ?DateTimeInterface $publicationDate = null;

    /** @var Review[] Available reviews for this book. */
    /** @var iterable|ArrayCollection */
    /** @ORM\OneToMany(targetEntity="Review", mappedBy="book", cascade={"persist","remove"}) */
    #[ApiProperty(readableLink: false, writableLink: false)]
    public iterable $reviews;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
