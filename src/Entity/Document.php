<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 * @Vich\Uploadable
 */
class Document
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="date")
     */
    private $annePublication;

    /**
     * @ORM\Column(type="date")
     */
    private $dateSoutenance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombreJury;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $universite;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $resume;

    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $organisme;

    /**
     * @ORM\ManyToOne(targetEntity=TypeDocument::class, inversedBy="documents")
     */
    private $typedocument;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="documents")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Domaine::class, inversedBy="documents")
     */
    private $domaine;

    /**
     * @ORM\ManyToOne(targetEntity=Niveau::class, inversedBy="documents")
     */
    private $niveau;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fichier;

    /**
     * @Vich\UploadableField(mapping="mes_documents", fileNameProperty="fichier")
     * @var File
     */
    private $imageFile;
    /**
     * @ORM\Column(type="float")
     */
    private $periode;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $nombrepage;

    /**
     * @ORM\Column(type="string", length=255 , nullable=false)
     */
    private $apreciation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couverture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $referent_source;
    



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAnnePublication(): ?\DateTimeInterface
    {
        return $this->annePublication;
    }

    public function setAnnePublication(\DateTimeInterface $annePublication): self
    {
        $this->annePublication = $annePublication;

        return $this;
    }

    public function getDateSoutenance(): ?\DateTimeInterface
    {
        return $this->dateSoutenance;
    }

    public function setDateSoutenance(\DateTimeInterface $dateSoutenance): self
    {
        $this->dateSoutenance = $dateSoutenance;

        return $this;
    }

    public function getNombreJury(): ?string
    {
        return $this->nombreJury;
    }

    public function setNombreJury(string $nombreJury): self
    {
        $this->nombreJury = $nombreJury;

        return $this;
    }

    public function getUniversite(): ?string
    {
        return $this->universite;
    }

    public function setUniversite(string $universite): self
    {
        $this->universite = $universite;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getOrganisme(): ?string
    {
        return $this->organisme;
    }

    public function setOrganisme(string $organisme): self
    {
        $this->organisme = $organisme;

        return $this;
    }

    public function getTypedocument(): ?TypeDocument
    {
        return $this->typedocument;
    }

    public function setTypedocument(?TypeDocument $typedocument): self
    {
        $this->typedocument = $typedocument;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDomaine(): ?Domaine
    {
        return $this->domaine;
    }

    public function setDomaine(?Domaine $domaine): self
    {
        $this->domaine = $domaine;

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getFichier(): ?string
    {
        return $this->fichier;
    }

    public function setFichier(?string $fichier): self
    {
        $this->fichier = $fichier;

        return $this;
    }

    

   

    public function getPeriode(): ?float
    {
        return $this->periode;
    }

    public function setPeriode(float $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    public function getNombrepage(): ?float
    {
        return $this->nombrepage;
    }

    public function setNombrepage(?float $nombrepage): self
    {
        $this->nombrepage = $nombrepage;

        return $this;
    }

    public function getApreciation(): ?string
    {
        return $this->apreciation;
    }

    public function setApreciation(string $apreciation): self
    {
        $this->apreciation = $apreciation;

        return $this;
    }

    public function setImageFile(File $fichier = null)
    {
        $this->imageFile = $fichier;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($fichier) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }
   

    public function __toString() {
        return $this->name;
    }

    public function getCouverture(): ?string
    {
        return $this->couverture;
    }

    public function setCouverture(string $couverture): self
    {
        $this->couverture = $couverture;

        return $this;
    }

    public function getReferentSource(): ?string
    {
        return $this->referent_source;
    }

    public function setReferentSource(?string $referent_source): self
    {
        $this->referent_source = $referent_source;

        return $this;
    }
}
