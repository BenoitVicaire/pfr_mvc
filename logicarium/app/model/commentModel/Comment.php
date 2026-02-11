<?php 

namespace App\Model\CommentModel;

class Comment{
    private ?int $id;
    private string $content;
    private string $created_at;
    private int $created_by;
    private int $thread_id;

     // Constructor

    public function __construct(
        
        ){
            
        }

    public function getId(): int { return $this->id; }
    public function setId(int $id): self { $this->id = $id; return $this; }

    public function getContent(): string { return $this->content; }
    public function setContent(string $content): self { $this->content = $content; return $this; }

    public function getCreatedAt(): string { return $this->created_at; }
    public function setCreatedAt(string $created_at): self { $this->created_at = $created_at; return $this; }

    public function getCreatedBy(): int { return $this->created_by; }
    public function setCreatedBy(int $created_by): self { $this->created_by = $created_by; return $this; }

    public function getThreadId(): int { return $this->thread_id; }
    public function setThreadId(int $thread_id): self { $this->thread_id = $thread_id; return $this; }
}