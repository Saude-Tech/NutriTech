<?php

namespace App\Models;

class Receita
{
    private ?int $id = null;
    private string $nome;
    private string $ingredientes;
    private string $modoReparo;
    private int $tempoReparo;
    private string $unidades;
    private int $porcoes;
    private ?string $regras = null;
    private ?string $restricaoAlimentar;
    private string $dificuldade;
    private ?string $feedback = null;
    private int $categoriaId;
    private ?int $combinacaoId = null;
    private ?string $imagem = null;
    private ?string $video = null;
    private ?string $criadoEm = null;

    public function __construct(
        string $nome,
        string $ingredientes,
        string $modoReparo,
        int $tempoReparo,
        string $unidades,
        int $porcoes,
        string $dificuldade
    ) {
        $this->nome = $nome;
        $this->ingredientes = $ingredientes;
        $this->modoReparo = $modoReparo;
        $this->tempoReparo = $tempoReparo;
        $this->unidades = $unidades;
        $this->porcoes = $porcoes;
        $this->dificuldade = $dificuldade;
    }

    public static function fromArray(array $data): self
    {
        $receita = new self(
            $data['nome'],
            $data['ingredientes'],
            $data['modo_preparo'],
            (int)$data['tempo_preparo'],
            $data['unidades'],
            (int)$data['porcoes'],
            $data['dificuldade']
        );

        $receita->id = $data['id'] ?? null;
        $receita->regras = $data['regras'] ?? null;
        $receita->restricaoAlimentar = $data['restricao_alimentar'] ?? null;
        $receita->feedback = $data['feedback'] ?? null;
        $receita->categoriaId = (int)($data['categoria_id'] ?? 0);
        $receita->combinacaoId = $data['combinacao_id'] ?? null;
        $receita->imagem = $data['imagem'] ?? null;
        $receita->video = $data['video'] ?? null;
        $receita->criadoEm = $data['created_at'] ?? null;

        return $receita;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function getId(): ?int { return $this->id; }
    public function getNome(): string { return $this->nome; }
    public function getCategoriaId(): int { return $this->categoriaId; }
}
