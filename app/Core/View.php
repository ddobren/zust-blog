<?php

class View
{
    public static function load(string $viewPath, array $vars = []): void
    {
        $fullPath = realpath(BASE_PATH . '/app/Views/' . $viewPath);

        if (!$fullPath || !file_exists($fullPath)) {
            echo "Greška: View fajl '$viewPath' ne postoji.";
            echo "<br>";
            return;
        }

        extract($vars);
        require $fullPath;
    }

 public static function renderTemplate(string $templatePath, string $componentPath, array $data = []): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $templateFullPath = __DIR__ . '/../views/' . $templatePath;
        $componentFullPath = __DIR__ . '/../views/' . $componentPath;

        ob_start();
        extract($data);
        require $componentFullPath; 
        $componentHtml = ob_get_clean();

        ob_start();
        require $templateFullPath;
        $templateContent = ob_get_clean();

        $output = str_replace('{{content}}', $componentHtml, $templateContent);

        echo $output;
    }

    public static function renderTemplateWithVars(string $templatePath, string $componentPath, array $vars = []): void
    {
        // Pokreni sesiju na početku
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $templateFullPath = __DIR__ . '/../views/' . $templatePath;
        $componentFullPath = __DIR__ . '/../views/' . $componentPath;

        if (!file_exists($templateFullPath) || !file_exists($componentFullPath)) {
            echo "Greška: Nisu pronađeni template ili komponenta.";
            return;
        }

        extract($vars);

        // Snimi komponentu u buffer
        ob_start();
        require $componentFullPath;
        $component = ob_get_clean();

        // Učitaj template
        $templateContent = file_get_contents($templateFullPath);

        // Zamijeni {{content}} i odmah ispiši rezultat
        echo str_replace('{{content}}', $component, $templateContent);
    }
}
