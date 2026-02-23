<?php

namespace App\Models;

class Feedback
{
    private ?int $id = null;
    private int $usuarioId;
    private int $receitaId;
    private int $nota;
    private ?string $comentario = null;
    private ?string $createdAt = null;

    public function __construct(int $usuarioId, int $receitaId, int $nota)
    {
        $this->usuarioId = $usuarioId;
        $this->receitaId = $receitaId;
        $this->nota = $nota;
    }

    public static function fromArray(array $data): self
    {
        $f = new self(
            (int)$data['usuario_id'],
            (int)$data['receita_id'],
            (int)$data['nota']
        );

        $f->id = $data['id'] ?? null;
        $f->comentario = $data['comentario'] ?? null;
        $f->createdAt = $data['created_at'] ?? null;

        return $f;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
