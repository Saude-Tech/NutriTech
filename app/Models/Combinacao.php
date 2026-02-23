<?php

namespace App\Models;

class Combinacao
{
    private ?int $id = null;
    private string $descricao;
    private ?string $beneficio = null;

    public function __construct(string $descricao, ?string $beneficio = null)
    {
        $this->descricao = $descricao;
        $this->beneficio = $beneficio;
    }

    public static function fromArray(array $data): self
    {
        $c = new self($data['descricao'], $data['beneficio'] ?? null);
        $c->id = $data['id'] ?? null;
        return $c;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function getId(): ?int { return $this->id; }
}
