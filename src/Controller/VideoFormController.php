<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class VideoFormController implements Controller
{
    public function __construct(private VideoRepository $repository)
    {
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        /** @var ?Video $video */
        $video = null;
        if ($id !== false && $id !== null) {
            $video = $this->repository->find($id);
        }

        require_once __DIR__ . '/../../inicio-html.php'; ?>
        <main class="container">
            <form class="container__formulario"
                  method="post">
                <h2 class="formulario__titulo">Envie um vídeo!</h2>
                    <div class="formulario__campo">
                        <label class="campo__etiqueta" for="url">Link embed</label>
                        <input name="url"
                               value="<?= $video?->url; ?>"
                               class="campo__escrita"
                               required
                               placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g"
                               id='url' />
                    </div>

                    <div class="formulario__campo">
                        <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                        <input name="titulo"
                               value="<?= $video?->title; ?>"
                               class="campo__escrita"
                               required
                               placeholder="Neste campo, dê o nome do vídeo"
                               id='titulo' />
                    </div>

                    <input class="formulario__botao" type="submit" value="Enviar" />
            </form>
        </main>

        <?php
        require_once __DIR__ . '/../../fim-html.php';
    }
}
