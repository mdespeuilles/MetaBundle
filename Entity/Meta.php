<?php

namespace Mdespeuilles\MetaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Meta
 *
 * @ORM\Table(name="meta")
 * @ORM\Entity(repositoryClass="Mdespeuilles\MetaBundle\Repository\MetaRepository")
 * @Vich\Uploadable()
 */
class Meta
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="ogTitle", type="string", length=255, nullable=true)
     */
    private $ogTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="ogDescription", type="text", nullable=true)
     */
    private $ogDescription;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="og_image", fileNameProperty="ogImage")
     *
     * @var File
     */
    private $ogImageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="ogImage", type="string", length=255, nullable=true)
     */
    private $ogImage;

    /**
     * @var string
     *
     * @ORM\Column(name="ogType", type="string", length=255, nullable=true)
     */
    private $ogType;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=255, nullable=true)
     */
    private $language;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Meta
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Meta
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set ogTitle
     *
     * @param string $ogTitle
     *
     * @return Meta
     */
    public function setOgTitle($ogTitle)
    {
        $this->ogTitle = $ogTitle;

        return $this;
    }

    /**
     * Get ogTitle
     *
     * @return string
     */
    public function getOgTitle()
    {
        return $this->ogTitle;
    }

    /**
     * Set ogDescription
     *
     * @param string $ogDescription
     *
     * @return Meta
     */
    public function setOgDescription($ogDescription)
    {
        $this->ogDescription = $ogDescription;

        return $this;
    }

    /**
     * Get ogDescription
     *
     * @return string
     */
    public function getOgDescription()
    {
        return $this->ogDescription;
    }

    /**
     * Set ogImage
     *
     * @param string $ogImage
     *
     * @return Meta
     */
    public function setOgImage($ogImage)
    {
        $this->ogImage = $ogImage;

        return $this;
    }

    /**
     * Get ogImage
     *
     * @return string
     */
    public function getOgImage()
    {
        return $this->ogImage;
    }

    /**
     * Set ogType
     *
     * @param string $ogType
     *
     * @return Meta
     */
    public function setOgType($ogType)
    {
        $this->ogType = $ogType;

        return $this;
    }

    /**
     * Get ogType
     *
     * @return string
     */
    public function getOgType()
    {
        return $this->ogType;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Meta
     */
    public function setOgImageFile(File $image = null)
    {
        $this->ogImageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getOgImageFile()
    {
        return $this->ogImageFile;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }
    
    /**
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }
    
    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
    }
}

