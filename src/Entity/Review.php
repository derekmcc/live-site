<?php
/**
 *
 * Summary for the review entity.
 *
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Recipe;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;


/**
 * Start of the Review class
 *
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 * Class Review
 * @package App\Entity
 */
class Review
{
    /**
     * Constant value to define the number of review items to be displayed on each page
     */
    const NUM_ITEMS = 10;

    /**
     * Review id
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Review author
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="reviewAuthor")
     * @ORM\JoinColumn(nullable=true)
     */
    private $author;

    /**
     * Review date of creation
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     */
    private $publishedAt;

    /**
     * Review summary
     * @ORM\Column(type="string")
     */
    private $summary;

    /**
     * Retailers where sell the recipe
     * @ORM\Column(type="string")
     */
    private $retailers;

    /**
     * Price paid for recipe
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * Recipe public true/false
     * @ORM\Column(type="boolean")
     */
    private $isPublicReview;

    /**
     * Request recipe be public
     * @ORM\Column(type="boolean")
     */
    private $requestReviewPublic;

    /**
     * Foreign key reference of user who voted on review
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="voter")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $votes;

    /**
     * Number of stars of recipe
     * @ORM\Column(type="float")
     */
    private $stars;

    /**
     * Review image
     * @ORM\Column(type="string", nullable=true)
     *
     * @Assert\NotBlank(message="Please, upload the image as a jpg")
     * @Assert\File(maxSize="10M",
     *          mimeTypes={
     *          "image/png",
     *          "image/jpeg",
     *          "image/jpg",
     *          "image/gif"
     *          }
     * )
     */
    private $image;

    /**
     * Number of up votes on review
     * @ORM\Column(type="integer", nullable=true)
     */
    private $upVotes = 0;

    /**
     * Number of down votes on review
     * @ORM\Column(type="integer", nullable=true)
     */
    private $downVotes = 0;

    /**
     * Foreign key reference to recipe of who the review belongs to
     * @ORM\ManyToOne(targetEntity="App\Entity\Recipe", inversedBy="reviews")
     * @ORM\JoinColumn(nullable=true)
     */
    private $recipe;

    /**
     * Gets the id of the review
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Gets the author of the review
     * @return User|null
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * Sets the author of the review
     * @param mixed $author
     */
    public function setAuthor(User $author)
    {
        $this->author = $author;
    }

    /**
     * Gets the date the review was published
     * @return mixed
     */
    public function getPublishedAt(): \DateTime
    {
        return $this->publishedAt;
    }

    /**
     * Sets the date the review was published
     * @param mixed $publishedAt
     */
    public function setPublishedAt(\DateTime $publishedAt): void
    {
        $this->publishedAt = $publishedAt;
    }

    /**
     * Gets the summary of the review
     * @return mixed
     */
    public function getSummary(): ?string
    {
        return $this->summary;
    }

    /**
     * Sets the summary of the review
     * @param mixed $summary
     */
    public function setSummary($summary): void
    {
        $this->summary = $summary;
    }

    /**
     * Gets the retailers of where sells the recipe
     * @return mixed
     */
    public function getRetailers(): ?string
    {
        return $this->retailers;
    }

    /**
     * Sets the retailers of where sells the recipe
     * @param mixed $retailers
     */
    public function setRetailers($retailers): void
    {
        $this->retailers = $retailers;
    }

    /**
     * Gets the price paid of the recipe
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Sets the price paid of the recipe
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * Gets the number of stars the recipe has
     * @return mixed
     */
    public function getStars()
    {
        return $this->stars;
    }

    /**
     * Sets the number of stars the recipe has
     * @param mixed $stars
     */
    public function setStars($stars): void
    {
        $this->stars = $stars;
    }

    /**
     * Gets the image of the review
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the image of the review
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * Gets the recipe the review belongs to
     * @return mixed
     */
    public function getRecipe()
    {
        return $this->recipe;
    }

    /**
     * Sets the recipe the review belongs to
     * @param null $recipe
     */
    public function setRecipe($recipe = null)
    {
        $this->recipe = $recipe;
    }

    /**
     * Review constructor
     */
    public function __construct()
    {
        $this->publishedAt = new \DateTime();
        $this->requestReviewPublic = new ArrayCollection();
    }

    /**
     * Gets whether the review is public or not
     * @return mixed
     */
    public function getisPublicReview()
    {
        return $this->isPublicReview;
    }

    /**
     * Sets whether the review is public or not
     * @param mixed $isPublicReview
     */
    public function setIsPublicReview($isPublicReview): void
    {
        $this->isPublicReview = $isPublicReview;
    }

    /**
     * Gets whether the review was requested to be public or not
     * @return mixed
     */
    public function getRequestReviewPublic()
    {
        return $this->requestReviewPublic;
    }

    /**
     * Sets whether the review was requested to be public or not
     * @param mixed $requestReviewPublic
     */
    public function setRequestReviewPublic($requestReviewPublic): void
    {
        $this->requestReviewPublic = $requestReviewPublic;
    }

    /**
     * Gets the user who up/down voted a review
     * @return User|null
     */
    public function getVotes(): ?User
    {
        return $this->votes;
    }

    /**
     * Sets the user who up/down voted a review
     * @param User $votes
     */
    public function setVotes(User $votes): void
    {
        $this->votes = $votes;
    }

    /**
     * Gets the number of up votes of a review
     * @return mixed
     */
    public function getUpVotes()
    {
        return $this->upVotes;
    }

    /**
     * Sets the number of up votes of a review
     * @param mixed $upVotes
     */
    public function setUpVotes($upVotes): void
    {
        $this->upVotes = $upVotes;
    }

    /**
     * Gets the number of down votes of a review
     * @return mixed
     */
    public function getDownVotes()
    {
        return $this->downVotes;
    }

    /**
     * Sets the number of down votes of a review
     * @param mixed $downVotes
     */
    public function setDownVotes($downVotes): void
    {
        $this->downVotes = $downVotes;
    }
}
