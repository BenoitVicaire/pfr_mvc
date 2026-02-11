<?php

namespace App\Model\ThreadModel;


class Thread {
    private ?int $id = null;
    private string $title;
    private int $category_id;
    private string $description;
    private string $content;
    private string $created_at;
    private int $created_by;
    private string $created_by_name;
    private string $last_update;
    private ?string $last_answer = null;

    // Constructor 
    public function __construct(

    ) {

    }

    // Getters et setters 
    public function getId(): int { return $this->id; }
    public function setId(int $id): self { $this->id = $id; return $this; }
    
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): self { $this->title = $title; return $this; }

    public function getCategoryId(): int { return $this->category_id; }
    public function setCategoryId(int $category_id): self { $this->category_id = $category_id; return $this; }

    public function getDescription(): string { return $this->description; }
    public function setDescription(string $description): self { $this->description = $description; return $this; }

    public function getContent(): string { return $this->content; }
    public function setContent(string $content): self { $this->content = $content; return $this; }

    public function getCreatedAt(): string { return $this->created_at; }
    public function setCreatedAt(string $created_at): self { $this->created_at = $created_at; return $this; }

    public function getCreatedBy(): int { return $this->created_by; }
    public function setCreatedBy(int $created_by): self { $this->created_by = $created_by; return $this; }

    public function getCreatedByName(): string { return $this->created_by_name; }
    public function setCreatedByName(string $created_by_name): self { $this->created_by_name = $created_by_name; return $this; }
    
    public function getLastUpdate(): string { return $this->last_update; }
    public function setLastUpdate(string $last_update): self { $this->last_update = $last_update; return $this; }
    
    public function getLastAnswer(): ?string { return $this->last_answer; }
    public function setLastAnswer(?string $last_answer): self { $this->last_answer = $last_answer; return $this; }
    

}
