<?php
declare(strict_types=1);

namespace App\Framework\View;

use App\Framework\Exception\ViewNotFoundException;

readonly class View
{
    public function __construct(
        private string $title
    ) {}

    /**
     * Associe une vue avec les données envoyées et affiche le résultat
     * @param string $path
     * @param array $params
     * @return void
     * @throws ViewNotFoundException
     */
    public function render(string $path, array $params = []): void
    {
        $file = dirname(__DIR__) . '/../../templates/' . $path . '.php';
        if (file_exists($file)) {
            extract($params);
            $title = $this->title;
            include dirname(__DIR__) . '/../../templates/base_layout.php';
        } else {
            throw new ViewNotFoundException(sprintf('La vue "%s" n\'existe pas', $file));
        }
    }
}
