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

        $templateFullPath = realpath(BASE_PATH . '/app/Views/' . $templatePath);
        $componentFullPath = realpath(BASE_PATH . '/app/Views/' . $componentPath);

        if (!$templateFullPath || !$componentFullPath) {
            echo "Greška: Nisu pronađeni template ili komponenta.";
            return;
        }

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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $templateFullPath = realpath(BASE_PATH . '/app/Views/' . $templatePath);
        $componentFullPath = realpath(BASE_PATH . '/app/Views/' . $componentPath);

        if (!$templateFullPath || !$componentFullPath) {
            echo "Greška: Nisu pronađeni template ili komponenta.";
            return;
        }

        extract($vars);

        ob_start();
        require $componentFullPath;
        $component = ob_get_clean();

        $templateContent = file_get_contents($templateFullPath);

        echo str_replace('{{content}}', $component, $templateContent);
    }
}
