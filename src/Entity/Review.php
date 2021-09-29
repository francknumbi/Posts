<?php


namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Review
 * @package App\Entity
 * @ORM\Entity
 */
#[ApiResource]
class Review
{
    /** The id of this review. */
    /**
     * @var int|null
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /** The rating of this review (between 0 and 5). */
    /**
     *
     * @ORM\Column(type="smallint")
     */
    public int $rating = 0;

    /** The body of the review. */
    /**
     * @var string
     * @ORM\Column
     */
    public string $body = '';

    /** The author of the review. */
    /**
     * @var string
     * @ORM\Column(type="date_immutable")
     */
    public string $author = '';

    /** The date of publication of this review.*/
    /**
     * @var DateTimeInterface|null
     * @ORM\Column(type="datetime_immutable")
     *
     */
    public ?DateTimeInterface $publicationDate = null;

    /** The book this review is about. */
    /**
    +  @ORM\ManyToOne(targetEntity="Book", inversedBy="reviews")
    */
    #[ApiProperty(readableLink: false, writableLink: false)]
    public ?Book $book = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
