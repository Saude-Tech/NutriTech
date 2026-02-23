<?php

namespace App\Models;

class Categoria
{
    private ?int $id = null;
    private string $nome;
    private ?string $descricao = null;

    public function __construct(string $nome, ?string $descricao = null)
    {
        $this->nome = $nome;
        $this->descricao = $descricao;
    }

    public static function fromArray(array $data): self
    {
        $cat = new self($data['nome'], $data['descricao'] ?? null);
        $cat->id = $data['id'] ?? null;
        return $cat;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function getId(): ?int { return $this->id; }
    public function getNome(): string { return $this->nome; }
}
