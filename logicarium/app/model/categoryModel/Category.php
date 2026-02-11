<?php 

namespace App\Model\CategoryModel;

class Category{
    private int $id;
    private string $name;
    private string $description;

    // Constructor

    public function __construct(

        ){
            
        }
   
    // Getter and Setter
    public function getId(): int { return $this->id; }
    public function setId(int $id): self { $this->id = $id; return $this; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }

    public function getDescription(): string { return $this->description; }
    public function setDescription(string $description): self { $this->description = $description; return $this; }
}